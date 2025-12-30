<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\AuthServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Exception;

class AuthController extends Controller
{
    private AuthServiceInterface $authService;

    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    public function login(Request $request): JsonResponse
    {
        $credentials = $request->only('username', 'password');

        try {
            $data = $this->authService->login($credentials);
            $cookie = cookie(
                'token',
                $data['access_token'],
                $data['expires_in'] / 60, // minutes
                '/',
                null,
                env('APP_ENV') === 'production',
                true, // httpOnly
                false,
                'Lax'
            );

            return response()->json($data)->withCookie($cookie);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode() ?: 401);
        }
    }

    public function logout(): JsonResponse
    {
        $this->authService->logout();
        $cookie = cookie()->forget('token');
        return response()->json(['message' => 'Successfully logged out'])->withCookie($cookie);
    }
}
