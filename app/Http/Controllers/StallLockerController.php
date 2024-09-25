<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Models\Building;
use App\Models\Floor;
use App\Models\StallLocker;
use Illuminate\Http\Request;

class StallLockerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $stalls = StallLocker::with(['vehicles', 'parkers'])->get();
        // return view('stall.stall_locker_list', compact('stalls'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Initialize $block and $building to null
        $block = null;
        $building = null;
        $floor = null;

        // Fetch all buildings
        $buildings = Building::all();
        // Fetch all blocks and their related buildings
        $blocks = Block::with('building')->get();

        $floors = Floor::with('block')->get();

        $floorId = $request->query('floor_id');

        // If a floorId is provided and valid, fetch the Block and related Building
        if ($floorId) {
            $floor = Floor::find($floorId);
            if ($floor) {
                $block = $floor->block;
                $building = $floor->block->building;
            }
        }

        // Define type full form array
        $typeFullForm = [
            'RESB' => 'Residential Building',
            'COMB' => 'Commercial Building',
            'RECB' => 'Residential-Commercial Building',
            // Add other types if needed
        ];
        if ($floor) {
            return view('stall.locker_add', compact('buildings', 'building', 'blocks', 'block', 'floors', 'floor', 'typeFullForm'));
        
        } else {
            // Handle the case when $floor is null (e.g., return an error or redirect)
            return view('stall.stall_add', compact('buildings', 'building', 'blocks', 'block', 'floors', 'floor', 'typeFullForm'));
        }  
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // Validate the request
        $request->validate([
            'floor_id' => 'required|exists:floors,id',
            'stall_locker_no' => 'required|string|max:255',
            'type' => 'required',
        ]);

        // Fetch the floor using the provided floor_id
        $floor = Floor::find($request->floor_id);

        if (!$floor) {
            return redirect()->back()->withErrors('Floor not found.');
        }

        // Check for uniqueness, ignoring the current record
        $exists = StallLocker::where('floor_id', $request->floor_id)
            ->where('stall_locker_no', $request->stall_locker_no)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'This Stall/Locker NO already exists on this floor.');
        }
        $stallLocker = new StallLocker();
        $stallLocker->floor_id = $request->floor_id;
        $stallLocker->stall_locker_no = $request['stall_locker_no'];
        $stallLocker->type = $request['type'];
        $stallLocker->capacity = $request['capacity'];
        $stallLocker->save();

        // return redirect()->route('floor.show', $request->floor_id)
        //     ->with('success', 'Stall/Locker added successfully.');
        return redirect()->back()
            ->with('success', 'Stall/Locker added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // $stallLocker = StallLocker::with('floor.block.building')->findOrFail($id);
        // // Check if the related data is available
        // $floor = $stallLocker->floor;
        // $block = $floor ? $floor->block : null;
        // $building = $block ? $block->building : null;
        // return view('stall.stall_locker_view', compact('stallLocker', 'floor', 'block', 'building'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Initialize $block and $building to null
        $block = null;
        $building = null;
        $floor = null;
        

        $stallLocker = StallLocker::findOrFail($id);
        $floor = $stallLocker->floor;
        $block = $floor->block;
        $building = $block->building;

        // Fetch all buildings
        $buildings = Building::all();
        // Fetch all blocks and their related buildings
        $blocks = Block::with('building')->get();

        $floors = Floor::with('block')->get();                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  

        // Define type full form array
        $typeFullForm = [
            'RESB' => 'Residential Building',
            'COMB' => 'Commercial Building',
            'RECB' => 'Residential-Commercial Building',
            // Add other types if needed
        ];

        if($floor->storage_lot){
            return view('stall.locker_edit', compact('stallLocker', 'buildings', 'building', 'blocks', 'block', 'floors', 'floor', 'typeFullForm'));
        }
        if($floor->parking_lot){
            return view('stall.stall_edit', compact('stallLocker', 'buildings', 'building', 'blocks', 'block', 'floors', 'floor', 'typeFullForm'));
        }
        // Pass all variables to the view
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'stall_locker_no' => 'required|string|max:255',
            'type' => 'required',
        ]);

        // Find and update the Stall/Locker
        $stallLocker = StallLocker::findOrFail($id);

        $floor = Floor::find($request->floor_id);

        if (!$floor) {
            return redirect()->back()->withErrors('Floor not found.');
        }
        // Check for uniqueness, ignoring the current record
        $exists = StallLocker::where('floor_id', $request->floor_id)
            ->where('stall_locker_no', $request->stall_locker_no)
            ->where('id', '!=', $stallLocker->id)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'This Stall/Locker NO already exists on this floor.');
        }

        $stallLocker->update([
            'floor_id' => $request->floor_id,
            'stall_locker_no' => $request->stall_locker_no,
            'capacity' => $request->capacity,
            'type' => $request->type,
        ]);

        // return redirect()->route('floor.show', $stallLocker->floor_id)
        //     ->with('success', 'Stall/Locker updated successfully.');

        return redirect()->back()
            ->with('success', 'Stall/Locker updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $stallLocker = StallLocker::findOrFail($id);
        $stallLocker->delete();

        // return redirect()->route('floor.show', $floorId)
        //     ->with('delete', 'Stall/Locker deleted successfully.');
        return redirect()->back()
            ->with('delete', 'Stall/Locker deleted successfully.');
    }
}
