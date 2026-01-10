document.addEventListener('DOMContentLoaded', async function () {
    const user = await Auth.getUser();
    if (user) {
        renderUserProfile(user);
        loadDashboardStats();
    }
});

function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
    return null;
}

function renderUserProfile(user) {
    const elements = {
        sidebarUserName: user.name,
        sidebarUserRole: '@' + user.username,
        welcomeName: user.name,
        infoUsername: user.username,
        infoJoined: new Date(user.created_at).toLocaleDateString('vi-VN')
    };

    Object.entries(elements).forEach(([id, value]) => {
        const el = document.getElementById(id);
        if (el) el.innerText = value;
    });

    const avatar = document.getElementById('userAvatar');
    if (avatar) {
        avatar.src = `https://ui-avatars.com/api/?name=${encodeURIComponent(user.name)}&background=8b5cf6&color=fff`;
    }
}

document.getElementById('logoutBtn')?.addEventListener('click', async function (e) {
    e.preventDefault();

    const result = await Swal.fire({
        title: 'Đăng xuất?',
        text: 'Bạn có chắc muốn đăng xuất khỏi hệ thống?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#8b5cf6',
        cancelButtonColor: '#64748b',
        confirmButtonText: 'Đăng xuất',
        cancelButtonText: 'Hủy',
        background: '#1e293b',
        color: '#fff'
    });

    if (result.isConfirmed) {
        await Auth.logout();
    }
});

async function loadDashboardStats() {
    try {
        const response = await fetch('/api/dashboard/stats', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            credentials: 'include'
        });

        const result = await response.json();

        if (result.success) {
            const data = result.data;

            // Update Visitors
            updateText('stats-visitor-count', formatNumber(data.visitors.total));
            updateText('stats-visitor-sub', data.visitors.growth_text);

            // Update Categories
            updateText('stats-category-count', data.categories.total);
            updateText('stats-category-sub', data.categories.sub_text);

            // BỎ PHẦN UPDATE LOCATION Ở ĐÂY

            // Update Posts
            updateText('stats-post-count', data.posts.total);
            updateText('stats-post-sub', data.posts.sub_text);

            // Update Admins
            updateText('stats-admin-count', data.admins.total);
            updateText('stats-admin-sub', data.admins.sub_text);
        }
    } catch (error) {
        console.error('Lỗi tải thống kê:', error);
    }
}

// Helper: Cập nhật text an toàn
function updateText(id, text) {
    const el = document.getElementById(id);
    if (el) el.innerText = text;
}

// Helper: Format số (ví dụ 12500 -> 12.5K)
function formatNumber(num) {
    if (num >= 1000000) return (num / 1000000).toFixed(1) + 'M';
    if (num >= 1000) return (num / 1000).toFixed(1) + 'K';
    return num;
}

