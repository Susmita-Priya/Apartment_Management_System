<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Models\Floor;
use App\Models\Unit;
use Illuminate\Http\Request;

class GetController extends Controller
{
    public function getBlocks($id)
    {
        // Fetch all blocks with their associated buildings
        $blocks = Block::where('building_id', $id)->get();
        return response()->json($blocks);
    }

    public function getFloorsNo($blockId, Request $request)
    {
        // Validate type input to ensure it's either 'upper' or 'underground'
        $type = $request->query('type');
        if (!in_array($type, ['upper', 'underground'])) {
            return response()->json(['error' => 'Invalid type provided'], 400);
        }
    
        // Fetch floors based on block_id and type
        $floors = Floor::where('block_id', $blockId)
            ->where('type', $type) // Assuming the type column exists in the Floor model
            ->pluck('floor_no');
    
        return response()->json(['existingFloors' => $floors]);
    }

    public function getFloors($id)
    {
        $floors = Floor::where('block_id', $id)->orderBy('type')->orderBy('floor_no')->get();
        $block = Block::find($id);
        return response()->json(['floors' => $floors, 'block' => $block]);
    }

    public function getUnits($id)
    {
        $units = Unit::where('floor_id', $id)->get();
        $floor = Floor::find($id);
        return response()->json(['units' => $units, 'floor' => $floor]);
    }


}
