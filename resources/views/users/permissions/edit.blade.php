@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="my-4 p-2">
            <h2>Edit Permission: <span class="fw-bold text-primary">{{ $permission->name }}</span></h2>
            <p class="lead">Here, you can edit the specified permission.</p>
        </div>
        <div class="p-2 col-sm-12 col-md-6 mx-auto">
            <form method="post" enctype="multipart/form-data" action="{{ route('permissions.edit', $permission) }}">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="type" class="form-label">Type</label>
                    <select class="form-select" name="type" id="type">
                        <option value="0" @if($selected == 1) selected @endif>Parent Permission</option>
                        <option value="1" @if($selected == 1) selected @endif>Sub Permission</option>
                    </select>
                </div>
                <div class="mb-3" id="parent">
                    <label for="type" class="form-label">Parent</label>
                    <select class="form-select" name="parent_id">
                        @foreach ($parent_permission as $p)
                            <option value="{{ $p->id }}">{{ $p->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control @error('name')border border-danger @enderror" 
                    name="name" id="name" value="{{ $permission->name }}">
            
                    @error('name')
                        <div class="mt-2 fs-6 text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" 
                    class="form-control" rows="3">{{ $permission->description }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection