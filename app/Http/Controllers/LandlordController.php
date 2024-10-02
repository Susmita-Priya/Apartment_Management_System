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
        $landlords = Landlord::all();
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
            'phone' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'nid' => 'required|string|max:20',
            'tax_id' => 'required|string|max:20',
            'dob' => 'required|date',
            'marital_status' => 'required|string|max:50',
            'per_address' => 'required|string|max:255',
            'occupation' => 'required|string|max:100',
            'religion' => 'required|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'passport' => 'nullable|string|max:20',
            'driving_license' => 'nullable|string|max:20',
            'company' => 'nullable|string|max:100',
            'qualification' => 'nullable|string|max:100',
        ]);

        $landlord = new Landlord($request->all());

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = time().'_landlord.'.$file->extension();
            $request->image->move(public_path('uploads/landlord'), $imageName);
            $landlord->image = 'uploads/landlord'.$imageName;
        }

        $landlord->save();

        $randomPassword = Str::random(10); // Generate a random 10-character password
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($randomPassword); // Set the random password
        $userRole = Role::where('name', 'lanlord')->first();  
        $user->role_id = $userRole->id; // Store the role_id from the role table where name is 'user'
        $user->save();

        return redirect()->route('landlord.index')->with('success', 'Landlord created successfully. </br> User password: <strong style="color: blue;">' . $randomPassword . '</strong>');
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
    public function edit(Landlord $landlord)
    {
        // return view('landlords.edit', compact('landlord'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Landlord $landlord)
    {
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'phone' => 'required|string|max:15',
        //     'email' => 'required|email|max:255',
        //     'nid' => 'required|string|max:20',
        //     'tax_id' => 'required|string|max:20',
        //     'dob' => 'required|date',
        //     'marital_status' => 'required|string|max:50',
        //     'per_address' => 'required|string|max:255',
        //     'occupation' => 'required|string|max:100',
        //     'religion' => 'required|string|max:50',
        //     'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        //     'passport' => 'nullable|string|max:20',
        //     'driving_license' => 'nullable|string|max:20',
        //     'company' => 'nullable|string|max:100',
        //     'qualification' => 'nullable|string|max:100',
        // ]);

        // $landlord->fill($request->all());

        // if ($request->hasFile('image')) {
        //     $imageName = time().'.'.$request->image->extension();
        //     $request->image->move(public_path('images'), $imageName);
        //     $landlord->image = $imageName;
        // }

        // $landlord->save();

        // return redirect()->route('landlord.index')->with('success', 'Landlord updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Landlord $landlord)
    {
        // $landlord->delete();
        // return redirect()->route('landlord.index')->with('success', 'Landlord deleted successfully.');
    }
}
