<?php
namespace App\Services;

use App\Interfaces\CategoryServiceInterface;
use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
use App\Repositories\CategoryRepository;

class CategoryService implements CategoryServiceInterface{
    public function __construct(
        protected CategoryRepositoryInterface $categoryRepository
    ){}

    public function getCategories()
    {
        throw new \Exception('Not implemented');
    }

    public function findCategoryById(int $id): ?Category
    {
        throw new \Exception('Not implemented');
    }

    public function createCategory(array $data)
    {
        throw new \Exception('Not implemented');
    }

    public function updateCategoryById(int $id, array $data): bool
    {
        throw new \Exception('Not implemented');
    }

    public function deleteCategoryById(int $id): bool
    {
        throw new \Exception('Not implemented');
    }
}
