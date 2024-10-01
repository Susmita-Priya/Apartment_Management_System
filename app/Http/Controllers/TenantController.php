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
        $tenants = Tenant::all();
        return view('tenant.tenant_list', compact('tenants'));
    }

    public function create()
    {
        return view('tenant.tenant_add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:1024', // Validate image file
            'name' => 'required',
            'father' => 'required',
            'mother' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'nid' => 'required|unique:tenants,nid',
            'tax_id' => 'required',
            'dob' => 'required|date',
            'marital_status' => 'required',
            'per_address' => 'required',
            'occupation' => 'required',
            'religion' => 'required',
            'new_house_start_date' => 'nullable|date',
        ]);

        $data = $request->all();

        // Handle family members
        $familyMembersDetails = [];
        $familyMembers = $request->input('family_members', []);

        foreach ($familyMembers as $member) {
            $familyMembersDetails[] = [
                'name' => $member['name'],
                'age' => $member['age'],
                'occupation' => $member['occupation'],
                'phone' => $member['phone'],
            ];
        }

        $tenant = new Tenant();
        $tenant->fill($data);

        // Store the family members' details as JSON
        $tenant->family_members = count($familyMembers); // Total count of family members
        $tenant->family_members_details = json_encode($familyMembersDetails);

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $filename = time() . '_tenant.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/tenant'), $filename);
            $tenant->image = 'uploads/tenant/' . $filename;
        }

        $tenant->save();
        return back()->with('success', 'Tenant added successfully');
    }

    public function show($id)
    {
        // $tenant = Tenant::find($id);
        // return view('tenant.tenant_view', compact('tenant'));
    }

    public function edit($id)
    {
        $tenant = Tenant::find($id);

        $familyMembersDetails = json_decode($tenant->family_members_details, true);
        return view('tenant.tenant_edit', compact('tenant', 'familyMembersDetails'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:1024', // Validate image file
            'name' => 'required',
            'father' => 'required',
            'mother' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'nid' => 'required|unique:tenants,nid,' . $id,
            'tax_id' => 'required',
            'dob' => 'required|date',
            'marital_status' => 'required',
            'per_address' => 'required',
            'occupation' => 'required',
            'religion' => 'required',
            'new_house_start_date' => 'nullable|date',
        ]);

        $data = $request->all();

        // Handle family members
        $familyMembersDetails = [];
        $familyMembers = $request->input('family_members', []);

        foreach ($familyMembers as $member) {
            $familyMembersDetails[] = [
                'name' => $member['name'],
                'age' => $member['age'],
                'occupation' => $member['occupation'],
                'phone' => $member['phone'],
            ];
        }

        $tenant = Tenant::find($id);
        $tenant->fill($data);

        // Store the family members' details as JSON
        $tenant->family_members = count($familyMembers); // Total count of family members
        $tenant->family_members_details = json_encode($familyMembersDetails);

        
        if ($request->hasfile('image')) {
            $file = $request->file('image');

             // Delete the old image if it exists
             if ($tenant->image && file_exists(public_path($tenant->image))) {
                unlink(public_path($tenant->image));
            }


            $filename = time() . '_tenant.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/tenant'), $filename);

            // // Delete the old image file
            // if (File::exists(public_path($tenant->image))) {
            //     File::delete(public_path($tenant->image));
            // }

            $fullPath = 'uploads/tenant/' . $filename;
        }else {
            // Keep the old image if no new image is uploaded
            $fullPath = $tenant->image;
        }

        $tenant->image = $fullPath;
        $tenant->save();
        return back()->with('success', 'Tenant updated successfully');
    }

    public function destroy($request,$id)
    {
        $tenant = Tenant::find($id);

        if ($request->hasfile('image')) {
             // Delete the old image if it exists
             if ($tenant->image && file_exists(public_path($tenant->image))) {
                unlink(public_path($tenant->image));
            }
        }

        $tenant->delete();
        return back()->with('success', 'Tenant deleted successfully');
    }
}
