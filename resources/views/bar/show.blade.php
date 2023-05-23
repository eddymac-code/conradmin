@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="my-4 p-2">
            <h2>Bar Details</h2>
            <p class="lead">Info for {{ $bar->name }}</p>
        </div>
        
        <div class="my-2">
            <a href="{{ route('bars') }}" class="btn btn-info float-md-end">Go Back</a>
        </div>
        <div class="clearfix"></div>
        @if (session('message'))
            <div class="p-2 my-2 rounded bg-success text-white text-center fw-bold">
                {{ session('message') }}
            </div> 
        @endif
        <div class="p-2">
            <div class="card" style="width: 24rem;">
                @if($bar->image)
                <img src="{{ asset('storage/images/bars/'.$bar->image) }}" style="background-color:lightgray;max-height: 50vh;object-fit:cover" class="card-img-top" alt="...">
                @endif
                <div class="card-body">
                  <h5 class="card-title">{{ $bar->name }}</h5>
                  <p class="card-text">{{ $bar->about }}</p>
                  
                  <a href="{{ route('bars.edit', $bar) }}" class="btn btn-primary">Edit</a>
                </div>
              </div>
        </div>
    </div>
@endsection