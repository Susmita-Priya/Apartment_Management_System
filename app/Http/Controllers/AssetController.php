<?php

namespace App\Http\Controllers;

use App\Models\Adroom;
use App\Models\Amroom;
use App\Models\Asset;
use App\Models\Block;
use App\Models\Comroom;
use App\Models\Mechroom;
use App\Models\Resroom;
use App\Models\Serroom;
use App\Models\StallLocker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AssetController extends Controller
{
   
    public function index()
    {
        $assets = Asset::all();
        return view('assets.index', compact('assets'));
    }

    /**
     * Show the form for creating a new asset.
     */
    public function create(Request $request)
    {
        // Retrieve form data
        $roomId = $request->input('id');
        $roomType = $request->input('room_type');
        $count = $request->input('count');
        $room = $request->input('room');

   // Mapping room types to models
   $roomModels = [
    "resroom" => Resroom::class,
    "comroom" => Comroom::class,
    "mechroom" => Mechroom::class,
    "adroom" => Adroom::class,
    "amroom" => Amroom::class,
    "serroom" => Serroom::class,
];

    $roomModelClass = $roomModels[$room]??null;

    // Find the room and its related entities
    $roominstance = $roomModelClass::find($roomId);
        return view('asset.asset_add', compact('roomId', 'roomType', 'count', 'room', 'roominstance'));
    }

    


public function store(Request $request)
{
    $request->validate([
        'room_type' => 'required|string',
        'room' => 'required|string',
        'room_id' => 'required|integer',
        'room_no' => 'required|string',
        'assets.*.name' => 'required|string',
        'assets.*.quantity' => 'required|integer|min:1',
    ]);

    // Mapping room types to models
    $roomModels = [
        'resroom' => Resroom::class,
        'comroom' => Comroom::class,
        'mechroom' => Mechroom::class,
        'adroom' => Adroom::class,
        'amroom' => Amroom::class,
        'serroom' => Serroom::class,
    ];

    // Get the model class for the room type
    $roomModelClass = $roomModels[$request->room] ?? null;

    if (!$roomModelClass || !$roomModelClass::find($request->room_id)) {
        return redirect()->back()->withErrors('Invalid room or room type.');
    }

    // Check for existing asset with the same assetsable_id and room_no
    $existingAsset = Asset::where('assetable_id', $request->room_id)
                          ->where('room_no', $request->room_no)
                          ->first();

    if ($existingAsset) {
        return redirect()->back()->with('error','An asset with the same room number already exists for this room.');
    }

    // Prepare assets details as an array
    $assetsDetails = array_map(function($assetData) {
        return [
            'name' => $assetData['name'],
            'quantity' => $assetData['quantity'],
        ];
    }, $request->assets);

    // Create or update asset for the polymorphic relationship
    Asset::create([
        'assetable_id' => $request->room_id,
        'assetable_type' => $roomModelClass,
        'room_no' => $request->room_no,    //bedroom1,bedroom2
        'assets_details' => json_encode($assetsDetails), // Include assets_details here
    ]);
// dd(request()->all());
    return redirect()->back()->with('success', 'Assets added/updated successfully!');
}


    /**
     * Display the specified asset.
     */
    public function show($id)
    {
        $assets = Asset::findOrFail($id);
        return view('asset.asset_view', compact('assets'));
    }

    /**
     * Show the form for editing the specified asset.
     */
    public function edit($id)
    {
        $asset = Asset::findOrFail($id);
        return view('asset.asset_edit', compact('asset'));
    }

    /**
     * Update the specified asset in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'assets.*.name' => 'required|string',
            'assets.*.quantity' => 'required|integer|min:1',
        ]);

        $asset = Asset::findOrFail($id);
        $asset->assets_details = json_encode([
            'name' => $request->input('assets.0.name'),
            'quantity' => $request->input('assets.0.quantity'),
        ]);

        $asset->save();

        return redirect()->back()->with('success', 'Asset updated successfully!');
    }

    /**
     * Remove the specified asset from storage.
     */
    public function destroy($id)
    {
        $asset = Asset::findOrFail($id);
        $asset->delete();

        return redirect()->back()->with('success', 'Asset deleted successfully!');
    }
}
