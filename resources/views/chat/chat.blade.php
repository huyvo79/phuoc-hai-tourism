@extends('layouts.dashboard')

@section('content')
    {{-- 
        1. h-[calc(100vh-90px)]: Tăng chiều cao lên 1 chút (giảm trừ ít hơn).
        2. flex-col lg:flex-row: Responsive (điện thoại xếp dọc, PC xếp ngang).
        3. gap-4: Khoảng cách vừa phải hơn.
    --}}
    <div class="flex flex-col lg:flex-row h-[calc(100vh-10px)] gap-1">

        {{-- CỘT TRÁI (DANH SÁCH): w-full lg:w-[350px] --}}
        <div class="w-full lg:w-[230px] shrink-0 flex flex-col bg-slate-800/50 backdrop-blur-xl border border-white/10 rounded-2xl overflow-hidden shadow-xl">
            <div class="p-4 border-b border-white/10 shrink-0">
                <h2 class="text-lg font-bold text-white mb-3 flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-purple-500/20 flex items-center justify-center">
                        <i class="fas fa-inbox text-purple-400"></i>
                    </div>
                    Tin nhắn khách
                </h2>
                <div class="relative group">
                    <i class="fas fa-search absolute left-3 top-3 text-slate-400 text-xs group-focus-within:text-purple-400 transition-colors"></i>
                    <input type="text" placeholder="Tìm kiếm tên..."
                        class="w-full bg-slate-900/50 text-white text-sm rounded-xl pl-9 pr-3 py-2.5 focus:outline-none focus:ring-1 focus:ring-purple-500 border border-white/5 placeholder-slate-500 transition-all">
                </div>
            </div>

            <div id="sessions-list" class="flex-1 overflow-y-auto custom-scrollbar p-3 space-y-1">
                <div class="text-center text-gray-500 mt-10 text-sm flex flex-col items-center">
                    <i class="fas fa-circle-notch fa-spin mb-2"></i>
                    Đang tải danh sách...
                </div>
            </div>
        </div>

        {{-- CỘT PHẢI (CHAT BOX): flex-1 (Tự lấp đầy khoảng trống) --}}
        <div class="flex-1 flex flex-col bg-slate-800/50 backdrop-blur-xl border border-white/10 rounded-2xl overflow-hidden shadow-xl min-w-0">
            
            <div class="h-16 px-6 border-b border-white/10 flex justify-between items-center bg-white/5 shrink-0">
                <div class="flex items-center gap-3">
                    <div class="relative">
                        <img id="header-avatar" src="https://ui-avatars.com/api/?name=Khach&background=random"
                            class="w-10 h-10 rounded-full ring-2 ring-purple-500/30">
                        <span class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-green-500 border-2 border-slate-800 rounded-full"></span>
                    </div>
                    <div>
                        <h3 id="current-chat-name" class="text-white font-bold text-base">Chọn khách để chat</h3>
                        <div class="flex items-center gap-1.5">
                            <span class="text-xs text-green-400 font-medium">Đang hoạt động</span>
                        </div>
                    </div>
                </div>
                
                <!-- <div class="flex gap-2">
                    <button class="w-8 h-8 rounded-full hover:bg-white/10 text-slate-400 flex items-center justify-center transition">
                        <i class="fas fa-phone"></i>
                    </button>
                    <button class="w-8 h-8 rounded-full hover:bg-white/10 text-slate-400 flex items-center justify-center transition">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                </div> -->
            </div>

            <div class="flex-1 overflow-y-auto p-6 space-y-6 custom-scrollbar bg-slate-900/30" id="admin-chat-body">
                <div class="flex h-full items-center justify-center text-slate-500 flex-col gap-3">
                    <div class="w-20 h-20 bg-slate-800 rounded-full flex items-center justify-center mb-2">
                        <i class="fas fa-comments text-4xl opacity-50 text-purple-400"></i>
                    </div>
                    <p class="text-sm font-medium">Chưa chọn đoạn chat nào</p>
                </div>
            </div>

            <div class="p-4 bg-slate-800/80 border-t border-white/10 shrink-0">
                <form id="admin-chat-form" class="flex gap-3 items-end">
                    <div class="flex-1 relative bg-slate-900 rounded-xl border border-white/10 focus-within:border-purple-500/50 transition-colors">
                        <input type="text" id="admin-chat-input" placeholder="Nhập tin nhắn phản hồi..." disabled
                            class="w-full bg-transparent text-white text-sm px-4 py-3.5 focus:outline-none placeholder-slate-500 disabled:opacity-50">
                    </div>
                    <button type="submit" disabled id="admin-send-btn"
                        class="w-12 h-12 shrink-0 bg-gradient-to-r from-purple-600 to-blue-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-purple-500/20 hover:shadow-purple-500/40 hover:scale-105 transition-all disabled:opacity-50 disabled:hover:scale-100 disabled:grayscale">
                        <i class="fas fa-paper-plane text-lg"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 5px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background-color: rgba(255, 255, 255, 0.1); border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background-color: rgba(255, 255, 255, 0.2); }
    </style>

    <script src="{{ asset('js/admin-chat.js') }}"></script>
@endsection