document.addEventListener('DOMContentLoaded', function () {

    // --- Xử lý Thêm Danh Mục ---
    document.getElementById('btn-quick-category')?.addEventListener('click', async () => {
        await Swal.fire({
            title: 'Thêm danh mục mới',
            // 1. HTML tùy chỉnh có chỗ hiển thị lỗi (p#error-category-name)
            html: `
                <div class="text-left">
                    <label class="block text-sm font-medium text-gray-300 mb-1">Tên danh mục</label>
                    <input id="swal-category-name" class="swal2-input w-full m-0 bg-slate-700 text-white border-slate-600 focus:border-indigo-500" placeholder="Nhập tên danh mục...">
                    <p id="error-category-name" class="text-red-400 text-xs mt-1 h-4"></p>
                </div>
            `,
            focusConfirm: false,
            showCancelButton: true,
            confirmButtonText: 'Tạo ngay',
            cancelButtonText: 'Hủy',
            confirmButtonColor: '#db2777', // Màu hồng
            background: '#1e293b',
            color: '#fff',
            showLoaderOnConfirm: true,

            // 2. Xử lý Logic gọi API
            preConfirm: async () => {
                // Reset lỗi cũ
                const errEl = document.getElementById('error-category-name');
                const inputEl = document.getElementById('swal-category-name');
                if (errEl) errEl.innerText = '';
                if (inputEl) inputEl.classList.remove('swal2-inputerror');

                // Lấy dữ liệu
                const name = document.getElementById('swal-category-name').value;

                try {
                    // Gọi API
                    const response = await fetch('/api/categories', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        credentials: 'include',
                        body: JSON.stringify({ name: name })
                    });

                    const result = await response.json();

                    // Kiểm tra kết quả
                    if (!response.ok) {
                        // --- CÓ LỖI ---
                        if (result.errors && result.errors.name) {
                            // Hiển thị lỗi validation của trường 'name'
                            errEl.innerText = result.errors.name[0];
                            inputEl.classList.add('swal2-inputerror');
                        } else {
                            Swal.showValidationMessage(result.message || 'Có lỗi xảy ra');
                        }
                        return false; // Giữ Modal mở
                    }

                    // --- THÀNH CÔNG ---
                    return result;

                } catch (error) {
                    Swal.showValidationMessage(`Lỗi kết nối: ${error}`);
                    return false;
                }
            }
        }).then((result) => {
            // 3. Xử lý sau khi thành công
            if (result.isConfirmed) {
                Swal.fire({
                    icon: 'success',
                    title: 'Thành công',
                    text: 'Đã thêm danh mục mới!',
                    background: '#1e293b', color: '#fff',
                    confirmButtonColor: '#db2777'
                });

                // Reload thống kê
                if (typeof loadDashboardStats === 'function') loadDashboardStats();
            }
        });
    });

    // --- Xử lý Tạo Admin Mới ---
    document.getElementById('btn-quick-admin')?.addEventListener('click', async () => {
        await Swal.fire({
            title: 'Tạo Admin mới',
            // Custom HTML: Thêm các thẻ <p id="error-..."> để hứng lỗi
            html: `
                <div class="text-left space-y-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Tên đăng nhập</label>
                        <input id="swal-username" class="swal2-input w-full m-0 bg-slate-700 text-white border-slate-600 focus:border-indigo-500" placeholder="Ví dụ: admin123">
                        <p id="error-username" class="text-red-400 text-xs mt-1 h-4"></p>
                    </div>
                
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Họ và tên</label>
                        <input id="swal-name" class="swal2-input w-full m-0 bg-slate-700 text-white border-slate-600 focus:border-indigo-500" placeholder="Ví dụ: Nguyễn Văn A">
                        <p id="error-name" class="text-red-400 text-xs mt-1 h-4"></p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Mật khẩu</label>
                        <input id="swal-password" type="password" class="swal2-input w-full m-0 bg-slate-700 text-white border-slate-600 focus:border-indigo-500" placeholder="Nhập mật khẩu..">
                        <p id="error-password" class="text-red-400 text-xs mt-1 h-4"></p>
                    </div>
                </div>
            `,
            focusConfirm: false,
            showCancelButton: true,
            confirmButtonText: 'Tạo tài khoản',
            confirmButtonColor: '#4f46e5',
            cancelButtonText: 'Hủy',
            background: '#1e293b',
            color: '#fff',
            showLoaderOnConfirm: true, // Hiển thị vòng xoay loading khi đang gọi API

            // Xử lý Logic khi bấm nút "Tạo tài khoản"
            preConfirm: async () => {
                // 1. Reset các lỗi cũ trước khi gọi API
                ['name', 'username', 'password'].forEach(field => {
                    const errEl = document.getElementById(`error-${field}`);
                    const inputEl = document.getElementById(`swal-${field}`);
                    if (errEl) errEl.innerText = '';
                    if (inputEl) inputEl.classList.remove('swal2-inputerror');
                });

                // 2. Lấy dữ liệu
                const formData = {
                    name: document.getElementById('swal-name').value,
                    username: document.getElementById('swal-username').value,
                    password: document.getElementById('swal-password').value
                };

                try {
                    // 3. Gọi API (Fetch)
                    const response = await fetch('/api/users', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        credentials: 'include',
                        body: JSON.stringify(formData)
                    });

                    const result = await response.json();

                    // 4. Kiểm tra kết quả
                    if (!response.ok) {
                        // --- TRƯỜNG HỢP CÓ LỖI ---
                        if (result.errors) {
                            // Map lỗi từ Laravel vào từng dòng trong SweetAlert
                            Object.keys(result.errors).forEach(key => {
                                const errorEl = document.getElementById(`error-${key}`);
                                const inputEl = document.getElementById(`swal-${key}`);

                                if (errorEl) errorEl.innerText = result.errors[key][0]; // Hiện text lỗi
                                if (inputEl) inputEl.classList.add('swal2-inputerror'); // Viền đỏ input
                            });
                        } else {
                            // Lỗi chung chung (không phải validation)
                            Swal.showValidationMessage(result.message || 'Có lỗi xảy ra');
                        }
                        return false; // QUAN TRỌNG: Giữ Modal mở để user sửa lỗi
                    }

                    // --- TRƯỜNG HỢP THÀNH CÔNG ---
                    return result;

                } catch (error) {
                    Swal.showValidationMessage(`Lỗi kết nối: ${error}`);
                    return false;
                }
            }
        }).then((result) => {
            // Chỉ chạy vào đây khi API trả về thành công (response.ok)
            if (result.isConfirmed) {
                Swal.fire({
                    icon: 'success',
                    title: 'Thành công',
                    text: 'Đã tạo tài khoản Admin mới!',
                    background: '#1e293b', color: '#fff',
                    confirmButtonColor: '#4f46e5'
                });

                // Reload lại thống kê
                if (typeof loadDashboardStats === 'function') loadDashboardStats();
            }
        });
    });
});

// Hàm gọi API chung để tái sử dụng
async function callApi(url, method, data) {
    try {
        const response = await fetch(url, {
            method: method,
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            credentials: 'include', // Để gửi kèm Cookie Token
            body: JSON.stringify(data)
        });

        const result = await response.json();

        if (response.ok && (result.success || result.id)) { // Check success
            Swal.fire({
                icon: 'success',
                title: 'Thành công!',
                text: result.message || 'Thao tác đã được thực hiện.',
                background: '#1e293b', color: '#fff',
                confirmButtonColor: '#8b5cf6'
            }).then(() => {
                // Reload lại thống kê dashboard để cập nhật số liệu
                if (typeof loadDashboardStats === 'function') loadDashboardStats();
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Lỗi!',
                text: result.message || 'Có lỗi xảy ra, vui lòng thử lại.',
                background: '#1e293b', color: '#fff'
            });
        }
    } catch (error) {
        console.error('API Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Lỗi kết nối',
            text: 'Không thể kết nối đến máy chủ.',
            background: '#1e293b', color: '#fff'
        });
    }
}
