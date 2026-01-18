<?php

namespace App\Http\Controllers;

use App\Models\PostImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostImageController extends Controller
{
    public function index()
    {
        $limit = request('limit', 10);
        $search = request('search');

        $query = PostImage::with('post');

        if ($search) {
            $query->whereHas('post', function($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%');
            });
        }

        $postImages = $query->paginate($limit)->appends(request()->query());
        return view('post_images.index', compact('postImages'));
    }

    public function create()
    {
        $posts = \App\Models\Post::all();
        return view('post_images.create', compact('posts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'post_id.required' => 'Vui lòng chọn bài viết.',
            'post_id.exists' => 'Bài viết không tồn tại.',
            'image.required' => 'Vui lòng chọn hình ảnh.',
            'image.image' => 'File phải là hình ảnh.',
            'image.mimes' => 'Hình ảnh phải có định dạng jpeg, png, jpg, hoặc gif.',
            'image.max' => 'Hình ảnh không được vượt quá 2MB.',
        ]);

        $imagePath = $request->file('image')->store('post_images', 'public');

        PostImage::create([
            'post_id' => $request->post_id,
            'image' => $imagePath,
        ]);

        return redirect()->route('post-images.index')->with('success', 'Hình ảnh bài viết đã được tạo thành công.');
    }

    public function show(PostImage $postImage)
    {
        return view('post_images.show', compact('postImage'));
    }

    public function edit(PostImage $postImage)
    {
        $posts = \App\Models\Post::all();
        return view('post_images.edit', compact('postImage', 'posts'));
    }

    public function update(Request $request, PostImage $postImage)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'post_id.required' => 'Vui lòng chọn bài viết.',
            'post_id.exists' => 'Bài viết không tồn tại.',
            'image.image' => 'File phải là hình ảnh.',
            'image.mimes' => 'Hình ảnh phải có định dạng jpeg, png, jpg, hoặc gif.',
            'image.max' => 'Hình ảnh không được vượt quá 2MB.',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            Storage::disk('public')->delete($postImage->image);
            $imagePath = $request->file('image')->store('post_images', 'public');
            $postImage->image = $imagePath;
        }

        $postImage->post_id = $request->post_id;
        $postImage->save();

        return redirect()->route('post-images.index')->with('success', 'Hình ảnh bài viết đã được cập nhật thành công.');
    }

    public function destroy(PostImage $postImage)
    {
        Storage::disk('public')->delete($postImage->image);
        $postImage->delete();

        return redirect()->route('post-images.index')->with('success', 'Hình ảnh bài viết đã được xóa thành công.');
    }
}