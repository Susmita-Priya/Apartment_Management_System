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
            'owner_phn' => 'required|max:255',
            'driver_name' => 'required|max:255',
            'driver_phn' => 'required|max:255',
            'vehicle_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:1024', // Validate image file

        ]);

        /// Determine vehicle type
        $vehicleType = $request->vehicle_type === 'new' ? $request->new_vehicle_type : $request->vehicle_type;

        // Generate the vehicle ID
        $lastVehicle = Vehicle::orderBy('created_at', 'desc')->first();
        $newVehicleId = 'V' . str_pad(($lastVehicle ? intval(substr($lastVehicle->vehicle_no, 1)) + 1 : 1), 4, '0', STR_PAD_LEFT);

        // Handle the image upload if present
        if ($request->hasFile('vehicle_image')) {
            $file = $request->file('vehicle_image');

            // Check if the image size exceeds 100KB (102400 bytes)
            if ($file->getSize() > 102400) {
                return redirect()->back()->with('error', 'Image size exceeds 100KB. Please upload a smaller image.');
            }

            $filename = time() . "_vehicle." . $file->getClientOriginalExtension();
            $path = 'uploads/vehicles';
            $file->move(public_path($path), $filename); // Move to 'public/uploads/vehicles' directly
            $fullPath = $path . '/' . $filename;
        } else {
            $fullPath = null;
        }

        // Create new vehicle entry
        Vehicle::create([
            'vehicle_no' => $newVehicleId,
            'vehicle_name' => $request->vehicle_name,
            'vehicle_type' =>  $vehicleType,
            'owner_name' => $request->owner_name,
            'owner_phn' => $request->owner_phn,
            'driver_name' => $request->driver_name,
            'driver_phn' => $request->driver_phn,
            'stall_no' => $request->stall_no,
            'status' => 'not_assigned', // Set status to not assigned
            'vehicle_image' =>  $fullPath, // Save image path
        ]);

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
            'owner_phn' => 'required|max:255',
            'driver_name' => 'required|max:255',
            'driver_phn' => 'required|max:255',
            'vehicle_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:1024', // Validate image file
        ]);

        // Find the existing vehicle
        $vehicle = Vehicle::findOrFail($id);

        // Determine vehicle type
        $vehicleType = $request->vehicle_type === 'new' ? $request->new_vehicle_type : $request->vehicle_type;

        // Handle the image upload if present
        if ($request->hasFile('vehicle_image')) {
            $file = $request->file('vehicle_image');

            // Check if the image size exceeds 100KB (102400 bytes)
            if ($file->getSize() > 102400) {
                return redirect()->back()->with('error', 'Image size exceeds 100KB. Please upload a smaller image.');
            }

            // Delete the old image if it exists
            if ($vehicle->vehicle_image && file_exists(public_path($vehicle->vehicle_image))) {
                unlink(public_path($vehicle->vehicle_image));
            }

            // Upload the new image
            $filename = time() . "vehicle." . $file->getClientOriginalExtension();
            $path = 'uploads/vehicles';
            $file->move(public_path($path), $filename);
            $fullPath = $path . '/' . $filename;
        } else {
            // Keep the old image if no new image is uploaded
            $fullPath = $vehicle->vehicle_image;
        }

        // Update vehicle entry
        $vehicle->update([
            'vehicle_name' => $request->vehicle_name,
            'vehicle_type' => $vehicleType,
            'owner_name' => $request->owner_name,
            'owner_phn' => $request->owner_phn,
            'driver_name' => $request->driver_name,
            'driver_phn' => $request->driver_phn,
            'stall_no' => $request->stall_no,
            'vehicle_image' => $fullPath, // Save or retain the image path
        ]);
        // Redirect or respond as needed
        return redirect()->back()->with('success', 'Vehicle updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        // Find the vehicle by ID
        $vehicle = Vehicle::findOrFail($id);

        // Delete the old image if it exists
        if ($vehicle->vehicle_image && file_exists(public_path($vehicle->vehicle_image))) {
            unlink(public_path($vehicle->vehicle_image));
        }
        // Delete the vehicle record
        $vehicle->delete();

        // Redirect back with a success message
        return redirect()->back()->with('delete', 'Vehicle deleted successfully.');
    }
}
