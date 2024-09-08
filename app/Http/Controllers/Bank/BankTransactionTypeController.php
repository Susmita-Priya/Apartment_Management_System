<?php

namespace App\Http\Controllers\Bank;

use App\Http\Controllers\Controller;
use App\Models\Bank\BankTransactionType;
use Illuminate\Http\Request;

class BankTransactionTypeController extends Controller
{
    public function index()
    {
        $data['page_title'] =  'bank transaction type';
        $data['bank_transaction_types'] =  BankTransactionType::orderBy('id', 'desc')->get();
        return view('bank.transaction_type.index', $data);
    }

    public function create()
    {
        $data['page_title'] =  'bank transaction type';
        return view('bank.transaction_type.create_edit', $data);
    }

    public function store(Request $request)
    {
        // return $request;
        $data = $request->all();

        $validate_data = $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        BankTransactionType::create($data);
        return back()->with('success', "Data created successfully. ");
    }

    public function edit(string $id)
    {
        $data['page_title'] =  'bank transaction type';
        $data['bank_transaction_type'] = BankTransactionType::find($id);
        return view('bank.transaction_type.create_edit', $data);
    }

    public function update(Request $request, string $id)
    {
        $validate_data = $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        $single_data = BankTransactionType::find($id);
        $data = $request->all();
        $single_data->update($data);
        return redirect()->route('bank_transaction_type.index')->with('success', "Data updated successfully");
    }

    public function destroy(string $id)
    {
        BankTransactionType::find($id)->delete();
        return back()->with('delete', "Data delete successfully!");
    }
}
