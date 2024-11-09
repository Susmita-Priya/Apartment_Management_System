<?php

namespace App\Http\Controllers;

use App\Models\Landlord;
use Illuminate\Support\Facades\Auth;
use App\Models\LeaseRequest;
use App\Models\Tenant;
use App\Models\Unit;
use App\Models\Unit_landlord;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

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
        $tenant = Tenant::where('email', Auth::user()->email)->first();
        $tenant_id = $tenant->id;
        $leaseRequests = LeaseRequest::where('tenant_id', $tenant_id)->where('agreement', 1)->get();
        if ($leaseRequests->isEmpty()) {
            return back()->with('error', 'No lease agreement found.');
        }
        return view('lease.aggrement', compact('leaseRequests', 'tenant'));
    }

    public function sendagreement($id)
    {
        $leaseRequests = LeaseRequest::findOrFail($id);
        $leaseRequests->agreement = 1;
        $leaseRequests->save();
        return back()->with('success', 'Agreement sent successfully.');
    }


    public function agreementform(Request $request, $tenant_id)
    {
        $leaseRequests = LeaseRequest::where('tenant_id', $tenant_id)->where('status','pending')->where('agreement',1)->first();
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = 'uploads/pdf';
            $file->move(public_path($path), $filename); // Move to 'public/uploads/images' directly
            $fullPath = $path . '/' . $filename;
            $leaseRequests->agreement_path = $fullPath;
            $leaseRequests->save();
            return back()->with('success', 'Agreement sent successfully.');
        } else {
            $fullPath = null;
            return back()->with('error', 'No file selected.');
        }

        // return view('lease.agreement_form', compact('leaseRequests'));
    }

    public function downloadAgreement($id)
    {
        $leaseRequest = LeaseRequest::findorFail($id);

        // Check if the agreement file exists
        if (!$leaseRequest || !$leaseRequest->agreement_path) {
            return back()->with('error', 'Agreement not found.');
        }

        $filePath = public_path($leaseRequest->agreement_path);

        if (file_exists($filePath)) {
            return response()->download($filePath);
        } else {
            return back()->with('error', 'File not found.');
        }
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

        $unit_landlord = Unit_landlord::where('unit_id', $request->unit_id);
        // dd($unit_landlord);
        if (!$unit_landlord->exists()) {
            return back()->with('error', 'No landlord assigned for this unit. Please contact the admin.');
        }


        LeaseRequest::create([
            'tenant_id' => $tenant_id,
            'landlord_id' => $request->landlord_id,
            'unit_id' => $request->unit_id,
            'start_date' => $request->start_date,
            'status' => 'Pending',
        ]);

        Unit::where('id', $request->unit_id)->update(['status' => 'Pending']);

        return back()->with('success', 'Lease request sent successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function accept($id)
    {
        $leaseRequest = LeaseRequest::findOrFail($id);
        $leaseRequest->status = 'approved';
        $leaseRequest->agreement = 0;
        $leaseRequest->save();

        Unit::where('id', $leaseRequest->unit_id)->update(['status' => 'Occupied']);

        return back()->with('success', 'Lease request accepted successfully.');
    }

    public function reject($id)
    {
        $leaseRequest = LeaseRequest::findOrFail($id);

        $unit_id = $leaseRequest->unit_id;

        Unit::where('id', $unit_id)->update(['status' => 'Vacant']);
        $leaseRequest->delete();

        return back()->with('success', 'Lease request rejected successfully.');
    }
}
