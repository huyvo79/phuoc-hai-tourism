<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập Admin - Phước Hải</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card shadow-sm" style="width: 400px;">
        <div class="card-header text-center bg-primary text-white">
            <h4>QUẢN TRỊ VIÊN</h4>
        </div>
        <div class="card-body">
            <div id="error-alert" class="alert alert-danger d-none"></div>

            <form id="loginForm">
                <div class="mb-3">
                    <label for="username" class="form-label">Tên đăng nhập</label>
                    <input type="text" class="form-control" id="username" required autofocus>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Mật khẩu</label>
                    <input type="password" class="form-control" id="password" required>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Đăng Nhập</button>
                </div>
            </form>
        </div>
        <div class="card-footer text-center text-muted">
            &copy; 2025 Website Du lịch Phước Hải
        </div>
    </div>
</div>

<script>
    document.getElementById('loginForm').addEventListener('submit', async function(e) {
        e.preventDefault(); // Chặn form load lại trang

        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;
        const errorAlert = document.getElementById('error-alert');

        // Reset thông báo lỗi
        errorAlert.classList.add('d-none');
        errorAlert.innerText = '';

        try {
            // 1. Gọi API Login
            const response = await fetch('/api/admin/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ username, password })
            });

            const data = await response.json();

            if (response.ok) {
                // 2. Đăng nhập thành công
                // Lưu Token vào localStorage để dùng cho các request sau
                localStorage.setItem('admin_token', data.data.access_token);
                
                // Chuyển hướng sang Dashboard
                window.location.href = '/admin/dashboard';
            } else {
                // 3. Đăng nhập thất bại -> Hiện lỗi
                errorAlert.innerText = data.message || 'Đăng nhập thất bại';
                errorAlert.classList.remove('d-none');
            }
        } catch (error) {
            console.error('Lỗi:', error);
            errorAlert.innerText = 'Có lỗi xảy ra, vui lòng thử lại.';
            errorAlert.classList.remove('d-none');
        }
    });
</script>

</body>
</html>