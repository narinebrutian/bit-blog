<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * @return View
     */
    public function index() : View
    {
        return view('admin.home');
    }

    /**
     * @return View
     */
    public function showAdminProfile(): View
    {
        return view('admin.profile');
    }
}
