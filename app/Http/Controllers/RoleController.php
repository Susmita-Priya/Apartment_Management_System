<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\Role_Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles =  Role :: all();

        return view('role.role_list',
        ['roles' => $roles]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $permissions = Permission::select('name', 'slug', 'groupby')
        // ->groupBy('groupby')
        // ->get();

        $permissions = Permission::all()->groupBy('groupby');

        return view('role.role_add', [
            'permissions' => $permissions,
        ]);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required', 
            ]
        );

        $role = new Role;
        $role -> name = $request['name'];
        $role -> save();

        // Attach permissions to the role
    if ($request->has('permissions')) {
        $role->permissions()->attach($request->input('permissions'));
    }

    // Redirect back with success message
    return redirect('role')->with('success', 'New Role Created and Permissions Assigned!');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $role = Role::find($id);
        //  if(is_null($role)){
        //     return redirect('/role');
        //  }else{
        //     $data = compact('role');
        //     return view('role.role_view')->with($data);
        //  }

        // Retrieve the role with its associated permissions by ID
    $role = Role::with('permissions')->findOrFail($id);
    
    // Pass the role data to the view
    return view('role.role_view', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = Role::find($id);
    if (is_null($role)) {
        return redirect('/role');
    }

    $permissions = Permission::all()->groupBy('groupby'); // Retrieve and group permissions by 'groupby'

    return view('role.role_edit', [
        'role' => $role,
        'permissions' => $permissions,
    ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'name' => 'required'
            ]
        );

        $role = Role::find($id);
    if (is_null($role)) {
        return redirect('/role');
    }

    $role->name = $request['name'];
    $role->save();

    // Sync permissions with the role
    $role->permissions()->sync($request->input('permissions', []));

    return redirect('role')->with('update', "Role has been updated!");

        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::find($id);
    if (!is_null($role)) {
        // Detach all permissions associated with the role
        $role->permissions()->detach();

        // Now delete the role
        $role->delete();
        
        // If the role has an associated iddoc, delete the file
        if ($role->iddoc && file_exists(public_path($role->iddoc))) {
            unlink(public_path($role->iddoc));
        }
    }

    return redirect('role')->with('delete', "Delete Successful!");
    }
}
