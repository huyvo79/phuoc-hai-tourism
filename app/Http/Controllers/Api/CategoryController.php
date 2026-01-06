<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Interfaces\CategoryServiceInterface;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function __construct(
        protected CategoryServiceInterface $categoryService
    ){}

    public function index()
    {
        $categories = $this->categoryService->getCategories();

        return response()->json($categories);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = $this->categoryService->createCategory($data);

        return response()->json([
            'success' => true,
            'message' => 'Category created',
            'data' => $category
        ], 201);
    }

    public function show($id)
    {
        $category = $this->categoryService->findCategoryById($id);
        abort_if(!$category, 404);

        return response()->json($category);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $categoryUpdated = $this->categoryService->updateCategoryById($id, $data);

        if (!$categoryUpdated) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Category updated',
            'data' => $categoryUpdated
        ]);
    }


    public function destroy($id)
    {
        $categoryDeleted = $this->categoryService->deleteCategoryById($id);

        if(!$categoryDeleted) return response()->json([
            'success' => false,
            'message' => 'Category not found'
        ], 404);

        return response()->json([
            'success' => true,
            'message' => 'Category deleted',
        ]);
    }
}
