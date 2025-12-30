document.addEventListener('DOMContentLoaded', function () {

    // ============================================================
    // 1. XỬ LÝ MODAL THÊM USER (ADD)
    // ============================================================

    // Mở Modal khi bấm nút "Thêm tài khoản"
    // Lưu ý: Trong HTML nút id="btn-add-user" chưa có data-toggle, nên ta dùng JS để mở
    const btnAddUser = document.getElementById('btn-add-user');
    if (btnAddUser) {
        btnAddUser.addEventListener('click', function () {
            // Reset form và lỗi trước khi mở
            const addForm = document.getElementById('addUserForm');
            if (addForm) addForm.reset();
            clearErrors();
            
            // Mở Modal bằng jQuery (do dùng Bootstrap 4/5)
            $('#addUserModal').modal('show');
        });
    }

    // Xử lý Submit Form Thêm
    const addForm = document.getElementById('addUserForm');
    if (addForm) {
        addForm.addEventListener('submit', async function (e) {
            e.preventDefault();

            // Setup nút bấm (loading)
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.textContent;
            setLoading(submitBtn, true);

            // Chuẩn bị dữ liệu
            const url = '/api/users';
            const formData = new FormData(this);
            clearErrors();

            try {
                const response = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': getCsrfToken()
                    },
                    body: formData
                });

                const data = await response.json();

                if (response.ok) {
                    handleSuccess('Thêm tài khoản thành công!');
                } else if (response.status === 422) {
                    handleValidationErrors(data.errors, 'add');
                    setLoading(submitBtn, false, originalText);
                } else {
                    handleError(data.message || 'Có lỗi xảy ra.');
                    setLoading(submitBtn, false, originalText);
                }
            } catch (err) {
                console.error(err);
                handleError('Lỗi kết nối server.');
                setLoading(submitBtn, false, originalText);
            }
        });
    }

    // ============================================================
    // 2. XỬ LÝ MODAL SỬA USER (EDIT)
    // ============================================================

    // Bắt sự kiện click vào nút Edit (Dùng Event Delegation vì nút này do Livewire sinh ra)
    $(document).on('click', '.edit-btn', function () {
        // Lấy dữ liệu từ nút bấm
        const id = $(this).data('id');
        const username = $(this).data('username');
        const name = $(this).data('name');

        // Điền vào form
        $('#edit_user_id').val(id);
        $('#edit_username').val(username);
        $('#edit_name').val(name);
        $('#edit_password').val(''); // Luôn xóa trắng mật khẩu

        clearErrors();
        
        // Mở Modal
        $('#editUserModal').modal('show');
    });

    // Xử lý Submit Form Sửa
    const editForm = document.getElementById('editUserForm');
    if (editForm) {
        editForm.addEventListener('submit', async function (e) {
            e.preventDefault();

            const id = document.getElementById('edit_user_id').value;
            if (!id) {
                handleError('Không tìm thấy ID tài khoản.');
                return;
            }

            // Setup nút bấm
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.textContent;
            setLoading(submitBtn, true);

            const url = `/api/users/${id}`;
            const formData = new FormData(this);
            formData.append('_method', 'PUT'); // Method spoofing cho Laravel

            clearErrors();

            try {
                const response = await fetch(url, {
                    method: 'POST', // Dùng POST để gửi FormData có _method: PUT
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': getCsrfToken()
                    },
                    body: formData
                });

                const data = await response.json();

                if (response.ok) {
                    handleSuccess('Cập nhật tài khoản thành công!');
                } else if (response.status === 422) {
                    handleValidationErrors(data.errors, 'edit');
                    setLoading(submitBtn, false, originalText);
                } else {
                    handleError(data.message || 'Cập nhật thất bại.');
                    setLoading(submitBtn, false, originalText);
                }
            } catch (err) {
                console.error(err);
                handleError('Lỗi kết nối server.');
                setLoading(submitBtn, false, originalText);
            }
        });
    }

    // ============================================================
    // 3. CÁC HÀM TIỆN ÍCH (HELPER FUNCTIONS)
    // ============================================================

    // Lấy CSRF Token
    function getCsrfToken() {
        return document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
    }

    // Xóa toàn bộ thông báo lỗi
    function clearErrors() {
        document.querySelectorAll('.error-message').forEach(el => el.textContent = '');
    }

    // Hiển thị trạng thái loading cho nút
    function setLoading(btn, isLoading, originalText = '') {
        if (!btn) return;
        if (isLoading) {
            btn.disabled = true;
            btn.textContent = 'Đang xử lý...';
        } else {
            btn.disabled = false;
            btn.textContent = originalText;
        }
    }

    // Hiển thị lỗi Validation (422)
    function handleValidationErrors(errors, prefix) {
        if (!errors) return;
        for (const [key, messages] of Object.entries(errors)) {
            // key: username -> id: error_add_username hoặc error_edit_username
            const errorElement = document.getElementById(`error_${prefix}_${key}`);
            if (errorElement) {
                errorElement.textContent = messages[0];
            }
        }
    }

    // Xử lý thành công
    function handleSuccess(message) {
        Swal.fire({
            icon: 'success',
            title: 'Thành công!',
            text: message,
            timer: 1500,
            showConfirmButton: false
        }).then(() => {
            location.reload(); // Load lại trang để cập nhật bảng Livewire
        });
    }

    // Xử lý lỗi chung
    function handleError(message) {
        Swal.fire({
            icon: 'error',
            title: 'Lỗi',
            text: message
        });
    }

    // Reset form khi đóng Modal (Bootstrap Events)
    $('#addUserModal, #editUserModal').on('hidden.bs.modal', function () {
        const form = this.querySelector('form');
        if (form) form.reset();
        clearErrors();
    });

});

// ============================================================
// 4. XỬ LÝ XÓA USER (Global Function)
// ============================================================
// Hàm này phải để ở scope global (window) vì nó được gọi từ onclick="" trong HTML

window.confirmDeleteUser = function (id) {
    Swal.fire({
        title: 'Xác nhận xóa?',
        text: "Bạn có chắc chắn muốn xóa tài khoản này? Hành động này không thể hoàn tác!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Xóa ngay',
        cancelButtonText: 'Hủy'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/api/users/${id}`, {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
                }
            })
            .then(res => res.json())
            .then(data => {
                // Kiểm tra cả 2 trường hợp success trả về từ API
                if (data.status === true || data.success === true) {
                    Swal.fire('Đã xóa!', 'Tài khoản đã được xóa thành công.', 'success')
                        .then(() => location.reload());
                } else {
                    Swal.fire('Lỗi!', data.message || 'Không thể xóa tài khoản.', 'error');
                }
            })
            .catch(err => {
                console.error(err);
                Swal.fire('Lỗi!', 'Không thể kết nối đến server.', 'error');
            });
        }
    });
};