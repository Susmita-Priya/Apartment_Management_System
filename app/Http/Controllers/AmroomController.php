<?php

namespace App\Http\Controllers;

use App\Models\Extraamroom;
use App\Models\Amroom;
use App\Models\Unit;
use Illuminate\Http\Request;

class AmroomController extends Controller
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

        // Return the view for adding a new amenity room
        return view('amroom.amroom_add', compact('unit', 'floor', 'block', 'building'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'unit_id' => 'required|exists:units,id',
            'balcony' => 'nullable|integer',
            'business_center' => 'nullable|integer',
            'gym' => 'nullable|integer',
            'hot_tub' => 'nullable|integer',
            'laundry_room' => 'nullable|integer',
            'library' => 'nullable|integer',
            'meeting_room' => 'nullable|integer',
            'mens_changing_room' => 'nullable|integer',
            'restaurant' => 'nullable|integer',
            'room_deck' => 'nullable|integer',
            'sauna' => 'nullable|integer',
            'swimming_pool' => 'nullable|integer',
            'theater_room' => 'nullable|integer',
            'womens_changing_room' => 'nullable|integer',
            'patio' => 'nullable|integer',
            'extra_rooms.*.room_name' => 'required|string',
            'extra_rooms.*.quantity' => 'required|integer',
        ]);

        $unitId = $request->input('unit_id');

        // Check if a room entry already exists for this unit
        $existingRoom = Amroom::where('unit_id', $unitId)->first();

        if ($existingRoom) {
            return redirect()->back()->withErrors(['error' => 'Room entry has already been submitted for this unit.']);
        }

        $amenityRoom = new Amroom();
        $amenityRoom->unit_id = $request->unit_id;
        $amenityRoom->balcony = $request->balcony;
        $amenityRoom->business_center = $request->business_center;
        $amenityRoom->gym = $request->gym;
        $amenityRoom->hot_tub = $request->hot_tub;
        $amenityRoom->laundry_room = $request->laundry_room;
        $amenityRoom->library = $request->library;
        $amenityRoom->meeting_room = $request->meeting_room;
        $amenityRoom->mens_changing_room = $request->mens_changing_room;
        $amenityRoom->restaurant = $request->restaurant;
        $amenityRoom->room_deck = $request->room_deck;
        $amenityRoom->sauna = $request->sauna;
        $amenityRoom->swimming_pool = $request->swimming_pool;
        $amenityRoom->theater_room = $request->theater_room;
        $amenityRoom->womens_changing_room = $request->womens_changing_room;
        $amenityRoom->patio = $request->patio;
        $amenityRoom->save();

        // Save extra rooms
        foreach ($request->input('extra_rooms', []) as $extraRoom) {
            Extraamroom::create([
                'amroom_id' => $amenityRoom->id,
                'room_name' => $extraRoom['room_name'],
                'quantity' => $extraRoom['quantity'],
            ]);
        }

        return redirect()->route('unit.show', $unitId)->with('success', 'Amenity Room entry added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $amroom = Amroom::findOrFail($id);
        $unit = $amroom->unit;
        $floor = $unit->floor;
        $block = $floor->block;
        $building = $block->building;

        return view('amroom.amroom_show', compact('amroom', 'unit', 'floor', 'block', 'building'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $amroom = Amroom::findOrFail($id);
        $unit = $amroom->unit;
        $floor = $unit->floor;
        $block = $floor->block;
        $building = $block->building;

        return view('amroom.amroom_edit', compact('amroom', 'unit', 'floor', 'block', 'building'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $amroom = Amroom::with('extraRooms')->findOrFail($id);

        // Validate incoming request
        $request->validate([
            'unit_id' => 'required|exists:units,id',
            'balcony' => 'nullable|integer',
            'business_center' => 'nullable|integer',
            'gym' => 'nullable|integer',
            'hot_tub' => 'nullable|integer',
            'laundry_room' => 'nullable|integer',
            'library' => 'nullable|integer',
            'meeting_room' => 'nullable|integer',
            'mens_changing_room' => 'nullable|integer',
            'restaurant' => 'nullable|integer',
            'room_deck' => 'nullable|integer',
            'sauna' => 'nullable|integer',
            'swimming_pool' => 'nullable|integer',
            'theater_room' => 'nullable|integer',
            'womens_changing_room' => 'nullable|integer',
            'patio' => 'nullable|integer',
            'extra_rooms.*.room_name' => 'nullable|string',
            'extra_rooms.*.quantity' => 'nullable|integer',
        ]);

        // Update basic fields
        $amroom->update([
            'balcony' => $request->balcony,
            'business_center' => $request->business_center,
            'gym' => $request->gym,
            'hot_tub' => $request->hot_tub,
            'laundry_room' => $request->laundry_room,
            'library' => $request->library,
            'meeting_room' => $request->meeting_room,
            'mens_changing_room' => $request->mens_changing_room,
            'restaurant' => $request->restaurant,
            'room_deck' => $request->room_deck,
            'sauna' => $request->sauna,
            'swimming_pool' => $request->swimming_pool,
            'theater_room' => $request->theater_room,
            'womens_changing_room' => $request->womens_changing_room,
            'patio' => $request->patio,
        ]);

        // Handle the extra rooms
        $extraRooms = $request->extra_rooms ?? [];

        // First, remove any existing extra rooms that are not in the request
        $amroom->extraRooms()->whereNotIn('id', collect($extraRooms)->pluck('id'))->delete();

        // Update or create new extra rooms
        foreach ($extraRooms as $extraRoomData) {
            if (isset($extraRoomData['id'])) {
                // Update existing room
                $extraRoom = $amroom->extraRooms()->find($extraRoomData['id']);
                if ($extraRoom) {
                    $extraRoom->update([
                        'room_name' => $extraRoomData['room_name'],
                        'quantity' => $extraRoomData['quantity'],
                    ]);
                }
            } else {
                // Create new room
                $amroom->extraRooms()->create([
                    'room_name' => $extraRoomData['room_name'],
                    'quantity' => $extraRoomData['quantity'],
                ]);
            }
        }

        return redirect()->route('unit.show', $request->unit_id)->with('success', 'Amenity Room updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $amroom = Amroom::find($id);

        if (!$amroom) {
            return redirect()->back()->with('error', 'Room not found.');
        }

        $amroom->delete();

        return redirect()->route('unit.show', $amroom->unit_id)->with('success', 'Amenity Room deleted successfully.');
    }
}
