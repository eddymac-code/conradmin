@extends('layouts.client')

@section('landing')
    <div class="pagelanding">
        <img src="{{ asset('img/room1.jpg') }}" alt="Image 1">
        <div class="overlay"></div>
        <div class="text">
            <p>Comfy, ain't it?</p>
        </div>
    </div>
@endsection

@section('content')
    <div class="maincontent">
        Some content here.
    </div>
@endsection