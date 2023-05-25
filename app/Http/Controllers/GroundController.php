<?php

namespace App\Http\Controllers;

use App\Models\Ground;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class GroundController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Gate::denies('grounds.access')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        $ground = Ground::all();
        return view('ground.data', ['ground' => $ground]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Gate::denies('grounds.create')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        return view('ground.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Gate::denies('grounds.create')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
            'image' => 'mimes:jpg,jpeg,png'
        ]);

        $ground = new Ground();
        $ground->name = $request->name;
        $ground->about = $request->about;
        $ground->price = $request->price;

        if ($request->hasFile('image')) {
            $destination = 'public/images/grounds';
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();
            $path = $image->storeAs($destination, $image_name);

            if ($path) {
                $ground->image = $image_name;
            }
        }

        $ground->save();

        return redirect()->route('grounds')->with('message', 'Ground Added Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ground $ground)
    {
        if (Gate::denies('grounds.view')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        return view('ground.show', ['ground' => $ground]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ground $ground)
    {
        if (Gate::denies('grounds.update')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        return view('ground.edit', ['ground' => $ground]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ground $ground)
    {
        if (Gate::denies('grounds.create')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
            'image' => 'mimes:jpg,jpeg,png'
        ]);

        $ground->name = $request->name;
        $ground->about = $request->about;
        $ground->price = $request->price;

        if ($request->hasFile('image')) {
            $destination = 'public/images/grounds';
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();
            $path = $image->storeAs($destination, $image_name);

            if ($path) {
                $ground->image = $image_name;
            }
        }

        $ground->save();

        return redirect()->route('grounds')->with('message', 'Ground Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ground $ground)
    {
        if (Gate::denies('grounds.delete')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        $ground->delete();

        return redirect()->route('grounds')->with('message', 'Ground Deleted.');
    }
}
