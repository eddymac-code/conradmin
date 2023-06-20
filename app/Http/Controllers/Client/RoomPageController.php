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

    public function show(Request $request)
    {
        $today = date("d/m/y");
        $tomorrow = date("d/m/y", strtotime("+1 day"));
        $roomTypes = RoomType::all();

        if (!empty($request->checkin) && !empty($request->checkout) && !empty($request->occupancy)) {
            // dd($request->roomtype);
            $roomtype = $request->roomtype;
            $checkin = $request->checkin;
            $checkout = $request->checkout;
            $occupancy = $request->occupancy;
            $roomTypes = RoomType::all();

            $roomType = RoomType::find($roomtype);
            // Regular expression pattern
            $pattern = '/(\d+)\s*(?:adult|adults)\s*(\d+)\s*(?:child|children)/';

            // Perform the regular expression match
            if (preg_match($pattern, $occupancy, $matches)) {
                $adults = $matches[1]; // Number of adults
                $children = $matches[2]; // Number of children

                // Use the extracted values in your search function or further processing
                $rooms = Room::where('room_type', $roomtype)->where('adults', '>=', $adults)
                        ->where('children', '>=', $children)
                        ->where('status', 0)
                        ->get();

                return view('client.rooms-available', [
                    'roomType' => $roomType,
                    'roomTypes' => $roomTypes,
                    'checkin' => $checkin,
                    'checkout' => $checkout,
                    'rooms' => $rooms
                ]);
            } else {
                // The text format doesn't match the pattern
                return back()->with("message", "Invalid text format");
            }
        }
        
        
        return view('client.rooms-available', [
            'roomTypes' => $roomTypes,
            'today' => $today,
            'tomorrow' => $tomorrow
        ]);
    }
}
