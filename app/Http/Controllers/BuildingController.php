<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Models\Building;
use App\Models\CommonArea;
use App\Models\Floor;
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

        if (Auth::user()->hasRole('Tenant')) {
            $buildings = Building::where('status', 1)
                ->latest()
                ->get();
        } else {
        $buildings = Building::where('company_id', Auth::user()->id)
            ->where('status', 1)
            ->latest()
            ->get();
        }
        return view('building.building_list', compact('buildings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $commonAreas = CommonArea::all();
        return view('building.building_add', compact('commonAreas'));
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
            'total_upper_floors' => 'required|integer',
            'total_underground_floors' => 'required|integer',

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
        $building->total_upper_floors = $request->total_upper_floors;
        $building->total_underground_floors = $request->total_underground_floors;
        $building->common_area = json_encode($request->common_area_id);
        $building->note = $request->note;
        $building->save();

        // Redirect with a success message
        return redirect()->route('building')->with('success', "New Building Request Send Successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $building = Building::findOrFail($id);

        $floors = Floor::where('building_id', $id)->orderBy('floor_no', 'asc')->get();

        $commonAreas = CommonArea::all();

        if (is_null($building)) {
            return redirect()->route('building');
        } else {
            return view('building.building_view', compact('building', 'floors', 'commonAreas'));
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
            $commonAreas = CommonArea::all();
            $selectCommonArea = json_decode($building->common_area, true) ?? [];
            $data = compact('building', 'selectCommonArea', 'commonAreas');
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
            'total_upper_floors' => 'required|integer',
            'total_underground_floors' => 'required|integer',
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
        $building->total_upper_floors = $request->total_upper_floors;
        $building->total_underground_floors = $request->total_underground_floors;
        $building->common_area = json_encode($request->common_area_id);
        $building->note = $request->note;
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


    public function pending()
    {
        $buildings = Building::where('company_id', Auth::user()->id)
            ->where('status', 0)
            ->latest()
            ->get();
        return view('building.building_request_list', compact('buildings'));
    }

    public function approve(string $id)
    {
        $building = Building::find($id);
        if (!is_null($building)) {
            $building->status = 1;
            $building->save();
        }
        return redirect()->route('building.pending')->with('success', 'Building Approved Successfully!');
    }

    public function reject(string $id, Request $request)
    {

        // dd($request->all());
        $building = Building::find($id);
        if (!is_null($building)) {
            $building->status = 2;
            $building->note = $request->note;
            $building->save();
        }
        return redirect()->back()->with('success', 'Building Rejected');
    }

    public function rejectList()
    {
        $buildings = Building::where('company_id', Auth::user()->id)
            ->where('status', 2)
            ->latest()
            ->get();
        return view('building.building_reject_list', compact('buildings'));
    }
   
}
