<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Country;
use App\Models\RoomExtra;
use Illuminate\Http\Request;
use App\Models\RoomReservation;
use Illuminate\Support\Facades\Gate;

class RoomReservationController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Gate::denies('reservations.access')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        $reservations = RoomReservation::paginate(20);

        return view('room.reservation.data', [
            'reservations' => $reservations
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Room $room)
    {
        if (Gate::denies('reservations.create')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }
        $countries = Country::all();
        $roomExtras = RoomExtra::all();

        return view('room.reservation.create', [
            'room' => $room,
            'countries' => $countries,
            'roomExtras' => $roomExtras,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Room $room)
    {
        if (Gate::denies('reservations.create')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        $this->validate($request, [
            'guest' => 'required',
            'identity' => 'required',
            'checkin' => 'required',
            'checkout' => 'required',
            'time_in' => ['required', 'date_format:H:i', 'after_or_equal:15:00'],
            'time_out' => ['required', 'date_format:H:i', 'before_or_equal:12:00'],
        ]);

        $refNo = $this->generateReferenceNumber($room->number);

        $roomReservation = new RoomReservation();
        $roomReservation->reference_number = $refNo;
        $roomReservation->source = 'admin';
        $roomReservation->guest_name = $request->guest;
        $roomReservation->guest_id = $request->identity;
        $roomReservation->country = $request->country;
        $roomReservation->phone = $request->phone;
        $roomReservation->room_id = $room->id;
        $roomReservation->check_in = $request->checkin;
        $roomReservation->check_out = $request->checkout;
        $roomReservation->time_in = $request->time_in;
        $roomReservation->time_out = $request->time_out;
        $roomReservation->special_requests = $request->special_requests;
        $roomReservation->status = 0;
        $roomReservation->total_cost = $request->total_price; // add other costs if required
        $roomReservation->save();

        // dd($roomReservation);

        // if ($reservation->status == 1) {
        //     $room->update(['status' => 1]);
        // } else {
        //     $room->update(['status' => 0]);
        // }

        if ($request->has('pay_info')) {
            return redirect()->route('rooms.reservations.payment', [$room, $roomReservation])->with('message', 'Reservation saved successfully');
        } else {
            return redirect()->route('rooms.reservations')->with('message', 'Reservation saved successfully');
        }
    }

    /**
     * Handle payment for the reservation
     */
    public function paymentIndex(Room $room, RoomReservation $roomReservation)
    {
        return view('room.reservation.pay_index', [
            'room' => $room,
            'roomReservation' => $roomReservation
        ]);
    }

    /**
     * Store payment for the reservation
     */
    public function paymentStore(Request $request, Room $room, RoomReservation $roomReservation)
    {
        // dd($request->request);
        if ($request->method == "mobile" && !empty($request->phone_number)) {
            // Send STK or prompt caller to send money via till/paybill
            $roomReservation->update(['status' => 1]);
            $room->update(['status' => 1]);
            $reservations = $roomReservation->room->reservations()->where('status', 0)->get();
            foreach ($reservations as $reservation) {
                $reservation->update(['status' => 3]);
                // Send Notification to client for cancellation.
            }

            return redirect()->route('rooms.reservations')->with('message', 'Reservation guaranteed and room booked successfully');
        
        } elseif($request->method == "cash" && $request->has('cash_confirm')) {
            // Send message
            $roomReservation->update(['status' => 1]);
            $room->update(['status' => 1]);
            $reservations = $roomReservation->room->reservations()->where('status', 0)->get();
            foreach ($reservations as $reservation) {
                $reservation->update(['status' => 3]);
                // Send Notification to client for cancellation.
            }

            return redirect()->route('rooms.reservations')->with('message', 'Reservation guaranteed and room booked successfully');
        } else {
            return back()->with('error', 'Please make sure to fill all inputs');
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(RoomReservation $roomReservation)
    {
        if (Gate::denies('reservations.view')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }
        
        return view('room.reservation.show', [
            'roomReservation' => $roomReservation
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RoomReservation $roomReservation)
    {
        if (Gate::denies('reservations.update')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }
        $countries = Country::all();
        $roomExtras = RoomExtra::all();

        $room = $roomReservation->room;

        return view('room.reservation.edit', [
            'room' => $room,
            'countries' => $countries,
            'roomExtras' => $roomExtras,
            'roomReservation' => $roomReservation
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RoomReservation $roomReservation)
    {
        if (Gate::denies('reservations.update')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        $this->validate($request, [
            'guest' => 'required',
            'identity' => 'required',
            'checkin' => 'required',
            'checkout' => 'required',
            'time_in' => ['required', 'date_format:H:i', 'after_or_equal:15:00'],
            'time_out' => ['required', 'date_format:H:i', 'before_or_equal:12:00'],
        ]);

        $roomReservation->source = 'admin';
        $roomReservation->guest_name = $request->guest;
        $roomReservation->guest_id = $request->identity;
        $roomReservation->country = $request->country;
        $roomReservation->phone = $request->phone;
        $roomReservation->room_id = $roomReservation->room->id;
        $roomReservation->check_in = $request->checkin;
        $roomReservation->check_out = $request->checkout;
        $roomReservation->time_in = $request->time_in;
        $roomReservation->time_out = $request->time_out;
        $roomReservation->special_requests = $request->special_requests;
        $roomReservation->status = $roomReservation->status;
        $roomReservation->total_cost = $request->total_price; // add other costs if required
        $roomReservation->save();

        if ($roomReservation->status == 1) {
            $roomReservation->room->update(['status' => 1]);
        } else {
            $roomReservation->room->update(['status' => 0]);
        }

        return redirect()->route('rooms.reservations')->with('message', 'Reservation updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RoomReservation $roomReservation)
    {
        if (Gate::denies('reservations.delete')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        $roomReservation->delete();

        return redirect()->route('rooms.reservations')->with('message', 'Reservation Deleted');
    }

    public function cancel(RoomReservation $roomReservation)
    {
        if (Gate::denies('reservations.update')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }
        $today = date('Y-m-d');

        if (! strtotime($roomReservation->check_in) > strtotime($today)) {
            return back()->with('alert', 'This action cannot be done. Contact System Administrator');
        }

        $roomReservation->update(['status' => 3]);

        if ($roomReservation->status === 3) {
            $roomReservation->room->update(['status' => 0]);
        }

        return back()->with('message', 'Reservation Cancelled');
    }

    public function guarantee(RoomReservation $roomReservation)
    {
        if (Gate::denies('reservations.update')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }
        $today = date('Y-m-d');

        if (! strtotime($roomReservation->check_in) > strtotime($today)) {
            return back()->with('alert', 'This action cannot be done. Contact System Administrator');
        }

        $roomReservation->update(['status' => 1]);
        
        if ($roomReservation->status === 1) {
            $roomReservation->room->update(['status' => 1]);
            $reservations = $roomReservation->room->reservations()->where('status', 0)->get();
            foreach ($reservations as $reservation) {
                $reservation->update(['status' => 3]);
                // Send Notification to client for cancellation.
            }
        }

        return back()->with('message', 'Reservation Guaranteed');
    }

    // public function unguarantee(RoomReservation $roomReservation)
    // {
    //     if (Gate::denies('reservations.update')) {
    //         return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
    //     }
    //     $today = date('Y-m-d');

    //     if (! strtotime($roomReservation->check_in) > strtotime($today)) {
    //         return back()->with('alert', 'This action cannot be done. Contact System Administrator');
    //     }

    //     $roomReservation->update(['status' => 0]);
    //     if ($roomReservation->status === 0) {
    //         $roomReservation->room->update(['status' => 0]);
    //     }

    //     return back()->with('message', 'Reservation Unsecured');
    // }

    protected function generateReferenceNumber($roomNumber)
    {
        $lastNumber = RoomReservation::max('id') ?: 0; // Get the last inserted ID or set it to 0 if no records exist
        $uniqueNumber = sprintf('%02d', ($lastNumber % 100)); // Extract the last two digits and pad with zeros if necessary
        return "CHR-$roomNumber-$uniqueNumber";
    }
}
