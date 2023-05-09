@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="my-4 p-2">
            <h2>Room Type: <span class="fw-bold text-primary">{{ $roomType->name }}</span></h2>
            <p class="lead">Here, you will view the room type's details.</p>
        </div>
        @if (session('message'))
            <div class="p-2 my-2 rounded bg-success text-white text-center fw-bold">
                {{ session('message') }}
            </div> 
        @endif
        <div class="p-2">
            <div class="card col-sm-12 col-lg-6 mx-auto mb-3">
                <div class="card-header">{{ $roomType->name }} ({{ $roomType->amenities->count() }} {{ Str::plural('amenity', $room->amenities->count()) }})</div>
                <div class="card-body">
                    <h3>Amenities</h3>
                    <ul class="list-group">
                        @forelse ($roomType->amenities as $amenity)
                        <li class="list-group-item"><img src="{{  }}" alt="Amenity Icon" class="mr-3">{{ $amenity->name }}</li>
                        @empty
                        <li class="list-group-item">No amenities for this room type yet.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection