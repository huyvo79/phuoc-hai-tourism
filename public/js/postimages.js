let currentPage = window.postImageConfig.currentPage;
let currentLimit = window.postImageConfig.currentLimit;
let currentSearch = window.postImageConfig.currentSearch;

document.addEventListener('DOMContentLoaded', () => {
    renderTable(window.postImageConfig.initialData);
    renderPagination(window.postImageConfig.pagination);

    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('input', debounce(e => {
            currentSearch = e.target.value;
            currentPage = 1;
            fetchPostImages();
        }, 500));
    }
});

/* ================= MODAL ================= */
function openDeleteModal(id, title) {
    document.getElementById('deleteModalTitle').textContent =
        `Xác nhận xóa hình ảnh của "${title}"`;

    document.getElementById('deleteModalMessage').textContent =
        'Dữ liệu hình ảnh sẽ bị xóa vĩnh viễn. Bạn có chắc chắn muốn tiếp tục?';

    let url = window.postImageConfig.destroyUrl.replace(':id', id);
    document.getElementById('deleteForm').action = url;

    toggleModal('deleteModal');
}

function toggleModal(id) {
    document.getElementById(id).classList.toggle('hidden');
}

/* ================= FETCH ================= */
async function fetchPostImages() {
    const res = await fetch(
        `${window.postImageConfig.indexUrl}?page=${currentPage}&limit=${currentLimit}&search=${currentSearch}`,
        {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        }
    );

    const data = await res.json();
    renderTable(data.data);
    renderPagination(data);
    document.getElementById('pageTotal').innerText = data.total;
}

/* ================= TABLE ================= */
function renderTable(postImages) {
    const tbody = document.getElementById('postImageTableBody');
    tbody.innerHTML = '';

    if (!postImages.length) {
        tbody.innerHTML = `
            <tr>
                <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                    Không có dữ liệu
                </td>
            </tr>
        `;
        return;
    }

    postImages.forEach(item => {
        const editUrl = window.postImageConfig.editUrl.replace(':id', item.id);

        tbody.insertAdjacentHTML('beforeend', `
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4">${item.id}</td>
                <td class="px-6 py-4">${item.post?.title ?? 'N/A'}</td>
                <td class="px-6 py-4">
                    <img src="${window.postImageConfig.assetUrl}/${item.image}"
                         class="w-16 h-16 rounded object-cover">
                </td>
                <td class="px-6 py-4 text-right">
                    <a href="${editUrl}" class="text-blue-600">Sửa</a>
                    <button onclick="openDeleteModal(${item.id}, '${item.post?.title ?? 'hình ảnh'}')"
                            class="text-red-600 ml-2">
                        Xóa
                    </button>
                </td>
            </tr>
        `);
    });
}

/* ================= PAGINATION ================= */
function renderPagination(data) {
    const controls = document.getElementById('paginationControls');
    controls.innerHTML = '';

    data.links.forEach(link => {
        controls.insertAdjacentHTML('beforeend', `
            <button ${!link.url ? 'disabled' : ''}
                onclick="goToPage('${link.url}')"
                class="px-3 py-1 border rounded ${link.active ? 'bg-indigo-600 text-white' : 'text-black'}">
                ${link.label.replace('&laquo; Previous', 'Trước').replace('Next &raquo;', 'Sau')}
            </button>
        `);
    });
}

function goToPage(url) {
    if (!url) return;
    currentPage = new URL(url).searchParams.get('page');
    fetchPostImages();
}

/* ================= UTILS ================= */
function debounce(fn, delay = 300) {
    let t;
    return (...args) => {
        clearTimeout(t);
        t = setTimeout(() => fn(...args), delay);
    };
}

function changeLimit(limit) {
    currentLimit = limit;
    currentPage = 1;
    fetchPostImages();
}
