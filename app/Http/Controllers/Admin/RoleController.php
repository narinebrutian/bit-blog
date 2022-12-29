<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use http\Client\Request;
use Illuminate\Http\RedirectResponse;
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
        $roles = Role::whereNotIn('name', ['admin'])->get();
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
        ]);

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
     * @param int $id
     * @return RedirectResponse
     */
    public function update(RoleRequest $request, int $id): RedirectResponse
    {
        $role = Role::findOrFail($id);
        $role->name = $request->name;
        $role->update();

        return to_route('role.index')->with('message', 'Role Updated successfully.');
    }

    /**
     * @param Role $role
     * @return RedirectResponse
     */
    public function destroy(Role $role): RedirectResponse
    {
        $role->delete();

        return back()->with('success', 'Role is deleted');
    }

    /**
     * @param Request $request
     * @param Role $role
     * @return RedirectResponse
     */
    public function givePermission(Request $request, Role $role): RedirectResponse
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
