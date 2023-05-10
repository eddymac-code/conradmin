@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="my-4 p-2">
            <h2> Assign Amenity</h2>
            <p class="lead">Link a room amenity to room types here</p>
        </div>
        @if (session('message'))
            <div class="p-2 my-2 rounded bg-success text-white text-center fw-bold">
                {{ session('message') }}
            </div> 
        @endif
        <div class="p-2">
            <div class="col-md-6">
                <form action="{{ route('amenities.assign', $amenity) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <h3>Assign <span class="fw-bold text-primary">{{ $amenity->name }}</span></h3>
                    </div>
                    <div class="form-group mb-3">
                        @foreach ($roomTypes as $type)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="types[]" value="{{ $type->id }}"
                                 id="" @if($amenity->roomTypes->contains($type->id)) checked @endif>
                                <label class="form-check-label" for="">
                                {{ $type->name }}
                                </label>
                          </div>
                        @endforeach
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Assign</button>
                </form>
            </div>
        </div>
    </div>
@endsection