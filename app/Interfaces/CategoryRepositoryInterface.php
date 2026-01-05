<?php

namespace App\Interfaces;

use App\Models\Category;

interface CategoryRepositoryInterface
{
    public function getAll();
    public function find(int $id): ?Category;
    public function create(array $data);
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
}
