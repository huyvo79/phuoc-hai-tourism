console.log('CATEGORY JS LOADED');



const API_URL = window.CategoryConfig.apiUrl;
const CSRF_TOKEN = window.CategoryConfig.csrfToken;

let currentPage = 1;
let perPage = 10;
let search = '';
let deleteId = null;

document.addEventListener('DOMContentLoaded', () => {
    loadCategories();

    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('keyup', e => {
            search = e.target.value;
            loadCategories(1);
        });
    }
});

function loadCategories(page = 1) {
    currentPage = page;

    fetch(`${CategoryConfig.apiUrl}?page=${page}&per_page=${perPage}&search=${search}`)
        .then(res => res.json())
        .then(res => {
            console.log('API RESPONSE:', res); // 👈 debug

            // API trả về array => truyền thẳng
            renderTable(res);

            document.getElementById('pageTotal').innerText = res.length;
        })
        .catch(err => console.error(err));
}


function renderTable(categories) {
    let html = '';

    if (!Array.isArray(categories) || categories.length === 0) {
        html = `
            <tr>
                <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                    Chưa có danh mục nào
                </td>
            </tr>
        `;
        document.getElementById('categoryTable').innerHTML = html;
        return;
    }

    categories.forEach(cat => {
        html += `
            <tr>
                <td class="px-6 py-4 text-gray-600">${cat.id}</td>
                <td class="px-6 py-4 text-gray-600">${cat.name}</td>
                <td class="px-6 py-4 text-gray-600">${cat.slug}</td>
                <td class="px-6 py-4 text-gray-600">
                    ${new Date(cat.created_at).toLocaleDateString()}
                </td>
                <td class="px-6 py-4 text-right">
                    <button onclick="openEditModal(${cat.id})"
                        class="text-indigo-600 hover:text-indigo-900 mr-3 inline-block">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                        </svg>
                    </button>
                    <button onclick="confirmDelete(${cat.id})"
                        class="text-red-500 hover:text-red-700 transition-colors p-1 rounded hover:bg-red-200"
                        title="Xóa tài khoản">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>
                    </button>
                </td>
            </tr>
        `;
    });

    document.getElementById('categoryTable').innerHTML = html;
}



function confirmDelete(id) {
    deleteId = id;
    toggleModal('deleteModal');
}

function deleteCategory() {
    fetch(`${CategoryConfig.apiUrl}/${deleteId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': CategoryConfig.csrfToken
        }
    })
    .then(() => {
        showToast('Xóa danh mục thành công');
        toggleModal('deleteModal');
        loadCategories(currentPage);
    });
}

function openEditModal(id) {
    fetch(`${CategoryConfig.apiUrl}/${id}`)
        .then(res => res.json())
        .then(cat => {
            document.getElementById('editId').value = cat.id;
            document.getElementById('editName').value = cat.name;
            toggleModal('editModal');
        });
}

function updateCategory() {
    const id = document.getElementById('editId').value;
    const name = document.getElementById('editName').value;

    fetch(`${CategoryConfig.apiUrl}/${id}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': CategoryConfig.csrfToken
        },
        body: JSON.stringify({ name })
    })
    .then(res => res.json())
    .then(() => {
        toggleModal('editModal');
        showToast('Sửa danh mục thành công');
        loadCategories(currentPage);
    });
}

function openCreateModal() {
    document.getElementById('createName').value = '';
    toggleModal('createModal');
}

function storeCategory() {
    const name = document.getElementById('createName').value.trim();

    if (!name) {
        alert('Vui lòng nhập tên danh mục');
        return;
    }

    fetch(CategoryConfig.apiUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': CategoryConfig.csrfToken
        },
        body: JSON.stringify({ name })
    })
    .then(res => res.json())
    .then(() => {
        toggleModal('createModal');
        showToast('Thêm danh mục thành công');
        loadCategories(1); // reload lại trang đầu
    });
}

