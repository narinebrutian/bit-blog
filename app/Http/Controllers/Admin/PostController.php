<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Models\User\Category;
use App\Models\User\Post;
use App\Models\User\Tag;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PostController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $posts = Post::all();

        return view('admin.post.show', compact('posts'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        $tags = Tag::all();
        $categories = Category::all();

        return view('admin.post.post', compact('tags', 'categories'));
    }

    /**
     * @param StorePostRequest $request
     * @return RedirectResponse
     */
    public function store(StorePostRequest $request): RedirectResponse
    {
        //$post = Post::create($request->validated());

        $post = Post::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'slug' => $request->slug,
            'status' => $request->status,
            'body' => $request->body,
            'image' => $request->image
        ]);

        $path = Storage::disk('local')->putFile('public/images', $request->image);
        $post->image = $path;

        $post->save();

        $post->tags()->sync($request->tags);
        $post->categories()->sync($request->categories);

        return redirect()->route('post.index')->with('success','Post created successfully!');
    }

    /**
     * @param $id
     * @return string
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
        $tags = Tag::all();
        $categories = Category::all();
        $post = Post::with('tags', 'categories')->findOrFail($id);

        return view('admin.post.edit', compact('post', 'tags', 'categories'));
    }

    /**
     * @param StorePostRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(StorePostRequest $request, int $id): RedirectResponse
    {
        $post = Post::findOrFail($id);

        $post->title = $request->title;
        $post->subtitle = $request->subtitle;
        $post->slug = $request->slug;
        $post->body = $request->body;
        $post->status = $request->status;

        if ($request->hasFile('image')){
            $path = Storage::disk('local')->put('public/images', $request->file('image'));
        }

        $post->image = $path;

        $post->tags()->sync($request->tags);
        $post->categories()->sync($request->categories);

        $post->update();

        return redirect()->route('post.index')->with('success','Post updated successfully!');

    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->back();
    }
}

//all() and cursor() are two different things.
//
//Normally cursor() method is used to reduce memory usage during fetching large amount of data.
//
//On the other hand all() method is used for fetching all the data from a particular table.
