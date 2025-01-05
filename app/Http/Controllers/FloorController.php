<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Models\Floor;
use App\Models\Building;
use App\Models\Stall;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FloorController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasRole('Tenant')) {
            $buildings = Building::where('status', 1)
                ->latest()
                ->get();
        } else {
        $buildings = Building::where('company_id', Auth::user()->id)->where('status',1)->latest()->get();
        }
        return view('floor.floor_list', compact('buildings'));
    }

    public function create(Request $request)
    {
        // Fetch all blocks and buildings
        $buildings = Building::where('company_id', Auth::user()->id)
        ->where('status',1)->get();
        
        $buildingId = $request->input('building_id');
        $building = Building::find($buildingId);
    
        // Fetch floors and already assigned floor numbers
        $floors = Floor::where('building_id', $building->id ?? null)->get();
        $existingFloors = Floor::where('building_id', $building->id ?? null)->pluck('floor_no')->toArray();
    
        // Define type full form array
        $typeFullForm = [
            'RESB' => 'Residential Building',
            'COMB' => 'Commercial Building',
            'RECB' => 'Residential-Commercial Building',
        ];
    
        // Pass all variables to the view
        return view('floor.floor_add', compact('buildings', 'building', 'floors', 'typeFullForm', 'existingFloors'));
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'floor_no' => 'required',
            'name' => 'nullable|string|max:255',
            'type' => 'required',
        ]);

        // Create a new Floor entry
        $floor = new Floor; 
        $floor->company_id = Auth::user()->id;
        $floor->building_id = $request->input('building_id');
        $floor->floor_no = $request->input('floor_no');
        $floor->name = $request->input('name');
        $floor->type = $request->input('type');
        $floor->is_residential_unit_exist = $request->has('is_residential_unit_exist');
        $floor->is_commercial_unit_exist = $request->has('is_commercial_unit_exist');
        $floor->is_supporting_room_exist = $request->has('is_supporting_room_exist');
        $floor->is_parking_lot_exist = $request->has('is_parking_lot_exist');
        $floor->is_storage_lot_exist = $request->has('is_storage_lot_exist');
        $floor->status = 1;
        $floor->save();

        return redirect()->back()->with('success', 'Floor added successfully.');
        // return redirect()->route('block.show', $block->id)->with('success', 'Floor added successfully.');
    }

    public function show(Request $request, string $id)
    {
        $floor = Floor::findOrFail($id);
        $building = Building::findOrFail($floor->building_id);
        $units = Unit::where('floor_id', $id)->orderBy('unit_no')->get();
        $stalls = Stall::where('floor_id', $id)->orderBy('stall_no')->get();
        return view('floor.floor_view', compact('building', 'floor', 'units', 'stalls'));
    }

    public function edit(Request $request, $id)
    {
        $buildings = Building::where('company_id', Auth::user()->id)
        ->where('status',1)->get();

        $floor = Floor::findOrFail($id);
        $building = Building::findOrFail($floor->building_id);

        $typeFullForm = [
            'RESB' => 'Residential Building',
            'COMB' => 'Commercial Building',
            'RECB' => 'Residential-Commercial Building',
        ];

        return view('floor.floor_edit', compact('floor', 'building', 'buildings', 'typeFullForm'));
    }

    public function update(Request $request, $id)
    {

        $floor = Floor::findOrFail($id);

        $request->validate([
            'floor_no' => 'required',
            'name' => 'nullable|string|max:255',
            'type' => 'required',
        ]);

        // Update the Floor entry
        $floor->building_id = $request->input('building_id');
        $floor->floor_no = $request->input('floor_no');
        $floor->name = $request->input('name');
        $floor->type = $request->input('type');
        $floor->is_residential_unit_exist = $request->has('is_residential_unit_exist');
        $floor->is_commercial_unit_exist = $request->has('is_commercial_unit_exist');
        $floor->is_supporting_room_exist = $request->has('is_supporting_room_exist');
        $floor->is_parking_lot_exist = $request->has('is_parking_lot_exist');
        $floor->is_storage_lot_exist = $request->has('is_storage_lot_exist');
        $floor->status = $request->status;
        $floor->save();

        return redirect()->back()->with('success', 'Floor updated successfully.');
        // return redirect()->route('block.show', $block->id)->with('success', 'Floor updated successfully.');
    }

    public function destroy($id)
    {
        $floor = Floor::findOrFail($id);
        $floor->delete();

        return redirect()->back()->with('delete', 'Floor Deleted successfully.');
    }
}
