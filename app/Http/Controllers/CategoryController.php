<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\View\View;
use \Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
    public function index(): View
    {
        $permissions = auth()->user()->roles->first()->permissions->pluck('name')->toArray();
        !in_array('view categories', $permissions) && abort(403, 'Unauthorized action.');
        $categories = Category::all()->sortByDesc('created_at')->load('user');
        return view('categories.index', compact('categories'));
    }

    public function create(): View
    {
        $permissions = auth()->user()->roles->first()->permissions->pluck('name')->toArray();
        !in_array('create categories', $permissions) && abort(403, 'Unauthorized action.');
        $method = 'POST';
        $category = null;
        $route = route('categories.store');
        return view('categories.create', compact('method', 'category', 'route'));
    }

    public function store(CategoryRequest $request): RedirectResponse
    {
        $permissions = auth()->user()->roles->first()->permissions->pluck('name')->toArray();
        !in_array('create categories', $permissions) && abort(403, 'Unauthorized action.');
        $category = Category::create($request->validated());
        $category->user()->associate(auth()->user());
        $category->save();
        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(Category $category): View
    {
        $permissions = auth()->user()->roles->first()->permissions->pluck('name')->toArray();
        !in_array('edit categories', $permissions) && abort(403, 'Unauthorized action.');
        $method = 'PUT';
        $route = route('categories.update', $category);
        return view('categories.edit', compact('category', 'method', 'route'));
    }

    public function update(CategoryRequest $request, Category $category): RedirectResponse
    {
        $permissions = auth()->user()->roles->first()->permissions->pluck('name')->toArray();
        !in_array('edit categories', $permissions) && abort(403, 'Unauthorized action.');
        $category->update($request->validated());
        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $permissions = auth()->user()->roles->first()->permissions->pluck('name')->toArray();
        !in_array('delete categories', $permissions) && abort(403, 'Unauthorized action.');
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
