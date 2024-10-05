<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;


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
            'email' => 'required|email|unique:users,email',
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

        $randomPassword = Str::random(10); // Generate a random 10-character password
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($randomPassword); // Set the random password
        $userRole = Role::where('name', 'User')->first();  
        $user->role_id = $userRole->id; // Store the role_id from the role table where name is 'user'
        $user->save();

        return back()->with('success', 'Tenant added successfully. </br> User password: <strong style="color: blue;">' . $randomPassword . '</strong>');
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
            'email' => 'required|email|unique:users,email,' . $id,
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
            $fullPath = 'uploads/tenant/' . $filename;
        } else {
            // Keep the old image if no new image is uploaded
            $fullPath = $tenant->image;
        }

        $tenant->image = $fullPath;
        $tenant->save();

        // Update the corresponding user
        $user = User::where('email', $tenant->email)->first();
        if ($user) {
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->save();
        }

        return back()->with('success', 'Tenant updated successfully');
    }

    public function destroy($id)
    {
        $tenant = Tenant::find($id);

        if ($tenant->image && file_exists(public_path($tenant->image))) {
            unlink(public_path($tenant->image));
        }

        // Delete the corresponding user
        $user = User::where('email', $tenant->email)->first();
        if ($user) {
            $user->delete();
        }

        $tenant->delete();
        return back()->with('success', 'Tenant deleted successfully');
    }
}
