@extends('layouts.dashboard')

@section('title', 'Thêm Bài viết mới')

@section('content')

<main class="w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-white-800">Thêm danh mục</h1>

        <a href="{{ route('category.list') }}"
           class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded shadow flex items-center gap-2 transition">
            ← Quay lại danh sách
        </a>
    </div>

    <div class="bg-white rounded-lg shadow border border-gray-200 overflow-hidden">
        <div class="p-6">

            <form action="{{ route('category.store') }}" method="POST" class="max-w-xl">
                @csrf

                {{-- Name --}}
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Tên danh mục <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Ví dụ: Du lịch biển"
                        class="w-full rounded-md shadow-sm border p-2 text-gray-900
                               focus:border-green-500 focus:ring-green-500
                               @error('name') border-red-500 @else border-gray-300 @enderror"
                    >

                    @error('name')
                        <p class="text-red-500 text-xs mt-1 italic">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Button --}}
                <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded shadow transition flex items-center gap-2">
                    Lưu
                </button>
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
