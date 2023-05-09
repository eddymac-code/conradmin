<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Gate::denies('permissions.access')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }
        
        $data = [];
        $permissions = Permission::where('parent_id', 0)->get();
        foreach ($permissions as $permission) {
            array_push($data, $permission);
            $subpermissions = Permission::where('parent_id', $permission->id)->get();
            foreach ($subpermissions as $sub) {
                array_push($data, $sub);
            }
        }

        $permissions = Permission::paginate(10);

        return view('users.permissions.data', [
            // 'data' => $data,
            'permissions' => $permissions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Gate::denies('permissions.create')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }
        
        $parent_permissions = Permission::where('parent_id', 0)->get();
        
        return view('users.permissions.create', [
            'parent_permissions' => $parent_permissions
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Gate::denies('permissions.create')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }
        
        $this->validate($request, [
            'name' => 'required'
        ]);

        $parent_id = $request->type == 0 ? "0" : $request->parent_id;

        Permission::create(['name' => $request->name, 'parent_id' => $parent_id, 'description' => $request->description]);

        return redirect()->route('permissions.create')->with('message', 'Successfully added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        if (Gate::denies('permissions.view')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }
        
        return view('users.permissions.show', [
            'permission' => $permission,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        if (Gate::denies('permissions.update')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }
        
        $parent_permission = Permission::where('parent_id', 0)->get();
        
        if ($permission->parent_id == 0) {
            $selected = 0;
        } else {
            $selected = 1;
        }
        
        return view('users.permissions.edit', [
            'permission' => $permission,
            'parent_permission' => $parent_permission,
            'selected' => $selected
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        if (Gate::denies('permissions.update')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }
        
        $this->validate($request, [
            'name' => 'required'
        ]);

        $permission->update(['name' => $request->name, 'parent_id' => $request->type == 0 ? "0" : $request->parent_id, 'description' => $request->description]);

        return redirect()->route('permissions')->with('message', 'Successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        if (Gate::denies('permissions.delete')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }
        
        $permission->delete();

        return redirect()->route('permissions')->with('message', 'Permission deleted.');
    }
}
