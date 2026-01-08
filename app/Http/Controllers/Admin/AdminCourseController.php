<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminCourseController extends Controller
{
    public function index(Request $request)
    {
        $courses = Course::with('category')->notDeleted()->get();
        $selectedCourse = null;

        if ($request->has('course_id')) {
            $selectedCourse = Course::with(['category', 'coursedetails'])->notDeleted()->findOrFail($request->query('course_id'));
        }

        return view('admin.courses.index', compact('courses', 'selectedCourse'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.courses.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'grade' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'course_details' => 'required|array|min:1',
            'course_details.*.name' => 'required|string|max:255',
            'course_details.*.content' => 'required|url',
            'course_details.*.description' => 'required|string',
        ]);

        $data = $request->only(['name', 'category_id', 'grade', 'price', 'description']);
        $data['is_deleted'] = false;
        $course = Course::create($data);

        foreach ($request->course_details as $detailData) {
            $course->coursedetails()->create($detailData);
        }

        return redirect()->route('admin.courses.index')->with('success', 'Course created successfully.');
    }

    public function edit($id)
    {
        $selectedCourse = Course::with(['category', 'coursedetails'])->notDeleted()->findOrFail($id);
        $categories = Category::all();
        return view('admin.courses.edit', compact('selectedCourse', 'categories'));
    }

    public function update(Request $request, $id)
    {
        logger('Update Course Request:', $request->all());

        $course = Course::notDeleted()->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'grade' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'course_details' => 'required|array|min:1',
            'course_details.*.id' => 'nullable|exists:course_details,id',
            'course_details.*.name' => 'required|string|max:255',
            'course_details.*.content' => 'required|url',
            'course_details.*.description' => 'required|string',
        ]);

        $data = $request->only(['name', 'category_id', 'grade', 'price', 'description']);
        $course->update($data);

        $existingDetailIds = $course->coursedetails()->pluck('id')->toArray();
        $submittedDetailIds = array_filter(array_column($request->course_details, 'id'));

        $course->coursedetails()->whereNotIn('id', $submittedDetailIds)->delete();

        foreach ($request->course_details as $detailData) {
            if (isset($detailData['id']) && in_array($detailData['id'], $existingDetailIds)) {
                $course->coursedetails()->where('id', $detailData['id'])->update([
                    'name' => $detailData['name'],
                    'content' => $detailData['content'],
                    'description' => $detailData['description'],
                ]);
            } else {
                $course->coursedetails()->create($detailData);
            }
        }

        return redirect()->route('admin.courses.index', ['course_id' => $course->id])->with('success', 'Course updated successfully.');
    }

    public function destroy($id)
    {
        logger('Destroy Course:', ['id' => $id]);

        $course = Course::notDeleted()->findOrFail($id);
        $course->update(['is_deleted' => true]);

        return redirect()->route('admin.courses.index')->with('success', 'Course deleted successfully.');
    }
}
