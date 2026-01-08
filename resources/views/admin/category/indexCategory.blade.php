@extends('layouts.dashboard')

@section('title', 'Quản lý danh mục')

@section('content')
    <main class="w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="mb-1">
            <div class="text-center mb-8">
                <h1
                    class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-purple-400 to-blue-400 bg-clip-text text-transparent">
                    Danh sách Danh mục
                </h1>
                <p class="text-gray-300 mt-2 text-sm">Quản lý tất cả thông tin danh mục tại một nơi.</p>
            </div>

            <div class="flex flex-col md:flex-row justify-between items-center bg-indigo-200 gap-4 p-2 rounded-xl">
                {{-- Thanh Tìm kiếm --}}
                <div class="relative w-full md:w-1/3">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <form action="" method="GET">
                        <input type="text" id="searchInput" name="search" value="{{ request('search') }}"
                            class="block w-full p-2.5 pl-10 text-sm text-gray-900 border border-gray-300 rounded-full bg-white focus:ring-indigo-500 focus:border-indigo-500 shadow-sm"
                            placeholder="Tìm theo mã danh mục hoặc tên danh mục...">
                    </form>
                </div>

                <div class="w-full md:w-auto">
                    <a href="{{ route('category.create') }}"
                        class="w-full md:w-auto bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2.5 px-5 rounded-full shadow-lg flex items-center justify-center gap-2 transition duration-200 transform hover:-translate-y-0.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Thêm Danh mục
                    </a>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        <div class="bg-white rounded-lg shadow border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-indigo-200">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-indigo-600 uppercase tracking-wider">ID
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-indigo-600 uppercase tracking-wider">
                                Name
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-indigo-600 uppercase tracking-wider">
                                Slug
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-indigo-600 uppercase  tracking-wider">
                                Ngày
                                đăng</th>
                            <th scope="col"
                                class="px-6 py-3 text-right text-xs font-medium text-indigo-600 uppercase tracking-wider">
                                Hành
                                động</th>
                        </tr>
                    </thead>
                    <tbody id="categoryTable" class="bg-white divide-y divide-gray-200">

                    </tbody>
                </table>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
                        <form action="" method="GET">
                            <div class="flex items-center gap-2 text-sm text-gray-700">
                                <span class="hidden sm:inline">Hiển thị</span>

                                <select name="per_page" onchange="this.form.submit()"
                                    class="block w-10 rounded-lg border-gray-300 py-1.5 text-sm text-indigo-600 font-medium leading-5 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 bg-white border cursor-pointer">
                                    @foreach ([5, 10, 15, 20] as $size)
                                        <option value="{{ $size }}" {{ $perPage == $size ? 'selected' : '' }}>
                                            {{ $size }}
                                        </option>
                                    @endforeach
                                </select>

                                <span class="hidden sm:inline">
                                    dòng trên tổng số <span class="font-medium text-indigo-600" id="pageTotal">0</span> dòng
                                </span>
                            </div>
                        </form>
                        @php
                            $current = $categories->currentPage();
                            $last = $categories->lastPage();

                            // class giống JS
                            $baseClass =
                                'relative inline-flex items-center justify-center w-8 h-8 rounded-full text-sm font-semibold transition-colors duration-200';
                            $inactiveClass = 'text-gray-500 hover:bg-indigo-100 hover:text-indigo-700';
                            $activeClass = 'bg-indigo-700 text-white shadow-sm';
                            $disabledClass = 'text-gray-300 pointer-events-none';
                        @endphp

                        {{--  --}}
                        <div class="flex items-center gap-1 justify-center mt-4">

                            {{-- 1. First (<<) --}}
                            <a href="{{ $current === 1 ? '#' : $categories->url(1) }}"
                                class="{{ $baseClass }} {{ $current === 1 ? $disabledClass : $inactiveClass }}">
                                <span class="sr-only">First</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
                                </svg>
                            </a>

                            {{-- 2. Previous (<) --}}
                            <a href="{{ $current === 1 ? '#' : $categories->previousPageUrl() }}"
                                class="{{ $baseClass }} {{ $current === 1 ? $disabledClass : $inactiveClass }}">
                                <span class="sr-only">Previous</span>
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7" />
                                </svg>
                            </a>

                            {{-- 3. Logic render số trang + ... --}}
                            @php
                                $pages = [];

                                if ($last <= 7) {
                                    $pages = range(1, $last);
                                } else {
                                    if ($current <= 4) {
                                        $pages = [1, 2, 3, 4, 5, '...', $last];
                                    } elseif ($current >= $last - 3) {
                                        $pages = [1, '...', $last - 4, $last - 3, $last - 2, $last - 1, $last];
                                    } else {
                                        $pages = [1, '...', $current - 1, $current, $current + 1, '...', $last];
                                    }
                                }
                            @endphp

                            @foreach ($pages as $page)
                                @if ($page === '...')
                                    <span
                                        class="relative inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400">
                                        ...
                                    </span>
                                @else
                                    <a href="{{ $categories->url($page) }}"
                                        class="{{ $baseClass }} {{ $page == $current ? $activeClass : $inactiveClass }}">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach

                            {{-- 4. Next (>) --}}
                            <a href="{{ $current === $last ? '#' : $categories->nextPageUrl() }}"
                                class="{{ $baseClass }} {{ $current === $last ? $disabledClass : $inactiveClass }}">
                                <span class="sr-only">Next</span>
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </a>

                            {{-- 5. Last (>>) --}}
                            <a href="{{ $current === $last ? '#' : $categories->url($last) }}"
                                class="{{ $baseClass }} {{ $current === $last ? $disabledClass : $inactiveClass }}">
                                <span class="sr-only">Last</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div id="deleteModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"
                onclick="toggleModal('deleteModal')"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div
                            class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Xóa danh mục</h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">Bạn có chắc chắn muốn xóa danh mục này không? Hành động
                                    này
                                    không thể hoàn tác.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    {{-- <form id="deleteForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">
                            Xóa ngay
                        </button>
                    </form> --}}
                    <button type="button" onclick="deleteCategory()" class="bg-red-600 text-white px-4 py-2 rounded">
                        Xóa ngay
                    </button>
                    <button type="button" onclick="toggleModal('deleteModal')"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Hủy bỏ
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div id="editModal" class="fixed inset-0 z-50 hidden">
        <div class="flex items-center justify-center min-h-screen bg-black bg-opacity-50">
            <div class="bg-white rounded-lg w-full max-w-md p-6">
                <h3 class="text-lg font-semibold mb-4">Sửa danh mục</h3>

                <input type="hidden" id="editId">

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Tên danh mục
                    </label>
                    <input type="text" id="editName"
                        class="w-full border rounded px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500 text-gray-700">
                </div>

                <div class="flex justify-end gap-2">
                    <button onclick="toggleModal('editModal')"
                        class="px-4 py-2 border rounded text-gray-700">
                        Hủy
                    </button>
                    <button onclick="updateCategory()"
                        class="px-4 py-2 bg-indigo-600 text-white rounded">
                        Lưu
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    {{-- <script>
        function toggleModal(modalID) {
            const modal = document.getElementById(modalID);
            if (modal) {
                modal.classList.toggle('hidden');
            }
        }

        function confirmDelete(id) {
            let url = "{{ route('category.destroy', ':id') }}";
            url = url.replace(':id', id);

            document.getElementById('deleteForm').action = url;
            toggleModal('deleteModal');
        }
    </script> --}}

    <script>
        window.CategoryConfig = {
            apiUrl: '/api/categories',
            csrfToken: '{{ csrf_token() }}'
        };
    </script>
    <script src="{{ asset('js/category.js') }}"></script>
@endpush
