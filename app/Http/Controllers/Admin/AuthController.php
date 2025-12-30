<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // 1. Hiển thị form đăng nhập
    public function showLoginForm()
    {
        // Kiểm tra nếu đã đăng nhập rồi thì chuyển hướng vào trang admin luôn
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.auth.login');
    }

    // 2. Xử lý đăng nhập
    public function login(Request $request)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Lấy thông tin đăng nhập
        $credentials = $request->only('username', 'password');

        // Thực hiện xác thực (Auth::attempt tự động mã hóa password để so sánh)
        if (Auth::attempt($credentials)) {
            // Đăng nhập thành công -> tạo lại session để bảo mật
            $request->session()->regenerate();

            return redirect()->intended(route('admin.dashboard'))
                             ->with('success', 'Đăng nhập thành công!');
        }

        // Đăng nhập thất bại -> quay lại form và báo lỗi
        return back()->withErrors([
            'username' => 'Tên đăng nhập hoặc mật khẩu không chính xác.',
        ])->onlyInput('username');
    }

    // 3. Xử lý đăng xuất
    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}