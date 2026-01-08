<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Icon -->
    <link rel="icon" type="image" href="{{ asset('favicon.webp') }}">
    <title>Admin - @yield('title')</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @yield('styles')
    <style>
        .modal {
            transition: opacity 0.25s ease;
        }

        body.modal-active {
            overflow-x: hidden;
            overflow-y: visible !important;
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.3s ease-out;
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(10px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-pulse-once {
            animation: pulse 1s cubic-bezier(0.4, 0, 0.6, 1) 1;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: .7;
            }
        }
    </style>
</head>

<body class="bg-gray-50 font-sans">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="fixed w-64 h-screen bg-white shadow-xl z-10">
            <div class="flex items-center justify-center h-16 bg-gradient-to-r from-purple-600 to-indigo-600">
                <h2 class="text-xl font-bold text-white tracking-wide">Admin Panel</h2>
            </div>
            <div class="p-4">
                <div
                    class="mb-6 flex items-center space-x-3 p-3 rounded-lg bg-gradient-to-r from-purple-50 to-indigo-50">
                    <div
                        class="w-10 h-10 rounded-full bg-gradient-to-r from-purple-500 to-indigo-500 flex items-center justify-center text-white">
                        <i class="fas fa-user"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-900">
                            {{ Auth::user()->name ?? 'Administrator' }}
                        </p>
                        <p class="text-xs text-gray-500">Online</p>
                    </div>
                </div>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('admin.users.index') }}"
                            class="flex items-center p-3 rounded-lg hover:bg-gray-100 transition-all duration-200 {{ request()->routeIs('admin.users') ? 'bg-purple-100 text-purple-700 shadow-sm' : 'text-gray-700' }}">
                            <i
                                class="fa-solid fa-cube w-5 h-5 mr-3 {{ request()->routeIs('admin.users.*') ? 'text-purple-600' : 'text-gray-500' }}"></i>
                            <span class="text-sm font-medium">Users</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.orders') }}"
                            class="flex items-center p-3 rounded-lg hover:bg-gray-100 transition-all duration-200 {{ request()->routeIs('admin.orders') ? 'bg-purple-100 text-purple-700 shadow-sm' : 'text-gray-700' }}">
                            <i
                                class="fa-solid fa-cube w-5 h-5 mr-3 {{ request()->routeIs('admin.orders.*') ? 'text-purple-600' : 'text-gray-500' }}"></i>
                            <span class="text-sm font-medium">Orders</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.courses.index') }}"
                            class="flex items-center p-3 rounded-lg hover:bg-gray-100 transition-all duration-200 {{ request()->routeIs('admin.courses.*') ? 'bg-purple-100 text-purple-700 shadow-sm' : 'text-gray-700' }}">
                            <i
                                class="fas fa-book w-5 h-5 mr-3 {{ request()->routeIs('admin.courses.*') ? 'text-purple-600' : 'text-gray-500' }}"></i>
                            <span class="text-sm font-medium">Courses</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.categories.index') }}"
                            class="flex items-center p-3 rounded-lg hover:bg-gray-100 transition-all duration-200 {{ request()->routeIs('admin.categories.*') ? 'bg-purple-100 text-purple-700 shadow-sm' : 'text-gray-700' }}">
                            <i
                                class="fas fa-tag w-5 h-5 mr-3 {{ request()->routeIs('admin.categories.*') ? 'text-purple-600' : 'text-gray-500' }}"></i>
                            <span class="text-sm font-medium">Categories</span>
                        </a>
                    </li>


                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault();
                                                this.closest('form').submit();"
                            class="flex items-center p-3 rounded-lg hover:bg-gray-100 transition-all duration-200 text-gray-700">
                            <i class="fas fa-sign-out-alt w-5 h-5 mr-3 text-gray-500"></i>
                            <span class="text-sm font-medium">Logout</span>
                        </x-dropdown-link>
                    </form>

                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 ml-64 p-8 overflow-y-auto">
            @if (session('success'))
                <div
                    class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-6 shadow-sm animate-fade-in-up">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-3 text-green-500"></i>
                        <p>{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if($errors->any())
                <div class="mb-4 p-4 rounded-lg bg-red-50 text-red-700 text-sm">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @yield('content')
        </div>
    </div>

    <!-- Modal Template -->
    <div class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center z-50 hidden"
        id="modal-container">
        <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

        <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded-lg shadow-lg z-50 overflow-y-auto">
            <div class="modal-content py-4 text-left px-6">
                <!-- Modal Header -->
                <div class="flex justify-between items-center pb-3">
                    <p class="text-xl font-bold text-gray-700" id="modal-title">Confirmation</p>
                    <button class="modal-close cursor-pointer z-50">
                        <i class="fas fa-times text-gray-500 hover:text-gray-700"></i>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="my-5" id="modal-body">
                    <p>Are you sure you want to proceed with this action?</p>
                </div>

                <!-- Modal Footer -->
                <div class="flex justify-end pt-2 gap-2" id="modal-footer">
                    <button
                        class="modal-close px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-colors">Cancel</button>
                    <button id="modal-confirm"
                        class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">Confirm</button>
                </div>
            </div>
        </div>
    </div>

    @vite('resources/js/app.js')
    <script>
        // Modal functionality
        const openModal = (title, message, confirmCallback) => {
            const modal = document.getElementById('modal-container');
            const modalTitle = document.getElementById('modal-title');
            const modalBody = document.getElementById('modal-body');
            const modalConfirm = document.getElementById('modal-confirm');

            modalTitle.textContent = title;
            modalBody.innerHTML = `<p>${message}</p>`;

            modal.classList.remove('hidden', 'opacity-0', 'pointer-events-none');
            modal.classList.add('opacity-100');
            document.body.classList.add('modal-active');

            // Remove previous event listeners
            const newModalConfirm = modalConfirm.cloneNode(true);
            modalConfirm.parentNode.replaceChild(newModalConfirm, modalConfirm);

            // Add new event listener
            newModalConfirm.addEventListener('click', () => {
                confirmCallback();
                closeModal();
            });
        };

        const closeModal = () => {
            const modal = document.getElementById('modal-container');
            modal.classList.add('opacity-0', 'pointer-events-none');
            setTimeout(() => {
                modal.classList.add('hidden');
                document.body.classList.remove('modal-active');
            }, 300);
        };

        // Close modal when clicking on overlay or close button
        document.querySelectorAll('.modal-close, .modal-overlay').forEach(elem => {
            elem.addEventListener('click', closeModal);
        });

        // Close modal when pressing ESC key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !document.getElementById('modal-container').classList.contains('hidden')) {
                closeModal();
            }
        });

        // Global function to handle delete confirmations
        window.confirmDelete = (formId, message) => {
            openModal('Confirm Deletion', message ||
                'Are you sure you want to delete this item? This action cannot be undone.', () => {
                    document.getElementById(formId).submit();
                });
            return false;
        };

        // Global function to handle course detail deletion
        window.confirmDeleteDetail = (element, message) => {
            openModal('Confirm Deletion', message ||
                'Are you sure you want to delete this detail? This action cannot be undone.', () => {
                    element.closest('.course-detail').remove();
                    updateDetailIndices();
                });
            return false;
        };
    </script>
    @yield('scripts')
</body>

</html>
