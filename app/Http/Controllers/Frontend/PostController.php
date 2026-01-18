<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Interfaces\PostServiceInterface;

class PostController extends Controller
{
    protected PostServiceInterface $postService;

    public function __construct(PostServiceInterface $postService)
    {
        $this->postService = $postService;
    }

    public function show(string $slug)
    {
        $post = $this->postService->getPostBySlug($slug);

        if (!$post) {
            abort(404);
        }

        return view('ui-single.single', compact('post'));
    }
}
