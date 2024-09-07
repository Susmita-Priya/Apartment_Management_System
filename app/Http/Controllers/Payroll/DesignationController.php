<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use App\Models\Payroll\Designation;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    public function index()
    {
        $data['page_title'] =  'designaiton';
        $data['designaitons'] =  Designation::orderBy('id', 'desc')->get();
        return view('payroll.designaiton.index', $data);
    }

    public function create()
    {
        $data['page_title'] =  'designaiton';
        return view('payroll.designaiton.create_edit', $data);
    }

    public function store(Request $request)
    {
        // return $request;
        $data = $request->all();

        $validate_data = $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        Designation::create($data);
        return back()->with('success', "Data created successfully. ");
    }

    public function edit(string $id)
    {
        $data['page_title'] =  'designaiton';
        $data['designaiton'] = Designation::find($id);
        return view('payroll.designaiton.create_edit', $data);
    }

    public function update(Request $request, string $id)
    {
        $validate_data = $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        $single_data = Designation::find($id);
        $data = $request->all();
        $single_data->update($data);
        return redirect()->route('designaiton.index')->with('success', "Data updated successfully");
    }

    public function destroy(string $id)
    {
        Designation::find($id)->delete();
        return back()->with('delete', "Data delete successfully!");
    }

    public function show(string $id)
    {
        $designaiton = Designation::find($id);
        return view('payroll.designaiton.show');
    }
}
