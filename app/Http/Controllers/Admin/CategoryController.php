<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\User\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $categories = Category::all();

        return view('admin.category.show', compact('categories'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('admin.category.category');
    }

    /**
     * @param StoreCategoryRequest $request
     * @return RedirectResponse
     */
    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        $tag = Category::create([
            "name" => $request->name,
            "slug" => $request->slug
        ]);

        $tag->save();

        return redirect()->route('category.index')->with('success','Category created successfully!');
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
        $category = Category::findOrFail($id);

        return view('admin.category.edit', compact('category'));
    }

    /**
     * @param StoreCategoryRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(StoreCategoryRequest $request, int $id): RedirectResponse
    {
        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->slug = $request->slug;

        $category->update();

        return redirect()->route('category.index')->with('success', 'Category updated successfully');
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->back();
    }
}
