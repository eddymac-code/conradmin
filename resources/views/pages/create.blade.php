@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="my-4 p-2">
            <h2>Create Page Content</h2>
            <p class="lead">Here, you can add new system page content.</p>
        </div>
        <div class="p-2">
            <form method="post" enctype="multipart/form-data" action="{{ route('pages.create') }}">
                @csrf
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
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control @error('title')border border-danger @enderror" 
                    name="title" id="title" value="{{ old('title') }}">
            
                    @error('title')
                        <div class="mt-2 fs-6 text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea name="content" id="editor" class="form-control" id="" cols="30" rows="10">{{ old('content') }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection

@section('footer-scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ))
            .catch( error => {
                console.log( error );
            } );
    </script>
@endsection