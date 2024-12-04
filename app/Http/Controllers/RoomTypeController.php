<?php

namespace App\Http\Controllers;

use App\Models\roomType;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roomTypes = roomType::all();
        return view('roomType.roomType_list', compact('roomTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('roomType.roomType_add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        roomType::create($request->all());

        return redirect()->back()
            ->with('success', 'Room Type created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(roomType $roomType)
    {
        // return view('roomType.roomType_show', compact('roomType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $roomType = roomType::find($id);
        if ($roomType == null) {
            return redirect()->back()
                ->with('error', 'Room Type not found.');
        }
        return view('roomType.roomType_edit', compact('roomType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $roomType = roomType::find($id);
        if ($roomType == null) {
            return redirect()->back()
                ->with('error', 'Room Type not found.');
        }

        $request->validate([
            'name' => 'required',
        ]);

        $roomType->update($request->all());

        return redirect()->back()
            ->with('success', 'Room Type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(roomType $roomType)
    {
        $roomType->delete();

        return redirect()->back()
            ->with('success', 'Room Type deleted successfully.');
    }
}
