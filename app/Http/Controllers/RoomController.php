<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RoomController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']);
    }
    
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
        
        $roomTypes = RoomType::all();
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

        $this->validate($request, [
            'type' => 'required',
            'number' => 'required',
            'price' => 'required',
            'image' => 'mimes:jpg,jpeg,png'
        ]);

        $room = new Room();
        $room->type = $request->type;
        $room->number = $request->number;
        $room->name = $request->name;
        $room->description = $request->description;
        $room->price = $request->price;

        if ($request->hasFile('image')) {
            $destination = 'public/images/rooms';
            $image = $request->file('image');
            $image_name = date("YmdHis").$image->getClientOriginalName();
            $path = $image->storeAs($destination, $image_name);

            if ($path) {
                $room->image = $image_name;
            }
        }

        $room->save();

        return redirect()->route('rooms')->with('message', 'Room Added Successfully!');
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

        $roomtypes = RoomType::all();

        return view('room.edit', [
            'room' => $room,
            'roomTypes' => $roomtypes
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        if (Gate::denies('rooms.update')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        $this->validate($request, [
            'type' => 'required',
            'number' => 'required',
            'price' => 'required',
            'image' => 'mimes:jpg,jpeg,png'
        ]);

        $setroom = Room::find($room->id);
        $setroom->type = $request->type;
        $setroom->number = $request->number;
        $setroom->name = $request->name;
        $setroom->description = $request->description;
        $setroom->price = $request->price;

        if ($request->hasFile('image')) {
            $destination = 'public/images/rooms';
            $image = $request->file('image');
            $image_name = date("YmdHis").$image->getClientOriginalName();
            $path = $image->storeAs($destination, $image_name);

            if ($path) {
                $setroom->image = $image_name;
            }
        }

        $setroom->save();

        return redirect()->route('rooms')->with('message', 'Room Updated Successfully!');
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
