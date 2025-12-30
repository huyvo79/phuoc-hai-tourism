@extends('admin.dashboard')

@section('title', 'Quản lý Tài khoản')

@section('content')
    {{-- CSS cho Datepicker nếu cần dùng, không thì có thể bỏ --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <main class="max-w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            @livewire('user-table')
        </div>
    </main>

    <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="editUserForm" method="POST">
                @csrf
                @method('PUT')

                {{-- ID ẩn để xác định user đang sửa --}}
                <input type="hidden" id="edit_user_id" name="id">

                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="editUserModalLabel">Chỉnh sửa tài khoản</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">

                                {{-- Trường 1: Tên đăng nhập (Username) --}}
                                <div class="form-group">
                                    <label for="edit_username">Tên đăng nhập</label>
                                    <input type="text" class="form-control" id="edit_username" name="username" required>
                                    <div class="text-danger error-message" id="error_edit_username"></div>
                                </div>

                                {{-- Trường 2: Họ và Tên (Name) --}}
                                <div class="form-group">
                                    <label for="edit_name">Họ và Tên hiển thị</label>
                                    <input type="text" class="form-control" id="edit_name" name="name" required>
                                    <div class="text-danger error-message" id="error_edit_name"></div>
                                </div>

                                {{-- Trường 3: Mật khẩu (Chỉ nhập nếu muốn đổi) --}}
                                <div class="form-group">
                                    <label for="edit_password">Mật khẩu mới</label>
                                    <input type="password" class="form-control" id="edit_password" name="password"
                                        placeholder="Để trống nếu không muốn thay đổi">
                                    <div class="text-danger error-message" id="error_edit_password"></div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="addUserForm" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="addUserModalLabel">Thêm Admin mới</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">

                                {{-- Trường 1: Tên đăng nhập --}}
                                <div class="form-group">
                                    <label for="add_username">Tên đăng nhập <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="add_username" name="username"
                                        placeholder="Ví dụ: admin_phuochai" required>
                                    <div class="text-danger error-message" id="error_add_username"></div>
                                </div>

                                {{-- Trường 2: Họ tên --}}
                                <div class="form-group">
                                    <label for="add_name">Họ và Tên <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="add_name" name="name"
                                        placeholder="Ví dụ: Nguyễn Văn A" required>
                                    <div class="text-danger error-message" id="error_add_name"></div>
                                </div>

                                {{-- Trường 3: Mật khẩu --}}
                                <div class="form-group">
                                    <label for="add_password">Mật khẩu <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" id="add_password" name="password"
                                        placeholder="Nhập mật khẩu..." required>
                                    <div class="text-danger error-message" id="error_add_password"></div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-success">Thêm mới</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
    {{-- Đổi file JS tương ứng --}}
    <script src="{{ asset('js/user.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
@endpush