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