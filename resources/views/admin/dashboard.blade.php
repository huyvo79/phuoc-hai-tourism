@extends('layouts.dashboard')

@section('title', 'Quản lý Tài khoản')

@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <main class="flex-1 bg-slate-900 text-white font-sans">
        <header class="bg-slate-900/80 backdrop-blur-md border-b border-white/5 px-8 py-4 sticky top-0 z-50">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold tracking-tight">Dashboard</h2>
                    <p class="text-slate-400 text-sm mt-1">Tổng quan hệ thống & báo cáo</p>
                </div>
                <div class="flex items-center gap-4">
                    <button
                        class="w-10 h-10 rounded-full bg-slate-800 hover:bg-slate-700 transition-all flex items-center justify-center text-slate-400 hover:text-white border border-white/5">
                        <i class="fas fa-bell"></i>
                    </button>
                </div>
            </div>
        </header>

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-6">

                <div
                    class="bg-gradient-to-br from-emerald-600 to-emerald-900 rounded-2xl p-6 shadow-xl shadow-emerald-500/10 border border-white/5">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-emerald-200 text-sm font-medium">Lượt truy cập</p>
                            <h3 class="text-3xl font-bold mt-2" id="stats-visitor-count">...</h3>
                        </div>
                        <div class="w-12 h-12 bg-white/10 rounded-xl flex items-center justify-center backdrop-blur-sm">
                            <i class="fas fa-chart-line text-xl text-white"></i>
                        </div>
                    </div>
                    <p class="text-emerald-200/80 text-xs mt-4 flex items-center gap-1" id="stats-visitor-sub">
                        <i class="fas fa-sync fa-spin"></i> Đang tải...
                    </p>
                </div>

                <div
                    class="bg-gradient-to-br from-pink-600 to-pink-900 rounded-2xl p-6 shadow-xl shadow-pink-500/10 border border-white/5">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-pink-200 text-sm font-medium">Danh mục</p>
                            <h3 class="text-3xl font-bold mt-2" id="stats-category-count">...</h3>
                        </div>
                        <div class="w-12 h-12 bg-white/10 rounded-xl flex items-center justify-center backdrop-blur-sm">
                            <i class="fas fa-layer-group text-xl text-white"></i>
                        </div>
                    </div>
                    <p class="text-pink-200/80 text-xs mt-4" id="stats-category-sub">...</p>
                </div>

                <div
                    class="bg-gradient-to-br from-blue-600 to-blue-900 rounded-2xl p-6 shadow-xl shadow-blue-500/10 border border-white/5">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-200 text-sm font-medium">Bài viết</p>
                            <h3 class="text-3xl font-bold mt-2" id="stats-post-count">...</h3>
                        </div>
                        <div class="w-12 h-12 bg-white/10 rounded-xl flex items-center justify-center backdrop-blur-sm">
                            <i class="fas fa-newspaper text-xl text-white"></i>
                        </div>
                    </div>
                    <p class="text-blue-200/80 text-xs mt-4" id="stats-post-sub">...</p>
                </div>

                <div
                    class="bg-gradient-to-br from-indigo-600 to-indigo-900 rounded-2xl p-6 shadow-xl shadow-indigo-500/10 border border-white/5">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-indigo-200 text-sm font-medium">Quản trị viên</p>
                            <h3 class="text-3xl font-bold mt-2" id="stats-admin-count">...</h3>
                        </div>
                        <div class="w-12 h-12 bg-white/10 rounded-xl flex items-center justify-center backdrop-blur-sm">
                            <i class="fas fa-users-cog text-xl text-white"></i>
                        </div>
                    </div>
                    <p class="text-indigo-200/80 text-xs mt-4" id="stats-admin-sub">...</p>
                </div>

            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div
                    class="lg:col-span-2 bg-slate-800/50 backdrop-blur border border-white/5 rounded-2xl p-6 flex flex-col h-full">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-bold flex items-center gap-2">
                            <i class="fas fa-id-card text-slate-400"></i> Thông tin phiên làm việc
                        </h3>
                        <span
                            class="px-3 py-1 bg-indigo-500/10 text-indigo-400 border border-indigo-500/20 text-xs font-semibold rounded-full">
                            Đang hoạt động
                        </span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 flex-1">
                        <div
                            class="p-4 bg-slate-900/50 rounded-xl border border-white/5 flex flex-col justify-center items-center text-center group hover:border-purple-500/30 transition-colors">
                            <div
                                class="w-12 h-12 bg-purple-500/10 rounded-full flex items-center justify-center mb-3 group-hover:bg-purple-500 group-hover:text-white transition-all text-purple-400">
                                <i class="fas fa-user text-lg"></i>
                            </div>
                            <p class="text-xs text-slate-400 uppercase tracking-wider">Họ và tên</p>
                            <p id="welcomeName" class="font-bold text-lg mt-1 text-white">Đang tải...</p>
                        </div>
                        <div
                            class="p-4 bg-slate-900/50 rounded-xl border border-white/5 flex flex-col justify-center items-center text-center group hover:border-blue-500/30 transition-colors">
                            <div
                                class="w-12 h-12 bg-blue-500/10 rounded-full flex items-center justify-center mb-3 group-hover:bg-blue-500 group-hover:text-white transition-all text-blue-400">
                                <i class="fas fa-at text-lg"></i>
                            </div>
                            <p class="text-xs text-slate-400 uppercase tracking-wider">Tên đăng nhập</p>
                            <p id="infoUsername" class="font-bold text-lg mt-1 text-white">...</p>
                        </div>
                        <div
                            class="p-4 bg-slate-900/50 rounded-xl border border-white/5 flex flex-col justify-center items-center text-center group hover:border-emerald-500/30 transition-colors">
                            <div
                                class="w-12 h-12 bg-emerald-500/10 rounded-full flex items-center justify-center mb-3 group-hover:bg-emerald-500 group-hover:text-white transition-all text-emerald-400">
                                <i class="fas fa-calendar-check text-lg"></i>
                            </div>
                            <p class="text-xs text-slate-400 uppercase tracking-wider">Ngày tham gia</p>
                            <p id="infoJoined" class="font-bold text-lg mt-1 text-white">...</p>
                        </div>
                    </div>
                </div>

                <div class="bg-slate-800/50 backdrop-blur border border-white/5 rounded-2xl p-6 flex flex-col h-full">
                    <h3 class="text-lg font-bold mb-6 flex items-center gap-2">
                        <i class="fas fa-bolt text-yellow-500"></i> Thao tác nhanh
                    </h3>

                    <div class="space-y-4 flex-1">
                        <button id="btn-quick-category"
                            class="group relative w-full p-4 rounded-2xl bg-slate-800/40 border border-white/5 hover:border-pink-500/50 hover:bg-slate-800/80 transition-all duration-300 overflow-hidden active:scale-[0.98]">

                            <div
                                class="absolute inset-0 bg-gradient-to-r from-pink-500/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            </div>

                            <div class="relative flex items-center justify-between">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-10 h-10 rounded-xl bg-slate-700/50 border border-white/5 group-hover:border-pink-500/30 group-hover:bg-pink-500/20 flex items-center justify-center transition-all duration-300 group-hover:scale-110">
                                        <i
                                            class="fas fa-layer-group text-gray-400 group-hover:text-pink-400 text-lg transition-colors"></i>
                                    </div>

                                    <div class="text-left">
                                        <h4 class="font-semibold text-gray-300 group-hover:text-white transition-colors">
                                            Danh mục</h4>
                                        <p class="text-xs text-gray-500 group-hover:text-pink-200/70">Tạo nhóm mới</p>
                                    </div>
                                </div>

                                <i
                                    class="fas fa-chevron-right text-gray-600 group-hover:text-pink-400 group-hover:translate-x-1 transition-all duration-300 text-sm"></i>
                            </div>
                        </button>

                        <a href="/admin/posts/create"
                            class="block group relative w-full p-4 rounded-2xl bg-slate-800/40 border border-white/5 hover:border-sky-500/50 hover:bg-slate-800/80 transition-all duration-300 overflow-hidden active:scale-[0.98]">

                            <div
                                class="absolute inset-0 bg-gradient-to-r from-sky-500/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            </div>

                            <div class="relative flex items-center justify-between">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-10 h-10 rounded-xl bg-slate-700/50 border border-white/5 group-hover:border-sky-500/30 group-hover:bg-sky-500/20 flex items-center justify-center transition-all duration-300 group-hover:scale-110">
                                        <i
                                            class="fas fa-pen-nib text-gray-400 group-hover:text-sky-400 text-lg transition-colors"></i>
                                    </div>
                                    <div class="text-left">
                                        <h4 class="font-semibold text-gray-300 group-hover:text-white transition-colors">
                                            Viết bài</h4>
                                        <p class="text-xs text-gray-500 group-hover:text-sky-200/70">Đăng nội dung mới</p>
                                    </div>
                                </div>
                                <i
                                    class="fas fa-chevron-right text-gray-600 group-hover:text-sky-400 group-hover:translate-x-1 transition-all duration-300 text-sm"></i>
                            </div>
                        </a>

                        <button id="btn-quick-admin" type="button" onclick="toggleModal('addUserModal')"
                            class="group relative w-full p-4 rounded-2xl bg-slate-800/40 border border-white/5 hover:border-violet-500/50 hover:bg-slate-800/80 transition-all duration-300 overflow-hidden active:scale-[0.98]">
                            <div
                                class="absolute inset-0 bg-gradient-to-r from-violet-500/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            </div>
                            <div class="relative flex items-center justify-between">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-10 h-10 rounded-xl bg-slate-700/50 border border-white/5 group-hover:border-violet-500/30 group-hover:bg-violet-500/20 flex items-center justify-center transition-all duration-300 group-hover:scale-110">
                                        <i
                                            class="fas fa-user-shield text-gray-400 group-hover:text-violet-400 text-lg transition-colors"></i>
                                    </div>
                                    <div class="text-left">
                                        <h4 class="font-semibold text-gray-300 group-hover:text-white transition-colors">
                                            Admin mới</h4>
                                        <p class="text-xs text-gray-500 group-hover:text-violet-200/70">Cấp quyền quản trị
                                        </p>
                                    </div>
                                </div>
                                <i
                                    class="fas fa-chevron-right text-gray-600 group-hover:text-violet-400 group-hover:translate-x-1 transition-all duration-300 text-sm"></i>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/js/auth.js"></script>
    <script src="/js/dashboard.js"></script>
@endpush