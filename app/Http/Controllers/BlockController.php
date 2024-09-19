<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Models\Building;
use Illuminate\Http\Request;

class BlockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all blocks with their associated buildings
        $blocks = Block::with('building')->get();
        return view('block.block_list', compact('blocks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $buildingId = $request->query('building_id');
        $building = Building::find($buildingId);
        $buildings = Building::all();
        $typeFullForm = [
            'RESB' => 'Residential Building',
            'COMB' => 'Commercial Building',
            'RECB' => 'Residential-Commercial Building',
            // Add other types if needed
        ];
        return view('block.block_add', compact('building', 'buildings', 'typeFullForm'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required',
            'building_id' => 'required|exists:buildings,id',
        ]);

        // Fetch the building
        $building = Building::find($request->building_id);

        // Generate a unique block ID
        $lastBlock = Block::where('building_id', $building->id)->orderBy('block_id', 'desc')->first();
        $lastNumber = $lastBlock ? intval(substr($lastBlock->block_id, strrpos($lastBlock->block_id, '-') + 4)) : 0;
        $newBlockId = $building->building_id . '-BLK' . ($lastNumber + 1);

        // Check for uniqueness and regenerate if needed
        while (Block::where('block_id', $newBlockId)->exists()) {
            $newBlockId = $building->building_id . '-BLK' . ($lastNumber + 1);
            $lastNumber++;
        }

        // Create a new Block entry
        Block::create([
            'block_id' => $newBlockId,
            'name' => $request->name,
            'building_id' => $request->building_id,
        ]);

        return redirect()->back()->with('success', 'Block added successfully.');

        // return redirect()->route('building.show', $building->id)->with('success', 'Block added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $block = Block::withCount(['building', 'floors'])->findOrFail($id);
        $block->load('commonArea.extraFields');
        $building = $block->building;    // Get the building associated with this block

        // Pass the data to the view
        return view('block.block_view', compact('block', 'building'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $block = Block::withCount(['building'])->findOrFail($id);
        $buildings = Building::all(); // Fetch all buildings
        $typeFullForm = [
            'RESB' => 'Residential Building',
            'COMB' => 'Commercial Building',
            'RECB' => 'Residential-Commercial Building',
            // Add other types if needed
        ];

        return view('block.block_edit', compact('block', 'buildings', 'typeFullForm'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $block = Block::findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:255',
        'building_id' => 'required|exists:buildings,id',
    ]);

    $block->name = $request->name;
    $block->building_id = $request->building_id; // Update the building_id
    $block->save();

    // Redirect back to the previous page with a success message
    return redirect()->back()->with('success', 'Block updated successfully');

        // return redirect()->route('building.show', $building->id)->with('success', 'Block updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        // Find the block to delete
        $block = Block::findOrFail($id);

        // Fetch the associated building
        $building = Building::findOrFail($block->building_id);

        // Delete the block
        $block->delete();

        // Redirect to the building's details page with a success message
        return redirect()->route('building.show', $building->id)->with('delete', 'Block deleted successfully.');
    }
}
