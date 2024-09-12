<?php

namespace App\Http\Controllers;


use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class TenantController extends Controller
{

    public function index()
    {
        // return 'index';
        $ll = Auth::user()->id;
        $ff = Auth::user()->user_level;

        $data['page_titile'] = 'Tenant';

        if ($ff == 1) {
            $data['renters'] = Tenant::where(['renter_status' => 1])->get();
        } else {
            $data['renters'] = Tenant::where(['landlord_id' => $ll, 'renter_status' => 1])->get();
        }
        return view('tenant.index', $data);
    }


    public function create()
    {
        return view('tenant.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'r_name' => 'required',
        ]);

        $data = $request->all();
        // return $data;

        $filename = '';
        if ($request->hasfile('r_image')) {
            $file = $request->file('r_image');
            $filename = date('Ymdmhs') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/tenant-images'), $filename);
        }

        $data['r_image'] = $filename;
        $data['landlord_id'] = Auth::user()->id;
        Tenant::create($data);
        return back()->with('success', 'Tenant added successfully');
    }

    public function show($id)
    {
        $data['tenant'] = Tenant::where(['r_id' => $id])->first();
        $data['page_title'] = "Tenant";
        // return $data['tenant'];
        
        return view('tenant.show', $data);
    }

    public function update(Request $request)
    {
        $request->validate([
            'r_name' => 'required',
        ]);

        $data = $request->all();
        // return $data;
        $renter = Tenant::find($request->r_id);

        $filename = $renter->r_image;
        if ($request->hasfile('r_image')) {
            File::delete(public_path('uploads/tenant/' . $renter->r_image));
            $file = $request->file('r_image');
            $filename = date('Ymdmhs') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/tenant'), $filename);
        }

        $data['r_image'] = $filename;
        $renter->update($data);
        return back()->with('success', 'Tenant information updated successfully');
    }

    public function makeActive($id)
    {
        $renter = Tenant::find($id);
        $renter->renter_status = 1;
        $renter->save();
        return back();
    }

    public function inActive($id)
    {
        $renter = Tenant::find($id);
        $renter->renter_status = 0;
        $renter->save();
        return back();
    }

    public function destroy($id)
    {
        $renter = Tenant::find($id);
        File::delete(public_path('uploads/tenant/' . $renter->r_image));
        $renter->delete();
        return back()->with('success', 'Tenant information deleted successfully');
    }
}
