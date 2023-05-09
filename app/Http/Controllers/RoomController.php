<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Gate::denies('rooms.access')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        $rooms = Room::paginate(10);

        return view('room.data', [
            'rooms' => $rooms
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Gate::denies('rooms.create')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }
        
        $roomTypes = ['Standard','Executive','Deluxe'];
        return view('room.create', [
            'roomTypes' => $roomTypes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Gate::denies('rooms.create')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        if (Gate::denies('rooms.view')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        if (Gate::denies('rooms.update')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        if (Gate::denies('rooms.update')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        if (Gate::denies('rooms.delete')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }
    }
}
