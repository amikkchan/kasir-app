<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        // Ambil semua kategori + produk yang berelasi
        $categories = Category::with('products')->get();

        return view('categories.index', compact('categories'));
    }

    public function store(StoreCategoryRequest $r)
    {
        Category::create($r->validated());
        return back()->with('success', 'Kategori dibuat.');
    }

    public function update(StoreCategoryRequest $r, Category $category)
    {
        $category->update($r->validated());
        return back()->with('success', 'Kategori diupdate.');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return back()->with('success', 'Kategori dihapus.');
    }
}
