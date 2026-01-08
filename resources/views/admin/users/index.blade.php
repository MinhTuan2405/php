@extends('layouts.admin')

@section('title', 'Manage Users')

@section('content')
<div class="mb-8">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Danh sách người dùng</h1>
            <p class="text-gray-600">Quản lý và theo dõi tất cả người dùng trong hệ thống</p>
        </div>
        <div class="mt-4 md:mt-0">
            <div class="flex items-center space-x-3">
                <a href="{{ route('admin.users.export') }}" class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-50 transition-colors flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                    </svg>
                    Xuất Excel
                </a>
            </div>
        </div>
    </div>
</div>

<div class="flex gap-6">
    <!-- Left: Users List -->
    <div class="w-1/3 flex flex-col">
        <div class="bg-white rounded-xl shadow-md p-5 mb-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-4 flex items-center">
                <i class="fas fa-users text-purple-500 mr-2"></i> Users List
            </h2>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
                <input type="text" id="user-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full pl-10 p-2.5" placeholder="Search users...">
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md flex-1 overflow-hidden">
            <div class="max-h-[calc(100vh-250px)] overflow-y-auto p-3 space-y-2" id="users-list">
                @forelse ($users as $u)
                <a href="{{ route('admin.users.index', ['user_id' => $u->id]) }}"
                   class="flex items-center p-3 rounded-lg {{ $selectedUser && $selectedUser->id == $u->id ? 'bg-purple-50 border-l-4 border-purple-500' : 'bg-gray-50 hover:bg-gray-100' }} transition-all duration-200 group">
                    <div class="flex-1">
                        <h3 class="font-medium text-gray-800 group-hover:text-purple-700 transition-colors">{{ $u->name }}</h3>
                        <div class="flex items-center text-sm text-gray-500 mt-1">
                            <span class="bg-indigo-100 text-indigo-800 text-xs font-medium px-2.5 py-0.5 rounded-full mr-2">{{ $u->email }}</span>
                            @if($u->role === 'Admin')
                                <span class="px-2 py-0.5 text-xs bg-green-100 text-green-700 rounded-full">Admin</span>
                            @else
                                <span class="px-2 py-0.5 text-xs bg-gray-100 text-gray-600 rounded-full">User</span>
                            @endif
                        </div>
                    </div>
                    <i class="fas fa-chevron-right text-gray-300 group-hover:text-purple-500 transition-colors"></i>
                </a>
                @empty
                <div class="flex flex-col items-center justify-center py-8 text-center">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-users text-gray-400 text-xl"></i>
                    </div>
                    <p class="text-gray-500">No users found.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Right: User Details -->
    <div class="w-2/3">
        @if ($selectedUser)
        <div class="bg-white rounded-xl shadow-md p-6 mb-6 animate-fade-in-up">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-1">{{ $selectedUser->name }}</h2>
                    <div class="flex items-center text-gray-500">
                        <span class="bg-indigo-100 text-indigo-800 text-xs font-medium px-2.5 py-0.5 rounded-full mr-2">{{ $selectedUser->email }}</span>
                        <span class="mx-2">|</span>
                        <span class="{{ $selectedUser->role === 'Admin' ? 'text-green-600' : 'text-gray-600' }}">
                            {{ $selectedUser->role === 'Admin' ? 'Admin' : 'User' }}
                        </span>
                        <span class="mx-2">|</span>
                        <span class="text-gray-600">ID: {{ $selectedUser->id }}</span>
                    </div>
                </div>
                <div class="flex space-x-2">
                    <a href="{{ route('admin.users.edit', $selectedUser->id) }}"
                        class="flex items-center bg-indigo-50 text-indigo-700 px-4 py-2 rounded-lg hover:bg-indigo-100 transition-colors duration-200">
                        <i class="fas fa-edit mr-2"></i> Edit
                    </a>
                    <form id="delete-user-form-{{ $selectedUser->id }}" action="{{ route('admin.users.destroy', $selectedUser->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="button"
                            onclick="confirmDelete('delete-user-form-{{ $selectedUser->id }}', 'Are you sure you want to delete <strong>{{ $selectedUser->name }}</strong>?')"
                            class="flex items-center bg-red-50 text-red-700 px-4 py-2 rounded-lg hover:bg-red-100 transition-colors duration-200">
                            <i class="fas fa-trash-alt mr-2"></i> Delete
                        </button>
                    </form>
                </div>
            </div>

            <div class="border-t border-gray-100 pt-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-4 flex items-center">
                    <i class="fas fa-id-card text-purple-500 mr-2"></i> Profile
                </h3>

                <div class="grid gap-4">
                    <div class="bg-gray-50 rounded-lg p-4 grid md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-600">Name</p>
                            <p class="font-medium text-gray-800">{{ $selectedUser->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Email</p>
                            <p class="font-medium text-gray-800">{{ $selectedUser->email }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Role</p>
                            <p class="font-medium text-gray-800">{{ $selectedUser->role === 'Admin' ? 'Admin' : 'User' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Joined</p>
                            <p class="font-medium text-gray-800">{{ $selectedUser->created_at?->format('Y-m-d H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="bg-white rounded-xl shadow-md p-8 flex flex-col items-center justify-center text-center h-64">
            <div class="w-20 h-20 bg-purple-100 rounded-full flex items-center justify-center mb-4">
                <i class="fas fa-user text-purple-500 text-2xl"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-700 mb-2">No User Selected</h3>
            <p class="text-gray-500 max-w-md">Select a user from the list to view details.</p>
        </div>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Simple search functionality
    document.getElementById('user-search').addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const userItems = document.querySelectorAll('#users-list > a');

        userItems.forEach(item => {
            const name = item.querySelector('h3').textContent.toLowerCase();
            const email = item.querySelector('.bg-indigo-100').textContent.toLowerCase();
            if (name.includes(searchTerm) || email.includes(searchTerm)) {
                item.style.display = 'flex';
            } else {
                item.style.display = 'none';
            }
        });
    });
</script>
@endsection