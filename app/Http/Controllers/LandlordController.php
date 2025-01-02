<?php

namespace App\Http\Controllers;

use App\Models\Landlord;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        $companies = User::role('Company')->get();
        return view('landlord.landlord_add', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:landlords',
            'phone' => 'required',
            'address' => 'string|max:255',
            'nid' => 'required|string|max:20',
            'tread_licence' => 'required|string|max:20',
            'password' => 'required|string|min:4',
        ]);
        $landlord = new Landlord($request->all());
        $landlord->password = Hash::make($request->input('password'));
        $landlord->save();

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');
        $user->tread_licence = $request->input('tread_licence');
        $user->parent_id = $request->input('company_id');
        $user->password = Hash::make($request->input('password'));

        Role::updateOrCreate(['name' => 'Landlord']);
        $user->assignRole('Landlord');
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
        $companies = User::role('Company')->get();
        return view('landlord.landlord_edit', compact('landlord', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required',
            'address' => 'string|max:255',
            'nid' => 'required|string|max:20',
            'tread_licence' => 'required|string|max:20',
        ]);

        $landlord = Landlord::find($id);
        $landlord->update([
            'company_id' => $request->input('company_id'),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'nid' => $request->input('nid'),
            'tread_licence' => $request->input('tread_licence'),
        ]);

        if ($request->filled('password')) {
            $landlord->password = Hash::make($request->input('password')); 
            $landlord->save();
        }

        // Update the corresponding user
        $user = User::where('email', $landlord->email)->first();
        if ($user) {
            $user->parent_id = $request->input('company_id');
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            $user->address = $request->input('address');
            $user->tread_licence = $request->input('tread_licence');

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

        // Delete the corresponding user
        $user = User::where('email', $landlord->email)->first();
        if ($user) {
            $user->delete();
        }

        $landlord->delete();
        return back()->with('success', 'Landlord deleted successfully');
    }
}
