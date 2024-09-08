<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Block;
use App\Models\Resroom;
use Illuminate\Http\Request;

class AssetController extends Controller
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
    public function create($id,$count,$room_type)
    {
        $resroom = Resroom::with(['unit.floor.block.building'])->findOrFail($id);
        // $unit = $resroom->unit;
        // $floor = $unit->floor;
        // $block = $floor->block;
        // $building = $block->building;
        // $resrooms = Resroom::all(); // Fetch all resrooms for the dropdown
        return view('asset.asset_add', compact('resroom','count','room_type'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // // Validate the incoming request data
        // $request->validate([
        //     'room_no' => 'required|exists:resrooms,id',
        //     'room_id' => 'required|string',
        //     'assets.*.name' => 'required|string|max:255',
        //     'assets.*.quantity' => 'required|integer|min:1',
        // ]);

        // // Loop through the assets and store them
        // foreach ($request->input('assets') as $assetData) {
        //     Asset::create([
        //         'resroom_id' => $request->input('room_no'),
        //         'room_id' => $request->input('room_id'),
        //         'asset_name' => $assetData['name'],
        //         'quantity' => $assetData['quantity'],
        //     ]);
        // }

        // // Redirect back with success message
        // // return
        // //     ->with('success', 'Assets added successfully.');

        // Prepare the array for bulk insert
    $assets = [];
    
    foreach ($request->input('assets') as $assetData) {
        $assets[] = [
            'resroom_id' => $request->input('room_no'),
            'room_id' => $request->input('room_id'),
            'asset_name' => $assetData['name'],
            'quantity' => $assetData['quantity'],
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    // Bulk insert the assets
    Asset::insert($assets);

    return redirect()->back()->with('success', 'Assets saved successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Asset $asset)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Asset $asset)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Asset $asset)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Asset $asset)
    {
        //
    }
}
