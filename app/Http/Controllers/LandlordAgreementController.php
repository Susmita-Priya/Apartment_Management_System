<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\Floor;
use App\Models\LandlordAgreement;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LandlordAgreementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $landlordAgreements = LandlordAgreement::all();
        return view('landlordAgreement.landlordAgreement_list', compact('landlordAgreements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $company = null;
        $landlord = null;
        $companies = User::whereHas('roles', function($query) {
            $query->where('name', 'Company');
        })->get();

        $landlords = User::whereHas('roles', function($query) {
            $query->where('name', 'Landlord');
        })->get();
        $company_id = Auth::user()->id;

     
        if (Auth::user()->hasRole('Landlord')) {
            $landlord = Auth::user();
            $company_id = $landlord->parent_id; 

        }elseif (Auth::user()->hasRole('Company')) {
            $company = Auth::user();
            $company_id = Auth::user()->id;
        }

        $buildings = Building::where('company_id', $company_id)->where('status',1)->get();
        $floors = Floor::where('type','upper')->where('status', 1)->get();
        $units = Unit::where('company_id', Auth::user()->id)->get();

        return view('landlordAgreement.landlordAgreement_add', compact('buildings', 'floors', 'units','landlords','companies','landlord','company'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 
        $request->validate([
            'amount' => 'required',
        ]);
        // dd($request->all());

        $landlordAgreement = new LandlordAgreement();
        $landlordAgreement->landlord_id = $request->landlord_id;
        $landlordAgreement->company_id = $request->company_id;
        $landlordAgreement->building_id = $request->building_id;
        $landlordAgreement->floor_id = $request->floor_id;
        $landlordAgreement->unit_id = $request->unit_id;
        if ($request->hasFile('document')) {
            $file = $request->file('document');
            $filename = time() . '_pdf.' . $file->getClientOriginalExtension();
            $path = 'uploads/pdfs';
            $file->move(public_path($path), $filename);
            $landlordAgreement->document = $path . '/' . $filename;
        }
        $landlordAgreement->amount = $request->amount;
        $landlordAgreement->status = 1;
        $landlordAgreement->save();

        return redirect()->back()->with('success', 'Landlord Agreement created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(LandlordAgreement $landlordAgreement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $landlordAgreement = LandlordAgreement::find($id);
        $companies = User::whereHas('roles', function($query) {
            $query->where('name', 'Company');
        })->get();

        $landlords = User::whereHas('roles', function($query) {
            $query->where('name', 'Landlord');
        })->get();

        $company_id = Auth::user()->id;
        $company = null;
        $landlord = null;

        if (Auth::user()->hasRole('Landlord')) {
            $landlord = Auth::user();
            $company_id = $landlord->parent_id; 
        }elseif (Auth::user()->hasRole('Company')) {
            $company = Auth::user();
        }

        $buildings = Building::where('company_id', $company_id)->where('status',1)->get();
        $floors = Floor::where('status', 1)->get();
        $units = Unit::where('company_id', Auth::user()->id)->get();

        return view('landlordAgreement.landlordAgreement_edit', compact('landlordAgreement', 'buildings', 'floors', 'units','landlords','companies','landlord','company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required',
        ]);

        $landlordAgreement = LandlordAgreement::find($id);
        $landlordAgreement->landlord_id = $request->landlord_id;
        $landlordAgreement->company_id = $request->company_id;
        $landlordAgreement->building_id = $request->building_id;
        $landlordAgreement->floor_id = $request->floor_id;
        $landlordAgreement->unit_id = $request->unit_id;
        if ($request->hasFile('document')) {

            if ($landlordAgreement->document && file_exists(public_path($landlordAgreement->document))) {
                unlink(public_path($landlordAgreement->document));
            }

            $file = $request->file('document');
            $filename = time() . '_pdf.' . $file->getClientOriginalExtension();
            $path = 'uploads/pdfs';
            $file->move(public_path($path), $filename);
            $fullPath = $path . '/' . $filename;
            $landlordAgreement->document = $fullPath;
        }

        $landlordAgreement->amount = $request->amount;
        $landlordAgreement->status = $request->status;
        $landlordAgreement->save();

        return redirect()->back()->with('success', 'Landlord Agreement updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $landlordAgreement = LandlordAgreement::find($id);
        $landlordAgreement->delete();
        return redirect()->back()->with('success', 'Landlord Agreement deleted successfully');
    }
  
}
