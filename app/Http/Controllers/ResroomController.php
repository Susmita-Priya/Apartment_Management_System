<?php

namespace App\Http\Controllers;

use App\Models\Extraresroom;
use App\Models\Resroom;
use App\Models\Unit;
use Illuminate\Http\Request;

class ResroomController extends Controller
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

        // Return the view for adding a new residential room
        return view('resroom.resroom_add', compact('unit', 'floor', 'block', 'building'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // Validate the request data
        $request->validate([
            'unit_id' => 'required|exists:units,id',
            'bedroom' => 'nullable|integer',
            'bathroom' => 'nullable|integer',
            'balcony' => 'nullable|integer',
            'dining_room' => 'nullable|integer',
            'library_room' => 'nullable|integer',
            'kitchen' => 'nullable|integer',
            'storeroom' => 'nullable|integer',
            'laundry' => 'nullable|integer',
            'solarium' => 'nullable|integer',
            'washroom' => 'nullable|integer',
            'extra_rooms.*.room_name' => 'nullable|string',
            'extra_rooms.*.quantity' => 'nullable|integer',
        ]);

        $unitId = $request->input('unit_id');

        // Check if a room entry already exists for this unit
        $existingRoom = Resroom::where('unit_id', $unitId)->first();

        if ($existingRoom) {
            return redirect()->back()->withErrors(['error' => 'Room entry has already been submitted for this unit.']);
        }

        // Create a new room entry
        $resroom = new Resroom();
        $resroom->unit_id = $unitId;
        $resroom->bedroom = $request->input('bedroom', 0);
        $resroom->bathroom = $request->input('bathroom', 0);
        $resroom->balcony = $request->input('balcony', 0);
        $resroom->dining_room = $request->input('dining_room', 0);
        $resroom->library_room = $request->input('library_room', 0);
        $resroom->kitchen = $request->input('kitchen', 0);
        $resroom->storeroom = $request->input('storeroom', 0);
        $resroom->laundry = $request->input('laundry', 0);
        $resroom->solarium = $request->input('solarium', 0);
        $resroom->washroom = $request->input('washroom', 0);
        $resroom->save();

        // Handle extra rooms
        foreach ($request->input('extra_rooms', []) as $extraRoom) {
            Extraresroom::create([
                'resroom_id' => $resroom->id,
                'room_name' => $extraRoom['room_name'],
                'quantity' => $extraRoom['quantity'],
            ]);
        }

        return redirect()->route('unit.show', $unitId)->with('success', 'Room entry added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id, $room_type)
{
    // Define room type labels
    $residentialRoomTypes = [
        'bedroom' => 'Bedroom',
        'bathroom' => 'Bathroom',
        'balcony' => 'Balcony',
        'dining_room' => 'Dining Room',
        'library_room' => 'Library Room',
        'kitchen' => 'Kitchen',
        'storeroom' => 'Storeroom',
        'laundry' => 'Laundry',
        'solarium' => 'Solarium',
        'washroom' => 'Washroom',
    ];

    $resroom = Resroom::with(['unit'])->findOrFail($id);
    $unit = $resroom->unit;

    // Fetch specific room type details
    $roomTypeDetails = $resroom->$room_type; 

    // Fetch the label using the room_type key
    $roomTypeLabel = $residentialRoomTypes[$room_type] ?? ucfirst($room_type);

    return view('resroom.resroom_view', compact('resroom', 'roomTypeDetails', 'room_type', 'roomTypeLabel'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $resroom = ResRoom::with('extraRooms')->findOrFail($id);
        $unit = $resroom->unit;  // Assuming Resroom has a 'unit' relationship.
        $block = $unit->floor->block;  // Assuming relationships from unit to floor and block.
        $floor = $unit->floor;  // Assuming unit belongs to floor.

        return view('resroom.resroom_edit', compact('resroom', 'unit', 'block', 'floor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $resroom = ResRoom::with('extraRooms')->findOrFail($id);


        // Validate incoming request
        $request->validate([
            'bedroom' => 'required|integer|min:0',
            'bathroom' => 'required|integer|min:0',
            'balcony' => 'required|integer|min:0',
            'dining_room' => 'required|integer|min:0',
            'library_room' => 'required|integer|min:0',
            'kitchen' => 'required|integer|min:0',
            'storeroom' => 'required|integer|min:0',
            'laundry' => 'required|integer|min:0',
            'solarium' => 'required|integer|min:0',
            'washroom' => 'required|integer|min:0',
            'extra_rooms.*.room_name' => 'required|string|max:255',
            'extra_rooms.*.quantity' => 'required|integer|min:0',
        ]);

        // Update basic fields
        $resroom->update([
            'bedroom' => $request->bedroom,
            'bathroom' => $request->bathroom,
            'balcony' => $request->balcony,
            'dining_room' => $request->dining_room,
            'library_room' => $request->library_room,
            'kitchen' => $request->kitchen,
            'storeroom' => $request->storeroom,
            'laundry' => $request->laundry,
            'solarium' => $request->solarium,
            'washroom' => $request->washroom,
        ]);

        // Handle the extra rooms
        $extraRooms = $request->extra_rooms ?? [];

        // First, remove any existing extra rooms that are not in the request
        $resroom->extraRooms()->whereNotIn('id', collect($extraRooms)->pluck('id'))->delete();

        // Update or create new extra rooms
        foreach ($extraRooms as $extraRoomData) {
            if (isset($extraRoomData['id'])) {
                $extraRoom = $resroom->extraRooms()->find($extraRoomData['id']);
                if ($extraRoom) {
                    $extraRoom->update([
                        'room_name' => $extraRoomData['room_name'],
                        'quantity' => $extraRoomData['quantity'],
                    ]);
                }
            } else {
                // Create new room
                $resroom->extraRooms()->create([
                    'room_name' => $extraRoomData['room_name'],
                    'quantity' => $extraRoomData['quantity'],
                ]);
            }
        }

        // Redirect with success message
        return redirect()->route('unit.show', $resroom->unit_id)
            ->with('success', 'Residential room details updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Find the resroom by ID
        $resroom = Resroom::find($id);

        if (!$resroom) {
            return redirect()->back()->with('error', 'Room not found.');
        }

        // Delete the room
        $resroom->delete();

        // Redirect with success message
        return redirect()->route('unit.show', $resroom->unit_id)->with('delete', 'Room deleted successfully.');
    }
}
