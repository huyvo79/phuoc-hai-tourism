@extends('layouts.dashboard')

@section('title', 'Quản lý Tài khoản')

@section('content')
    {{-- CSS cho Flatpickr nếu cần --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <main class="w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        {{-- Header & Button Thêm mới --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-white-800">Danh sách Tài khoản</h1>
            <button onclick="toggleModal('addUserModal')" 
                    class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow flex items-center gap-2 transition duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Thêm Admin mới
            </button>
        </div>

        {{-- Bảng danh sách User --}}
        <div class="bg-white rounded-lg shadow border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tên đăng nhập</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Họ và Tên</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ngày tạo</th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Hành động</th>
                        </tr>
                    </thead>
                    {{-- QUAN TRỌNG: Để trống body, JS sẽ tự đổ dữ liệu vào đây --}}
                    <tbody class="bg-white divide-y divide-gray-200 text-gray-700" id="userTableBody">
                        {{-- Dữ liệu sẽ được render từ API --}}
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    {{-- MODAL SỬA USER --}}
    <div id="editUserModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="toggleModal('editUserModal')"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form id="editUserForm">
                    {{-- Method Spoofing cho Laravel --}}
                    <input type="hidden" id="edit_user_id" name="id">

                    <div class="bg-blue-600 px-4 py-3 sm:px-6">
                        <h3 class="text-lg leading-6 font-medium text-white" id="modal-title">Chỉnh sửa tài khoản</h3>
                        <button type="button" class="absolute top-3 right-3 text-blue-200 hover:text-white" onclick="toggleModal('editUserModal')">
                            <span class="sr-only">Close</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="space-y-4">
                            <div>
                                <label for="edit_username" class="block text-sm font-medium text-gray-700">Tên đăng nhập</label>
                                <input type="text" name="username" id="edit_username" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm border p-2 text-gray-900">
                                <div class="text-red-500 text-xs mt-1 error-message" id="error_edit_username"></div>
                            </div>
                            <div>
                                <label for="edit_name" class="block text-sm font-medium text-gray-700">Họ và Tên hiển thị</label>
                                <input type="text" name="name" id="edit_name" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm border p-2 text-gray-900">
                                <div class="text-red-500 text-xs mt-1 error-message" id="error_edit_name"></div>
                            </div>
                            <div>
                                <label for="edit_password" class="block text-sm font-medium text-gray-700">Mật khẩu mới</label>
                                <input type="password" name="password" id="edit_password" placeholder="Để trống nếu không muốn thay đổi"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm border p-2 text-gray-900">
                                <div class="text-red-500 text-xs mt-1 error-message" id="error_edit_password"></div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">
                            Lưu thay đổi
                        </button>
                        <button type="button" onclick="toggleModal('editUserModal')" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Đóng
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- MODAL THÊM USER --}}
    <div id="addUserModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="toggleModal('addUserModal')"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form id="addUserForm">
                    <div class="bg-green-600 px-4 py-3 sm:px-6">
                        <h3 class="text-lg leading-6 font-medium text-white" id="modal-title">Thêm Admin mới</h3>
                        <button type="button" class="absolute top-3 right-3 text-green-200 hover:text-white" onclick="toggleModal('addUserModal')">
                            <span class="sr-only">Close</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="space-y-4">
                            <div>
                                <label for="add_username" class="block text-sm font-medium text-gray-700">Tên đăng nhập <span class="text-red-500">*</span></label>
                                <input type="text" name="username" id="add_username" required placeholder="Ví dụ: admin_phuochai"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm border p-2 text-gray-900">
                                <div class="text-red-500 text-xs mt-1 error-message" id="error_add_username"></div>
                            </div>
                            <div>
                                <label for="add_name" class="block text-sm font-medium text-gray-700">Họ và Tên <span class="text-red-500">*</span></label>
                                <input type="text" name="name" id="add_name" required placeholder="Ví dụ: Nguyễn Văn A"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm border p-2 text-gray-900">
                                <div class="text-red-500 text-xs mt-1 error-message" id="error_add_name"></div>
                            </div>
                            <div>
                                <label for="add_password" class="block text-sm font-medium text-gray-700">Mật khẩu <span class="text-red-500">*</span></label>
                                <input type="password" name="password" id="add_password" required placeholder="Nhập mật khẩu..."
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm border p-2 text-gray-900">
                                <div class="text-red-500 text-xs mt-1 error-message" id="error_add_password"></div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">
                            Thêm mới
                        </button>
                        <button type="button" onclick="toggleModal('addUserModal')" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
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