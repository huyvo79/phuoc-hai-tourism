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

    public function getAllWithoutPagination()
    {
        return Post::with('category')->orderBy('created_at', 'desc')->get();
    }

    public function find($id)
    {
        return Post::with(['category', 'images', 'relatedPosts'])->find($id);
    }

    public function create(array $attributes)
    {
        $post = Post::create($attributes);

        if (isset($attributes['related_ids']) && !empty($attributes['related_ids'])) {
            $post->relatedPosts()->attach($attributes['related_ids']);
        }

        return $post;
    }

    public function update($id, array $attributes)
    {
        $post = Post::find($id);

        if ($post) {
            $post->update($attributes);

            if (isset($attributes['related_ids'])) {
                $post->relatedPosts()->sync($attributes['related_ids']);
            }

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

    public function search($keyword, $limit = 5)
    {
        return Post::where('title', 'LIKE', "%{$keyword}%")
            ->orWhere('summary', 'LIKE', "%{$keyword}%")
            ->select('id', 'title', 'slug', 'thumbnail', 'summary')
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    public function findBySlug(string $slug)
    {
        return Post::with(['category', 'relatedPosts'])
            ->where('slug', $slug)
            ->first();
    }

}