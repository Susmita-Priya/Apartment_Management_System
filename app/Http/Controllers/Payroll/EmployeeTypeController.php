<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use App\Models\Payroll\EmployeeType;
use Illuminate\Http\Request;

class EmployeeTypeController extends Controller
{
    public function index()
    {
        $data['page_title'] =  'employee type';
        $data['employee_types'] =  EmployeeType::orderBy('id', 'desc')->get();
        return view('payroll.employee_type.index', $data);
    }

    public function create()
    {
        $data['page_title'] =  'employee type';
        return view('payroll.employee_type.create_edit', $data);
    }

    public function store(Request $request)
    {
        // return $request;
        $data = $request->all();

        $validate_data = $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        EmployeeType::create($data);
        return back()->with('success', "Data created successfully. ");
    }

    public function edit(string $id)
    {
        $data['page_title'] =  'employee type';
        $data['employee_type'] = EmployeeType::find($id);
        return view('payroll.employee_type.create_edit', $data);
    }

    public function update(Request $request, string $id)
    {
        $validate_data = $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        $single_data = EmployeeType::find($id);
        $data = $request->all();
        $single_data->update($data);
        return redirect()->route('employee_type.index')->with('success', "Data updated successfully");
    }

    public function destroy(string $id)
    {
        EmployeeType::find($id)->delete();
        return back()->with('delete', "Data delete successfully!");
    }

    public function show(string $id)
    {
        $employee_type = EmployeeType::find($id);
        return view('payroll.employee_type.show');
    }
}
