<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Interfaces\PostServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $postService;

    public function __construct(PostServiceInterface $postService)
    {
        $this->postService = $postService;
    }

    public function index(): JsonResponse
    {
        $posts = $this->postService->getAllPosts();
        return response()->json($posts);
    }

    public function indexWithoutPagination(): JsonResponse
    {
        $posts = $this->postService->getAllPostsWithoutPagination();
        return response()->json($posts);
    }

    public function store(StorePostRequest $request): JsonResponse
    {
        // Lấy dữ liệu đã validate từ Request
        $data = $request->validated();

        // Gọi Service để xử lý logic (tách ảnh, lưu db...)
        $post = $this->postService->createPost($data);

        return response()->json([
            'message' => 'Tạo bài viết thành công',
            'data' => $post
        ], 201);
    }

    public function show($id): JsonResponse
    {
        $post = $this->postService->getPostById($id);

        if (!$post) {
            return response()->json(['message' => 'Không tìm thấy bài viết'], 404);
        }

        return response()->json($post);
    }


    public function update(UpdatePostRequest $request, $id): JsonResponse
    {
        $data = $request->validated();

        $post = $this->postService->updatePost($id, $data);

        if (!$post) {
            return response()->json(['message' => 'Không tìm thấy bài viết hoặc cập nhật lỗi'], 404);
        }

        return response()->json([
            'message' => 'Cập nhật thành công',
            'data' => $post
        ]);
    }

    public function destroy($id): JsonResponse
    {
        $deleted = $this->postService->deletePost($id);

        if (!$deleted) {
            return response()->json(['message' => 'Không tìm thấy bài viết để xóa'], 404);
        }

        return response()->json(['message' => 'Xóa bài viết thành công']);
    }

    public function search(Request $request): JsonResponse
    {
        $keyword = $request->query('q');

        if (!$keyword || strlen(trim($keyword)) < 2) {
            return response()->json([]); // Không tìm nếu từ khóa quá ngắn
        }

        $posts = $this->postService->searchPosts($keyword);

        return response()->json($posts);
    }
}