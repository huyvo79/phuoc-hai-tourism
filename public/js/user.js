/* ===============================
   CONFIG
================================ */
const API_BASE = '/api/users';

/* ===============================
   FETCH WRAPPER (COOKIE JWT)
================================ */
async function apiFetch(url, options = {}) {
    const response = await fetch(url, {
        credentials: 'same-origin', // ⬅️ BẮT BUỘC
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
            window.location.href = '/login';
        });
        throw new Error('Unauthorized');
    }

    return response.json();
}

/* ===============================
   LOAD USERS
================================ */
async function fetchUsers() {
    try {
        const res = await apiFetch(API_BASE);
        renderTable(res.data ?? []);
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
                <td colspan="4" class="text-center py-6 text-gray-500">
                    Chưa có dữ liệu
                </td>
            </tr>`;
        return;
    }

    users.forEach(u => {
        tbody.insertAdjacentHTML('beforeend', `
            <tr>
                <td class="px-6 py-4">${u.id}</td>
                <td class="px-6 py-4 font-medium">${u.username}</td>
                <td class="px-6 py-4">${u.name}</td>
                <td class="px-6 py-4">${u.created_at}</td>
                <td class="px-6 py-4 text-right">
                    <button class="text-indigo-600 mr-3"
                        onclick="openEditModal(${u.id})">Sửa</button>
                    <button class="text-red-600"
                        onclick="confirmDelete(${u.id})">Xóa</button>
                </td>
            </tr>
        `);
    });
}

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
        fetchUsers();
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
    const raw = Object.fromEntries(new FormData(
        document.getElementById('editUserForm')
    ));

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
        fetchUsers();
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
            fetchUsers(); 
            Swal.fire('Đã xóa!', 'Tài khoản đã được xóa thành công.', 'success');
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
fetchUsers();
