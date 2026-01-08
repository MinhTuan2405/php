<x-guest-layout>
    <div class="min-h-screen flex flex-col md:flex-row">
        <!-- Left side - Image -->
        <div class="hidden md:block md:w-1/2 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1501504905252-473c47e087f8?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1374&q=80')">
            <div class="h-full w-full bg-gradient-to-r from-blue-900/90 to-indigo-900/80 flex items-center justify-center p-12">
                <div class="max-w-xl">
                    <h2 class="text-4xl font-bold text-white mb-6">Chào mừng trở lại!</h2>
                    <p class="text-xl text-white/90 mb-8">Đăng nhập để tiếp tục hành trình học tập và khám phá hàng ngàn khóa học chất lượng cao.</p>
                    <div class="grid grid-cols-3 gap-4">
                        <div class="bg-white/20 p-4 rounded-lg backdrop-blur-sm shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <div class="bg-white/20 p-4 rounded-lg backdrop-blur-sm shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <div class="bg-white/20 p-4 rounded-lg backdrop-blur-sm shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right side - Form -->
        <div class="w-full md:w-1/2 bg-gradient-to-b from-gray-50 to-white flex items-center justify-center p-6 md:p-12 relative">
            <div class="w-full max-w-md ">
                <!-- Close -->
                <a href="{{ route('welcome') }}" class="absolute top-10 right-10"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 hover:text-red-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </a>
                <!-- Logo -->
                <div class="flex justify-center mb-8">
                    <div class="h-16 w-16 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg transform transition-transform hover:scale-105">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                </div>

                <h2 class="text-3xl font-bold text-gray-800 text-center mb-2">Đăng nhập</h2>
                <p class="text-gray-600 text-center mb-8">Nhập thông tin đăng nhập để tiếp tục học tập</p>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" class="text-gray-700 font-medium text-sm mb-2" />
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                </svg>
                            </div>
                            <x-text-input id="email" class="block mt-1 w-full pl-10 rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition duration-150" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="email@example.com" />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <x-input-label for="password" :value="__('Mật khẩu')" class="text-gray-700 font-medium text-sm" />
                            @if (Route::has('password.request'))
                            <a class="text-sm text-blue-600 hover:text-blue-800 font-medium transition duration-150"
                                href="{{ route('password.request') }}">
                                {{ __('Quên mật khẩu?') }}
                            </a>
                            @endif
                        </div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <x-text-input id="password" class="block mt-1 w-full pl-10 rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition duration-150" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <div class="block">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox"
                                class="rounded-md border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" name="remember">
                            <span class="ms-2 text-sm text-gray-600">{{ __('Ghi nhớ tôi') }}</span>
                        </label>
                    </div>

                    <div class="flex flex-col space-y-4">
                        <x-primary-button class="w-full justify-center bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold py-3 px-6 rounded-lg transition duration-150 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                            {{ __('Đăng nhập') }}
                        </x-primary-button>

                        <div class="relative my-4">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-300"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-2 bg-white text-gray-500">Hoặc tiếp tục với</span>
                            </div>
                        </div>

                        <div class="grid grid-cols-3 gap-3">
                            <button type="button" class="flex justify-center items-center py-2.5 border border-gray-300 rounded-lg hover:bg-gray-50 transition duration-150 shadow-sm hover:shadow">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4" />
                                    <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853" />
                                    <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05" />
                                    <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335" />
                                </svg>
                            </button>
                            <button type="button" class="flex justify-center items-center py-2.5 border border-gray-300 rounded-lg hover:bg-gray-50 transition duration-150 shadow-sm hover:shadow">
                                <svg class="h-5 w-5 text-[#1877F2]" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                </svg>
                            </button>
                            <button type="button" class="flex justify-center items-center py-2.5 border border-gray-300 rounded-lg hover:bg-gray-50 transition duration-150 shadow-sm hover:shadow">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13.0401 2.02C13.0401 1.53 12.5801 1.25 12.1501 1.44C10.3301 2.21 8.78006 3.55 7.79006 5.22C7.76006 5.26 7.74006 5.29 7.71006 5.33C7.21006 6.16 6.79006 7.07 6.57006 8.07C6.56006 8.12 6.55006 8.18 6.54006 8.24C6.42006 8.88 6.33006 9.56 6.33006 10.26C6.33006 10.7 6.36006 11.13 6.42006 11.55C6.43006 11.62 6.45006 11.68 6.46006 11.74C6.59006 12.42 6.82006 13.05 7.12006 13.65C7.13006 13.66 7.13006 13.67 7.14006 13.68C7.74006 14.8 8.63006 15.75 9.75006 16.38C9.81006 16.41 9.86006 16.45 9.92006 16.48C10.4901 16.74 11.1001 16.92 11.7501 17C11.8001 17.01 11.8601 17.01 11.9101 17.02C12.3001 17.09 12.7001 17.12 13.1101 17.12C13.8001 17.12 14.4601 17.02 15.0801 16.83C15.1301 16.82 15.1701 16.8 15.2201 16.79C15.9601 16.53 16.6401 16.16 17.2301 15.68C17.2401 15.67 17.2501 15.66 17.2601 15.65C17.8901 15.11 18.4301 14.44 18.8401 13.68C18.8501 13.67 18.8501 13.66 18.8601 13.65C19.1601 13.05 19.3901 12.42 19.5201 11.74C19.5301 11.68 19.5401 11.62 19.5501 11.55C19.6101 11.13 19.6401 10.7 19.6401 10.26C19.6401 9.83 19.6101 9.4 19.5501 8.98C19.5401 8.91 19.5301 8.84 19.5201 8.77C19.4501 8.33 19.3401 7.9 19.1901 7.48C19.1801 7.45 19.1701 7.42 19.1601 7.39C18.9901 6.91 18.7801 6.45 18.5201 6.02C18.5101 6 18.5001 5.98 18.4901 5.96C18.2301 5.53 17.9301 5.13 17.6001 4.76C17.5801 4.74 17.5601 4.72 17.5401 4.7C17.2101 4.33 16.8401 3.99 16.4401 3.69C16.4201 3.67 16.4001 3.66 16.3801 3.64C15.9801 3.34 15.5401 3.08 15.0801 2.87C15.0501 2.86 15.0301 2.84 15.0001 2.83C14.5401 2.62 14.0501 2.46 13.5401 2.35C13.5001 2.34 13.4601 2.33 13.4201 2.32C13.2901 2.29 13.1601 2.26 13.0401 2.24V2.02Z" fill="black" />
                                </svg>
                            </button>
                        </div>

                        <div class="text-center mt-4">
                            <span class="text-sm text-gray-600">Chưa có tài khoản? </span>
                            <a href="{{ route('register') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium transition duration-150">
                                {{ __('Đăng ký ngay') }}
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>