@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="my-4 p-2">
            <h2>Permission: <span class="fw-bold text-primary">{{ $permission->name }}</span></h2>
            <p class="lead">Here, you will view the permission's details and perform further actions.</p>
        </div>
        
        <div class="p-2">
            <div class="card col-sm-12 col-lg-6 mx-auto mb-3">
                <div class="card-header">Name: <span class="fw-bold">{{ $permission->name }}</span></div>
                <div class="card-body">
                    <div>
                        <h3>Type: @if($permission->parent_id == 0) Parent Permission @else Child Permission @endif</h3>
                    </div>
                    <h3>Permission Roles</h3>
                    <ul class="list-group">
                        @forelse ($permission->roles as $role)
                        <li class="list-group-item">{{ $role->name }}</li>
                        @empty
                        <li class="list-group-item">No roles has this permission yet.</li>
                        @endforelse
                    </ul>
                </div>
                <div class="card-footer"><a href="{{ route('permissions.edit', $permission) }}" class="btn btn-primary float-end">Edit</a></div>
                <div class="clearfix"></div>
            </div>

            {{-- <div class="card col-sm-12 col-lg-6 mx-auto">
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
                <div class="card-footer"><a href="{{ route('roles.edit', $role) }}" class="btn btn-primary float-end">See Permissions for this role</a></div>
                <div class="clearfix"></div>
            </div> --}}
        </div>
    </div>
@endsection