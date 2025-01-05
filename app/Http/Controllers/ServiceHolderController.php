<?php

namespace App\Http\Controllers;

use App\Models\Landlord;
use App\Models\LandlordAgreement;
use App\Models\Service;
use App\Models\ServiceHolder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceHolderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::where('company_id', Auth::user()->id)->get();
        $serviceHolders = ServiceHolder::with('landlord')->where('company_id', Auth::user()->id)->get();

        return view('serviceHolder.serviceHolder_list', compact('serviceHolders','services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $landlordAgreements = LandlordAgreement::with('landlord')->get();
        $landlords = $landlordAgreements->pluck('landlord')->unique();

        $services = Service::where('company_id', Auth::user()->id)->get();
        return view('serviceHolder.serviceHolder_add', compact('landlordAgreements','services','landlords'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'phone' => 'required',
        ]);

        $serviceHolder = new ServiceHolder();
        $serviceHolder->company_id = Auth::user()->id;
        $serviceHolder->landlord_id = $request->landlord_id;
        $serviceHolder->name = $request->name;
        $serviceHolder->phone = $request->phone;
        $serviceHolder->email = $request->email;
        $serviceHolder->services_id = json_encode($request->services_id);
        $serviceHolder->note = $request->note;
        $serviceHolder->save();
        return redirect()->back()->with('success', 'Service Holder added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(ServiceHolder $serviceHolder)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $landlordAgreements = LandlordAgreement::with('landlord')->get();
        $landlords = $landlordAgreements->pluck('landlord')->unique();
        $services = Service::where('company_id', Auth::user()->id)->get();

        $serviceHolder = ServiceHolder::find($id);
        return view('serviceHolder.serviceHolder_edit', compact('landlordAgreements','services','landlords','serviceHolder'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'phone' => 'required',
            'services_id' => 'required',
        ]);

        $serviceHolder = ServiceHolder::find($id);
        $serviceHolder->company_id = Auth::user()->id;
        $serviceHolder->landlord_id = $request->landlord_id;
        $serviceHolder->name = $request->name;
        $serviceHolder->phone = $request->phone;
        $serviceHolder->email = $request->email;
        $serviceHolder->services_id = json_encode($request->services_id);
        $serviceHolder->note = $request->note;
        $serviceHolder->status = $request->status;
        $serviceHolder->save();
        return redirect()->back()->with('success', 'Service Holder updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $serviceHolder = ServiceHolder::find($id);
        $serviceHolder->delete();
        return redirect()->back()->with('success', 'Service Holder deleted successfully');
    }
}
