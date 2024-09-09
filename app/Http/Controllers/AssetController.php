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
    public function create($id, $count, $room_type)
    {
        $resroom = Resroom::with(['unit.floor.block.building'])->findOrFail($id);
        return view('asset.asset_add', compact('resroom', 'count', 'room_type'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'room_no' => 'required|exists:resrooms,id',
            'room_id' => 'required|string',
            'assets.*.name' => 'required|string|max:255',
            'assets.*.quantity' => 'required|integer|min:1',
        ]);
    
        // Group assets by resroom_id and room_id
        $assetsGrouped = [];
    
        foreach ($request->input('assets') as $assetData) {
            $roomId = $request->input('room_id');
            $resroomId = $request->input('room_no');
    
            $key = $resroomId . '-' . $roomId;
    
            if (!isset($assetsGrouped[$key])) {
                $assetsGrouped[$key] = [
                    'resroom_id' => $resroomId,
                    'room_id' => $roomId,
                    'assets_details' => [],
                ];
            }
    
            $assetsGrouped[$key]['assets_details'][] = [
                'asset_name' => $assetData['name'],
                'quantity' => $assetData['quantity'],
            ];
        }
    
        // Check for existing entries
        foreach ($assetsGrouped as $assetsGroup) {
            $existingAsset = Asset::where('resroom_id', $assetsGroup['resroom_id'])
                ->where('room_id', $assetsGroup['room_id'])
                ->first();
    
            if ($existingAsset) {
                return redirect()->back()->with('error', 'An entry already exists.');
            }
        }
    
        // Save each group to the database
        foreach ($assetsGrouped as $assetsGroup) {
            Asset::updateOrCreate(
                [
                    'resroom_id' => $assetsGroup['resroom_id'],
                    'room_id' => $assetsGroup['room_id'],
                ],
                [
                    'assets_details' => json_encode($assetsGroup['assets_details']),
                ]
            );
        }
    
        return redirect()->back()->with('success', 'Assets saved successfully.');
    }
    
    /**
     * Display the specified resource.
     */
    public function show($id)
{
    // Fetch the asset data for the room based on the ID
    $assets = Asset::where('room_id', $id)->get();

    // Return a view or partial HTML to be loaded in the modal
    return view('asset.asset_view', compact('assets'));
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
