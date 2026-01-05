<?php
namespace App\Repositories;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface{
    public function getAllCategories()
    {
        return Category::all();
    }

    public function findCategoryById(int $id): ?Category
    {
        return Category::find($id);
    }

    public function createCategory(array $data)
    {
        return Category::create($data);
    }

    public function updateCategory(int $id, array $data): bool
    {
        $category = Category::find($id);

        if(!$category) return false;

        return Category::update($data);
    }

    public function deleteCategory(int $id): bool
    {
        $category = Category::find($id);

        if(!$category) return false;

        return Category::delete($id);
    }
}
