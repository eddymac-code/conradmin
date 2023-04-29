@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="my-4 p-2">
            <h2>Create User Roles</h2>
            <p class="lead">Here, you can add a new user role to the records.</p>
        </div>
        <div class="p-2">
            <form method="post" enctype="multipart/form-data" action="{{ route('roles.create') }}">
                @csrf
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
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection