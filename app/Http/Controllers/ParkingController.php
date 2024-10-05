<?php

namespace App\Http\Controllers;

use App\Models\Floor;
use App\Models\Parker;
use App\Models\Parking;
use App\Models\StallLocker;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class ParkingController extends Controller
{
    // Method to display all stalls
    public function listparking(Request $request)
    {
        // Initialize the query for StallLocker with eager loading of related models
        $stalls = StallLocker::with(['vehicles', 'parkers', 'floor.block.building'])
            ->where('type', '!=', 'Storage Locker') // Exclude storage stalls
            ->get();

        // Pass the stalls to the view
        return view('parking.parking_list', compact('stalls'));
    }


    // Method to show parking assign form
    public function create($stallId)
    {
        // Find the stall with related vehicles and parkers
        $stall = StallLocker::with(['vehicles', 'parkers'])->findOrFail($stallId);

        // Fetch only the vehicles and parkers that are not assigned
        $vehicles = Vehicle::where('status', 'not_assigned')->get();
        $parkers = Parker::where('status', 'not_assigned')->get();

        return view('parking.parking_assign', compact('stall', 'vehicles', 'parkers'));
    }

    // Method to store vehicle and parker assignments
    public function store(Request $request, $stallId)
    {
        // Validate the incoming request
        $request->validate([
            'vehicle_no' => 'nullable|array', // Ensure it's an array
            'vehicle_no.*' => 'exists:vehicles,id', // Validate each vehicle ID exists
            'parker_no' => 'nullable|exists:parkers,id',
        ]);

        // Find the stall
        $stall = StallLocker::findOrFail($stallId);

        // Assign vehicles if provided
        if ($request->vehicle_no) {
            foreach ($request->vehicle_no as $vehicleId) {
                // Check stall capacity
                $assignedVehicles = Vehicle::where('stall_no', $stallId)->count();
                if ($assignedVehicles >= $stall->capacity) {
                    return back()->with('error', 'Stall capacity exceeded for this parking stall.');
                }

                // // Create a parking record and assign vehicle
                // $parking = new Parking();
                // $parking->stall_no = $stallId;
                // $parking->vehicle_no = json_encode([$vehicleId]); // Store vehicle ID as JSON
                // $parking->save();

                // Update vehicle status to 'assigned'
                $vehicle = Vehicle::find($vehicleId);
                $vehicle->status = 'assigned';
                $vehicle->stall_no = $stallId;
                $vehicle->save();
            }
        }

        // Handle the parker assignment
        if ($request->filled('parker_no')) {
            // Check if there is a previously assigned parker
            if ($stall->parkers->isNotEmpty()) {
                // Get the current parker
                $previousParker = $stall->parkers->first();

                // Update previous parker status to 'not_assigned'
                $previousParker->status = 'not_assigned';
                $previousParker->stall_no = null;
                $previousParker->save();
            }

            // Assign the new parker
            $parker = Parker::findOrFail($request->parker_no);
            $parker->status = 'assigned';
            $parker->stall_no = $stallId; // Assign the new parker to the stall
            $parker->save();

            // Link the new parker to the stall (add if relationship isn't explicitly defined)
            $stall->parkers()->save($parker);
        }

        return redirect()->back()->with('success', 'Assigned successfully.');
    }

    // Method to remove vehicle assignment
    public function removeVehicle($vehicleId)
    {
        // Find the vehicle
        $vehicle = Vehicle::findOrFail($vehicleId);
        // $parking = Parking::findOrFail($vehicleId);

        // $parking->vehicle_no = null;
        // Unassign the vehicle by setting stall_no to null and updating status
        $vehicle->stall_no = null;
        $vehicle->status = 'not_assigned';
        $vehicle->save();

        return back()->with('success', 'Vehicle unassigned successfully.');
    }

    // Method to remove vehicle assignment
    public function removeParker($parkerId)
    {
        // Find the vehicle
        $parker = Parker::findOrFail($parkerId);
        $parker->stall_no = null;
        $parker->status = 'not_assigned';
        $parker->save();

        return back()->with('success', 'Parker unassigned successfully.');
    }

}
