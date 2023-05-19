<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Page;

class RoomPageController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }
    
    public function index()
    {
        $page = Page::where('title', 'Rooms')->first();
        return view('client.rooms', [
            'page' => $page
        ]);
    }
}
