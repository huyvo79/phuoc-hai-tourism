<?php
namespace App\Repositories;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getAll()
    {
        return Category::all();
    }


    public function paginate(array $filters = [], int $perPage = 5)
    {
        return Category::query()
            // 1. Giữ điều kiện loại trừ ID = 1
            ->where('id', '!=', 1)

            // 2. Áp dụng tìm kiếm trực tiếp trong SQL (tương tự hàm User)
            ->when($filters['search'] ?? null, function ($query, $search) {
                $search = trim($search);
                // Lưu ý: Hầu hết các collation trong MySQL (như utf8_unicode_ci) 
                // đều tự động hỗ trợ tìm kiếm không dấu (gõ 'a' tìm được cả 'á').
                $query->where('name', 'LIKE', "%{$search}%");
            })

            // 3. Sắp xếp
            ->orderBy('id', 'desc')

            // 4. Phân trang trực tiếp từ Database
            ->paginate($perPage)
            ->withQueryString(); // Giữ lại các tham số trên URL (như ?search=...) khi chuyển trang
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

        if (!$category)
            return false;

        return $category->update($data);
    }

    public function delete(int $id): bool
    {
        $category = Category::find($id);

        if (!$category)
            return false;

        return $category->delete($id);
    }
}
