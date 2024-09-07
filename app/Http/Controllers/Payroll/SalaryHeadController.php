<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use App\Models\Payroll\SalaryHead;
use Illuminate\Http\Request;

class SalaryHeadController extends Controller
{
    public function index()
    {
        $data['page_title'] =  'salary head';
        $data['salary_heads'] =  SalaryHead::orderBy('id', 'asc')->get();
        return view('payroll.salary_head.index', $data);
    }

    public function create()
    {
        $data['page_title'] =  'salary head';
        return view('payroll.salary_head.create_edit', $data);
    }

    public function store(Request $request)
    {
        // return $request;
        $data = $request->all();

        $validate_data = $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        SalaryHead::create($data);
        return back()->with('success', "Data created successfully. ");
    }

    public function edit(string $id)
    {
        $data['page_title'] =  'salary head';
        $data['salary_head'] = SalaryHead::find($id);
        return view('payroll.salary_head.create_edit', $data);
    }

    public function update(Request $request, string $id)
    {
        $validate_data = $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        $single_data = SalaryHead::find($id);
        $data = $request->all();
        $single_data->update($data);
        return redirect()->route('salary_head.index')->with('success', "Data updated successfully");
    }

    public function destroy(string $id)
    {
        SalaryHead::find($id)->delete();
        return back()->with('delete', "Data delete successfully!");
    }

    public function show(string $id)
    {
        $salary_head = SalaryHead::find($id);
        return view('payroll.salary_head.show');
    }
}
