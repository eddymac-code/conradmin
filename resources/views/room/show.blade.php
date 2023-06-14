@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="my-4 p-2">
            <h2>Room Details</h2>
            <p class="lead">Info for {{ $room->name }}: No {{ $room->number }}.</p>
        </div>
        
        <div class="my-2">
            <a href="{{ route('rooms') }}" class="btn btn-info float-md-end">Go Back</a>
        </div>
        <div class="clearfix"></div>
        @if (session('message'))
            <div class="p-2 my-2 rounded bg-success text-white text-center fw-bold">
                {{ session('message') }}
            </div> 
        @endif
        <div class="p-2">
            <div class="card" style="width: 24rem;">
                @if($room->image)
                <img src="{{ asset('storage/images/rooms/'.$room->image) }}" style="background-color:lightgray;max-height: 50vh;object-fit:cover" class="card-img-top" alt="...">
                @endif
                <div class="card-body">
                  <h5 class="card-title">Room {{ $room->number }}</h5>
                  <p class="card-text">{{ $room->description }}</p>
                  <div class="mb-2">
                    <p class="card-text">Amenities</p>
                    @foreach ($room->roomType->amenities as $amenity)
                        <img style="width:20px" src="{{ asset('storage/images/rooms/amenities/'.$amenity->image) }}" title="{{ $amenity->name }}" alt="">
                    @endforeach
                  </div>
                  @if ($room->reservations()->whereNotIn('status', [0,3])->count() < 1)
                  <a href="{{ route('rooms.reservations.create', $room) }}" class="btn btn-primary">Reserve</a>
                  @endif
                </div>
              </div>
        </div>
    </div>
@endsection