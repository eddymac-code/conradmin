@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="my-4 p-2">
            <h2>Roles</h2>
            <p class="lead">Here, you will find all user roles related to this system.</p>
        </div>
        <div class="my-2">
            <a href="{{ route('roles.create') }}" class="btn btn-primary float-md-end">Add Role</a>
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
                    <th scope="col">PERMISSIONS</th>
                    <th scope="col">ACTION</th>
                  </tr>
                </thead>
                <tbody>
                    @if ($roles->count() < 1)
                        <tr>
                           <td colspan="5" class="text-center">No Roles here yet</td> 
                        </tr>
                    @else
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($roles as $role)
                            <tr>
                                <th scope="row">{{ ++$i }}</th>
                                <td><span class="fw-bold">{{ $role->name }}</span></td>
                                <td><span class="fw-bold">{{ $role->guard_name }}</span></td>
                                <td><span class="fw-bold">{{ $role->permissions->count() }} {{ Str::plural('permission', $role->permissions->count()) }}</span></td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-default dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa-solid fa-bars"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                          <li><a class="dropdown-item" href="{{ route('roles.show', $role) }}">View</a></li>
                                          <li><a class="dropdown-item" href="{{ route('roles.edit', $role) }}">Edit</a></li>
                                          <li>
                                            <form action="{{ route('roles.delete', $role) }}" method="post">
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