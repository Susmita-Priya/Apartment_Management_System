<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->get();
        return view('user.user_list', ['users' => $users]);
    }

    public function create()
    {
        $roles = Role::all();
        return view('user.user_add', ['roles' => $roles]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role_id' => 'required|exists:roles,id',
        ]);
    
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password); // Hash the password
        $user->role_id = $request->role_id;
        $user->save();
    
        return redirect()->route('user.index')->with('success', 'User added successfully!');
    }

    public function show(string $id)
    {
        // Retrieve the user with their role and associated permissions by ID
        $user = User::with('role.permissions')->findOrFail($id);
    
        // Pass the user data to the view
        return view('user.user_view', compact('user'));
    }

    public function edit(string $id)
    {
        // Retrieve the user by their ID
        $user = User::findOrFail($id);
    
        // Retrieve all roles
        $roles = Role::all();
    
        // Pass the user and roles to the view
        return view('user.user_edit', ['user' => $user, 'roles' => $roles]);
    }
    

    public function update(Request $request, string $id)
    {
        // Validate the incoming request data
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
        'password' => 'nullable',
        'role_id' => 'required|exists:roles,id',
    ]);

    // Retrieve the user by the given ID
    $user = User::findOrFail($id);

    // Update the user's name and email
    $user->update($request->only(['name', 'email']));

    // Update the user's role
    $user->role_id = $request->input('role_id');

        // Check if the password field is filled, then hash and update it
    if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
    }
    
    $user->save();

    // Redirect back to the user index with a success message
    return redirect()->route('user.index')->with('success', 'User updated successfully!');

    }

    public function destroy(string $id)
    {
    // Retrieve the user by the given ID
    $user = User::findOrFail($id);

    // Delete the user
    $user->delete();

    // Redirect back to the user index with a success message
    return redirect()->route('user.index')->with('success', 'User deleted successfully!');
    }

}

