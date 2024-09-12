<?php

namespace App\Http\Controllers\Bank;

use App\Http\Controllers\Controller;

use App\Models\Accounts\Account;
use App\Models\Bank\BankTransaction;
use App\Models\Bank\BankTransactionType;
use Illuminate\Http\Request;

class BankTransactionController extends Controller
{
    public function index(Request $request)
    {
        $data['page_title'] = 'Bank Transaction';
        $data['accounts'] = Account::where('status', 1)->get();
        $data['bank_transaction_types'] = BankTransactionType::where('status', 1)->get();

        $data['start_date'] = $start_date = $request->start_date ?? date('Y-m-d');
        $data['end_date'] = $end_date = $request->end_date ?? date('Y-m-d');
        $data['searched_transaction_type'] = $searched_transaction_type = $request->bank_transaction_type_id ?? '';

        $data['bankTransactions'] = BankTransaction::with('account','transaction_type')
            ->orderBy('id', 'desc')
            ->whereBetween('transaction_date', [$start_date, $end_date])
            ->when($searched_transaction_type != '', function ($query) use ($searched_transaction_type) {
                $query->where('bank_transaction_type_id', $searched_transaction_type);
            })
            ->when($start_date != '', function ($query) use ($start_date) {
                $query->whereDate('transaction_date', '>=', $start_date);
            })
            ->when($end_date != '', function ($query) use ($end_date) {
                $query->whereDate('transaction_date', '<=', $end_date);
            })
            ->get();
        // return $data['bankTransactions'];

        return view('bank.transaction.index', $data);
    }

    public function create()
    {
        $data['page_title'] = 'Bank Transaction';
        $data['accounts'] = Account::where('status', 1)->get();
        $data['bank_transaction_types'] = BankTransactionType::where('status', 1)->get();
        return view('bank.transaction.create', $data);
    }

    public function store(Request $request)
    {
        // return $request->all();

        $request->validate([
            'transaction_date' => 'required',
            'account_id' => 'required',
            'bank_transaction_type_id' => 'required',
            'transaction_amount' => 'required',
        ]);

        $data = $request->all();
        BankTransaction::create($data);
        return redirect()->back()->with('success', 'Data added successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data['page_title'] = 'Bank Transaction';
        $data['bank_transaction'] = BankTransaction::find($id);
        $data['accounts'] = Account::where('status', 1)->get();
        $data['bank_transaction_types'] = BankTransactionType::where('status', 1)->get();

        return view('bank.transaction.edit', $data);
    }

    public function update(Request $request, $id)
    {
        // return $request->all();

        $request->validate([
            'transaction_date' => 'required',
            'account_id' => 'required',
            'bank_transaction_type_id' => 'required',
            'transaction_amount' => 'required',
        ]);

        $data = $request->all();
        $bank_transaction = BankTransaction::find($id);
        $bank_transaction->update($data);
        return redirect()->back()->with('success', 'Data added successfully');
    }

    public function destroy($id)
    {
        BankTransaction::find($id)->delete();
        return redirect()->back()->with('error', 'Data deleted successfully');
    }

    public function transactionReport(Request $request)
    {
        // return $request->all();
        
        $data['page_title'] = 'Bank Transaction';
        $data['start_date'] = $start_date =  $request->start_date ?? date('Y-m-d');
        $data['end_date'] = $end_date =   $request->end_date ?? date('Y-m-d');

        $data['searched_account_id'] = $searched_account_id = $request->account_id;
        $data['searched_account'] = Account::find($request->account_id);
        $data['accounts'] = Account::where('status', 1)->get();

        $data['searched_transaction_type_id'] = $searched_transaction_type_id = $request->bank_transaction_type_id ?? '';
        $data['searched_transaction_type'] = BankTransactionType::find($searched_transaction_type_id);
        $data['bank_transaction_types'] = BankTransactionType::where('status', 1)->get();

        $data['bankTransactions'] = BankTransaction::with('account')
            ->when($searched_transaction_type_id != '', function ($query) use ($searched_transaction_type_id) {
                $query->where('bank_transaction_type_id', $searched_transaction_type_id);
            })
            ->when($searched_account_id != 0, function ($query) use ($searched_account_id) {
                $query->where('account_id', $searched_account_id);
            })
            ->when($start_date != "", function ($query) use ($start_date) {
                $query->whereDate('transaction_date', '>=', $start_date);
            })
            ->when($end_date != "", function ($query) use ($end_date) {
                $query->whereDate('transaction_date', '<=', $end_date);
            })
            ->orderBy('id', 'desc')
            ->get();

        // return $data['investments'];


        return view('bank.transaction.report', $data);
    }
}
