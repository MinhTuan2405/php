<x-app-layout>
    <div>
        <!-- Hero Section -->
        <section class="relative overflow-hidden">
            <!-- Background Image with Overlay -->
            <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80')"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-blue-900/90 to-indigo-900/80"></div>
            
            <div class="relative z-10 py-20 md:py-28">
                <div class="container mx-auto px-4 md:px-6 lg:px-8">
                    <div class="max-w-3xl mx-auto text-center space-y-8">
                        <div>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-white/20 backdrop-blur-sm text-white mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                Đội ngũ chuyên gia
                            </span>
                            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight text-white">Gặp gỡ đội ngũ của chúng tôi</h1>
                        </div>
                        <p class="text-lg md:text-xl text-blue-100">Đội ngũ giảng viên và chuyên gia hàng đầu với kinh nghiệm giảng dạy phong phú, luôn sẵn sàng hỗ trợ bạn trong hành trình học tập.</p>
                    </div>
                </div>
            </div>
            
            <!-- Decorative Elements -->
            <div class="absolute bottom-0 left-0 w-full overflow-hidden">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none" class="w-full h-16 text-white">
                    <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V95.8C59.71,118.11,130.83,141.14,214.86,141.14c67.64,0,133.76-18.59,190.91-39.94Z" fill="currentColor"></path>
                </svg>
            </div>
        </section>

        <!-- Team Leadership Section -->
        <section class="py-16 bg-white">
            <div class="container mx-auto px-4 md:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">Ban lãnh đạo</h2>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">Những người dẫn dắt và định hướng sứ mệnh giáo dục của chúng tôi</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Leader 1 -->
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 p-6 text-center group hover:scale-105 transform border border-gray-100">
                        <div class="relative w-40 h-40 mx-auto mb-6 overflow-hidden rounded-full">
                            <img src="{{ asset('Images/tai.png') }}" alt="CEO" class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-110">
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-1 group-hover:text-indigo-600 transition-colors duration-300">Trần Đức Tài</h3>
                        <p class="text-indigo-600 font-medium mb-3">uwu</p>
                        <p class="text-gray-600 mb-4">Nande Haruhikage yatta no!!!</p>
                        <div class="flex justify-center space-x-3">
                            <a href="#" class="text-gray-500 hover:text-indigo-600 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z"/>
                                </svg>
                            </a>
                            <a href="#" class="text-gray-500 hover:text-indigo-600 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                                </svg>
                            </a>
                            <a href="#" class="text-gray-500 hover:text-indigo-600 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Leader 2 -->
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 p-6 text-center group hover:scale-105 transform border border-gray-100">
                        <div class="relative w-40 h-40 mx-auto mb-6 overflow-hidden rounded-full">
                            <img src="{{ asset('Images/sang.png') }}" alt="COO" class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-110">
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-1 group-hover:text-indigo-600 transition-colors duration-300">Nguyễn Ngọc Sang</h3>
                        <p class="text-indigo-600 font-medium mb-3">Shark</p>
                        <p class="text-gray-600 mb-4">Ae duyệt binh tổng phím ...</p>
                        <div class="flex justify-center space-x-3">
                            <a href="#" class="text-gray-500 hover:text-indigo-600 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z"/>
                                </svg>
                            </a>
                            <a href="#" class="text-gray-500 hover:text-indigo-600 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                                </svg>
                            </a>
                            <a href="#" class="text-gray-500 hover:text-indigo-600 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Leader 3 -->
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 p-6 text-center group hover:scale-105 transform border border-gray-100">
                        <div class="relative w-40 h-40 mx-auto mb-6 overflow-hidden rounded-full">
                            <img src="{{ asset('Images/dinh.png') }}" alt="CTO" class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-110">
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-1 group-hover:text-indigo-600 transition-colors duration-300">Lê Quang Định</h3>
                        <p class="text-indigo-600 font-medium mb-3">Meeting dza lone dza wei</p>
                        <p class="text-gray-600 mb-4">wHY MA EVEN HERE ....</p>
                        <div class="flex justify-center space-x-3">
                            <a href="#" class="text-gray-500 hover:text-indigo-600 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z"/>
                                </svg>
                            </a>
                            <a href="#" class="text-gray-500 hover:text-indigo-600 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                                </svg>
                            </a>
                            <a href="#" class="text-gray-500 hover:text-indigo-600 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Team Members Section -->
        <section class="py-16 bg-gray-50">
            <div class="container mx-auto px-4 md:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">Đội ngũ giảng viên</h2>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">Random people on dza Internet ...</p>
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    <!-- Team Member 1 -->
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 p-6 text-center group hover:scale-105 transform border border-gray-100">
                        <div class="relative w-32 h-32 mx-auto mb-4 overflow-hidden rounded-full">
                            <img src="https://randomuser.me/api/portraits/women/22.jpg" alt="Team Member" class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-110">
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-1 group-hover:text-indigo-600 transition-colors duration-300">Phạm Thị Dung</h3>
                        <p class="text-indigo-600 font-medium mb-2">Giảng viên Toán học</p>
                        <p class="text-gray-600 text-sm mb-3">Tiến sĩ Toán học, 8 năm kinh nghiệm giảng dạy</p>
                        <div class="flex justify-center space-x-2">
                            <a href="#" class="text-gray-500 hover:text-indigo-600 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z"/>
                                </svg>
                            </a>
                            <a href="#" class="text-gray-500 hover:text-indigo-600 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Team Member 2 -->
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 p-6 text-center group hover:scale-105 transform border border-gray-100">
                        <div class="relative w-32 h-32 mx-auto mb-4 overflow-hidden rounded-full">
                            <img src="https://randomuser.me/api/portraits/men/23.jpg" alt="Team Member" class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-110">
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-1 group-hover:text-indigo-600 transition-colors duration-300">Hoàng Văn Đức</h3>
                        <p class="text-indigo-600 font-medium mb-2">Giảng viên Vật lý</p>
                        <p class="text-gray-600 text-sm mb-3">Thạc sĩ Vật lý, 6 năm kinh nghiệm giảng dạy</p>
                        <div class="flex justify-center space-x-2">
                            <a href="#" class="text-gray-500 hover:text-indigo-600 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z"/>
                                </svg>
                            </a>
                            <a href="#" class="text-gray-500 hover:text-indigo-600 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Team Member 3 -->
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 p-6 text-center group hover:scale-105 transform border border-gray-100">
                        <div class="relative w-32 h-32 mx-auto mb-4 overflow-hidden rounded-full">
                            <img src="https://randomuser.me/api/portraits/women/33.jpg" alt="Team Member" class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-110">
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-1 group-hover:text-indigo-600 transition-colors duration-300">Nguyễn Thị Hoa</h3>
                        <p class="text-indigo-600 font-medium mb-2">Giảng viên Hóa học</p>
                        <p class="text-gray-600 text-sm mb-3">Tiến sĩ Hóa học, 7 năm kinh nghiệm giảng dạy</p>
                        <div class="flex justify-center space-x-2">
                            <a href="#" class="text-gray-500 hover:text-indigo-600 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z"/>
                                </svg>
                            </a>
                            <a href="#" class="text-gray-500 hover:text-indigo-600 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Team Member 4 -->
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 p-6 text-center group hover:scale-105 transform border border-gray-100">
                        <div class="relative w-32 h-32 mx-auto mb-4 overflow-hidden rounded-full">
                            <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Team Member" class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-110">
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-1 group-hover:text-indigo-600 transition-colors duration-300">Trần Văn Giang</h3>
                        <p class="text-indigo-600 font-medium mb-2">Giảng viên Tiếng Anh</p>
                        <p class="text-gray-600 text-sm mb-3">Thạc sĩ Ngôn ngữ học, 9 năm kinh nghiệm giảng dạy</p>
                        <div class="flex justify-center space-x-2">
                            <a href="#" class="text-gray-500 hover:text-indigo-600 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z"/>
                                </svg>
                            </a>
                            <a href="#" class="text-gray-500 hover:text-indigo-600 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Team Member 5 -->
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 p-6 text-center group hover:scale-105 transform border border-gray-100">
                        <div class="relative w-32 h-32 mx-auto mb-4 overflow-hidden rounded-full">
                            <img src="https://randomuser.me/api/portraits/women/55.jpg" alt="Team Member" class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-110">
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-1 group-hover:text-indigo-600 transition-colors duration-300">Lê Thị Hương</h3>
                        <p class="text-indigo-600 font-medium mb-2">Giảng viên Sinh học</p>
                        <p class="text-gray-600 text-sm mb-3">Tiến sĩ Sinh học, 5 năm kinh nghiệm giảng dạy</p>
                        <div class="flex justify-center space-x-2">
                            <a href="#" class="text-gray-500 hover:text-indigo-600 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z"/>
                                </svg>
                            </a>
                            <a href="#" class="text-gray-500 hover:text-indigo-600 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Team Member 6 -->
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 p-6 text-center group hover:scale-105 transform border border-gray-100">
                        <div class="relative w-32 h-32 mx-auto mb-4 overflow-hidden rounded-full">
                            <img src="https://randomuser.me/api/portraits/men/52.jpg" alt="Team Member" class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-110">
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-1 group-hover:text-indigo-600 transition-colors duration-300">Nguyễn Văn Hùng</h3>
                        <p class="text-indigo-600 font-medium mb-2">Giảng viên Tin học</p>
                        <p class="text-gray-600 text-sm mb-3">Thạc sĩ Khoa học Máy tính, 7 năm kinh nghiệm giảng dạy</p>
                        <div class="flex justify-center space-x-2">
                            <a href="#" class="text-gray-500 hover:text-indigo-600 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z"/>
                                </svg>
                            </a>
                            <a href="#" class="text-gray-500 hover:text-indigo-600 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Team Member 7 -->
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 p-6 text-center group hover:scale-105 transform border border-gray-100">
                        <div class="relative w-32 h-32 mx-auto mb-4 overflow-hidden rounded-full">
                            <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="Team Member" class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-110">
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-1 group-hover:text-indigo-600 transition-colors duration-300">Phạm Thị Lan</h3>
                        <p class="text-indigo-600 font-medium mb-2">Giảng viên Địa lý</p>
                        <p class="text-gray-600 text-sm mb-3">Thạc sĩ Địa lý học, 6 năm kinh nghiệm giảng dạy</p>
                        <div class="flex justify-center space-x-2">
                            <a href="#" class="text-gray-500 hover:text-indigo-600 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z"/>
                                </svg>
                            </a>
                            <a href="#" class="text-gray-500 hover:text-indigo-600 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Team Member 8 -->
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 p-6 text-center group hover:scale-105 transform border border-gray-100">
                        <div class="relative w-32 h-32 mx-auto mb-4 overflow-hidden rounded-full">
                            <img src="https://randomuser.me/api/portraits/men/72.jpg" alt="Team Member" class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-110">
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-1 group-hover:text-indigo-600 transition-colors duration-300">Trần Văn Nam</h3>
                        <p class="text-indigo-600 font-medium mb-2">Giảng viên Lịch sử</p>
                        <p class="text-gray-600 text-sm mb-3">Tiến sĩ Lịch sử, 10 năm kinh nghiệm giảng dạy</p>
                        <div class="flex justify-center space-x-2">
                            <a href="#" class="text-gray-500 hover:text-indigo-600 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z"/>
                                </svg>
                            </a>
                            <a href="#" class="text-gray-500 hover:text-indigo-600 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="text-center mt-10">
                    <a href="#" class="inline-flex items-center text-indigo-600 hover:text-indigo-800 font-medium">
                        Xem tất cả giảng viên
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </section>
        
        <!-- Support Team Section -->
        <section class="py-16 bg-white">
            <div class="container mx-auto px-4 md:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">Đội ngũ hỗ trợ</h2>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">Luôn sẵn sàng giải đáp mọi thắc mắc và hỗ trợ bạn trong quá trình học tập</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Support Member 1 -->
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 p-6 text-center group hover:scale-105 transform border border-gray-100">
                        <div class="relative w-32 h-32 mx-auto mb-4 overflow-hidden rounded-full">
                            <img src="https://randomuser.me/api/portraits/women/42.jpg" alt="Support Team" class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-110">
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-1 group-hover:text-indigo-600 transition-colors duration-300">Nguyễn Thị Hạnh</h3>
                        <p class="text-indigo-600 font-medium mb-2">Trưởng phòng hỗ trợ học viên</p>
                        <p class="text-gray-600 text-sm mb-3">Chuyên gia tư vấn giáo dục với hơn 5 năm kinh nghiệm hỗ trợ học viên</p>
                        <div class="flex justify-center space-x-3 mt-4">
                            <a href="#" class="bg-indigo-100 hover:bg-indigo-200 text-indigo-600 p-2 rounded-full transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </a>
                            <a href="#" class="bg-indigo-100 hover:bg-indigo-200 text-indigo-600 p-2 rounded-full transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </a>
                            <a href="#" class="bg-indigo-100 hover:bg-indigo-200 text-indigo-600 p-2 rounded-full transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Support Member 2 -->
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 p-6 text-center group hover:scale-105 transform border border-gray-100">
                        <div class="relative w-32 h-32 mx-auto mb-4 overflow-hidden rounded-full">
                            <img src="https://randomuser.me/api/portraits/men/62.jpg" alt="Support Team" class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-110">
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-1 group-hover:text-indigo-600 transition-colors duration-300">Lê Văn Tuấn</h3>
                        <p class="text-indigo-600 font-medium mb-2">Chuyên viên tư vấn học tập</p>
                        <p class="text-gray-600 text-sm mb-3">Chuyên gia tư vấn lộ trình học tập với hơn 4 năm kinh nghiệm hỗ trợ học viên</p>
                        <div class="flex justify-center space-x-3 mt-4">
                            <a href="#" class="bg-indigo-100 hover:bg-indigo-200 text-indigo-600 p-2 rounded-full transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </a>
                            <a href="#" class="bg-indigo-100 hover:bg-indigo-200 text-indigo-600 p-2 rounded-full transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </a>
                            <a href="#" class="bg-indigo-100  />
                                </svg>
                            </a>
                            <a href="#" class="bg-indigo-100 hover:bg-indigo-200 text-indigo-600 p-2 rounded-full transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Support Member 3 -->
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 p-6 text-center group hover:scale-105 transform border border-gray-100">
                        <div class="relative w-32 h-32 mx-auto mb-4 overflow-hidden rounded-full">
                            <img src="https://randomuser.me/api/portraits/women/48.jpg" alt="Support Team" class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-110">
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-1 group-hover:text-indigo-600 transition-colors duration-300">Phạm Thị Mai</h3>
                        <p class="text-indigo-600 font-medium mb-2">Chuyên viên hỗ trợ kỹ thuật</p>
                        <p class="text-gray-600 text-sm mb-3">Chuyên gia hỗ trợ kỹ thuật với hơn 3 năm kinh nghiệm giải quyết vấn đề kỹ thuật cho học viên</p>
                        <div class="flex justify-center space-x-3 mt-4">
                            <a href="#" class="bg-indigo-100 hover:bg-indigo-200 text-indigo-600 p-2 rounded-full transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </a>
                            <a href="#" class="bg-indigo-100 hover:bg-indigo-200 text-indigo-600 p-2 rounded-full transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </a>
                            <a href="#" class="bg-indigo-100 hover:bg-indigo-200 text-indigo-600 p-2 rounded-full transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- CTA Section -->
        <section class="py-16 bg-gradient-to-r from-blue-900 to-indigo-900 text-white">
            <div class="container mx-auto px-4 md:px-6 lg:px-8">
                <div class="max-w-4xl mx-auto text-center">
                    <h2 class="text-3xl md:text-4xl font-bold mb-6">Tham gia đội ngũ của chúng tôi</h2>
                    <p class="text-lg md:text-xl text-blue-100 mb-8">Chúng tôi luôn tìm kiếm những người tài năng và đam mê giáo dục để cùng nhau xây dựng nền tảng học tập tốt nhất.</p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="#" class="bg-white text-indigo-700 hover:bg-blue-50 px-8 py-4 rounded-full font-medium text-lg shadow-lg transition duration-300 inline-flex items-center justify-center">
                            Xem vị trí tuyển dụng
                        </a>
                        <a href="#" class="bg-transparent border-2 border-white text-white hover:bg-white/10 px-8 py-4 rounded-full font-medium text-lg transition duration-300 inline-flex items-center justify-center">
                            Liên hệ với chúng tôi
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>
