<?php
namespace App\Interfaces;

use App\Models\Category;

interface CategoryServiceInterface {
    public function getCategories();
    public function findCategoryById(int $id): ?Category;
    public function createCategory(array $data);
    public function updateCategoryById(int $id, array $data): bool;
    public function deleteCategoryById(int $id): bool;
}
