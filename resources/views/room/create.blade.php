@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="my-4 p-2">
            <h2> Create Room</h2>
            <p class="lead">Add a new hotel room here</p>
        </div>
        <div class="my-2">
            <a href="{{ route('rooms.types.create') }}" class="btn btn-primary float-md-end">Add Room Type</a>
        </div>
        <div class="clearfix"></div>
        @if (session('message'))
            <div class="p-2 my-2 rounded bg-success text-white text-center fw-bold">
                {{ session('message') }}
            </div> 
        @endif
        <div class="p-2">
            <div class="col-md-6">
                <form action="{{ route('rooms.create') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <h3>Create Room</h3>
                    </div>
                    <div class="form-group mb-3">
                        <label for="type" class="form-label">Type</label>
                        <select class="form-select" aria-label="Default select example" name="type" id="type">
                            <option>-- Select --</option>
                            @foreach ($roomTypes as $type)
                                <option value="{{ $type }}">{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="no" class="form-label">Room Number</label>
                        <input type="number" class="form-control" name="number" id="no" value="{{ old('number') }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="name" class="form-label">Room Name</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" class="form-control" id="description" cols="30" rows="10">{{ old('description') }}</textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control" name="price" id="price" value="{{ old('price') }}">
                    </div>
                    <div class="form-group mb-3">
                       <label for="image" class="form-label">Main Image</label>
                       <input type="file" class="form-control" name="image" id="image"> 
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection