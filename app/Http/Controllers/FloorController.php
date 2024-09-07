<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Models\Floor;
use App\Models\Building;
use Illuminate\Http\Request;

class FloorController extends Controller
{
    public function index($blockId)
    {
        // $block = Block::with('floors')->findOrFail($blockId);
        // $building = $block->building;

        // return view('floors.index', compact('building', 'block'));
    }

    public function create(Request $request)
    {

        $blockId = $request->query('block_id');

        $block = Block::findOrFail($blockId);
        $building = $block->building;

        return view('floor.floor_add', compact('building', 'block'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'floor_no' => 'required',
            'name' => 'nullable|string|max:255',
            'type' => 'required|in:rooftop,upper,ground,underground',
        ]);

        $blockId = $request->input('block_id'); // Change from query to input
        $block = Block::findOrFail($blockId);

        // Check for uniqueness
        $exists = Floor::where('block_id', $request->block_id)
            ->where('floor_no', $request->floor_no)
            ->where('type', $request->type)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'This Floor NO already exists on this Block.');
        }

        // Create a new Floor entry
        $floor = new Floor;
        $floor->block_id = $blockId;
        $floor->floor_no = $request->input('floor_no');
        $floor->name = $request->input('name');
        $floor->type = $request->input('type');
        $floor->residential_suite = $request->has('residential_suite');
        $floor->commercial_unit = $request->has('commercial_unit');
        $floor->supporting_service_room = $request->has('supporting_service_room');
        $floor->parking_lot = $request->has('parking_lot');
        $floor->bike_lot = $request->has('bike_lot');
        $floor->storage_lot = $request->has('storage_lot');
        $floor->save();

        return redirect()->route('block.show', $block->id)->with('success', 'Floor added successfully.');
    }

    public function show(Request $request, string $id)
    {
        $floor = Floor::findOrFail($id);
        $block = $floor->block;
        $building = $block->building;
        $floor = Floor::withCount(['units', 'stallsLockers'])->findOrFail($id);

        return view('floor.floor_view', compact('building', 'block', 'floor'));
    }

    public function edit(Request $request, $id)
    {
        $floor = Floor::findOrFail($id);
        $block = $floor->block;
        $building = $block->building;

        return view('floor.floor_edit', compact('floor', 'block', 'building'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'floor_no' => 'required',
            'name' => 'nullable|string|max:255',
            'type' => 'required|in:rooftop,upper,ground,underground',
        ]);

        $floor = Floor::findOrFail($id);
        $block = $floor->block;
        // // Check for valid options based on building type
        // if ($building->type == 'RESB' && !$request->has('residential_suite')) {
        //     return redirect()->back()->withErrors(['residential_suite' => 'Residential suites must be specified for residential buildings.']);
        // }

        // if ($building->type == 'COMB' && !$request->has('commercial_unit')) {
        //     return redirect()->back()->withErrors(['commercial_unit' => 'Commercial units must be specified for commercial buildings.']);
        // }

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
        $floor->bike_lot = $request->has('bike_lot');
        $floor->storage_lot = $request->has('storage_lot');
        $floor->save();
        return redirect()->route('block.show', $block->id)->with('success', 'Floor updated successfully.');
    }

    public function destroy($id)
    {
        $floor = Floor::findOrFail($id);
        $floor->delete();

        // Fetch the associated building
        $block = Block::findOrFail($floor->block_id);

        return redirect()->route('block.show', $block->id)->with('delete', 'Floor Deleted successfully.');
    }
}
