/* ===============================
   CONFIG
================================ */
const API_BASE = '/api/users';

/* ===============================
   STATE QUẢN LÝ
================================ */
let currentPage = 1;
let currentSearch = '';
const PER_PAGE = 5; // Bạn có thể chỉnh số lượng tùy ý

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
        // Cập nhật state toàn cục để dùng lại khi reload
        currentPage = page;
        currentSearch = search;

        const params = new URLSearchParams({
            page: page,
            per_page: PER_PAGE,
            search: search
        });

        const res = await apiFetch(`${API_BASE}?${params.toString()}`);

        // Laravel Resource trả về: { data: [...], meta: {...}, links: {...} }
        const users = res.data || [];
        const meta = res.meta;

        renderTable(users);       // <--- Đã thêm lại hàm này
        renderPagination(meta);   // <--- Render phân trang

        // Cập nhật text hiển thị số lượng (nếu có meta)
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
   RENDER TABLE (Đã thêm lại)
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
        tbody.insertAdjacentHTML('beforeend', `
            <tr class="bg-white even:bg-indigo-50 hover:bg-indigo-100 transition-colors duration-200">
                <td class="px-6 py-4 border-b border-indigo-100 text-gray-900">${u.id}</td>
                <td class="px-6 py-4 border-b border-indigo-100 font-medium text-gray-900">${u.username}</td>
                <td class="px-6 py-4 border-b border-indigo-100 text-gray-700">${u.name}</td>
                <td class="px-6 py-4 border-b border-indigo-100 text-gray-500">${u.created_at}</td>
                
                <td class="px-6 py-4 border-b border-indigo-100 text-right">
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
    if (!container || !meta) return;

    let html = '';

    // Nút Previous
    const prevDisabled = meta.current_page === 1 ? 'pointer-events-none opacity-50' : 'cursor-pointer';
    html += `
        <a onclick="changePage(${meta.current_page - 1})" 
           class="${prevDisabled} relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 bg-indigo-100 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
            <span class="sr-only">Previous</span>
            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd" />
            </svg>
        </a>
    `;

    // Render các số trang
    for (let i = 1; i <= meta.last_page; i++) {
        const activeClass = i === meta.current_page
            ? 'z-10 bg-indigo-600 text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600'
            : 'text-gray-900 bg-indigo-100 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:outline-offset-0';

        html += `
            <a onclick="changePage(${i})" 
               class="${activeClass} relative cursor-pointer inline-flex items-center px-4 py-2 text-sm font-semibold focus:z-20">
               ${i}
            </a>
        `;
    }

    // Nút Next
    const nextDisabled = meta.current_page === meta.last_page ? 'pointer-events-none opacity-50' : 'cursor-pointer';
    html += `
        <a onclick="changePage(${meta.current_page + 1})" 
           class="${nextDisabled} relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 bg-indigo-100 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
            <span class="sr-only">Next</span>
            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
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

// Debounce Search
let debounceTimer;
document.getElementById('searchInput')?.addEventListener('input', (e) => {
    clearTimeout(debounceTimer);
    debounceTimer = setTimeout(() => {
        const keyword = e.target.value.trim();
        fetchUsers(1, keyword); // Tìm kiếm mới luôn về trang 1
    }, 500);
});

/* ===============================
   CREATE USER
================================ */
async function createUser() {
    clearErrors('add');
    const form = document.getElementById('addUserForm');
    const data = Object.fromEntries(new FormData(form));

    try {
        await apiFetch(API_BASE, {
            method: 'POST',
            body: JSON.stringify(data),
        });

        toggleModal('addUserModal');
        form.reset();
        
        // Khi thêm mới thành công, nên về trang 1 để thấy user mới nhất (nếu sort desc)
        fetchUsers(1, ''); 
        Swal.fire('Thành công', 'Đã thêm tài khoản', 'success');
    } catch (e) {
        console.error(e);
    }
}

/* ===============================
   EDIT USER
================================ */
async function openEditModal(id) {
    try {
        const res = await apiFetch(`${API_BASE}/${id}`);
        const u = res.data;

        document.getElementById('edit_user_id').value = u.id;
        document.getElementById('edit_username').value = u.username;
        document.getElementById('edit_name').value = u.name;
        document.getElementById('edit_password').value = '';

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
        await apiFetch(`${API_BASE}/${id}`, {
            method: 'PUT',
            body: JSON.stringify(data),
        });

        toggleModal('editUserModal');
        // SỬA: Giữ nguyên trang và từ khóa tìm kiếm
        fetchUsers(currentPage, currentSearch); 
        Swal.fire('Thành công', 'Đã cập nhật', 'success');
    } catch (e) {
        console.error(e);
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
window.toggleModal = id =>
    document.getElementById(id)?.classList.toggle('hidden');

function clearErrors(prefix) {
    document
        .querySelectorAll(`[id^="error_${prefix}_"]`)
        .forEach(e => e.innerText = '');
}

document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('addUserForm')?.addEventListener('submit', e => {
        e.preventDefault();
        createUser();
    });

    document.getElementById('editUserForm')?.addEventListener('submit', e => {
        e.preventDefault();
        updateUser();
    });
});

/* ===============================
   AUTO LOAD
================================ */
console.log('USER.JS LOADED');
fetchUsers(currentPage, currentSearch);