<?php

namespace App\Http\Controllers;

use App\Models\vehicleType;
use Illuminate\Http\Request;

class VehicleTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicleTypes = vehicleType::where('status', 1)->get();
        return view('vehicleType.vehicleType_list', compact('vehicleTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vehicleType.vehicleType_add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        vehicleType::create($request->all());

        return redirect()->back()
            ->with('success', 'Vehicle Type created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(vehicleType $vehicleType)
    {
        // return view('vehicleType.vehicleType_show', compact('vehicleType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $vehicleType = vehicleType::find($id);
        if ($vehicleType == null) {
            return redirect()->back()
                ->with('error', 'Vehicle Type not found.');
        }
        return view('vehicleType.vehicleType_edit', compact('vehicleType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $vehicleType = vehicleType::find($id);
        if ($vehicleType == null) {
            return redirect()->back()
                ->with('error', 'Vehicle Type not found.');
        }

        $request->validate([
            'name' => 'required',
        ]);

        $vehicleType->update($request->all());

        return redirect()->back()
            ->with('success', 'Vehicle Type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        vehicleType::find($id)->delete();

        return redirect()->back()
            ->with('success', 'Vehicle Type deleted successfully.');
    }
}
