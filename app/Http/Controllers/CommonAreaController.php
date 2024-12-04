<?php

namespace App\Http\Controllers;

use App\Models\CommonArea;
use Illuminate\Http\Request;

class CommonAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $commonAreas = CommonArea::latest()->get();
        return view('commonArea.commonArea_list', compact('commonAreas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('commonArea.commonArea_add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);

        // Create the common area
        $commonArea = new CommonArea;
        $commonArea->name = $request->name;
        $commonArea->description = $request->description;
        $commonArea->save();

        return redirect()->back()->with('success', 'Common Area created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(CommonArea $commonArea)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $commonArea = CommonArea::find($id);
        return view('commonArea.commonArea_edit', compact('commonArea'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);

        $commonArea = CommonArea::find($id);
        $commonArea->name = $request->name;
        $commonArea->description = $request->description;
        $commonArea->status = $request->status;
        $commonArea->save();

        return redirect()->back()->with('success', 'Common Area updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $commonArea = CommonArea::find($id);
        $commonArea->delete();
        return redirect()->back()->with('success', 'Common Area deleted successfully.');
    }
    
}
