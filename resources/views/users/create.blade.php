@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="my-4 p-2">
            <h2>Create Users</h2>
            <p class="lead">Here, you can add a new system user to the records.</p>
        </div>
        <div class="p-2">
            <form method="post" enctype="multipart/form-data" action="{{ route('users.create') }}">
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
                <div class="mb-3">
                  <label for="email" class="form-label">Email address</label>
                  <input type="email" name="email" class="form-control @error('email')border border-danger @enderror" 
                 id="email" value="{{ old('email') }}">
            
                  @error('email')
                        <div class="mt-2 fs-6 text-danger">
                            {{ $message }}
                        </div>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" name="password" class="form-control @error('password')border border-danger @enderror"
                   id="password">
            
                  @error('password')
                        <div class="mt-2 fs-6 text-danger">
                            {{ $message }}
                        </div>
                  @enderror
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control @error('password')border border-danger @enderror" 
                    id="password_confirmation">
                </div>
                <div class="mb-3">
                    <label for="photo" class="form-label">Photo</label>
                    <input type="file" class="form-control @error('photo')border border-danger @enderror" 
                    name="photo" id="photo" value="{{ old('photo') }}">
            
                    @error('photo')
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