<nav x-data="{ open: false }" class="bg-white border-b fixed w-full border-gray-100 shadow-sm z-50">
    <!-- Primary Navigation Menu -->
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('welcome') }}" class="flex items-center space-x-2">
                        <div class="h-12 w-16 transform transition-transform duration-300 hover:scale-105 flex items-center justify-center">
                            <img src="{{ asset('Images/MyneWorkshopCrest.svg') }}" alt="Logo" class="h-full w-full object-contain">
                        </div>
                        <span class="font-bold text-lg text-transparent hidden sm:inline-block" style="color: #A96800">Philine's Online Courses</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('welcome')" :active="request()->routeIs('welcome')" class="text-gray-700 hover:text-indigo-600 transition-colors duration-300 font-medium">
                        {{ __('Trang chủ') }}
                    </x-nav-link>

                    <x-nav-link :href="route('category.index')" :active="request()->routeIs('category.index')" class="text-gray-700 hover:text-indigo-600 transition-colors duration-300 font-medium">
                        {{ __('Danh mục') }}
                    </x-nav-link>
                    @auth
                    <x-nav-link :href="route('course.index')" :active="request()->routeIs('course.index')" class="text-gray-700 hover:text-indigo-600 transition-colors duration-300 font-medium">
                        {{ __('Khóa học của tôi') }}
                    </x-nav-link>
                @endauth
                    <x-nav-link :href="route('teams')" :active="request()->routeIs('teams')" class="text-gray-700 hover:text-indigo-600 transition-colors duration-300 font-medium">
                        {{ __('Đội ngũ') }}
                    </x-nav-link>
                </div>
            </div>


            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                <!-- Cart Icon -->
                <a href="{{ route('cart.index') }}" class="text-gray-700 hover:text-indigo-600 mr-4 relative transition-colors duration-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    @php
                    $cartCount = \App\Models\Cart::where('user_id', auth()->id())->count();
                    @endphp
                    @if($cartCount > 0)
                    <span class="absolute -top-2 -right-2 bg-indigo-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs font-bold animate-pulse">
                        {{ $cartCount }}
                    </span>
                    @endif
                </a>


                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-full text-gray-700 bg-white hover:text-indigo-600 hover:bg-gray-50 focus:outline-none transition ease-in-out duration-200">
                            <div class="flex items-center">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=4f46e5&color=fff" alt="{{ Auth::user()->name }}" class="h-8 w-8 rounded-full mr-2 border-2 border-white shadow-sm">
                                <span>{{ Auth::user()->name }}</span>
                            </div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-3 border-b border-gray-100">
                            <p class="text-sm text-gray-500">Đã đăng nhập với</p>
                            <p class="text-sm font-medium text-gray-800 truncate">{{ Auth::user()->email }}</p>
                        </div>

                        <x-dropdown-link :href="route('profile.edit')" class="flex items-center hover:bg-indigo-50 hover:text-indigo-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            {{ __('Hồ sơ') }}
                        </x-dropdown-link>

                        <x-dropdown-link :href="route('course.index')" class="flex items-center hover:bg-indigo-50 hover:text-indigo-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            {{ __('Khóa học của tôi') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();"
                                class="flex items-center text-red-600 hover:text-red-800 hover:bg-red-50">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                {{ __('Đăng xuất') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
                @else
                <div class="space-x-4">
                    <a href="{{ route('login') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-800 transition duration-200">Đăng nhập</a>
                    <a href="{{ route('register') }}" class="text-sm font-medium px-4 py-2 bg-gradient-to-r from-indigo-600 to-blue-600 text-white rounded-full hover:from-indigo-700 hover:to-blue-700 transition duration-200 shadow-sm hover:shadow">Đăng ký</a>
                </div>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('welcome')" :active="request()->routeIs('welcome')" class="hover:bg-indigo-50 hover:text-indigo-700">
                {{ __('Trang chủ') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('category.index')" :active="request()->routeIs('category.index')" class="hover:bg-indigo-50 hover:text-indigo-700">
                {{ __('Danh mục') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="#" class="hover:bg-indigo-50 hover:text-indigo-700">
                {{ __('Khóa học mới') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="#" class="hover:bg-indigo-50 hover:text-indigo-700">
                {{ __('Giảng viên') }}
            </x-responsive-nav-link>
        </div>


        <!-- Responsive Settings Options -->
        @auth
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4 flex items-center">
                <div class="flex-shrink-0">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=4f46e5&color=fff" alt="{{ Auth::user()->name }}" class="h-10 w-10 rounded-full border-2 border-white shadow-sm">
                </div>
                <div class="ml-3">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="flex items-center hover:bg-indigo-50 hover:text-indigo-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    {{ __('Hồ sơ') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link href="#" class="flex items-center hover:bg-indigo-50 hover:text-indigo-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    {{ __('Khóa học của tôi') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('cart.index')" class="flex items-center hover:bg-indigo-50 hover:text-indigo-700">
                    <svg class="h-5 w-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    {{ __('Giỏ hàng') }}
                    @if($cartCount > 0)
                    <span class="ml-auto bg-indigo-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs font-bold">
                        {{ $cartCount }}
                    </span>
                    @endif
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();"
                        class="flex items-center text-red-600 hover:bg-red-50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        {{ __('Đăng xuất') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
        @else
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="mt-3 space-y-1 px-4">
                <x-responsive-nav-link :href="route('login')" class="hover:bg-indigo-50 hover:text-indigo-700">
                    {{ __('Đăng nhập') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('register')" class="bg-gradient-to-r from-indigo-600 to-blue-600 text-white rounded-lg hover:from-indigo-700 hover:to-blue-700">
                    {{ __('Đăng ký') }}
                </x-responsive-nav-link>
            </div>
        </div>
        @endauth
    </div>
</nav>
