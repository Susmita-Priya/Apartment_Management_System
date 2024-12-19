<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Models\Building;
use App\Models\Floor;
use App\Models\Landlord;
use App\Models\Room;
use App\Models\roomType;
use App\Models\Unit;
use App\Models\Unit_landlord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all blocks with their associated buildings
        $buildings = Building::where('company_id', Auth::user()->id)->where('status',1)->latest()->get();

        return view('unit.unit_list', compact('buildings'));
    }
    //l

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Fetch all buildings, blocks, and floors
        $buildings = Building::where('company_id', Auth::user()->id)
        ->where('status',1)->get();
        $floors = Floor::where('type', 'upper')->where('status',1)->get();

        // Fetch the floor using the provided floor_id
        $floorId = $request->query('floor_id');
        $floor = Floor::find($floorId);
        $building = Building::find($floor->building_id ?? null);

        // Define type full form array
        $typeFullForm = [
            'RESB' => 'Residential Building',
            'COMB' => 'Commercial Building',
            'RECB' => 'Residential-Commercial Building',
            // Add other types if needed
        ];

        // Pass all variables to the view
        return view('unit.unit_add', compact('buildings', 'building', 'floors', 'floor', 'typeFullForm'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'unit_no' => 'required',
            'type' => 'required',
        ]);

        $floorId = $request->input('floor_id'); 

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
        $unit->company_id = Auth::user()->id;
        $unit->floor_id = $floorId;
        $unit->unit_no = $request->unit_no;
        $unit->type = $request->type;
        $unit->rent = $request->rent;
        $unit->price = $request->price;
        $unit->save();

        // return redirect()->route('floor.show', $request->floor_id)->with('success', 'Unit added successfully.');
        return redirect()->back()->with('success', 'Unit added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $unit = Unit::findOrFail($id);
        $floor = Floor::findOrFail($unit->floor_id);
        $building = Building::findOrFail($floor->building_id);
        $rooms = Room::where('unit_id', $unit->id)->orderBy('room_no')->get();
        $roomTypes = roomType::where('status',1)->get();
     
        return view('unit.unit_view', compact('unit', 'floor', 'building', 'rooms', 'roomTypes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, Request $request)
    {

        // Fetch all buildings, blocks, and floors
        $buildings = Building::where('company_id', Auth::user()->id)
        ->where('status',1)->get();
        $floors = Floor::where('type', 'upper')->get();

        // Fetch the floor using the provided floor_id
        $unit = Unit::findOrFail($id);
        $floor = Floor::find($unit->floor_id ?? null);
        $building = Building::find($floor->building_id ?? null);

        $typeFullForm = [
            'RESB' => 'Residential Building',
            'COMB' => 'Commercial Building',
            'RECB' => 'Residential-Commercial Building',
            
        ];

        // Pass all variables to the view
        return view('unit.unit_edit', compact('unit', 'buildings', 'building', 'floors', 'floor', 'typeFullForm'));
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
        $unit->rent = $request->rent;
        $unit->status = 0;
        $unit->save();

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

        return redirect()->back()
            ->with('delete', 'Unit deleted successfully.');
    }
}
