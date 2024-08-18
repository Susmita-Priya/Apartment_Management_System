<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions =  Permission :: all();

        return view('permission.permission_list',
        ['permissions' => $permissions]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('permission.permission_add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required', 
                'slug' => 'required',
                'groupby' => 'required'
            ]
        );

        $permission= new permission;
        $permission -> name = $request['name'];
        $permission -> slug = $request['slug'];
        $permission -> groupby = $request['groupby'];
        $permission -> save();

        // return back()-> with('success',"Registration successfull ! ");
        return redirect('permission')->with('success',"New Permission Been Created ! ");
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $permission = Permission::find($id);
         if(is_null($permission)){
            return redirect('/permission');
         }else{
            $data = compact('permission');
            return view('permission.permission_edit')->with($data);
         }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'name' => 'required',
                'slug' => 'required',
                'groupby' => 'required'
            ]
        );

        $permission = Permission::find($id);

        $permission -> name = $request['name'];
        $permission -> slug = $request['slug'];
        $permission -> groupby = $request['groupby'];
        $permission -> save();

        // return back()-> with('success',"Registration successfull ! ");
        return redirect('permission')->with('update',"Permission have been updated ! ");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $permission = Permission::find($id);
        if(!is_null($permission)){
            $permission->delete();
            if ($permission->iddoc && file_exists(public_path($permission->iddoc))) {
                unlink(public_path($permission->iddoc));
            }
        }
            
        return redirect('permission')->with('delete',"Delete Successfull ! ");
    }
}
