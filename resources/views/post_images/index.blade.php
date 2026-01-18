@extends('layouts.dashboard')

@section('title', 'Quản lý Hình Ảnh Của Bài viết')

@section('content')
    <main class="w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="mb-1">
            <div class="text-center mb-8">
                <h1
                    class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-purple-400 to-blue-400 bg-clip-text text-transparent">
                    Danh sách Hình Ảnh Của Bài viết
                </h1>
                <p class="text-gray-300 mt-2 text-sm">Quản lý hình ảnh của bài viết </p>
            </div>

            <div class="flex flex-col md:flex-row justify-between items-center bg-indigo-200 gap-4 p-2 rounded-xl">
                <div class="relative w-full md:w-1/3">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <input type="text" id="searchInput"
                        class="block w-full p-2.5 pl-10 text-sm text-gray-900 border border-gray-300 rounded-full bg-white focus:ring-indigo-500 focus:border-indigo-500 shadow-sm"
                        placeholder="Tìm theo tên bài viết..." value="{{ request('search') }}">
                </div>

                <div class="w-full md:w-auto">
                    <a href="{{ route('post-images.create') }}"
                        class="w-full md:w-auto bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2.5 px-5 rounded-full shadow-lg flex items-center justify-center gap-2 transition duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Thêm ảnh mới cho bài viết
                    </a>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 mt-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white rounded-lg shadow border border-gray-200 overflow-hidden mt-1">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-indigo-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">TÊN BÀI VIẾT
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">HÌNH ẢNH
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                HÀNH ĐỘNG</th>
                        </tr>
                    </thead>
                    <tbody id="postImageTableBody" class="bg-white divide-y divide-gray-200">
                        @foreach($postImages as $postImage)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $postImage->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $postImage->post->title ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <img src="{{ asset('storage/' . $postImage->image) }}" alt="Hình ảnh" class="w-16 h-16 object-cover rounded-lg shadow-sm">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('post-images.show', $postImage) }}"
                                            class="text-indigo-600 hover:text-indigo-900 p-1 rounded-md hover:bg-indigo-50 transition-colors"
                                            title="Xem chi tiết">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </a>
                                        <a href="{{ route('post-images.edit', $postImage) }}"
                                            class="text-blue-600 hover:text-blue-900 p-1 rounded-md hover:bg-blue-50 transition-colors"
                                            title="Chỉnh sửa">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>
                                        <button onclick="openDeleteModal({{ $postImage->id }}, '{{ $postImage->post->title ?? 'hình ảnh' }}')"
                                            class="text-red-600 hover:text-red-900 p-1 rounded-md hover:bg-red-50 transition-colors"
                                            title="Xóa">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
                <div class="flex items-center gap-2 text-sm text-gray-700">
                    <span class="hidden sm:inline">Hiển thị</span>
                    <select onchange="changeLimit(this.value)"
                        class="block w-14 rounded-lg border-gray-300 py-1.5 text-sm text-indigo-600 font-medium shadow-sm focus:border-indigo-500 focus:ring-indigo-500 bg-white border cursor-pointer">
                        <option value="5">5</option>
                        <option value="10" selected>10</option>
                        <option value="15">15</option>
                        <option value="20">20</option>
                    </select>
                    <span class="hidden sm:inline">
                        dòng trên tổng số <span class="font-medium text-indigo-600" id="pageTotal">{{ $postImages->total() }}</span> dòng
                    </span>
                </div>

                <div class="flex items-center gap-1">
                    {{ $postImages->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </main>

    <!-- Delete Modal -->
    <div id="deleteModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"
                onclick="toggleModal('deleteModal')"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div
                class="inline-block align-bottom bg-white rounded-xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div
                            class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-bold text-gray-900" id="deleteModalTitle">Xác nhận xóa hình ảnh</h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500" id="deleteModalMessage">Dữ liệu hình ảnh sẽ bị xóa vĩnh viễn. Bạn có chắc chắn muốn tiếp tục?</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse gap-2">
                    <form id="deleteForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="w-full inline-flex justify-center rounded-full border border-transparent shadow-sm px-5 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none sm:w-auto sm:text-sm transition-all">
                            Xóa ngay
                        </button>
                    </form>
                    <button type="button" onclick="toggleModal('deleteModal')"
                        class="mt-3 w-full inline-flex justify-center rounded-full border border-gray-300 shadow-sm px-5 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:w-auto sm:text-sm transition-all">
                        Hủy bỏ
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openDeleteModal(id, title) {
            document.getElementById('deleteModalTitle').textContent = `Xác nhận xóa hình ảnh của "${title}"`;
            document.getElementById('deleteModalMessage').textContent = 'Dữ liệu hình ảnh sẽ bị xóa vĩnh viễn. Bạn có chắc chắn muốn tiếp tục?';
            document.getElementById('deleteForm').action = `/admin/post-images/${id}`;
            toggleModal('deleteModal');
        }

        function toggleModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.toggle('hidden');
        }

        function changeLimit(limit) {
            const url = new URL(window.location);
            url.searchParams.set('limit', limit);
            window.location.href = url.toString();
        }

        // Search functionality
        document.getElementById('searchInput').addEventListener('input', function() {
            const searchTerm = this.value.trim();
            const url = new URL(window.location);
            
            if (searchTerm) {
                url.searchParams.set('search', searchTerm);
            } else {
                url.searchParams.delete('search');
            }
            
            // Debounce search
            clearTimeout(window.searchTimeout);
            window.searchTimeout = setTimeout(() => {
                window.location.href = url.toString();
            }, 500);
        });
    </script>
@endsection