<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use App\Models\Accounts\Account;
use App\Models\Accounts\AccountGroup;
use App\Models\Accounts\JournalEntry;
use App\Models\Accounts\JournalEntryDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JournalEntryController extends Controller
{
    public function index()
    {
        $data['page_title'] =  'Journal Entry';
        $data['journal_entries'] =  JournalEntry::orderBy('id', 'desc')
            ->with('journal_entry_details.account', 'data_inputed_by')
            ->get();

        // return $data['journal_entries'];

        return view('accounts.journal-entry.index', $data);
    }

    public function create()
    {
        $latest_data = JournalEntry::orderByDesc('id')->first();
        if (!empty($latest_data)) {
            $number = ($latest_data->id) + 1;
        } else {
            $number =  1;
        }
        $data['journal_code'] =  'JC0' . $number;

        $data['page_title'] =  'Journal Entry';
        $data['accounts'] =  Account::orderBy('id', 'desc')->where('status',1)->get();
        $data['account_groups'] =  AccountGroup::orderBy('id', 'desc')->where('status',1)->get();
        // return $data['account_groups'];
        return view('accounts.journal-entry.create', $data);
    }

    public function store(Request $request)
    {
        // return $request;
        $validate_data = $request->validate([
            'entry_date' => 'required',
            'account_id' => 'required',
            'account_group_id' => 'required',
        ]);

        $created_by = Auth::user()->id ?? 0;

        $journal_entry = JournalEntry::create([
            'entry_date' => $request->entry_date,
            'journal_code' => $request->journal_code,
            'remarks' => $request->remarks,
            'created_by' => $created_by,
        ]);

        if (!empty($request->account_id)) {
            foreach ($request->account_id as $key => $account_id) {
                JournalEntryDetail::create([
                    'entry_date' => $request->entry_date,
                    'journal_entry_id' => $journal_entry->id,
                    'account_id' => $account_id,
                    'account_group_id' => $request->account_group_id[$key],
                    'debit' => $request->debit[$key],
                    'credit' => $request->credit[$key],
                    'created_by' => $created_by,
                ]);
            }
        }

        return back()->with('success', "Data created successfully. ");
    }

    public function edit(string $id)
    {
        $data['page_title'] =  'Journal Entry';
        $data['journal_entry'] = JournalEntry::find($id);
        $data['accounts'] =  Account::orderBy('id', 'desc')->where('status',1)->get();
        $data['account_groups'] =  AccountGroup::orderBy('id', 'desc')->where('status',1)->get();
        // return $data['journal_entry'];

        return view('accounts.journal-entry.edit', $data);
    }

    public function update(Request $request, string $id)
    {
        // return $request;
        $validate_data = $request->validate([
            'entry_date' => 'required',
            'account_id' => 'required',
            'account_group_id' => 'required',
        ]);

        $journal_entry = JournalEntry::find($id);

        $updated_by = Auth::user()->id ?? 0;

        $journal_entry->update([
            'entry_date' => $request->entry_date,
            'journal_code' => $request->journal_code,
            'remarks' => $request->remarks,
            'updated_by' => $updated_by,
        ]);

        JournalEntryDetail::where('journal_entry_id', $journal_entry->id)->delete();

        if (!empty($request->account_id)) {
            foreach ($request->account_id as $key => $account_id) {
                JournalEntryDetail::create([
                    'entry_date' => $request->entry_date,
                    'journal_entry_id' => $journal_entry->id,
                    'account_id' => $account_id,
                    'account_group_id' => $request->account_group_id[$key],
                    'debit' => $request->debit[$key],
                    'credit' => $request->credit[$key],
                    'updated_by' => $updated_by,
                ]);
            }
        }
        return redirect()->route('journal-entry.index')->with('success', "Data updated successfully");
    }

    public function destroy(string $id)
    {
        JournalEntry::find($id)->delete();
        JournalEntryDetail::where('journal_entry_id', $id)->delete();
        return back()->with('delete', "Data delete successfully!");
    }

    public function addMoreInput(Request $request)
    {
        $data['index_count'] = $request->index_count;
        $data['accounts'] =  Account::orderBy('id', 'desc')->where('status',1)->get();
        $data['account_groups'] =  AccountGroup::orderBy('id', 'desc')->where('status',1)->get();
        // return $data['account_groups'];
        return view('accounts.journal-entry.add_more_input', $data);
    }

    public function show(string $id)
    {
        $data['journal_entry'] = JournalEntry::find($id);
        $data['page_title'] =  'Journal Entry';
        return view('accounts.journal-entry.show',$data);
    }
}
