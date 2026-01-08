<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class EmergencyController extends Controller
{
    public function resetAdmin(Request $request)
    {
        // Kiểm tra Key (Giữ nguyên logic của bạn)
        $secretKey = env('ADMIN_RESET_SECRET', 'phuochai'); 
        if (!$secretKey || $request->query('key') !== $secretKey) {
            abort(403, 'Truy cập trái phép!');
        }

        // Tìm và Reset mật khẩu
        $admin = User::where('username', 'admin')->first();
        if (!$admin) {
             return response()->json(['message' => 'Không tìm thấy admin'], 404);
        }

        $defaultPass = '123456'; 
        $admin->password = Hash::make($defaultPass);
        $admin->save();

        // Truyền biến $defaultPass sang view với tên là 'newPass'
        return view('admin.emergency.success', [
            'newPass' => $defaultPass
        ]);
    }
}