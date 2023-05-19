@extends('layouts.client')

@section('landing')
    <div class="pagelanding">
        <img src="{{ asset('storage/images/pages/'.$page->image) }}" alt="Image 1">
        <div class="overlay"></div>
        <div class="text">
            <p>Comfy, ain't it?</p>
        </div>
    </div>
@endsection

@section('content')
    {!! $page->content !!}
@endsection