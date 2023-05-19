@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="my-4 p-2">
            <h2>Pages</h2>
            <p class="lead">Here, you will find all pages' information at a glance</p>
        </div>
        <div class="my-2">
            <a href="{{ route('pages.create') }}" class="btn btn-primary float-md-end">Add Page</a>
        </div>
        <div class="clearfix"></div>
        @if (session('message'))
            <div class="p-2 my-2 rounded bg-success text-white text-center fw-bold">
                {{ session('message') }}
            </div> 
        @endif
        <div class="p-2">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">IMAGE</th>
                    <th scope="col">TITLE</th>
                    <th scope="col">ACTION</th>
                  </tr>
                </thead>
                <tbody>
                    @if ($pages->count() < 1)
                        <tr>
                           <td colspan="4" class="text-center">No Pages here yet</td> 
                        </tr>
                    @else
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($pages as $page)
                            <tr>
                                <th scope="row">{{ ++$i }}</th>
                                <td><img style="width:30px;height:30px;" src="{{ asset('/storage/images/pages/'.$page->image) ?? '' }}" alt="Landing Image"></td>
                                <td><span class="fw-bold">{{ $page->title }}</span></td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-default dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa-solid fa-bars"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                          <li><a class="dropdown-item" href="{{ route('pages.show', $page->id) }}">View</a></li>
                                          <li><a class="dropdown-item" href="{{ route('pages.edit', $page->id) }}">Edit</a></li>
                                          <li>
                                            <form action="{{ route('pages.delete', $page->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-decoration-none" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                          </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
              </table>
        </div>
    </div>
@endsection