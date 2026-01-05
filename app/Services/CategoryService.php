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
        return $this->categoryRepository->getAll();
    }

    public function findCategoryById(int $id): ?Category
    {
        return $this->categoryRepository->find($id);
    }

    public function createCategory(array $data)
    {
        return $this->categoryRepository->create($data);
    }

    public function updateCategoryById(int $id, array $data): bool
    {
        return $this->categoryRepository->update($id, $data);
    }

    public function deleteCategoryById(int $id): bool
    {
        return $this->categoryRepository->delete($id);
    }
}
