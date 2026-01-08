@if($course)
    {{-- 1. LOGIC: Calculate Image URL ONLY ONCE here --}}
    @php
        $videoId = '';
        // Default fallback image
        $thumbnailUrl = asset('images/placeholder-video.jpg'); 
        
        // Check if there is a video and extract thumbnail
        if (isset($course->coursedetails[0]) && preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $course->coursedetails[0]->content, $match)) {
            $videoId = $match[1];
            $thumbnailUrl = "https://img.youtube.com/vi/{$videoId}/hqdefault.jpg"; 
        }

        // 1. Define your FAQs here (Easy to edit text)
        $faqs = [
            [
                'question' => 'Khóa học này dành cho ai?',
                'answer' => 'Khóa học được thiết kế cho học sinh từ lớp 6 đến lớp 12 muốn nâng cao kiến thức và kỹ năng trong môn học tương ứng.' 
            ],
            [
                'question' => 'Tôi có được cấp chứng chỉ sau khi hoàn thành không?',
                'answer' => 'Có. Sau khi hoàn thành 100% bài học và bài kiểm tra cuối khóa, hệ thống sẽ tự động cấp chứng chỉ hoàn thành khóa học cho bạn.'
            ],
            [
                'question' => 'Tôi có thể xem lại bài học trong bao lâu?',
                'answer' => 'Bạn được quyền truy cập trọn đời (Lifetime Access). Bạn có thể xem lại bất cứ lúc nào và bao nhiêu lần tùy thích.'
            ],
            [
                'question' => 'Nếu tôi gặp khó khăn trong quá trình học thì sao?',
                'answer' => 'Chúng tôi có nhóm hỗ trợ riêng cho học viên. Giảng viên và đội ngũ trợ giảng sẽ giải đáp thắc mắc của bạn trong vòng 24h.'
            ]
        ];

        // 2. Prepare Schema for Google (Auto-generated from above)
        $faqSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => array_map(function($faq) {
                return [
                    '@type' => 'Question',
                    'name' => $faq['question'],
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => $faq['answer']
                    ]
                ];
            }, $faqs)
        ];
        $courseSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'Course',
            'name' => $course->name,
            'description' => Str::limit($course->description ?? '', 300),
            'provider' => [
                '@type' => 'Organization',
                'name' => config('app.name'),
                'sameAs' => url('/'),
            ],
            'educationalLevel' => 'Grade ' . ($course->grade ?? ''),
            'courseCode' => 'COURSE-' . $course->id,
            'image' => $thumbnailUrl,
            'url' => url()->current(),
        ];

        // Product + Offer for price
        $productSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'Product',
            'name' => $course->name,
            'description' => Str::limit($course->description ?? '', 300),
            'image' => $thumbnailUrl,
            'sku' => 'COURSE-' . $course->id,
            'brand' => [
                '@type' => 'Brand',
                'name' => config('app.name'),
            ],
            'offers' => [
                '@type' => 'Offer',
                'price' => (string) ($course->price ?? 0),
                'priceCurrency' => 'VND',
                'availability' => 'https://schema.org/InStock',
                'url' => url()->current(),
            ],
        ];

        $breadcrumbsSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                [
                    '@type' => 'ListItem',
                    'position' => 1,
                    'name' => 'Trang chủ',
                    'item' => route('welcome'),
                ],
                [
                    '@type' => 'ListItem',
                    'position' => 2,
                    'name' => 'Khóa học',
                    'item' => route('category.index'),
                ],
                [
                    '@type' => 'ListItem',
                    'position' => 3,
                    'name' => $course->name,
                    'item' => url()->current(),
                ],
            ],
        ];
    @endphp

    {{-- 2. SEO SECTION: Pass data to Layout --}}
    @section('title','Khóa học ' . $course->name)
    @section('meta_description', Str::limit($course->description ?? 'Học khóa học ' . $course->name . ' online.', 200))
    @section('meta_image', $thumbnailUrl) 

    @section('og_title','Khóa học ' . $course->name)
    @section('og_description', Str::limit($course->description ?? 'Học khóa học ' . $course->name . ' online.', 200))
    @section('og_image', $thumbnailUrl)
    
    {{-- 3. CONTENT: Render the page --}}
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $course->name }}
            </h2>
        </x-slot>

        <div class="py-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200" itemscope itemtype="https://schema.org/Course">
                        <meta itemprop="provider" content="Philine's Course Page">
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                            <div class="lg:col-span-2">
                                <div class="rounded-xl overflow-hidden shadow-lg mb-6">
                                    {{-- USE THE VARIABLE WE CALCULATED AT TOP --}}
                                    <img itemprop="image" src="{{ $thumbnailUrl }}" alt="Video Thumbnail" class="w-full aspect-video object-cover">
                                </div>

                                <h1 itemprop="name" class="text-2xl font-bold text-gray-800 mb-4">{{ $course->name }}</h1>
                                
                                {{-- ... (Keep your Course Info: Category, Grade, Time) ... --}}
                                <div class="flex items-center mb-4 text-sm text-gray-600">
                                    <div class="flex items-center mr-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                        <span>{{ $course->category->name }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        <span>Lớp {{ $course->grade }}</span>
                                    </div>
                                </div>

                                <div class="mb-8">
                                    <h2 class="text-lg font-semibold mb-2 text-gray-800">Mô tả khóa học</h2>
                                    <p itemprop="description" class="text-gray-600" style="text-align: justify; line-height: 1.5;">
                                        {!! nl2br(e($course->description ?? '')) !!}
                                    </p>
                                </div>

                                {{-- ... (Keep your Course Content/Accordion logic here) ... --}}
                                <div class="mb-8">
                                    <h2 class="text-lg font-semibold mb-4 text-gray-800">Nội dung khóa học</h2>
                                    <div class="space-y-3">
                                        @forelse($course->coursedetails as $index => $detail)
                                            {{-- Calculate logic for Detail Items --}}
                                            @php
                                            $detailVideoId = '';
                                            $detailThumbnailUrl = asset('images/placeholder-video.jpg');
                                            if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $detail->content ?? '', $match)) {
                                                $detailVideoId = $match[1];
                                                $detailThumbnailUrl = "https://img.youtube.com/vi/{$detailVideoId}/hqdefault.jpg";
                                            }
                                            @endphp
                                            
                                            <div x-data="{ open: false }" class="border border-gray-200 rounded-lg overflow-hidden">
                                                <button @click="open = !open" class="w-full bg-gray-50 px-4 py-3 flex justify-between items-center cursor-pointer hover:bg-gray-100 focus:outline-none">
                                                    <div class="font-medium text-left">{{ $index + 1 }}. {{ $detail->name }}</div>
                                                    <svg :class="{'transform rotate-180': open}" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                                    </svg>
                                                </button>
                                                <div x-show="open" x-collapse class="p-4 bg-white border-t border-gray-200">
                                                    <p class="text-gray-600 text-sm mb-2">{{ $detail->description ?? '' }}</p>
                                                    <div class="rounded-xl overflow-hidden shadow-md mb-2">
                                                        <img src="{{ $detailThumbnailUrl }}" alt="Detail Thumbnail" class="w-full aspect-video object-cover">
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <p class="text-gray-600">Chưa có nội dung chi tiết.</p>
                                        @endforelse
                                    </div>
                                </div>

                                <div class="mt-12 mb-8">
                                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Câu hỏi thường gặp</h2>
                                    
                                    <div class="space-y-4">
                                        @foreach($faqs as $index => $faq)
                                            <div x-data="{ active: false }" class="border border-gray-200 rounded-lg bg-white overflow-hidden">
                                                <button 
                                                    @click="active = !active" 
                                                    class="w-full flex justify-between items-center px-6 py-4 text-left font-medium text-gray-800 hover:bg-gray-50 transition-colors duration-150 focus:outline-none"
                                                >
                                                    <span>{{ $faq['question'] }}</span>
                                                    {{-- Icon rotates when open --}}
                                                    <svg :class="{'rotate-180': active}" class="w-5 h-5 text-gray-500 transform transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                                    </svg>
                                                </button>
                                                
                                                {{-- Answer Area --}}
                                                <div 
                                                    x-show="active" 
                                                    x-collapse 
                                                    class="px-6 pb-4 text-gray-600 leading-relaxed border-t border-gray-100"
                                                    style="display: none;"
                                                >
                                                    <div class="pt-4">
                                                        {{ $faq['answer'] }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="lg:col-span-1">
                                {{-- ... (Your Price, Buy Buttons, and Includes list) ... --}}
                                <div class="border border-gray-200 rounded-xl shadow-sm p-6 sticky top-4">
                                    <div class="mb-4">
                                        <div class="text-3xl font-bold text-blue-600 mb-2">{{ number_format($course->price) }} VND</div>
                                        <div class="flex items-center text-sm text-gray-500">
                                            <span>Truy cập trọn đời</span>
                                        </div>
                                    </div>

                                    @auth
                                        @if(!auth()->user()->courses->contains($course->id))
                                            {{-- Buy Buttons --}}
                                            <form action="{{ route('cart.add', $course) }}" method="POST" class="mb-4">
                                                @csrf
                                                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg shadow-md flex items-center justify-center">
                                                    Thêm vào giỏ hàng
                                                </button>
                                            </form>
                                            <form action="{{ route('cart.buy', $course) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="w-full border border-blue-600 text-blue-600 hover:bg-blue-50 font-bold py-3 px-4 rounded-lg">Mua ngay</button>
                                            </form>
                                        @else
                                            <a href="{{ route('course.learn', $course->id) }}" class="w-full bg-green-600 text-white font-bold py-3 px-4 rounded-lg text-center block">Bắt đầu học</a>
                                        @endif
                                    @else
                                        <a href="{{ route('login') }}" class="w-full bg-blue-600 text-white font-bold py-3 px-4 rounded-lg text-center block">Đăng nhập để mua khóa học</a>
                                    @endauth

                                    <div class="divide-y divide-gray-200 mt-4">
                                        <div class="py-4">
                                            <h3 class="font-medium text-gray-800 mb-2">Khóa học bao gồm:</h3>
                                            {{-- List items --}}
                                            <ul class="space-y-2 text-sm text-gray-600">
                                                <li class="flex items-center"><svg class="h-5 w-5 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg> Tài liệu học tập</li>
                                            </ul>
                                        </div>
                                        <!-- Facebook share removed -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
@else
    <p>Khóa học không tồn tại.</p>
@endif

{{-- Schema.org script --}}
<script type="application/ld+json">
{!! json_encode($courseSchema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}
</script>
<script type="application/ld+json">
{!! json_encode($productSchema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}
</script>
<script type="application/ld+json">
{!! json_encode($breadcrumbsSchema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}
</script>
<script type="application/ld+json">
{!! json_encode($faqSchema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}
</script>
<script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=692c78ff4bb269982e55aa5f&product=sop' async='async'></script>
