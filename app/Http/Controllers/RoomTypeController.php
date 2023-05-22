<?php

namespace App\Http\Controllers;

use App\Models\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RoomTypeController extends Controller
{
    public function __construct()
    {
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
        
        $roomTypes = RoomType::all();

        return view('room.type.data', [
            'roomTypes' => $roomTypes
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
        
        return view('room.type.create');
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
            'name' => 'required',
        ]);

        $type = new RoomType();
        $type->name = $request->name;
        $type->description = $request->description;

        if ($request->hasFile('image')) {
            $destination = 'public/images/rooms/types';
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();
            $path = $image->storeAs($destination, $image_name);

            if ($path) {
                $type->image = $image_name;
            }
        }

        $type->save();

        return redirect()->route('rooms.types')->with('message', 'Successfully added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(RoomType $roomType)
    {
        if (Gate::denies('roomtypes.view')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }
        
        return view('room.type.show', [
            'roomType' => $roomType
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RoomType $roomType)
    {
        if (Gate::denies('roomtypes.update')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }
        
        return view('room.type.edit', [
            'roomType' => $roomType
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RoomType $roomType)
    {
        if (Gate::denies('roomtypes.update')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }
        
        $this->validate($request, [
            'name' => 'required',
        ]);

        $type = RoomType::find($roomType->id);
        $type->name = $request->name;
        $type->description = $request->description;

        if ($request->hasFile('image')) {
            $destination = 'public/images/rooms/types';
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();
            $path = $image->storeAs($destination, $image_name);

            if ($path) {
                $type->image = $image_name;
            }
        }

        $type->save();

        return redirect()->route('rooms.types')->with('message', 'Successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RoomType $roomType)
    {
        if (Gate::denies('roomtypes.delete')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }
        
        $roomType->delete();

        return redirect()->route('rooms.types')->with('message', 'Deleted!');
    }
}
