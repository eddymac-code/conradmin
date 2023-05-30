@extends('layouts.client')

@section('content')
    <div class="p-2">
        <h3>{{ __('Please input available dates and number of people') }}</h3>
        {{-- <form action="" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="checkin" class="form-label">{{ __('Check In') }}</label>
                            <input type="datetime-local" class="form-control" name="checkin">
                        </div>
                        <div class="col-md-6">
                            <label for="checkout" class="form-label">{{ __('Check Out') }}</label>
                            <input type="datetime-local" class="form-control" name="checkout">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label" for="adults">Adults</label>
                            <div class="input-group">
                                <span class="input-group-text" onclick="decrement('adults')">-</span>
                                <input type="number" class="form-control" id="adults" min="1" value="1" readonly>
                                <span class="input-group-text" onclick="increment('adults')">+</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="kids">Kids</label>
                            <div class="input-group">
                                <span class="input-group-text" onclick="decrement('kids')">-</span>
                                <input type="number" class="form-control" id="kids" min="0" value="0" readonly>
                                <span class="input-group-text" onclick="increment('kids')">+</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary" type="submit">Search</button>
        </form> --}}

        <form class="roomform row" action="" method="post">
            @csrf
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label" for="checkin">Check In</label>
                        <input type="datetime-local" class="form-control" name="checkin" placeholder="YYYY-MM-DD">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="checkout">Check Out</label>
                        <input type="datetime-local" class="form-control" name="checkout" placeholder="YYYY-MM-DD">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-12 p-over" style="border: 0; width:100%">
                        <label class="form-label" for="">Occupancy</label>
                        <input type="text" class="form-control" name="capacity" id="guestsInput" readonly>
                        <div class="p-over-content">
                            <div class="p-over-row">
                                <span class="p-over-label">Adults:</span>
                                <div class="p-over-value">
                                <button id="adultsDecrement">-</button>
                                <span id="adultsCount">1</span>
                                <button id="adultsIncrement">+</button>
                                </div>
                            </div>
                            <div class="p-over-row">
                                <span class="p-over-label">Children:</span>
                                <div class="p-over-value">
                                <button id="childrenDecrement">-</button>
                                <span id="childrenCount">0</span>
                                <button id="childrenIncrement">+</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn btn-outline-primary col-md-2" type="submit">Search</button>
        </form>
    </div>
@endsection

@section('footer-scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    flatpickr("input[type=datetime-local]");
</script>
@endsection