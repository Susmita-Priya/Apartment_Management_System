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
        $buildings = Building::where('company_id', Auth::user()->id)->where('status',1)->latest()->get();
        return view('floor.floor_list', compact('buildings'));
    }

    public function create(Request $request)
    {
        // Fetch all blocks and buildings
        $buildings = Building::where('status',1)->get();
        $blocks = Block::all();
        
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
        $floor = Floor::findOrFail($id);
        $block = Block::findOrFail($floor->block_id);
        $building = Building::findOrFail($block->building_id);
        $units = Unit::where('floor_id', $id)->orderBy('unit_no')->get();
        
        return view('floor.floor_view', compact('building', 'block', 'floor', 'units'));
    }

    public function edit(Request $request, $id)
    {
        $buildings = Building::all();
        $blocks = Block::all();

        $floor = Floor::findOrFail($id);
        $block = Block::findOrFail($floor->block_id);
        $building = Building::findOrFail($block->building_id);

        $typeFullForm = [
            'RESB' => 'Residential Building',
            'COMB' => 'Commercial Building',
            'RECB' => 'Residential-Commercial Building',
        ];

        return view('floor.floor_edit', compact('floor', 'block', 'building', 'buildings', 'blocks', 'typeFullForm'));
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
        $floor->block_id = $request->input('block_id');
        $floor->floor_no = $request->input('floor_no');
        $floor->name = $request->input('name');
        $floor->type = $request->input('type');
        $floor->is_residential_unit_exist = $request->has('is_residential_unit_exist');
        $floor->is_commercial_unit_exist = $request->has('is_commercial_unit_exist');
        $floor->is_supporting_room_exist = $request->has('is_supporting_room_exist');
        $floor->is_parking_lot_exist = $request->has('is_parking_lot_exist');
        $floor->is_storage_lot_exist = $request->has('is_storage_lot_exist');
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
