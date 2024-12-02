<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Block;
use App\Models\Building;
use App\Models\Floor;
use App\Models\Room;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all blocks with their associated buildings
        $buildings = Building::where('company_id', Auth::user()->id)->where('status',1)->latest()->get();

        return view('room.room_list', compact('buildings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Fetch all buildings, blocks, and floors
        $buildings = Building::where('status',1)->get();
        $blocks = Block::all();
        $floors = Floor::where('type', 'upper')->where('status',1)->get();
        $units = Unit::all();

        // Fetch the floor using the provided floor_id
        $unitId = $request->query('unit_id');
        $unit = Unit::find($unitId);
        $floor = Floor::find($unit->floor_id ?? null);
        $block = Block::find($floor->block_id ?? null);
        $building = Building::find($block->building_id ?? null);

        // Define type full form array
        $typeFullForm = [
            'RESB' => 'Residential Building',
            'COMB' => 'Commercial Building',
            'RECB' => 'Residential-Commercial Building',
        ];

        $assets = Asset::all();

        // Pass all variables to the view
        return view('room.room_add', compact('buildings', 'building', 'blocks', 'block', 'floors', 'floor', 'typeFullForm', 'units', 'unit', 'assets'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'unit_id' => 'required',
            'type' => 'required',
            'room_no' => 'required',
            
        ]);

        $room = new Room();
        $room->company_id = Auth::user()->id;   
        $room->unit_id = $request->unit_id;
        $room->type = $request->type;
        $room->room_no = $request->room_no;
        $room->assets = json_encode($request->assets);
        $room->save();

        return redirect()->back()->with('success', 'Room added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $assets = Asset::all();
        $room = Room::findOrFail($id);

        // Fetch all buildings, blocks, and floors
        $buildings = Building::where('status',1)->get();
        $blocks = Block::all();
        $floors = Floor::where('type', 'upper')->where('status',1)->get();
        $units = Unit::all();

        // Fetch the floor using the provided floor_id
        $unit = Unit::find($room->unit_id);
        $floor = Floor::find($unit->floor_id ?? null);
        $block = Block::find($floor->block_id ?? null);
        $building = Building::find($block->building_id ?? null);

        // Define type full form array
        $typeFullForm = [
            'RESB' => 'Residential Building',
            'COMB' => 'Commercial Building',
            'RECB' => 'Residential-Commercial Building',
        ];

        return view('room.room_edit', compact('room', 'assets', 'buildings', 'building', 'blocks', 'block', 'floors', 'floor', 'typeFullForm', 'units', 'unit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'unit_id' => 'required',
            'type' => 'required',
            'room_no' => 'required',
        ]);

        $room = Room::findOrFail($id); 
        $room->unit_id = $request->unit_id;
        $room->type = $request->type;
        $room->room_no = $request->room_no;
        $room->assets = json_encode($request->assets);
        $room->save();

        return redirect()->back()->with('success', 'Room Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        //
    }
}
