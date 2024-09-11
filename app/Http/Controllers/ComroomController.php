<?php

namespace App\Http\Controllers;

use App\Models\Comroom;
use App\Models\Extracomroom;
use App\Models\Unit;
use Illuminate\Http\Request;

class ComroomController extends Controller
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
        $unitId = $request->query('unit_id');
        $unit = Unit::findOrFail($unitId);
        $floor = $unit->floor;
        $block = $floor->block;
        $building = $block->building;

        // Return the view for adding a new residential room
        return view('comroom.comroom_add', compact('unit', 'floor', 'block', 'building'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'unit_id' => 'required|exists:units,id',
            'bathroom' => 'nullable|integer',
            'office_room' => 'nullable|integer',
            'conference_room' => 'nullable|integer',
            'dining_room' => 'nullable|integer',
            'kitchen' => 'nullable|integer',
            'laundry' => 'nullable|integer',
            'solarium' => 'nullable|integer',
            'storage' => 'nullable|integer',
            'washroom' => 'nullable|integer',
            'extra_rooms.*.room_name' => 'required|string',
            'extra_rooms.*.quantity' => 'required|integer',
        ]);

        $unitId = $request->input('unit_id');

        // Check if a room entry already exists for this unit
        $existingRoom = Comroom::where('unit_id', $unitId)->first();

        if ($existingRoom) {
            return redirect()->back()->withErrors(['error' => 'Room entry has already been submitted for this unit.']);
        }

        $commercialRoom = new Comroom();
        $commercialRoom->unit_id = $request->unit_id;
        $commercialRoom->bathroom = $request->bathroom;
        $commercialRoom->office_room = $request->officeroom;
        $commercialRoom->conference_room = $request->conferenceroom;
        $commercialRoom->dining_room = $request->dining_room;
        $commercialRoom->kitchen = $request->kitchen;
        $commercialRoom->laundry = $request->laundry;
        $commercialRoom->solarium = $request->solarium;
        $commercialRoom->storage = $request->storage;
        $commercialRoom->washroom = $request->washroom;
        $commercialRoom->save();

        // Save extra rooms
        foreach ($request->input('extra_rooms', []) as $extraRoom) {
            Extracomroom::create([
                'comroom_id' => $commercialRoom->id,
                'room_name' => $extraRoom['room_name'],
                'quantity' => $extraRoom['quantity'],
            ]);
        }

        return redirect()->route('unit.show', $unitId)->with('success', 'Room entry added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id,$room_type)
    {
        // $comroom = Comroom::with(['unit'])->findOrFail($id);
        // $unit = $comroom->unit; 
        // $roomTypeDetails = $comroom->$room_type; // Fetch specific room type details
        
        // return view('comroom.comroom_view', compact('comroom', 'roomTypeDetails', 'room_type'));


        // Define room type labels
        $commercialRoomTypes = [
            'bathroom' => 'Bathroom',
            'office_room' => 'Office Room',
            'conference_room' => 'Conference Room',
            'dining_room' => 'Dining Room',
            'kitchen' => 'Kitchen',
            'laundry' => 'Laundry',
            'solarium' => 'Solarium',
            'storage' => 'Storage',
            'washroom' => 'Washroom',
        ];

        $comroom = Comroom::with(['unit', 'asset'])->findOrFail($id);
        $unit = $comroom->unit;

        // Fetch specific room type details
        $roomTypeDetails = $comroom->$room_type;

        // Fetch the label using the room_type key
        $roomTypeLabel = $residentialRoomTypes[$room_type] ?? ucfirst($room_type);

        return view('comroom.comroom_view', compact('comroom', 'roomTypeDetails', 'room_type', 'roomTypeLabel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $comroom = Comroom::findOrFail($id);
        $unit = $comroom->unit;  // Assuming Resroom has a 'unit' relationship.
        $block = $unit->floor->block;  // Assuming relationships from unit to floor and block.
        $floor = $unit->floor;
        $block = $floor->block;
        $building = $block->building;

        return view('comroom.comroom_edit', compact('comroom', 'unit', 'block', 'floor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $comroom = Comroom::with('extraRooms')->findOrFail($id);

        // Validate incoming request
        $request->validate([
            'unit_id' => 'required|exists:units,id',
            'bathroom' => 'nullable|integer',
            'office_room' => 'nullable|integer',
            'conference_room' => 'nullable|integer',
            'dining_room' => 'nullable|integer',
            'kitchen' => 'nullable|integer',
            'laundry' => 'nullable|integer',
            'solarium' => 'nullable|integer',
            'storage' => 'nullable|integer',
            'washroom' => 'nullable|integer',
            'extra_rooms.*.room_name' => 'nullable|string',
            'extra_rooms.*.quantity' => 'nullable|integer',
        ]);

        // Update basic fields
        $comroom->update([
            'bathroom' => $request->bathroom,
            'office_room' => $request->office_room,
            'conference_room' => $request->conference_room,
            'dining_room' => $request->dining_room,
            'kitchen' => $request->kitchen,
            'laundry' => $request->laundry,
            'solarium' => $request->solarium,
            'storage' => $request->storage,
            'washroom' => $request->washroom,
        ]);

        // Handle the extra rooms
        $extraRooms = $request->extra_rooms ?? [];

        // First, remove any existing extra rooms that are not in the request
        $comroom->extraRooms()->whereNotIn('id', collect($extraRooms)->pluck('id'))->delete();

        // Update or create new extra rooms
        foreach ($extraRooms as $extraRoomData) {
            if (isset($extraRoomData['id'])) {
                // Update existing room
                $extraRoom = $comroom->extraRooms()->find($extraRoomData['id']);
                if ($extraRoom) {
                    $extraRoom->update([
                        'room_name' => $extraRoomData['room_name'],
                        'quantity' => $extraRoomData['quantity'],
                    ]);
                }
            } else {
                // Create new room
                $comroom->extraRooms()->create([
                    'room_name' => $extraRoomData['room_name'],
                    'quantity' => $extraRoomData['quantity'],
                ]);
            }
        }

        return redirect()->route('unit.show', $request->unit_id)->with('success', 'Commercial Room updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Find the resroom by ID
        $comroom = Comroom::find($id);

        if (!$comroom) {
            return redirect()->back()->with('error', 'Room not found.');
        }

        // Delete the room
        $comroom->delete();

        // Redirect with success message
        return redirect()->route('unit.show', $comroom->unit_id)->with('delete', 'Room deleted successfully.');
    }
}
