<?php

namespace App\Http\Controllers;

use App\Models\Parker;
use App\Models\Stall;
use App\Models\StallLocker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParkerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parkers = Parker:: where('company_id', Auth::user()->id)->get();
        $stalls = Stall::all(); 
        return view('parker.parker_list', compact('parkers', 'stalls'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $stalls = Stall::all(); // Fetch available stalls
        return view('parker.parker_add', compact('stalls'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'stall_no' => 'nullable',
        ]);

        // Determine the status based on stall assignment
        $status = $request->stall_no ? '1' : '0';
 
        // Generate the vehicle ID
        $lastParker = Parker::orderBy('created_at', 'desc')->first();
        $newParkerId = 'P' . str_pad(($lastParker ? intval(substr($lastParker->parker_no, 1)) + 1 : 1), 4, '0', STR_PAD_LEFT);
      
        // Create new parker
        Parker::create([
            'company_id' => Auth::user()->id,
            'parker_no' => $newParkerId,
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'stall_no' => $request->stall_no ?? null,
            'status' => $status,
        ]);

        return redirect()->back()->with('success', 'Parker added successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Parker $parker)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $parker = Parker::findOrFail($id);
        $stalls = Stall::all(); 

        return view('parker.parker_edit', compact('parker', 'stalls'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'stall_no' => 'nullable',
        ]);

        // Find the existing vehicle
        $parker = Parker::findOrFail($id);

        // Create new parker
        $parker->update([
            'parker_no' => $request->parker_no,
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'stall_no' => $request->stall_no ?? $parker->stall_no,
            'status' => $request->stall_no ? '1' : $parker->status,
        ]);

        return redirect()->back()->with('success', 'Parker updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $parker = Parker::findOrFail($id);

        $parker->delete();

        return redirect()->back()
            ->with('delete', 'parker deleted successfully.');
    }
}
