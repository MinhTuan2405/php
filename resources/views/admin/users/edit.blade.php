@extends('layouts.admin')

@section('title','Edit User')

@section('content')
<div class="w-full max-w-6xl">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800 flex items-center">
            <i class="fas fa-user-edit text-purple-500 mr-3"></i> Sửa Người Dùng #{{ $user->id }}
        </h1>
        <a href="{{ route('admin.users.index') }}"
           class="px-4 py-3 rounded-lg bg-gray-100 text-gray-700 hover:bg-gray-200 text-sm flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Quay lại
        </a>
    </div>

    <div class="grid md:grid-cols-2 gap-6">
        <!-- Thông tin cơ bản -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-lg font-semibold text-gray-700 mb-4 flex items-center">
                <i class="fas fa-id-card text-indigo-500 mr-2"></i> Thông tin
            </h2>
            <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-2">Tên</label>
                    <input name="name" value="{{ old('name', $user->name) }}"
                        class="w-full bg-gray-50 border border-gray-300 rounded-lg px-4 py-3 text-sm focus:ring-purple-500 focus:border-purple-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-2">Email (không đổi)</label>
                    <input value="{{ $user->email }}" disabled
                        class="w-full bg-gray-100 border border-gray-200 rounded-lg px-4 py-3 text-sm text-gray-500 cursor-not-allowed">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-2">Mật khẩu mới</label>
                    <input name="password" type="password"
                        class="w-full bg-gray-50 border border-gray-300 rounded-lg px-4 py-3 text-sm focus:ring-pink-500 focus:border-pink-500"
                        placeholder="Ít nhất 8 ký tự">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-2">Xác nhận mật khẩu mới</label>
                    <input name="password_confirmation" type="password"
                        class="w-full bg-gray-50 border border-gray-300 rounded-lg px-4 py-3 text-sm focus:ring-pink-500 focus:border-pink-500"
                        placeholder="Nhập lại mật khẩu mới">
                </div>
            </div>

            <div class="text-xs text-gray-500 bg-pink-50 border border-pink-100 rounded-lg p-3 flex items-start">
                <i class="fas fa-info-circle mr-2 mt-0.5 text-pink-500"></i>
                <span>Để trống các ô mật khẩu phía trên nếu bạn không muốn thay đổi mật khẩu hiện tại.</span>
            </div>

            <div class="flex items-center pt-2">
                <input type="checkbox" id="is_admin" name="is_admin" value="1"
                    class="h-5 w-5 text-purple-600 border-gray-300 rounded focus:ring-purple-500 cursor-pointer"
                    {{ $user->role === 'Admin' ? 'checked' : '' }}>
                <label for="is_admin" class="ml-2 text-sm font-medium text-gray-700 cursor-pointer">Cấp quyền Quản trị viên (Admin)</label>
            </div>

            <div class="pt-4 border-t border-gray-100">
                <button type="submit"
                        class="w-full inline-flex items-center justify-center bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-medium px-5 py-3 rounded-lg hover:from-purple-700 hover:to-indigo-700 transition shadow-lg shadow-purple-200">
                    <i class="fas fa-save mr-2"></i> Lưu thay đổi
                </button>
            </div>
        </form>
        </div>
    </div>
</div>
@endsection