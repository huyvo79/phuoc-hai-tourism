@extends('layouts.dashboard')

@section('content')
    <div class="flex h-[calc(100vh-theme(spacing.32))] gap-6">

        <div
            class="w-1/3 flex flex-col bg-slate-800/50 backdrop-blur-xl border border-white/10 rounded-2xl overflow-hidden shadow-xl">
            <div class="p-4 border-b border-white/10">
                <h2 class="text-lg font-bold text-white mb-3 flex items-center gap-2">
                    <i class="fas fa-inbox text-purple-400"></i> Tin nhắn khách
                </h2>
                <div class="relative">
                    <i class="fas fa-search absolute left-3 top-3 text-slate-400 text-xs"></i>
                    <input type="text" placeholder="Tìm kiếm khách..."
                        class="w-full bg-slate-900/50 text-white text-sm rounded-lg pl-9 pr-3 py-2.5 focus:outline-none focus:ring-1 focus:ring-purple-500 border border-white/5 placeholder-slate-500 transition-all">
                </div>
            </div>

            <div id="sessions-list" class="flex-1 overflow-y-auto custom-scrollbar p-2 space-y-1">
                <div class="text-center text-gray-500 mt-4 text-xs">Đang tải danh sách...</div>
            </div>
        </div>

        <div
            class="w-2/3 flex flex-col bg-slate-800/50 backdrop-blur-xl border border-white/10 rounded-2xl overflow-hidden shadow-xl">

            <div class="p-4 border-b border-white/10 flex justify-between items-center bg-white/5">
                <div class="flex items-center gap-3">
                    <img src="https://ui-avatars.com/api/?name=Khach&background=random"
                        class="w-10 h-10 rounded-full ring-2 ring-purple-500/30">
                    <div>
                        <h3 id="current-chat-name" class="text-white font-bold text-sm">Chọn khách để chat</h3>
                        <div class="flex items-center gap-1.5">
                            <span class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse"></span>
                            <span class="text-xs text-gray-400">Trực tuyến</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex-1 overflow-y-auto p-6 space-y-6 custom-scrollbar bg-slate-900/30" id="admin-chat-body">
                <div class="flex h-full items-center justify-center text-gray-500 flex-col gap-2">
                    <i class="fas fa-comments text-4xl mb-2 opacity-50"></i>
                    <p>Vui lòng chọn một khách hàng để bắt đầu</p>
                </div>
            </div>

            <div class="p-4 bg-slate-800/80 border-t border-white/10">
                <form id="admin-chat-form" class="flex gap-3">
                    <div class="flex-1 relative">
                        <input type="text" id="admin-chat-input" placeholder="Nhập câu trả lời..." disabled
                            class="w-full bg-slate-900 text-white text-sm rounded-xl pl-4 pr-10 py-3 focus:outline-none focus:ring-1 focus:ring-purple-500 border border-white/10 placeholder-slate-500 shadow-inner disabled:opacity-50">
                    </div>
                    <button type="submit" disabled id="admin-send-btn"
                        class="w-12 h-12 bg-gradient-to-r from-purple-500 to-blue-500 rounded-xl flex items-center justify-center text-white shadow-lg shadow-purple-500/30 hover:shadow-purple-500/50 hover:scale-105 transition-all disabled:opacity-50">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 20px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }
    </style>

    <script type="module">
        let currentGuestId = null;

        document.addEventListener('DOMContentLoaded', function () {
            // 1. Tải danh sách khách hàng ngay khi vào trang
            loadSessions();

            // Tự động cập nhật danh sách mỗi 5 giây (để biết có tin mới)
            setInterval(loadSessions, 5000);

            // 2. Xử lý Admin gửi tin nhắn (Trả lời)
            const form = document.getElementById('admin-chat-form');
            const input = document.getElementById('admin-chat-input');

            form.addEventListener('submit', function (e) {
                e.preventDefault();
                const message = input.value.trim();
                if (!message || !currentGuestId) return;

                // Hiện tin nhắn lên màn hình ngay
                appendMessage(message, 'admin');
                input.value = '';

                // Gửi API Admin Reply
                fetch('/api/chat/admin-reply', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ session_id: currentGuestId, message: message })
                })
                    .then(res => res.json())
                    .then(data => {
                        console.log("Admin sent:", data);
                        loadSessions(); // Cập nhật lại thứ tự tin nhắn
                    })
                    .catch(err => console.error("Lỗi gửi tin:", err));
            });
        });

        // 3. Hàm tải danh sách các phiên chat (Sidebar bên trái)
        function loadSessions() {
            fetch('/api/chat/sessions')
                .then(res => res.json())
                .then(data => {
                    const list = document.getElementById('sessions-list');
                    // Nếu không có ai chat
                    if (data.length === 0) {
                        list.innerHTML = '<div class="text-center text-gray-500 mt-4 text-xs">Chưa có tin nhắn nào</div>';
                        return;
                    }

                    // Xóa danh sách cũ và vẽ lại
                    list.innerHTML = '';

                    data.forEach(session => {
                        // Kiểm tra xem khách này có đang được chọn không để tô màu
                        const isActive = currentGuestId === session.id ? 'bg-slate-700 border-purple-500/50' : 'border-transparent hover:bg-white/5';

                        // Lấy tin nhắn cuối cùng để hiển thị preview
                        const lastMsg = session.messages && session.messages.length > 0 ? session.messages[0].message : '...';

                        const html = `
                            <div onclick="selectGuest('${session.id}', '${session.name}')" 
                                 class="cursor-pointer ${isActive} border p-3 rounded-xl flex items-center gap-3 transition-all mb-1">
                                <div class="relative shrink-0">
                                    <img src="https://ui-avatars.com/api/?name=${encodeURIComponent(session.name)}&background=random" class="w-10 h-10 rounded-full">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-white font-medium text-sm truncate">${session.name}</h4>
                                    <p class="text-xs text-gray-400 truncate">${lastMsg}</p>
                                </div>
                            </div>
                        `;
                        list.insertAdjacentHTML('beforeend', html);
                    });
                })
                .catch(err => console.error("Lỗi tải sessions:", err));
        }

        // 4. Hàm chọn khách để bắt đầu chat (Được gọi khi click vào sidebar)
        window.selectGuest = function (id, name) {
            currentGuestId = id;
            document.getElementById('current-chat-name').innerText = name || 'Khách hàng';

            // Mở khóa ô nhập liệu
            document.getElementById('admin-chat-input').disabled = false;
            document.getElementById('admin-send-btn').disabled = false;

            // Hiện loading
            const body = document.getElementById('admin-chat-body');
            body.innerHTML = '<div class="flex h-full items-center justify-center text-gray-500">Đang tải lịch sử...</div>';

            // Tải lịch sử chat của khách này
            fetch(`/api/chat/history/${id}`)
                .then(res => res.json())
                .then(msgs => {
                    body.innerHTML = ''; // Xóa loading
                    msgs.forEach(msg => appendMessage(msg.message, msg.is_admin ? 'admin' : 'guest'));

                    // Cuộn xuống cuối
                    body.scrollTop = body.scrollHeight;
                });

            // KẾT NỐI REAL-TIME (Reverb) CHO KHÁCH NÀY
            if (window.Echo) {
                window.Echo.leaveAllChannels(); // Ngắt kết nối người cũ
                window.Echo.channel(`chat.${id}`)
                    .listen('MessageSent', (e) => {
                        console.log("Admin nhận tin mới:", e);
                        // Nếu tin nhắn KHÔNG PHẢI do admin gửi thì hiện lên (tránh hiện 2 lần)
                        if (!e.is_admin) {
                            appendMessage(e.message, 'guest');
                            // Phát âm thanh thông báo nếu cần
                        }
                        loadSessions(); // Cập nhật lại sidebar
                    });
            }

            // Vẽ lại sidebar để highlight người đang chọn
            loadSessions();
        }

        // 5. Hàm vẽ tin nhắn ra màn hình Admin
        function appendMessage(text, sender) {
            const body = document.getElementById('admin-chat-body');
            let html = '';
            if (sender === 'admin') {
                // Tin Admin (Bên phải - Màu tím)
                html = `
                <div class="flex items-start gap-3 justify-end">
                    <div class="flex flex-col items-end gap-1 max-w-[70%]">
                        <div class="bg-gradient-to-r from-purple-600 to-blue-600 p-3 rounded-2xl rounded-tr-none text-sm text-white shadow-lg">
                            ${text}
                        </div>
                    </div>
                </div>`;
            } else {
                // Tin Khách (Bên trái - Màu xám)
                html = `
                <div class="flex items-start gap-3">
                    <img src="https://ui-avatars.com/api/?name=Khach&background=random" class="w-8 h-8 rounded-full mt-1">
                    <div class="flex flex-col items-start gap-1 max-w-[70%]">
                        <div class="bg-slate-700/80 p-3 rounded-2xl rounded-tl-none text-sm text-gray-200 shadow-sm border border-white/5">
                            ${text}
                        </div>
                    </div>
                </div>`;
            }
            body.insertAdjacentHTML('beforeend', html);
            body.scrollTop = body.scrollHeight;
        }
    </script>
@endsection