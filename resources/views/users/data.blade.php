@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="my-4 p-2">
            <h2>Users</h2>
            <p class="lead">Here, you will find all users' information at a glance</p>
        </div>
        <div class="my-2">
            <a href="{{ route('users.create') }}" class="btn btn-primary float-md-end">Add User</a>
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
                    <th scope="col">NAME</th>
                    <th scope="col">EMAIL</th>
                    <th scope="col">ACTION</th>
                  </tr>
                </thead>
                <tbody>
                    @if ($users->count() < 1)
                        <tr>
                           <td colspan="5" class="text-center">No Users here yet</td> 
                        </tr>
                    @else
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($users as $user)
                            <tr>
                                <th scope="row">{{ ++$i }}</th>
                                <td><img style="width:30px;height:30px;" src="{{ asset('/storage/images/users/'.$user->image) ?? '' }}" alt="User Image"></td>
                                <td><span class="fw-bold">{{ $user->name }}</span></td>
                                <td><span class="fw-bold">{{ $user->email }}</span></td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-default dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa-solid fa-bars"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                          <li><a class="dropdown-item" href="{{ route('users.show', $user) }}">View</a></li>
                                          <li><a class="dropdown-item" href="{{ route('users.edit', $user) }}">Edit</a></li>
                                          <li>
                                            <form action="{{ route('users.delete', $user) }}" method="post">
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