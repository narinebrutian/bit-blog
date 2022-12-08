<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\User\UserHomeController;
use App\Http\Controllers\User\UserPostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//User Routes

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->namespace('User')->group( function(){

    Route::get('/', [UserHomeController::class, 'index'])->name('home');

    Route::get('post/{id}', [UserPostController::class, 'post'])->name('post');

    Route::get('post/category/{category}', [UserHomeController::class, 'category'])->name('category');

    Route::get('post/tag/{tag}', [UserHomeController::class, 'tag'])->name('tag');

});

//Admin Routes

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->namespace('Admin')->group(function (){

    Route::get('admin/home', [HomeController::class, 'index'])->name('admin-home');

});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->prefix('admin')->group(function() {

    Route::resource('/user', UserController::class);

    Route::resource('/post', PostController::class);

    Route::resource('/tag', TagController::class);

    Route::resource('/category', CategoryController::class);

});

//default jetstream routes

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
