<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User\Category;
use App\Models\User\Post;
use App\Models\User\Tag;
use Illuminate\View\View;

class UserPostController extends Controller
{
    /**
     * @param int $id
     * @return View
     */
    public function post(int $id): View
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();
        $tags = Tag::all();

        return view('user.post', compact('categories', 'tags', 'post'));
    }
}
