@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="my-4 p-2">
            <h2>Update room</h2>
            <p class="lead">Manage hotel room: <span class="fw-bold text-primary">{{ $room->name }}</span></p>
        </div>
        @if (session('message'))
            <div class="p-2 my-2 rounded bg-success text-white text-center fw-bold">
                {{ session('message') }}
            </div> 
        @endif
        <div class="p-2">
            <div class="col-md-6">
                <form action="{{ route('rooms.create', $room) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <h3>Create Room</h3>
                    </div>
                    <div class="form-group mb-3">
                        <label for="type" class="form-label">Type</label>
                        <select class="form-select @error('type') border border-danger @enderror" aria-label="Type Select" name="type" id="type">
                            <option value="">-- Select --</option>
                            @foreach ($roomTypes as $type)
                                <option value="{{ $type->id }}" @if($room->roomType === $type) selected @endif>{{ $type->name }}</option>
                            @endforeach
                        </select>
                        @error('type')
                            <div class="mt-2 text-danger fs-6">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="no" class="form-label">Room Number</label>
                        <input type="number" class="form-control @error('number') border border-danger @enderror" name="number" id="no" value="{{ $room->number }}">
                        @error('number')
                            <div class="text-danger fs-6 mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="name" class="form-label">Room Name</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ $room->name }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" class="form-control" id="description" cols="30" rows="10">{{ $room->description }}</textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control @error('price') border border-danger @enderror" name="price" id="price" value="{{ $room->price }}">
                        @error('price')
                            <div class="mt-2 text-danger fs-6">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                       <label for="image" class="form-label">Main Image</label>
                       <input type="file" class="form-control @error('image') border border-danger @enderror" name="image" id="image">
                       @error('image')
                           <div class="mt-2 text-danger fs-6">
                                {{ $message }}
                           </div>
                       @enderror 
                    </div>
                    @if ($room->image)
                        <div>
                            <img src="{{ asset('storage/images/rooms/'.$room->image) }}" alt="Room Image" style="height:30px;width:30px">
                        </div>
                    @endif
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection