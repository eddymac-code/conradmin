@extends('layouts.client-2')

@section('content')
    <div class="pg-landing">
        <img src="{{ asset('images/swimming2.jpg') }}" alt="Image 1">        
        <div class="content">
            <p>Fitness is next to?</p>
            <p>How about some fun?</p>
        </div>
        <div class="overlay"></div>
    </div>
    <div class="container text-center">
        @foreach ($pools as $pool)
        <h4>{{ $pool->name }}</h4>
        <div class="row row-cols-lg-2 row-cols-md-2 row-cols-1 mb-5">
            <div class="col">
                <div>
                    <img class="img-fluid object-fit-cover" src="{{ asset('storage/images/pools/'.$pool->image) }}" alt="poolimg">
                </div>
            </div>
            <div class="col">
                <div>
                    <p>{{ $pool->about }}</p>
                    <p>Price: {{ \App\Models\Setting::where('setting_key', 'hotel_currency')->first()->setting_value }} {{ $pool->price }}</p>
                </div>
            </div>
        </div> 
        @endforeach
        <hr>
        @foreach ($gyms as $gym)
        <h4>{{ $gym->name }}</h4>
        <div class="row row-cols-lg-2 row-cols-md-2 row-cols-1 mb-5">
            <div class="col">
                <div>
                    <img class="img-fluid object-fit-cover" src="{{ asset('storage/images/gyms/'.$gym->image) }}" alt="gymimg">
                </div>
            </div>
            <div class="col">
                <div>
                    <p>{{ $gym->about }}</p>
                    <p>Price: {{ \App\Models\Setting::where('setting_key', 'hotel_currency')->first()->setting_value }} {{ $gym->price }}</p>
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

@section('content')
    
    <span id="toggleButton" onclick="toggleContent()">Read More...</span>
    <hr>
    
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

        scrollToContent();
        function scrollToContent() {
            window.addEventListener('DOMContentLoaded', function () {
                setTimeout(function () {
                var section = document.getElementById('maincontent');
                section.scrollIntoView();
                }, 3000);
            });
        }
    </script>
@endsection