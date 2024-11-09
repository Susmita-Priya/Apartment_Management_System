<?php

namespace App\Http\Controllers;

use App\Models\Landlord;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LandlordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $landlords = Landlord::withCount('units')->get();
        return view('landlord.landlord_list', compact('landlords'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('landlord.landlord_add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required',
            'email' => 'required|email|max:255',
            'nid' => 'required|string|max:20',
            'tax_id' => 'required|string|max:20',
            'dob' => 'required|date',
            'marital_status' => 'required|string|max:50',
            'per_address' => 'required|string|max:255',
            'occupation' => 'required|string|max:100',
            'religion' => 'required|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'passport' => 'nullable|string|max:20',
            'driving_license' => 'nullable|string|max:20',
            'company' => 'nullable|string|max:100',
            'qualification' => 'nullable|string|max:100',
            'password' => 'required|min:4', // Add password validation
        ]);
        $landlord = new Landlord($request->all());

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = time().'_landlord.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/landlord'), $imageName);
            $landlord->image = 'uploads/landlord/'.$imageName;
        }

        $landlord->save();

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password')); // Use the provided password
        $userRole = Role::where('name', 'Landlord')->first();  
        $user->role_id = $userRole->id; // Store the role_id from the role table where name is 'user'
        $user->save();

        return redirect()->back()->with('success', 'Landlord created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Landlord $landlord)
    {
        // return view('landlords.show', compact('landlord'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $landlord = Landlord::find($id);
        return view('landlord.landlord_edit', compact('landlord'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required',
            'email' => 'required|email|max:255',
            'nid' => 'required|string|max:20',
            'tax_id' => 'required|string|max:20',
            'dob' => 'required|date',
            'marital_status' => 'required|string|max:50',
            'per_address' => 'required|string|max:255',
            'occupation' => 'required|string|max:100',
            'religion' => 'required|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'passport' => 'nullable|string|max:20',
            'driving_license' => 'nullable|string|max:20',
            'company' => 'nullable|string|max:100',
            'qualification' => 'nullable|string|max:100',
            'password' => 'nullable', // Add password validation
        ]);

        $landlord = Landlord::find($id);
        $landlord->fill($request->all());

        if ($request->hasfile('image')) {
            $file = $request->file('image');

            // Delete the old image if it exists
            if ($landlord->image && file_exists(public_path($landlord->image))) {
                unlink(public_path($landlord->image));
            }

            $filename = time() . '_landlord.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/landlord'), $filename);
            $fullPath = 'uploads/landlord/' . $filename;
        } else {
            // Keep the old image if no new image is uploaded
            $fullPath = $landlord->image;
        }

        $landlord->image = $fullPath;
        $landlord->save();

        // Update the corresponding user
        $user = User::where('email', $landlord->email)->first();
        if ($user) {
            $user->name = $request->input('name');
            $user->email = $request->input('email');
             // Update password if provided, otherwise keep the existing one
        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }
            $user->save();
        }

        return redirect()->back()->with('success', 'Landlord updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $landlord = Landlord::find($id);

        if ($landlord->image && file_exists(public_path($landlord->image))) {
            unlink(public_path($landlord->image));
        }

        // Delete the corresponding user
        $user = User::where('email', $landlord->email)->first();
        if ($user) {
            $user->delete();
        }

        $landlord->delete();
        return back()->with('success', 'Landlord deleted successfully');
        
    }
}
