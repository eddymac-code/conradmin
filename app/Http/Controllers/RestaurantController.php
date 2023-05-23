<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RestaurantController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Gate::denies('restaurants.access')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        $restaurants = Restaurant::all();
        return view('restaurant.data', [
            'restaurants' => $restaurants
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Gate::denies('restaurants.create')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        return view('restaurant.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Gate::denies('restaurants.create')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        $this->validate($request, [
            'name' => 'required',
            'about' => 'required',
            'image' => 'mimes:jpg,jpeg,png'
        ]);

        $restaurant = new Restaurant();
        $restaurant->name = $request->name;
        $restaurant->about = $request->about;

        if($request->hasFile('image'))
        {
            $destination = 'public/images/restaurants';
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();
            $path = $image->storeAs($destination, $image_name);

            if($path){
                $restaurant->image = $image_name;
            }
        }

        $restaurant->save();

        return redirect()->route('restaurants')->with('message', 'Restaurant Created Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Restaurant $restaurant)
    {
        if (Gate::denies('restaurants.view')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        return view('restaurant.show', [
            'restaurant' => $restaurant
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Restaurant $restaurant)
    {
        if (Gate::denies('restaurants.edit')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        return view('restaurant.edit', [
            'restaurant' => $restaurant
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        if (Gate::denies('restaurants.edit')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        $this->validate($request, [
            'name' => 'required',
            'about' => 'required',
            'image' => 'mimes:jpg,jpeg,png'
        ]);

        $srestaurant = Restaurant::find($restaurant->id);
        $srestaurant->name = $request->name;
        $srestaurant->about = $request->about;

        if($request->hasFile('image'))
        {
            $destination = 'public/images/restaurants';
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();
            $path = $image->storeAs($destination, $image_name);

            if($path){
                $srestaurant->image = $image_name;
            }
        }

        $srestaurant->save();

        return redirect()->route('restaurants')->with('message', 'Restaurant Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurant $restaurant)
    {
        if (Gate::denies('restaurants.delete')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        $restaurant->delete();

        return redirect()->route('restaurants')->with('message', 'Restaurant Deleted!');
    }
}
