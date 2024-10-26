<?php

namespace App\Http\Controllers;

use App\Models\Landlord;
use Illuminate\Support\Facades\Auth;
use App\Models\LeaseRequest;
use App\Models\Tenant;
use App\Models\Unit;
use Illuminate\Http\Request;

class LeaseRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $landlord = Landlord::where('email', Auth::user()->email)->first();
        $landlord_id = $landlord->id;
        $leaseRequests = LeaseRequest::where('landlord_id', $landlord_id)
                         ->where('status', 'Pending')
                         ->get();
        return view('lease.lease_request', compact('leaseRequests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function agreement()
    {
        $leaseRequests = LeaseRequest::where('status', 'Pending')->get();
        $tenant = Tenant::where('email', Auth::user()->email)->first();
        return view('lease.aggrement', compact('leaseRequests', 'tenant'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $tenant = Tenant::where('email', Auth::user()->email)->first();
        $tenant_id = $tenant->id;
        
        $request->validate([
            'start_date' => 'required', 
        ]);

        if (LeaseRequest::where('tenant_id', $tenant_id)->where('unit_id', $request->unit_id)->exists()) {
            return back()->with('error', 'You have already sent a lease request for this unit.');
        }

        LeaseRequest::create([
            'tenant_id' => $tenant_id,
            'landlord_id' => $request->landlord_id,
            'unit_id' => $request->unit_id,
            'start_date' => $request->start_date,
            'status' => 'pending',
        ]);

        Unit::where('id', $request->unit_id)->update(['status' => 'Pending']);

        return back()->with('success', 'Lease request sent successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(LeaseRequest $leaseRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LeaseRequest $leaseRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LeaseRequest $leaseRequest)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LeaseRequest $leaseRequest)
    {
        //
    }
}
