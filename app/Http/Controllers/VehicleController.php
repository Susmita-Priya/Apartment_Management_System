<?php

namespace App\Http\Controllers;

use App\Models\Stall;
use App\Models\StallLocker;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\vehicleType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicles = Vehicle::where('company_id', Auth::user()->id)->latest()->get();
        $stalls = Stall::where('company_id', Auth::user()->id)->get();
        return view('vehicle.vehicle_list', compact('vehicles', 'stalls'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Fetch all available stalls to display in the dropdown
        $stalls = Stall::where('company_id', Auth::user()->id)->get();
        $vehicleTypes = vehicleType::where('status', 1)->get();
        $vehicleOwners = User::whereHas('roles', function($query) {
            $query->whereIn('name', ['Tenant', 'Landlord']);
        })->get();
        return view('vehicle.vehicle_add', compact('stalls', 'vehicleTypes', 'vehicleOwners'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'registration_no' => 'required|max:255',
            'vehicle_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:1024', // Validate image file
            'stall_id' => 'nullable',
        ]);

        // Determine the status based on stall assignment
        $status = $request->stall_id ? '1' : '0';

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
            'company_id' => Auth::user()->id,
            'stall_id' => $request->stall_id,
            'vehicle_type_id' => $request->vehicle_type_id,
            'vehicle_owner_id' => $request->vehicle_owner_id,
            'vehicle_no' => $newVehicleId,
            'model' => $request->model,
            'registration_no' => $request->registration_no,
            'vehicle_image' =>  $fullPath, 
            'status' => $status,
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
        $stalls = Stall::where('company_id', Auth::user()->id)->get();
        $vehicleTypes = vehicleType::where('status', 1)->get();
        $vehicleOwners = User::whereHas('roles', function($query) {
            $query->whereIn('name', ['Tenant', 'Landlord']);
        })->get();

        return view('vehicle.vehicle_edit', compact('vehicle', 'stalls', 'vehicleTypes', 'vehicleOwners'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'registration_no' => 'required|max:255',
            'vehicle_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:1024', // Validate image file
            'stall_id' => 'nullable',
        ]);

        // Find the existing vehicle
        $vehicle = Vehicle::findOrFail($id);

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
            'stall_id' => $request->stall_id,
            'vehicle_type_id' => $request->vehicle_type_id,
            'vehicle_owner_id' => $request->vehicle_owner_id,
            'model' => $request->model,
            'registration_no' => $request->registration_no,
            'vehicle_image' => $fullPath,
            'status' => $request->stall_id ? '1' : $vehicle->status,
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
