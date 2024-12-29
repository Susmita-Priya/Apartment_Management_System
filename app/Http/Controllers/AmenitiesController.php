<?php

namespace App\Http\Controllers;

use App\Models\Amenities;
use Illuminate\Http\Request;

class AmenitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $amenities = Amenities::all();
        return view('amenities.amenities_list', compact('amenities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('amenities.amenities_add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'nullable', 
        ]);

        // Handle the image upload if present
        if ($request->hasFile('image')) {
            $file = $request->file('image');

            // Check if the image size exceeds 100KB (102400 bytes)
            if ($file->getSize() > 102400) {
                return redirect()->back()->with('error', 'Image size exceeds 100KB. Please upload a smaller image.');
            }

            $filename = time() . "_amenity." . $file->getClientOriginalExtension();
            $path = 'uploads/amenities';
            $file->move(public_path($path), $filename); // Move to 'public/uploads/buildings' directly
            $fullPath = $path . '/' . $filename;
        } else {
            $fullPath = null;
        }

        // Create the amenity
        $amenities = new Amenities;
        $amenities->name = $request->name;
        $amenities->description = $request->description;
        $amenities->image = $fullPath;
        $amenities->save();

        return redirect()->back()
            ->with('success', 'Asset created successfully.');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(amenities $amenities)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $amenities = Amenities::find($id);
        if ($amenities == null) {
            return redirect()->back()
                ->with('error', 'Asset not found.');
        }
        return view('amenities.amenities_edit', compact('amenities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $amenities = Amenities::find($id);
        if ($amenities == null) {
            return redirect()->back()
                ->with('error', 'Asset not found.');
        }

        $request->validate([
            'name' => 'required',
        ]);

        // Handle the image upload if present
        if ($request->hasFile('image')) {
            $file = $request->file('image');

            // Check if the image size exceeds 100KB (102400 bytes)
            if ($file->getSize() > 102400) {
                return redirect()->back()->with('error', 'Image size exceeds 100KB. Please upload a smaller image.');
            }

            $filename = time() . "_amenity." . $file->getClientOriginalExtension();
            $path = 'uploads/amenities';
            $file->move(public_path($path), $filename); // Move to 'public/uploads/buildings' directly
            $fullPath = $path . '/' . $filename;
        } else {
            $fullPath = $amenities->image;
        }

        $amenities->name = $request->name;
        $amenities->description = $request->description;
        $amenities->image = $fullPath;
        $amenities->status = $request->status;
        $amenities->save();

        return redirect()->back()
            ->with('success', 'Asset updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $amenities = Amenities::find($id);
        if ($amenities == null) {
            return redirect()->back()
                ->with('error', 'Asset not found.');
        }

        if ($amenities->image && file_exists(public_path($amenities->image))) {
            unlink(public_path($amenities->image));
        }

        $amenities->delete();

        return redirect()->back()
            ->with('success', 'Asset deleted successfully.');
    }
}
