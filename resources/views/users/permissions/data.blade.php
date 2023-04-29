@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="my-4 p-2">
            <h2>Permissions</h2>
            <p class="lead">Here, you will find all user permissions related to this system.</p>
        </div>
        <div class="my-2">
            <a href="{{ route('permissions.create') }}" class="btn btn-primary float-md-end">Add Permission</a>
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
                    <th scope="col">NAME</th>
                    <th scope="col">GUARD NAME</th>
                    <th scope="col">ACTION</th>
                  </tr>
                </thead>
                <tbody>
                    @if ($permissions->count() < 1)
                        <tr>
                           <td colspan="4" class="text-center">No Permissions here yet</td> 
                        </tr>
                    @else
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($permissions as $permission)
                            <tr>
                                <th scope="row">{{ ++$i }}</th>
                                <td><span class="fw-bold">{{ $permission->name }}</span></td>
                                <td><span class="fw-bold">{{ $permission->guard_name }}</span></td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-default dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa-solid fa-bars"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                          <li><a class="dropdown-item" href="{{ route('permissions.show', $permission) }}">View</a></li>
                                          <li><a class="dropdown-item" href="{{ route('permissions.edit', $permission) }}">Edit</a></li>
                                          <li>
                                            <form action="{{ route('permissions.delete', $permission) }}" method="post">
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
              <div class="d-flex">
                {{ $permissions->links() }}
              </div>
        </div>
    </div>
@endsection