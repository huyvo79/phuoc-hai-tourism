/* ===============================
   CONFIG
================================ */
const API_BASE = '/api/users';

/* ===============================
   STATE QUẢN LÝ
================================ */
let currentPage = 1;
let currentSearch = '';
let currentLimit = 5;
/* ===============================
   HÀM XỬ LÝ KHI CHỌN SELECT BOX
================================ */
// Thêm hàm này để bắt sự kiện onchange từ HTML
function changeLimit(newLimit) {
    currentLimit = parseInt(newLimit); // Cập nhật limit mới
    fetchUsers(1, currentSearch);      // Reset về trang 1 với limit mới
}
/* ===============================
   FETCH WRAPPER (COOKIE JWT)
================================ */
async function apiFetch(url, options = {}) {
    const response = await fetch(url, {
        credentials: 'same-origin',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
        },
        ...options,
    });

    if (response.status === 401) {
        Swal.fire(
            'Phiên đăng nhập hết hạn',
            'Vui lòng đăng nhập lại',
            'warning'
        ).then(() => {
            window.location.href = '/admin/login';
        });
        throw new Error('Unauthorized');
    }

    return response.json();
}

/* ===============================
   LOAD USERS
================================ */
async function fetchUsers(page = 1, search = '') {
    try {
        currentPage = page;
        currentSearch = search;

        const params = new URLSearchParams({
            page: page,
            limit: currentLimit,
            search: search
        });

        const res = await apiFetch(`${API_BASE}?${params.toString()}`);

        const users = res.data || [];
        const meta = res.meta;

        renderTable(users);
        renderPagination(meta);

        if (meta) {
            document.getElementById('pageFrom').innerText = meta.from || 0;
            document.getElementById('pageTo').innerText = meta.to || 0;
            document.getElementById('pageTotal').innerText = meta.total || 0;
        }

    } catch (e) {
        console.error(e);
    }
}

/* ===============================
   RENDER TABLE
================================ */
function renderTable(users) {
    const tbody = document.getElementById('userTableBody');
    if (!tbody) return;

    tbody.innerHTML = '';

    if (!users.length) {
        tbody.innerHTML = `
            <tr>
                <td colspan="5" class="text-center py-6 text-gray-500">
                    Không tìm thấy dữ liệu phù hợp
                </td>
            </tr>`;
        return;
    }

    users.forEach(u => {
        // --- LOGIC KIỂM TRA SUPER ADMIN ---
        // Giả sử tài khoản cần bảo vệ có username là 'admin'
        const isSuperAdmin = (u.username === 'admin');

        let actionButtons = '';

        if (isSuperAdmin) {
            // CASE 1: Nếu là Admin xịn -> Hiện Badge "Bảo vệ"
            actionButtons = `
                <div class="flex items-center justify-end gap-2">
                    <button onclick="openEditModal(${u.id})" 
                            class="text-indigo-600 hover:text-indigo-900 transition-colors mt-1 p-1 rounded hover:bg-indigo-200" 
                            title="Đổi mật khẩu">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                        </svg>
                    </button>
                    
                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-500 cursor-not-allowed" title="Không thể xóa Admin">
                        Mặc định
                    </span>
                </div>
            `;
        } else {
            // CASE 2: Tài khoản thường -> Hiện nút Sửa / Xóa
            actionButtons = `
                <div class="flex items-center justify-end gap-3">
                    <button onclick="openEditModal(${u.id})" 
                            class="text-indigo-600 hover:text-indigo-900 transition-colors mt-1 p-1 rounded hover:bg-indigo-200" 
                            title="Sửa tài khoản">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                        </svg>
                    </button>

                    <button onclick="confirmDelete(${u.id})" 
                            class="text-red-500 hover:text-red-700 transition-colors p-1 rounded hover:bg-red-200" 
                            title="Xóa tài khoản">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>
                    </button>
                </div>
            `;
        }

        tbody.insertAdjacentHTML('beforeend', `
            <tr class="bg-white even:bg-indigo-50 hover:bg-indigo-100 transition-colors duration-200">
                <td class="px-6 py-2 border-b border-indigo-100 text-gray-900">${u.id}</td>
                <td class="px-6 py-2 border-b border-indigo-100 font-medium text-gray-900">${u.username}</td>
                <td class="px-6 py-2 border-b border-indigo-100 text-gray-700">${u.name}</td>
                <td class="px-6 py-2 border-b border-indigo-100 text-gray-500">${u.created_at}</td>
                
                <td class="px-6 py-2 border-b border-indigo-100 text-right">
                   ${actionButtons}
                </td>
            </tr>
        `);
    });
}

