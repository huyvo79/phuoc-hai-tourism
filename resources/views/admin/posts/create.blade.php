@extends('layouts.dashboard')

@section('title', 'Thêm Bài viết mới')

@section('content')

<main class="w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
        <h1 class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-purple-400 to-blue-400 bg-clip-text text-transparent">
            Viết bài mới
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
            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="md:col-span-2 space-y-6">
                        <div>
                            <label for="title" class="block text-sm font-semibold text-indigo-600 mb-1">Tiêu đề bài viết <span class="text-red-500">*</span></label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}" required
                                class="w-full rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 border p-2.5 text-gray-900 @error('title') border-red-500 @else border-gray-300 @enderror">
                            @error('title') <p class="text-red-500 text-xs mt-1 italic">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="summary" class="block text-sm font-semibold text-indigo-600 mb-1">Tóm tắt ngắn</label>
                            <textarea name="summary" id="summary" rows="3"
                                class="w-full rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 border p-2.5 text-gray-900 @error('summary') border-red-500 @else border-gray-300 @enderror">{{ old('summary') }}</textarea>
                            @error('summary') <p class="text-red-500 text-xs mt-1 italic">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="content-editor" class="block text-sm font-semibold text-indigo-600 mb-1">Nội dung chi tiết <span class="text-red-500">*</span></label>
                            <textarea id="content-editor" name="content" class="h-96 text-gray-900">{{ old('content') }}</textarea>
                            @error('content') <p class="text-red-500 text-xs mt-1 italic">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="bg-indigo-50 p-5 rounded-xl border border-indigo-100 shadow-sm">
                            <label for="category_id" class="block text-sm font-semibold text-indigo-600 mb-2">Danh mục <span class="text-red-500">*</span></label>
                            <select name="category_id" id="category_id"
                                class="w-full rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 border p-2.5 bg-white text-gray-900 @error('category_id') border-red-500 @else border-gray-300 @enderror">
                                <option value="">-- Chọn danh mục --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id') <p class="text-red-500 text-xs mt-1 italic">{{ $message }}</p> @enderror
                        </div>

                        <div class="bg-indigo-50 p-5 rounded-xl border border-indigo-100 shadow-sm">
                            <label for="priority" class="block text-sm font-semibold text-indigo-600 mb-2">Độ ưu tiên</label>
                            <input type="number" name="priority" id="priority" value="{{ old('priority', 0) }}" min="0"
                                class="w-full rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 border p-2.5 bg-white text-gray-900 @error('priority') border-red-500 @else border-gray-300 @enderror">
                            @error('priority') <p class="text-red-500 text-xs mt-1 italic">{{ $message }}</p> @enderror
                        </div>

                        <div class="bg-indigo-50 p-5 rounded-xl border border-indigo-100 shadow-sm">
                            <label class="block text-sm font-semibold text-indigo-600 mb-3">Ảnh bìa (Thumbnail)</label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-dashed rounded-lg bg-white relative @error('thumbnail') border-red-500 @else border-indigo-200 @enderror">
                                <div class="space-y-2 text-center">
                                    <img id="preview-img" class="mx-auto max-h-48 hidden rounded-lg mb-3 shadow-md">
                                    <div class="flex text-sm text-gray-600 justify-center">
                                        <label for="thumbnail" class="relative cursor-pointer bg-white rounded-md font-bold text-indigo-600 hover:text-indigo-500">
                                            <span>Tải ảnh lên</span>
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
                                    <label class="block text-[10px] font-medium text-gray-500 uppercase">Vĩ độ</label>
                                    <input type="text" name="latitude" value="{{ old('latitude') }}"
                                        class="w-full rounded-lg shadow-sm border p-2 text-sm text-gray-900 @error('latitude') border-red-500 @else border-gray-300 @enderror">
                                    @error('latitude') <p class="text-red-500 text-xs mt-1 italic">{{ $message }}</p> @enderror
                                </div>

                                <div>
                                    <label class="block text-[10px] font-medium text-gray-500 uppercase">Kinh độ</label>
                                    <input type="text" name="longitude" value="{{ old('longitude') }}"
                                        class="w-full rounded-lg shadow-sm border p-2 text-sm text-gray-900 @error('longitude') border-red-500 @else border-gray-300 @enderror">
                                    @error('longitude') <p class="text-red-500 text-xs mt-1 italic">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="bg-indigo-50 p-5 rounded-xl border border-indigo-100 shadow-sm">
                            <label class="block text-sm font-semibold text-indigo-600 mb-2">Bài viết liên quan</label>
                            <select name="related_ids[]" multiple
                                class="w-full h-32 rounded-lg shadow-sm border p-2 text-sm text-gray-900 @error('related_ids') border-red-500 @else border-gray-300 @enderror">
                                @foreach($allPosts ?? [] as $p)
                                    <option value="{{ $p->id }}" {{ collect(old('related_ids'))->contains($p->id) ? 'selected' : '' }}>
                                        {{ $p->title }}
                                    </option>
                                @endforeach
                            </select>
                            @error('related_ids') <p class="text-red-500 text-xs mt-1 italic">{{ $message }}</p> @enderror
                            @error('related_ids.*') <p class="text-red-500 text-xs mt-1 italic">{{ $message }}</p> @enderror
                        </div>

                        <button type="submit"
                            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-4 rounded-full shadow-lg transition duration-200">
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
<style>
    @keyframes tiny-spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    .tiny-loading-overlay {
        position: absolute; top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(255, 255, 255, 0.7); 
        display: flex; align-items: center; justify-content: center; 
        z-index: 9999; border-radius: 10px;
    }
    .tiny-spinner {
        width: 40px; height: 40px;
        border: 4px solid #f3f3f3;
        border-top: 4px solid #22c55e; /* Màu xanh lá của bạn */
        border-radius: 50%;
        animation: tiny-spin 0.8s linear infinite;
    }
