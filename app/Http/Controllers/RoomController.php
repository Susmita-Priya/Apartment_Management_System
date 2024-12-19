<?php

namespace App\Http\Controllers;

use App\Models\Amenities;
use App\Models\Block;
use App\Models\Building;
use App\Models\Floor;
use App\Models\Room;
use App\Models\roomType;
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
        $buildings = Building::where('company_id', Auth::user()->id)->where('status', 1)->latest()->get();

        return view('room.room_list', compact('buildings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Fetch all buildings, blocks, and floors
        $buildings = Building::where('company_id', Auth::user()->id)
        ->where('status',1)->get();
        $floors = Floor::where('type', 'upper')->where('status', 1)->get();
        $units = Unit::all();
        $roomTypes = roomType::where('status', 1)->get();

        // Fetch the floor using the provided floor_id
        $unitId = $request->query('unit_id');
        $unit = Unit::find($unitId);
        $floor = Floor::find($unit->floor_id ?? null);
        $building = Building::find($floor->building_id ?? null);

        // Define type full form array
        $typeFullForm = [
            'RESB' => 'Residential Building',
            'COMB' => 'Commercial Building',
            'RECB' => 'Residential-Commercial Building',
        ];

        $amenities = Amenities::all();

        // Pass all variables to the view
        return view('room.room_add', compact('buildings', 'building', 'floors', 'floor', 'typeFullForm', 'units', 'unit', 'amenities', 'roomTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'room_no' => 'required',
        ]);

        $room = new Room();
        $room->company_id = Auth::user()->id;
        $room->unit_id = $request->unit_id;
        $room->room_type_id = $request->room_type_id;
        $room->room_no = $request->room_no;
        $room->amenities = json_encode($request->amenities);
        $room->save();

        return redirect()->back()->with('success', 'Room added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $room = Room::findOrFail($id);
        $unit = Unit::find($room->unit_id);
        $floor = Floor::find($unit->floor_id);
        $building = Building::find($floor->building_id);

        $roomTypeId = $room->room_type_id;
        $roomType = roomType::find($roomTypeId);
        $roomAmenities = json_decode($room->amenities);
        $amenities = Amenities::all();

        $selectedAmenities = [];

        foreach ($roomAmenities as $roomAmenity) {
            $amenity = $amenities->where('id', $roomAmenity->id)->first();
            if ($amenity) {
                $selectedAmenities[] = [
                    'name' => $amenity->name,
                    'description' => $amenity->description,
                    'image' => $amenity->image,
                    'quantity' => $roomAmenity->quantity
                ];
            }
        }

        return view('room.room_view', compact('room', 'unit', 'floor', 'building', 'roomType', 'selectedAmenities'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $amenities = Amenities::all();
        $room = Room::findOrFail($id);

        // Fetch all buildings, blocks, and floors
        $buildings = Building::where('company_id', Auth::user()->id)
        ->where('status',1)->get();
        $floors = Floor::where('type', 'upper')->where('status', 1)->get();
        $units = Unit::all();
        $roomTypes = roomType::where('status', 1)->get();

        // Fetch the floor using the provided floor_id
        $unit = Unit::find($room->unit_id);
        $floor = Floor::find($unit->floor_id ?? null);
        $building = Building::find($floor->building_id ?? null);

        // Define type full form array
        $typeFullForm = [
            'RESB' => 'Residential Building',
            'COMB' => 'Commercial Building',
            'RECB' => 'Residential-Commercial Building',
        ];

        return view('room.room_edit', compact('room', 'amenities', 'buildings', 'building', 'floors', 'floor', 'typeFullForm', 'units', 'unit', 'roomTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'room_no' => 'required',
        ]);

        $room = Room::findOrFail($id);
        $room->unit_id = $request->unit_id;
        $room->room_type_id = $request->room_type_id;
        $room->room_no = $request->room_no;
        $room->amenities = json_encode($request->amenities);
        $room->save();

        return redirect()->back()->with('success', 'Room Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $room = Room::findOrFail($id);
        $room->delete();

        return redirect()->back()->with('success', 'Room deleted successfully');
    }
}
