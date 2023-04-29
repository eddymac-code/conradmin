@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="my-4 p-2">
            <h2>Assigning/Revoking permissions for role: <span class="fw-bold text-primary">{{ $role->name }}</span></h2>
            <p class="lead">Here, you will manage this role's permissions.</p>
        </div>
        
        <div class="p-2">
            <div class="card col-sm-12 col-lg-8 mx-auto mb-3">
                <div class="card-header">{{ $role->name }}</div>
                <div class="card-body">
                    @if (!$data)
                    <div class="card">
                        <div class="card-body">
                            <p class="lean">No permissions to assign.</p>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('permissions.create') }}" class="btn btn-primary float-right">Create Permissions</a>
                        </div>
                    </div>
                @else
                <div class="panel">
                    <form action="{{ route('role.assign.permissions', $role) }}" method="post">
                        @csrf
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Permission</th>
                                                    <th scope="col">Description</th>
                                                    <th scope="col">Assigned?</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data as $permission)
                                                    <div class="mb-3">
                                                    <tr>
                                                        <td>
                                                            @if ($permission->parent_id == 0)
                                                                <strong>{{ $permission->name }}</strong>
                                                            @else
                                                                __{{ $permission->name }}
                                                            @endif
                                                        </td>
                                                        <td>{{ $permission->description }}</td>
                                                        <td>
                                                            <input type="checkbox" name="permission_id[]"
                                                            value="{{ $permission->id }}" @if($role->permissions->contains($permission->id)) checked @endif>
                                                        </td>
                                                    </tr>
                                                    </div>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
                @endif
                </div>
                <div class="card-footer"><a href="{{ route('roles.edit', $role) }}" class="btn btn-primary float-end">Edit</a></div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
@endsection