<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $selectedCategory = null;

        if ($request->has('category_id')) {
            $selectedCategory = Category::findOrFail($request->query('category_id'));
        }

        return view('admin.categories.index', compact('categories', 'selectedCategory'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create($request->all());
        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category->update($request->all());
        return redirect()->route('admin.categories.index', ['category_id' => $id])->with('success', 'Category updated successfully.');
    }
}
