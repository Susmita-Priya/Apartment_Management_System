<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\LeaseRequest;
use Illuminate\Http\Request;

class LeaseRequestController extends Controller
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
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'landlord_id' => 'required|exists:users,id',
            'unit_id' => 'required|exists:units,id',
        ]);

        LeaseRequest::create([
            'tenant_id' => Auth::user()->id,
            'landlord_id' => $request->landlord_id,
            'unit_id' => $request->unit_id,
            'start_date' => $request->start_date,
            'status' => 'pending',
        ]);

        return response()->json(['message' => 'Lease request sent successfully!']);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LeaseRequest $leaseRequest)
    {
        //
    }
}
