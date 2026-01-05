@extends('layouts.dashboard')

@section('title', 'Thêm Bài viết mới')

@section('content')

<main class="w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Viết bài mới</h1>
        <a href="{{ route('posts.index') }}" 
           class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded shadow flex items-center gap-2 transition duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
            </svg>
            Quay lại danh sách
        </a>
    </div>

    <div class="bg-white rounded-lg shadow border border-gray-200 overflow-hidden">
        <div class="p-6">
            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="md:col-span-2 space-y-6">
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Tiêu đề bài viết <span class="text-red-500">*</span></label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}" required
                                class="w-full rounded-md shadow-sm focus:border-green-500 focus:ring-green-500 border p-2 text-base text-gray-900 @error('title') border-red-500 @else border-gray-300 @enderror"
                                placeholder="Nhập tiêu đề bài viết...">
                            @error('title') <p class="text-red-500 text-xs mt-1 italic">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="summary" class="block text-sm font-medium text-gray-700 mb-1">Tóm tắt ngắn</label>
                            <textarea name="summary" id="summary" rows="3"
                                class="w-full rounded-md shadow-sm focus:border-green-500 focus:ring-green-500 border p-2 text-gray-900 @error('summary') border-red-500 @else border-gray-300 @enderror"
                                placeholder="Mô tả ngắn gọn về bài viết...">{{ old('summary') }}</textarea>
                            @error('summary') <p class="text-red-500 text-xs mt-1 italic">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="content-editor" class="block text-sm font-medium text-gray-700 mb-1">Nội dung chi tiết <span class="text-red-500">*</span></label>
                            <textarea id="content-editor" name="content" class="h-96 text-gray-900">{{ old('content') }}</textarea>
                            @error('content') <p class="text-red-500 text-xs mt-1 italic">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                            <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Danh mục <span class="text-red-500">*</span></label>
                            <select name="category_id" id="category_id" class="w-full rounded-md shadow-sm focus:border-green-500 focus:ring-green-500 border p-2 bg-white text-gray-900 @error('category_id') border-red-500 @else border-gray-300 @enderror">
                                <option value="">-- Chọn danh mục --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id') <p class="text-red-500 text-xs mt-1 italic">{{ $message }}</p> @enderror
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                            <label for="priority" class="block text-sm font-medium text-gray-700 mb-1">Độ ưu tiên</label>
                            <input type="number" name="priority" id="priority" value="{{ old('priority', 0) }}" min="0"
                                class="w-full rounded-md shadow-sm focus:border-green-500 focus:ring-green-500 border p-2 bg-white text-gray-900 @error('priority') border-red-500 @else border-gray-300 @enderror">
                            <p class="text-xs text-gray-500 mt-1">Số càng lớn càng hiển thị lên đầu.</p>
                            @error('priority') <p class="text-red-500 text-xs mt-1 italic">{{ $message }}</p> @enderror
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Ảnh bìa (Thumbnail)</label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-dashed rounded-md bg-white relative @error('thumbnail') border-red-500 @else border-gray-300 @enderror">
                                <div class="space-y-1 text-center">
                                    <img id="preview-img" src="#" alt="Preview" class="mx-auto max-h-48 hidden rounded mb-3">
                                    <div class="flex text-sm text-gray-600 justify-center">
                                        <label for="thumbnail" class="relative cursor-pointer bg-white rounded-md font-medium text-green-600 hover:text-green-500 focus-within:outline-none">
                                            <span>Tải ảnh lên</span>
                                            <input id="thumbnail" name="thumbnail" type="file" class="sr-only" accept="image/*" onchange="previewImage(this)">
                                        </label>
                                    </div>
                                    <p class="text-xs text-gray-500">PNG, JPG, GIF tối đa 2MB</p>
                                </div>
                            </div>
                            @error('thumbnail') <p class="text-red-500 text-xs mt-1 italic">{{ $message }}</p> @enderror
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                            <h3 class="text-sm font-medium text-gray-700 mb-3 border-b pb-2">Tọa độ (Google Maps)</h3>
                            
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label for="latitude" class="block text-xs font-medium text-gray-600 mb-1">Vĩ độ (Lat)</label>
                                    <input type="text" name="latitude" id="latitude" value="{{ old('latitude') }}"
                                        class="w-full rounded-md shadow-sm border p-2 text-sm text-gray-900 @error('latitude') border-red-500 @else border-gray-300 @enderror"
                                        placeholder="VD: 10.762">
                                    @error('latitude') <p class="text-red-500 text-xs mt-1 italic">{{ $message }}</p> @enderror
                                </div>
                        
                                <div>
                                    <label for="longitude" class="block text-xs font-medium text-gray-600 mb-1">Kinh độ (Long)</label>
                                    <input type="text" name="longitude" id="longitude" value="{{ old('longitude') }}"
                                        class="w-full rounded-md shadow-sm border p-2 text-sm text-gray-900 @error('longitude') border-red-500 @else border-gray-300 @enderror"
                                        placeholder="VD: 106.660">
                                    @error('longitude') <p class="text-red-500 text-xs mt-1 italic">{{ $message }}</p> @enderror
                                </div>
                            </div>
                            <p class="text-xs text-gray-500 mt-2">
                                <a href="https://www.google.com/maps" target="_blank" class="text-blue-600 hover:underline">Mở Google Maps</a> để lấy tọa độ.
                            </p>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                            <label for="related_ids" class="block text-sm font-medium text-gray-700 mb-2">Bài viết liên quan</label>
                            
                            <select name="related_ids[]" id="related_ids" multiple
                                class="w-full h-32 rounded-md shadow-sm border-gray-300 border p-2 text-sm text-gray-900 focus:border-green-500 focus:ring-green-500">
                                @if(isset($allPosts) && $allPosts->count() > 0)
                                    @foreach($allPosts as $p)
                                        <option value="{{ $p->id }}" {{ (collect(old('related_ids'))->contains($p->id)) ? 'selected' : '' }}>
                                            {{ $p->title }}
                                        </option>
                                    @endforeach
                                @else
                                    <option disabled>Chưa có bài viết nào khác</option>
                                @endif
                            </select>
                            <p class="text-xs text-gray-500 mt-1">Giữ phím <strong>Ctrl</strong> (Windows) hoặc <strong>Cmd</strong> (Mac) để chọn nhiều bài.</p>
                            @error('related_ids') <p class="text-red-500 text-xs mt-1 italic">{{ $message }}</p> @enderror
                        </div>

                        <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded shadow transition duration-200 flex justify-center items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Đăng bài ngay
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