@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="my-4 p-2">
            <h2>Facility Details</h2>
            <p class="lead">Info for {{ $conferenceFacility->name }}</p>
        </div>
        
        <div class="my-2">
            <a href="{{ route('facilities') }}" class="btn btn-info float-md-end">Go Back</a>
        </div>
        <div class="clearfix"></div>
        @if (session('message'))
            <div class="p-2 my-2 rounded bg-success text-white text-center fw-bold">
                {{ session('message') }}
            </div> 
        @endif
        <div class="p-2">
            <div class="card" style="width: 24rem;">
                @if($conferenceFacility->image)
                <img src="{{ asset('storage/images/conference_facilities/'.$conferenceFacility->image) }}" style="background-color:lightgray;max-height: 50vh;object-fit:cover" class="card-img-top" alt="...">
                @endif
                <div class="card-body">
                  <h5 class="card-title">{{ $conferenceFacility->name }}</h5>
                  <p class="card-text">{{ $conferenceFacility->capacity }} ({{ \App\Models\Setting::where('setting_key', 'hotel_currency')->first()->setting_value }} {{ $facility->price }})</p>
                  <p class="card-text">{{ $conferenceFacility->about }}</p>
                  
                  <a href="{{ route('facilities.edit', $conferenceFacility) }}" class="btn btn-primary">Edit</a>
                </div>
              </div>
        </div>
    </div>
@endsection