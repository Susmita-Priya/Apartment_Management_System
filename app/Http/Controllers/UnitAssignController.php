<?php

namespace App\Http\Controllers;

use App\Models\Landlord;
use App\Models\Tenant;
use App\Models\Unit_assign;
use Illuminate\Http\Request;

class UnitAssignController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(String $id)
    {
        $unit = Unit_assign::with('unit')->get($id);
        $tenants = Tenant::all();
        $landlords = Landlord::all();
        return view('unit.unit_assign', compact('unit', 'tenants', 'landlords'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'unit_id' => 'required|exists:units,id',
            'tenant_id' => 'nullable|exists:tenants,id',
            'landlord_id' => 'nullable|exists:landlords,id',
        ]);

        Unit_assign::create([
            'unit_id' => $request->unit_id,
            'tenant_id' => $request->tenant_id,
            'landlord_id' => $request->landlord_id,
        ]);

        return redirect()->route('unit.index')->with('success', 'Unit assigned successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Unit_assign $unit_assign)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unit_assign $unit_assign)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Unit_assign $unit_assign)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unit_assign $unit_assign)
    {
        //
    }
}
