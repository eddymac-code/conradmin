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
        @if (session('message'))
            <div class="p-2 my-2 rounded bg-success text-white text-center fw-bold">
                {{ session('message') }}
            </div> 
        @endif
        <form class="roomform row" action="{{ route('client.rooms.available') }}" method="post">
            @csrf
            <div class="col-md-2">
                <div class="row">
                    <div class="col-md-12">
                        <label class="form-label" for="checkin">Room Type</label>
                        <select name="roomtype" id="roomtype" class="form-select">
                            <option value="">-- Select --</option>
                            @foreach ($roomTypes as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
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
                        <input type="text" class="form-control" name="occupancy" id="guestsInput" readonly>
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

    @if (!empty($checkin))
        <div class="p-2">
            <div class="my-2">
                <a href="{{ route('client.rooms.available') }}" class="btn btn-light float-md-end">Reset</a>
            </div>
            <div class="clearfix"></div>
        @php
            $i = 0;
        @endphp
        @if ($rooms->count() < 1)
            <p class="lead">Unfortunately, no rooms fit your search. Please try changing your search parameters</p>
        @else
        <p>These are the <strong>{{ $roomType->name }}</strong> rooms available for booking for the period <strong>{{ $checkin }}</strong> to <strong>{{ $checkout }}</strong> </p>
        <div id="carouselExample" class="p-2 carousel slide" data-bs-ride="carousel">
            <ol class="carousel-indicators">
              @foreach($rooms as $index => $room)
                <li data-bs-target="#carouselExample" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}"></li>
              @endforeach
            </ol>
            <div class="carousel-inner">
              @foreach($rooms as $index => $room)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                  <img style="object-fit: scale-down" src="{{ asset('storage/images/rooms/'.$room->image) }}" class="d-block w-100" alt="{{ $room->number }} Image">
                  <div class="carousel-caption">
                    <h3>Room No: {{ $room->number }}</h3>
                    <p>{{ \App\Models\Setting::where('setting_key', 'hotel_currency')->first()->setting_value }} {{ number_format($room->price, 2) }} {{ __('Per Night') }}</p>
                    <a href="" class="btn btn-primary">Reserve</a>
                  </div>
                </div>
              @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExample" role="button" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExample" role="button" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </a>
          </div>
        @endif
        </div>
    @endif
@endsection

@section('footer-scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    flatpickr("input[type=datetime-local]");
</script>
<script>
    // for showing popover on guests occupancy input
var adultsCount = 1;
    var childrenCount = 0;
    var guestsInput = document.getElementById('guestsInput');
    var adultsCountElement = document.getElementById('adultsCount');
    var childrenCountElement = document.getElementById('childrenCount');
    var popover = document.querySelector('.p-over');
    var popoverContent = document.querySelector('.p-over-content');

    function updateGuestsInput() {
      var adultsText = adultsCount === 1 ? 'adult' : 'adults';
      var childrenText = childrenCount === 1 ? 'child' : 'children';
      guestsInput.value = adultsCount + ' ' + adultsText + ' ' + childrenCount + ' ' + childrenText;
    }

    function updateCounts() {
      adultsCountElement.textContent = adultsCount;
      childrenCountElement.textContent = childrenCount;
      updateGuestsInput();
    }

    function decrementCount(type) {
      if (type === 'adults') {
        if (adultsCount > 1) {
          adultsCount--;
        }
      } else if (type === 'children') {
        if (childrenCount > 0) {
          childrenCount--;
        }
      }
      updateCounts();
    }

    function incrementCount(type) {
      if (type === 'adults') {
        adultsCount++;
      } else if (type === 'children') {
        childrenCount++;
      }
      updateCounts();
    }

    function handleClickOutside(event) {
      if (!popover.contains(event.target)) {
        popover.classList.remove('active');
      }
    }

    document.getElementById('adultsDecrement').addEventListener('click', function (event) {
      event.preventDefault();
      decrementCount('adults');
    });

    document.getElementById('adultsIncrement').addEventListener('click', function (event) {
      event.preventDefault();
      incrementCount('adults');
    });

    document.getElementById('childrenDecrement').addEventListener('click', function (event) {
      event.preventDefault();
      decrementCount('children');
    });

    document.getElementById('childrenIncrement').addEventListener('click', function (event) {
      event.preventDefault();
      incrementCount('children');
    });

    guestsInput.addEventListener('click', function (event) {
      event.preventDefault();
      popover.classList.toggle('active');
    });

    document.addEventListener('click', handleClickOutside);

    updateGuestsInput();
</script>
@endsection