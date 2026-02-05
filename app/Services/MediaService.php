<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaService
{
    public function uploadImage(Request $request)
    {
        $request->validate([
            'file' => 'required|image|max:5120',
        ]);

        // lưu vào uploads/content
        $path = $request->file('file')->store('uploads/content', 'public');

        return response()->json([
            'location' => Storage::url($path)
        ]);
    }

    public function uploadThumbnail(Request $request)
    {
        $request->validate([
            'file' => 'required|image|max:2048',
        ]);

        $path = $request->file('file')->store('uploads/thumbnails', 'public');

        return response()->json([
            'location' => Storage::url($path)
        ]);
    }

    public function uploadVideo(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:mp4,webm,ogg|max:51200',
        ]);

        $path = $request->file('file')->store('uploads/content', 'public');

        return response()->json([
            'location' => Storage::url($path)
        ]);
    }
}
