<?php

namespace App\Http\Controllers;

use App\Models\Landlord;
use App\Models\Unit;
use App\Models\Unit_landlord;
use Illuminate\Http\Request;

class UnitLandlordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(String $id)
    {
        $unit = Unit::find($id);
        $landlords = Landlord::all();
        $assignments = Unit_landlord::where('unit_id', $id)->get();
        return view('unit.unit_landlord', compact('unit', 'landlords', 'assignments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Unit_landlord::create([
            'unit_id' => $request->unit_id,
            'landlord_id' => $request->landlord_id,
        ]);

        return redirect()->back()->with('success', 'Landlord assigned successfully.');
    }

    // Method to remove vehicle assignment
    public function removeLandlord($id)
    {
        $unit_landlord = Unit_landlord::findOrFail($id);
        
        $unit_landlord->delete();

        return back()->with('success', 'Landlord unassigned successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Unit_landlord $unit_landlord)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unit_landlord $unit_landlord)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Unit_landlord $unit_landlord)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unit_landlord $unit_landlord)
    {
        //
    }
}
