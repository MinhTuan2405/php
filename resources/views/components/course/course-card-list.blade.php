<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
    @foreach ($courses as $course)
        <x-course.course-card :course="$course" />
    @endforeach
</div>

@if(count($courses) === 0)
<div class="flex flex-col items-center justify-center py-16 bg-white rounded-lg shadow-sm border border-gray-100">
    <div class="w-20 h-20 bg-indigo-100 rounded-full flex items-center justify-center mb-6">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
        </svg>
    </div>
    <h3 class="text-xl font-medium text-gray-800 mb-2">Không tìm thấy khóa học</h3>
    <p class="text-gray-600 text-center max-w-md mb-6">Hiện tại chưa có khóa học nào trong danh mục này. Vui lòng quay lại sau hoặc thử tìm kiếm với từ khóa khác.</p>
    <a href="{{ route('category.index') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-600 to-blue-600 text-white rounded-full hover:from-indigo-700 hover:to-blue-700 transition duration-200">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        Quay lại danh mục
    </a>
</div>
@endif
