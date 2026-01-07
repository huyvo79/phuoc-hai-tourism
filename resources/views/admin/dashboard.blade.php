@extends('layouts.dashboard')

@section('title', 'Quản lý Tài khoản')

@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <main class="flex-1 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900">
        <header class="bg-slate-800/50 backdrop-blur-xl border-b border-white/10 px-8 py-4">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold">Dashboard</h2>
                    <p class="text-gray-400 text-sm">Chào mừng bạn trở lại!</p>
                </div>
                <div class="flex items-center gap-4">
                    <button
                        class="w-10 h-10 rounded-xl bg-slate-700/50 hover:bg-slate-700 transition-colors flex items-center justify-center text-gray-400 hover:text-white">
                        <i class="fas fa-bell"></i>
                    </button>
                    <button
                        class="w-10 h-10 rounded-xl bg-slate-700/50 hover:bg-slate-700 transition-colors flex items-center justify-center text-gray-400 hover:text-white">
                        <i class="fas fa-cog"></i>
                    </button>
                </div>
            </div>
        </header>

        <div class="p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div
                    class="bg-gradient-to-br from-purple-600 to-purple-800 rounded-2xl p-6 shadow-xl shadow-purple-500/20">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-purple-200 text-sm">Tổng địa điểm</p>
                            <h3 class="text-3xl font-bold mt-1">24</h3>
                        </div>
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                            <i class="fas fa-map-marker-alt text-xl"></i>
                        </div>
                    </div>
                    <p class="text-purple-200 text-xs mt-4"><i class="fas fa-arrow-up mr-1"></i>+12% so với tháng
                        trước</p>
                </div>

                <div
                    class="bg-gradient-to-br from-blue-600 to-blue-800 rounded-2xl p-6 shadow-xl shadow-blue-500/20">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-200 text-sm">Bài viết</p>
                            <h3 class="text-3xl font-bold mt-1">156</h3>
                        </div>
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                            <i class="fas fa-newspaper text-xl"></i>
                        </div>
                    </div>
                    <p class="text-blue-200 text-xs mt-4"><i class="fas fa-arrow-up mr-1"></i>+8% so với tháng trước
                    </p>
                </div>

                <div
                    class="bg-gradient-to-br from-emerald-600 to-emerald-800 rounded-2xl p-6 shadow-xl shadow-emerald-500/20">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-emerald-200 text-sm">Lượt xem</p>
                            <h3 class="text-3xl font-bold mt-1">8.5K</h3>
                        </div>
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                            <i class="fas fa-eye text-xl"></i>
                        </div>
                    </div>
                    <p class="text-emerald-200 text-xs mt-4"><i class="fas fa-arrow-up mr-1"></i>+23% so với tháng
                        trước</p>
                </div>

                <div
                    class="bg-gradient-to-br from-amber-600 to-amber-800 rounded-2xl p-6 shadow-xl shadow-amber-500/20">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-amber-200 text-sm">Đánh giá</p>
                            <h3 class="text-3xl font-bold mt-1">4.8</h3>
                        </div>
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                            <i class="fas fa-star text-xl"></i>
                        </div>
                    </div>
                    <p class="text-amber-200 text-xs mt-4"><i class="fas fa-arrow-up mr-1"></i>+5% so với tháng
                        trước</p>
                </div>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 bg-slate-800/50 backdrop-blur-xl rounded-2xl border border-white/10 p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold">Thông tin tài khoản</h3>
                        <span class="px-3 py-1 bg-purple-500/20 text-purple-400 text-xs rounded-full">Admin</span>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center gap-4 p-4 bg-slate-700/30 rounded-xl">
                            <div class="w-10 h-10 bg-purple-500/20 rounded-lg flex items-center justify-center">
                                <i class="fas fa-user text-purple-400"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-400">Họ tên</p>
                                <p id="welcomeName" class="font-medium">Đang tải...</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 p-4 bg-slate-700/30 rounded-xl">
                            <div class="w-10 h-10 bg-blue-500/20 rounded-lg flex items-center justify-center">
                                <i class="fas fa-at text-blue-400"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-400">Username</p>
                                <p id="infoUsername" class="font-medium">...</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 p-4 bg-slate-700/30 rounded-xl">
                            <div class="w-10 h-10 bg-emerald-500/20 rounded-lg flex items-center justify-center">
                                <i class="fas fa-calendar text-emerald-400"></i>
                            </div>
                            <div>                                    
                                <p class="text-sm text-gray-400">Ngày tham gia</p>
                                <p id="infoJoined" class="font-medium">...</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-slate-800/50 backdrop-blur-xl rounded-2xl border border-white/10 p-6">
                    <h3 class="text-lg font-semibold mb-6">Thao tác nhanh</h3>
                    <div class="space-y-3">
                        <button
                            class="w-full p-4 bg-gradient-to-r from-purple-600 to-blue-600 hover:from-purple-500 hover:to-blue-500 rounded-xl text-left transition-all hover:scale-[1.02] active:scale-[0.98]">
                            <i class="fas fa-plus mr-3"></i>Thêm địa điểm mới
                        </button>
                        <button
                            class="w-full p-4 bg-slate-700/50 hover:bg-slate-700 rounded-xl text-left transition-all">
                            <i class="fas fa-edit mr-3 text-blue-400"></i>Viết bài mới
                        </button>
                        <button
                            class="w-full p-4 bg-slate-700/50 hover:bg-slate-700 rounded-xl text-left transition-all">
                            <i class="fas fa-image mr-3 text-emerald-400"></i>Upload hình ảnh
                        </button>
                        <button
                            class="w-full p-4 bg-slate-700/50 hover:bg-slate-700 rounded-xl text-left transition-all">
                            <i class="fas fa-chart-bar mr-3 text-amber-400"></i>Xem thống kê
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
