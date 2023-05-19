@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="my-4 p-2">
            <h2>Edit Page Content</h2>
            <p class="lead">Here, you can edit {{ $page->title }} page content.</p>
        </div>
        <div class="p-2">
            <form method="post" enctype="multipart/form-data" action="{{ route('pages.edit', $page->id) }}">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="photo" class="form-label">Photo</label>
                    <input type="file" class="form-control @error('photo')border border-danger @enderror" 
                    name="photo" id="photo">
                    @if ($page->image)
                        <div class="mb-3">
                            <img style="width:70px;height:70px;" src="{{ asset('/storage/images/pages/'.$page->image) ?? '' }}" alt="Landing Image">
                        </div>
                    @endif
            
                    @error('photo')
                        <div class="mt-2 fs-6 text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control @error('title')border border-danger @enderror" 
                    name="title" id="title" value="{{ $page->title }}">
            
                    @error('title')
                        <div class="mt-2 fs-6 text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea name="content" class="editor form-control" id="" cols="30" rows="10">{{ $page->content }}</textarea>
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