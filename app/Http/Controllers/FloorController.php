<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Models\Floor;
use App\Models\Building;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FloorController extends Controller
{
    public function index()
    {

        // Fetch all floors with their associated blocks and buildings
        $floors = Floor::with('block.building')->get();
        return view('floor.floor_list', compact('floors'));
    }

    // public function create(Request $request)
    // {
       
    //     $blocks = Block::all();
    //     $buildings = Building::all();

    //     $blockId = request('block_id');
    //     $block = Block::find($blockId);
    //     $building = Building::find($block->building_id??null);
    //     $floors = Floor::where('block_id', $block->id ?? null)->get();
    //     $typeFullForm = [
    //         'RESB' => 'Residential Building',
    //         'COMB' => 'Commercial Building',
    //         'RECB' => 'Residential-Commercial Building',
    //     ];
    //     return view('floor.floor_add', compact('buildings', 'building', 'blocks', 'block', 'floors','typeFullForm','existingFloors'));
    // }

    public function create(Request $request)
    {
        // Fetch all blocks and buildings
        $blocks = Block::all();
        $buildings = Building::all();
    
        $blockId = $request->input('block_id');
        $block = Block::find($blockId);
        $building = Building::find($block->building_id ?? null);
    
        // Fetch floors and already assigned floor numbers
        $floors = Floor::where('block_id', $block->id ?? null)->get();
        $existingFloors = Floor::where('block_id', $block->id ?? null)->pluck('floor_no')->toArray();
    
        // Define type full form array
        $typeFullForm = [
            'RESB' => 'Residential Building',
            'COMB' => 'Commercial Building',
            'RECB' => 'Residential-Commercial Building',
        ];
    
        // Pass all variables to the view
        return view('floor.floor_add', compact('buildings', 'building', 'blocks', 'block', 'floors', 'typeFullForm', 'existingFloors'));
    }

    public function getFloors($blockId, Request $request)
    {
        // Validate type input to ensure it's either 'upper' or 'underground'
        $type = $request->query('type');
        if (!in_array($type, ['upper', 'underground'])) {
            return response()->json(['error' => 'Invalid type provided'], 400);
        }
    
        // Fetch floors based on block_id and type
        $floors = Floor::where('block_id', $blockId)
            ->where('type', $type) // Assuming the type column exists in the Floor model
            ->pluck('floor_no');
    
        return response()->json(['existingFloors' => $floors]);
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
        $floor->block_id = $request->input('block_id');
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
        $floor = Floor::withCount(['units', 'stallsLockers'])->findOrFail($id);
        $block = $floor->block;
        $building = $block->building;
        
        return view('floor.floor_view', compact('building', 'block', 'floor'));
    }

    public function edit(Request $request, $id)
    {
        // Fetch all buildings
        $buildings = Building::all();
        // Fetch all blocks and their related buildings
        $blocks = Block::with('building')->get();

        $floor = Floor::findOrFail($id);
        $block = $floor->block;
        $building = $block->building;

        // Define type full form array
        $typeFullForm = [
            'RESB' => 'Residential Building',
            'COMB' => 'Commercial Building',
            'RECB' => 'Residential-Commercial Building',
            // Add other types if needed
        ];

        return view('floor.floor_edit', compact('floor', 'block', 'building', 'buildings', 'blocks', 'typeFullForm'));
    }

    public function update(Request $request, $id)
    {

        $floor = Floor::findOrFail($id);
        $previousBuilding = $floor->building;

        $request->validate([
            'floor_no' => 'required',
            'name' => 'nullable|string|max:255',
            'type' => 'required|in:rooftop,upper,ground,underground',
        ]);

        // Check for uniqueness
        $exists = Floor::where('block_id', $request->block_id)
            ->where('floor_no', $request->floor_no)
            ->where('type', $request->type)
            ->where('id', '!=', $floor->id)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'This Floor NO already exists on this Block.');
        }

        // Update the Floor entry
        $floor->block_id = $request->input('block_id');
        $floor->floor_no = $request->input('floor_no');
        $floor->name = $request->input('name');
        $floor->type = $request->input('type');
        $floor->residential_suite = $request->has('residential_suite');
        $floor->commercial_unit = $request->has('commercial_unit');
        $floor->supporting_service_room = $request->has('supporting_service_room');
        $floor->parking_lot = $request->has('parking_lot');
        $floor->storage_lot = $request->has('storage_lot');
        $floor->save();

         // Handle deletion of units if the building type has changed
    if ($previousBuilding->id !== $request->building_id) {
        $newBuilding = Building::findOrFail($request->building_id);

        if ($newBuilding->type === 'RESB') {
            // Delete commercial units if present in this floor
            Unit::where('floor_id', $id)
                ->where('type', 'Commercial Unit')
                ->delete();
        } elseif ($newBuilding->type === 'COMB') {
            // Delete residential suites if present in this floor
            Unit::where('floor_id', $id)
                ->where('type', 'Residential Suite')
                ->delete();
        } 
        // No need to delete units if the new building type is 'RECB'
    }

        return redirect()->back()->with('success', 'Floor updated successfully.');
        // return redirect()->route('block.show', $block->id)->with('success', 'Floor updated successfully.');
    }

    public function destroy($id)
    {
        $floor = Floor::findOrFail($id);
        $floor->delete();

        // return redirect()->route('block.show', $block->id)->with('delete', 'Floor Deleted successfully.');
        return redirect()->back()->with('delete', 'Floor Deleted successfully.');
    }
}
