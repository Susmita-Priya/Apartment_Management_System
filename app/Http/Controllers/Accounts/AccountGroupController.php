<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use App\Models\Accounts\AccountGroup;
use Illuminate\Http\Request;

class AccountGroupController extends Controller
{
    public function index()
    {
        $data['page_title'] =  'Account Group';
        $data['account_groups'] =  AccountGroup::orderBy('id', 'desc')->get();
        return view('accounts.account-group.index', $data);
    }

    public function create()
    {
        $data['page_title'] =  'Account Group';
        return view('accounts.account-group.create_edit', $data);
    }

    public function store(Request $request)
    {
        // return $request;
        $data = $request->all();

        $validate_data = $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        AccountGroup::create($data);
        return back()->with('success', "Data created successfully. ");
    }

    public function edit(string $id)
    {
        $data['page_title'] =  'Account Group';
        $data['account_group'] = AccountGroup::find($id);
        return view('accounts.account-group.create_edit', $data);
    }

    public function update(Request $request, string $id)
    {
        $validate_data = $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        $single_data = AccountGroup::find($id);
        $data = $request->all();
        $single_data->update($data);
        return redirect()->route('account-group.index')->with('success', "Data updated successfully");
    }

    public function destroy(string $id)
    {
        AccountGroup::find($id)->delete();
        return back()->with('delete', "Data delete successfully!");
    }

    public function show(string $id)
    {
        $account = AccountGroup::find($id);
        return view('accounts.account-group.show');
    }
}
