@extends('layouts.client')

@section('landing')
    <div class="pagelanding">
        <img src="{{ asset('img/contacts1.jpg') }}" alt="Image 1">
        <div class="overlay"></div>
        <div class="text">
            <p>Please, talk to us.</p>
        </div>
    </div>
@endsection

@section('content')
    <div class="maincontent">
        Some content here.
    </div>
@endsection