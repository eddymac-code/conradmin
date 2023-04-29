@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="my-4 p-2">
            <h2>Role: <span class="fw-bold text-primary">{{ $role->name }}</span></h2>
            <p class="lead">Here, you will view the role's details and perform further actions.</p>
        </div>
        @if (session('message'))
            <div class="p-2 my-2 rounded bg-success text-white text-center fw-bold">
                {{ session('message') }}
            </div> 
        @endif
        <div class="p-2">
            <div class="card col-sm-12 col-lg-6 mx-auto mb-3">
                <div class="card-header">{{ $role->name }} ({{ $role->permissions->count() }} {{ Str::plural('permission', $role->permissions->count()) }})</div>
                <div class="card-body">
                    <h3>Role Users</h3>
                    <ul class="list-group">
                        @forelse ($role->users as $user)
                        <li class="list-group-item">{{ $user->name }}</li>
                        @empty
                        <li class="list-group-item">No users for this role yet.</li>
                        @endforelse
                    </ul>
                </div>
                <div class="card-footer"><a href="{{ route('role.assign.permissions', $role) }}" class="btn btn-primary float-end">Manage Permissions for this Role</a></div>
                <div class="clearfix"></div>
            </div>

            <div class="card col-sm-12 col-lg-6 mx-auto">
                <div class="card-header">
                    <h3>Assign this role to a user</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('assign', $role) }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="position" class="form-label">User</label>
                            <select class="form-select" name="user" aria-label="Select user">
                                <option> --Select-- </option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">
                                        {{ $user->name }}
                                    </option>        
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <div class="card-footer"></div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
@endsection