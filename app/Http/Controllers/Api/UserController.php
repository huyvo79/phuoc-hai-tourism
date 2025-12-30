<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * GET: Lấy danh sách toàn bộ users
     */
    public function index()
    {
        $users = User::select('id', 'username', 'name', 'created_at')->get(); // Không lấy password
        return response()->json([
            'status' => true,
            'message' => 'Lấy danh sách người dùng thành công',
            'data' => $users
        ], 200);
    }

    /**
     * POST: Tạo user mới
     */
    public function store(Request $request)
    {
        // 1. Validate dữ liệu
        $validator = validator($request->all(), [
            'username' => 'required|string|unique:users,username', // Username không được trùng
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Lỗi kiểm tra dữ liệu',
                'errors' => $validator->errors()
            ], 422);
        }

        // 2. Tạo user
        $user = User::create([
            'username' => $request->username,
            'name' => $request->name,
            'password' => Hash::make($request->password), // Mã hóa mật khẩu
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Tạo người dùng thành công',
            'data' => $user
        ], 201);
    }

    /**
     * GET: Xem chi tiết 1 user
     */
    public function show(string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy người dùng'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $user
        ], 200);
    }

    /**
     * PUT/PATCH: Cập nhật thông tin user
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['status' => false, 'message' => 'Không tìm thấy người dùng'], 404);
        }

        // Validate (chú ý unique username trừ id hiện tại ra)
        $validator = validator($request->all(), [
            'username' => ['sometimes', 'string', Rule::unique('users')->ignore($user->id)],
            'name' => 'sometimes|string|max:255',
            'password' => 'sometimes|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 422);
        }

        // Cập nhật dữ liệu
        if ($request->has('username')) $user->username = $request->username;
        if ($request->has('name')) $user->name = $request->name;
        if ($request->has('password')) $user->password = Hash::make($request->password);

        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'Cập nhật thành công',
            'data' => $user
        ], 200);
    }

    /**
     * DELETE: Xóa user
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['status' => false, 'message' => 'Không tìm thấy người dùng'], 404);
        }

        $user->delete();

        return response()->json([
            'status' => true,
            'message' => 'Đã xóa người dùng thành công'
        ], 200);
    }
}