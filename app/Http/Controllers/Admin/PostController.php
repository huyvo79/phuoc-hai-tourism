<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\PostService;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $limit = $request->input('limit', 10);

        $query = Post::with('category')
            ->when($search, function ($q) use ($search) {
                return $q->where(function ($subQuery) use ($search) {
                    $subQuery->where('title', 'LIKE', "%{$search}%")
                        ->orWhere('slug', 'LIKE', "%{$search}%")
                        ->orWhere('summary', 'LIKE', "%{$search}%");
                });
            })
            ->orderBy('priority', 'desc')
            ->orderBy('created_at', 'desc');

        $posts = $query->paginate($limit);

        if ($request->wantsJson()) {
            return response()->json($posts);
        }

        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $allPosts = Post::select('id', 'title')->get();
        $categories = Category::all();
        
        return view('admin.posts.create', compact('allPosts', 'categories'));
    }

    public function store(StorePostRequest $request)
    {
        $this->postService->createPost($request->validated());
        return redirect()->route('posts.index')->with('success', 'Thêm bài viết thành công!');
    }

    public function edit($id)
    {
        $post = Post::with('relatedPosts')->find($id);

        if (!$post) {
            return redirect()->route('posts.index')->with('error', 'Không tìm thấy bài viết!');
        }

        $allPosts = Post::select('id', 'title')->where('id', '!=', $id)->get();
        $categories = Category::all();

        return view('admin.posts.edit', compact('post', 'allPosts', 'categories'));
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