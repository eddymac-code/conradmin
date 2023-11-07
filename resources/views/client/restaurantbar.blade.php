@extends('layouts.client-2')

@section('content')
    <div class="pg-landing">
        <img src="{{ asset('images/restaurant1.jpg') }}" alt="Restaurant Image">        
        <div class="content">
            <p>Ambience to live for.</p>
        </div>
        <div class="overlay"></div>
    </div>
    <div class="dark-separator"></div>
    <div class="container text-center">
        <h3>More</h3>
        @foreach ($restaurant as $restaurant)
        <h4>{{ $restaurant->name }}</h4>
        <div class="row row-cols-lg-2 row-cols-md-2 row-cols-1 mb-5">
            <div class="col">
                <div>
                    <img class="img-fluid" src="{{ asset('storage/images/restaurants/'.$restaurant->image) }}" alt="restaurantimg">
                </div>
            </div>
            <div class="col">
                <div>
                    <p>{{ $restaurant->about }}</p>
                </div>
            </div>
        </div>
        @endforeach
        @foreach ($bars as $bar)
        <h4>{{ $bar->name }}</h4>
        <div class="row row-cols-lg-2 row-cols-md-2 row-cols-1 mb-5">        
            <div class="col">
                <div>
                    <img class="img-fluid" src="{{ asset('storage/images/bars/'.$bar->image) }}" alt="bar1">
                </div>
            </div>
            <div class="col">
                <div>
                    <p>{{ $bar->about }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="dark-separator"></div>

    <div class="content-box" id="content-box">
        {!! $page->content !!}
    </div>
@endsection