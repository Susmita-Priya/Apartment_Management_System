<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use App\Models\Accounts\Account;
use App\Models\Accounts\AccountGroup;
use App\Models\Accounts\JournalEntryDetail;
use Illuminate\Http\Request;

class AccountingReportController extends Controller
{
    public function generalLedger(Request $request)
    {
        $data['page_title'] =  'General Ledger Report';

        $data['start_date'] = $start_date =  $request->start_date ?? date('Y-m-d');
        $data['end_date'] = $end_date =   $request->end_date ?? date('Y-m-d');
        $data['searched_account_group_id'] = $account_group_id =   $request->account_group_id ?? 0;

        $data['searched_account_group'] =  AccountGroup::find($account_group_id);

        $data['account_groups'] =  AccountGroup::orderBy('id', 'desc')->where('status', 1)->get();

        $data['journal_entry_details'] = JournalEntryDetail::orderByDesc('id')
            ->when($account_group_id != 0, function ($query) use ($account_group_id) {
                $query->where('account_group_id', $account_group_id);
            })
            ->when($start_date != '', function ($query) use ($start_date) {
                $query->whereDate('entry_date', '>=', $start_date);
            })
            ->when($end_date != '', function ($query) use ($end_date) {
                $query->whereDate('entry_date', '<=', $end_date);
            })
            ->get();

        // return $data['accounts'];


        // previous balance start
        // $previous_credited = JournalEntryDetail::orderByDesc('id')
        //     ->when($account_group_id != 0, function ($query) use ($account_group_id) {
        //         $query->where('account_group_id', $account_group_id);
        //     })
        //     ->when($start_date != '', function ($query) use ($start_date) {
        //         $query->whereDate('entry_date', '<', $start_date);
        //     })
        //     ->sum('credit');
        // $previous_debited = JournalEntryDetail::orderByDesc('id')
        //     ->when($account_group_id != 0, function ($query) use ($account_group_id) {
        //         $query->where('account_group_id', $account_group_id);
        //     })
        //     ->when($start_date != '', function ($query) use ($start_date) {
        //         $query->whereDate('entry_date', '<', $start_date);
        //     })
        //     ->sum('debit');

        // $data['previous_balance'] = $previous_credited - $previous_debited;

        // end previous balance

        return view('accounts.report.general_ledger', $data);
    }

    public function balance_sheet(Request $request)
    {
        $data['page_title'] =  'Balance Sheet';
        $data['accounts'] =  Account::orderBy('id', 'asc')->where('status', 1)->get();
        return view('accounts.account.balance_sheet', $data);
    }
}
