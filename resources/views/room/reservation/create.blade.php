@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="my-4 p-2">
            <h2> Create Reservation</h2>
            <p class="lead">Add a new hotel reservation here</p>
        </div>
        @if (session('message'))
            <div class="p-2 my-2 rounded bg-success text-white text-center fw-bold">
                {{ session('message') }}
            </div> 
        @endif
        <div class="p-2">
            <div class="col-md-6">
                <form action="{{ route('rooms.reservations.create', $room) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <h3>Create Reservation</h3>
                    </div>
                    <div class="form-group mb-3">
                        <label for="guest_name" class="form-label">Guest Name</label>
                        <input type="text" name="guest" id="guest_name" value="{{ old('guest') }}"
                        class="form-control @error('guest') border border-danger @enderror">

                        @error('guest')
                            <div class="text-danger fs-6 mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="guest_id" class="form-label">Guest Id/Passport Number</label>
                        <input type="text" name="identity" id="guest_id" value="{{ old('identity') }}"
                        class="form-control @error('identity') border border-danger @enderror">

                        @error('identity')
                            <div class="text-danger fs-6 mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3 row">
                        <div class="col-md-6">
                            <label for="guest_name" class="form-label">Guest Country</label>
                        <select name="country" id="country-select" 
                        class="form-select @error('country') border border-danger @enderror">
                            <option value=""> --Select Country-- </option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}" data-telephone-code="{{ $country->code }}">{{ $country->name }}</option>
                            @endforeach
                        </select>

                        @error('country')
                            <div class="text-danger fs-6 mt-2">{{ $message }}</div>
                        @enderror
                        </div>
                        <div class="col-md-6">
                        <label for="telephone-input" class="form-label">Guest Phone</label>
                        <div class="input-group">
                        <span class="input-group-text" id="telephone-code"></span>
                        <input type="text" name="phone" id="telephone-input" value="{{ old('phone') }}"
                        class="form-control @error('phone') border border-danger @enderror">
                        </div>

                        @error('phone')
                            <div class="text-danger fs-6 mt-2">{{ $message }}</div>
                        @enderror
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="checkin" class="form-label">Check-In Date</label>
                        <input type="date" name="checkin" id="checkin" value="{{ old('checkin') }}"
                        class="form-control @error('checkin') border border-danger @enderror">

                        @error('checkin')
                            <div class="text-danger fs-6 mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="checkout" class="form-label">Check-Out Date</label>
                        <input type="date" name="checkout" id="checkout" value="{{ old('checkout') }}"
                        class="form-control @error('checkout') border border-danger @enderror">

                        @error('checkout')
                            <div class="text-danger fs-6 mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="timein" class="form-label">Time In</label>
                        <input type="time" name="time_in" id="timein" value="{{ old('time_in') }}"
                        class="form-control @error('time_in') border border-danger @enderror">

                        @error('time_in')
                            <div class="text-danger fs-6 mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="timeout" class="form-label">Time Out</label>
                        <input type="time" name="time_out" id="timeout" value="{{ old('time_out') }}"
                        class="form-control @error('time_out') border border-danger @enderror">

                        @error('time_out')
                            <div class="text-danger fs-6 mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="description" class="form-label">Special Requests?</label>
                        <textarea name="special_requests" class="form-control" id="special_requests" cols="30" rows="10">{{ old('special_requests') }}</textarea>
                        <p class="fs-6 text-danger">*Please note that fulfillment of these requests is subject to availability and hotel policies</p>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" name="pay_info" id="payment">
                        <label class="form-check-label" for="payment">Has Guest provided payment information? (For guaranteeing the reservation)</label>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('footer-scripts')
<script>
    // Get the necessary elements
    var selectElement = document.getElementById('country-select');
    var telephoneCodeElement = document.getElementById('telephone-code');
    var telephoneInputElement = document.getElementById('telephone-input');

    // Add event listener to the select element
    selectElement.addEventListener('change', function() {
        // Get the selected option
        var selectedOption = selectElement.options[selectElement.selectedIndex];

        // Update the telephone code element with the selected country's telephone code
        telephoneCodeElement.textContent = selectedOption.getAttribute('data-telephone-code');
    });

    // Add event listener to the telephone input element
    telephoneInputElement.addEventListener('input', function() {
        // Remove any non-digit characters from the input value
        var cleanedValue = telephoneInputElement.value.replace(/\D/g, '');

        // Set the cleaned value as the input value
        telephoneInputElement.value = cleanedValue;
    });
</script>

@endsection