function showToast(message, type = 'success') {
    const toast = document.getElementById('toast');

    toast.innerText = message;
    toast.className =
        'fixed top-5 right-5 z-50 px-4 py-3 rounded-lg shadow-lg text-white';

    if (type === 'success') {
        toast.classList.add('bg-green-600');
    } else {
        toast.classList.add('bg-red-600');
    }

    toast.classList.remove('hidden');

    setTimeout(() => {
        toast.classList.add('hidden');
    }, 2500);
}

function loadCategories(page = 1) {
    currentPage = page;

    fetch(`/api/categories?page=${page}&per_page=${perPage}`)
        .then(res => res.json())
        .then(res => {
            renderTable(res.data);
            renderPagination(res);
            document.getElementById('pageTotal').innerText = res.total;
        })
        .catch(err => console.error(err));
}

function renderPagination(meta) {
    const container = document.getElementById('paginationControls');
    const pageTotalDisplay = document.getElementById('pageTotal');

    if (pageTotalDisplay && meta) {
        pageTotalDisplay.innerText = meta.total;
    }

    if (!container || !meta) return;

    let html = '';
    const current = meta.current_page;
    const last = meta.last_page;

    if (last <= 1) {
        container.innerHTML = '';
        return;
    }

    // ==== Class giống Blade
    const baseClass =
        "relative inline-flex items-center justify-center w-8 h-8 rounded-full text-sm font-semibold transition-colors duration-200";
    const inactiveClass =
        "text-gray-500 hover:bg-indigo-100 hover:text-indigo-700";
    const activeClass =
        "bg-indigo-700 text-white shadow-sm";
    const disabledClass =
        "text-gray-300 pointer-events-none";

    // ==== 1. First (<<)
    html += `
        <a onclick="${current === 1 ? '' : 'changePage(1)'}"
           class="${baseClass} ${current === 1 ? disabledClass : inactiveClass} cursor-pointer">
            <span class="sr-only">First</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
            </svg>
        </a>
    `;

    // ==== 2. Previous (<)
    html += `
        <a onclick="${current === 1 ? '' : `changePage(${current - 1})`}"
           class="${baseClass} ${current === 1 ? disabledClass : inactiveClass} cursor-pointer">
            <span class="sr-only">Previous</span>
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 19l-7-7 7-7" />
            </svg>
        </a>
    `;

    // ==== 3. Logic số trang + ...
    let pages = [];

    if (last <= 7) {
        for (let i = 1; i <= last; i++) pages.push(i);
    } else {
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
            html += `
                <span class="relative inline-flex items-center justify-center
                             w-8 h-8 text-sm text-gray-400">
                    ...
                </span>
            `;
        } else {
            html += `
                <a onclick="changePage(${page})"
                   class="${baseClass} ${
                       page === current ? activeClass : inactiveClass
                   } cursor-pointer">
                    ${page}
                </a>
            `;
        }
    });

    // ==== 4. Next (>)
    html += `
        <a onclick="${current === last ? '' : `changePage(${current + 1})`}"
           class="${baseClass} ${current === last ? disabledClass : inactiveClass} cursor-pointer">
            <span class="sr-only">Next</span>
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 5l7 7-7 7" />
            </svg>
        </a>
    `;

    // ==== 5. Last (>>)
    html += `
        <a onclick="${current === last ? '' : `changePage(${last})`}"
           class="${baseClass} ${current === last ? disabledClass : inactiveClass} cursor-pointer">
            <span class="sr-only">Last</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13 5l7 7-7 7M5 5l7 7-7 7" />
            </svg>
        </a>
    `;

    container.innerHTML = html;
}


function changePerPage(value) {
    perPage = value;
    loadCategories(1);
}

/* Modal helper */
function toggleModal(modalID) {
    const modal = document.getElementById(modalID);
    modal.classList.toggle('hidden');
}

window.changePage = function (page) {
    if (page < 1) return;
    loadCategories(page);
};
