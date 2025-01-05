<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\Floor;
use App\Models\Landlord;
use App\Models\LandlordAgreement;
use App\Models\TenantAgreement;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TenantAgreementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->hasRole('Tenant')) {
            $tenantAgreements = TenantAgreement::where('tenant_id', Auth::user()->id)->where('status', 1)->get();
        } else {
            $tenantAgreements = TenantAgreement::where('status', 1)->get();
        }
        return view('tenantAgreement.tenantAgreement_list', compact('tenantAgreements'));
    }

    public function pending()
    {
        $tenantAgreements = null;
        if (Auth::user()->hasRole('Tenant')) {
            $tenantAgreements = TenantAgreement::where('tenant_id', Auth::user()->id)->where('status', 0)->get();
        } else {
        $tenantAgreements = TenantAgreement::where('status', 0)->get(); 
        }
        return view('tenantAgreement.tenantAgreement_pending', compact('tenantAgreements'));
    }

    public function approve(string $id)
    {
        $tenantAgreement = TenantAgreement::find($id);
        $unit = Unit::find($tenantAgreement->unit_id);
        if (!is_null($tenantAgreement)) {
            $tenantAgreement->status = 1;
            $unit->status = 2;
            $tenantAgreement->save();
            $unit->save();
        }
        return redirect()->back()->with('success', 'Agreement Approved Successfully!');
    }

    public function reject(string $id)
    {
        $tenantAgreements = TenantAgreement::find($id);
        if (!is_null($tenantAgreements)) {
            $tenantAgreements->status = 2;
            $tenantAgreements->save();
        }
        return redirect()->back()->with('success', 'Agreement Rejected');
    }

    public function rejectList()
    {
        if (Auth::user()->hasRole('Tenant')) {
            $tenantAgreements = TenantAgreement::where('tenant_id', Auth::user()->id)
                ->where('status', 2)
                ->latest()
                ->get();
        } else {
            $tenantAgreements = TenantAgreement::where('status', 2)
                ->latest()
                ->get();
        }
        return view('tenantAgreement.tenantAgreement_reject_list', compact('tenantAgreements'));
    }


    public function create()
    {
        $landlordAgreements = LandlordAgreement::with(['landlord', 'building', 'floor', 'unit'])->get();

        $landlords = $landlordAgreements->pluck('landlord')->unique('id');
        $buildings = $landlordAgreements->pluck('building')->unique('id');
        $floors = $landlordAgreements->pluck('floor')->unique('id');
        $units = $landlordAgreements->pluck('unit')->filter(function ($unit) {
            return $unit->status == 0;
        })->unique('id');

    return view('tenantAgreement.tenantAgreement_create', compact('landlordAgreements','landlords', 'buildings', 'floors', 'units'));
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
            'rent' => 'required',
            'rent_advance_received' => 'required',
            'lease_start_date' => 'required',
            'lease_end_date' => 'required',
            'status' => 'required'
        ]);

        $tenantAgreement = new TenantAgreement();
        $tenantAgreement->landlord_id = $request->landlord_id;
        $tenantAgreement->tenant_id = Auth::user()->id;
        $tenantAgreement->building_id = $request->building_id;
        $tenantAgreement->floor_id = $request->floor_id;
        $tenantAgreement->unit_id = $request->unit_id;
        if ($request->hasFile('document')) {
            $file = $request->file('document');
            $filename = time() . '_pdf.' . $file->getClientOriginalExtension();
            $path = 'uploads/tenantpdfs';
            $file->move(public_path($path), $filename);

            $fullpath = $path . '/' . $filename;
            $tenantAgreement->document = $fullpath;
        }
        $tenantAgreement->rent = $request->rent;
        $tenantAgreement->rent_advance_received = $request->rent_advance_received;
        $tenantAgreement->lease_start_date = $request->lease_start_date;
        $tenantAgreement->lease_end_date = $request->lease_end_date;
        $tenantAgreement->save();

        $unit = Unit::find($request->unit_id);
        $unit->status = 1;
        $unit->save();

        return redirect()->back()->with('success', 'Tenant Agreement Request send successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
