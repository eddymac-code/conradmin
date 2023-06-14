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
        @foreach ($roomType as $roomType)
        <div class="col-md-4 d-flex">
            <div class="card">
                @if($roomType->image)
                <img src="{{ asset('storage/images/rooms/types/'.$roomType->image) }}" style="height:200px;object-fit:cover" class="card-img-top" alt="...">
                @endif
                <div class="card-body d-flex flex-column">
                  <h5 class="card-title">{{ $roomType->name }}</h5>
                  <p class="card-text">{{ $roomType->description ?? '' }}</p>
                  <div class="mb-2">
                    <p class="card-text">Amenities</p>
                    <p>
                    @foreach ($roomType->amenities as $amenity)
                        <img style="width:20px" src="{{ asset('storage/images/rooms/amenities/'.$amenity->image) }}" title="{{ $amenity->name }}" data-bs-toggle="popover" data-bs-content="" data-bs-trigger="hover" alt="">
                    @endforeach
                    </p>
                  </div>
                </div>
              </div>
        </div>
        @endforeach
        
        <div class="my-5 text-center">
            <a href="{{ route('client.rooms.available') }}" class="btn btn-primary mt-auto">Check Availability</a>
          </div>
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