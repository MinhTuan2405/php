@extends('layouts.admin')

@section('title', 'Edit Course')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.courses.index', ['course_id' => $selectedCourse->id]) }}" class="text-purple-600 hover:text-purple-800 flex items-center">
        <i class="fas fa-arrow-left mr-2"></i> Back to Course Details
    </a>
</div>

<div class="bg-white rounded-xl shadow-md p-6 mb-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
        <i class="fas fa-edit text-purple-500 mr-3"></i> Edit Course: {{ $selectedCourse->name }}
    </h1>

    <!-- Form Update Course -->
    <form action="{{ route('admin.courses.update', $selectedCourse->id) }}" method="POST" class="max-w-4xl">
        @csrf
        @method('PUT')

        <!-- Course Information -->
        <div class="mb-8">
            <div class="flex items-center mb-4">
                <div class="w-8 h-8 rounded-full bg-purple-100 flex items-center justify-center mr-3">
                    <i class="fas fa-info text-purple-500"></i>
                </div>
                <h2 class="text-xl font-semibold text-gray-700">Course Information</h2>
            </div>

            <div class="bg-gray-50 rounded-lg p-6">
                <div class="grid grid-cols-2 gap-6">
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-medium mb-2">Course Name</label>
                        <input type="text" name="name" id="name" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-200 focus:border-purple-500 transition-all @error('name') border-red-500 @enderror" value="{{ old('name', $selectedCourse->name) }}">
                        @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="category_id" class="block text-gray-700 font-medium mb-2">Category</label>
                        <select name="category_id" id="category_id" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-200 focus:border-purple-500 transition-all @error('category_id') border-red-500 @enderror">
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $selectedCourse->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="grade" class="block text-gray-700 font-medium mb-2">Grade</label>
                        <input type="text" name="grade" id="grade" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-200 focus:border-purple-500 transition-all @error('grade') border-red-500 @enderror" value="{{ old('grade', $selectedCourse->grade) }}">
                        @error('grade')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="price" class="block text-gray-700 font-medium mb-2">Price ($)</label>
                        <input type="number" name="price" id="price" step="0.01" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-200 focus:border-purple-500 transition-all @error('price') border-red-500 @enderror" value="{{ old('price', $selectedCourse->price) }}">
                        @error('price')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-gray-700 font-medium mb-2">Course Description</label>
                    <textarea name="description" id="description" rows="4" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-200 focus:border-purple-500 transition-all @error('description') border-red-500 @enderror">{{ old('description', $selectedCourse->description) }}</textarea>
                    @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Course Details -->
        <div class="mb-8">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center">
                    <div class="w-8 h-8 rounded-full bg-purple-100 flex items-center justify-center mr-3">
                        <i class="fas fa-list-ul text-purple-500"></i>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-700">Course Details</h2>
                </div>
                <button type="button" id="add-course-detail" class="flex items-center bg-green-50 text-green-700 px-4 py-2 rounded-lg hover:bg-green-100 transition-colors duration-200">
                    <i class="fas fa-plus mr-2"></i> Add Detail
                </button>
            </div>

            <div id="course-details-container" class="space-y-4">
                @foreach ($selectedCourse->coursedetails as $index => $detail)
                <div class="course-detail bg-gray-50 rounded-lg p-5 shadow-sm hover:shadow-md transition-all duration-200">
                    <div class="flex justify-between items-center mb-3">
                        <h3 class="font-medium text-gray-800">Detail #{{ $index + 1 }}</h3>
                        <button type="button" class="delete-course-detail text-red-500 hover:text-red-700 transition-colors" data-index="{{ $index }}">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>

                    <input type="hidden" name="course_details[{{ $index }}][id]" value="{{ $detail->id }}">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="course_details_{{ $index }}_name" class="block text-gray-700 font-medium mb-2">Detail Name</label>
                            <input type="text" name="course_details[{{ $index }}][name]" id="course_details_{{ $index }}_name" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-200 focus:border-purple-500 transition-all @error('course_details.' . $index . '.name') border-red-500 @enderror" value="{{ old('course_details.' . $index . '.name', $detail->name) }}">
                            @error('course_details.' . $index . '.name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="course_details_{{ $index }}_content" class="block text-gray-700 font-medium mb-2">Content (URL)</label>
                            <input type="url" name="course_details[{{ $index }}][content]" id="course_details_{{ $index }}_content" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-200 focus:border-purple-500 transition-all @error('course_details.' . $index . '.content') border-red-500 @enderror" value="{{ old('course_details.' . $index . '.content', $detail->content) }}">
                            @error('course_details.' . $index . '.content')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <label for="course_details_{{ $index }}_description" class="block text-gray-700 font-medium mb-2">Description</label>
                        <textarea name="course_details[{{ $index }}][description]" id="course_details_{{ $index }}_description" rows="3" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-200 focus:border-purple-500 transition-all @error('course_details.' . $index . '.description') border-red-500 @enderror">{{ old('course_details.' . $index . '.description', $detail->description) }}</textarea>
                        @error('course_details.' . $index . '.description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                @endforeach
            </div>

            @if(count($selectedCourse->coursedetails) === 0)
            <div id="no-details-message" class="bg-gray-50 rounded-lg p-6 text-center">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-file-alt text-gray-400 text-xl"></i>
                </div>
                <p class="text-gray-500 mb-2">No course details added yet.</p>
                <p class="text-sm text-gray-400">Click the "Add Detail" button to add your first course detail.</p>
            </div>
            @endif
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center space-x-4 border-t border-gray-100 pt-6">
            <button type="submit" class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-6 py-3 rounded-lg hover:from-purple-700 hover:to-indigo-700 transition-all duration-200 flex items-center shadow-md">
                <i class="fas fa-save mr-2"></i> Update Course
            </button>
            <a href="{{ route('admin.courses.index', ['course_id' => $selectedCourse->id]) }}" class="bg-gray-200 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-300 transition-colors duration-200">
                Cancel
            </a>
        </div>
    </form>

    <!-- Form Delete Course (separate) -->
    <div class="mt-12 pt-6 border-t border-gray-200">
        <h3 class="text-lg font-semibold text-red-600 mb-4">Danger Zone</h3>
        <p class="text-gray-600 mb-4">Once you delete a course, there is no going back. Please be certain.</p>

        <form id="delete-course-form" action="{{ route('admin.courses.destroy', $selectedCourse->id) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="button"
                onclick="confirmDelete('delete-course-form', 'Are you sure you want to delete <strong>{{ $selectedCourse->name }}</strong>? This will also delete all associated course details.')"
                class="bg-red-50 text-red-700 px-4 py-2 rounded-lg hover:bg-red-100 transition-colors duration-200 flex items-center w-auto">
                <i class="fas fa-trash-alt mr-2"></i> Delete Course
            </button>
        </form>
    </div>
</div>

@section('scripts')
<script>
    document.getElementById('add-course-detail').addEventListener('click', function() {
        const container = document.getElementById('course-details-container');
        const noDetailsMessage = document.getElementById('no-details-message');

        if (noDetailsMessage) {
            noDetailsMessage.remove();
        }

        const index = container.querySelectorAll('.course-detail').length;
        const newDetail = `
            <div class="course-detail bg-gray-50 rounded-lg p-5 shadow-sm hover:shadow-md transition-all duration-200 animate-fade-in-up">
                <div class="flex justify-between items-center mb-3">
                    <h3 class="font-medium text-gray-800">Detail #${index + 1}</h3>
                    <button type="button" class="delete-course-detail text-red-500 hover:text-red-700 transition-colors" data-index="${index}">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="course_details_${index}_name" class="block text-gray-700 font-medium mb-2">Detail Name</label>
                        <input type="text" name="course_details[${index}][name]" id="course_details_${index}_name" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-200 focus:border-purple-500 transition-all">
                    </div>
                    <div>
                        <label for="course_details_${index}_content" class="block text-gray-700 font-medium mb-2">Content (URL)</label>
                        <input type="url" name="course_details[${index}][content]" id="course_details_${index}_content" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-200 focus:border-purple-500 transition-all">
                    </div>
                </div>
                <div>
                    <label for="course_details_${index}_description" class="block text-gray-700 font-medium mb-2">Description</label>
                    <textarea name="course_details[${index}][description]" id="course_details_${index}_description" rows="3" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-200 focus:border-purple-500 transition-all"></textarea>
                </div>
            </div>`;
        container.insertAdjacentHTML('beforeend', newDetail);

        const newDeleteButton = container.querySelector(`.delete-course-detail[data-index="${index}"]`);
        newDeleteButton.addEventListener('click', function() {
            confirmDeleteDetail(this, 'Are you sure you want to delete this course detail?');
        });
    });

    function updateDetailIndices() {
        const details = document.querySelectorAll('.course-detail');
        details.forEach((detail, newIndex) => {
            // Update heading
            const heading = detail.querySelector('h3');
            if (heading) {
                heading.textContent = `Detail #${newIndex + 1}`;
            }

            // Update inputs
            const inputs = detail.querySelectorAll('input, textarea');
            inputs.forEach(input => {
                const nameAttr = input.getAttribute('name');
                if (nameAttr) {
                    const newNameAttr = nameAttr.replace(/\[\d+\]/, `[${newIndex}]`);
                    input.setAttribute('name', newNameAttr);
                }

                const idAttr = input.getAttribute('id');
                if (idAttr) {
                    const newIdAttr = idAttr.replace(/_\d+_/, `_${newIndex}_`);
                    input.setAttribute('id', newIdAttr);
                }
            });

            // Update labels
            const labels = detail.querySelectorAll('label');
            labels.forEach(label => {
                const forAttr = label.getAttribute('for');
                if (forAttr) {
                    const newForAttr = forAttr.replace(/_\d+_/, `_${newIndex}_`);
                    label.setAttribute('for', newForAttr);
                }
            });

            // Update delete button
            const deleteButton = detail.querySelector('.delete-course-detail');
            if (deleteButton) {
                deleteButton.dataset.index = newIndex;
            }
        });
    }

    document.querySelectorAll('.delete-course-detail').forEach(button => {
        button.addEventListener('click', function() {
            confirmDeleteDetail(this, 'Are you sure you want to delete this course detail?');
        });
    });
</script>
@endsection
@endsection