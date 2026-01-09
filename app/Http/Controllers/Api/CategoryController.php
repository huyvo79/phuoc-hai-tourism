<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\CategoryServiceInterface;
use App\Models\Category;

class CategoryController extends Controller
{
    public function __construct(
        protected CategoryServiceInterface $categoryService
    ){}

    public function index(Request $request)
    {
        $request->validate([
            'page' => 'nullable|integer|min:1',
            'per_page' => 'nullable|integer|in:5,10,15,20',
        ]);

        $perPage = $request->get('per_page', 5);
        $search = $request->get('search');

        $query = Category::query();

        if ($search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('id', $search);
        }

        return response()->json(
            $query->orderBy('id', 'desc')->paginate($perPage)
        );
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
