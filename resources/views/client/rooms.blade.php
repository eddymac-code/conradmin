@extends('layouts.client')

@section('landing')
    <div class="pagelanding">
        <img src="{{ asset('storage/images/pages/'.$page->image) }}" alt="Image 1">
        <div class="overlay"></div>
        <div class="text">
            <p>Comfy, ain't it?</p>
        </div>
    </div>
@endsection

@section('content')
    <div class="content-box" id="content-box">
        {!! $page->content !!}
    </div>
    <span id="toggleButton" onclick="toggleContent()">Read More...</span>
    <hr>
    <div class="row">
        <h4>Available Room Types</h4>
        @foreach ($roomType as $room)
        <div class="col-4 card-row">
            <div class="card card-column">
                <img src="{{ asset('storage/images/rooms/types/'.$room->image) }}" alt="Room Type" style="height:30vh;width:100%;object-fit:cover">
                <div class="card-container">
                    <h5>{{ $room->name }}</h5>
                    <p>{{ $room->description ?? '' }}</p>
                    <p>
                        @foreach ($room->amenities as $amenity)
                        <img style="width:20px" src="{{ asset('storage/images/rooms/amenities/'.$amenity->image) }}" title="{{ $amenity->name }}" alt="">
                        @endforeach
                    </p>
                    <p><button class="button">Check available rooms</button></p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
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