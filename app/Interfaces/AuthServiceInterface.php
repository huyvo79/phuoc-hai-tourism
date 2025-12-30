<?php

namespace App\Interfaces;

interface AuthServiceInterface
{
    public function login(array $credentials): array;
    public function logout(): void;
}
