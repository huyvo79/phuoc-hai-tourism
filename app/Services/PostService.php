<?php

namespace App\Services;

use App\Interfaces\PostServiceInterface;
use App\Interfaces\PostRepositoryInterface;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class PostService implements PostServiceInterface
{
    protected $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function getAllPosts()
    {
        return $this->postRepository->getAll();
    }

    public function getAllPostsWithoutPagination()
    {
        return $this->postRepository->getAllWithoutPagination();
    }

    public function getPostById($id)
    {
        return $this->postRepository->find($id);
    }

    public function createPost(array $data)
    {
        return DB::transaction(function () use ($data) {
            if (isset($data['title'])) {
                $data['slug'] = Str::slug($data['title']) . '-' . time();
            }

            if (empty($data['category_id'])) {
                $data['category_id'] = 1;
            }

            if (isset($data['thumbnail']) && $data['thumbnail'] instanceof UploadedFile) {
                $file = $data['thumbnail'];
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('uploads/thumbnails', $filename, 'public');
                $data['thumbnail'] = '/storage/' . $path;
            }

            if (isset($data['content'])) {
                $data['content'] = $this->processContentImages($data['content']);
            }

            $post = $this->postRepository->create($data);

            if (isset($data['related_ids'])) {
                $post->relatedPosts()->sync($data['related_ids']);
            }

            return $post;
        });
    }

    public function updatePost($id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $post = $this->postRepository->find($id);
            if (!$post) {
                return null;
            }

            if (array_key_exists('category_id', $data) && empty($data['category_id'])) {
                $data['category_id'] = 1;
            }

            if (isset($data['thumbnail']) && $data['thumbnail'] instanceof UploadedFile) {
                if ($post->thumbnail) {
                    $oldPath = str_replace('/storage/', '', $post->thumbnail);
                    if (Storage::disk('public')->exists($oldPath)) {
                        Storage::disk('public')->delete($oldPath);
                    }
                }

                $file = $data['thumbnail'];
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('uploads/thumbnails', $filename, 'public');
                $data['thumbnail'] = '/storage/' . $path;
            }

            if (isset($data['content'])) {
                $data['content'] = $this->processContentImages($data['content']);
            }

            $updatedPost = $this->postRepository->update($id, $data);

            if (isset($data['related_ids'])) {
                $updatedPost->relatedPosts()->sync($data['related_ids']);
            }

            return $updatedPost;
        });
    }

    public function deletePost($id)
    {
        $post = $this->postRepository->find($id);

        if (!$post) {
            return false;
        }

        if ($post->thumbnail) {
            $thumbnailPath = str_replace('/storage/', '', $post->thumbnail);
            if (Storage::disk('public')->exists($thumbnailPath)) {
                Storage::disk('public')->delete($thumbnailPath);
            }
        }

        $this->deleteImagesInContent($post->content);

        return $this->postRepository->delete($id);
    }

    private function deleteImagesInContent($content)
    {
        if (!$content) {
            return;
        }

        preg_match_all('/src="\/storage\/([^"]+)"/', $content, $matches);

        if (!empty($matches[1])) {
            foreach ($matches[1] as $path) {
                if (Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                }
            }
        }
    }

    private function processContentImages($content)
    {
        if (strpos($content, '<img') === false) {
            return $content;
        }

        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();

        $images = $dom->getElementsByTagName('img');

        foreach ($images as $img) {
            $src = $img->getAttribute('src');
            if (preg_match('/data:image\/(\w+);base64,/', $src, $type)) {
                $data = substr($src, strpos($src, ',') + 1);
                $data = base64_decode($data);
                
                if ($data === false) continue;

                $imageName = 'content_' . time() . '_' . Str::random(10) . '.' . strtolower($type[1]);
                $path = 'uploads/content/' . $imageName;
                Storage::disk('public')->put($path, $data);

                $img->setAttribute('src', '/storage/' . $path);
            }
        }
        return $dom->saveHTML();
    }
}