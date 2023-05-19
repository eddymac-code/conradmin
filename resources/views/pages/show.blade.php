@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="my-4 p-2">
            <h2>Page: {{ $page->title }}</h2>
            <p class="lead">Here, you will find all info on the page.</p>
        </div>

        @if (session('message'))
            <div class="p-2 my-2 rounded bg-success text-white text-center fw-bold">
                {{ session('message') }}
            </div> 
        @endif

        <div class="p-2">
            @if($page->image)
                <div class="col-md-6 rounded overflow-hidden mb-5">
                    <img class="img-fluid" src="{{ asset('/storage/images/pages/'.$page->image) ?? '' }}" alt="Landing Image">
                </div>
            @endif
            <h3>{{ $page->title }}</h3>
            <p>{!! $page->content !!}</p>
        </div>
    </div>
@endsection