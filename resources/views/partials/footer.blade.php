<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer Phước Hải - Modern & Original Content</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body>

    <div class="h-1.5 w-full bg-gradient-to-r from-cyan-400 via-blue-500 to-indigo-600"></div>

    <footer class="bg-[#0f172a] text-slate-400 py-16 font-sans" id="contact">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 mb-12">

                <div class="flex flex-col justify-start">
                    <h3 class="text-white text-2xl font-bold mb-6 tracking-tight">
                        Chào mừng bạn đến với xã Phước Hải!
                        <span class="text-cyan-400">.</span>
                    </h3>
                    <p class="text-base leading-relaxed text-slate-400 max-w-md border-l-2 border-cyan-500/30 pl-4">
                        Hãy cùng khám phá các điểm đến thú vị, món ăn ngon và dịch vụ an toàn chỉ với một lần quét mã
                        QR.
                    </p>
                </div>

                <div class="flex flex-col items-start md:items-end text-left md:text-right">
                    <h3 class="text-white text-2xl font-bold mb-6 tracking-tight">
                        Liên hệ với chúng tôi
                    </h3>

                    <p class="text-base leading-relaxed text-slate-400 mb-6 max-w-lg">
                        Mọi thông tin góp ý liên hệ qua Đoàn cơ sở xã Phước Hải, hoặc qua sdt
                        <a href="tel:0962110192"
                            class="text-cyan-400 font-bold hover:text-cyan-300 transition-colors inline-block border-b border-transparent hover:border-cyan-300">
                            0962 110 192
                        </a>
                        (Trung – Chuyên viên MTTQ)
                    </p>

                    <div class="flex gap-4">
                        <a href="#"
                            class="group w-10 h-10 flex items-center justify-center rounded-lg bg-slate-800 text-slate-400 hover:bg-blue-600 hover:text-white transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:shadow-blue-500/30 ring-1 ring-white/5">
                            <i class="fa-brands fa-facebook-f text-xl"></i>
                        </a>

                        <a href="#"
                            class="group w-10 h-10 flex items-center justify-center rounded-lg bg-slate-800 text-slate-400 hover:bg-pink-500 hover:text-white transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:shadow-pink-500/30 ring-1 ring-white/5">
                            <i class="fa-brands fa-instagram text-xl"></i>
                        </a>

                        <a href="#"
                            class="group w-10 h-10 flex items-center justify-center rounded-lg bg-slate-800 text-slate-400 hover:bg-black hover:text-white transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:shadow-gray-900/30 ring-1 ring-white/5">
                            <i class="fa-brands fa-tiktok text-xl"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="border-t border-slate-800 pt-8 text-center">
                <p class="text-sm text-slate-500">
                    &copy; 2026 PhuocHai. Tất cả quyền được bảo lưu.
                </p>
            </div>
        </div>
    </footer>
    <div class="fixed bottom-6 right-6 z-50 flex flex-col items-end space-y-4 font-sans">

        <div id="chat-box"
            class="hidden w-[350px] h-[450px] bg-slate-900 border border-slate-700 rounded-2xl shadow-2xl flex flex-col overflow-hidden ring-1 ring-white/10 transition-all duration-300 transform origin-bottom-right">

            <div class="bg-gradient-to-r from-blue-600 to-cyan-500 p-4 flex justify-between items-center shadow-lg">
                <div class="flex items-center gap-3">
                    <div class="relative">
                        <div
                            class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center backdrop-blur-sm">
                            <i class="fas fa-headset text-white text-lg"></i>
                        </div>
                        <span
                            class="absolute bottom-0 right-0 w-3 h-3 bg-green-400 border-2 border-blue-600 rounded-full"></span>
                    </div>
                    <div>
                        <h4 class="font-bold text-white text-sm">Hỗ trợ Phước Hải</h4>
                        <p class="text-xs text-blue-100">Chúng tôi đang online</p>
                    </div>
                </div>
                <button onclick="toggleChat()"
                    class="text-white/80 hover:text-white hover:bg-white/10 p-2 rounded-lg transition">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="flex-1 bg-slate-800 p-4 overflow-y-auto space-y-4 scrollbar-thin scrollbar-thumb-slate-600 scrollbar-track-transparent"
                id="chat-messages">

                <div class="flex items-end gap-2">
                    <div
                        class="w-6 h-6 rounded-full bg-cyan-500/20 flex items-center justify-center text-cyan-400 text-xs shrink-0">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <div
                        class="bg-slate-700/50 text-slate-200 px-4 py-2 rounded-2xl rounded-bl-none max-w-[80%] text-sm border border-white/5">
                        Xin chào! Tôi có thể giúp gì cho bạn khi đến tham quan Phước Hải ạ?
                    </div>
                </div>

                <div class="flex items-end gap-2 justify-end">
                    <div
                        class="bg-gradient-to-r from-cyan-500 to-blue-500 text-white px-4 py-2 rounded-2xl rounded-br-none max-w-[80%] text-sm shadow-lg shadow-blue-500/20">
                        Cho mình hỏi đường đến chợ hải sản với?
                    </div>
                </div>
            </div>

            <div class="p-3 bg-slate-900 border-t border-slate-700">
                <form id="chat-form" class="flex gap-2">
                    <input type="text" placeholder="Nhập tin nhắn..."
                        class="flex-1 bg-slate-800 text-slate-200 text-sm rounded-xl px-4 py-3 focus:outline-none focus:ring-1 focus:ring-cyan-500 border border-slate-700 placeholder-slate-500">
                    <button type="button"
                        class="bg-cyan-500 hover:bg-cyan-400 text-white w-12 rounded-xl flex items-center justify-center transition-all shadow-lg shadow-cyan-500/20">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </form>
                <div class="text-center mt-2">
                    <p class="text-[10px] text-slate-500">Được hỗ trợ bởi Phước Hải Travel</p>
                </div>
            </div>
        </div>

        <button onclick="toggleChat()" id="chat-toggle-btn"
            class="group w-14 h-14 bg-gradient-to-r from-cyan-400 to-blue-600 rounded-full flex items-center justify-center shadow-lg shadow-blue-500/40 hover:scale-110 transition-all duration-300 ring-4 ring-slate-900 relative">
            <i class="fas fa-comment-dots text-2xl text-white group-hover:rotate-12 transition-transform"></i>

            <span
                class="absolute top-0 right-0 w-4 h-4 bg-red-500 border-2 border-slate-900 rounded-full animate-bounce"></span>
        </button>
    </div>

    <script type="module">
        document.addEventListener('DOMContentLoaded', function () {
            // 1. Định danh Khách (Tạo UUID nếu chưa có)
            let guestId = localStorage.getItem('chat_session_id');
            if (!guestId) {
                guestId = crypto.randomUUID();
                localStorage.setItem('chat_session_id', guestId);
            }

            // 2. Load lịch sử chat cũ (nếu khách F5 trang)
            const chatContainer = document.getElementById('chat-messages');
            fetch(`/api/chat/history/${guestId}`)
                .then(res => res.json())
                .then(messages => {
                    chatContainer.innerHTML = ''; // Clear mẫu
                    messages.forEach(msg => {
                        appendClientMessage(msg.message, msg.is_admin ? 'admin' : 'guest');
                    });
                });

            // 3. Lắng nghe tin nhắn từ Admin (Reverb)
            window.Echo.channel(`chat.${guestId}`)
                .listen('MessageSent', (e) => {
                    console.log('Tin mới:', e);
                    // Nếu tin nhắn là của admin thì hiển thị
                    if (e.is_admin) {
                        appendClientMessage(e.message, 'admin');
                        // Mở box chat lên nếu đang đóng và có tin nhắn tới
                        const chatBox = document.getElementById('chat-box');
                        if (chatBox.classList.contains('hidden')) {
                            toggleChat();
                        }
                    }
                });

            // 4. Xử lý gửi tin nhắn
            const form = document.getElementById('chat-form');
            const input = form.querySelector('input');

            form.addEventListener('submit', function (e) {
                e.preventDefault(); // Chặn load lại trang
                const message = input.value.trim();
                if (!message) return;

                // Hiển thị ngay lên giao diện
                appendClientMessage(message, 'guest');
                input.value = '';

                // Gửi API lên Server
                fetch('/api/chat/guest-send', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        session_id: guestId,
                        message: message
                    })
                })
                    .catch(error => console.error('Lỗi:', error));
            });
        });

        // Hàm Toggle Box Chat
        window.toggleChat = function () {
            const chatBox = document.getElementById('chat-box');
            chatBox.classList.toggle('hidden');
        }

        // Hàm vẽ tin nhắn cho Client
        function appendClientMessage(text, sender) {
            const container = document.getElementById('chat-messages');
            let html = '';

            if (sender === 'admin') {
                html = `
                <div class="flex items-end gap-2">
                    <div class="w-6 h-6 rounded-full bg-cyan-500/20 flex items-center justify-center text-cyan-400 text-xs shrink-0">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <div class="bg-slate-700/50 text-slate-200 px-4 py-2 rounded-2xl rounded-bl-none max-w-[80%] text-sm border border-white/5">
                        ${text}
                    </div>
                </div>`;
            } else {
                html = `
                <div class="flex items-end gap-2 justify-end">
                    <div class="bg-gradient-to-r from-cyan-500 to-blue-500 text-white px-4 py-2 rounded-2xl rounded-br-none max-w-[80%] text-sm shadow-lg shadow-blue-500/20">
                        ${text}
                    </div>
                </div>`;
            }

            container.insertAdjacentHTML('beforeend', html);
            container.scrollTop = container.scrollHeight;
        }
    </script>

</body>

</html>