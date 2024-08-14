<?php

namespace App\Http\Controllers;


use App\Models\Users;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users =  Users :: all();

        return view('user.user_list',
        ['users' => $users]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.user_add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'fullname' => 'required', 
                'email' => 'required',
                'phn' => 'required',
                'idno' => 'required',
                'address' => 'required'
            ]
        );

        if ($request->has('iddoc')) {
            $file = $request->file('iddoc');
            $filename = time() . "user." . $file->getClientOriginalExtension();
            $path = 'uploads'; 
            $file->move(public_path($path), $filename); // Move to 'public/uploads' directly
            $fullPath = $path . '/' . $filename; 
        } else {
            $fullPath = null; 
        }

        $user = new Users;
        $user -> fullname = $request['fullname'];
        $user -> email = $request['email'];
        $user -> phn = $request['phn'];
        $user -> idno = $request['idno'];
        $user -> iddoc = $fullPath;
        $user -> address = $request['address'];
        $user -> occ_status = $request['occ_status'];
        $user -> occ_place = $request['occ_place'];
        $user -> emname = $request['emname'];
        $user -> emphn = $request['emphn'];
        $user -> save();

        // return back()-> with('success',"Registration successfull ! ");
        return redirect('user')->with('success',"New User Been Created ! ");
    }

    /**
     * Display the specified resource.
     */
    public function show(Users $users)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = Users::find($id);
         if(is_null($user)){
            return redirect('/user');
         }else{
            $data = compact('user');
            return view('user.user_edit')->with($data);
         }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'fullname' => 'required', 
                'email' => 'required',
                'phn' => 'required',
                'idno' => 'required',
                'address' => 'required'
            ]
        );

        $user = Users::find($id);

        if ($request->hasFile('iddoc')) {
            $file = $request->file('iddoc');
            $filename = time() . "user." . $file->getClientOriginalExtension();
            $path = 'uploads';
            $file->move(public_path($path), $filename);
            $fullPath = $path . '/' . $filename;
    
            // If a new image is uploaded, delete the old one
            if ($user->iddoc && file_exists(public_path($user->iddoc))) {
                unlink(public_path($user->iddoc));
            }

            $user->iddoc = $fullPath; // Update with new image path
        }

        $user -> fullname = $request['fullname'];
        $user -> email = $request['email'];
        $user -> phn = $request['phn'];
        $user -> idno = $request['idno'];
        $user -> address = $request['address'];
        $user -> occ_status = $request['occ_status'];
        $user -> occ_place = $request['occ_place'];
        $user -> emname = $request['emname'];
        $user -> emphn = $request['emphn'];
        $user -> save();

        // return back()-> with('success',"Registration successfull ! ");
        return redirect('user')->with('update',"User details have been updated ! ");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Users::find($id);
        if(!is_null($user)){
            $user->delete();
            if ($user->iddoc && file_exists(public_path($user->iddoc))) {
                unlink(public_path($user->iddoc));
            }
        }
            
        return redirect('user')->with('delete',"Delete Successfull ! ");
    }
    
}
