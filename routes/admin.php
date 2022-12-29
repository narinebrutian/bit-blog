<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LoginController;
use Illuminate\Support\Facades\Route;


//Admin Routes

Route::group(['prefix' => 'alliance-admin'], function() {

   Route::get('login', [LoginController::class, 'showLoginForm'])->name('admin-login');

   Route::post('login', [LoginController::class, 'login'])->name('admin-login-post');

   Route::get('logout', [LoginController::class, 'logout'])->name('admin-logout');

   Route::group(['middleware' => ['auth:admin']], function () {

        Route::get('/home', [HomeController::class, 'index'])->name('admin-home');

        Route::get('/profile',[HomeController::class, 'showAdminProfile'])->name('admin.profile');

        Route::resource('/users', UserController::class);

        Route::resource('/post', PostController::class);

        Route::resource('/tag', TagController::class);

        Route::resource('/category', CategoryController::class);

        Route::resource('/role', RoleController::class);

        Route::resource('/admins', AdminController::class);

        Route::post('/roles/{role}/permissions', [RoleController::class, 'givePermission'])->name('roles.permissions');
        Route::delete('/roles/{role}/permissions/{permission}', [RoleController::class, 'revokePermission'])->name('roles.permissions.revoke');

        Route::resource('/permissions', PermissionController::class);
//
//        Route::post('/permissions/{permission}/roles', [PermissionController::class, 'assignRole'])->name('permissions.roles');
//        Route::delete('/permissions/{permission}/roles/{role}', [PermissionController::class, 'removeRole'])->name('permissions.roles.remove');
//
//        Route::get('/users', [UserController::class, 'index'])->name('users.index');
//        Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
//        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
//        Route::post('/users/{user}/roles', [UserController::class, 'assignRole'])->name('users.roles');
//        Route::delete('/users/{user}/roles/{role}', [UserController::class, 'removeRole'])->name('users.roles.remove');
//        Route::post('/users/{user}/permissions', [UserController::class, 'givePermission'])->name('users.permissions');
//        Route::delete('/users/{user}/permissions/{permission}', [UserController::class, 'revokePermission'])->name('users.permissions.revoke');
   });

});
