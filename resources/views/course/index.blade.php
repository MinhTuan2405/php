<x-app-layout>
    <div class="pt-20 pb-6 bg-gradient-to-r from-indigo-900 to-blue-900 text-white">
        <div class="container mx-auto px-4 md:px-6 lg:px-8">
            <h1 class="text-3xl md:text-4xl font-bold mb-2">Khóa học của tôi</h1>
            <p class="text-blue-100 max-w-2xl">Danh sách khóa học bạn đã mua </p>
        </div>
    </div>
    <div class="container mx-auto px-4 md:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
            <div class="p-6 border-b border-gray-100">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <h2 class="text-xl font-semibold text-gray-800">Danh sách khóa học</h2>
                    </div>
            </div>

        <div class="p-6" id="courses-list">

    @if ($courses->isNotEmpty())
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($courses as $courseUser)
                <x-course.course-card :course="$courseUser->course" />
            @endforeach
        </div>
    @else
        <div class="flex flex-col items-center justify-center py-16 bg-white rounded-lg shadow-sm border border-gray-100">
            <div class="w-20 h-20 bg-indigo-100 rounded-full flex items-center justify-center mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
            </div>
            <h3 class="text-xl font-medium text-gray-800 mb-2">Bạn chưa đăng ký khóa học</h3>
            <p class="text-gray-600 text-center max-w-md mb-6">Hiện tại bạn chưa đăng ký khóa học nào. Hãy khám phá các khóa học và bắt đầu học ngay hôm nay!</p>
            <a href="{{ route('category.index') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-600 to-blue-600 text-white rounded-full hover:from-indigo-700 hover:to-blue-700 transition duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Quay lại danh mục
            </a>
        </div>
    @endif
    </div>

    </div>
    </div>
</x-app-layout>