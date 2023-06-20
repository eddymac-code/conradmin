<?php

namespace App\Http\Controllers;

use App\Models\RoomExtra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RoomExtraController extends Controller
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

        $roomExtras = RoomExtra::all();

        return view('room.extra.data', [
            'roomExtras' => $roomExtras
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

        return view('room.extra.create');
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
            'name' => ['required'],
            'price' => ['required']
        ]);

        $roomExtra = new RoomExtra();
        $roomExtra->name = $request->name;
        $roomExtra->description = $request->description;
        $roomExtra->price = $request->price;
        $roomExtra->save();

        return redirect()->route('rooms.extras')->with('message', 'Room extra successfully saved');
    }

    /**
     * Display the specified resource.
     */
    public function show(RoomExtra $roomExtra)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RoomExtra $roomExtra)
    {
        if (Gate::denies('rooms.update')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        return view('room.extra.edit', [
            'roomExtra' => $roomExtra
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RoomExtra $roomExtra)
    {
        if (Gate::denies('rooms.update')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        $this->validate($request, [
            'name' => ['required'],
            'price' => ['required']
        ]);

        $roomExtra->name = $request->name;
        $roomExtra->description = $request->description;
        $roomExtra->price = $request->price;
        $roomExtra->save();

        return redirect()->route('rooms.extras')->with('message', 'Room extra successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RoomExtra $roomExtra)
    {
        if (Gate::denies('rooms.delete')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        $roomExtra->delete();

        return redirect()->route('rooms.extras')->with('message', 'Room extra deleted');
    }
}
