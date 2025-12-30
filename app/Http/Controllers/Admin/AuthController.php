<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('username', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'status' => false,
                'message' => 'Tài khoản hoặc mật khẩu không chính xác.',
            ], 401);  
        }

        $user = User::where('username', $request->username)->firstOrFail();

        $token = $user->createToken('admin-login')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Đăng nhập thành công!',
            'data' => [
                'user' => $user,       
                'access_token' => $token, 
                'token_type' => 'Bearer',
            ]
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => true,
            'message' => 'Đăng xuất thành công.'
        ]);
    }
}