<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\User\UserHomeController;
use App\Http\Controllers\User\UserPostController;
use App\Http\Controllers\Admin\LoginController;
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

//Guest routes

Route::namespace('User')->get('/', [UserHomeController::class, 'index'])->name('home');

//User Routes

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->namespace('User')->group( function(){

    Route::get('/', [UserHomeController::class, 'index'])->name('home');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('post/{id}', [UserPostController::class, 'post'])->name('post');

    Route::get('post/category/{category}', [UserHomeController::class, 'category'])->name('category');

    Route::get('post/tag/{tag}', [UserHomeController::class, 'tag'])->name('tag');

});


//admin
require 'admin.php';
