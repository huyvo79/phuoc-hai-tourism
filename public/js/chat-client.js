document.addEventListener('DOMContentLoaded', function () {
    // 1. Định danh Khách (Tạo UUID nếu chưa có)
    let guestId = localStorage.getItem('chat_session_id');
    if (!guestId) {
        guestId = crypto.randomUUID();
        localStorage.setItem('chat_session_id', guestId);
    }
    
    // Lưu session ID vào biến global để tiện dùng
    window.chatSessionId = guestId;

    // 2. Lắng nghe tin nhắn từ Server (Reverb)
    // Kênh: chat.{uuid}
    // Sự kiện: MessageSent (chú ý namespace: .MessageSent hoặc tên class event)
    window.Echo.channel(`chat.${guestId}`)
        .listen('MessageSent', (e) => {
            console.log('Tin nhắn mới:', e);
            appendMessage(e.message, e.is_admin ? 'admin' : 'guest');
        });

    // 3. Xử lý gửi tin nhắn
    const form = document.getElementById('chat-form');
    const input = form.querySelector('input');

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        const message = input.value;
        if (!message) return;

        // Hiển thị ngay lên giao diện (Optimistic UI)
        appendMessage(message, 'guest');
        input.value = ''; // Xóa ô nhập

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
        .then(response => response.json())
        .catch(error => console.error('Lỗi:', error));
    });
});

// Hàm vẽ tin nhắn ra HTML (Dựa trên giao diện bạn đã gửi)
function appendMessage(text, sender) {
    const container = document.getElementById('chat-messages');
    let html = '';

    if (sender === 'admin') {
        // Tin nhắn Admin (Bên Trái)
        html = `
            <div class="flex items-end gap-2 fade-in">
                <div class="w-6 h-6 rounded-full bg-cyan-500/20 flex items-center justify-center text-cyan-400 text-xs shrink-0">
                    <i class="fas fa-user-tie"></i>
                </div>
                <div class="bg-slate-700/50 text-slate-200 px-4 py-2 rounded-2xl rounded-bl-none max-w-[80%] text-sm border border-white/5">
                    ${text}
                </div>
            </div>`;
    } else {
        // Tin nhắn Khách (Bên Phải)
        html = `
            <div class="flex items-end gap-2 justify-end fade-in">
                <div class="bg-gradient-to-r from-cyan-500 to-blue-500 text-white px-4 py-2 rounded-2xl rounded-br-none max-w-[80%] text-sm shadow-lg shadow-blue-500/20">
                    ${text}
                </div>
            </div>`;
    }

    container.insertAdjacentHTML('beforeend', html);
    // Tự động cuộn xuống cuối
    container.scrollTop = container.scrollHeight;
}