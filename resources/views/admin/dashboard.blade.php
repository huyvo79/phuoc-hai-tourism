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

    <style>
        body { font-family: sans-serif; background: #f5f7fa; }
        .sidebar { min-height: 100vh; background: #343a40; color: #fff; padding-top: 20px; }
        .sidebar a { color: #adb5bd; text-decoration: none; display: block; padding: 10px 20px; }
        .sidebar a:hover { color: #fff; background: #495057; }
        .sidebar i { margin-right: 10px; width: 20px; text-align: center; }
        .sidebar-avatar { padding: 20px; text-align: center; border-top: 1px solid #4b545c; margin-top: 20px; }
        .user-avatar img { width: 60px; height: 60px; border-radius: 50%; object-fit: cover; border: 2px solid #6c757d; }
        .user-info { margin-top: 10px; }
        .user-name { display: block; font-weight: bold; color: #fff; }
        .user-role { display: block; font-size: 0.8em; color: #adb5bd; }
        body { display: none; } 
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 sidebar p-0">
                <div class="sidebar-brand text-center py-4">
                    <h4 class="text-white font-weight-bold mb-0">PHƯỚC HẢI</h4>
                    <small class="text-muted">TRAVEL ADMIN</small>
                </div>
                <hr style="border-color: #4b545c; margin-top: 0;">

                <ul class="list-unstyled">
                    <li><a href="#" class="text-white"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                    <li><a href="#"><i class="fas fa-layer-group"></i> Quản lý Danh mục</a></li>
                    <li><a href="#"><i class="fas fa-map-marked-alt"></i> Địa điểm / Bài viết</a></li>
                    
                    <hr style="border-color: #4b545c; margin: 10px 15px;">
                    
                    <li>
                        <a href="#" id="logoutBtn" class="text-danger">
                            <i class="fa fa-sign-out-alt"></i> Đăng xuất
                        </a>
                    </li>
                </ul>

                <div class="sidebar-avatar">
                    <div class="user-avatar">
                        <img id="userAvatar" src="" alt="Avatar">
                    </div>
                    <div class="user-info">
                        <span id="sidebarUserName" class="user-name">Đang tải...</span>
                        <span id="sidebarUserRole" class="user-role">...</span>
                    </div>
                </div>
            </div>

            <div class="col-md-10 bg-white p-4">
                <h2 class="border-bottom pb-2 mb-3">Tổng quan</h2>
                
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Xin chào, <span id="welcomeName" class="text-primary font-weight-bold">...</span>!</h5>
                        <hr>
                        <p><strong>Thông tin Token:</strong></p>
                        <ul class="text-muted">
                            <li><strong>Username:</strong> <span id="infoUsername"></span></li>
                            <li><strong>Ngày tham gia:</strong> <span id="infoJoined"></span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Script Xử lý Logic --}}
    <script>
        const token = localStorage.getItem('admin_token');
        if (!token) {
            window.location.href = '/admin/login';
        } else {
            document.body.style.display = 'block'; 
            loadUserProfile();
        }

        // 2. Hàm gọi API lấy thông tin User
        async function loadUserProfile() {
            try {
                // Gọi API profile mà ta đã khai báo trong api.php
                const response = await fetch('/api/admin/profile', {
                    method: 'GET',
                    headers: {
                        'Authorization': `Bearer ${token}`, 
                        'Accept': 'application/json'
                    }
                });

                if (response.status === 401) {
                    logout(); 
                    return;
                }

                const user = await response.json();

                document.getElementById('sidebarUserName').innerText = user.name;
                document.getElementById('sidebarUserRole').innerText = '@' + user.username;
                document.getElementById('welcomeName').innerText = user.name;
                document.getElementById('infoUsername').innerText = user.username;
                document.getElementById('infoJoined').innerText = new Date(user.created_at).toLocaleDateString('vi-VN');
                
                document.getElementById('userAvatar').src = `https://ui-avatars.com/api/?name=${encodeURIComponent(user.name)}&background=random`;

            } catch (error) {
                console.error('Lỗi tải profile:', error);
            }
        }

        document.getElementById('logoutBtn').addEventListener('click', async function(e) {
            e.preventDefault();
            await logout();
        });

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