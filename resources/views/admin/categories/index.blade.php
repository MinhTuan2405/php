@extends('layouts.admin')

@section('title', 'Manage Categories')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-3xl font-bold text-gray-800">Manage Categories</h1>
    <a href="{{ route('admin.categories.create') }}"
        class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-5 py-2.5 rounded-lg hover:from-purple-700 hover:to-indigo-700 transition-all duration-200 flex items-center shadow-md">
        <i class="fas fa-plus mr-2"></i> Add New Category
    </a>
</div>

<div class="flex gap-6">
    <!-- Left: Categories List -->
    <div class="w-1/3">
        <div class="bg-white rounded-xl shadow-md p-5 mb-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-4 flex items-center">
                <i class="fas fa-tag text-purple-500 mr-2"></i> Categories List
            </h2>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
                <input type="text" id="category-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full pl-10 p-2.5" placeholder="Search categories...">
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="max-h-[calc(100vh-250px)] overflow-y-auto p-3 space-y-2" id="categories-list">
                @forelse ($categories as $category)
                <a href="{{ route('admin.categories.index', ['category_id' => $category->id]) }}"
                    class="flex items-center p-3 rounded-lg {{ $selectedCategory && $selectedCategory->id == $category->id ? 'bg-purple-50 border-l-4 border-purple-500' : 'bg-gray-50 hover:bg-gray-100' }} transition-all duration-200 group">
                    <div class="flex-1">
                        <h3 class="font-medium text-gray-800 group-hover:text-purple-700 transition-colors">{{ $category->name }}</h3>
                    </div>
                    <i class="fas fa-chevron-right text-gray-300 group-hover:text-purple-500 transition-colors"></i>
                </a>
                @empty
                <div class="flex flex-col items-center justify-center py-8 text-center">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-tag text-gray-400 text-xl"></i>
                    </div>
                    <p class="text-gray-500">No categories found.</p>
                    <p class="text-sm text-gray-400 mt-1">Create your first category to get started.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Right: Category Details & Edit -->
    <div class="w-2/3">
        @if ($selectedCategory)
        <div class="bg-white rounded-xl shadow-md p-6 mb-6 animate-fade-in-up">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-1">{{ $selectedCategory->name }}</h2>
                    <p class="text-gray-500">Category ID: {{ $selectedCategory->id }}</p>
                </div>
            </div>

            <div class="bg-gray-50 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-4 flex items-center">
                    <i class="fas fa-edit text-purple-500 mr-2"></i> Edit Category
                </h3>
                <form action="{{ route('admin.categories.update', $selectedCategory->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-medium mb-2">Category Name</label>
                        <input type="text" name="name" id="name" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-200 focus:border-purple-500 transition-all @error('name') border-red-500 @enderror" value="{{ old('name', $selectedCategory->name) }}">
                        @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-4 py-2 rounded-lg hover:from-purple-700 hover:to-indigo-700 transition-all duration-200 flex items-center shadow-md w-auto">
                        <i class="fas fa-save mr-2"></i> Update Category
                    </button>
                </form>
            </div>
        </div>
        @else
        <div class="bg-white rounded-xl shadow-md p-8 flex flex-col items-center justify-center text-center h-64">
            <div class="w-20 h-20 bg-purple-100 rounded-full flex items-center justify-center mb-4">
                <i class="fas fa-tag text-purple-500 text-2xl"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-700 mb-2">No Category Selected</h3>
            <p class="text-gray-500 max-w-md">Select a category from the list to view and edit its details, or create a new category to get started.</p>
        </div>
        @endif
    </div>
</div>

@section('scripts')
<script>
    // Simple search functionality
    document.getElementById('category-search').addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const categoryItems = document.querySelectorAll('#categories-list > a');

        categoryItems.forEach(item => {
            const categoryName = item.querySelector('h3').textContent.toLowerCase();

            if (categoryName.includes(searchTerm)) {
                item.style.display = 'flex';
            } else {
                item.style.display = 'none';
            }
        });
    });
</script>
@endsection
@endsection