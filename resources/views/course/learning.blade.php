@if($course)
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ $course->name }}
            </h2>
            <nav class="flex">
                <a href="{{ route('dashboard') }}" class="text-indigo-600 hover:text-indigo-800 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Trang chủ
                </a>
            </nav>
        </div>
    </x-slot>

    <div class="py-12 pt-24 bg-gradient-to-b from-gray-50 to-white min-h-screen">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Left column: Lesson list -->
                <div class="col-span-1 bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-indigo-600 to-blue-600 px-6 py-4 text-white">
                        <h3 class="text-lg font-semibold">Danh sách bài học</h3>
                        <p class="text-sm text-indigo-100">{{ $course->coursedetails->count() }} bài học</p>
                    </div>
                    <div class="p-4">
                        <ul class="space-y-1">
                            @foreach($course->coursedetails as $index => $detail)
                                <li>
                                    <button 
                                        class="w-full text-left px-4 py-3 rounded-lg transition-all duration-200 flex items-center group hover:bg-indigo-50" 
                                        onclick="selectLesson({{ $index }})"
                                        id="lesson-button-{{ $index }}"
                                    >
                                        <span class="flex-shrink-0 w-8 h-8 flex items-center justify-center bg-indigo-100 text-indigo-600 rounded-full mr-3 group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                                            {{ $index + 1 }}
                                        </span>
                                        <span class="text-gray-700 group-hover:text-indigo-700 font-medium transition-colors">
                                            {{ $detail->name }}
                                        </span>
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Right column: Video player -->
                <div class="col-span-1 md:col-span-3">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="p-6" id="video-player-area">
                            <div class="flex items-center justify-center h-64 bg-gray-50 rounded-lg border border-gray-200">
                                <div class="text-center">
                                    <div class="animate-pulse flex justify-center mb-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <p class="text-gray-500">Đang tải bài học...</p>
                                    <p class="text-sm text-gray-400 mt-2">Vui lòng chờ trong giây lát</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-6 py-4 border-t border-gray-100">
                            <div class="flex items-center justify-between">
                                <div class="text-sm text-gray-500">
                                    <span class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Bạn cần xem hết video hiện tại trước khi chuyển sang bài tiếp theo
                                    </span>
                                </div>
                                <div>
                                    <button id="next-lesson-btn" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition-colors flex items-center opacity-50 cursor-not-allowed" disabled>
                                        Bài tiếp theo
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Course progress -->
                    <div class="mt-6 bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Tiến độ khóa học</h3>
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="bg-gradient-to-r from-indigo-600 to-blue-600 h-2.5 rounded-full" style="width: 0%" id="progress-bar"></div>
                        </div>
                        <div class="flex justify-between mt-2">
                            <span class="text-sm text-gray-500">0% hoàn thành</span>
                            <span class="text-sm text-gray-500">0/{{ $course->coursedetails->count() }} bài học</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @php
        // Prepare lessons array
        $lessons = $course->coursedetails->map(function ($detail) {
            $videoId = '';
            if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $detail->content, $match)) {
                $videoId = $match[1];
            }
            return [
                'title' => $detail->name,
                'videoId' => $videoId,
            ];
        })->values();
    @endphp

    <script>
   let lessons = @json($lessons);
let currentIndex = 0;
let canChangeLesson = true;
let player;
let maxWatchedTime = 0;
let seekCheckInterval;
let completedLessons = [];

// Load YouTube Iframe API
let tag = document.createElement('script');
tag.src = "https://www.youtube.com/iframe_api";
document.body.appendChild(tag);

function onYouTubeIframeAPIReady() {
    loadLesson(0); // Auto-load first lesson
}

function loadLesson(index) {
    const lesson = lessons[index];
    currentIndex = index;
    canChangeLesson = false;
    maxWatchedTime = 0;

    // Update active lesson in sidebar
    document.querySelectorAll('[id^="lesson-button-"]').forEach(button => {
        button.classList.remove('bg-indigo-50', 'text-indigo-700');
    });
    document.getElementById(`lesson-button-${index}`).classList.add('bg-indigo-50', 'text-indigo-700');

    const videoArea = document.getElementById('video-player-area');
    videoArea.innerHTML = `
        <h2 class="text-xl font-semibold mb-4 text-gray-800">${lesson.title}</h2>
        <div class="relative w-full aspect-video rounded-lg overflow-hidden shadow-md" id="yt-player-wrapper">
            <div id="yt-player" class="w-full h-full"></div>
        </div>
    `;

    if (seekCheckInterval) clearInterval(seekCheckInterval);

    player = new YT.Player('yt-player', {
        videoId: lesson.videoId,
        playerVars: {
            rel: 0,
            modestbranding: 1,
            playsinline: 1
        },
        events: {
            onReady: function () {
                // Check every second for unauthorized seeking
                seekCheckInterval = setInterval(() => {
                    const currentTime = player.getCurrentTime();
                    if (currentTime - maxWatchedTime > 2) {
                        player.seekTo(maxWatchedTime, true); // Rewind to max watched
                    } else {
                        maxWatchedTime = Math.max(maxWatchedTime, currentTime);
                    }
                }, 1000);
            },
            onStateChange: function (event) {
                if (event.data === YT.PlayerState.ENDED) {
                    canChangeLesson = true;
                    clearInterval(seekCheckInterval); // Stop checking on end
                    
                    // Mark lesson as completed
                    if (!completedLessons.includes(currentIndex)) {
                        completedLessons.push(currentIndex);
                        updateProgress();
                    }
                    
                    // Enable next button if not last lesson
                    const nextBtn = document.getElementById('next-lesson-btn');
                    if (currentIndex < lessons.length - 1) {
                        nextBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                        nextBtn.disabled = false;
                        nextBtn.onclick = function() {
                            loadLesson(currentIndex + 1);
                        };
                    }
                }
            }
        }
    });
}

function updateProgress() {
    const progressPercent = (completedLessons.length / lessons.length) * 100;
    document.getElementById('progress-bar').style.width = `${progressPercent}%`;
    document.querySelector('.text-sm.text-gray-500').textContent = `${progressPercent.toFixed(0)}% hoàn thành`;
    document.querySelector('.text-sm.text-gray-500 + .text-sm.text-gray-500').textContent = 
        `${completedLessons.length}/${lessons.length} bài học`;
}

function selectLesson(index) {
    if (index === currentIndex) return;

    if (!canChangeLesson) {
        Swal.fire({
            title: 'Chưa thể chuyển bài!',
            text: 'Bạn phải xem hết video hiện tại trước khi chuyển bài.',
            icon: 'warning',
            confirmButtonColor: '#4f46e5',
            confirmButtonText: 'Đã hiểu'
        });
        return;
    }

    loadLesson(index);
}

// Add SweetAlert2 for better alerts
if (typeof Swal === 'undefined') {
    const sweetAlertScript = document.createElement('script');
    sweetAlertScript.src = 'https://cdn.jsdelivr.net/npm/sweetalert2@11';
    document.body.appendChild(sweetAlertScript);
}
    </script>
</x-app-layout>
@else
<div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-indigo-50 to-blue-50">
    <div class="text-center p-8 bg-white rounded-xl shadow-md max-w-md">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-indigo-500 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <p class="text-gray-600 text-lg mb-4">Khóa học không tồn tại hoặc đã bị xóa.</p>
        <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            Quay về trang chủ
        </a>
    </div>
</div>
@endif
