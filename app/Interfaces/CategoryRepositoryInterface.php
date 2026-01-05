<?php

namespace App\Interfaces;

use App\Models\Category;

interface CategoryRepositoryInterface
{
    public function getAllCategories();
    public function findCategoryById(int $id): ?Category;
    public function createCategory(array $data);
    public function updateCategory(int $id, array $data): bool;
    public function deleteCategory(int $id): bool;
}
