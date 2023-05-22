<?php

namespace App\Http\Controllers\Client;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RestaurantAndBarPageController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }
    
    public function index()
    {
        $page = Page::where('title', 'Restaurant and Bars')->first();
        return view('client.restaurantbar', [
            'page' => $page
        ]);
    }
}
