<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $courses = Course::with('category')->notDeleted()->get();

        return view('categories.index', compact('categories', 'courses'));
    }

    public function show(Category $category)
    {
        $courses = $category->courses;
        $categories = Category::all();

        return view('categories.show', compact('category', 'courses', 'categories'));
    }

    public function filter(Request $request)
    {
        $categories = Category::all();
        $selectedCategories = $request->input('categories', []);
        $minPrice = $request->filled('min_price') ? $request->input('min_price') : 0;
        $maxPrice = $request->filled('max_price') ? $request->input('max_price') : 10000000;

        $courses = Course::query();

        if (!empty($selectedCategories) && !in_array("", $selectedCategories)) {
            $courses->whereIn('category_id', $selectedCategories);
        }

        $courses->whereBetween('price', [$minPrice, $maxPrice]);

        return view('categories.index', [
            'categories' => $categories,
            'courses' => $courses->get(),
            'selectedCategories' => $selectedCategories,
        ]);
    }
}
