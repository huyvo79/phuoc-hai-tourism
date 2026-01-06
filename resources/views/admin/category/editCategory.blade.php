@extends('layouts.dashboard')

@section('title', 'Cập nhật danh mục')

@section('content')
<main class="w-full mx-auto px-6 py-8">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Cập nhật danh mục</h1>

        <a href="{{ route('category.list') }}"
           class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded shadow">
            ← Quay lại
        </a>
    </div>

    <div class="bg-white rounded-lg shadow border border-gray-200">
        <div class="p-6 max-w-xl">

            <form action="{{ route('category.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Tên danh mục
                    </label>

                    <input type="text"
                           name="name"
                           value="{{ old('name', $category->name) }}"
                           class="w-full rounded-md border p-2 focus:ring-green-500 focus:border-green-500
                           @error('name') border-red-500 @else border-gray-300 @enderror">

                    @error('name')
                        <p class="text-red-500 text-xs mt-1 italic">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded shadow">
                    💾 Cập nhật
                </button>
            </form>

        </div>
    </div>
</main>
@endsection
