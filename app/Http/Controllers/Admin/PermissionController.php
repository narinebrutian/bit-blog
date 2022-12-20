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

class PermissionController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $permissions = Permission::all();

        return view('admin.permissions.index', compact('permissions'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('admin.permissions.create');
    }

    /**
     * @param PermissionRequest $request
     * @return RedirectResponse
     */
    public function store(PermissionRequest $request): RedirectResponse
    {
        $validated = $request->validate(['name' => 'required']);

        Permission::create($validated);

        return redirect()->route('admin.permissions.index')->with('message', 'Permission created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * @param Permission $permission
     * @return View
     */
    public function edit(Permission $permission): View
    {
        $roles = Role::all();

        return view('admin.permissions.edit', compact('permission', 'roles'));
    }

    /**
     * @param PermissionRequest $request
     * @param Permission $permission
     * @param $id
     * @return RedirectResponse
     */
    public function update(PermissionRequest $request, Permission $permission, $id): RedirectResponse
    {
        $permission = Permission::findOrFail($id);

        $permission->update();

        return redirect()->route('admin.permissions.index')->with('message', 'Permission updated.');
    }

    /**
     * @param Permission $permission
     * @return RedirectResponse
     */
    public function destroy(Permission $permission): RedirectResponse
    {
        $permission->delete();

        return back()->with('message', 'Permission deleted.');
    }

    /**
     * @param Request $request
     * @param Permission $permission
     * @return RedirectResponse
     */
    public function assignRole(RoleRequest $request, Permission $permission): RedirectResponse
    {
        if ($permission->hasRole($request->role)) {
            return back()->with('message', 'Role exists.');
        }

        $permission->assignRole($request->role);
        return back()->with('message', 'Role assigned.');
    }

    /**
     * @param Permission $permission
     * @param Role $role
     * @return RedirectResponse
     */
    public function removeRole(Permission $permission, Role $role): RedirectResponse
    {
        if ($permission->hasRole($role)) {
            $permission->removeRole($role);
            return back()->with('message', 'Role removed.');
        }

        return back()->with('message', 'Role not exists.');
    }
}
