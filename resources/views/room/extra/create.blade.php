@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="my-4 p-2">
            <h2> Create Room Extras</h2>
            <p class="lead">Add a hotel room extra here</p>
        </div>
        @if (session('message'))
            <div class="p-2 my-2 rounded bg-success text-white text-center fw-bold">
                {{ session('message') }}
            </div> 
        @endif
        <div class="p-2">
            <div class="col-md-6">
                <form action="{{ route('rooms.extras.create') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <h3>Create Room Extra</h3>
                    </div>
                    <div class="form-group mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control @error('name') border border-danger @enderror" name="name" id="name" value="{{ old('name') }}">
                        @error('name')
                            <div class="mt-2 text-danger fs-6">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" class="form-control" id="description" cols="30" rows="10">{{ old('description') }}</textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control @error('price') border border-danger @enderror" name="price" id="price" value="{{ old('price') }}">
                        @error('price')
                            <div class="mt-2 text-danger fs-6">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection