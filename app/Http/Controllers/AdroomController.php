<?php

namespace App\Http\Controllers;

use App\Models\Extraadroom;
use App\Models\Adroom;
use App\Models\Unit;
use Illuminate\Http\Request;

class AdroomController extends Controller
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

        // Return the view for adding a new administrative room
        return view('adroom.adroom_add', compact('unit', 'floor', 'block', 'building'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'unit_id' => 'required|exists:units,id',
            'accounting' => 'nullable|integer',
            'board_room' => 'nullable|integer',
            'building_manager_office' => 'nullable|integer',
            'business_center_room' => 'nullable|integer',
            'computer_it' => 'nullable|integer',
            'conference_room' => 'nullable|integer',
            'first_aid_room' => 'nullable|integer',
            'human_resource' => 'nullable|integer',
            'meeting_room' => 'nullable|integer',
            'property_manager_office' => 'nullable|integer',
            'registration_office' => 'nullable|integer',
            'sales_marketing' => 'nullable|integer',
            'security_concierge' => 'nullable|integer',
            'shipping_receiving' => 'nullable|integer',
            'workshop_room' => 'nullable|integer',
            'extra_rooms.*.room_name' => 'required|string',
            'extra_rooms.*.quantity' => 'required|integer',
        ]);

        $unitId = $request->input('unit_id');

        // Check if a room entry already exists for this unit
        $existingRoom = Adroom::where('unit_id', $unitId)->first();

        if ($existingRoom) {
            return redirect()->back()->withErrors(['error' => 'Room entry has already been submitted for this unit.']);
        }

        $administrativeRoom = new Adroom();
        $administrativeRoom->unit_id = $request->unit_id;
        $administrativeRoom->accounting = $request->accounting;
        $administrativeRoom->board_room = $request->board_room;
        $administrativeRoom->building_manager_office = $request->building_manager_office;
        $administrativeRoom->business_center_room = $request->business_center_room;
        $administrativeRoom->computer_it = $request->computer_it;
        $administrativeRoom->conference_room = $request->conference_room;
        $administrativeRoom->first_aid_room = $request->first_aid_room;
        $administrativeRoom->human_resource = $request->human_resource;
        $administrativeRoom->meeting_room = $request->meeting_room;
        $administrativeRoom->property_manager_office = $request->property_manager_office;
        $administrativeRoom->registration_office = $request->registration_office;
        $administrativeRoom->sales_marketing = $request->sales_marketing;
        $administrativeRoom->security_concierge = $request->security_concierge;
        $administrativeRoom->shipping_receiving = $request->shipping_receiving;
        $administrativeRoom->workshop_room = $request->workshop_room;
        $administrativeRoom->save();

        // Save extra rooms
        foreach ($request->input('extra_rooms', []) as $extraRoom) {
            Extraadroom::create([
                'adroom_id' => $administrativeRoom->id,
                'room_name' => $extraRoom['room_name'],
                'quantity' => $extraRoom['quantity'],
            ]);
        }

        return redirect()->route('unit.show', $unitId)->with('success', 'Administrative Room entry added successfully.');
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
        $adroom = Adroom::findOrFail($id);
        $unit = $adroom->unit;
        $floor = $unit->floor;
        $block = $floor->block;
        $building = $block->building;

        return view('adroom.adroom_edit', compact('adroom', 'unit', 'floor', 'block', 'building'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $adroom = Adroom::with('extraRooms')->findOrFail($id);

        // Validate incoming request
        $request->validate([
            'unit_id' => 'required|exists:units,id',
            'accounting' => 'nullable|integer',
            'board_room' => 'nullable|integer',
            'building_manager_office' => 'nullable|integer',
            'business_center_room' => 'nullable|integer',
            'computer_it' => 'nullable|integer',
            'conference_room' => 'nullable|integer',
            'first_aid_room' => 'nullable|integer',
            'human_resource' => 'nullable|integer',
            'meeting_room' => 'nullable|integer',
            'property_manager_office' => 'nullable|integer',
            'registration_office' => 'nullable|integer',
            'sales_marketing' => 'nullable|integer',
            'security_concierge' => 'nullable|integer',
            'shipping_receiving' => 'nullable|integer',
            'workshop_room' => 'nullable|integer',
            'extra_rooms.*.room_name' => 'nullable|string',
            'extra_rooms.*.quantity' => 'nullable|integer',
        ]);

        // Update basic fields
        $adroom->update([
            'accounting' => $request->accounting,
            'board_room' => $request->board_room,
            'building_manager_office' => $request->building_manager_office,
            'business_center_room' => $request->business_center_room,
            'computer_it' => $request->computer_it,
            'conference_room' => $request->conference_room,
            'first_aid_room' => $request->first_aid_room,
            'human_resource' => $request->human_resource,
            'meeting_room' => $request->meeting_room,
            'property_manager_office' => $request->property_manager_office,
            'registration_office' => $request->registration_office,
            'sales_marketing' => $request->sales_marketing,
            'security_concierge' => $request->security_concierge,
            'shipping_receiving' => $request->shipping_receiving,
            'workshop_room' => $request->workshop_room,
        ]);

        // Handle the extra rooms
        $extraRooms = $request->extra_rooms ?? [];

        // First, remove any existing extra rooms that are not in the request
        $adroom->extraRooms()->whereNotIn('id', collect($extraRooms)->pluck('id'))->delete();

        // Update or create new extra rooms
        foreach ($extraRooms as $extraRoomData) {
            if (isset($extraRoomData['id'])) {
                // Update existing room
                $extraRoom = $adroom->extraRooms()->find($extraRoomData['id']);
                if ($extraRoom) {
                    $extraRoom->update([
                        'room_name' => $extraRoomData['room_name'],
                        'quantity' => $extraRoomData['quantity'],
                    ]);
                }
            } else {
                // Create new room
                $adroom->extraRooms()->create([
                    'room_name' => $extraRoomData['room_name'],
                    'quantity' => $extraRoomData['quantity'],
                ]);
            }
        }

        return redirect()->route('unit.show', $request->unit_id)->with('success', 'Administrative Room updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $adroom = Adroom::find($id);

        if (!$adroom) {
            return redirect()->back()->with('error', 'Room not found.');
        }

        $adroom->delete();

        return redirect()->route('unit.show', $adroom->unit_id)->with('delete', 'Administrative Room deleted successfully.');
    }
}
