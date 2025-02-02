<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Models\Building;
use App\Models\Floor;
use App\Models\Room;
use App\Models\roomType;
use App\Models\Stall;
use App\Models\Unit;
use Illuminate\Http\Request;

class GetController extends Controller
{

    // Fetch all blocks with their associated buildings
    // public function getBlocks($id)
    // {
    //     $blocks = Block::where('building_id', $id)->get();
    //     return response()->json($blocks);
    // }



    // Fetch all floors no with their associated blocks
    public function getFloorsNo($buildingId, Request $request)
    {
        // Validate type input to ensure it's either 'upper' or 'underground'
        $type = $request->query('type');
        if (!in_array($type, ['upper', 'underground'])) {
            return response()->json(['error' => 'Invalid type provided'], 400);
        }
    
        $floors = Floor::where('building_id', $buildingId)
            ->where('type', $type)
            ->pluck('floor_no');
    
        return response()->json(['existingFloors' => $floors]);
    }

    
    // Fetch all floors with their associated blocks
    public function getFloors($id)
    {
        $floors = Floor::where('building_id', $id)->orderBy('type')->orderBy('floor_no')->get();
        $building = Building::find($id);
        return response()->json(['floors' => $floors, 'building' => $building]);
    }


    public function getFloorsUpper($id)
    {
        $floors = Floor::where('building_id', $id)->where('type','upper')->orderBy('type')->orderBy('floor_no')->get();
        $building = Building::find($id);
        return response()->json(['floors' => $floors, 'building' => $building]);
    }


    public function getFloorsUnderground($id)
    {
        $floors = Floor::where('building_id', $id)->where('type','underground')->orderBy('type')->orderBy('floor_no')->get();
        $building = Building::find($id);
        return response()->json(['floors' => $floors, 'building' => $building]);
    }


    // Fetch all units with their associated floors
    public function getUnits($id)
    {
        $units = Unit::where('floor_id', $id)->get();
        $floor = Floor::find($id);
        return response()->json(['units' => $units, 'floor' => $floor]);
    }

    
    // Fetch all rooms with their associated units
    public function getRooms($id)
    {
        $rooms = Room::where('unit_id', $id)->orderBy('room_no')->get();
        $roomTypes = roomType::all();
        $unit = Unit::find($id);
        return response()->json(['rooms' => $rooms, 'unit' => $unit, 'roomTypes' => $roomTypes]);
    }


    public function getStalls($id)
    {
        $stalls = Stall::where('floor_id', $id)->get();
        $floor = Floor::find($id);
        return response()->json(['stalls' => $stalls, 'floor' => $floor]);
    }


}
