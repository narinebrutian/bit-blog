<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRequest;
use App\Http\Requests\RoleRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
//        $roles = Role::whereNotIn('name', ['admin'])->get();
        $roles =  Role::all();
        $permissions = Permission::all();

        return view('admin.roles.show', compact('roles', 'permissions'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        $permissions = Permission::all();

        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * @param RoleRequest $request
     * @return RedirectResponse
     */
    public function store(RoleRequest $request): RedirectResponse
    {
        Role::create([
            'name' => $request->name
        ])->permissions()->sync($request->role);

        return redirect()->route('role.index')->with('message', 'Role Created successfully.');
    }

    /**
     * @param Role $role
     * @return View
     */
    public function edit(Role $role): View
    {
        $permissions = Permission::all();

        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    /**
     * @param RoleRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(RoleRequest $request, $id): RedirectResponse
    {
        $role = Role::findOrFail($id);

        $role->name = $request->name;

        $role->update();

        return to_route('role.index')->with('message', 'Role Updated successfully.');
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $role = Role::findOrFail($id);

        $role->delete();

        return redirect() -> route('role.index');
    }

    /**
     * @param PermissionRequest $request
     * @param Role $role
     * @return RedirectResponse
     */
    public function givePermission(PermissionRequest $request, Role $role): RedirectResponse
    {
        if($role->hasPermissionTo($request->permission)){
            return back()->with('message', 'Permission exists.');
        }
        $role->givePermissionTo($request->permission);
        return back()->with('message', 'Permission added.');
    }

    /**
     * @param Role $role
     * @param Permission $permission
     * @return RedirectResponse
     */
    public function revokePermission(Role $role, Permission $permission): RedirectResponse
    {
        if($role->hasPermissionTo($permission)){
            $role->revokePermissionTo($permission);
            return back()->with('message', 'Permission revoked.');
        }
        return back()->with('message', 'Permission not exists.');
    }
}
