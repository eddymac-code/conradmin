<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConferenceFacility;
use Illuminate\Support\Facades\Gate;

class ConferenceFacilityController extends Controller
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
        if (Gate::denies('conferences.access')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        $facilities = ConferenceFacility::all();

        return view('conference_facilities.data', [
            'facilities' => $facilities
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Gate::denies('conferences.create')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        return view('conference_facilities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Gate::denies('conferences.create')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        $this->validate($request, [
            'name' => 'required',
            'type' => 'required',
            'about' => 'required',
            'capacity' => 'required',
            'price' => 'required',
            'image' => 'mimes:jpg,jpeg,png'
        ]);

        $facility = new ConferenceFacility();
        $facility->name = $request->name;
        $facility->type = $request->type;
        $facility->about = $request->about;
        $facility->capacity = $request->capacity;
        $facility->price = $request->price;

        if($request->hasFile('image'))
        {
            $destination = 'public/images/conference_facilities';
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();
            $path = $image->storeAs($destination, $image_name);

            if($path){
                $facility->image = $image_name;
            }
        }

        $facility->save();

        return redirect()->route('conferences')->with('message', 'Facility Created Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(ConferenceFacility $conferenceFacility)
    {
        if (Gate::denies('conferences.view')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        return view('conference_facilities.show', [
            'conferenceFacility' => $conferenceFacility
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ConferenceFacility $conferenceFacility)
    {
        if (Gate::denies('conferences.edit')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        return view('conference_facilities.edit', [
            'conferenceFacility' => $conferenceFacility
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ConferenceFacility $conferenceFacility)
    {
        if (Gate::denies('conferences.edit')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        $this->validate($request, [
            'name' => 'required',
            'type' => 'required',
            'about' => 'required',
            'capacity' => 'required',
            'price' => 'required',
            'image' => 'mimes:jpg,jpeg,png'
        ]);

        $facility = ConferenceFacility::find($conferenceFacility->id);
        $facility->name = $request->name;
        $facility->type = $request->type;
        $facility->about = $request->about;
        $facility->capacity = $request->capacity;
        $facility->price = $request->price;

        if($request->hasFile('image'))
        {
            $destination = 'public/images/conference_facilities';
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();
            $path = $image->storeAs($destination, $image_name);

            if($path){
                $facility->image = $image_name;
            }
        }

        $facility->save();

        return redirect()->route('conferences')->with('message', 'Facility Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ConferenceFacility $conferenceFacility)
    {
        if (Gate::denies('conferences.delete')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        $conferenceFacility->delete();
        return redirect()->route('conferences')->with('message', 'Facility Deleted!');
    }
}
