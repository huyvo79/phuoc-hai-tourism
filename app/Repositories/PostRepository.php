<?php
namespace App\Repositories;

use App\Interfaces\PostRepositoryInterface; 
use App\Models\Post;

class PostRepository implements PostRepositoryInterface
{
    public function getAll()
    {
        return Post::with('category')->orderBy('created_at', 'desc')->paginate(10);
    }

    public function find($id)
    {
        return Post::with('category', 'images')->find($id); // Eager load luôn ảnh cho tiện
    }

    public function create(array $attributes)
    {
        return Post::create($attributes);
    }

    public function update($id, array $attributes)
    {
        $post = Post::find($id);
        if ($post) {
            $post->update($attributes);
            return $post;
        }
        return null;
    }

    public function delete($id)
    {
        $post = Post::find($id);
        if ($post) {
            return $post->delete();
        }
        return false;
    }
}