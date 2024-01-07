<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Department;
use App\Imports\ProductImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Contracts\View\View;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(): View
    {
        $permissions = auth()->user()->roles->first()->permissions->pluck('name')->toArray();
        !in_array('view products', $permissions) && abort(403, 'Unauthorized action.');
        $products = Product::all()->sortBy('created_at')->load('category', 'department', 'creator');
        return view('products.index', compact('products'));
    }

    public function show(Product $product): View
    {
        $permissions = auth()->user()->roles->first()->permissions->pluck('name')->toArray();
        !in_array('view products', $permissions) && abort(403, 'Unauthorized action.');
        return view('products.show', compact('product'));
    }

    public function create(): View
    {
        $permissions = auth()->user()->roles->first()->permissions->pluck('name')->toArray();
        !in_array('create products', $permissions) && abort(403, 'Unauthorized action.');
        $categories = Category::all();
        $departments = Department::all();
        $method = 'POST';
        $route = route('products.store');
        $product = null;
        return view('products.create', compact('categories', 'departments', 'method', 'route', 'product'));
    }

    public function store(ProductRequest $request): RedirectResponse
    {
        $permissions = auth()->user()->roles->first()->permissions->pluck('name')->toArray();
        !in_array('create products', $permissions) && abort(403, 'Unauthorized action.');
        $file = $request->file('image');
        unset($request['image']);
        $product = Product::create($request->validated());
        $product->addMedia($file)->toMediaCollection('product-images');
        return redirect()->route('products.index');
    }

    public function edit(Product $product): View
    {
        $permissions = auth()->user()->roles->first()->permissions->pluck('name')->toArray();
        !in_array('edit products', $permissions) && abort(403, 'Unauthorized action.');
        $categories = Category::all();
        $departments = Department::all();
        $method = 'PUT';
        $route = route('products.update', $product);
        return view('products.edit', compact('categories', 'departments', 'method', 'route', 'product'));
    }

    public function update(ProductRequest $request, Product $product): RedirectResponse
    {
        $permissions = auth()->user()->roles->first()->permissions->pluck('name')->toArray();
        !in_array('edit products', $permissions) && abort(403, 'Unauthorized action.');
        $file = $request->file('image');
        unset($request['image']);
        $product->update($request->validated());
        $file && $product->addMedia($file)->toMediaCollection('product-images');
        return redirect()->route('products.index');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $permissions = auth()->user()->roles->first()->permissions->pluck('name')->toArray();
        !in_array('delete products', $permissions) && abort(403, 'Unauthorized action.');
        $product->delete();
        return redirect()->route('products.index');
    }

    public function import(Request $request): RedirectResponse
    {
        $permissions = auth()->user()->roles->first()->permissions->pluck('name')->toArray();
        !in_array('create products', $permissions) && abort(403, 'Unauthorized action.');
        $request->validate([
            'file' => 'required|mimes:xlsx',
        ]);
        $file = request()->file('file');
        Excel::import(new ProductImport, $file);
        return redirect()->route('products.index');
    }
}
