<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ReservationController extends Controller
{
    /**
     * Constructor
     */
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

        $reservations = Reservation::paginate(20);

        return view('reservation.data', [
            'reservations' => $reservations
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Gate::denies('reservations.create')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }
        $countries = Country::all();

        return view('reservation.create', [
            'countries' => $countries,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Gate::denies('reservations.create')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        dd($request);

        $this->validate($request, [
            'guest' => 'required',
            'identity' => 'required',
            'checkin' => 'required',
            'checkout' => 'required',
            'time_in' => ['required', 'date_format:H:i', 'after_or_equal:15:00'],
            'time_out' => ['required', 'date_format:H:i', 'before_or_equal:12:00'],
        ]);

        $refNo = $this->generateReferenceNumber($room->number);

        $reservation = new Reservation();
        $reservation->reference_number = $refNo;
        $reservation->source = 'admin';
        $reservation->guest_name = $request->guest;
        $reservation->guest_id = $request->identity;
        $reservation->country = $request->country;
        $reservation->phone = $request->phone;
        $reservation->check_in = $request->checkin;
        $reservation->check_out = $request->checkout;
        $reservation->time_in = $request->time_in;
        $reservation->time_out = $request->time_out;
        $reservation->special_requests = $request->special_requests;
        $reservation->status = 0;
        $reservation->total_cost = $request->total_price; // add other costs if required
        $reservation->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}
