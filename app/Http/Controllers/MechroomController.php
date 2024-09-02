<?php

namespace App\Http\Controllers;

use App\Models\Extramechroom;
use App\Models\Mechroom;
use App\Models\Unit;
use Illuminate\Http\Request;

class MechroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $unitId = $request->query('unit_id');
        $unit = Unit::findOrFail($unitId);
        $floor = $unit->floor;
        $block = $floor->block;
        $building = $block->building;

        // Return the view for adding a new mechanical room
        return view('mechroom.mechroom_add', compact('unit', 'floor', 'block', 'building'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'unit_id' => 'required|exists:units,id',
            'backup_generator' => 'nullable|integer',
            'boilers_room' => 'nullable|integer',
            'compactor_room' => 'nullable|integer',
            'electrical_room' => 'nullable|integer',
            'elevator_mechanical_room' => 'nullable|integer',
            'elevators_pit_room' => 'nullable|integer',
            'elevators_room' => 'nullable|integer',
            'emergency_hydro_room' => 'nullable|integer',
            'fan_room' => 'nullable|integer',
            'fire_extinguishers' => 'nullable|integer',
            'fire_panel' => 'nullable|integer',
            'garbage_chute' => 'nullable|integer',
            'hvac_mechanical_room' => 'nullable|integer',
            'hydro_room' => 'nullable|integer',
            'mechanical_room' => 'nullable|integer',
            'phone_cable_room' => 'nullable|integer',
            'recycling_room' => 'nullable|integer',
            'sprinklers_room' => 'nullable|integer',
            'swimming_pool_mechanical_room' => 'nullable|integer',
            'water_pump_room' => 'nullable|integer',
            'extra_rooms.*.room_name' => 'required|string',
            'extra_rooms.*.quantity' => 'required|integer',
        ]);

        $unitId = $request->input('unit_id');

        // Check if a room entry already exists for this unit
        $existingRoom = Mechroom::where('unit_id', $unitId)->first();

        if ($existingRoom) {
            return redirect()->back()->withErrors(['error' => 'Room entry has already been submitted for this unit.']);
        }

        $mechanicalRoom = new Mechroom();
        $mechanicalRoom->unit_id = $request->unit_id;
        $mechanicalRoom->backup_generator = $request->backup_generator;
        $mechanicalRoom->boilers_room = $request->boilers_room;
        $mechanicalRoom->compactor_room = $request->compactor_room;
        $mechanicalRoom->electrical_room = $request->electrical_room;
        $mechanicalRoom->elevator_mechanical_room = $request->elevator_mechanical_room;
        $mechanicalRoom->elevators_pit_room = $request->elevators_pit_room;
        $mechanicalRoom->elevators_room = $request->elevators_room;
        $mechanicalRoom->emergency_hydro_room = $request->emergency_hydro_room;
        $mechanicalRoom->fan_room = $request->fan_room;
        $mechanicalRoom->fire_extinguishers = $request->fire_extinguishers;
        $mechanicalRoom->fire_panel = $request->fire_panel;
        $mechanicalRoom->garbage_chute = $request->garbage_chute;
        $mechanicalRoom->hvac_mechanical_room = $request->hvac_mechanical_room;
        $mechanicalRoom->hydro_room = $request->hydro_room;
        $mechanicalRoom->mechanical_room = $request->mechanical_room;
        $mechanicalRoom->phone_cable_room = $request->phone_cable_room;
        $mechanicalRoom->recycling_room = $request->recycling_room;
        $mechanicalRoom->sprinklers_room = $request->sprinklers_room;
        $mechanicalRoom->swimming_pool_mechanical_room = $request->swimming_pool_mechanical_room;
        $mechanicalRoom->water_pump_room = $request->water_pump_room;
        $mechanicalRoom->save();

        // Save extra rooms
        foreach ($request->input('extra_rooms', []) as $extraRoom) {
            Extramechroom::create([
                'mechroom_id' => $mechanicalRoom->id,
                'room_name' => $extraRoom['room_name'],
                'quantity' => $extraRoom['quantity'],
            ]);
        }

        return redirect()->route('unit.show', $unitId)->with('success', 'Mechanical Room entry added successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $mechroom = Mechroom::findOrFail($id);
        $unit = $mechroom->unit;
        $floor = $unit->floor;
        $block = $floor->block;
        $building = $block->building;

        return view('mechroom.mechroom_edit', compact('mechroom', 'unit', 'floor', 'block', 'building'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $mechroom = Mechroom::with('extraRooms')->findOrFail($id);

        // Validate incoming request
        $request->validate([
            'unit_id' => 'required|exists:units,id',
            'backup_generator' => 'nullable|integer',
            'boilers_room' => 'nullable|integer',
            'compactor_room' => 'nullable|integer',
            'electrical_room' => 'nullable|integer',
            'elevator_mechanical_room' => 'nullable|integer',
            'elevators_pit_room' => 'nullable|integer',
            'elevators_room' => 'nullable|integer',
            'emergency_hydro_room' => 'nullable|integer',
            'fan_room' => 'nullable|integer',
            'fire_extinguishers' => 'nullable|integer',
            'fire_panel' => 'nullable|integer',
            'garbage_chute' => 'nullable|integer',
            'hvac_mechanical_room' => 'nullable|integer',
            'hydro_room' => 'nullable|integer',
            'mechanical_room' => 'nullable|integer',
            'phone_cable_room' => 'nullable|integer',
            'recycling_room' => 'nullable|integer',
            'sprinklers_room' => 'nullable|integer',
            'swimming_pool_mechanical_room' => 'nullable|integer',
            'water_pump_room' => 'nullable|integer',
            'extra_rooms.*.room_name' => 'nullable|string',
            'extra_rooms.*.quantity' => 'nullable|integer',
        ]);

        // Update basic fields
        $mechroom->update([
            'backup_generator' => $request->backup_generator,
            'boilers_room' => $request->boilers_room,
            'compactor_room' => $request->compactor_room,
            'electrical_room' => $request->electrical_room,
            'elevator_mechanical_room' => $request->elevator_mechanical_room,
            'elevators_pit_room' => $request->elevators_pit_room,
            'elevators_room' => $request->elevators_room,
            'emergency_hydro_room' => $request->emergency_hydro_room,
            'fan_room' => $request->fan_room,
            'fire_extinguishers' => $request->fire_extinguishers,
            'fire_panel' => $request->fire_panel,
            'garbage_chute' => $request->garbage_chute,
            'hvac_mechanical_room' => $request->hvac_mechanical_room,
            'hydro_room' => $request->hydro_room,
            'mechanical_room' => $request->mechanical_room,
            'phone_cable_room' => $request->phone_cable_room,
            'recycling_room' => $request->recycling_room,
            'sprinklers_room' => $request->sprinklers_room,
            'swimming_pool_mechanical_room' => $request->swimming_pool_mechanical_room,
            'water_pump_room' => $request->water_pump_room,
        ]);

        // Handle the extra rooms
        $extraRooms = $request->extra_rooms ?? [];

        // First, remove any existing extra rooms that are not in the request
        $mechroom->extraRooms()->whereNotIn('id', collect($extraRooms)->pluck('id'))->delete();

        // Update or create new extra rooms
        foreach ($extraRooms as $extraRoomData) {
            if (isset($extraRoomData['id'])) {
                // Update existing room
                $extraRoom = $mechroom->extraRooms()->find($extraRoomData['id']);
                if ($extraRoom) {
                    $extraRoom->update([
                        'room_name' => $extraRoomData['room_name'],
                        'quantity' => $extraRoomData['quantity'],
                    ]);
                }
            } else {
                // Create new room
                $mechroom->extraRooms()->create([
                    'room_name' => $extraRoomData['room_name'],
                    'quantity' => $extraRoomData['quantity'],
                ]);
            }
        }

        return redirect()->route('unit.show', $request->unit_id)->with('success', 'Mechanical Room updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $mechroom = Mechroom::find($id);

        if (!$mechroom) {
            return redirect()->back()->with('error', 'Room not found.');
        }

        $mechroom->delete();

        return redirect()->route('unit.show', $mechroom->unit_id)->with('delete', 'Mechanical Room deleted successfully.');

    }
}
