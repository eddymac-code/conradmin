@extends('layouts.client')

@section('landing')
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
    {{-- <div id="firstpagecalc"></div> --}}
@endsection

@section('content')
    {!! $page->content !!}
@endsection