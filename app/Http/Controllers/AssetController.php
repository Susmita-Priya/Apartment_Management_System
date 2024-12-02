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
        return view('asset.asset_list', compact('assets'));
    }

    /**
     * Show the form for creating a new asset.
     */
    public function create()
    {

        return view('asset.asset_add');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'nullable|image', 
        ]);

        // Handle the image upload if present
        if ($request->hasFile('image')) {
            $file = $request->file('image');

            // Check if the image size exceeds 100KB (102400 bytes)
            if ($file->getSize() > 102400) {
                return redirect()->back()->with('error', 'Image size exceeds 100KB. Please upload a smaller image.');
            }

            $filename = time() . "_asset." . $file->getClientOriginalExtension();
            $path = 'uploads/assets';
            $file->move(public_path($path), $filename); // Move to 'public/uploads/buildings' directly
            $fullPath = $path . '/' . $filename;
        } else {
            $fullPath = null;
        }

        // Create the asset
        $asset = new Asset;
        $asset->name = $request->name;
        $asset->image = $fullPath;
        $asset->short_description = $request->short_description;
        $asset->save();

        return redirect()->back()->with('success', 'Assets added successfully!');
    }


    /**
     * Display the specified asset.
     */
    public function show($id)
    {
        $assets = Asset::findOrFail($id);
        return view('asset.asset_list', compact('assets'));
    }

    /**
     * Show the form for editing the specified asset.
     */
    public function edit($id, Request $request)
    {
        $asset = Asset::findOrFail($id);

        return view('asset.asset_edit', compact('asset'));
    }

    /**
     * Update the specified asset in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required',
            'image' => 'nullable|image', 
        ]);

        // Find the building to update
        $asset = Asset::findOrFail($id);

        // Handle the image upload if present
        if ($request->hasFile('image')) {
            $file = $request->file('image');

            // Check if the image size exceeds 100KB (102400 bytes)
            if ($file->getSize() > 102400) {
                return redirect()->back()->with('error', 'Image size exceeds 100KB. Please upload a smaller image.');
            }

            // Delete the old image if it exists
            if ($asset->image && file_exists(public_path($asset->image))) {
                unlink(public_path($asset->image));
            }

            // Upload the new image
            $filename = time() . "asset." . $file->getClientOriginalExtension();
            $path = 'uploads/assets';
            $file->move(public_path($path), $filename);
            $fullPath = $path . '/' . $filename;
        } else {
            // Keep the old image if no new image is uploaded
            $fullPath = $asset->image;
        }

        // Update the asset record
        $asset->name = $request->name;
        $asset->short_description = $request->short_description;
        $asset->image = $fullPath;
        $asset->status = $request->status;
        $asset->save();

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
