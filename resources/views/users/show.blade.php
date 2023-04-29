@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="my-4 p-2">
            <h2>User: {{ $user->name }}</h2>
            <p class="lead">View user's details.</p>
        </div>
        <div class="p-2">
            <div class="card w-md-50 mx-auto">
                <div class="card-header">{{ $user->name }}</div>
                <div class="card-body d-md-flex align-items-center justify-content-around">
                    <img style="width:200px;height:200px;" class="mb-sm-3 rounded-circle" src="{{ asset('/storage/images/users/'.$user->image) ?? '' }}" alt="User Image">
                    <ul class="list-group">
                        <li class="list-group-item">{{ $user->email }}</li>
                        <li class="list-group-item">{{ 'Role' }}</li>
                    </ul>
                </div>
                <div class="card-footer"><a href="{{ route('users.edit', $user) }}" class="btn btn-primary float-end">Edit</a></div>
                <div class="clearfix"></div>
            </div>

        </div>
    </div>
@endsection