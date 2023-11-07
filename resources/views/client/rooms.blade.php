@extends('layouts.client-2')

@section('content')
    <div class="pg-landing">
        <img src="{{ asset('storage/images/pages/'.$page->image) }}" alt="Image 1">
        <div class="content">
            <h2>Comfy, ain't it?</h2>
        </div>
        <div class="overlay"></div>
    </div>
    <div class="dark-separator"></div>
    <div class="p-5">
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
                    </div>
                  </div>
            </div>
            @endforeach
            
            <div class="my-5 text-center">
                <a href="{{ route('client.rooms.available') }}" class="btn btn-primary mt-auto">Check Availability</a>
              </div>
        </div>
    </div>
    <div class="dark-separator"></div>
    <div class="pg-content-box" id="content-box">
        {!! $page->content !!}
    </div>
@endsection

@section('other')
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