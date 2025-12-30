<?php

namespace App\Services;

use App\Interfaces\AuthServiceInterface;
use Illuminate\Support\Facades\Auth;
use Exception;

class AuthService implements AuthServiceInterface
{
    public function login(array $credentials): array
    {
        if (!$token = Auth::guard('api')->attempt($credentials)) {
            throw new Exception('Invalid credentials', 401);
        }

        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::guard('api')->factory()->getTTL() * 60
        ];
    }

    public function logout(): void
    {
        Auth::guard('api')->logout();
    }
}
