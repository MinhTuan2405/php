<x-app-layout>
    <div class="pt-20 pb-6 bg-gradient-to-r from-indigo-900 to-blue-900 text-white">
        <div class="container mx-auto px-4 md:px-6 lg:px-8">
            <h1 class="text-3xl md:text-4xl font-bold mb-2">Trang cá nhân</h1>
            <p class="text-blue-100 max-w-2xl">Quản lý thông tin cá nhân và cài đặt tài khoản của bạn</p>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100">
                <div class="p-6 sm:p-8">
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100">
                <div class="p-6 sm:p-8">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100">
                <div class="p-6 sm:p-8">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
