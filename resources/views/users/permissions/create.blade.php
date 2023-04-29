@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('message'))
            <div class="p-2 my-2 rounded bg-success text-white text-center fw-bold">
                {{ session('message') }}
            </div> 
        @endif
        <div class="my-4 p-2">
            <h2>Create User Permissions</h2>
            <p class="lead">Here, you can add a new user permission to the records.</p>
        </div>
        <div class="p-2 col-sm-12 col-md-6 mx-auto">
            <form method="post" enctype="multipart/form-data" action="{{ route('permissions.create') }}">
                @csrf
                <div class="mb-3">
                    <label for="type" class="form-label">Type</label>
                    <select class="form-select" name="type" id="type">
                        <option value="0">Parent Permission</option>
                        <option value="1">Sub Permission</option>
                    </select>
                </div>
                <div class="mb-3" id="parent">
                    <label for="type" class="form-label">Parent</label>
                    <select class="form-select" name="parent_id">
                        @foreach ($parent_permissions as $permission)
                            <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control @error('name')border border-danger @enderror" 
                    name="name" id="name" value="{{ old('name') }}">
            
                    @error('name')
                        <div class="mt-2 fs-6 text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" 
                    class="form-control" rows="3">{{ old('description') }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection