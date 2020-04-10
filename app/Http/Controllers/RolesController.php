<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{

    public function index()
    {
        return view('admin.roles.manage');
    }

    public function new(Request $request)
    {
        $role = Role::create(['name' => $request->name]);

        return back();
    }

    public function remove(Request $request)
    {
        $role = Role::findOrFail($request->input('group_id'));
        $role->delete();

        return redirect('admin/roles');
    }

    public function rolelist()
    {
        $roles = Role::all();

        return view('admin.roles.rolelist', compact('roles'));
    }

    public function edit($id)
    {
        $role = Role::find($id);
        $permissions = Permission::All();

        return view('admin.roles.editpermissions', compact('role', 'permissions'));
    }

    public function update(Request $request)
    {
        $role = Role::find($request->input('role_id'));
        $permissions = $request->input('data');

        $role->colour = $request->input('role_colour');
        $role->save();

        foreach ($permissions as $key => $permission) {
            $perm = Permission::find($permission['node_id']);

            if ($permission['value'] == 1) {
                $role->givePermissionTo($perm);
            } else {
                $role->revokePermissionTo($perm);
            }
        }

        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
    }

    public function assign($id)
    {
        $user = User::where('id', $id);

        $user->assignRole('Admin');


        $user->syncRoles('Administrator');

    }
}
