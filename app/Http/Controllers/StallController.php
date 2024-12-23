<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Models\Building;
use App\Models\Floor;
use App\Models\Parker;
use App\Models\Stall;
use App\Models\StallLocker;
use App\Models\Vehicle;
use App\Models\vehicleType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StallController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         // Fetch all blocks with their associated buildings
         $buildings = Building::where('company_id', Auth::user()->id)->where('status',1)->latest()->get();
        return view('stall.stall_index', compact('buildings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Fetch all buildings, blocks, and floors
        $buildings = Building::where('company_id', Auth::user()->id)
        ->where('status',1)->get();
        $floors = Floor::where('type', 'underground')->where('status',1)->get();

        // Fetch the floor using the provided floor_id
        $floorId = $request->query('floor_id');
        $floor = Floor::find($floorId);
        $building = Building::find($floor->building_id ?? null);

        // Define type full form array
        $typeFullForm = [
            'RESB' => 'Residential Building',
            'COMB' => 'Commercial Building',
            'RECB' => 'Residential-Commercial Building',
            // Add other types if needed
        ];

        // Pass all variables to the view
        return view('stall.stall_add', compact('buildings', 'building', 'floors', 'floor', 'typeFullForm'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        // Validate the request
        $request->validate([
            'stall_no' => 'string',
            'type' => 'required',
            'capacity' => 'required',
        ]);

        $floor = Floor::find($request->floor_id);

        if (!$floor) {
            return redirect()->back()->withErrors('Floor not found.');
        }

        // Check for uniqueness
        $exists = Stall::where('floor_id', $request->floor_id)
            ->where('stall_no', $request->stall_no)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'This Stall NO already exists on this floor.');
        }

        Stall::create([
            'company_id' => Auth::user()->id,
            'floor_id' => $request->floor_id,
            'stall_no' => $request->stall_no,
            'capacity' => $request->capacity,
            'type' => $request->type,
        ]);

        return redirect()->back()
            ->with('success', 'Stall added successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $stall = Stall::findOrFail($id);
        $floor = Floor::findOrFail($stall->floor_id);
        $building = Building::findOrFail($floor->building_id);
        $parkers = Parker::where('stall_no', $id)->get();
        $vehicles = Vehicle::where('stall_id', $stall->id)->orderBy('vehicle_no')->get();
        $vehicleTypes = vehicleType::where('status',1)->get();
     
        return view('stall.stall_view', compact('stall', 'floor', 'building','parkers','vehicles','vehicleTypes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, Request $request)
    {
        // Fetch all buildings, blocks, and floors
        $buildings = Building::where('company_id', Auth::user()->id)
        ->where('status',1)->get();
        $floors = Floor::where('type', 'underground')->get();

        // Fetch the floor using the provided floor_id
        $stall = Stall::findOrFail($id);
        $floor = Floor::find($stall->floor_id ?? null);
        $building = Building::find($floor->building_id ?? null);

        $typeFullForm = [
            'RESB' => 'Residential Building',
            'COMB' => 'Commercial Building',
            'RECB' => 'Residential-Commercial Building',
            
        ];

        // Pass all variables to the view
        return view('stall.stall_edit', compact('stall', 'buildings', 'building', 'floors', 'floor', 'typeFullForm'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'stall_no' => 'string',
            'type' => 'required',
            'capacity' => 'required',
        ]);

        $stall = Stall::findOrFail($id);

        $floor = Floor::find($request->floor_id);

        if (!$floor) {
            return redirect()->back()->withErrors('Floor not found.');
        }

        // Check for uniqueness
        $exists = Stall::where('floor_id', $request->floor_id)
            ->where('stall_no', $request->stall_no)
            ->where('id', '!=', $id)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'This Stall NO already exists on this floor.');
        }

        // Update the stall
        $stall->floor_id = $request->floor_id;
        $stall->stall_no = $request->stall_no;
        $stall->capacity = $request->capacity;
        $stall->type = $request->type;
        $stall->status = $request->status;
        $stall->save();

        return redirect()->back()
            ->with('success', 'Stall updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $stall = Stall::findOrFail($id);
        $parkers = Parker::where('stall_no', $id)->get();
        if ($parkers) {
            foreach ($parkers as $parker) {
            $parker->stall_no = null;
            $parker->status = 0;
            $parker->save();
            }
        }
        $stall->delete();

        return redirect()->back()
            ->with('delete', 'Stall deleted successfully.');
    }
}
