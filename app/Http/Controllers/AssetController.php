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

        $roomModelClass = $roomModels[$room] ?? null;

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
            'assets.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // Image validation
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
            return redirect()->back()->with('error', 'An asset with the same room number already exists for this room.');
        }

        $assetsDetails = [];
        foreach ($request->assets as $index => $assetData) {
            $imagePath = null;

            if ($request->hasFile("assets.$index.image")) {
                $image = $request->file("assets.$index.image");

                // Check if the image size exceeds 100KB
                if ($image->getSize() > 102400) {
                    return redirect()->back()->with('error', 'Image size for asset ' . ($index + 1) . ' exceeds 100KB. Please upload a smaller image.');
                }

                $filename = time() . "_asset_{$index}." . $image->getClientOriginalExtension();
                $path = 'uploads/assets';
                $image->move(public_path($path), $filename);
                $imagePath = $path . '/' . $filename;
            }

            $assetsDetails[] = [
                'name' => $assetData['name'],
                'quantity' => $assetData['quantity'],
                'image' => $imagePath,
            ];
        }

        // Create or update asset for the polymorphic relationship
        Asset::create([
            'assetable_id' => $request->room_id,
            'assetable_type' => $roomModelClass,
            'room_no' => $request->room_no,    //bedroom1,bedroom2
            'assets_details' => json_encode($assetsDetails), // Include assets_details here
        ]);
        // dd(request()->all());
        return redirect()->back()->with('success', 'Assets added successfully!');
    }


    /**
     * Display the specified asset.
     */
    public function show($id)
    {
        $asset = Asset::findOrFail($id);
        $details = json_decode($asset->assets_details, true);
        return view('asset.asset_view', compact('details'));
    }

    /**
     * Show the form for editing the specified asset.
     */
    public function edit($id, Request $request)
    {
        $asset = Asset::findOrFail($id);

        // Decode the JSON string into an array
        $asset->assets_details = json_decode($asset->assets_details, true);

        // Determine the room instance for the breadcrumb navigation
        $roomModelClass = $asset->assetable_type;
        $roominstance = $roomModelClass::find($asset->assetable_id);
        $room = strtolower(class_basename($roomModelClass)); // Get room type like 'resroom'
        $roomId = $asset->assetable_id;
        $roomType = $result = preg_replace('/[0-9]/', '', $asset->room_no);

        return view('asset.asset_edit', compact('asset', 'roominstance', 'room', 'roomId', 'roomType'));
    }

    /**
     * Update the specified asset in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'room_no' => 'required|string',
            'assets.*.name' => 'required|string',
            'assets.*.quantity' => 'required|integer|min:1',
        ]);

        $asset = Asset::findOrFail($id);

        // Check for existing asset with the same assetsable_id and room_no, excluding the current asset
        $existingAsset = Asset::where('assetable_id', $asset->assetable_id)
            ->where('room_no', $request->room_no)
            ->where('id', '!=', $asset->id)
            ->first();

        if ($existingAsset) {
            return redirect()->back()->with('error', 'An asset with the same room number already exists for this room.');
        }

        // Prepare to collect asset data for bulk update
        $assetsDetails = [];

        // Decode the existing assets details to keep old images
        $existingAssetsDetails = json_decode($asset->assets_details, true);

        foreach ($request->assets as $index => $assetData) {
            $imagePath = null;

            // Check if there's a new image uploaded for this asset
            if ($request->hasFile("assets.{$index}.image")) {
                $image = $request->file("assets.{$index}.image");

                // Optional: Validate image size
                if ($image->getSize() > 102400) {
                    return redirect()->back()->with('error', 'Image size for asset ' . ($index + 1) . ' exceeds 100KB. Please upload a smaller image.');
                }

                // Delete the old image if it exists
                if (isset($existingAssetsDetails[$index]['image']) && file_exists(public_path($existingAssetsDetails[$index]['image']))) {
                    unlink(public_path($existingAssetsDetails[$index]['image']));
                }

                // Generate a unique filename and move the image
                $filename = time() . "_asset_{$index}." . $image->getClientOriginalExtension();
                $path = 'uploads/assets';
                $image->move(public_path($path), $filename);
                $imagePath = $path . '/' . $filename;
            } else {
                // If no new image, use old image path
                if (isset($existingAssetsDetails[$index]['image'])) {
                    $imagePath = $existingAssetsDetails[$index]['image'];
                }
            }

            // Collect the asset data
            $assetsDetails[] = [
                'id' => $index,
                'name' => $assetData['name'],
                'quantity' => $assetData['quantity'],
                'image' => $imagePath,
            ];
        }

        // Update asset
        $asset->update([
            'room_no' => $request->room_no, // Update room number
            'assets_details' => json_encode($assetsDetails), // Include assets_details here
        ]);

        return redirect()->back()->with('success', 'Assets updated successfully!');
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
