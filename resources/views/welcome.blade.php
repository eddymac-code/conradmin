@extends('layouts.client')

@section('content')
    <div class="slider">
        <img src="{{ asset('img/room1.jpg') }}" alt="Image 1">
        <img src="{{ asset('img/restaurant1.jpg') }}" alt="Image 2">
        <img src="{{ asset('img/office1.jpg') }}" alt="Image 3">
        <img src="{{ asset('img/swimming1.jpg') }}" alt="Image 4">
        <div class="overlay"></div>
        <div class="text">
            <h1>Conrad Resort</h1>
            <p>Experience our awesome services.</p>
            <button>Learn More</button>
        </div>
    </div>
    {{-- <div class="buttons">
        <button class="prev">Prev</button>
        <button class="next">Next</button>
    </div> --}}

    <div id="pages">
        <button class="tablink" id="defaultOpen" onclick="openPageSection('Overview', this, '#012353')">Overview</button>
        <button class="tablink" onclick="openPageSection('Rooms', this, '#012353')">Rooms</button>
        <button class="tablink" onclick="openPageSection('RNB', this, '#012353')">Restaurant and Bars</button>
        <button class="tablink" onclick="openPageSection('Confac', this, '#012353')">Conference Facilities</button>
        <button class="tablink" onclick="openPageSection('Swimming', this, '#012353')">Swimming Pool</button>
        <button class="tablink" onclick="openPageSection('Grounds', this, '#012353')">Grounds</button>

        <div id="Overview" class="tab-content">
            <h3>Heading here</h3>
            <p>Deliver some content here please!</p>

            <h3>Heading here</h3>
            <p>Deliver some content here please!</p>

            <h3>Heading here</h3>
            <p>Deliver some content here please!</p>

            <h3>Heading here</h3>
            <p>Deliver some content here please!</p>

            <h3>Heading here</h3>
            <p>Deliver some content here please!</p>
        </div>
        <div id="Rooms" class="tab-content">
            <h3>Heading here</h3>
            <p>Deliver some content here please!</p>
        </div>
        <div id="RNB" class="tab-content">
            <h3>Heading here</h3>
            <p>Deliver some content here please!</p>
        </div>
        <div id="Confac" class="tab-content">
            <h3>Heading here</h3>
            <p>Deliver some content here please!</p>
        </div>
        <div id="Swimming" class="tab-content">
            <h3>Heading here</h3>
            <p>Deliver some content here please!</p>
        </div>
        <div id="Grounds" class="tab-content">
            <h3>Grounds Content</h3>
            <p>Right here is where it is.</p>
        </div>
    </div>

    <div id="firstpagecalc"></div>
@endsection