<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\MediaService;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    protected $mediaService;

    public function __construct(MediaService $mediaService)
    {
        $this->mediaService = $mediaService;
    }

    public function uploadImage(Request $request)
    {
        return $this->mediaService->uploadImage($request);
    }

    public function uploadVideo(Request $request)
    {
        return $this->mediaService->uploadVideo($request);
    }
}
