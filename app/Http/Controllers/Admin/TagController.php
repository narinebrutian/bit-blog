<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTagRequest;
use App\Models\User\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TagController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $tags = Tag::cursor();

        return view('admin.tag.show', compact('tags'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('admin.tag.tag');
    }

    /**
     * @param StoreTagRequest $request
     * @return RedirectResponse
     */
    public function store(StoreTagRequest $request): RedirectResponse
    {
        $tag = Tag::create([
            "name" => $request->name,
            "slug" => $request->slug
        ]);

        $tag->save();

        return redirect()->route('tag.index')->with('success','Tag created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return void
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
        $tag = Tag::findOrFail($id);

        return view('admin.tag.edit', compact('tag'));
    }

    /**
     * @param StoreTagRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(StoreTagRequest $request, int $id)
    {
        $tag = Tag::findOrFail($id);

        $tag->name = $request->name;
        $tag->slug = $request->slug;

        $tag->update();

        return redirect()->route('tag.index')->with('success', 'Tag updated successfully!');
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $tag = Tag::findOrFail($id);

        $tag->delete();

        return redirect()->back();
    }
}
