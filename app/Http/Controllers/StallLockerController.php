<?php

namespace App\Http\Controllers;

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
        // Code for listing all stalls/lockers, if needed
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $floorId = $request->query('floor_id');
        $floor = Floor::findOrFail($floorId);
        $block = $floor->block;
        $building = $floor->block->building;

        return view('stall.stall_locker_add', compact('floor', 'block', 'building'));
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

        // // Create the Stall/Locker
        // StallLocker::create([
        //     'floor_id' => $request->floor_id,
        //     'stall_locker_no' => $request->stall_locker_no,
        //     'type' => $request->type,
        // ]);

        // Create a new unit with the generated unit_id


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
        // Add other fields as needed
        $stallLocker->save();

        return redirect()->route('floor.show', $request->floor_id)
            ->with('success', 'Stall/Locker added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $stallLocker = StallLocker::with('floor.block.building')->findOrFail($id);

        return view('stall.stall_locker_view', compact('stallLocker'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $stallLocker = StallLocker::findOrFail($id);
        $floor = $stallLocker->floor;
        $block = $floor->block;
        $building = $block->building;

        return view('stall.stall_locker_edit', compact('stallLocker', 'floor', 'block', 'building'));
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

        // Check for uniqueness, ignoring the current record
        $exists = StallLocker::where('floor_id', $request->floor_id)
            ->where('stall_locker_no', $request->stall_locker_no)
            ->where('id', '!=', $stallLocker->id)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'This Stall/Locker NO already exists on this floor.');
        }

        $stallLocker->update([
            'stall_locker_no' => $request->stall_locker_no,
            'type' => $request->type,
        ]);

        return redirect()->route('floor.show', $stallLocker->floor_id)
            ->with('success', 'Stall/Locker updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $stallLocker = StallLocker::findOrFail($id);
        $floorId = $stallLocker->floor_id;

        $stallLocker->delete();

        return redirect()->route('floor.show', $floorId)
            ->with('delete', 'Stall/Locker deleted successfully.');
    }
}
