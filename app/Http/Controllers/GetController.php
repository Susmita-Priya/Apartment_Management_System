<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Models\Floor;
use App\Models\Room;
use App\Models\Unit;
use Illuminate\Http\Request;

class GetController extends Controller
{

    // Fetch all blocks with their associated buildings
    public function getBlocks($id)
    {
        $blocks = Block::where('building_id', $id)->get();
        return response()->json($blocks);
    }



    // Fetch all floors no with their associated blocks
    public function getFloorsNo($blockId, Request $request)
    {
        // Validate type input to ensure it's either 'upper' or 'underground'
        $type = $request->query('type');
        if (!in_array($type, ['upper', 'underground'])) {
            return response()->json(['error' => 'Invalid type provided'], 400);
        }
    
        $floors = Floor::where('block_id', $blockId)
            ->where('type', $type)
            ->pluck('floor_no');
    
        return response()->json(['existingFloors' => $floors]);
    }



    // Fetch all floors with their associated blocks
    public function getFloors($id)
    {
        $floors = Floor::where('block_id', $id)->where('type','upper')->orderBy('type')->orderBy('floor_no')->get();
        $block = Block::find($id);
        return response()->json(['floors' => $floors, 'block' => $block]);
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
        $unit = Unit::find($id);
        return response()->json(['rooms' => $rooms, 'unit' => $unit]);
    }


}
