<?php

namespace App\Http\Controllers;

use App\Models\Amenity;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AmenityController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Gate::denies('roomtypes.access')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        $amenities = Amenity::all();
        
        return view('room.amenity.data', [
            'amenities' => $amenities
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Gate::denies('roomtypes.create')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        return view('room.amenity.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Gate::denies('roomtypes.create')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        $this->validate($request, [
            'name' => 'required'
        ]);

        $amenity = new Amenity();
        $amenity->name = $request->name;

        if ($request->hasFile('image')) {
            $destination = 'public/images/rooms/amenities';
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();
            $path = $image->storeAs($destination, $image_name);

            if ($path) {
                $amenity->image = $image_name;
            }
        }

        $amenity->save();

        return redirect()->route('amenities')->with('message', 'Amenity Successfully added!');
    }

    /**
     * Assign the specified resource.
     */
    public function show(Amenity $amenity)
    {
        if (Gate::denies('roomtypes.assign')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        $roomTypes = RoomType::all();

        return view('room.amenity.assign', [
            'amenity' => $amenity,
            'roomTypes' => $roomTypes
        ]);
    }

    /**
     * Assign the specified resource.
     */
    public function assignRoomtypes(Amenity $amenity, Request $request)
    {
        if (Gate::denies('roomtypes.assign')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        $assigned = $amenity->roomTypes()->sync($request->types);

        if ($assigned) {
            return redirect()->route('amenities.assign', $amenity)->with('message', "Room types assigned successfully!");
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Amenity $amenity)
    {
        if (Gate::denies('roomtypes.update')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        return view('room.amenity.edit', [
            'amenity' => $amenity
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Amenity $amenity)
    {
        if (Gate::denies('roomtypes.update')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        $this->validate($request, [
            'name' => 'required'
        ]);

        $data = [
            'name' => $request->name,
            'description' => $request->description
        ];

        if ($request->hasFile('image')) {
            $destination = 'public/images/rooms/amenities';
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();
            $path = $image->storeAs($destination, $image_name);

            if ($path) {
                $data['image'] = $image_name;
            }
        }

        $amenity->update($data);

        return redirect()->route('amenities')->with('message', 'Amenity Successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Amenity $amenity)
    {
        if (Gate::denies('roomtypes.delete')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        $amenity->delete();

        return redirect()->route('amenities')->with('message', 'Amenity Deleted!');
    }
}
