<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * GET: Lấy danh sách users
     */
    public function index(): JsonResponse
    {
        // Sử dụng UserResource::collection để format cả danh sách
        return response()->json([
            'status'  => true,
            'message' => 'Lấy danh sách người dùng thành công',
            'data'    => UserResource::collection(User::all())
        ], 200);
    }

    /**
     * POST: Tạo user mới
     * Sử dụng StoreUserRequest để validate tự động
     */
    public function store(StoreUserRequest $request): JsonResponse
    {
        // Lấy dữ liệu đã validate
        $validated = $request->validated();
        
        // Nếu Model chưa có cast 'password' => 'hashed', cần hash thủ công:
        // $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        return response()->json([
            'status'  => true,
            'message' => 'Tạo người dùng thành công',
            'data'    => new UserResource($user)
        ], 201);
    }

    /**
     * GET: Xem chi tiết
     * Sử dụng Route Model Binding (User $user) thay vì $id
     */
    public function show(User $user): JsonResponse
    {
        // Nếu không tìm thấy, Laravel tự động trả về 404 (ModelNotFoundException)
        // Nên bạn không cần check if (!$user) thủ công nữa.
        
        return response()->json([
            'status' => true,
            'data'   => new UserResource($user)
        ], 200);
    }

    /**
     * PUT/PATCH: Cập nhật
     */
    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        $validated = $request->validated();

        // Xử lý riêng password nếu có gửi lên (nếu Model chưa cast hashed)
        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }

        $user->update($validated);

        return response()->json([
            'status'  => true,
            'message' => 'Cập nhật thành công',
            'data'    => new UserResource($user)
        ], 200);
    }

    /**
     * DELETE: Xóa user
     */
    public function destroy(User $user): JsonResponse
    {
        $user->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Đã xóa người dùng thành công'
        ], 200);
    }
}