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
                <a href="/"
                    class="w-12 h-12 bg-gradient-to-br from-purple-500 to-blue-500 rounded-xl flex items-center justify-center mx-auto mb-3 shadow-lg shadow-purple-500/30">
                    <i class="fas fa-mountain-sun text-xl text-white"></i>
                </a>
                <h1
                    class="text-xl font-bold bg-gradient-to-r from-purple-400 to-blue-400 bg-clip-text text-transparent">
                    PHƯỚC HẢI</h1>
                <p class="text-xs text-gray-500 mt-1">TRAVEL ADMIN</p>
            </div>

            <nav class="flex-1 py-6 space-y-1 px-3">
    
                {{-- 1. DASHBOARD --}}
                <a href="{{ route('admin.dashboard') }}"
                class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg transition-all
                {{ request()->routeIs('admin.dashboard') ? 'active bg-slate-700/50 text-white shadow-lg shadow-purple-500/10' : 'text-gray-400 hover:text-white' }}">
                    
                    <i class="fas fa-th-large w-5 {{ request()->routeIs('admin.dashboard') ? 'text-purple-400' : '' }}"></i>
                    <span>Dashboard</span>
                </a>

                {{-- 2. QUẢN LÝ DANH MỤC --}}
                <a href="{{ route('category.list') }}" 
                class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg transition-all
                {{ request()->routeIs('category.list') ? 'active bg-slate-700/50 text-white shadow-lg shadow-purple-500/10' : 'text-gray-400 hover:text-white' }}">
                    
                    <i class="fas fa-layer-group w-5 {{ request()->routeIs('category.list') ? 'text-purple-400' : '' }}"></i>
                    <span>Quản lý Danh mục</span>
                </a>

                {{-- 3. ĐỊA ĐIỂM / BÀI VIẾT --}}
                <a href="{{ route('posts.index') }}"
                class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg transition-all
                {{ request()->routeIs('posts.index') ? 'active bg-slate-700/50 text-white shadow-lg shadow-purple-500/10' : 'text-gray-400 hover:text-white' }}">
                    
                    <i class="fas fa-map-marked-alt w-5 {{ request()->routeIs('posts.index') ? 'text-purple-400' : '' }}"></i>
                    <span>Địa điểm / Bài viết</span>
                </a>

                <div class="border-t border-white/10 my-4"></div>

                {{-- 4. TÀI KHOẢN ADMIN (Phần bạn đang làm) --}}
                <a href="{{ route('user.list') }}"
                class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg transition-all
                {{ request()->routeIs('user.list') || request()->routeIs('user.*') ? 'active bg-slate-700/50 text-white shadow-lg shadow-purple-500/10' : 'text-gray-400 hover:text-white' }}">
                    
                    {{-- Icon cũng đổi màu tím khi active --}}
                    <i class="fas fa-users-cog w-5 {{ request()->routeIs('user.list') || request()->routeIs('user.*') ? 'text-purple-400' : '' }}"></i>
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
            <div class="p-8 flex-1">
                @yield('content')
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/js/auth.js"></script>
    <script src="/js/dashboard.js"></script>
    @stack('scripts')
</body>

</html>
