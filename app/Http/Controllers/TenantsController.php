<?php

namespace App\Http\Controllers;


use App\Models\Tenants;
use Illuminate\Http\Request;

class TenantsController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    //  public function alert(Request $request)
    //  {
 
    //      // return back()-> with('success',"Registration successfull ! ");
    //      return view('sweetalert')->with('message',"New User Been Created ! ");
    //  }

    public function index()
    {
        $tenants =  Tenants :: all();

        return view('tenants.tenants_list',
        ['tenants' => $tenants]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tenants.tenants_add');
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
            $filename = time() . "tenants." . $file->getClientOriginalExtension();
            $path = 'uploads'; 
            $file->move(public_path($path), $filename); // Move to 'public/uploads' directly
            $fullPath = $path . '/' . $filename; 
        } else {
            $fullPath = null; 
        }

        $tenants = new Tenants;
        $tenants -> fullname = $request['fullname'];
        $tenants -> email = $request['email'];
        $tenants -> phn = $request['phn'];
        $tenants -> idno = $request['idno'];
        $tenants -> iddoc = $fullPath;
        $tenants -> address = $request['address'];
        $tenants -> occ_status = $request['occ_status'];
        $tenants -> occ_place = $request['occ_place'];
        $tenants -> emname = $request['emname'];
        $tenants -> emphn = $request['emphn'];
        $tenants -> save();

        // return back()-> with('success',"Registration successfull ! ");
        return redirect('tenants')->with('success',"New Tenants Been Created ! ");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tenants = Tenants::find($id);
         if(is_null($tenants)){
            return redirect('/tenants');
         }else{
            $data = compact('tenants');
            return view('tenants.tenants_view')->with($data);
         }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tenants = Tenants::find($id);
         if(is_null($tenants)){
            return redirect('/tenants');
         }else{
            $data = compact('tenants');
            return view('tenants.tenants_edit')->with($data);
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

        $tenants = Tenants::find($id);

        if ($request->hasFile('iddoc')) {
            $file = $request->file('iddoc');
            $filename = time() . "tenants." . $file->getClientOriginalExtension();
            $path = 'uploads';
            $file->move(public_path($path), $filename);
            $fullPath = $path . '/' . $filename;
    
            // If a new image is uploaded, delete the old one
            if ($tenants->iddoc && file_exists(public_path($tenants->iddoc))) {
                unlink(public_path($tenants->iddoc));
            }

            $tenants->iddoc = $fullPath; // Update with new image path
        }

        $tenants -> fullname = $request['fullname'];
        $tenants -> email = $request['email'];
        $tenants -> phn = $request['phn'];
        $tenants -> idno = $request['idno'];
        $tenants -> address = $request['address'];
        $tenants -> occ_status = $request['occ_status'];
        $tenants -> occ_place = $request['occ_place'];
        $tenants -> emname = $request['emname'];
        $tenants -> emphn = $request['emphn'];
        $tenants -> save();

        // return back()-> with('success',"Registration successfull ! ");
        return redirect('tenants')->with('update',"Tenants details have been updated ! ");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tenants = Tenants::find($id);
        if(!is_null($tenants)){
            $tenants->delete();
            if ($tenants->iddoc && file_exists(public_path($tenants->iddoc))) {
                unlink(public_path($tenants->iddoc));
            }
        }
            
        return redirect('tenants')->with('delete',"Delete Successfull ! ");
    }
    
}