</style>

<script>
tinymce.init({
    selector: '#content-editor',
    license_key: 'gpl', 
    height: 600,
    statusbar: false, 
    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed pagebreak advlist',
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
    file_picker_types: 'image media',

    // Không cần setup hàm showLoading/hideLoading thủ công nữa
    setup: function (editor) {
        // Bạn có thể giữ lại các logic khác ở đây nếu cần
    },

    file_picker_callback: function (cb, value, meta) {
        const input = document.createElement('input');
        input.type = 'file';

        let uploadUrl = '/admin/tinymce/upload-image';
        if (meta.filetype === 'image') {
            input.accept = 'image/*';
        } else {
            input.accept = 'video/*';
            uploadUrl = '/admin/tinymce/upload-video';
        }

        input.onchange = function () {
            const file = this.files[0];
            const formData = new FormData();
            formData.append('file', file);

            const editor = tinymce.activeEditor;

            const notification = editor.notificationManager.open({
                text: 'Đang tải tệp lên: ' + file.name,
                type: 'info',
                progressbar: true 
            });

            const submitBtn = document.querySelector('button[type="submit"]') || document.querySelector('.bg-indigo-600');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.style.opacity = '0.5';
            }

            const xhr = new XMLHttpRequest();
            xhr.open('POST', uploadUrl);

            xhr.upload.onprogress = function (e) {
                if (e.lengthComputable) {
                    const percent = Math.round((e.loaded / e.total) * 100);
                    notification.progressBar.value(percent); 
                }
            };

            xhr.onload = function () {
                notification.close();

                try {
                    const res = JSON.parse(xhr.responseText);
                    cb(res.location, { title: file.name });
                    
                    editor.notificationManager.open({
                        text: 'Tải lên thành công!',
                        type: 'success',
                        timeout: 2000 
                    });
                } catch (e) {
                    alert('Lỗi phản hồi từ server');
                } finally {
                    if (submitBtn) {
                        submitBtn.disabled = false;
                        submitBtn.style.opacity = '1';
                    }
                }
            };

            xhr.onerror = function () {
                notification.close();
                editor.notificationManager.open({
                    text: 'Lỗi trong quá trình tải lên!',
                    type: 'error'
                });
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.style.opacity = '1';
                }
            };

            xhr.send(formData);
        };

        input.click();
    }
});

function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            const img = document.getElementById('preview-img');
            if(img) {
                img.src = e.target.result;
                img.classList.remove('hidden');
            }
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
