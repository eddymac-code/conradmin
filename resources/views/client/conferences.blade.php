@extends('layouts.client-2')

@section('content')
    <div class="pg-landing">
        <img src="{{ asset('images/office1.jpg') }}" alt="Image 1">
        <div class="content">
            <h2>Conferencing</h2>
            <p>Serenity and comfort, for all your conference needs.</p>
        </div>
        <div class="overlay"></div>
    </div>

    
    <h2 style="text-align: center; padding: 2em 0 0">Facilities</h2>
    <div class="pg-showcase">
        @foreach ($facilities as $facility)
        <div class="pg-card">
            <img src="{{ asset('storage/images/conference_facilities/'.$facility->image) }}" alt="facilityimg">
            <div class="pg-card-info">
                <h4>{{ $facility->name }}</h4>
                <p>{{ $facility->about }}</p>
                <p><strong>Capacity:</strong> {{ $facility->capacity }} {{ Str::plural('person', $facility->capacity) }}</p>
                <p><strong>Price:</strong> {{ \App\Models\Setting::where('setting_key', 'hotel_currency')->first()->setting_value }} {{ $facility->price }}</p>
            </div>
        </div> 
        @endforeach
    </div>

    <div class="dark-separator"></div>

    <div class="pg-content-box" id="content-box">
        {!! $page->content !!}
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