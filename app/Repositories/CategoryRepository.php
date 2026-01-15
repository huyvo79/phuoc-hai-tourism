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

    public function paginate(array $filters = [], int $perPage = 5): LengthAwarePaginator
    {
        $query = Category::where('id', '!=', 1);

         // 🔍 SEARCH: theo ID hoặc Name
        if (!empty($filters['search'])) {
            $search = trim($filters['search']);

            $query->where(function ($q) use ($search) {

                // Nếu là số → tìm theo ID
                if (is_numeric($search)) {
                    $q->where('id', $search);
                }

                // Luôn tìm theo name
                $q->orWhere('name', 'like', '%' . $search . '%');
            });
        }

        return $query
            ->orderBy('id', 'desc')
            ->paginate($perPage)
            ->withQueryString(); // ⭐ giữ search + per_page khi chuyển trang
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
