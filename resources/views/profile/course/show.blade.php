@if($course)
<!-- Nội dung hiện tại của view -->


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $course->name }}
        </h2>
    </x-slot>

    <div class="py-12 pt-24">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <!-- Left Column - Video and Details -->
                        <div class="lg:col-span-2">
                            @if($course->content)
                            <div class="rounded-xl overflow-hidden shadow-lg mb-6">
                                @php
                                $videoId = '';
                                if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $course->video_url, $match)) {
                                $videoId = $match[1];
                                }
                                @endphp
                                <iframe src="https://www.youtube.com/embed/{{ $videoId }}" class="w-full aspect-video"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen>
                                </iframe>
                            </div>
                            @endif

                            <h1 class="text-2xl font-bold text-gray-800 mb-4">{{ $course->name }}</h1>

                            <div class="flex items-center mb-4 text-sm text-gray-600">
                                <div class="flex items-center mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                    <span>{{ $course->category->name }}</span>
                                </div>
                                <div class="flex items-center mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    <span>Lớp {{ $course->grade }}</span>
                                </div>
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>10 giờ học</span>
                                </div>
                            </div>

                            <div class="mb-8">
                                <h3 class="text-lg font-semibold mb-2 text-gray-800">Mô tả khóa học</h3>
                                <p class="text-gray-600">
                                    {{ $course->description ?? 'Khóa học này sẽ giúp bạn nắm vững kiến thức và kỹ năng cần thiết để thành công trong môn học. Được thiết kế bởi các giảng viên có nhiều kinh nghiệm, khóa học cung cấp nội dung chất lượng cao và bài tập thực hành phong phú.' }}
                                </p>
                            </div>

                            <div class="mb-8">
                                <h3 class="text-lg font-semibold mb-4 text-gray-800">Nội dung khóa học</h3>
                                <div class="space-y-3">
                                    @forelse($course->coursedetails as $index => $detail)
                                    <div class="border border-gray-200 rounded-lg overflow-hidden">
                                        <div class="bg-gray-50 px-4 py-3 flex justify-between items-center cursor-pointer hover:bg-gray-100">
                                            <div class="font-medium">{{ $index + 1 }}. {{ $detail->name }}</div>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </div>
                                    </div>
                                    @empty
                                    <p class="text-gray-600">Chưa có nội dung chi tiết cho khóa học này.</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>

                        <!-- Right Column - Price and CTA -->
                        <div class="lg:col-span-1">
                            <div class="border border-gray-200 rounded-xl shadow-sm p-6 sticky top-24">
                                <div class="mb-4">
                                    <div class="text-3xl font-bold text-blue-600 mb-2">{{ number_format($course->price) }} VND</div>
                                    <div class="flex items-center text-sm text-gray-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span>Truy cập trọn đời</span>
                                    </div>
                                </div>

                                @auth
                                @if(!auth()->user()->courses->contains($course->id))
                                <form action="{{ route('cart.add', $course) }}" method="POST" class="mb-4">
                                    @csrf
                                    <button type="submit"
                                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg transition duration-150 shadow-md hover:shadow-lg flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        Thêm vào giỏ hàng
                                    </button>
                                </form>
                                <button type="button" class="w-full border border-blue-600 text-blue-600 hover:bg-blue-50 font-bold py-3 px-4 rounded-lg transition duration-150 mb-6">
                                    Mua ngay
                                </button>
                                @else
                                <a href="#" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-lg transition duration-150 shadow-md hover:shadow-lg flex items-center justify-center mb-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Bắt đầu học
                                </a>
                                @endif
                                @else
                                <a href="{{ route('login') }}" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg transition duration-150 shadow-md hover:shadow-lg flex items-center justify-center mb-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                    </svg>
                                    Đăng nhập để đăng ký
                                </a>
                                @endauth

                                <div class="divide-y divide-gray-200">
                                    <div class="py-4">
                                        <h4 class="font-medium text-gray-800 mb-2">Khóa học này bao gồm:</h4>
                                        <ul class="space-y-2">
                                            <li class="flex items-center text-sm text-gray-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                10 giờ video bài giảng
                                            </li>
                                            <li class="flex items-center text-sm text-gray-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                20 bài tập thực hành
                                            </li>
                                            <li class="flex items-center text-sm text-gray-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                Tài liệu học tập
                                            </li>
                                            <li class="flex items-center text-sm text-gray-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                Chứng chỉ hoàn thành
                                            </li>
                                            <li class="flex items-center text-sm text-gray-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                Hỗ trợ trực tuyến
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- Share button removed -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a href="{{ route('course.index') }}" class="text-indigo-600 hover:underline">← Quay lại danh sách</a>

</x-app-layout>
@else
<p>Khóa học không tồn tại.</p>
@endif
