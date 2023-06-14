@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="my-4 p-2">
            <h2> Update Reservation for Room {{ $roomReservation->room->number }}</h2>
            <p class="lead">Update hotel reservation here</p>
        </div>
        <div class="p-2">
            <div class="col-md-6">
                <form action="{{ route('rooms.reservations.edit', $roomReservation) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <h3>Update Reservation</h3>
                    </div>
                    <div class="form-group mb-3">
                        <label for="guest_name" class="form-label">Guest Name</label>
                        <input type="text" name="guest" id="guest_name" value="{{ $roomReservation->guest_name }}"
                        class="form-control @error('guest') border border-danger @enderror">

                        @error('guest')
                            <div class="text-danger fs-6 mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="guest_id" class="form-label">Guest Id/Passport Number</label>
                        <input type="text" name="identity" id="guest_id" value="{{ $roomReservation->guest_id }}"
                        class="form-control @error('identity') border border-danger @enderror">

                        @error('identity')
                            <div class="text-danger fs-6 mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="checkin" class="form-label">Check-In Date</label>
                        <input type="date" name="checkin" id="checkin" value="{{ $roomReservation->check_in }}"
                        class="form-control @error('checkin') border border-danger @enderror">

                        @error('checkin')
                            <div class="text-danger fs-6 mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="checkout" class="form-label">Check-Out Date</label>
                        <input type="date" name="checkout" id="checkout" value="{{ $roomReservation->check_out }}"
                        class="form-control @error('checkout') border border-danger @enderror">

                        @error('checkout')
                            <div class="text-danger fs-6 mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="timein" class="form-label">Time In</label>
                        <input type="time" name="time_in" id="timein" value="{{ $roomReservation->time_in }}"
                        class="form-control @error('time_in') border border-danger @enderror">

                        @error('time_in')
                            <div class="text-danger fs-6 mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="timeout" class="form-label">Time Out</label>
                        <input type="time" name="time_out" id="timeout" value="{{ $roomReservation->time_out }}"
                        class="form-control @error('time_out') border border-danger @enderror">

                        @error('time_out')
                            <div class="text-danger fs-6 mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="description" class="form-label">Special Requests?</label>
                        <textarea name="special_requests" class="form-control" id="special_requests" cols="30" rows="10">{{ $roomReservation->special_requests }}</textarea>
                        <p class="fs-6 text-danger">*Please note that fulfillment of these requests is subject to availability and hotel policies</p>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" name="pay_info" id="payment" @if($roomReservation->status == 1) checked @endif>
                        <label class="form-check-label" for="payment">Has Guest provided payment information? (For guaranteeing the reservation)</label>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection