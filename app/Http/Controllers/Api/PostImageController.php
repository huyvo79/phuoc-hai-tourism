<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PostImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostImageController extends Controller
{
    public function index()
    {
        $postImages = PostImage::with('post')->paginate(10);
        return response()->json($postImages);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
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

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $imagePath = $request->file('image')->store('post_images', 'public');

        $postImage = PostImage::create([
            'post_id' => $request->post_id,
            'image' => $imagePath,
        ]);

        return response()->json($postImage->load('post'), 201);
    }

    public function show(PostImage $postImage)
    {
        return response()->json($postImage->load('post'));
    }

    public function update(Request $request, PostImage $postImage)
    {
        $validator = Validator::make($request->all(), [
            'post_id' => 'required|exists:posts,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'post_id.required' => 'Vui lòng chọn bài viết.',
            'post_id.exists' => 'Bài viết không tồn tại.',
            'image.image' => 'File phải là hình ảnh.',
            'image.mimes' => 'Hình ảnh phải có định dạng jpeg, png, jpg, hoặc gif.',
            'image.max' => 'Hình ảnh không được vượt quá 2MB.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($postImage->image);
            $imagePath = $request->file('image')->store('post_images', 'public');
            $postImage->image = $imagePath;
        }

        $postImage->post_id = $request->post_id;
        $postImage->save();

        return response()->json($postImage->load('post'));
    }

    public function destroy(PostImage $postImage)
    {
        Storage::disk('public')->delete($postImage->image);
        $postImage->delete();

        return response()->json(['message' => 'Hình ảnh bài viết đã được xóa thành công.']);
    }
}