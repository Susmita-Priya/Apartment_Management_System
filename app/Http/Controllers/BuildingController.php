<?php

namespace App\Http\Controllers;

use App\Models\Building;
use Illuminate\Http\Request;

class BuildingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         // Fetch all buildings from the database
    $buildings = Building::all();

    // Fetch all buildings with their associated blocks from the database
    // $buildings = Building::withCount('blocks')->get();

    // Pass the buildings data to the view
    return view('building.building_list', compact('buildings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('building.building_add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
     
    // Validate the request data
    $request->validate([
        'name' => 'required',
        'type' => 'required',
        // 'property_id' => 'required|exists:properties,id',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
    ]);

    // Handle the image upload if present
    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $filename = time() . "_building." . $file->getClientOriginalExtension();
        $path = 'uploads/buildings'; 
        $file->move(public_path($path), $filename); // Move to 'public/uploads/buildings' directly
        $fullPath = $path . '/' . $filename; 
    } else {
        $fullPath = null; 
    }

    // Generate the building ID
    $buildingType = $request->type; // 'RESB', 'COMB', 'RECB'
    $lastBuilding = Building::where('type', $buildingType)->orderBy('building_id', 'desc')->first();
    $newBuildingId = $buildingType . str_pad(($lastBuilding ? intval(substr($lastBuilding->building_id, 4)) + 1 : 1), 4, '0', STR_PAD_LEFT);

    // Create a new Building entry using the detailed approach
    $building = new Building;
    $building->building_id = $newBuildingId;
    $building->name = $request->name;
    $building->type = $buildingType;
    $building->image = $fullPath;
    $building->save();

    // Redirect with a success message
    return redirect('building')->with('success', "New Building Created Successfully!");

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $building = Building::withCount('blocks')->findOrFail($id);

        // $building = Building::with('blocks')->find($id);
    
        if (is_null($building)) {
            return redirect('/building');
        } else {
            return view('building.building_view', compact('building'));
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $building = Building::find($id);
         if(is_null($building)){
            return redirect('/building');
         }else{
            $data = compact('building');
            return view('building.building_edit')->with($data);
         }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request data
    $request->validate([
        'name' => 'required',
        'type' => 'required|in:RESB,COMB,RECB',
        // 'property_id' => 'required|exists:properties,id',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
    ]);

    // Find the building to update
    $building = Building::findOrFail($id);

    // Handle the image upload if present
    if ($request->hasFile('image')) {
        // Delete the old image if it exists
        if ($building->image && file_exists(public_path($building->image))) {
            unlink(public_path($building->image));
        }

        // Upload the new image
        $file = $request->file('image');
        $filename = time() . "_building." . $file->getClientOriginalExtension();
        $path = 'uploads/buildings';
        $file->move(public_path($path), $filename);
        $fullPath = $path . '/' . $filename;
    } else {
        // Keep the old image if no new image is uploaded
        $fullPath = $building->image;
    }

    // Update the building record
    $building->name = $request->name;
    $building->type = $request->type;
    $building->image = $fullPath;
    $building->save();

    // Redirect with a success message
    return redirect('building')->with('success', "Building Updated Successfully!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the building by its ID
    $building = Building::find($id);

    if (!is_null($building)) {
        // Delete the building record
        $building->delete();

        // Check if the image file exists and delete it
        if ($building->image && file_exists(public_path($building->image))) {
            unlink(public_path($building->image));
        }
    }

    // Redirect with a success message
    return redirect('building')->with('delete', 'Delete Successful!');
    }
}
