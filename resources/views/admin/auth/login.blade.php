<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập Admin - Phước Hải</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body
    class="min-h-screen bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 flex items-center justify-center p-4">
    <div
        class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=1920')] bg-cover bg-center opacity-20">
    </div>

    <div class="relative w-full max-w-md">
        <div
            class="absolute -inset-1 bg-gradient-to-r from-purple-600 via-pink-500 to-blue-500 rounded-2xl blur-lg opacity-75 animate-pulse">
        </div>

        <div
            class="relative bg-slate-900/90 backdrop-blur-xl rounded-2xl shadow-2xl border border-white/10 overflow-hidden">
            <div class="bg-gradient-to-r from-purple-600 to-blue-600 p-6 text-center">
                <div
                    class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-3 backdrop-blur-sm">
                    <i class="fas fa-user-shield text-3xl text-white"></i>
                </div>
                <h1 class="text-2xl font-bold text-white tracking-wide">QUẢN TRỊ VIÊN</h1>
                <p class="text-purple-200 text-sm mt-1">Du lịch Phước Hải</p>
            </div>

            <div class="p-8">
                <div id="error-alert"
                    class="hidden mb-6 p-4 bg-red-500/20 border border-red-500/50 rounded-xl text-red-300 text-sm flex items-center gap-3">
                    <i class="fas fa-exclamation-circle text-lg"></i>
                    <span id="error-message"></span>
                </div>

                <form id="loginForm" class="space-y-6">
                    <div class="space-y-2">
                        <label for="username" class="block text-sm font-medium text-gray-300">
                            <i class="fas fa-user mr-2 text-purple-400"></i>Tên đăng nhập
                        </label>
                        <input type="text" id="username" required autofocus
                            class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300">
                    </div>

                    <div class="space-y-2">
                        <label for="password" class="block text-sm font-medium text-gray-300">
                            <i class="fas fa-lock mr-2 text-purple-400"></i>Mật khẩu
                        </label>
                        <div class="relative">
                            <input type="password" id="password" required
                                class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300 pr-12">
                            <button type="button" id="togglePassword"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 hover:text-purple-400 transition-colors">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" id="submitBtn"
                        class="w-full py-3 px-4 bg-gradient-to-r from-purple-600 to-blue-600 hover:from-purple-500 hover:to-blue-500 text-white font-semibold rounded-xl shadow-lg shadow-purple-500/30 transition-all duration-300 transform hover:scale-[1.02] active:scale-[0.98] flex items-center justify-center gap-2">
                        <span id="btnText">Đăng Nhập</span>
                        <i id="btnIcon" class="fas fa-arrow-right"></i>
                        <svg id="btnSpinner" class="w-5 h-5 animate-spin hidden" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                    </button>
                </form>
            </div>

            <div class="px-8 py-4 bg-slate-800/50 border-t border-white/5 text-center">
                <p class="text-gray-500 text-sm">© 2025 Website Du lịch Phước Hải</p>
            </div>
        </div>
    </div>

    <script src="/js/auth.js"></script>
    <script src="/js/login.js"></script>
</body>

</html>
