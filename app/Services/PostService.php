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
    public function __construct(
        protected PostRepositoryInterface $postRepository
    ) {}


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

    public function getPostBySlug($slug)
    {
        return $this->postRepository->findBySlug($slug);
    }

    public function searchPosts($keyword)
    {
        return $this->postRepository->search($keyword);
    }


    public function createPost(array $data)
    {
        return DB::transaction(function () use ($data) {

            $data = $this->preparePostData($data);

            if ($this->hasFile($data, 'thumbnail')) {
                $data['thumbnail'] = $this->uploadFile($data['thumbnail'], 'uploads/thumbnails');
            }

            $post = $this->postRepository->create($data);
            $this->syncRelated($post, $data);

            return $post;
        });
    }


    public function updatePost($id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {

            $post = $this->postRepository->find($id);
            if (!$post) return null;

            if ($this->contentChanged($post, $data)) {
                $this->cleanupRemovedMedia($post->content, $data['content']);
            }

            if ($this->hasFile($data, 'thumbnail')) {
                $this->deleteFile($post->thumbnail);
                $data['thumbnail'] = $this->uploadFile($data['thumbnail'], 'uploads/thumbnails');
            }

            $data = $this->preparePostData($data);

            $post = $this->postRepository->update($id, $data);
            $this->syncRelated($post, $data);

            return $post;
        });
    }


    public function deletePost($id)
    {
        $post = $this->postRepository->find($id);
        if (!$post) return false;

        $this->deleteFile($post->thumbnail);
        $this->deleteMediaInContent($post->content);

        return $this->postRepository->delete($id);
    }


    private function preparePostData(array $data): array
    {
        $data['slug'] = $data['slug'] ?? Str::slug($data['title']) . '-' . time();
        $data['category_id'] = $data['category_id'] ?: 1;
        return $data;
    }

    private function syncRelated($post, array $data): void
    {
        if (!empty($data['related_ids'])) {
            $post->relatedPosts()->sync($data['related_ids']);
        }
    }

    private function hasFile(array $data, string $key): bool
    {
        return isset($data[$key]) && $data[$key] instanceof UploadedFile;
    }

    private function contentChanged($post, array $data): bool
    {
        return isset($data['content']) && $data['content'] !== $post->content;
    }


    private function uploadFile(UploadedFile $file, string $folder): string
    {
        $filename = now()->timestamp . '_' . $file->getClientOriginalName();
        $path = $file->storeAs($folder, $filename, 'public');
        return Storage::url($path);
    }

    private function deleteFile(?string $url): void
    {
        if (!$url) return;

        $path = str_replace('/storage/', '', $url);
        Storage::disk('public')->delete($path);
    }


    private function deleteMediaInContent(?string $content): void
    {
        foreach ($this->extractMediaPaths($content) as $path) {
            Storage::disk('public')->delete($path);
        }
    }

    private function cleanupRemovedMedia(string $old, string $new): void
    {
        $removed = array_diff(
            $this->extractMediaPaths($old),
            $this->extractMediaPaths($new)
        );

        foreach ($removed as $path) {
            Storage::disk('public')->delete($path);
        }
    }

    private function extractMediaPaths(?string $content): array
    {
        if (!$content) return [];

        preg_match_all('#/storage/(uploads/[^"\']+)#', $content, $matches);
        return $matches[1] ?? [];
    }
}
