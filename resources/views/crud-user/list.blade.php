@extends('layouts.dashboard')

@section('title', 'Quản lý Tài khoản')

@section('content')
    {{-- CSS cho Flatpickr nếu cần --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <main class="w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- Header & Button Thêm mới --}}
        <div class="mb-1">
            <div class="text-center mb-8">
                <h1
                    class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-purple-400 to-blue-400 bg-clip-text text-transparent">
                    Danh sách Tài khoản Admin
                </h1>
                <p class="text-gray-300 mt-2 text-sm">Quản lý tất cả tài khoản quản trị viên tại một nơi.</p>
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
                    <input type="text" id="searchInput"
                        class="block w-full p-2.5 pl-10 text-sm text-gray-900 border border-gray-300 rounded-full bg-white focus:ring-indigo-500 focus:border-indigo-500 shadow-sm"
                        placeholder="Tìm theo tên hoặc username...">
                </div>

                {{-- Nút Thêm mới --}}
                <div class="w-full md:w-auto">
                    <button onclick="toggleModal('addUserModal')"
                        class="w-full md:w-auto bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2.5 px-5 rounded-full shadow-lg flex items-center justify-center gap-2 transition duration-200 transform hover:-translate-y-0.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Thêm Admin mới
                    </button>
                </div>
            </div>
        </div>

        {{-- Bảng danh sách User --}}
        <div class="bg-white rounded-lg shadow border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-indigo-200">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-indigo-600 uppercase tracking-wider">ID
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-indigo-600 uppercase tracking-wider">Tên
                                đăng nhập</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-indigo-600 uppercase tracking-wider">Họ
                                và Tên</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-indigo-600 uppercase tracking-wider">
                                Ngày tạo</th>
                            <th scope="col"
                                class="px-6 py-3 text-right text-xs font-medium text-indigo-600 uppercase tracking-wider">
                                Hành động</th>
                        </tr>
                    </thead>
                    {{-- QUAN TRỌNG: Để trống body, JS sẽ tự đổ dữ liệu vào đây --}}
                    <tbody class="divide-y divide-indigo-100" id="userTableBody">
                        {{-- Dữ liệu sẽ được render từ API --}}
                    </tbody>
                </table>
                {{-- Pagination Controls --}}
                <div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">

                    <div class="flex items-center gap-2 text-sm text-gray-700">
                        <span class="hidden sm:inline">Hiển thị</span>

                        <select onchange="changeLimit(this.value)"
                            class="block w-10 rounded-lg border-gray-300 py-1.5 text-sm text-indigo-600 font-medium leading-5 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 bg-white border cursor-pointer">
                            <option value="5" class="font-medium" selected>5</option>
                            <option value="10" class="font-medium">10</option> 
                            <option value="15" class="font-medium">15</option>
                            <option value="20" class="font-medium">20</option>
                        </select>

                        <span class="hidden sm:inline">
                            dòng trên tổng số <span class="font-medium text-indigo-600" id="pageTotal">0</span> dòng
                        </span>
                    </div>

                    <div class="flex items-center gap-1">
                        <nav class="isolate inline-flex gap-1" aria-label="Pagination" id="paginationControls">
                            {{-- JS sẽ render các nút hình tròn vào đây --}}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </main>

    {{-- MODAL SỬA USER --}}
    <div id="editUserModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"
                onclick="toggleModal('editUserModal')"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form id="editUserForm">
                    {{-- Method Spoofing cho Laravel --}}
                    <input type="hidden" id="edit_user_id" name="id">

                    <div class="bg-indigo-500 px-4 py-3 sm:px-6">
                        <h3 class="text-lg leading-6 font-medium text-white" id="modal-title">Chỉnh sửa tài khoản</h3>
                        <button type="button" class="absolute top-3 right-3 text-blue-200 hover:text-white"
                            onclick="toggleModal('editUserModal')">
                            <span class="sr-only">Close</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="space-y-4">
                            <div>
                                <label for="edit_username" class="block text-sm font-medium text-gray-700">Tên đăng
                                    nhập</label>
                                <input type="text" name="username" id="edit_username" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm border p-2 text-gray-900">
                                <div class="text-red-500 text-xs mt-1 error-message" id="error_edit_username"></div>
                            </div>
                            <div>
                                <label for="edit_name" class="block text-sm font-medium text-gray-700">Họ và Tên hiển
                                    thị</label>
                                <input type="text" name="name" id="edit_name" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm border p-2 text-gray-900">
                                <div class="text-red-500 text-xs mt-1 error-message" id="error_edit_name"></div>
                            </div>
                            <div>
                                <label for="edit_password" class="block text-sm font-medium text-gray-700">Mật khẩu
                                    mới</label>
                                <input type="password" name="password" id="edit_password"
                                    placeholder="Để trống nếu không muốn thay đổi"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm border p-2 text-gray-900">
                                <div class="text-red-500 text-xs mt-1 error-message" id="error_edit_password"></div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-500 text-base font-medium text-white hover:bg-indigo-600 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">
                            Lưu thay đổi
                        </button>
                        <button type="button" onclick="toggleModal('editUserModal')"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Đóng
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- MODAL THÊM USER --}}
    <div id="addUserModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"
                onclick="toggleModal('addUserModal')"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form id="addUserForm">
                    <div class="bg-indigo-500 px-4 py-3 sm:px-6">
                        <h3 class="text-lg leading-6 font-medium text-white" id="modal-title">Thêm Admin mới</h3>
                        <button type="button" class="absolute top-3 right-3 text-green-200 hover:text-white"
                            onclick="toggleModal('addUserModal')">
                            <span class="sr-only">Close</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="space-y-4">
                            <div>
                                <label for="add_username" class="block text-sm font-medium text-gray-700">Tên đăng nhập
                                    <span class="text-red-500">*</span></label>
                                <input type="text" name="username" id="add_username" required
                                    placeholder="Ví dụ: admin_phuochai"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm border p-2 text-gray-900">
                                <div class="text-red-500 text-xs mt-1 error-message" id="error_add_username"></div>
                            </div>
                            <div>
                                <label for="add_name" class="block text-sm font-medium text-gray-700">Họ và Tên <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="name" id="add_name" required placeholder="Ví dụ: Nguyễn Văn A"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm border p-2 text-gray-900">
                                <div class="text-red-500 text-xs mt-1 error-message" id="error_add_name"></div>
                            </div>
                            <div>
                                <label for="add_password" class="block text-sm font-medium text-gray-700">Mật khẩu <span
                                        class="text-red-500">*</span></label>
                                <input type="password" name="password" id="add_password" required
                                    placeholder="Nhập mật khẩu..."
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm border p-2 text-gray-900">
                                <div class="text-red-500 text-xs mt-1 error-message" id="error_add_password"></div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-500 text-base font-medium text-white hover:bg-indigo-600 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">
                            Thêm mới
                        </button>
                        <button type="button" onclick="toggleModal('addUserModal')"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Đóng
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/user.js') }}" defer></script>
@endpush