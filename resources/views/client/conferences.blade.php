@extends('layouts.client')

@section('landing')
    <div class="pagelanding">
        <img src="{{ asset('img/office1.jpg') }}" alt="Image 1">
        <div class="overlay"></div>
        <div class="text">
            <p>Serenity and comfort, for all your conference needs.</p>
        </div>
    </div>
@endsection

@section('content')
    <div class="content-box" id="content-box">
        {!! $page->content !!}
    </div>
    <span id="toggleButton" onclick="toggleContent()">Read More...</span>
    <hr>
    @foreach ($facilities as $facility)
    <div class="row">
        <h4>{{ $facility->name }}</h4>
        <div class="col-6">
            <div>
                <img class="rounded feature-img" src="{{ asset('storage/images/conference_facilities/'.$facility->image) }}" alt="facilityimg">
            </div>
        </div>
        <div class="col-6">
            <div>
                <p>{{ $facility->about }}</p>
                <p>Capacity: {{ $facility->capacity }} {{ Str::plural('person', $facility->capacity) }}</p>
                <p>Price: {{ \App\Models\Setting::where('setting_key', 'hotel_currency')->first()->setting_value }} {{ $facility->price }}</p>
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