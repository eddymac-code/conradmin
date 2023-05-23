<?php

namespace App\Http\Controllers\Client;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bar;
use App\Models\Restaurant;

class RestaurantAndBarPageController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }
    
    public function index()
    {
        $page = Page::where('title', 'Restaurant and Bars')->first();
        $bars = Bar::all();
        $restaurant = Restaurant::all();
        return view('client.restaurantbar', [
            'page' => $page,
            'bars' => $bars,
            'restaurant' => $restaurant
        ]);
    }
}
