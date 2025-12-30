<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Phước Hải</title>

    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
    <link rel="shortcut icon" href="/favicon.ico" />

    {{-- Bootstrap & Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    {{-- CSS Livewire (Nên đặt ở head) --}}
    @livewireStyles

    <style>
        /* Ẩn body mặc định để tránh nháy giao diện khi chưa check token */
        body {
            display: none;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            {{-- SIDEBAR --}}
            <div class="col-md-2 sidebar p-0 bg-dark" style="min-height: 100vh;">
                <div class="sidebar-brand text-center py-4">
                    <h4 class="text-white font-weight-bold mb-0">PHƯỚC HẢI</h4>
                    <small class="text-muted">TRAVEL ADMIN</small>
                </div>
                <hr style="border-color: #4b545c; margin-top: 0;">

                <ul class="list-unstyled">
                    <li><a href="#" class="text-white d-block p-3"><i class="fas fa-tachometer-alt mr-2"></i>
                            Dashboard</a></li>
                    <li><a href="#" class="text-white d-block p-3"><i class="fas fa-layer-group mr-2"></i> Quản lý Danh
                            mục</a></li>
                    <li><a href="#" class="text-white d-block p-3"><i class="fas fa-map-marked-alt mr-2"></i> Địa điểm /
                            Bài viết</a></li>

                    <hr style="border-color: #4b545c; margin: 10px 15px;">

                    <li>
                        <a href="#" class="text-white d-block p-3">
                            <i class="fas fa-users-cog mr-2"></i> Tài khoản Admin
                        </a>
                    </li>

                    <li>
                        {{-- SỬA LỖI: Đóng thẻ a và li đúng cách --}}
                        <a href="#" id="logoutBtn" class="text-danger d-block p-3">
                            <i class="fa fa-sign-out-alt mr-2"></i> Đăng xuất
                        </a>
                    </li>
                </ul>

                <div class="sidebar-avatar p-3 text-center text-white">
                    <div class="user-avatar mb-2">
                        <img id="userAvatar" src="" alt="Avatar" class="rounded-circle" width="50">
                    </div>
                    <div class="user-info">
                        <span id="sidebarUserName" class="user-name d-block font-weight-bold">Đang tải...</span>
                        <small id="sidebarUserRole" class="user-role text-muted">...</small>
                    </div>
                </div>
            </div>

            {{-- MAIN CONTENT (Thêm phần này để hiển thị nội dung bên phải sidebar) --}}
            <div class="col-md-10 bg-light">
                <div class="p-4">
                    <h3>Xin chào, <span id="welcomeName">User</span></h3>
                    <p>Username: <span id="infoUsername">...</span></p>
                    <p>Ngày tham gia: <span id="infoJoined">...</span></p>
                </div>
            </div>
        </div>
    </div>

    {{-- 1. Thư viện JS (Đặt trước script logic) --}}
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- 2. Script của Livewire (Đặt độc lập) --}}
    @livewireScripts

    {{-- 3. Script Logic Tùy chỉnh --}}
    <script>
        // Kiểm tra Token ngay lập tức
        const token = localStorage.getItem('admin_token');
        if (!token) {
            window.location.href = '/admin/login';
        } else {
            // Nếu có token mới hiện body và load dữ liệu
            document.body.style.display = 'block';

            // Chờ DOM load xong mới chạy logic gán HTML
            document.addEventListener('DOMContentLoaded', function () {
                loadUserProfile();
            });
        }

        // Hàm gọi API lấy thông tin User
        async function loadUserProfile() {
            try {
                const response = await fetch('/api/admin/profile', {
                    method: 'GET',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json'
                    }
                });

                if (response.status === 401) {
                    logout(); // Token hết hạn hoặc không hợp lệ
                    return;
                }

                const user = await response.json();

                // Gán dữ liệu vào Sidebar
                const elName = document.getElementById('sidebarUserName');
                const elRole = document.getElementById('sidebarUserRole');
                const elAvatar = document.getElementById('userAvatar');

                if (elName) elName.innerText = user.name;
                if (elRole) elRole.innerText = '@' + user.username;
                if (elAvatar) elAvatar.src = `https://ui-avatars.com/api/?name=${encodeURIComponent(user.name)}&background=random`;

                // Gán dữ liệu vào Main Content (Kiểm tra xem phần tử có tồn tại không để tránh lỗi)
                const elWelcome = document.getElementById('welcomeName');
                const elInfoUser = document.getElementById('infoUsername');
                const elInfoJoined = document.getElementById('infoJoined');

                if (elWelcome) elWelcome.innerText = user.name;
                if (elInfoUser) elInfoUser.innerText = user.username;
                if (elInfoJoined) elInfoJoined.innerText = new Date(user.created_at).toLocaleDateString('vi-VN');

            } catch (error) {
                console.error('Lỗi tải profile:', error);
            }
        }

        // Sự kiện Đăng xuất
        const btnLogout = document.getElementById('logoutBtn');
        if (btnLogout) {
            btnLogout.addEventListener('click', async function (e) {
                e.preventDefault();
                await logout();
            });
        }

        async function logout() {
            try {
                await fetch('/api/admin/logout', {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json'
                    }
                });
            } catch (error) {
                console.log('Lỗi logout server, nhưng vẫn sẽ xóa local token');
            }

            localStorage.removeItem('admin_token');
            window.location.href = '/admin/login';
        }
    </script>
</body>

</html>