<footer class="mt-12 border-t border-gray-200 bg-white">
    <div class="w-full px-6 md:px-16 lg:px-24 py-12">
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 lg:gap-32 mb-12 border-b border-gray-100 pb-12">
            
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <i class="fas fa-cube text-indigo-600 text-2xl"></i>
                    <span class="text-xl font-bold text-gray-800">{{ config('app.name') }}</span>
                </div>
                <p class="text-sm text-gray-600 leading-relaxed max-w-md"> Nền tảng học tập trực tuyến hàng đầu. Kết nối tri thức, kiến tạo tương lai vững bền cho thế hệ trẻ.
                </p>
                
                <div class="flex items-center gap-4 mt-4">
                    <a href="https://facebook.com" target="_blank" class="h-10 w-10 flex items-center justify-center rounded-full bg-blue-100 text-blue-700 hover:bg-blue-700 hover:text-white transition-all duration-300 shadow-sm group">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                        </svg>
                    </a>

                    <a href="https://youtube.com" target="_blank" class="h-10 w-10 flex items-center justify-center rounded-full bg-red-100 text-red-600 hover:bg-red-600 hover:text-white transition-all duration-300 shadow-sm">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd" d="M19.812 5.418c.861.23 1.538.907 1.768 1.768C21.998 8.746 22 12 22 12s0 3.255-.418 4.814a2.504 2.504 0 0 1-1.768 1.768c-1.56.419-7.814.419-7.814.419s-6.255 0-7.814-.419a2.505 2.505 0 0 1-1.768-1.768C2 15.255 2 12 2 12s0-3.255.418-4.814a2.507 2.507 0 0 1 1.768-1.768C5.744 5 11.998 5 11.998 5s6.255 0 7.814.418zM15.194 12 10 15V9l5.194 3z" clip-rule="evenodd" />
                        </svg>
                    </a>

                    <a href="https://x.com" target="_blank" class="group h-10 w-10 flex items-center justify-center rounded-full bg-gray-200 hover:bg-black-600 transition-all duration-300 shadow-sm">
                        <svg class="w-5 h-5 fill-current text-gray-900 group-hover:text-white transition-colors duration-300" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M13.6823 10.6218L20.2391 3H18.6854L12.9921 9.61788L8.44486 3H3.2002L10.0765 13.0074L3.2002 21H4.75404L10.7663 14.0113L15.5685 21H20.8131L13.6819 10.6218ZM11.5541 13.0956L10.8574 12.0991L5.31391 4.16971H7.70053L12.1742 10.5689L12.8709 11.5655L18.6861 19.8835H16.2995L11.5541 13.096V13.0956Z" />
                        </svg>
                    </a>
                </div>
            </div>

            <div class="md:text-right md:flex md:flex-col md:items-end">
                <h3 class="text-sm font-bold uppercase tracking-wider text-gray-900 mb-4">Liên kết nhanh</h3>
                <ul class="space-y-3">
                    <li><a href="{{ route('welcome') }}" class="text-sm text-gray-600 hover:text-indigo-600 inline-flex items-center gap-2 transition">Trang chủ <i class="fas fa-home text-indigo-400"></i></a></li>
                    <li><a href="{{ route('teams') }}" class="text-sm text-gray-600 hover:text-indigo-600 inline-flex items-center gap-2 transition">Về chúng tôi <i class="fas fa-users text-indigo-400"></i></a></li>
                    <li><a href="#" class="text-sm text-gray-600 hover:text-indigo-600 inline-flex items-center gap-2 transition">Khóa học <i class="fas fa-book-open text-indigo-400"></i></a></li>
                    <li><a href="#" class="text-sm text-gray-600 hover:text-indigo-600 inline-flex items-center gap-2 transition">Liên hệ hỗ trợ <i class="fas fa-headset text-indigo-400"></i></a></li>
                </ul>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-10 lg:gap-32 items-start">

            <div class="h-full">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-map-marked-alt text-indigo-500 mr-2"></i> Bản đồ
                </h3>
                <div class="overflow-hidden rounded-2xl shadow-md border border-gray-200 h-[280px] w-full bg-gray-100 relative group">
                   <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.6504566689327!2d106.67960847558366!3d10.761399259469602!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f1b91dddf0b%3A0x1ab004c91f448812!2sHo%20Chi%20Minh%20City%20University%20of%20Education!5e0!3m2!1sen!2s!4v1764417786352!5m2!1sen!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>

        </div>

        <div class="mt-16 pt-8 border-t border-gray-100 text-center text-xs text-gray-400">
            <p>© {{ date('Y') }} {{ config('app.name') }}. Được xây dựng bằng Laravel & Tailwind CSS.</p>
        </div>
    </div>
</footer>