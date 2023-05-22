<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\RoomType;

class RoomPageController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }
    
    public function index()
    {
        $page = Page::where('title', 'Rooms')->first();
        $roomType = RoomType::all();
        return view('client.rooms', [
            'page' => $page,
            'roomType' => $roomType
        ]);
    }
}
