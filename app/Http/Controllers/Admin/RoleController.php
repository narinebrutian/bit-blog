<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRequest;
use App\Http\Requests\RoleRequest;
use App\Models\admin\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::whereNotIn('name', ['admin'])->get();
        $permissions = Permission::all();

        return view('admin.roles.show', compact('roles', 'permissions'));
    }

    public function create()
    {
        $permissions = Permission::all();

        return view('admin.roles.create', compact('permissions'));
    }

    public function store(RoleRequest $request)
    {
        Role::create([
            'name' => $request->name
        ]);

        return redirect()->route('role.index')->with('message', 'Role Created successfully.');
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();

        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    /**
     * @param RoleRequest $request
     * @param Role $role
     * @param $id
     * @return RedirectResponse
     */
    public function update(RoleRequest $request, Role $role, $id)
    {
        $role = Role::findOrFail($id);

        $role->name = $request->name;

        $role->update();

        return to_route('admin.roles.index')->with('message', 'Role Updated successfully.');
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return back()->with('message', 'Role deleted.');
    }

    public function givePermission(PermissionRequest $request, Role $role)
    {
        if($role->hasPermissionTo($request->permission)){
            return back()->with('message', 'Permission exists.');
        }
        $role->givePermissionTo($request->permission);
        return back()->with('message', 'Permission added.');
    }

    public function revokePermission(Role $role, Permission $permission)
    {
        if($role->hasPermissionTo($permission)){
            $role->revokePermissionTo($permission);
            return back()->with('message', 'Permission revoked.');
        }
        return back()->with('message', 'Permission not exists.');
    }
}
