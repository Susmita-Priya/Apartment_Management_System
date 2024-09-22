<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Models\Building;
use App\Models\Floor;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        // Fetch units with their related floor, block, and building details
        $units = Unit::with(['floor.block', 'floor.block.building'])->get();

        return view('unit.unit_list', compact('units'));
    }     
    //l

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Fetch all buildings
        $buildings = Building::all();
        // Fetch all blocks and their related buildings
        $blocks = Block::with('building')->get();

        $floors = Floor::with('block')->get();

        $floorId = $request->query('floor_id');

        // Initialize $block and $building to null
        $block = null;
        $building = null;
        $floor = null;

        // If a floorId is provided and valid, fetch the Block and related Building
        if ($floorId) {
            $floor = Floor::find($floorId);
            if ($floor) {
                $block = $floor->block;
                $building = $floor->block->building;
            }
        }

        // Define type full form array
        $typeFullForm = [
            'RESB' => 'Residential Building',
            'COMB' => 'Commercial Building',
            'RECB' => 'Residential-Commercial Building',
            // Add other types if needed
        ];

        // Pass all variables to the view
        return view('unit.unit_add', compact('buildings', 'building', 'blocks', 'block', 'floors', 'floor', 'typeFullForm'));
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

        $floorId = $request->input('floor_id'); // Change from query to input
        // Fetch the floor using the provided floor_id
        $floor = Floor::find($request->floor_id);

        if (!$floor) {
            return redirect()->back()->withErrors('Floor not found.');
        }

       
        // Check for uniqueness, ignoring the current record
        $exists = Unit::where('floor_id', $request->floor_id)
            ->where('unit_no', $request->unit_no)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'This Unit NO already exists on this floor.');
        }

        // Create a new unit with the generated unit_id
        $unit = new Unit();
        $unit->floor_id = $floorId;
        $unit->unit_no = $request->unit_no;
        $unit->type = $request['type'];
        // Add other fields as needed
        $unit->save();

        // return redirect()->route('floor.show', $request->floor_id)->with('success', 'Unit added successfully.');
        return redirect()->back()->with('success', 'Unit added successfully.');
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
    public function edit(string $id,Request $request)
    {

        // Initialize $block and $building to null
         $block = null;
         $building = null;
         $floor = null;

        $unit = Unit::findOrFail($id);
        $floor = $unit->floor;
        $block = $floor->block;
        $building = $block->building;

         // Fetch all buildings
         $buildings = Building::all();
         // Fetch all blocks and their related buildings
         $blocks = Block::with('building')->get();
 
         $floors = Floor::with('block')->get();
 
         // Define type full form array
         $typeFullForm = [
             'RESB' => 'Residential Building',
             'COMB' => 'Commercial Building',
             'RECB' => 'Residential-Commercial Building',
             // Add other types if needed
         ];
 
         // Pass all variables to the view
         return view('unit.unit_edit', compact('unit','buildings', 'building', 'blocks', 'block', 'floors', 'floor', 'typeFullForm'));

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

        // Check for uniqueness, ignoring the current record
        $exists = Unit::where('floor_id', $request->floor_id)
            ->where('unit_no', $request->unit_no)
            ->where('id', '!=', $unit->id)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'This Unit NO already exists on this floor.');
        }

        // Update the unit
        $unit->floor_id = $request->floor_id;
        $unit->unit_no = $request->unit_no;
        $unit->type = $request->type;
        // Add other fields as needed
        $unit->save();

        // return redirect()->route('floor.show', $request->floor_id)
        //     ->with('success', 'Unit updated successfully.');

        return redirect()->back()
        ->with('success', 'Unit updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $unit = Unit::findOrFail($id);

        $unit->delete();

        // return redirect()->route('floor.show', $floorId)
        //     ->with('delete', 'Unit deleted successfully.');

        return redirect()->back()
        ->with('delete', 'Unit deleted successfully.');
    }
}
