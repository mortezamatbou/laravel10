<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionTest extends Controller
{

    public function index(): View
    {
        $users = User::all();
        return view('permissions.index', compact('users'))->with('title', 'Permission Package Test');
    }

    public function user_add(): View
    {
//        $role = Role::create(['name' => 'writer']);
//        $permission = Permission::create(['name' => 'edit users']);

        return view('permissions.user_add')->with('title', 'Add new user');
    }

    public function permission_list(): View
    {
        $permissions = Permission::all();
        return view('permissions.permission_list', compact('permissions'))->with('title', 'Permissions');
    }

    public function role_list(): View
    {
        $roles = Role::all();
        return view('permissions.role_list', compact('roles'))->with('title', 'Roles');
    }

    public function test(): void
    {
        $role = Role::findByName('writer', 'web');
        // pre_print("$role->name | $role->guard_name");

        $permission = Permission::findByName('edit users', 'web');
        // pre_print("$permission->name | $permission->guard_name");

        // --- Assign a permission to a role. using either of these methods --- //
        // pass a permission to a role
        $role->givePermissionTo($permission);
        // pass a role to permission
        // $permission->assignRole($role);
        // -------------------------------------------------------------------- //

        // Remove permission from a role
        // $role->revokePermissionTo($permission);

//        $users = User::all();
//        foreach ($users as $user) {
//            echo "$user->id $user->name $user->email";
//            echo '<br>';
//        }

        $user = User::where('email', 'mori@lobdown.com')->first();
        pre_print($user->permissions);






    }


}
