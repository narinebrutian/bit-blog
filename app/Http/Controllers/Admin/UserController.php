<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRequest;
use App\Http\Requests\RoleRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $users = User::all();

        return view('admin.users.show', compact('users'));
    }

    /**
     * @param User $user
     * @return View
     */
    public function show(User $user): View
    {
        $roles = Role::all();
        $permissions = Permission::all();

        return view('admin.users.role', compact('user', 'roles', 'permissions'));
    }

    /**
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $user = User::findOrFail($id);

        return view('admin.users.edit', compact('user'));
    }

    /**
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request,int $id): RedirectResponse
    {
        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->email = $request->email;

        $user->update();

        return redirect()->route('users.index')->with('success', 'User info updated successfully!');
    }

    /**
     * @param RoleRequest $request
     * @param User $user
     * @return RedirectResponse
     */
    public function assignRole(RoleRequest $request, User $user): RedirectResponse
    {
        if ($user->hasRole($request->role)) {
            return back()->with('message', 'Role exists.');
        }

        $user->assignRole($request->role);
        return back()->with('message', 'Role assigned.');
    }

    /**
     * @param User $user
     * @param Role $role
     * @return RedirectResponse
     */
    public function removeRole(User $user, Role $role): RedirectResponse
    {
        if ($user->hasRole($role)) {
            $user->removeRole($role);
            return back()->with('message', 'Role removed.');
        }

        return back()->with('message', 'Role not exists.');
    }


    /**
     * @param PermissionRequest $request
     * @param User $user
     * @return RedirectResponse
     */
    public function givePermission(PermissionRequest $request, User $user): RedirectResponse
    {
        if ($user->hasPermissionTo($request->permission)) {

            return back()->with('message', 'Permission exists.');
        }
        $user->givePermissionTo($request->permission);

        return back()->with('message', 'Permission added.');
    }

    /**
     * @param User $user
     * @param Permission $permission
     * @return RedirectResponse
     */
    public function revokePermission(User $user, Permission $permission): RedirectResponse
    {
        if ($user->hasPermissionTo($permission)) {
            $user->revokePermissionTo($permission);
            return back()->with('message', 'Permission revoked.');
        }

        return back()->with('message', 'Permission does not exist.');
    }

    /**
     * @param User $user
     * @return RedirectResponse
     */
    public function destroy(User $user): RedirectResponse
    {
        if ($user->hasRole('admin')) {
            return back()->with('message', 'You are admin.');
        }

        $user->delete();

        return back()->with('message', 'User deleted.');
    }
}
