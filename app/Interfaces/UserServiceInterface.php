<?php

namespace App\Interfaces;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserServiceInterface
{
    public function getPaginatedUsers(array $filters = [], int $perPage = 5);
    public function getUserById(int $id): ?User;
    public function createUser(array $data): User;
    public function updateUser(User $user, array $data): User;
    public function deleteUser(User $user): bool;
}
