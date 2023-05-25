<?php

namespace App\Http\Controllers;

use App\Models\Gym;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class GymController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Gate::denies('gyms.access')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        $gym = Gym::all();
        return view('gym.data', ['gym' => $gym]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Gate::denies('gyms.create')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        return view('gym.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Gate::denies('gyms.create')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
            'image' => 'mimes:jpg,jpeg,png'
        ]);

        $gym = new Gym();
        $gym->name = $request->name;
        $gym->about = $request->about;
        $gym->price = $request->price;

        if ($request->hasFile('image')) {
            $destination = 'public/images/gyms';
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();
            $path = $image->storeAs($destination, $image_name);

            if ($path) {
                $gym->image = $image_name;
            }
        }

        $gym->save();

        return redirect()->route('gyms')->with('message', 'Gym Added Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Gym $gym)
    {
        if (Gate::denies('gyms.view')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        return view('gym.show', ['gym' => $gym]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gym $gym)
    {
        if (Gate::denies('gyms.update')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        return view('gym.edit', ['gym' => $gym]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gym $gym)
    {
        if (Gate::denies('gyms.update')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
            'image' => 'mimes:jpg,jpeg,png'
        ]);

        $gym->name = $request->name;
        $gym->about = $request->about;
        $gym->price = $request->price;

        if ($request->hasFile('image')) {
            $destination = 'public/images/gyms';
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();
            $path = $image->storeAs($destination, $image_name);

            if ($path) {
                $gym->image = $image_name;
            }
        }

        $gym->save();

        return redirect()->route('gyms')->with('message', 'Gym Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gym $gym)
    {
        if (Gate::denies('gyms.delete')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        $gym->delete();

        return redirect()->route('gyms')->with('message', 'Gym Deleted.');
    }
}
