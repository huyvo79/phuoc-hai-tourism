<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\PostService;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index()
    {
        $posts = $this->postService->getAllPosts();
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(StorePostRequest $request)
    {
        $this->postService->createPost($request->validated());
        return redirect()->route('posts.index')->with('success', 'Thêm bài viết thành công!');
    }

    public function edit($id)
    {
        $post = $this->postService->getPostById($id);

        if (!$post) {
            return redirect()->route('posts.index')->with('error', 'Không tìm thấy bài viết!');
        }

        return view('admin.posts.edit', compact('post'));
    }

    public function update(UpdatePostRequest $request, $id)
    {
        $result = $this->postService->updatePost($id, $request->validated());

        if (!$result) {
            return back()->with('error', 'Cập nhật thất bại!');
        }

        return redirect()->route('posts.index')->with('success', 'Cập nhật bài viết thành công!');
    }

    public function destroy($id)
    {
        $this->postService->deletePost($id);
        return redirect()->route('posts.index')->with('success', 'Đã xóa bài viết!');
    }
}