/* ===============================
   RENDER PAGINATION
================================ */
function renderPagination(meta) {
    const container = document.getElementById('paginationControls');
    const pageTotalDisplay = document.getElementById('pageTotal');

    if (pageTotalDisplay && meta) {
        pageTotalDisplay.innerText = meta.total; // Cập nhật tổng số dòng
    }

    if (!container || !meta) return;

    let html = '';
    const current = meta.current_page;
    const last = meta.last_page;

    // Helper: Class cho nút thường và nút active
    const baseClass = "relative inline-flex items-center justify-center w-8 h-8 rounded-full text-sm font-semibold transition-colors duration-200";
    const inactiveClass = "text-gray-500 hover:bg-indigo-100 hover:text-indigo-700";
    const activeClass = "bg-indigo-700 text-white shadow-sm";
    const disabledClass = "text-gray-300 pointer-events-none";

    // 1. Nút First (<<)
    html += `
        <a onclick="changePage(1)" class="${baseClass} ${current === 1 ? disabledClass : inactiveClass} cursor-pointer">
            <span class="sr-only">First</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
            </svg>
        </a>
    `;

    // 2. Nút Previous (<)
    html += `
        <a onclick="changePage(${current - 1})" class="${baseClass} ${current === 1 ? disabledClass : inactiveClass} cursor-pointer">
            <span class="sr-only">Previous</span>
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </a>
    `;

    // 3. Render các số trang (Xử lý dấu ... thông minh)
    // Logic: Luôn hiện trang đầu, trang cuối, và các trang xung quanh current
    let pages = [];

    if (last <= 7) {
        // Nếu ít trang thì hiện hết
        for (let i = 1; i <= last; i++) pages.push(i);
    } else {
        // Nếu nhiều trang, tính toán hiển thị dấu ...
        if (current <= 4) {
            pages = [1, 2, 3, 4, 5, '...', last];
        } else if (current >= last - 3) {
            pages = [1, '...', last - 4, last - 3, last - 2, last - 1, last];
        } else {
            pages = [1, '...', current - 1, current, current + 1, '...', last];
        }
    }

    pages.forEach(page => {
        if (page === '...') {
            html += `<span class="relative inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400">...</span>`;
        } else {
            const isActive = page === current;
            html += `
                <a onclick="changePage(${page})" 
                   class="${baseClass} ${isActive ? activeClass : inactiveClass} cursor-pointer">
                   ${page}
                </a>
            `;
        }
    });

    // 4. Nút Next (>)
    html += `
        <a onclick="changePage(${current + 1})" class="${baseClass} ${current === last ? disabledClass : inactiveClass} cursor-pointer">
            <span class="sr-only">Next</span>
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </a>
    `;

    // 5. Nút Last (>>)
    html += `
        <a onclick="changePage(${last})" class="${baseClass} ${current === last ? disabledClass : inactiveClass} cursor-pointer">
            <span class="sr-only">Last</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
            </svg>
        </a>
    `;

    container.innerHTML = html;
}

/* ===============================
   EVENT HANDLERS
================================ */
function changePage(page) {
    if (page < 1) return;
    fetchUsers(page, currentSearch);
}

/* ===============================
   EVENT HANDLERS & DEBOUNCE
================================ */
document.addEventListener('DOMContentLoaded', () => {
    // 1. Xử lý Submit Form Thêm
    document.getElementById('addUserForm')?.addEventListener('submit', e => {
        e.preventDefault();
        createUser();
    });

    // 2. Xử lý Submit Form Sửa
    document.getElementById('editUserForm')?.addEventListener('submit', e => {
        e.preventDefault();
        updateUser();
    });

    // 3. Xử lý Search Debounce (ĐÃ SỬA VỊ TRÍ)
    let debounceTimer;
    const searchInput = document.getElementById('searchInput');

    if (searchInput) {
        searchInput.addEventListener('input', (e) => {
            clearTimeout(debounceTimer); // Xóa timer cũ nếu người dùng gõ tiếp

            // Hiển thị trạng thái đang chờ (Optional UX)
            // document.getElementById('loading-icon').style.display = 'block';

            debounceTimer = setTimeout(() => {
                const keyword = e.target.value.trim();
                fetchUsers(1, keyword); // Gọi API sau 500ms dừng gõ
            }, 500); // Thời gian delay 500ms
        });
    }
});

/* ===============================
   CREATE USER
================================ */
async function createUser() {
    clearErrors('add');
    const form = document.getElementById('addUserForm');
    const data = Object.fromEntries(new FormData(form));

    try {
        // Lưu kết quả trả về vào biến res
        const res = await apiFetch(API_BASE, {
            method: 'POST',
            body: JSON.stringify(data),
        });

        // KIỂM TRA LỖI TỪ BACKEND
        // Nếu backend trả về status: false (do Validation failed)
        if (res.status === false) {
            showErrors(res.errors, 'add'); // Hiển thị lỗi lên form
            return; // Dừng hàm, không chạy đoạn code success bên dưới
        }

        // Nếu thành công
        toggleModal('addUserModal');
        form.reset();
        fetchUsers(1, '');
        Swal.fire('Thành công', 'Đã thêm tài khoản', 'success');

    } catch (e) {
        console.error(e);
        Swal.fire('Lỗi hệ thống', 'Vui lòng thử lại sau', 'error');
    }
}

