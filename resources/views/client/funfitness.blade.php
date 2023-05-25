@extends('layouts.client')

@section('landing')
    <div class="pagelanding">
        <img src="{{ asset('img/swimming2.jpg') }}" alt="Image 1">
        <div class="overlay"></div>
        <div class="text">
            <p>Fitness is next to?</p>
            <p>How about some fun?</p>
        </div>
    </div>
@endsection

@section('content')
    <div class="content-box" id="content-box">
        {!! $page->content !!}
    </div>
    <span id="toggleButton" onclick="toggleContent()">Read More...</span>
    <hr>
    @foreach ($pools as $pool)
    <div class="row">
        <h4>{{ $pool->name }}</h4>
        <div class="col-6">
            <div>
                <img class="rounded feature-img" src="{{ asset('storage/images/pools/'.$pool->image) }}" alt="poolimg">
            </div>
        </div>
        <div class="col-6">
            <div>
                <p>{{ $pool->about }}</p>
                <p>Price: {{ \App\Models\Setting::where('setting_key', 'hotel_currency')->first()->setting_value }} {{ $pool->price }}</p>
            </div>
        </div>
    </div> 
    @endforeach
    <hr>
    @foreach ($gyms as $gym)
    <div class="row">
        <h4>{{ $gym->name }}</h4>
        <div class="col-6">
            <div>
                <img class="rounded feature-img" src="{{ asset('storage/images/gyms/'.$gym->image) }}" alt="gymimg">
            </div>
        </div>
        <div class="col-6">
            <div>
                <p>{{ $gym->about }}</p>
                <p>Price: {{ \App\Models\Setting::where('setting_key', 'hotel_currency')->first()->setting_value }} {{ $gym->price }}</p>
            </div>
        </div>
    </div> 
    @endforeach
@endsection

@section('footer-scripts')
    <script>
        function toggleContent() {
            var content = document.getElementById("content-box");
            var toggleButton = document.getElementById("toggleButton");

            if (content.classList.contains("expanded")) {
                content.classList.remove("expanded");
                toggleButton.innerHTML = "Read More...";
            } else {
                content.classList.add("expanded");
                toggleButton.innerHTML = "Read Less";
            }
        }
    </script>
@endsection