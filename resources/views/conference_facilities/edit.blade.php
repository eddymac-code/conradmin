@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="my-4 p-2">
            <h2> Create Facility</h2>
            <p class="lead">Add a hotel conference facility here</p>
        </div>
        @if (session('message'))
            <div class="p-2 my-2 rounded bg-success text-white text-center fw-bold">
                {{ session('message') }}
            </div> 
        @endif
        <div class="p-2">
            <div class="col-md-6">
                <form action="{{ route('facilities.edit', $conferenceFacility) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <h3>Update Facility</h3>
                    </div>
                    <div class="form-group mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control @error('name') border border-danger @enderror" name="name" id="name" value="{{ $conferenceFacility->name }}">
                        @error('name')
                            <div class="mt-2 text-danger fs-6">
                                 {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="type" class="form-label">Type</label>
                        <select class="form-select @error('type') border border-danger @enderror" name="type" id="type">
                            <option value="">-- Select --</option>
                            <option value="Hall" @if($conferenceFacility->type === "Hall") selected @endif>Hall</option>
                            <option value="Boardroom" @if($conferenceFacility->type === "Boardroom") selected @endif>Boardroom</option>
                            <option value="Working Space" @if($conferenceFacility->type === "Working Space") selected @endif>Working Space</option>
                            <option value="Office" @if($conferenceFacility->type === "Office") selected @endif>Office</option>
                        </select>
                        @error('type')
                            <div class="mt-2 text-danger fs-6">
                                 {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="about" class="form-label">About</label>
                        <textarea name="about" class="form-control @error('about') border border-danger @enderror" id="about" cols="30" rows="10">{{ $conferenceFacility->about }}</textarea>
                        @error('about')
                            <div class="mt-2 text-danger fs-6">
                                 {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="capacity" class="form-label">Capacity</label>
                        <input type="number" class="form-control @error('capacity') border border-danger @enderror" name="capacity" id="capacity" value="{{ $conferenceFacility->capacity }}">
                        @error('capacity')
                            <div class="mt-2 text-danger fs-6">
                                 {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control @error('price') border border-danger @enderror" name="price" id="price" value="{{ $conferenceFacility->price }}">
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
                    @if($conferenceFacility->image)
                    <div class="mb-3">
                        <img style="width:50px;height:50px" src="{{ asset('storage/images/conference_facilities/'.$conferenceFacilities->image) }}" alt="" class="rounded">
                    </div>
                    @endif
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection