<?php

namespace App\Http\Controllers;

use App\Models\Floor;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {}

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

        $floorId = $request->query('floor_id');
        $floor = Floor::findOrFail($floorId);
        $block = $floor->block;
        $building = $floor->block->building;

        return view('unit.unit_add', compact('floor', 'block', 'building'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'floor_id' => 'required|exists:floors,id',
            'unit_no' => 'required',
        ]);

        // Fetch the floor using the provided floor_id
        $floor = Floor::find($request->floor_id);

        if (!$floor) {
            return redirect()->back()->withErrors('Floor not found.');
        }

        // Combine floor_id with user-provided unit_no to generate the unit_id
        // $unitNo = $request->unit_no;
        // $unitId = $floor->floor_no . '-UNIT' . $unitNo;

        // // Check for uniqueness
        // if (Unit::where('unit_id', $unitId)->exists()) {
        //     return redirect()->back()->withErrors('Unit ID already exists.');
        // }

        // Check for uniqueness, ignoring the current record
        $exists = Unit::where('floor_id', $request->floor_id)
            ->where('unit_no', $request->unit_no)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'This Unit NO already exists on this floor.');
        }

        // Create a new unit with the generated unit_id
        $unit = new Unit();
        $unit->floor_id = $floor->id;
        $unit->unit_no = $request->unit_no;
        $unit->type = $request['type'];
        // Add other fields as needed
        $unit->save();

        return redirect()->route('floor.show', $request->floor_id)
            ->with('success', 'Unit added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Retrieve the unit along with its related data
        $unit = Unit::with(['floor.block.building', 'resRoom.extraRooms'])->findOrFail($id);

        // Check if the related data is available
        $floor = $unit->floor;
        $block = $floor ? $floor->block : null;
        $building = $block ? $block->building : null;

        // Return the view with data
        return view('unit.unit_view', compact('unit', 'floor', 'block', 'building'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $unit = Unit::findOrFail($id);
        $floor = $unit->floor;
        $block = $floor->block;
        $building = $block->building;

        // Debugging: Check the data
        //  dd($unit);

        return view('unit.unit_edit', compact('unit', 'floor', 'block', 'building'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'floor_id' => 'required|exists:floors,id',
            'unit_no' => 'required',
        ]);

        // Fetch the unit
        $unit = Unit::findOrFail($id);

        $floor = Floor::find($request->floor_id);

        if (!$floor) {
            return redirect()->back()->withErrors('Floor not found.');
        }

        // Combine floor_id with user-provided unit_no to generate the unit_id
        // $unitNo = $request->unit_no;
        // $unitId = $floor->floor_no . '-UNIT' . $unitNo;
        // // Check for uniqueness
        // if ($unit->unit_id !== $unitId && Unit::where('unit_id', $unitId)->exists()) {
        //     return redirect()->back()->withErrors('Unit ID already exists.');
        // }
        // Check for uniqueness, ignoring the current record
        $exists = Unit::where('floor_id', $request->floor_id)
            ->where('unit_no', $request->unit_no)
            ->where('id', '!=', $unit->id)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'This Stall/Locker NO already exists on this floor.');
        }
        // Update the unit
        $unit->unit_no = $request->unit_no;;
        $unit->type = $request->type;
        // Add other fields as needed
        $unit->save();

        return redirect()->route('floor.show', $request->floor_id)
            ->with('success', 'Unit updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $unit = Unit::findOrFail($id);
        $floorId = $unit->floor_id;

        $unit->delete();

        return redirect()->route('floor.show', $floorId)
            ->with('delete', 'Unit deleted successfully.');
    }
}
