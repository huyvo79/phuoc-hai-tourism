console.log('CATEGORY JS LOADED');

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
                    <button onclick="confirmDelete(${cat.id})"
                        class="text-red-500 hover:text-red-700">
                        Xóa
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
        toggleModal('deleteModal');
        loadCategories(currentPage);
    });
}

/* Modal helper */
function toggleModal(modalID) {
    const modal = document.getElementById(modalID);
    modal.classList.toggle('hidden');
}
