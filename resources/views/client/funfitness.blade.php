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
    <div class="maincontent">
        Some content here.
    </div>
@endsection