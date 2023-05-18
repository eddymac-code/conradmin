@extends('layouts.client')

@section('landing')
    <div class="pagelanding">
        <img src="{{ asset('img/grounds1.jpg') }}" alt="Image 1">
        <div class="overlay"></div>
        <div class="text">
            <p>Clean, fresh air with mother nature's perfection</p>
        </div>
    </div>
@endsection

@section('content')
    <div class="maincontent">
        Some content here.
    </div>
@endsection