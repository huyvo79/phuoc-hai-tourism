<?php
namespace App\Repositories;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class CategoryRepository implements CategoryRepositoryInterface{
    public function getAll()
    {
        return Category::all();
    }


    public function paginate(array $filters = [], int $perPage = 5)
    {
        $query = Category::where('id', '!=', 1)
            ->orderBy('id', 'desc');

        $categories = $query->get();

        if (!empty($filters['search'])) {

            $searchRaw = mb_strtolower(trim($filters['search']), 'UTF-8');
            $searchAscii = Str::ascii($searchRaw);
            $hasAccent   = $searchRaw !== $searchAscii;

            $categories = $categories->filter(function ($item) use ($searchRaw, $searchAscii, $hasAccent) {

                $nameRaw   = mb_strtolower($item->name, 'UTF-8');
                $nameAscii = Str::ascii($nameRaw);

                // ✅ nếu user gõ CÓ DẤU → chỉ match raw
                if ($hasAccent) {
                    return str_contains($nameRaw, $searchRaw);
                }

                // ✅ nếu user gõ KHÔNG DẤU → match cả 2
                return str_contains($nameRaw, $searchRaw)
                    || str_contains($nameAscii, $searchAscii);
            });
        }


        // paginate collection thủ công
        $page = request('page', 1);
        $total = $categories->count();

        $items = $categories
            ->slice(($page - 1) * $perPage, $perPage)
            ->values();

        return new \Illuminate\Pagination\LengthAwarePaginator(
            $items,
            $total,
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );
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
