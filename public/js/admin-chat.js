let currentGuestId = null;

document.addEventListener('DOMContentLoaded', function () {
    // 1. Tải danh sách
    loadSessions();
    setInterval(loadSessions, 5000);

    // 2. Xử lý gửi tin
    const form = document.getElementById('admin-chat-form');
    const input = document.getElementById('admin-chat-input');

    if (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            const message = input.value.trim();
            if (!message || !currentGuestId) return;

            appendMessage(message, 'admin');
            input.value = '';

            fetch('/api/chat/admin-reply', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ session_id: currentGuestId, message: message })
            })
                .then(res => res.json())
                .then(data => { loadSessions(); })
                .catch(err => console.error("Lỗi gửi tin:", err));
        });
    }
});

// --- HÀM 1: TẠO MÀU CỐ ĐỊNH TỪ ID (Thay thế cho random) ---
function stringToColor(str) {
    if (!str) return '6b7280'; // Màu xám mặc định nếu lỗi
    let hash = 0;
    for (let i = 0; i < str.length; i++) {
        hash = str.charCodeAt(i) + ((hash << 5) - hash);
    }
    let color = '';
    for (let i = 0; i < 3; i++) {
        let value = (hash >> (i * 8)) & 0xFF;
        color += ('00' + value.toString(16)).substr(-2);
    }
    return color;
}

// --- HÀM 2: FORMAT TÊN ---
function formatGuestName(id) {
    if (!id) return "Khách hàng";
    const shortId = id.substring(0, 6).toUpperCase();
    return `Khách - ${shortId}`;
}

// 3. Hàm tải danh sách (SIDEBAR)
function loadSessions() {
    fetch('/api/chat/sessions')
        .then(res => res.json())
        .then(data => {
            const list = document.getElementById('sessions-list');
            if (!list) return;

            if (data.length === 0) {
                list.innerHTML = '<div class="text-center text-gray-500 mt-4 text-xs">Chưa có tin nhắn nào</div>';
                return;
            }

            list.innerHTML = '';

            data.forEach(session => {
                const isActive = currentGuestId === session.id ? 'bg-slate-700 border-purple-500/50' : 'border-transparent hover:bg-white/5';
                const lastMsg = session.messages && session.messages.length > 0 ? session.messages[0].message : '...';

                const displayName = formatGuestName(session.id);

                // TẠO MÀU DỰA TRÊN ID
                const bgHex = stringToColor(session.id);
                // URL KHÔNG CÒN "random" NỮA MÀ DÙNG MÃ MÀU VỪA TẠO
                const avatarUrl = `https://ui-avatars.com/api/?name=${encodeURIComponent(displayName)}&background=${bgHex}&color=fff&size=128`;

                const html = `
                    <div onclick="selectGuest('${session.id}', '${displayName}')" 
                         class="cursor-pointer ${isActive} border p-3 rounded-xl flex items-center gap-3 transition-all mb-1">
                        <div class="relative shrink-0">
                            <img src="${avatarUrl}" class="w-10 h-10 rounded-full">
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="text-white font-medium text-sm truncate">${displayName}</h4>
                            <p class="text-xs text-gray-400 truncate">${lastMsg}</p>
                        </div>
                    </div>
                `;
                list.insertAdjacentHTML('beforeend', html);
            });
        })
        .catch(err => console.error("Lỗi tải sessions:", err));
}

// 4. Hàm chọn khách (HEADER CHAT)
window.selectGuest = function (id, name) {
    currentGuestId = id;
    const safeName = name || formatGuestName(id);

    // Tính toán lại màu cho khớp với sidebar
    const bgHex = stringToColor(id);

    const nameEl = document.getElementById('current-chat-name');
    const inputEl = document.getElementById('admin-chat-input');
    const btnEl = document.getElementById('admin-send-btn');
    const bodyEl = document.getElementById('admin-chat-body');

    // --- SỬA Ở ĐÂY: Chọn bằng ID thay vì class cũ ---
    const headerImg = document.getElementById('header-avatar');

    if (nameEl) nameEl.innerText = safeName;

    // Cập nhật ảnh Header
    if (headerImg) {
        // Cập nhật URL ảnh với tên và màu đã tính toán
        headerImg.src = `https://ui-avatars.com/api/?name=${encodeURIComponent(safeName)}&background=${bgHex}&color=fff&size=128`;
    }

    if (inputEl) inputEl.disabled = false;
    if (btnEl) btnEl.disabled = false;

    // Loading
    if (bodyEl) bodyEl.innerHTML = '<div class="flex h-full items-center justify-center text-gray-500">Đang tải lịch sử...</div>';

    fetch(`/api/chat/history/${id}`)
        .then(res => res.json())
        .then(msgs => {
            if (bodyEl) {
                bodyEl.innerHTML = '';
                msgs.forEach(msg => appendMessage(msg.message, msg.is_admin ? 'admin' : 'guest'));
                bodyEl.scrollTop = bodyEl.scrollHeight;
            }
        });

    if (window.Echo) {
        window.Echo.leaveAllChannels();
        window.Echo.channel(`chat.${id}`)
            .listen('MessageSent', (e) => {
                if (!e.is_admin) appendMessage(e.message, 'guest');
                loadSessions();
            });
    }
    loadSessions();
}

// 5. Hàm vẽ tin nhắn (CHAT BUBBLE)
function appendMessage(text, sender) {
    const body = document.getElementById('admin-chat-body');
    if (!body) return;

    let html = '';
    if (sender === 'admin') {
        html = `
        <div class="flex items-start gap-3 justify-end">
            <div class="flex flex-col items-end gap-1 max-w-[70%]">
                <div class="bg-gradient-to-r from-purple-600 to-blue-600 p-3 rounded-2xl rounded-tr-none text-sm text-white shadow-lg">
                    ${text}
                </div>
            </div>
        </div>`;
    } else {
        // Lấy lại màu từ ID hiện tại để đồng bộ
        const guestName = formatGuestName(currentGuestId);
        const bgHex = stringToColor(currentGuestId);
        const avatarUrl = `https://ui-avatars.com/api/?name=${encodeURIComponent(guestName)}&background=${bgHex}&color=fff`;

        html = `
        <div class="flex items-start gap-3">
            <img src="${avatarUrl}" class="w-8 h-8 rounded-full mt-1">
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