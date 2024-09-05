<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Models\Comarea;
use App\Models\ComExtraField;
use Illuminate\Http\Request;

class ComareaController extends Controller
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
    public function create(Request $request)
    {
        $blockId = $request->query('block_id');
        $block = Block::findOrFail($blockId);
        $building = $block->building;

        // Return the view for adding a new common area under the block
        return view('comarea.comarea_add', compact('block', 'building'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       // Validation rules
       $request->validate([
        'block_id' => 'required|exists:blocks,id',
        'firelane_enabled' => 'nullable|boolean',
        'building_entrance_enabled' => 'nullable|boolean',
        'corridors_enabled' => 'nullable|boolean',
        'driveways_enabled' => 'nullable|boolean',
        'emergency_stairways_enabled' => 'nullable|boolean',
        'garden_enabled' => 'nullable|boolean',
        'hallway_enabled' => 'nullable|boolean',
        'loading_dock_enabled' => 'nullable|boolean',
        'lobby_enabled' => 'nullable|boolean',
        'parking_entrance_enabled' => 'nullable|boolean',
        'patio_enabled' => 'nullable|boolean',
        'rooftop_enabled' => 'nullable|boolean',
        'stairways_enabled' => 'nullable|boolean',
        'walkways_enabled' => 'nullable|boolean',
        'extra_fields.*.field_name' => 'nullable|string',
        'extra_fields.*.enabled' => 'nullable|boolean',
    ]);

    $blockId = $request->input('block_id');

    // Check if a common area entry already exists for this block
    $existingArea = Comarea::where('block_id', $blockId)->first();

    if ($existingArea) {
        return redirect()->back()->with('error', 'Common area entry has already been submitted for this block.');
    }

    // Create a new Common Area entry
    $comarea = new Comarea;
    $comarea->block_id = $blockId;
    $comarea->firelane = $request->has('firelane_enabled') ? 1 : 0;
    $comarea->building_entrance = $request->has('building_entrance_enabled') ? 1 : 0;
    $comarea->corridors = $request->has('corridors_enabled') ? 1 : 0;
    $comarea->driveways = $request->has('driveways_enabled') ? 1 : 0;
    $comarea->emergency_stairways = $request->has('emergency_stairways_enabled') ? 1 : 0;
    $comarea->garden = $request->has('garden_enabled') ? 1 : 0;
    $comarea->hallway = $request->has('hallway_enabled') ? 1 : 0;
    $comarea->loading_dock = $request->has('loading_dock_enabled') ? 1 : 0;
    $comarea->lobby = $request->has('lobby_enabled') ? 1 : 0;
    $comarea->parking_entrance = $request->has('parking_entrance_enabled') ? 1 : 0;
    $comarea->patio = $request->has('patio_enabled') ? 1 : 0;
    $comarea->rooftop = $request->has('rooftop_enabled') ? 1 : 0;
    $comarea->stairways = $request->has('stairways_enabled') ? 1 : 0;
    $comarea->walkways = $request->has('walkways_enabled') ? 1 : 0;
    $comarea->save();

    // Save extra fields
    foreach ($request->input('extra_fields', []) as $extraField) {
        if (isset($extraField['field_name']) && !empty($extraField['field_name'])) {
            ComExtraField::create([
                'comarea_id' => $comarea->id,
                'field_name' => $extraField['field_name'],
                'quantity' => isset($extraField['quantity']) ? $extraField['quantity'] : 0,
            ]);
        }
    }

    return redirect()->route('block.show', $blockId)->with('success', 'Common area entry added successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        
        $comarea = Comarea::findOrFail($id);
        $block = $comarea->block;
        $building = $block->building;

        return view('comarea.comarea_edit', compact('comarea', 'block', 'building'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $comarea = Comarea::with('extraFields')->findOrFail($id);

        // Validate incoming request
        $request->validate([
            'block_id' => 'required|exists:blocks,id',
            'firelane' => 'nullable|integer',
            'building_entrance' => 'nullable|integer',
            'corridors' => 'nullable|integer',
            'driveways' => 'nullable|integer',
            'emergency_stairways' => 'nullable|integer',
            'garden' => 'nullable|integer',
            'hallway' => 'nullable|integer',
            'loading_dock' => 'nullable|integer',
            'lobby' => 'nullable|integer',
            'parking_entrance' => 'nullable|integer',
            'patio' => 'nullable|integer',
            'rooftop' => 'nullable|integer',
            'stairways' => 'nullable|integer',
            'walkways' => 'nullable|integer',
            'extra_fields.*.field_name' => 'nullable|string',
            'extra_fields.*.quantity' => 'nullable|integer',
        ]);

        // Update basic fields
        $comarea->update([
            'firelane' => $request->firelane,
            'building_entrance' => $request->building_entrance,
            'corridors' => $request->corridors,
            'driveways' => $request->driveways,
            'emergency_stairways' => $request->emergency_stairways,
            'garden' => $request->garden,
            'hallway' => $request->hallway,
            'loading_dock' => $request->loading_dock,
            'lobby' => $request->lobby,
            'parking_entrance' => $request->parking_entrance,
            'patio' => $request->patio,
            'rooftop' => $request->rooftop,
            'stairways' => $request->stairways,
            'walkways' => $request->walkways,
        ]);

        // Handle the extra fields
        $extraFields = $request->extra_fields ?? [];

        // Remove any extra fields not in the request
        $comarea->extraFields()->whereNotIn('id', collect($extraFields)->pluck('id'))->delete();

        // Update or create new extra fields
        foreach ($extraFields as $extraFieldData) {
            if (isset($extraFieldData['id'])) {
                // Update existing field
                $extraField = $comarea->extraFields()->find($extraFieldData['id']);
                if ($extraField) {
                    $extraField->update([
                        'field_name' => $extraFieldData['field_name'],
                        'quantity' => $extraFieldData['quantity'],
                    ]);
                }
            } else {
                // Create new field
                $comarea->extraFields()->create([
                    'field_name' => $extraFieldData['field_name'],
                    'quantity' => $extraFieldData['quantity'],
                ]);
            }
        }

        return redirect()->route('block.show', $request->block_id)->with('success', 'Common area updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $comarea = Comarea::findOrFail($id);

        if (!$comarea) {
            return redirect()->back()->with('error', 'Common area not found.');
        }

        $comarea->delete();

        return redirect()->route('block.show', $comarea->block_id)->with('delete', 'Common area deleted successfully.');

    }
}
