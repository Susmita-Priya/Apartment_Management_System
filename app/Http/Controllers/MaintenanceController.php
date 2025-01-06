<?php

namespace App\Http\Controllers;

use App\Models\LandlordAgreement;
use App\Models\Maintenance;
use App\Models\TenantAgreement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->hasRole('Tenant')) {
            $maintenances = Maintenance::where('tenant_id', Auth::user()->id)->get();
        } else {
            $maintenances = Maintenance::all();
        }
        return view('maintenance.maintenance_list', compact('maintenances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $landlordAgreements = LandlordAgreement::with(['landlord', 'building', 'floor', 'unit'])->get();

        $landlords = $landlordAgreements->pluck('landlord')->unique('id');
        $buildings = $landlordAgreements->pluck('building')->unique('id');
        $floors = $landlordAgreements->pluck('floor')->unique('id');
        $units = $landlordAgreements->pluck('unit')->filter(function ($unit) {
            return $unit->status == 0;
        })->unique('id');

        return view('maintenance.maintenance_add', compact('landlordAgreements','landlords', 'buildings', 'floors', 'units'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        validator($request->all(), [
            'landlord_id' => 'required',
            'building_id' => 'required',
            'floor_id' => 'required',
            'unit_id' => 'required',
            'issue' => 'required',
        ]);

        $maintenance = new Maintenance();
        $maintenance->tenant_id = Auth::user()->id;
        $maintenance->landlord_id = $request->landlord_id;
        $maintenance->building_id = $request->building_id;
        $maintenance->floor_id = $request->floor_id;
        $maintenance->unit_id = $request->unit_id;
        $maintenance->issue = $request->issue;
        $maintenance->save();

        return redirect()->back()->with('success', 'Maintenance Request Sent Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Maintenance $maintenance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $maintenance = Maintenance::find($id);

        $landlordAgreements = LandlordAgreement::with(['landlord', 'building', 'floor', 'unit'])->get();

        $landlords = $landlordAgreements->pluck('landlord')->unique('id');
        $buildings = $landlordAgreements->pluck('building')->unique('id');
        $floors = $landlordAgreements->pluck('floor')->unique('id');
        $units = $landlordAgreements->pluck('unit')->filter(function ($unit) {
            return $unit->status == 0;
        })->unique('id');

        return view('maintenance.maintenance_edit', compact('maintenance', 'landlordAgreements','landlords', 'buildings', 'floors', 'units'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $maintenance = Maintenance::find($id);
        $maintenance->status = $request->status;
        $maintenance->save();
        return redirect()->back()->with('success', 'Maintenance Request Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Maintenance $maintenance)
    {
        //
    }
}
