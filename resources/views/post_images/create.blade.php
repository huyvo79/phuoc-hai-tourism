@extends('layouts.dashboard')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Create Post Image</h1>

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('post-images.store') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded-lg p-6">
        @csrf

        <div class="mb-4">
            <label for="post_id" class="block text-gray-700 text-sm font-bold mb-2">Bài viết:</label>
            <select name="post_id" id="post_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                <option value="">Chọn bài viết</option>
                @foreach($posts as $post)
                    <option value="{{ $post->id }}">{{ $post->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Hình ảnh:</label>
            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-dashed border-gray-300 rounded-lg bg-gray-50">
                <div class="space-y-2 text-center">
                    <img id="previewImg" class="mx-auto max-h-48 hidden rounded-lg mb-3 shadow-md">
                    <div class="flex text-sm text-gray-600 justify-center">
                        <label for="image" class="relative cursor-pointer bg-white rounded-md font-bold text-indigo-600 hover:text-indigo-500">
                            <span>Chọn hình ảnh</span>
                            <input type="file" name="image" id="image" class="sr-only" accept="image/*" required onchange="previewImage(this)">
                        </label>
                    </div>
                    <p class="text-xs text-gray-500">PNG, JPG, GIF tối đa 2MB</p>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Tạo Hình ảnh Bài viết
            </button>
            <a href="{{ route('post-images.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Hủy
            </a>
        </div>
    </form>
</div>

<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            const img = document.getElementById('previewImg');
            img.src = e.target.result;
            img.classList.remove('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection