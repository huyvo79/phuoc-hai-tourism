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
                    // --- SỬA Ở ĐÂY: Ép kiểu để nhận diện đúng Admin/Guest ---
                    const isAdmin = (msg.is_admin == 1 || msg.is_admin === 'true' || msg.is_admin === true);

                    appendClientMessage(msg.message, isAdmin ? 'admin' : 'guest');
                });
            })
            .catch(err => console.error("Lỗi tải lịch sử:", err));
    }

    // 3. Lắng nghe tin nhắn từ Admin (Reverb)
    if (window.Echo) {
        window.Echo.channel(`chat.${guestId}`)
            .listen('MessageSent', (e) => {
                console.log('Tin mới:', e);

                // --- SỬA Ở ĐÂY: Kiểm tra kỹ lưỡng biến is_admin ---
                const isAdmin = (e.is_admin == 1 || e.is_admin === 'true' || e.is_admin === true);

                // Chỉ hiện thông báo/append tin nhắn NẾU ĐÚNG LÀ ADMIN
                if (isAdmin) {
                    appendClientMessage(e.message, 'admin');

                    // Lấy element khung chat và chấm đỏ
                    const chatBox = document.getElementById('chat-box');
                    const notificationDot = document.getElementById('chat-notification');

                    // Logic: Nếu chat đang đóng thì hiện chấm đỏ
                    if (chatBox && chatBox.classList.contains('hidden')) {
                        if (notificationDot) {
                            notificationDot.classList.remove('hidden'); // HIỆN chấm đỏ
                        }
                    }
                }
                // Nếu không phải admin (tức là tin của chính mình gửi từ tab khác), 
                // bạn có thể handle thêm ở đây nếu muốn, nhưng thường thì không cần 
                // vì form submit đã append rồi.
            });
    }

    // 4. Xử lý gửi tin (Không đổi)
    const form = document.getElementById('chat-form');
    if (form) {
        // Tìm input bên trong form (đề phòng form không có id input cụ thể)
        const input = form.querySelector('input') || document.getElementById('chat-input');

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            // Nếu không tìm thấy input thì return
            if (!input) return;

            const message = input.value.trim();
            if (!message) return;

            // Tin mình gửi thì luôn là 'guest'
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

// Hàm Toggle Box Chat (Giữ nguyên)
window.toggleChat = function () {
    const chatBox = document.getElementById('chat-box');
    const chatMessages = document.getElementById('chat-messages');
    const notificationDot = document.getElementById('chat-notification');

    if (chatBox) {
        const isHidden = chatBox.classList.contains('hidden');

        if (isHidden) {
            chatBox.classList.remove('hidden');
            if (notificationDot) notificationDot.classList.add('hidden');
            if (chatMessages) {
                setTimeout(() => {
                    chatMessages.scrollTop = chatMessages.scrollHeight;
                }, 0);
            }
        } else {
            chatBox.classList.add('hidden');
        }
    }
}

// Hàm appendClientMessage (Giữ nguyên logic render)
function appendClientMessage(text, sender) {
    const container = document.getElementById('chat-messages');
    if (!container) return;

    let html = '';
    if (sender === 'admin') {
        // ADMIN: Bên trái, màu xám/tối
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
        // GUEST (Mình): Bên phải, màu xanh
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