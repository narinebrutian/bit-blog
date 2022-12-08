<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User\Category;
use App\Models\User\Post;
use App\Models\User\Tag;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class UserHomeController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $posts = Post::orderBy('created_at')->paginate(3);

        return view('user.home', compact('posts'));
    }

    /**
     * @param Tag $tag
     * @return View
     */
    public function tag(Tag $tag): View
    {
        $posts =  $tag->posts();

        return view('user.home', compact('posts'));
    }

    /**
     * @param Category $category
     * @return View
     */
    public function category(Category $category): View
    {
        $posts =  $category->posts();

        return view('user.home', compact('posts'));
    }
}
