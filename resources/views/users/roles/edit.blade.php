@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="my-4 p-2">
            <h2>Edit: <span class="fw-bold text-primary">{{ $role->name }}</span></h2>
            <p class="lead">Here, you can edit the above role.</p>
        </div>
        <div class="p-2">
            <form method="post" enctype="multipart/form-data" action="{{ route('roles.edit', $role) }}">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control @error('name')border border-danger @enderror" 
                    name="name" id="name" value="{{ $role->name }}">
            
                    @error('name')
                        <div class="mt-2 fs-6 text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection