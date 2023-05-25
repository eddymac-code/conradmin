@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="my-4 p-2">
            <h2>Update Gym</h2>
            <p class="lead">Update the Gym here.</p>
        </div>
        @if (session('message'))
            <div class="p-2 my-2 rounded bg-success text-white text-center fw-bold">
                {{ session('message') }}
            </div> 
        @endif
        <div class="p-2">
            <div class="col-md-6">
                <form action="{{ route('gyms.edit', $gym) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <h3>Update Facility</h3>
                    </div>
                    <div class="form-group mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control @error('name') border border-danger @enderror" name="name" id="name" value="{{ $gym->name }}">
                        @error('name')
                            <div class="mt-2 text-danger fs-6">
                                 {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="about" class="form-label">About</label>
                        <textarea name="about" class="form-control @error('about') border border-danger @enderror" id="about" cols="30" rows="10">{{ $gym->about }}</textarea>
                        @error('about')
                            <div class="mt-2 text-danger fs-6">
                                 {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control @error('price') border border-danger @enderror" name="price" id="price" value="{{ $gym->price }}">
                        @error('price')
                            <div class="mt-2 text-danger fs-6">
                                 {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control @error('image') border border-danger @enderror" name="image" id="image">
                        @error('image')
                            <div class="mt-2 text-danger fs-6">
                                 {{ $message }}
                            </div>
                        @enderror 
                    </div>
                    @if($gym->image)
                    <div class="mb-3">
                        <img style="width:50px;height:50px" src="{{ asset('storage/images/gyms/'.$gym->image) }}" alt="" class="rounded">
                    </div>
                    @endif
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection