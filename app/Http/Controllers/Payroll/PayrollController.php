<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use App\Models\Payroll\Employee;
use App\Models\Payroll\Payroll;
use App\Models\Payroll\PayrollDetail;
use App\Models\Payroll\SalaryHead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PayrollController extends Controller
{
    public function generate(Request $request)
    {
        // return $request;
        $data['page_title'] =  'payroll';
        $data['submited_year'] = $year = $request->year ?? '';
        $data['submited_month'] = $month =  $request->month ?? '';


        if (!empty($year) && !empty($month)) {
            $unique_check = Payroll::where([
                'year' => $year,
                'month' => $month,
            ])->first();

            $data['salary_heads'] =  SalaryHead::orderBy('id', 'asc')->where(['status' => 1])->get();

            if (!empty($unique_check)) {
                return back()->with('error', "Payroll already generated. ");
            } else {
                $data['employees'] =  Employee::orderBy('id', 'desc')
                    ->where('status', 1)
                    ->get();
            }
        }

        return view('payroll.payroll.generate_form', $data);
    }

    public function index()
    {
        $data['page_title'] =  'payroll';
        $data['payrolls'] =  Payroll::orderBy('id', 'desc')->get();
        return view('payroll.payroll.index', $data);
    }

    public function store(Request $request)
    {
        // return $request;

        $validate_data = $request->validate([
            'submited_year' => 'required',
            'submited_month' => 'required',
            'amount' => 'required',
        ]);

        $payroll = Payroll::create([
            'year' => $request->submited_year,
            'month' => $request->submited_month,
            'grand_total' => $request->grand_total,
            'generated_by' => (Auth::user()->id ?? 0),
        ]);

        if (!empty($request->employee_id)) {
            foreach ($request->employee_id as $key => $employee_id) {
                PayrollDetail::create([
                    'payroll_id' => $payroll->id,
                    'year' => $request->submited_year,
                    'month' => $request->submited_month,
                    'salary_head_id' => $request->salary_head_id[$key],
                    'employee_id' => $request->employee_id[$key],
                    'amount' => $request->amount[$key],
                ]);
            }
        }
        return redirect()->route('payroll.index')->with('success', "Data created successfully. ");
    }

    public function edit(string $id)
    {
        $data['page_title'] =  'payroll';
        $data['payroll'] = $payroll = Payroll::find($id);

        $data['submited_year'] = $payroll->year ?? '';
        $data['submited_month'] = $payroll->month ?? '';

        $payroll_details_emplyee_ids = PayrollDetail::where('payroll_id', $id)->pluck('employee_id');
        // return $payroll_details_emplyee_ids;

        $data['employees'] =  Employee::orderBy('id', 'desc')
            ->whereIn('id', $payroll_details_emplyee_ids)
            ->get();

        $data['salary_heads'] =  SalaryHead::orderBy('id', 'asc')->where(['status' => 1])->get();


        return view('payroll.payroll.edit', $data);
    }

    public function update(Request $request, string $id)
    {
        $validate_data = $request->validate([
            'submited_year' => 'required',
            'submited_month' => 'required',
            'amount' => 'required',
        ]);


        $payroll = Payroll::find($id);

        $payroll->update([
            'year' => $request->submited_year,
            'month' => $request->submited_month,
            'grand_total' => $request->grand_total,
            'generated_by' => (Auth::user()->id ?? 0),
        ]);

        PayrollDetail::where('payroll_id', $id)->delete();

        if (!empty($request->employee_id)) {
            foreach ($request->employee_id as $key => $employee_id) {
                PayrollDetail::create([
                    'payroll_id' => $payroll->id,
                    'year' => $request->submited_year,
                    'month' => $request->submited_month,
                    'salary_head_id' => $request->salary_head_id[$key],
                    'employee_id' => $request->employee_id[$key],
                    'amount' => $request->amount[$key],
                ]);
            }
        }

        return redirect()->route('payroll.index')->with('success', "Data updated successfully. ");
    }

    public function destroy(string $id)
    {
        Payroll::find($id)->delete();
        PayrollDetail::where('payroll_id', $id)->delete();
        return back()->with('delete', "Data delete successfully!");
    }

    public function show(string $id)
    {
        $data['page_title'] =  'payroll';
        $data['payroll'] = $payroll = Payroll::find($id);

        $data['submited_year'] = $payroll->year ?? '';
        $data['submited_month'] = $payroll->month ?? '';

        $payroll_details_emplyee_ids = PayrollDetail::where('payroll_id', $id)->pluck('employee_id');

        $data['employees'] =  Employee::orderBy('id', 'desc')
            ->whereIn('id', $payroll_details_emplyee_ids)
            ->get();

        $data['salary_heads'] =  SalaryHead::orderBy('id', 'asc')->where(['status' => 1])->get();


        return view('payroll.payroll.show', $data);
    }
}
