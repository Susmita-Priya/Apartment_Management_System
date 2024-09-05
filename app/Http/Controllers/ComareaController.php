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
            'extra_fields.*.quantity' => 'nullable|integer|min:0',
        ]);
    
        $blockId = $request->input('block_id');
    
        // Retrieve the existing common area
        $comarea = Comarea::findOrFail($id);
    
        // Update Common Area fields
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
    
        // Sync Extra Fields
        $existingExtraFields = $comarea->extraFields->pluck('id')->toArray();
        $newExtraFields = $request->input('extra_fields', []);
    
        // Update or create new extra fields
        foreach ($newExtraFields as $extraField) {
            if (isset($extraField['field_name']) && !empty($extraField['field_name'])) {
                if (isset($extraField['id'])) {
                    // Update existing extra field
                    $comExtraField = ComExtraField::find($extraField['id']);
                    if ($comExtraField) {
                        $comExtraField->update([
                            'field_name' => $extraField['field_name'],
                            'quantity' => isset($extraField['quantity']) ? $extraField['quantity'] : 0,
                        ]);
                    }
                    // Remove from the list of existing fields to be deleted later
                    $existingExtraFields = array_diff($existingExtraFields, [$extraField['id']]);
                } else {
                    // Create new extra field
                    ComExtraField::create([
                        'comarea_id' => $comarea->id,
                        'field_name' => $extraField['field_name'],
                        'quantity' => isset($extraField['quantity']) ? $extraField['quantity'] : 0,
                    ]);
                }
            }
        }
    
        // Delete removed extra fields
        ComExtraField::whereIn('id', $existingExtraFields)->delete();
    
        return redirect()->route('block.show', $blockId)->with('success', 'Common area entry updated successfully.');
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
