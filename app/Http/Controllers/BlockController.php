<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Models\Building;
use App\Models\Floor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all blocks with their associated buildings
        $buildings = Building::where('company_id', Auth::user()->id)->where('status',1)->latest()->get();
        // dd($buildings);
        return view('block.block_list', compact('buildings')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $building_id = request('building_id');
        $building = Building::find($building_id);
        $buildings = Building::where('status',1)->get();
        $typeFullForm = [
            'RESB' => 'Residential Building',
            'COMB' => 'Commercial Building',
            'RECB' => 'Residential-Commercial Building',
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
            'total_upper_floors'=>'required|numeric',
            'total_underground_floors'=> 'required|numeric',
        ]);

        // Fetch the building
        $building = Building::find($request->building_id);

        // Generate a unique block ID
        $lastBlock = Block::where('building_id', $building->id)->orderBy('block_no', 'desc')->first();
        $lastNumber = $lastBlock ? intval(substr($lastBlock->block_no, strrpos($lastBlock->block_no, '-') + 4)) : 0;
        $newBlockNo = $building->building_no . '-BLK' . ($lastNumber + 1);

        // Check for uniqueness and regenerate if needed
        while (Block::where('block_no', $newBlockNo)->exists()) {
            $newBlockNo = $building->building_no . '-BLK' . ($lastNumber + 1);
            $lastNumber++;
        }

        // dd($building->company_id);


        // Create a new Block entry
        Block::create([
            'company_id' => $building->company_id,
            'building_id' => $building->id,
            'block_no' => $newBlockNo,
            'name' => $request->name,
            'total_upper_floors' => $request->total_upper_floors,
            'total_underground_floors' => $request->total_underground_floors,
        ]);

        return redirect()->back()->with('success', 'Block added successfully.');

        // return redirect()->route('building.show', $building->id)->with('success', 'Block added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $block = Block::findOrFail($id);
        $building = Building::find($block->building_id);  
        $floors = Floor::where('block_id', $id)->orderBy('type')->orderBy('floor_no')->get();

        // Pass the data to the view
        return view('block.block_view', compact('block', 'building','floors'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $block = Block::findOrFail($id);
        $buildings = Building::all(); // Fetch all buildings
        $building = Building::find($block->building_id);
        $typeFullForm = [
            'RESB' => 'Residential Building',
            'COMB' => 'Commercial Building',
            'RECB' => 'Residential-Commercial Building',
            // Add other types if needed
        ];

        return view('block.block_edit', compact('block', 'buildings', 'building', 'typeFullForm'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $block = Block::findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:255',
        'total_upper_floors'=>'required|numeric',
        'total_underground_floors'=> 'required|numeric',
    ]);

    $block->name = $request->name;
    $block->building_id = $request->building_id; // Update the building_id
    $block->total_upper_floors = $request->total_upper_floors;
    $block->total_underground_floors = $request->total_underground_floors;
    $block->save();

    // Redirect back to the previous page with a success message
    return redirect()->back()->with('success', 'Block updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the block to delete
        $block = Block::findOrFail($id);

        // Delete the block
        $block->delete();

        return redirect()->back()->with('delete', 'Block deleted successfully.');
    }
}
