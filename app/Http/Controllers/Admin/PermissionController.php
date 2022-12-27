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

        Permission::create([
            'name' => $request->name
        ]);

        return redirect()->route('permissions.index')->with('message', 'Permission created.');
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
        $roles = Permission::all();

        return view('admin.permissions.edit', compact('permission', 'roles'));
    }

    /**
     * @param PermissionRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(PermissionRequest $request, int $id): RedirectResponse
    {
        $permission = Permission::findOrFail($id);
        $permission->name = $request->name;
        $permission->update();

        return redirect()->route('permissions.index')->with('message', 'Permission updated.');
    }

    /**
     * @param Permission $permission
     * @return RedirectResponse
     */
    public function destroy(Permission $permission): RedirectResponse
    {

        $permission->delete();

        return redirect() -> route('permissions.index') -> with('message', 'Permission deleted.');
    }
}
