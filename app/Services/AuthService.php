<?php

namespace App\Services;

use App\Interfaces\AuthServiceInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\AuthenticationException;

class AuthService implements AuthServiceInterface
{
    protected function guard()
    {
        return Auth::guard('api');
    }

    public function login(array $credentials): array
    {
        if (!$token = $this->guard()->attempt($credentials)) {
            throw new AuthenticationException('Tài khoản hoặc mật khẩu không chính xác.');
        }

        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60,
        ];
    }

    public function logout(): void
    {
        $this->guard()->logout();
    }

    public function user(): ?User
    {
        return $this->guard()->user();
    }
}
