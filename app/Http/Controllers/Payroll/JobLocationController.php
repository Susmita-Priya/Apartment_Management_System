<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use App\Models\Payroll\JobLocatin;
use Illuminate\Http\Request;

class JobLocationController extends Controller
{
    public function index()
    {
        $data['page_title'] =  'job location';
        $data['job_locations'] =  JobLocatin::orderBy('id', 'desc')->get();
        return view('payroll.job_location.index', $data);
    }

    public function create()
    {
        $data['page_title'] =  'job location';
        return view('payroll.job_location.create_edit', $data);
    }

    public function store(Request $request)
    {
        // return $request;
        $data = $request->all();

        $validate_data = $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        JobLocatin::create($data);
        return back()->with('success', "Data created successfully. ");
    }

    public function edit(string $id)
    {
        $data['page_title'] =  'job location';
        $data['job_location'] = JobLocatin::find($id);
        return view('payroll.job_location.create_edit', $data);
    }

    public function update(Request $request, string $id)
    {
        $validate_data = $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        $single_data = JobLocatin::find($id);
        $data = $request->all();
        $single_data->update($data);
        return redirect()->route('job_location.index')->with('success', "Data updated successfully");
    }

    public function destroy(string $id)
    {
        JobLocatin::find($id)->delete();
        return back()->with('delete', "Data delete successfully!");
    }

    public function show(string $id)
    {
        $job_location = JobLocatin::find($id);
        return view('payroll.job_location.show');
    }
}
