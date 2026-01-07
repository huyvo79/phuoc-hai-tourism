@extends('layouts.dashboard')

@section('title', 'Quản lý danh mục')

@section('content')
    <main class="w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="mb-1">
            <div class="text-center mb-8">
                <h1
                    class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-purple-400 to-blue-400 bg-clip-text text-transparent">
                    Danh sách Danh mục
                </h1>
                <p class="text-gray-300 mt-2 text-sm">Quản lý tất cả thông tin danh mục tại một nơi.</p>
            </div>

            <div class="flex flex-col md:flex-row justify-between items-center bg-indigo-200 gap-4 p-2 rounded-xl">

                {{-- Thanh Tìm kiếm --}}
                <div class="relative w-full md:w-1/3">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <input type="text" id="searchInput"
                        class="block w-full p-2.5 pl-10 text-sm text-gray-900 border border-gray-300 rounded-full bg-white focus:ring-indigo-500 focus:border-indigo-500 shadow-sm"
                        placeholder="Tìm theo mã danh mục hoặc tên danh mục...">
                </div>

                {{-- Nút Thêm mới --}}
                <div class="w-full md:w-auto">
                    <a href="{{ route('category.create') }}"
                        class="w-full md:w-auto bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2.5 px-5 rounded-full shadow-lg flex items-center justify-center gap-2 transition duration-200 transform hover:-translate-y-0.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Thêm Danh mục
                    </a>
                </div>
            </div>
        </div>

        {{--  --}}
        {{-- <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-white-800">Danh sách danh mục</h1>
            <a href="{{ route('category.create') }}"
                class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow flex items-center gap-2 transition duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Thêm Danh mục
            </a>
        </div> --}}

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        <div class="bg-white rounded-lg shadow border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-indigo-200">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-indigo-600 uppercase tracking-wider">ID
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-indigo-600 uppercase tracking-wider">
                                Name
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-indigo-600 uppercase tracking-wider">
                                Slug
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-indigo-600 uppercase  tracking-wider">
                                Ngày
                                đăng</th>
                            <th scope="col"
                                class="px-6 py-3 text-right text-xs font-medium text-indigo-600 uppercase tracking-wider">
                                Hành
                                động</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($categories as $category)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $category->id }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $category->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $category->slug }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $category->created_at->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('category.edit', $category->id) }}"
                                        class="text-indigo-600 hover:text-indigo-900 mr-3 inline-block">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                        </svg>
                                    </a>

                                    <button onclick="confirmDelete({{ $category->id }})"
                                        class="text-red-500 hover:text-red-700 transition-colors p-1 rounded hover:bg-red-200"
                                        title="Xóa tài khoản">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                                    Chưa có danh mục nào.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <div id="deleteModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"
                onclick="toggleModal('deleteModal')"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div
                            class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Xóa danh mục</h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">Bạn có chắc chắn muốn xóa danh mục này không? Hành động
                                    này
                                    không thể hoàn tác.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <form id="deleteForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">
                            Xóa ngay
                        </button>
                    </form>
                    <button type="button" onclick="toggleModal('deleteModal')"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Hủy bỏ
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function toggleModal(modalID) {
            const modal = document.getElementById(modalID);
            if (modal) {
                modal.classList.toggle('hidden');
            }
        }

        function confirmDelete(id) {
            let url = "{{ route('category.destroy', ':id') }}";
            url = url.replace(':id', id);

            document.getElementById('deleteForm').action = url;
            toggleModal('deleteModal');
        }
    </script>
@endpush