/* ===============================
   EDIT USER
================================ */
async function openEditModal(id) {
    try {
        const res = await apiFetch(`${API_BASE}/${id}`);
        const u = res.data;

        // Đổ dữ liệu vào form
        document.getElementById('edit_user_id').value = u.id;

        const usernameInput = document.getElementById('edit_username');
        usernameInput.value = u.username;
        document.getElementById('edit_name').value = u.name;
        document.getElementById('edit_password').value = '';

        // --- LOGIC MỚI: KHÓA USERNAME NẾU LÀ ADMIN ---
        if (u.username === 'admin') {
            usernameInput.setAttribute('disabled', 'true'); // Không cho sửa
            usernameInput.classList.add('bg-gray-100', 'cursor-not-allowed'); // Thêm màu xám
        } else {
            usernameInput.removeAttribute('disabled');
            usernameInput.classList.remove('bg-gray-100', 'cursor-not-allowed');
        }
        // ----------------------------------------------

        clearErrors('edit');
        toggleModal('editUserModal');
    } catch (e) {
        console.error(e);
    }
}

async function updateUser() {
    clearErrors('edit');
    const id = document.getElementById('edit_user_id').value;
    const raw = Object.fromEntries(new FormData(document.getElementById('editUserForm')));

    const data = {};
    for (const k in raw) {
        if (k === 'password' && !raw[k]) continue;
        data[k] = raw[k];
    }

    try {
        const res = await apiFetch(`${API_BASE}/${id}`, {
            method: 'PUT',
            body: JSON.stringify(data),
        });

        // KIỂM TRA LỖI
        if (res.status === false) {
            showErrors(res.errors, 'edit'); // Chú ý prefix là 'edit'
            return;
        }

        toggleModal('editUserModal');
        fetchUsers(currentPage, currentSearch);
        Swal.fire('Thành công', 'Đã cập nhật', 'success');
    } catch (e) {
        console.error(e);
        Swal.fire('Lỗi hệ thống', 'Vui lòng thử lại sau', 'error');
    }
}

/* ===============================
   DELETE USER
================================ */
function confirmDelete(id) {
    Swal.fire({
        title: `Bạn có chắc muốn xóa tài khoản (ID = ${id})?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        confirmButtonText: 'Xóa',
        cancelButtonText: 'Hủy'
    }).then(async (result) => {
        if (!result.isConfirmed) return;

        try {
            await apiFetch(`${API_BASE}/${id}`, { method: 'DELETE' });

            // SỬA: Giữ nguyên trang và từ khóa tìm kiếm
            fetchUsers(currentPage, currentSearch);
            Swal.fire('Đã xóa!', 'Tài khoản đã được xóa.', 'success');
        } catch (e) {
            console.error(e);
            Swal.fire('Lỗi!', 'Không thể xóa tài khoản này.', 'error');
        }
    });
}

/* ===============================
   UI HELPERS
================================ */
window.toggleModal = (id) => {
    const modal = document.getElementById(id);
    if (!modal) return;

    // Kiểm tra trạng thái hiện tại: 
    // Nếu modal KHÔNG có class 'hidden' nghĩa là nó đang hiện -> Hành động này sẽ là ĐÓNG.
    const isClosing = !modal.classList.contains('hidden');

    // Thực hiện ẩn/hiện
    modal.classList.toggle('hidden');

    // LOGIC DỌN DẸP KHI ĐÓNG MODAL
    if (isClosing) {

        // 1. Xử lý cho Modal Thêm mới (addUserModal)
        if (id === 'addUserModal') {
            const form = document.getElementById('addUserForm');
            if (form) form.reset(); // Xóa sạch dữ liệu trong các ô input
            clearErrors('add');     // Xóa các dòng thông báo lỗi màu đỏ
        }

        // 2. Xử lý cho Modal Sửa (editUserModal) - Tùy chọn
        // Khi đóng form sửa, ta cũng nên xóa lỗi cũ để lần sau mở lên không bị ám
        if (id === 'editUserModal') {
            clearErrors('edit');
        }
    }
};

function clearErrors(prefix) {
    document
        .querySelectorAll(`[id^="error_${prefix}_"]`)
        .forEach(e => e.innerText = '');
}

function showErrors(errors, prefix) {
    // errors là object: { username: ["Lỗi 1"], password: ["Lỗi 2"] }
    for (const [key, messages] of Object.entries(errors)) {
        const errorDiv = document.getElementById(`error_${prefix}_${key}`);
        if (errorDiv) {
            errorDiv.innerText = messages[0]; // Chỉ hiện thông báo lỗi đầu tiên
        }
    }
}

/* ===============================
   AUTO LOAD
================================ */
console.log('USER.JS LOADED');
fetchUsers(currentPage, currentSearch);