@extends('layouts.dashboard')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Post Image Details</h1>

    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="mb-4">
            <strong>ID:</strong> {{ $postImage->id }}
        </div>

        <div class="mb-4">
            <strong>Post:</strong> {{ $postImage->post->title ?? 'N/A' }}
        </div>

        <div class="mb-4">
            <strong>Image:</strong>
            <br>
            <img src="{{ asset('storage/' . $postImage->image) }}" alt="Post Image" class="w-64 h-64 object-cover mt-2">
        </div>

        <div class="mb-4">
            <strong>Created At:</strong> {{ $postImage->created_at }}
        </div>

        <div class="mb-4">
            <strong>Updated At:</strong> {{ $postImage->updated_at }}
        </div>

        <a href="{{ route('post-images.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            TRở về danh sách
        </a>
    </div>
</div>
@endsection