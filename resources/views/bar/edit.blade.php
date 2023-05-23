@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="my-4 p-2">
            <h2> Create Bar</h2>
            <p class="lead">Add a hotel bar here</p>
        </div>
        @if (session('message'))
            <div class="p-2 my-2 rounded bg-success text-white text-center fw-bold">
                {{ session('message') }}
            </div> 
        @endif
        <div class="p-2">
            <div class="col-md-6">
                <form action="{{ route('bars.edit', $bar) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <h3>Update Bar: <span class="fw-bold text-primary">{{ $bar->name }}</span></h3>
                    </div>
                    <div class="form-group mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control @error('name') border border-danger @enderror" name="name" id="name" value="{{ $bar->name }}">
                        @error('name')
                            <div class="mt-2 text-danger fs-6">
                                 {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="about" class="form-label">About</label>
                        <textarea name="about" class="form-control @error('about') border border-danger @enderror" id="about" cols="30" rows="10">{{ $bar->about }}</textarea>
                        @error('about')
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
                    @if($bar->image)
                    <div class="mb-3">
                        <img style="width:50px;height:50px" src="{{ asset('storage/images/bars/'.$bar->image) }}" alt="" class="rounded">
                    </div>
                    @endif
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection