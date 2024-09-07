<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use App\Models\Payroll\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $data['page_title'] =  'department';
        $data['departments'] =  Department::orderBy('id', 'desc')->get();
        return view('payroll.department.index', $data);
    }

    public function create()
    {
        $data['page_title'] =  'department';
        return view('payroll.department.create_edit', $data);
    }

    public function store(Request $request)
    {
        // return $request;
        $data = $request->all();

        $validate_data = $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        Department::create($data);
        return back()->with('success', "Data created successfully. ");
    }

    public function edit(string $id)
    {
        $data['page_title'] =  'department';
        $data['department'] = Department::find($id);
        return view('payroll.department.create_edit', $data);
    }

    public function update(Request $request, string $id)
    {
        $validate_data = $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        $single_data = Department::find($id);
        $data = $request->all();
        $single_data->update($data);
        return redirect()->route('department.index')->with('success', "Data updated successfully");
    }

    public function destroy(string $id)
    {
        Department::find($id)->delete();
        return back()->with('delete', "Data delete successfully!");
    }

    public function show(string $id)
    {
        $department = Department::find($id);
        return view('payroll.department.show');
    }
}
