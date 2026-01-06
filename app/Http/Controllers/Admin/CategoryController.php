<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\CategoryServiceInterface;

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
}
