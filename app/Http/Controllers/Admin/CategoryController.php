<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\CategoryServiceInterface;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function __construct(
        protected CategoryServiceInterface $categoryService
    ){}

    public function index(Request $request)
    {
        // $categories = $this->categoryService->getCategories();
        //paginate
        $perPage = (int) $request->get('per_page', 5);
        $categories = $this->categoryService->getPaginatedCategories(
            $request->only(['search']),
            $perPage
        );
        // ⬇⬇⬇ ĐIỂM KHÁC BIỆT QUAN TRỌNG
        return view('admin.category.indexCategory', compact('categories', 'perPage'));
    }

    public function create()
    {
        return view('admin.category.createCategory');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $this->categoryService->createCategory([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('category.list')
            ->with('success', 'Thêm danh mục thành công');
    }


    public function edit($id)
    {
        $category = $this->categoryService->findCategoryById($id);
        abort_if(!$category, 404);

        return view('admin.category.editCategory', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $updated = $this->categoryService->updateCategoryById($id, [
            'name' => $request->name,
        ]);

        if (!$updated) {
            return redirect()->back()->with('error', 'Danh mục không tồn tại');
        }

        return redirect()
            ->route('category.list')
            ->with('success', 'Cập nhật danh mục thành công');
    }

    public function destroy($id)
    {
        $deleted = $this->categoryService->deleteCategoryById($id);

        if (!$deleted) {
            return redirect()->back()->with('error', 'Danh mục không tồn tại');
        }

        return redirect()
            ->route('category.list')
            ->with('success', 'Xóa danh mục thành công');
    }
}
