<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Interfaces\AuthServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Auth\AuthenticationException;

class AuthController extends Controller
{
    public function __construct(
        private AuthServiceInterface $authService
    ) {}

    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $data = $this->authService->login($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Đăng nhập thành công!',
            ])->withCookie($this->createTokenCookie($data));
        } catch (AuthenticationException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 401);
        }
    }

    public function logout(): JsonResponse
    {
        $this->authService->logout();

        return response()->json([
            'success' => true,
            'message' => 'Đăng xuất thành công.',
        ])->withCookie(cookie()->forget('token'));
    }

    public function me(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $this->authService->user(),
        ]);
    }

    private function createTokenCookie(array $data): \Symfony\Component\HttpFoundation\Cookie
    {
        return cookie(
            'token',
            $data['access_token'],
            $data['expires_in'] / 60,
            '/',
            null,
            config('app.env') === 'production',
            true,
            false,
            'Lax'
        );
    }
}
