<?php

namespace App\Http\Controllers;

use App\Models\Bar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BarController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Gate::denies('bars.access')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        $bars = Bar::all();
        return view('bar.data', [
            'bars' => $bars
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Gate::denies('bars.create')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        return view('bar.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Gate::denies('bars.create')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        $this->validate($request, [
            'name' => 'required',
            'about' => 'required',
            'image' => 'mimes:jpg,jpeg,png'
        ]);

        $bar = new Bar();
        $bar->name = $request->name;
        $bar->about = $request->about;

        if($request->hasFile('image'))
        {
            $destination = 'public/images/bars';
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();
            $path = $image->storeAs($destination, $image_name);

            if($path){
                $bar->image = $image_name;
            }
        }

        $bar->save();

        return redirect()->route('bars')->with('message', 'Bar Created Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Bar $bar)
    {
        if (Gate::denies('bars.view')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        return view('bar.show', [
            'bar' => $bar
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bar $bar)
    {
        if (Gate::denies('bars.update')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        return view('bar.edit', [
            'bar' => $bar
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bar $bar)
    {
        if (Gate::denies('bars.update')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        $this->validate($request, [
            'name' => 'required',
            'about' => 'required',
            'image' => 'mimes:jpg,jpeg,png'
        ]);

        $sbar = Bar::find($bar->id);
        $sbar->name = $request->name;
        $sbar->about = $request->about;

        if($request->hasFile('image'))
        {
            $destination = 'public/images/bars';
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();
            $path = $image->storeAs($destination, $image_name);

            if($path){
                $sbar->image = $image_name;
            }
        }

        $sbar->save();

        return redirect()->route('bars')->with('message', 'Bar Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bar $bar)
    {
        if (Gate::denies('bars.delete')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        $bar->delete();

        return redirect()->route('bars')->with('message', 'Bar Deleted!');
    }
}
