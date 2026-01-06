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

    public function index()
    {
        $categories = $this->categoryService->getCategories();

        // ⬇⬇⬇ ĐIỂM KHÁC BIỆT QUAN TRỌNG
        return view('admin.category.indexCategory', compact('categories'));
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

        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ];

        $this->categoryService->createCategory($data);

        return redirect()
            ->route('category.list')
            ->with('success', 'Thêm danh mục thành công');
    }
}
