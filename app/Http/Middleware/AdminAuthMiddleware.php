<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AdminAuthMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->cookie('token');

        if (!$token) {
            return redirect()->route('admin.login');
        }

        try {
            JWTAuth::setToken($token);
            $user = JWTAuth::authenticate();

            if (!$user) {
                return redirect()->route('admin.login')
                    ->withCookie(cookie()->forget('token'));
            }

            $newToken = JWTAuth::refresh($token);
            $ttl = config('jwt.ttl', 30);

            $response = $next($request);

            return $response->withCookie(cookie(
                'token',
                $newToken,
                $ttl,
                '/',
                null,
                config('app.env') === 'production',
                true,
                false,
                'Lax'
            ));

        } catch (JWTException $e) {
            return redirect()->route('admin.login')
                ->withCookie(cookie()->forget('token'));
        }
    }
}
