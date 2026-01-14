<?php
namespace App\Interfaces;

use App\Models\Category;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface CategoryServiceInterface {
    public function getCategories();
    public function getPaginatedCategories(array $filters = [], int $perPage = 5): LengthAwarePaginator;
    public function findCategoryById(int $id): ?Category;
    public function createCategory(array $data);
    public function updateCategoryById(int $id, array $data): bool;
    public function deleteCategoryById(int $id): bool;
}
