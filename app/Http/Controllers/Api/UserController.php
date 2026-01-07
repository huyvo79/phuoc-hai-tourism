<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Interfaces\UserServiceInterface;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(
        private UserServiceInterface $userService
    ) {
    }

    public function index(Request $request)
    {
        $filters = [
            'search' => $request->input('search'),
        ];

        // SỬA: Lấy tham số 'limit', nếu không có thì mặc định là 5
        // Ép kiểu (int) để đảm bảo an toàn
        $limit = (int) $request->input('limit', 5);

        // Gọi service với biến $limit vừa lấy được
        $users = $this->userService->getPaginatedUsers($filters, $limit);

        // Trả về collection (Laravel tự động bao gồm meta pagination)
        return UserResource::collection($users);
    }

    public function store(StoreUserRequest $request): JsonResponse
    {
        $user = $this->userService->createUser($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Tạo người dùng thành công',
            'data' => new UserResource($user)
        ], 201);
    }

    public function show(User $user): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => new UserResource($user)
        ]);
    }

    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        $user = $this->userService->updateUser($user, $request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Cập nhật thành công',
            'data' => new UserResource($user)
        ]);
    }

    public function destroy(User $user): JsonResponse
    {
        $this->userService->deleteUser($user);

        return response()->json([
            'success' => true,
            'message' => 'Đã xóa người dùng thành công'
        ]);
    }
}