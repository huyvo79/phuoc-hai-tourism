<?php
namespace App\Repositories;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoryRepository implements CategoryRepositoryInterface{
    public function getAll()
    {
        return Category::all();
    }

    public function paginate(array $filter = [], int $perPage = 5): LengthAwarePaginator
    {
        $query = Category::query();

        // filter theo tên (ví dụ)
        if (!empty($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }

        // sort mới nhất
        $query->orderBy('id', 'desc');

        return $query->paginate($perPage);
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
