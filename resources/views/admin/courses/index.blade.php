@extends('layouts.admin')

@section('title', 'Manage Courses')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-3xl font-bold text-gray-800">Manage Courses</h1>
    <a href="{{ route('admin.courses.create') }}"
        class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-5 py-2.5 rounded-lg hover:from-purple-700 hover:to-indigo-700 transition-all duration-200 flex items-center shadow-md">
        <i class="fas fa-plus mr-2"></i> Add New Course
    </a>
</div>

<div class="flex gap-6">
    <!-- Left: Courses List -->
    <div class="w-1/3 flex flex-col">
        <div class="bg-white rounded-xl shadow-md p-5 mb-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-4 flex items-center">
                <i class="fas fa-book text-purple-500 mr-2"></i> Courses List
            </h2>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
                <input type="text" id="course-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full pl-10 p-2.5" placeholder="Search courses...">
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md flex-1 overflow-hidden">
            <div class="max-h-[calc(100vh-250px)] overflow-y-auto p-3 space-y-2" id="courses-list">
                @forelse ($courses as $course)
                <a href="{{ route('admin.courses.index', ['course_id' => $course->id]) }}"
                    class="flex items-center p-3 rounded-lg {{ $selectedCourse && $selectedCourse->id == $course->id ? 'bg-purple-50 border-l-4 border-purple-500' : 'bg-gray-50 hover:bg-gray-100' }} transition-all duration-200 group">
                    <div class="flex-1">
                        <h3 class="font-medium text-gray-800 group-hover:text-purple-700 transition-colors">{{ $course->name }}</h3>
                        <div class="flex items-center text-sm text-gray-500 mt-1">
                            <span class="bg-indigo-100 text-indigo-800 text-xs font-medium px-2.5 py-0.5 rounded-full mr-2">{{ $course->category->name }}</span>
                            <span>Grade: {{ $course->grade }}</span>
                        </div>
                    </div>
                    <i class="fas fa-chevron-right text-gray-300 group-hover:text-purple-500 transition-colors"></i>
                </a>
                @empty
                <div class="flex flex-col items-center justify-center py-8 text-center">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-book text-gray-400 text-xl"></i>
                    </div>
                    <p class="text-gray-500">No courses found.</p>
                    <p class="text-sm text-gray-400 mt-1">Create your first course to get started.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Right: Course Details -->
    <div class="w-2/3">
        @if ($selectedCourse)
        <div class="bg-white rounded-xl shadow-md p-6 mb-6 animate-fade-in-up">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-1">{{ $selectedCourse->name }}</h2>
                    <div class="flex items-center text-gray-500">
                        <span class="bg-indigo-100 text-indigo-800 text-xs font-medium px-2.5 py-0.5 rounded-full mr-2">{{ $selectedCourse->category->name }}</span>
                        <span class="mr-2">|</span>
                        <span>Grade: {{ $selectedCourse->grade }}</span>
                        <span class="mx-2">|</span>
                        <span class="font-medium text-green-600">${{ $selectedCourse->price }}</span>
                    </div>
                </div>
                <div class="flex space-x-2">
                    <a href="{{ route('admin.courses.edit', $selectedCourse->id) }}"
                        class="flex items-center bg-indigo-50 text-indigo-700 px-4 py-2 rounded-lg hover:bg-indigo-100 transition-colors duration-200">
                        <i class="fas fa-edit mr-2"></i> Edit
                    </a>
                    <form id="delete-course-form-{{ $selectedCourse->id }}" action="{{ route('admin.courses.destroy', $selectedCourse->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="button"
                            onclick="confirmDelete('delete-course-form-{{ $selectedCourse->id }}', 'Are you sure you want to delete <strong>{{ $selectedCourse->name }}</strong>? This will also delete all associated course details.')"
                            class="flex items-center bg-red-50 text-red-700 px-4 py-2 rounded-lg hover:bg-red-100 transition-colors duration-200">
                            <i class="fas fa-trash-alt mr-2"></i> Delete
                        </button>
                    </form>
                </div>
            </div>

            <div class="border-t border-gray-100 pt-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-4 flex items-center">
                    <i class="fas fa-list-ul text-purple-500 mr-2"></i> Course Details
                </h3>

                @if(count($selectedCourse->coursedetails) > 0)
                <div class="grid gap-4">
                    @foreach ($selectedCourse->coursedetails as $detail)
                    <div class="bg-gray-50 rounded-lg p-4 hover:shadow-md transition-shadow duration-200">
                        <div class="flex justify-between items-start">
                            <h4 class="font-medium text-gray-800 mb-2">{{ $detail->name }}</h4>
                        </div>
                        <p class="text-sm text-gray-600 mb-2">{{ $detail->description }}</p>
                        <a href="{{ $detail->content }}" target="_blank" class="text-indigo-600 hover:text-indigo-800 text-sm flex items-center">
                            <i class="fas fa-external-link-alt mr-1"></i> View Content
                        </a>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="bg-gray-50 rounded-lg p-6 text-center">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-file-alt text-gray-400 text-xl"></i>
                    </div>
                    <p class="text-gray-500">No course details available.</p>
                    <a href="{{ route('admin.courses.edit', $selectedCourse->id) }}" class="text-purple-600 hover:text-purple-800 mt-2 inline-block">
                        Add details to this course
                    </a>
                </div>
                @endif
            </div>
        </div>
        @else
        <div class="bg-white rounded-xl shadow-md p-8 flex flex-col items-center justify-center text-center h-64">
            <div class="w-20 h-20 bg-purple-100 rounded-full flex items-center justify-center mb-4">
                <i class="fas fa-book-open text-purple-500 text-2xl"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-700 mb-2">No Course Selected</h3>
            <p class="text-gray-500 max-w-md">Select a course from the list to view its details, or create a new course to get started.</p>
        </div>
        @endif
    </div>
</div>

@section('scripts')
<script>
    // Simple search functionality
    document.getElementById('course-search').addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const courseItems = document.querySelectorAll('#courses-list > a');

        courseItems.forEach(item => {
            const courseName = item.querySelector('h3').textContent.toLowerCase();
            const categoryName = item.querySelector('.bg-indigo-100').textContent.toLowerCase();

            if (courseName.includes(searchTerm) || categoryName.includes(searchTerm)) {
                item.style.display = 'flex';
            } else {
                item.style.display = 'none';
            }
        });
    });
</script>
@endsection
@endsection