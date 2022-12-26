<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Models\admin\Admin;
use App\Models\admin\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $admins = Admin::all();

        return view('admin.admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $roles = Role::all();
        return view('admin.admins.create', compact('roles'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        Admin::create([
            'name' => $request->name
        ]);

        return redirect()->route('admins.index')->with('message', 'Admin Created successfully.');
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
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $admin = Admin::findOrFail($id);

        return view('admin.admins.edit', compact('admin'));
    }

    /**
     * @param AdminRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(AdminRequest $request, int $id): RedirectResponse
    {
        $admin = Admin::findOrFail($id);

        $admin->name = $request->name;

        $admin->update();

        return to_route('admin.admins.index')->with('message', 'Admin Updated successfully.');
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $admin = Admin::findOrFail($id);

        $admin->delete();

        return back()->with('message', 'Role deleted.');
    }
}
