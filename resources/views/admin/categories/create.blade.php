@extends('layouts.admin')

@section('title', 'Create Category')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.categories.index') }}" class="text-purple-600 hover:text-purple-800 flex items-center">
        <i class="fas fa-arrow-left mr-2"></i> Back to Categories
    </a>
</div>

<div class="bg-white rounded-xl shadow-md p-6 mb-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
        <i class="fas fa-plus-circle text-purple-500 mr-3"></i> Create New Category
    </h1>

    <form action="{{ route('admin.categories.store') }}" method="POST" class="max-w-lg">
        @csrf

        <div class="bg-gray-50 rounded-lg p-6 mb-6">
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-medium mb-2">Category Name</label>
                <input type="text" name="name" id="name" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-200 focus:border-purple-500 transition-all @error('name') border-red-500 @enderror" value="{{ old('name') }}">
                @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center space-x-4">
            <button type="submit" class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-6 py-3 rounded-lg hover:from-purple-700 hover:to-indigo-700 transition-all duration-200 flex items-center shadow-md">
                <i class="fas fa-save mr-2"></i> Create Category
            </button>
            <a href="{{ route('admin.categories.index') }}" class="bg-gray-200 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-300 transition-colors duration-200">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection