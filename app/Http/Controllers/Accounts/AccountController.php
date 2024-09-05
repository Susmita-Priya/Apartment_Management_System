<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use App\Models\Accounts\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        $data['page_title'] =  'Account';
        $data['accounts'] =  Account::orderBy('id', 'desc')->get();
        return view('accounts.account.index', $data);
    }

    public function create()
    {
        $data['page_title'] =  'Account';
        return view('accounts.account.create_edit', $data);
    }

    public function store(Request $request)
    {
        // return $request;
        $data = $request->all();

        $validate_data = $request->validate([
            'account_title' => 'required',
            'status' => 'required',
        ]);

        Account::create($data);
        return back()->with('success', "Data created successfully. ");
    }

    public function edit(string $id)
    {
        $data['page_title'] =  'Account';
        $data['account'] = Account::find($id);
        return view('accounts.account.create_edit', $data);
    }

    public function update(Request $request, string $id)
    {
        $validate_data = $request->validate([
            'account_title' => 'required',
            'status' => 'required',
        ]);

        $single_data = Account::find($id);
        $data = $request->all();
        $single_data->update($data);
        return redirect()->route('account.index')->with('success', "Data updated successfully");
    }

    public function destroy(string $id)
    {
        Account::find($id)->delete();
        return back()->with('delete', "Data delete successfully!");
    }

    public function show(string $id)
    {
        $account = Account::find($id);
        return view('accounts.account.show');
    }
}
