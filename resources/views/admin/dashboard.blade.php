<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Phước Hải</title>
    <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="/css/dashboard.css">
</head>

<body class="bg-slate-900 text-white">
    <div class="flex min-h-screen">
        <aside class="w-64 bg-slate-800/50 backdrop-blur-xl border-r border-white/10 flex flex-col">
            <div class="p-6 text-center border-b border-white/10">
                <div
                    class="w-12 h-12 bg-gradient-to-br from-purple-500 to-blue-500 rounded-xl flex items-center justify-center mx-auto mb-3 shadow-lg shadow-purple-500/30">
                    <i class="fas fa-mountain-sun text-xl text-white"></i>
                </div>
                <h1
                    class="text-xl font-bold bg-gradient-to-r from-purple-400 to-blue-400 bg-clip-text text-transparent">
                    PHƯỚC HẢI</h1>
                <p class="text-xs text-gray-500 mt-1">TRAVEL ADMIN</p>
            </div>

            <nav class="flex-1 py-6 space-y-1 px-3">
                <a href="#"
                    class="sidebar-link active flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:text-white transition-all">
                    <i class="fas fa-th-large w-5 text-purple-400"></i>
                    <span>Dashboard</span>
                </a>
                <a href="#"
                    class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg text-gray-400 hover:text-white transition-all">
                    <i class="fas fa-layer-group w-5"></i>
                    <span>Quản lý Danh mục</span>
                </a>
                <a href="#"
                    class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg text-gray-400 hover:text-white transition-all">
                    <i class="fas fa-map-marked-alt w-5"></i>
                    <span>Địa điểm / Bài viết</span>
                </a>

                <div class="border-t border-white/10 my-4"></div>

                <a href="#"
                    class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg text-gray-400 hover:text-white transition-all">
                    <i class="fas fa-users-cog w-5"></i>
                    <span>Tài khoản Admin</span>
                </a>
                <a href="#" id="logoutBtn"
                    class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg text-red-400 hover:text-red-300 hover:bg-red-500/10 transition-all">
                    <i class="fas fa-sign-out-alt w-5"></i>
                    <span>Đăng xuất</span>
                </a>
            </nav>

            <div class="p-4 border-t border-white/10">
                <div class="flex items-center gap-3 p-3 bg-slate-700/50 rounded-xl">
                    <img id="userAvatar" src="" alt="Avatar"
                        class="w-10 h-10 rounded-full ring-2 ring-purple-500/50">
                    <div class="flex-1 min-w-0">
                        <p id="sidebarUserName" class="text-sm font-medium truncate">Đang tải...</p>
                        <p id="sidebarUserRole" class="text-xs text-gray-400 truncate">...</p>
                    </div>
                </div>
            </div>
        </aside>

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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/js/auth.js"></script>
    <script src="/js/dashboard.js"></script>
</body>

</html>
