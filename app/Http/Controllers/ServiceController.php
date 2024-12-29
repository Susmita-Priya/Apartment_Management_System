<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::where('company_id', Auth::user()->id)
            ->where('status', 1)
            ->latest()
            ->get();
        return view('service.service_list', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('service.service_add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
        ]);

        $service = new Service();
        $service->company_id = Auth::user()->id;
        $service->name = $request->name;
        $service->price = $request->price;
        $service->note = $request->note;
        $service->save();

        return redirect()->back()
            ->with('success', 'Service created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $service = Service::find($id);
        if ($service == null) {
            return redirect()->back()
                ->with('error', 'Service not found.');
        }
        return view('service.service_edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
        ]);

        $service = Service::find($id);
        $service->name = $request->name;
        $service->price = $request->price;
        $service->note = $request->note;
        $service->status = $request->status;
        $service->save();

        return redirect()->back()
            ->with('success', 'Service updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $service = Service::find($id);
        if ($service == null) {
            return redirect()->back()
                ->with('error', 'Service not found.');
        }
        $service->delete();

        return redirect()->back()
            ->with('success', 'Service deleted successfully.');
    }
}
