<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use App\Models\Payroll\Department;
use App\Models\Payroll\Designation;
use App\Models\Payroll\Employee;
use App\Models\Payroll\EmployeeSalary;
use App\Models\Payroll\EmployeeType;
use App\Models\Payroll\JobLocatin;
use App\Models\Payroll\SalaryHead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class EmployeeController extends Controller
{
    public function index()
    {
        $data['page_title'] =  'employee';
        $data['employees'] =  Employee::orderBy('id', 'desc')
            ->with('designation')
            ->get();
        // return $data['employees'];

        return view('payroll.employee.index', $data);
    }

    public function create()
    {
        // return date('l');
        $data['page_title'] =  'employee';

        $latest_data = Employee::orderByDesc('id')->first();
        if (!empty($latest_data)) {
            $number = ($latest_data->id) + 1;
        } else {
            $number =  1;
        }
        $data['employee_code'] =  'EMP00' . $number;


        $data['departments'] =  Department::orderBy('id', 'desc')->where('status', 1)->get();
        $data['designaitons'] =  Designation::orderBy('id', 'desc')->where('status', 1)->get();
        $data['employee_types'] =  EmployeeType::orderBy('id', 'desc')->where('status', 1)->get();
        $data['job_locations'] =  JobLocatin::orderBy('id', 'desc')->where('status', 1)->get();

        $data['salary_heads'] =  SalaryHead::orderBy('id', 'asc')
            ->where([
                'status' => 1,
                // 'head_type' => 1,
                'emp_create_status' => 1
            ])
            ->get();

        return view('payroll.employee.create_edit', $data);
    }

    public function store(Request $request)
    {
        // return $request;

        $validate_data = $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        $filename = '';
        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $filename = date('Ymdmhs') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/employee/image'), $filename);
        }

        $data = $request->all();
        $data['image'] = $filename;

        $employee = Employee::create($data);

        if (!empty($request->amount)) {
            foreach ($request->salary_head_id as $key => $salary_head_id) {
                EmployeeSalary::create([
                    'employee_id' => $employee->id,
                    'salary_head_id' => $salary_head_id,
                    'amount' => $request->amount[$key] ?? null,
                ]);
            }
        }
        return back()->with('success', "Data created successfully. ");
    }

    public function edit(string $id)
    {
        $data['page_title'] =  'employee';
        $data['employee'] = Employee::find($id);
        $data['departments'] =  Department::orderBy('id', 'desc')->where('status', 1)->get();
        $data['designaitons'] =  Designation::orderBy('id', 'desc')->where('status', 1)->get();
        $data['employee_types'] =  EmployeeType::orderBy('id', 'desc')->where('status', 1)->get();
        $data['job_locations'] =  JobLocatin::orderBy('id', 'desc')->where('status', 1)->get();

        $data['salary_heads'] =  SalaryHead::orderBy('id', 'asc')->where([
            'status' => 1,
            // 'head_type' => 1,
            'emp_create_status' => 1
        ])->get();

        return view('payroll.employee.create_edit', $data);
    }

    public function update(Request $request, string $id)
    {
        $validate_data = $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        $employee = Employee::find($id);
        $data = $request->all();

        $filename = $request->image ?? '';

        if ($request->hasfile('image')) {
            File::delete(public_path('/uploads/employee/image/' . $employee->image));
            $file = $request->file('image');
            $filename = date('Ymdmhs') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/employee/image'), $filename);
        }
        $data['image'] = $filename;
        $employee->update($data);

        EmployeeSalary::where('employee_id', $employee->id)->delete();
        if (!empty($request->amount)) {
            foreach ($request->salary_head_id as $key => $salary_head_id) {
                EmployeeSalary::create([
                    'employee_id' => $employee->id,
                    'salary_head_id' => $salary_head_id,
                    'amount' => $request->amount[$key] ?? null,
                ]);
            }
        }


        return redirect()->route('employee.index')->with('success', "Data updated successfully");
    }

    public function destroy(string $id)
    {
        $employee = Employee::find($id);
        File::delete(public_path('/uploads/employee/image/' . $employee->image));
        $employee->delete();
        EmployeeSalary::where('employee_id', $id)->delete();
        return back()->with('delete', "Data delete successfully!");
    }

    public function show(string $id)
    {
        $data['employee'] = Employee::find($id);
        $data['page_title'] =  'Employee Information';
        $data['salary_heads'] =  SalaryHead::orderBy('id', 'asc')->where(['status' => 1, 'head_type' => 1, 'emp_create_status' => 1])->get();
        return view('payroll.employee.show', $data);
    }
}
