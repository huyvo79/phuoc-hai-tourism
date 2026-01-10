@extends('layouts.dashboard')

@section('title', 'Cập nhật Bài viết')

@section('content')

<main class="w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
        <h1 class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-purple-400 to-blue-400 bg-clip-text text-transparent">
            Cập nhật Bài viết
        </h1>
        <a href="{{ route('posts.index') }}" 
           class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-5 rounded-full shadow-lg flex items-center gap-2 transition duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
            </svg>
            Quay lại
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden">
        <div class="p-6">
            <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="md:col-span-2 space-y-6">
                        <div>
                            <label for="title" class="block text-sm font-semibold text-indigo-600 mb-1">Tiêu đề bài viết <span class="text-red-500">*</span></label>
                            <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}" required
                                class="w-full rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 border p-2.5 text-gray-900 @error('title') border-red-500 @else border-gray-300 @enderror"
                                placeholder="Nhập tiêu đề bài viết...">
                            @error('title') <p class="text-red-500 text-xs mt-1 italic">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="summary" class="block text-sm font-semibold text-indigo-600 mb-1">Tóm tắt ngắn</label>
                            <textarea name="summary" id="summary" rows="3"
                                class="w-full rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 border p-2.5 text-gray-900 @error('summary') border-red-500 @else border-gray-300 @enderror"
                                placeholder="Mô tả ngắn gọn về bài viết...">{{ old('summary', $post->summary) }}</textarea>
                            @error('summary') <p class="text-red-500 text-xs mt-1 italic">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="content-editor" class="block text-sm font-semibold text-indigo-600 mb-1">Nội dung chi tiết <span class="text-red-500">*</span></label>
                            <textarea id="content-editor" name="content" class="h-96 text-gray-900">{{ old('content', $post->content) }}</textarea>
                            @error('content') <p class="text-red-500 text-xs mt-1 italic">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="bg-indigo-50 p-5 rounded-xl border border-indigo-100 shadow-sm">
                            <label for="category_id" class="block text-sm font-semibold text-indigo-600 mb-2">Danh mục <span class="text-red-500">*</span></label>
                            <select name="category_id" id="category_id" class="w-full rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 border p-2.5 bg-white text-gray-900 @error('category_id') border-red-500 @else border-gray-300 @enderror">
                                <option value="">-- Chọn danh mục --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id') <p class="text-red-500 text-xs mt-1 italic">{{ $message }}</p> @enderror
                        </div>

                        <div class="bg-indigo-50 p-5 rounded-xl border border-indigo-100 shadow-sm">
                            <label for="priority" class="block text-sm font-semibold text-indigo-600 mb-2">Độ ưu tiên</label>
                            <input type="number" name="priority" id="priority" value="{{ old('priority', $post->priority) }}" min="0"
                                class="w-full rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 border p-2.5 bg-white text-gray-900 @error('priority') border-red-500 @else border-gray-300 @enderror">
                            @error('priority') <p class="text-red-500 text-xs mt-1 italic">{{ $message }}</p> @enderror
                        </div>

                        <div class="bg-indigo-50 p-5 rounded-xl border border-indigo-100 shadow-sm">
                            <label class="block text-sm font-semibold text-indigo-600 mb-3">Ảnh bìa (Thumbnail)</label>
                            @if($post->thumbnail)
                                <div class="mb-4 text-center">
                                    <img src="{{ $post->thumbnail }}" alt="Current Image" class="mx-auto max-h-32 rounded-lg border border-indigo-200 shadow-sm">
                                </div>
                            @endif
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-dashed rounded-lg bg-white relative @error('thumbnail') border-red-500 @else border-indigo-200 @enderror">
                                <div class="space-y-2 text-center">
                                    <img id="preview-img" src="#" alt="Preview" class="mx-auto max-h-48 hidden rounded-lg mb-3 shadow-md">
                                    <div class="flex text-sm text-gray-600 justify-center">
                                        <label for="thumbnail" class="relative cursor-pointer bg-white rounded-md font-bold text-indigo-600 hover:text-indigo-500 focus-within:outline-none">
                                            <span>Thay đổi ảnh</span>
                                            <input id="thumbnail" name="thumbnail" type="file" class="sr-only" accept="image/*" onchange="previewImage(this)">
                                        </label>
                                    </div>
                                    <p class="text-[10px] text-gray-400">PNG, JPG tối đa 2MB</p>
                                </div>
                            </div>
                            @error('thumbnail') <p class="text-red-500 text-xs mt-1 italic">{{ $message }}</p> @enderror
                        </div>

                        <div class="bg-indigo-50 p-5 rounded-xl border border-indigo-100 shadow-sm">
                            <div class="flex justify-between items-center mb-3 border-b border-indigo-100 pb-2">
                                <h3 class="text-sm font-semibold text-indigo-600">Tọa độ (Maps)</h3>
                                <a href="https://www.google.com/maps" target="_blank" class="text-[10px] text-blue-600 hover:underline flex items-center gap-1 font-medium">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                    </svg>
                                    Lấy tọa độ
                                </a>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="latitude" class="block text-[10px] font-medium text-gray-500 uppercase">Vĩ độ</label>
                                    <input type="text" name="latitude" id="latitude" value="{{ old('latitude', $post->latitude) }}"
                                        class="w-full rounded-lg shadow-sm border p-2 text-sm text-gray-900 focus:ring-indigo-500 focus:border-indigo-500 border-gray-300">
                                </div>
                                <div>
                                    <label for="longitude" class="block text-[10px] font-medium text-gray-500 uppercase">Kinh độ</label>
                                    <input type="text" name="longitude" id="longitude" value="{{ old('longitude', $post->longitude) }}"
                                        class="w-full rounded-lg shadow-sm border p-2 text-sm text-gray-900 focus:ring-indigo-500 focus:border-indigo-500 border-gray-300">
                                </div>
                            </div>
                        </div>

                        <div class="bg-indigo-50 p-5 rounded-xl border border-indigo-100 shadow-sm">
                            <label for="related_ids" class="block text-sm font-semibold text-indigo-600 mb-2">Bài viết liên quan</label>
                            <select name="related_ids[]" id="related_ids" multiple
                                class="w-full h-32 rounded-lg shadow-sm border-gray-300 border p-2 text-sm text-gray-900 focus:ring-indigo-500 focus:border-indigo-500">
                                @if(isset($allPosts) && $allPosts->count() > 0)
                                    @foreach($allPosts as $p)
                                        <option value="{{ $p->id }}" 
                                            {{ (collect(old('related_ids', $post->relatedPosts->pluck('id')->toArray()))->contains($p->id)) ? 'selected' : '' }}>
                                            {{ $p->title }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-4 rounded-full shadow-lg transition duration-200 flex justify-center items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                            </svg>
                            Lưu thay đổi
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection

@push('scripts')
    <script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
    <script>
        tinymce.init({
            selector: '#content-editor',
            license_key: 'gpl',
            height: 500,
            plugins: 'image link lists table code preview fullscreen wordcount',
            toolbar: 'undo redo | blocks | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code preview fullscreen',
            branding: false,
            paste_data_images: true,
            file_picker_callback: function (callback, value, meta) {
                if (meta.filetype === 'image') {
                    var input = document.createElement('input');
                    input.setAttribute('type', 'file');
                    input.setAttribute('accept', 'image/*');
                    input.onchange = function () {
                        var file = this.files[0];
                        var reader = new FileReader();
                        reader.onload = function () {
                            callback(reader.result, {
                                alt: file.name
                            });
                        };
                        reader.readAsDataURL(file);
                    };
                    input.click();
                }
            }
        });

        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.getElementById('preview-img');
                    img.src = e.target.result;
                    img.classList.remove('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush