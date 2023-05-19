<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions.
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        // Permission::create([
        //     ['name' => 'users.access', 'parent_id' => '0', 'description' => 'Access Users Module'],
        //     ['name' => 'users.view', 'parent_id' => '1', 'description' => 'View system users'],
        //     ['name' => 'users.create', 'parent_id' => '1', 'description' => 'Add system users'],
        //     ['name' => 'users.update', 'parent_id' => '1', 'description' => 'Update system users'],
        //     ['name' => 'users.delete', 'parent_id' => '1', 'description' => 'Delete system users'],
        //     ['name' => 'roles.view', 'parent_id' => '1', 'description' => 'View user roles'],
        //     ['name' => 'roles.create', 'parent_id' => '1', 'description' => 'Add user roles'],
        //     ['name' => 'roles.update', 'parent_id' => '1', 'description' => 'Update user roles'],
        //     ['name' => 'roles.delete', 'parent_id' => '1', 'description' => 'Delete user roles'],
        //     ['name' => 'permissions.view', 'parent_id' => '1', 'description' => 'View role permissions'],
        //     ['name' => 'permissions.create', 'parent_id' => '1', 'description' => 'Add role permissions'],
        //     ['name' => 'permissions.update', 'parent_id' => '1', 'description' => 'Update role permissions'],
        //     ['name' => 'permissions.delete', 'parent_id' => '1', 'description' => 'Delete role permissions'],
        //     ['name' => 'settings.access', 'parent_id' => '0', 'description' => 'Access Settings Module'],

        // ]);

        $arrayOfPermissionNames = ['users.access','users.view','users.create','users.update','users.delete',
    'roles.view', 'roles.create','roles.update','roles.delete','permissions.view','permissions.create','permissions.update',
'permissions.delete','settings.access','settings.update','pages.access','pages.view','pages.create','pages.update','pages.delete',
'services.access','rooms.access','rooms.view','rooms.create','rooms.update','rooms.delete',
'roomtypes.access','roomtypes.view','roomtypes.create','roomtypes.update','roomtypes.delete','roomtypes.assign'];
        $permissions = collect($arrayOfPermissionNames)->map(function ($permission) {
            $descArray = explode('.', $permission);
            $description = ucfirst($descArray[1]) . " " . $descArray[0];
            return ['name' => $permission, 'guard_name' => 'web', 'parent_id' => 0, 'description' => $description];
        });

        Permission::insert($permissions->toArray());

        // crete main role and assign created permissions
        $role = Role::create(['name' => 'Super Admin'])->givePermissionTo(Permission::all());

        User::find(1)->assignRole($role->name);
    }
}
