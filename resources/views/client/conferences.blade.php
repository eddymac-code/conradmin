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
    <div class="maincontent">
        Some content here.
    </div>
@endsection