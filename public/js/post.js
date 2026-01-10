let currentPage = 1;
let currentLimit = 10;
let currentSearch = '';

document.addEventListener('DOMContentLoaded', function() {
    fetchPosts();

    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('input', debounce(function(e) {
            currentSearch = e.target.value;
            currentPage = 1;
            fetchPosts();
        }, 500));
    }
});

function debounce(func, timeout = 300) {
    let timer;
    return (...args) => {
        clearTimeout(timer);
        timer = setTimeout(() => { func.apply(this, args); }, timeout);
    };
}

async function fetchPosts() {
    try {
        const response = await fetch(`/admin/posts?page=${currentPage}&limit=${currentLimit}&search=${currentSearch}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        });
        const data = await response.json();
        
        renderTable(data.data);
        renderPagination(data);
        document.getElementById('pageTotal').innerText = data.total;
    } catch (error) {
        console.error('Error:', error);
    }
}

function renderTable(posts) {
    const tbody = document.getElementById('postTableBody');
    if (!tbody) return;
    
    tbody.innerHTML = '';

    if (posts.length === 0) {
        tbody.innerHTML = `<tr><td colspan="6" class="px-6 py-10 text-center text-gray-500">Không tìm thấy bài viết nào.</td></tr>`;
        return;
    }

    posts.forEach(post => {
        const date = new Date(post.created_at).toLocaleDateString('vi-VN');
        const thumbnail = post.thumbnail 
            ? `<img src="${post.thumbnail}" class="h-12 w-12 rounded-lg object-cover border border-gray-100 shadow-sm">`
            : `<div class="h-12 w-12 rounded-lg bg-gray-100 flex items-center justify-center text-[10px] text-gray-400 border border-dashed border-gray-300">No img</div>`;

        const row = `
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">#${post.id}</td>
                <td class="px-6 py-4 whitespace-nowrap">${thumbnail}</td>
                <td class="px-6 py-4">
                    <div class="text-sm font-semibold text-gray-900 line-clamp-1">${post.title}</div>
                    <div class="text-xs text-gray-400 line-clamp-1 italic">${post.slug}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">
                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-medium rounded-full bg-indigo-100 text-indigo-700">
                        ${post.category ? post.category.name : 'Chưa phân loại'}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${date}</td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <a href="/admin/posts/${post.id}/edit" class="text-indigo-600 hover:text-indigo-900 mr-4 transition-colors">Sửa</a>
                    <button onclick="confirmDelete(${post.id})" class="text-red-500 hover:text-red-700 transition-colors">Xóa</button>
                </td>
            </tr>
        `;
        tbody.insertAdjacentHTML('beforeend', row);
    });
}

function renderPagination(data) {
    const controls = document.getElementById('paginationControls');
    if (!controls) return;
    controls.innerHTML = '';

    data.links.forEach(link => {
        const activeClass = link.active 
            ? 'bg-indigo-600 text-white' 
            : 'bg-white text-gray-700 hover:bg-gray-50 border-gray-300';
        
        const disabledAttr = !link.url ? 'disabled' : '';
        
        const btn = `
            <button onclick="goToPage('${link.url}')" ${disabledAttr}
                class="relative inline-flex items-center px-3 py-1 border text-sm font-medium rounded-md transition-all ${activeClass}">
                ${link.label.replace('&laquo; Previous', 'Trước').replace('Next &raquo;', 'Sau')}
            </button>
        `;
        controls.insertAdjacentHTML('beforeend', btn);
    });
}

function goToPage(url) {
    if (!url) return;
    const urlParams = new URLSearchParams(url.split('?')[1]);
    currentPage = urlParams.get('page');
    fetchPosts();
}

function changeLimit(limit) {
    currentLimit = limit;
    currentPage = 1;
    fetchPosts();
}