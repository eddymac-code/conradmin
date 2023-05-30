<?php

namespace App\Http\Controllers\Client;

use App\Models\Page;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoomPageController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }
    
    public function index(Request $request)
    {
        $page = Page::where('title', 'Rooms')->first();
        $roomType = RoomType::all();
        // $roomt = $request->room_type;
        // $today = date("d/m/y");
        // $tomorrow = date("d/m/y", strtotime("+1 day"));

        return view('client.rooms', [
            'page' => $page,
            'roomType' => $roomType,
            // 'roomt' => $roomt,
            // 'today' => $today,
            // 'tomorrow' => $tomorrow
        ]);
    }

    public function show(RoomType $roomType)
    {
        $today = date("d/m/y");
        $tomorrow = date("d/m/y", strtotime("+1 day"));
        
        return view('client.rooms-available', [
            'roomType' => $roomType,
            'today' => $today,
            'tomorrow' => $tomorrow
        ]);
    }
}
