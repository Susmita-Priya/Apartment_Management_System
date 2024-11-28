<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Models\Building;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BuildingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Fetch all buildings from the database

        // $data['search_property'] = $search_property = $request->search_property ?? '';

        // $data['buildings'] = Building::orderBy('id', 'asc')
        //     ->when($search_property != '', function ($query) use ($search_property) {
        //         $query->where('name', 'like', "%$search_property%");
        //     })
        //     ->get();
        // return $buildings;

        // Pass the buildings data to the view
        // return view('building.building_list', $data);


        $buildings = Building::where('company_id', Auth::user()->id)
            ->where('status', 1)
            ->latest()
            ->get();
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

        // dd($request->all());

        // Validate the request data
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'image' => 'nullable|image', 
        ]);

        // Handle the image upload if present
        if ($request->hasFile('image')) {
            $file = $request->file('image');

            // Check if the image size exceeds 100KB (102400 bytes)
            if ($file->getSize() > 102400) {
                return redirect()->back()->with('error', 'Image size exceeds 100KB. Please upload a smaller image.');
            }

            $filename = time() . "_building." . $file->getClientOriginalExtension();
            $path = 'uploads/buildings';
            $file->move(public_path($path), $filename); // Move to 'public/uploads/buildings' directly
            $fullPath = $path . '/' . $filename;
        } else {
            $fullPath = null;
        }

        // Generate the building ID
        $buildingType = $request->type; // 'RESB', 'COMB', 'RECB'
        $lastBuilding = Building::where('type', $buildingType)->orderBy('building_no', 'desc')->first();
        $newBuildingNo = $buildingType . str_pad(($lastBuilding ? intval(substr($lastBuilding->building_no, 4)) + 1 : 1), 4, '0', STR_PAD_LEFT);

        // Create a new Building entry using the detailed approach
        $building = new Building;
        $building->company_id = Auth::user()->id;
        $building->building_no = $newBuildingNo;
        $building->name = $request->name;
        $building->type = $buildingType;
        $building->image = $fullPath;
        $building->save();

        // Redirect with a success message
        return redirect()->route('building')->with('success', "New Building Created Successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $building = Building::findOrFail($id);

        $blocks = Block::where('building_id', $id)->latest()->get();

        if (is_null($building)) {
            return redirect()->route('building');
        } else {
            return view('building.building_view', compact('building', 'blocks'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $building = Building::find($id);
        if (is_null($building)) {
            return redirect()->route('building');
        } else {
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
            'type' => 'required',
            'image' => 'nullable|image', 
        ]);

        // Find the building to update
        $building = Building::findOrFail($id);

        // Handle the image upload if present
        if ($request->hasFile('image')) {
            $file = $request->file('image');

            // Check if the image size exceeds 100KB (102400 bytes)
            if ($file->getSize() > 102400) {
                return redirect()->back()->with('error', 'Image size exceeds 100KB. Please upload a smaller image.');
            }

            // Delete the old image if it exists
            if ($building->image && file_exists(public_path($building->image))) {
                unlink(public_path($building->image));
            }

            // Upload the new image
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
        return redirect()->route('building')->with('success', "Building Updated Successfully!");
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
        return redirect()->route('building')->with('delete', 'Delete Successful!');
    }
}
