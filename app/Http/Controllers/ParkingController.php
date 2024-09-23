<?php

namespace App\Http\Controllers;

use App\Models\Parker;
use App\Models\Parking;
use App\Models\StallLocker;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class ParkingController extends Controller
{

// Method to display all stalls
public function listparking()
{
    $stalls = StallLocker::with('vehicles', 'parkers')->get();
    return view('parking.parking_list', compact('stalls'));
}

// Method to show parking assign form
public function create($stallId)
{
    $stall = StallLocker::with('vehicles', 'parkers')->find($stallId);
    $vehicles = Vehicle::all();
    $parkers = Parker::all();

    return view('parking.parking_assign', compact('stall', 'vehicles', 'parkers'));
}

// Method to store vehicle and parker assignments
public function store(Request $request, $stallId)
{
    $stall = StallLocker::find($stallId);

    // // Check if capacity is not exceeded
    // if ($stall->vehicles->count() >= $stall->vehicle_capacity) {
    //     return back()->with('error', 'Vehicle capacity exceeded for this stall.');
    // }

    $parking = new Parking();
    $parking->stall_no = $stallId;
    $parking->vehicle_no = $request->vehicle_no;
    $parking->parker_no = $request->parker_no;
    $parking->save();

    return redirect()->route('parking.list')->with('success', 'Vehicle and parker assigned successfully.');
}
    
}
