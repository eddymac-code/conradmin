<?php

namespace App\Http\Controllers;

use App\Models\Pool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PoolController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Gate::denies('pools.access')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        $pool = Pool::all();
        return view('pool.data', ['pool' => $pool]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Gate::denies('pools.create')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        return view('pool.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Gate::denies('pools.create')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
            'image' => 'mimes:jpg,jpeg,png'
        ]);

        $pool = new Pool();
        $pool->name = $request->name;
        $pool->about = $request->about;
        $pool->price = $request->price;

        if ($request->hasFile('image')) {
            $destination = 'public/images/pools';
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();
            $path = $image->storeAs($destination, $image_name);

            if ($path) {
                $pool->image = $image_name;
            }
        }

        $pool->save();

        return redirect()->route('pools')->with('message', 'Pool Added Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pool $pool)
    {
        if (Gate::denies('pools.view')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        return view('pool.show', ['pool' => $pool]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pool $pool)
    {
        if (Gate::denies('pools.update')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        return view('pool.edit', ['pool' => $pool]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pool $pool)
    {
        if (Gate::denies('pools.update')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
            'image' => 'mimes:jpg,jpeg,png'
        ]);

        $pool->name = $request->name;
        $pool->about = $request->about;
        $pool->price = $request->price;

        if ($request->hasFile('image')) {
            $destination = 'public/images/pools';
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();
            $path = $image->storeAs($destination, $image_name);

            if ($path) {
                $pool->image = $image_name;
            }
        }

        $pool->save();

        return redirect()->route('pools')->with('message', 'Pool Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pool $pool)
    {
        if (Gate::denies('pools.delete')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        $pool->delete();

        return redirect()->route('pools')->with('message', 'Pool Deleted.');
    }
}
