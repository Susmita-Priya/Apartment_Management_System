<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{
    public function create_edit()
    {
        $data['page_title'] =  'setting';
        $data['setting'] =  Setting::first();
        return view('setting.create_edit', $data);
    }

    public function store(Request $request)
    {
        // return $request;
        
        $data = $request->all();

        $filename = '';
        if ($request->hasfile('company_logo')) {
            $file = $request->file('company_logo');
            $filename = date('Ymdmhs') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('setting/company_logo/'), $filename);
        }
        $data['company_logo'] = $filename;
        Setting::create($data);
        return back()->with('success', "Data created successfully. ");
    }

    public function update(Request $request, string $id)
    {
        $setting = Setting::find($id);
        $data = $request->all();
        $filename = $request->company_logo ?? '';
        if ($request->hasfile('company_logo')) {
            File::delete(public_path('/setting/company_logo/' . $setting->company_logo));
            $file = $request->file('company_logo');
            $filename = date('Ymdmhs') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('setting/company_logo/'), $filename);
        }
        $data['company_logo'] = $filename;

        $setting->update($data);
        return redirect()->back()->with('success', "Data updated successfully");
    }
}
