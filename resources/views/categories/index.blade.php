<x-app-layout>
    <div class="pt-20 pb-6 bg-gradient-to-r from-indigo-900 to-blue-900 text-white">
        <div class="container mx-auto px-4 md:px-6 lg:px-8">
            <h1 class="text-3xl md:text-4xl font-bold mb-2">Khám phá khóa học</h1>
            <p class="text-blue-100 max-w-2xl">Tìm kiếm khóa học phù hợp với nhu cầu học tập của bạn từ danh sách đa dạng các danh mục</p>
        </div>
    </div>

    <div class="container mx-auto px-4 md:px-6 lg:px-8 py-8">
        <form action="{{ route('category.filter') }}" method="GET" class="bg-white rounded-xl shadow-md p-6 mb-8 border border-gray-100">
            <div class="mb-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 mr-2 text-indigo-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
                    </svg>
                    Lọc theo danh mục
                </h2>
                
                <ul class="flex flex-wrap gap-3">
                    <li>
                        <input type="checkbox" name="categories[]" value="" id="all-option" class="hidden peer" {{ empty($selectedCategories) ? 'checked' : '' }}>
                        <label for="all-option" class="inline-flex items-center justify-between px-5 py-2.5 text-gray-500 bg-white border-2 border-gray-200 rounded-full cursor-pointer peer-checked:border-indigo-600 hover:text-gray-600 hover:bg-gray-50 peer-checked:text-indigo-600 peer-checked:bg-indigo-100 transition-all duration-200">
                            <div class="block">
                                <div class="w-full font-semibold">Tất cả</div>
                            </div>
                        </label>
                    </li>

                    @foreach ($categories as $cat)
                    <li>
                        <input type="checkbox" name="categories[]" value="{{ $cat->id }}" id="category-{{ $cat->id }}" class="hidden peer" {{ in_array($cat->id, $selectedCategories ?? []) ? 'checked' : '' }}>
                        <label for="category-{{ $cat->id }}" class="inline-flex items-center justify-between px-5 py-2.5 text-gray-500 bg-white border-2 border-gray-200 rounded-full cursor-pointer peer-checked:border-indigo-600 hover:text-gray-600 hover:bg-gray-50 peer-checked:text-indigo-600 peer-checked:bg-indigo-100 transition-all duration-200">
                            <div class="block">
                                <div class="w-full font-semibold">{{ $cat->name }}</div>
                            </div>
                        </label>
                    </li>
                    @endforeach
                </ul>
            </div>

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                <div class="flex flex-col md:flex-row md:items-center gap-4">
                    <h2 class="text-xl font-semibold text-gray-800 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Khoảng giá
                    </h2>
                    
                    <div class="flex items-center gap-4">
                        <div class="relative">
                            <input type="number" name="min_price" id="min-price" class="border border-gray-300 rounded-lg px-4 py-2.5 pl-10 w-full focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200" placeholder="0" value="{{ request('min_price') }}">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500">₫</span>
                            </div>
                        </div>

                        <span class="text-gray-600 font-semibold">-</span>
                        
                        <div class="relative">
                            <input type="number" name="max_price" id="max-price" class="border border-gray-300 rounded-lg px-4 py-2.5 pl-10 w-full focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200" placeholder="10000000" value="{{ request('max_price') }}">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500">₫</span>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="focus:outline-none text-white bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 focus:ring-4 focus:ring-indigo-300 font-medium rounded-full text-sm px-6 py-3 flex gap-2 items-center justify-center transition-all duration-200 shadow-md hover:shadow">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
                    </svg>
                    Áp dụng bộ lọc
                </button>
            </div>
        </form>

        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
            <div class="p-6 border-b border-gray-100">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <h2 class="text-xl font-semibold text-gray-800">Kết quả tìm kiếm</h2>
                    
                    <div class="relative w-full md:w-1/3">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" id="search" placeholder="Tìm kiếm khóa học..." class="w-full text-sm text-gray-900 border border-gray-300 rounded-full bg-gray-50 pl-10 pr-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200">
                    </div>
                </div>
            </div>

            <div class="p-6" id="courses-list">
                @include('components.course.course-card-list', ['courses' => $courses])
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let selectAll = document.getElementById("all-option");
        let checkboxes = document.querySelectorAll("input[name='categories[]']");

        selectAll.addEventListener("change", function() {
            if (this.checked) {
                checkboxes.forEach(checkbox => checkbox.checked = false);
            }
        });

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener("change", function() {
                if (this.checked) {
                    selectAll.checked = false;
                }

                let allUnchecked = [...checkboxes].every(checkbox => !checkbox.checked);
                selectAll.checked = allUnchecked;
            });
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        let searchInput = document.getElementById("search");
        let typingTimer;
        const doneTypingInterval = 500; // Delay in ms

        function fetchSearchResults() {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(() => {
                let query = searchInput.value;
                
                // Show loading indicator
                let coursesContainer = document.getElementById("courses-list");
                coursesContainer.innerHTML = '<div class="flex justify-center items-center py-12"><div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-indigo-600"></div></div>';

                fetch(`/courses/search?query=${query}`)
                    .then(response => response.text())
                    .then(html => {
                        coursesContainer.innerHTML = html;
                    });
            }, doneTypingInterval);
        }

        searchInput.addEventListener("keyup", fetchSearchResults);
    });
</script>
