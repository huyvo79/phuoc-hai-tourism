<?php
namespace App\Repositories;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface{
    public function getAll()
    {
        return Category::all();
    }

    public function find(int $id): ?Category
    {
        return Category::find($id);
    }

    public function create(array $data)
    {
        return Category::create($data);
    }

    public function update(int $id, array $data): bool
    {
        $category = Category::find($id);

        if(!$category) return false;

        return $category->update($data);
    }

    public function delete(int $id): bool
    {
        $category = Category::find($id);

        if(!$category) return false;

        return $category->delete($id);
    }
}
