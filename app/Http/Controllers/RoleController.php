<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Gate::denies('roles.access')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }
        
        $roles = Role::all();
        return view('users.roles.data', [
            'roles' => $roles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Gate::denies('roles.create')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        return view('users.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Gate::denies('roles.create')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        $this->validate($request, [
            'name' => 'required'
        ]);

        Role::create(['name' => $request->name]);

        return redirect()->route('roles')->with('message', 'Successfully added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        if (Gate::denies('roles.view')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }
        
        $users = User::all();
        return view('users.roles.show', [
            'role' => $role,
            'users' => $users,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        if (Gate::denies('roles.update')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }
        
        return view('users.roles.edit', ['role' => $role]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        if (Gate::denies('roles.update')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }
        
        $this->validate($request, [
            'name' => 'required'
        ]);

        $role->update(['name' => $request->name]);

        return redirect()->route('roles')->with('message', 'Successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        if (Gate::denies('roles.delete')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }
        
        $role->delete();

        return redirect()->route('roles')->with('message', 'Role deleted.');
    }

    public function toUser(Request $request, Role $role)
    {
        if (Gate::denies('roles.update')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }
        
        $this->validate($request, [
            'user' => 'required'
        ]);

        $user = User::find($request->user);

        $user->assignRole($role->name);

        return redirect()->route('roles.show', $role)->with('message', 'Role successfully assigned.');
    }

    public function assignPermissionsIndex(Role $role)
    {
        if (Gate::denies('roles.update')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }
        
        $data = [];
        $permissions = Permission::where('parent_id', 0)->get();
        foreach ($permissions as $permission) {
            array_push($data, $permission);
            $sub_permissions = Permission::where('parent_id', $permission->id)->get();
            foreach ($sub_permissions as $value) {
                array_push($data, $value);
            }
        }

        return view('users.roles.assign_permissions', [
            'role' => $role,
            'data' => $data,
        ]);
    }

    public function assignPermissionsGo(Request $request, Role $role)
    {
        if (Gate::denies('roles.update')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        $permissions = [];

        if (!empty($request->permission_id)) {
            foreach ($request->permission_id as $id) {
                $p = Permission::findById($id);
                array_push($permissions, $p);
            }
        }

        $role->syncPermissions($permissions);

        return redirect()->route('roles.show', $role)->with('message', 'Successfully reassigned!');
    }
}
