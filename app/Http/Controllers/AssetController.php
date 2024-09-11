<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Block;
use App\Models\Comroom;
use App\Models\Resroom;
use App\Models\StallLocker;
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
    // public function create($id, $count, $room_type)
    // {
    //     // // Try to find the Resroom or Comroom based on the ID
    //     // $resroom = Resroom::with(['unit.floor.block.building'])->find($id);
    //     // $comroom = Comroom::with(['unit.floor.block.building'])->find($id);

    //     // // Determine which room is available and send it in one variable
    //     // $room = $resroom ?? $comroom; // If $resroom is not null, use it; otherwise, use $comroom

    //     // if (!$room) {
    //     //     // Handle the case where neither room is found
    //     //     return redirect()->back()->with('error', 'Room not found');
    //     // }

    //     // // Determine the type of room (for additional checks if needed)
    //     // $buil_type = $resroom ? 'resroom' : 'comroom';

    //     // // Pass only one room variable to the view
    //     // return view('asset.asset_add', compact('room', 'buil_type','room_type', 'count'));

    //     $resrooms = Resroom::all();
    //     $comrooms = Comroom::all();
    //     $stallLockers = StallLocker::all();

    //     return view('assets.create', compact('resrooms', 'comrooms', 'stallLockers'));
    // }


    public function create($id, $count, $room_type)
{
    // Fetch relevant data for the view
    $resrooms = Resroom::all();
    $comrooms = Comroom::all();
    $stallLockers = StallLocker::all();
    
    // Fetch a room if you have an id and room_type to identify it
    $room = null;
    if ($room_type == 'resroom') {
        $room = Resroom::with(['unit.floor.block.building'])->findOrFail($id);
    } elseif ($room_type == 'comroom') {
        $room = Comroom::with(['unit.floor.block.building'])->findOrFail($id);
    } elseif ($room_type == 'stall_locker') {
        $room = StallLocker::with(['floor.block.building'])->findOrFail($id);
    }

    // Pass room information to the view
    return view('asset.asset_add', compact('resrooms', 'comrooms', 'stallLockers', 'room_type', 'id', 'count', 'room'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|string',
            'room_no' => 'required|exists:stalls_lockers,id,|nullable',
            'resroom_id' => 'nullable|exists:resrooms,id',
            'comroom_id' => 'nullable|exists:comrooms,id',
            'stall_locker_id' => 'nullable|exists:stalls_lockers,id',
            'assets.*.name' => 'required|string|max:255',
            'assets.*.quantity' => 'required|integer|min:1',
        ]);

        // Determine the type of room/stall and set the foreign key accordingly
        $roomType = $request->input('room_type');
        $foreignKey = $request->input("{$roomType}_id");
        
        // Group assets by room type and identifier
        $assetsGrouped = [];

        foreach ($request->input('assets') as $assetData) {
            $key = $request->input('room_no') . '-' . $request->input('room_id');

            if (!isset($assetsGrouped[$key])) {
                $assetsGrouped[$key] = [
                    'room_stall_id' => $request->input('room_no'),
                    'room_id' => $request->input('room_id'),
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
            $existingAsset = Asset::where('room_stall_id', $assetsGroup['room_stall_id'])
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
                    'room_stall_id' => $assetsGroup['room_stall_id'],
                    'room_id' => $assetsGroup['room_id'],
                ],
                [
                    'resroom_id' => $roomType == 'resroom' ? $foreignKey : null,
                    'comroom_id' => $roomType == 'comroom' ? $foreignKey : null,
                    'stall_locker_id' => $roomType == 'stall_locker' ? $foreignKey : null,
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
        $assets = Asset::where('room_id', $id)->get();

        // Decode JSON manually (if not casting properly)
        foreach ($assets as $asset) {
            $asset->assets_details = json_decode($asset->assets_details, true);
        }

        return view('asset.asset_view', compact('assets'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, $room_type)
    {
        $asset = Asset::findOrFail($id);
        $resroom = Resroom::find($asset->resroom_id);
        $comroom = Comroom::find($asset->comroom_id);
        $stallLocker = StallLocker::find($asset->stall_locker_id);

        // Determine which room is available and send it in one variable
        $room = $resroom ?? $comroom ?? $stallLocker;

        if (!$room) {
            return redirect()->back()->with('error', 'Room not found');
        }

        // Decode JSON if assets_details is stored as a JSON string
        if (is_string($asset->assets_details)) {
            $asset->assets_details = json_decode($asset->assets_details, true);
        }

        return view('asset.edit', compact('room', 'asset', 'room_type'));
    }

    /**
     * Update the specified asset in storage.
     */
    public function update(Request $request, $id, $room_type)
    {
        $request->validate([
            'assets.*.name' => 'required|string|max:255',
            'assets.*.quantity' => 'required|integer|min:1',
        ]);

        $asset = Asset::findOrFail($id);

        // Update the asset details
        $assetDetails = [];
        foreach ($request->input('assets') as $assetData) {
            $assetDetails[] = [
                'asset_name' => $assetData['name'],
                'quantity' => $assetData['quantity'],
            ];
        }

        $asset->update([
            'assets_details' => json_encode($assetDetails),
        ]);

        return redirect()->route('asset.show', ['id' => $asset->room_id])
            ->with('success', 'Assets updated successfully.');
    }

    /**
     * Remove the specified asset from storage.
     */
    public function destroy($id)
    {
        $asset = Asset::findOrFail($id);    
        $asset->delete();

        return redirect()->back()->with('delete', 'Asset deleted successfully.');
    }
}
