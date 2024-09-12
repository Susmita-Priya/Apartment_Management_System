<?php

namespace App\Http\Controllers;

use App\Models\Serroom;
use App\Models\Extraserroom;
use App\Models\Unit;
use Illuminate\Http\Request;

class SerroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Add logic if needed for listing service rooms
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

        // Return the view for adding a new service room
        return view('serroom.serroom_add', compact('unit', 'floor', 'block', 'building'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'unit_id' => 'required|exists:units,id',
            'garbage_chute' => 'nullable|integer',
            'garbage_recycling_room' => 'nullable|integer',
            'inventory_rooms' => 'nullable|integer',
            'janitorial_room' => 'nullable|integer',
            'laundry_room' => 'nullable|integer',
            'loading_dock' => 'nullable|integer',
            'lobby' => 'nullable|integer',
            'mailroom' => 'nullable|integer',
            'mens_bathroom' => 'nullable|integer',
            'mens_washroom' => 'nullable|integer',
            'shipping_receiving' => 'nullable|integer',
            'storage_room' => 'nullable|integer',
            'womens_bathroom' => 'nullable|integer',
            'womens_washroom' => 'nullable|integer',
            'workshop' => 'nullable|integer',
            'extra_rooms.*.room_name' => 'required|string',
            'extra_rooms.*.quantity' => 'required|integer',
        ]);

        $unitId = $request->input('unit_id');

        // Check if a room entry already exists for this unit
        $existingRoom = Serroom::where('unit_id', $unitId)->first();

        if ($existingRoom) {
            return redirect()->back()->withErrors(['error' => 'Room entry has already been submitted for this unit.']);
        }

        $serviceRoom = new Serroom();
        $serviceRoom->unit_id = $request->unit_id;
        $serviceRoom->garbage_chute = $request->garbage_chute;
        $serviceRoom->garbage_recycling_room = $request->garbage_recycling_room;
        $serviceRoom->inventory_rooms = $request->inventory_rooms;
        $serviceRoom->janitorial_room = $request->janitorial_room;
        $serviceRoom->laundry_room = $request->laundry_room;
        $serviceRoom->loading_dock = $request->loading_dock;
        $serviceRoom->lobby = $request->lobby;
        $serviceRoom->mailroom = $request->mailroom;
        $serviceRoom->mens_bathroom = $request->mens_bathroom;
        $serviceRoom->mens_washroom = $request->mens_washroom;
        $serviceRoom->shipping_receiving = $request->shipping_receiving;
        $serviceRoom->storage_room = $request->storage_room;
        $serviceRoom->womens_bathroom = $request->womens_bathroom;
        $serviceRoom->womens_washroom = $request->womens_washroom;
        $serviceRoom->workshop = $request->workshop;
        $serviceRoom->save();

        // Save extra rooms
        foreach ($request->input('extra_rooms', []) as $extraRoom) {
            Extraserroom::create([
                'serroom_id' => $serviceRoom->id,
                'room_name' => $extraRoom['room_name'],
                'quantity' => $extraRoom['quantity'],
            ]);
        }

        return redirect()->route('unit.show', $unitId)->with('success', 'Service Room entry added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id, $room_type)
    {

    // Fetch the residential room with related unit and assets
    $serroom = Serroom::with(['unit', 'assets'])->findOrFail($id);
    $unit = $serroom->unit;

    // Fetch specific room type details from the model
    $roomTypeDetails = $serroom->$room_type ?? null;

    if (!$roomTypeDetails) {
        return redirect()->back()->with('error', 'Room details not found.');
    }
    // dd($mechroom);

    return view('serroom.serroom_view', compact('serroom', 'roomTypeDetails', 'room_type'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $serroom = Serroom::findOrFail($id);
        $unit = $serroom->unit;
        $floor = $unit->floor;
        $block = $floor->block;
        $building = $block->building;

        return view('serroom.serroom_edit', compact('serroom', 'unit', 'floor', 'block', 'building'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $serroom = Serroom::with('extraRooms')->findOrFail($id);

        // Validate incoming request
        $request->validate([
            'unit_id' => 'required|exists:units,id',
            'garbage_chute' => 'nullable|integer',
            'garbage_recycling_room' => 'nullable|integer',
            'inventory_rooms' => 'nullable|integer',
            'janitorial_room' => 'nullable|integer',
            'laundry_room' => 'nullable|integer',
            'loading_dock' => 'nullable|integer',
            'lobby' => 'nullable|integer',
            'mailroom' => 'nullable|integer',
            'mens_bathroom' => 'nullable|integer',
            'mens_washroom' => 'nullable|integer',
            'shipping_receiving' => 'nullable|integer',
            'storage_room' => 'nullable|integer',
            'womens_bathroom' => 'nullable|integer',
            'womens_washroom' => 'nullable|integer',
            'workshop' => 'nullable|integer',
            'extra_rooms.*.room_name' => 'nullable|string',
            'extra_rooms.*.quantity' => 'nullable|integer',
        ]);

        // Update basic fields
        $serroom->update([
            'garbage_chute' => $request->garbage_chute,
            'garbage_recycling_room' => $request->garbage_recycling_room,
            'inventory_rooms' => $request->inventory_rooms,
            'janitorial_room' => $request->janitorial_room,
            'laundry_room' => $request->laundry_room,
            'loading_dock' => $request->loading_dock,
            'lobby' => $request->lobby,
            'mailroom' => $request->mailroom,
            'mens_bathroom' => $request->mens_bathroom,
            'mens_washroom' => $request->mens_washroom,
            'shipping_receiving' => $request->shipping_receiving,
            'storage_room' => $request->storage_room,
            'womens_bathroom' => $request->womens_bathroom,
            'womens_washroom' => $request->womens_washroom,
            'workshop' => $request->workshop,
        ]);

        // Handle the extra rooms
        $extraRooms = $request->extra_rooms ?? [];

        // First, remove any existing extra rooms that are not in the request
        $serroom->extraRooms()->whereNotIn('id', collect($extraRooms)->pluck('id'))->delete();

        // Update or create new extra rooms
        foreach ($extraRooms as $extraRoomData) {
            if (isset($extraRoomData['id'])) {
                // Update existing room
                $extraRoom = $serroom->extraRooms()->find($extraRoomData['id']);
                if ($extraRoom) {
                    $extraRoom->update([
                        'room_name' => $extraRoomData['room_name'],
                        'quantity' => $extraRoomData['quantity'],
                    ]);
                }
            } else {
                // Create new room
                $serroom->extraRooms()->create([
                    'room_name' => $extraRoomData['room_name'],
                    'quantity' => $extraRoomData['quantity'],
                ]);
            }
        }

        return redirect()->route('unit.show', $request->unit_id)->with('success', 'Service Room updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $serroom = Serroom::find($id);

        if (!$serroom) {
            return redirect()->back()->with('error', 'Service Room not found.');
        }

        $serroom->delete();

        return redirect()->route('unit.show', $serroom->unit_id)->with('delete', 'Service Room deleted successfully.');
    }
}
