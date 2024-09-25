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

    // // Method to display all stalls
    // public function listparking()
    // {
    //     // Eager load related models (vehicles, parkers, floors, etc.)
    //     $stalls = StallLocker::with(['vehicles', 'parkers', 'parking','floor.block.building'])->get();

    //     return view('parking.parking_list', compact('stalls'));
    // }


    // Method to display all stalls
    public function listparking(Request $request)
    {
        //          // Get floor_id from the request
        //     $floorId =  $query->where('floor_id'); // Filter by the provided floor_id

        //     // Initialize the query for StallLocker with eager loading
        //     $query = StallLocker::with(['vehicles', 'parkers', 'parking']);

        //     // // If a floor_id is provided, filter by floor_id
        //     // if ($floorId) {
        //     //     $query->where('floor_id', $floorId); // Filter by the provided floor_id
        //     // }

        //     // Exclude storage stalls
        //     $stalls = $query->where('type', '!=', 'Storage Locker')->get();

        //     // Fetch the floor, block, and building associated with the provided floor_id
        //     $floor = null;
        //     $block = null;
        //     $building = null;

        //     if ($floorId) {
        //         $floor = Floor::find($floorId); // Find the floor by the provided floor_id
        //         if ($floor) {
        //             $block = $floor->block; // Get the associated block
        //             $building = $block->building; // Get the associated building
        //         }
        //     }
        //    dd($block,$building);
        //     // Pass the stalls, block, and building to the view
        //     return view('parking.parking_list', compact('stalls', 'block', 'building'));


        // Initialize the query for StallLocker with eager loading of related models
        $stalls = StallLocker::with(['vehicles', 'parkers', 'parking', 'floor.block.building'])
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
            'vehicle_no' => 'required|array', // Ensure it's an array
            'vehicle_no.*' => 'exists:vehicles,id', // Validate each vehicle ID exists
            'parker_no' => 'required|exists:parkers,id',
        ]);

        // Find the stall
        $stall = StallLocker::findOrFail($stallId);

        // Check if the stall has capacity for more vehicles
        $assignedVehicles = Parking::where('stall_no', $stallId)->count();
        if ($assignedVehicles >= $stall->capacity) {
            return back()->with('error', 'Stall capacity exceeded for this parking stall.');
        }

        // Loop through each vehicle to create a parking record
        foreach ($request->vehicle_no as $vehicleId) {
            // Create a new parking record for each vehicle
            $parking = new Parking();
            $parking->stall_no = $stallId;
            $parking->vehicle_no = json_encode([$vehicleId]); // Encode as JSON
            $parking->parker_no = $request->parker_no;
            $parking->save();

            // Update vehicle status to 'assigned' and set stall_no
            $vehicle = Vehicle::find($vehicleId);
            $vehicle->status = 'assigned';
            $vehicle->stall_no = $stallId;
            $vehicle->save();
        }

        // Update parker status to 'assigned' and set stall_no (if applicable)
        $parker = Parker::find($request->parker_no);
        $parker->status = 'assigned';
        $parker->stall_no = $stallId;
        $parker->save();

        return redirect()->route('parking.list')->with('success', 'Vehicle and parker assigned successfully.');
    }
}
