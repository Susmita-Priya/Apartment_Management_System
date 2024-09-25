<?php

namespace App\Http\Controllers;

use App\Models\StallLocker;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicles = Vehicle::all();
        return view('vehicle.vehicle_list', compact('vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Fetch all available stalls to display in the dropdown
        $stalls = StallLocker::all();
        return view('vehicle.vehicle_add', compact('stalls'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'vehicle_name' => 'required|max:255',
            'vehicle_type' => 'required|max:255',
            'owner_name' => 'required|max:255',
        ]);

        // Determine vehicle type
        $vehicleType = $request->vehicle_type === 'new' ? $request->new_vehicle_type : $request->vehicle_type;

        // Generate the vehicle ID
        $lastVehicle = Vehicle::orderBy('created_at', 'desc')->first();
        $newVehicleId = 'V' . str_pad(($lastVehicle ? intval(substr($lastVehicle->vehicle_no, 1)) + 1 : 1), 4, '0', STR_PAD_LEFT);

        // Create new vehicle entry
        Vehicle::create([
            'vehicle_no' => $newVehicleId, // Set the generated vehicle number
            'vehicle_name' => $request->vehicle_name,
            'vehicle_type' =>  $vehicleType,
            'owner_name' => $request->owner_name,
            'stall_no' => $request->stall_no,
            'status' => 'not_assigned', // Set status to assigned
        ]);

        // Redirect to a success page or the vehicle listing page
        return redirect()->back()->with('success', 'Vehicle added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Vehicle $vehicle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $stalls = StallLocker::all(); // Fetch all available stalls

        return view('vehicle.vehicle_edit', compact('vehicle', 'stalls'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'vehicle_name' => 'required|max:255',
            'vehicle_type' => 'required|max:255',
            'owner_name' => 'required|max:255',
        ]);

        // Find the existing vehicle
        $vehicle = Vehicle::findOrFail($id);

        // Determine vehicle type
        $vehicleType = $request->vehicle_type === 'new' ? $request->new_vehicle_type : $request->vehicle_type;

        // Update vehicle entry
        $vehicle->update([
            'vehicle_name' => $request->vehicle_name,
            'vehicle_type' => $vehicleType,
            'owner_name' => $request->owner_name,
            'stall_no' => $request->stall_no, // Ensure the field name matches your database column
        ]);

        // Redirect or respond as needed
        return redirect()->back()->with('success', 'Vehicle updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $vehicle = Vehicle::findOrFail($id);

        $vehicle->delete();

        // return redirect()->route('floor.show', $floorId)
        //     ->with('delete', 'vehicle deleted successfully.');

        return redirect()->back()
            ->with('delete', 'vehicle deleted successfully.');
    }
}
