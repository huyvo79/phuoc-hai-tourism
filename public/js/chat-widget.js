document.addEventListener('DOMContentLoaded', function () {
    // 1: Định danh khách
    let guestId = localStorage.getItem('chat_session_id');
    if (!guestId) {
        guestId = crypto.randomUUID();
        localStorage.setItem('chat_session_id', guestId);
    }

    // 2: Load lịch sử
    const chatContainer = document.getElementById('chat-messages');
    if (chatContainer) {
        fetch(`/api/chat/history/${guestId}`)
            .then(res => res.json())
            .then(messages => {
                chatContainer.innerHTML = '';
                messages.forEach(msg => {
                    appendClientMessage(msg.message, msg.is_admin ? 'admin' : 'guest');
                });
            })
            .catch(err => console.error("Lỗi tải lịch sử:", err));
    }

    // 3. Lắng nghe tin nhắn từ Admin (Reverb)
    if (window.Echo) {
        window.Echo.channel(`chat.${guestId}`)
            .listen('MessageSent', (e) => {
                console.log('Tin mới:', e);

                if (e.is_admin) {
                    appendClientMessage(e.message, 'admin');

                    // Lấy element khung chat và chấm đỏ
                    const chatBox = document.getElementById('chat-box');
                    const notificationDot = document.getElementById('chat-notification');

                    // Logic mới: Nếu chat đang đóng thì hiện chấm đỏ
                    if (chatBox && chatBox.classList.contains('hidden')) {
                        if (notificationDot) {
                            notificationDot.classList.remove('hidden'); // HIỆN chấm đỏ
                        }
                    }
                }
            });
    }

    // ... (Phần 4: Xử lý gửi tin - Giữ nguyên) ...
    const form = document.getElementById('chat-form');
    if (form) {
        const input = form.querySelector('input');
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            const message = input.value.trim();
            if (!message) return;

            appendClientMessage(message, 'guest');
            input.value = '';

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
            }).catch(error => console.error('Lỗi gửi tin:', error));
        });
    }
});

// Hàm Toggle Box Chat
window.toggleChat = function () {
    const chatBox = document.getElementById('chat-box');
    const chatMessages = document.getElementById('chat-messages'); // Lấy khung chứa tin nhắn
    const notificationDot = document.getElementById('chat-notification'); // Lấy chấm đỏ

    if (chatBox) {
        // Kiểm tra xem hiện tại đang ẩn hay hiện
        const isHidden = chatBox.classList.contains('hidden');

        if (isHidden) {
            // 1. Mở Chat
            chatBox.classList.remove('hidden');

            // 2. Ẩn chấm đỏ thông báo (nếu có)
            if (notificationDot) {
                notificationDot.classList.add('hidden');
            }

            // 3. Cuộn xuống dưới cùng
            // Dùng setTimeout để đảm bảo DOM đã hiển thị xong chiều cao mới cuộn được
            if (chatMessages) {
                setTimeout(() => {
                    chatMessages.scrollTop = chatMessages.scrollHeight;
                }, 0);
            }

        } else {
            // Đóng Chat
            chatBox.classList.add('hidden');
        }
    }
}

// ... (Hàm appendClientMessage - Giữ nguyên) ...
function appendClientMessage(text, sender) {
    const container = document.getElementById('chat-messages');
    if (!container) return;

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