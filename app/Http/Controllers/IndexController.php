<?php

namespace App\Http\Controllers;

use App\Interfaces\CategoryServiceInterface;
use Illuminate\Http\Request;
use App\Services\PostService;
use Illuminate\Http\JsonResponse;

class IndexController extends Controller
{
   protected $postService;
   protected $categoryService;
   /**
    * Inject PostService vào Controller
    */
   public function __construct(PostService $postService, CategoryServiceInterface $categoryService)
   {
      $this->postService = $postService;
      $this->categoryService = $categoryService;
   }

   public function index()
   {
      return view('ui-index.index');
   }
   public function single()
   {
      return view('ui-single.single');
   }
   public function archive()
   {
      return view('ui-archive.archive');
   }
   /**
    * Lấy danh sách bài viết không phân trang
    */
   public function indexWithoutPagination(): JsonResponse
   {
      $posts = $this->postService->getAllPostsWithoutPagination();

      return response()->json($posts);
   }

   /**
    * Tìm kiếm bài viết theo từ khóa
    */
   public function search(Request $request): JsonResponse
   {
      $keyword = $request->query('q');

      // Validate: Không tìm nếu từ khóa rỗng hoặc ngắn hơn 2 ký tự
      if (!$keyword || strlen(trim($keyword)) < 2) {
         return response()->json([]);
      }

      $posts = $this->postService->searchPosts($keyword);

      return response()->json($posts);
   }

   public function indexCategories()
   {
      $categories = $this->categoryService->getCategories();
      return response()->json($categories);
   }
}