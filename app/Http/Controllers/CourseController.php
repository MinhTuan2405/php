<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\CourseUser;
use Illuminate\View\View;


class CourseController extends Controller
{
    // Course detail
    // public function show($course_id): View
    // {
    //     $course = Course::with(['category', 'coursedetails'])->notDeleted()
    //         ->findOrFail($course_id);

    //     return view('course.show', compact('course'));
    // }

    public function show(Course $course)
    {
        // Laravel automatically found the product matching the slug in the URL!
        return view('course.show', compact('course'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $selectedCategories = session()->get('selectedCategories', []);

        $courses = Course::query();

        if (!empty($query)) {
            $courses->where('name', 'LIKE', "%{$query}%");
        }

        if (!empty($selectedCategories)) {
            $courses->whereIn('category_id', $selectedCategories);
        }

        return view('components.course.course-card-list', ['courses' => $courses->get()])->render();
    }

    // course list of user
    public function index(): View
    {
        $courses = CourseUser::where('user_id', auth()->id())
            ->with(['course.category'])
            ->get();

        return view('course.index', compact('courses'));
    }

    public function showcourseuser($course_id): View
    {
        $course = Course::with(['category', 'coursedetails'])->notDeleted()
            ->findOrFail($course_id);

        return view('profile.course.show', compact('course'));
    }
    public function startLearning($course_id): View
    {
        $course = Course::with(['category', 'coursedetails'])->notDeleted()
            ->findOrFail($course_id);

        return view('course.learning', compact('course'));
    }
}
