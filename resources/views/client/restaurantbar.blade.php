@extends('layouts.client')

@section('landing')
    <div class="pagelanding">
        <img src="{{ asset('img/restaurant1.jpg') }}" alt="Image 1">
        <div class="overlay"></div>
        <div class="text">
            <p>Ambience to live for.</p>
        </div>
    </div>
@endsection

@section('content')
    <div class="content-box" id="content-box">
        {!! $page->content !!}
    </div>
    <span id="toggleButton" onclick="toggleContent()">Read More...</span>
    <hr>
    <h3>More</h3>
    @foreach ($restaurant as $restaurant)
    <div class="row">
        <h4>{{ $restaurant->name }}</h4>
        <div class="col-6">
            <div>
                <img class="rounded feature-img" src="{{ asset('storage/images/restaurants/'.$restaurant->image) }}" alt="restaurantimg">
            </div>
        </div>
        <div class="col-6">
            <div>
                <p>{{ $restaurant->about }}</p>
            </div>
        </div>
    </div>
    @endforeach
    @foreach ($bars as $bar)
    <div class="row">
        <h4>{{ $bar->name }}</h4>
        <div class="col-6">
            <div>
                <img class="rounded feature-img" src="{{ asset('storage/images/bars/'.$bar->image) }}" alt="bar1">
            </div>
        </div>
        <div class="col-6">
            <div>
                <p>{{ $bar->about }}</p>
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