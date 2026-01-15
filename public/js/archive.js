// const checkboxes = document.querySelectorAll('.filter-checkbox');
//         const posts = document.querySelectorAll('.post-card');

//         checkboxes.forEach(cb => {
//             cb.addEventListener('change', filterPosts);
//         });

//         function filterPosts() {
//             const checked = Array.from(checkboxes)
//                 .filter(cb => cb.checked)
//                 .map(cb => cb.value);

//             posts.forEach(post => {
//                 const category = post.dataset.category;

//                 if (checked.length === 0 || checked.includes(category)) {
//                     post.style.display = 'block';
//                 } else {
//                     post.style.display = 'none';
//                 }
//             });
//         }


document.addEventListener('DOMContentLoaded', () => {
    loadAllCategories();
    loadPosts();
});

/* ================= LOAD CATEGORY ================= */

async function loadCategories() {
    const list = document.getElementById('categoryList');
    if (!list) return;

    try {
        const res = await fetch('/api/categories', {
            headers: { Accept: 'application/json' }
        });

        if (!res.ok) throw new Error('API error');

        const json = await res.json();
        const categories = Array.isArray(json.data) ? json.data : [];

        list.innerHTML = '';

        categories.forEach(cat => {
            const li = document.createElement('li');
            li.innerHTML = `
                <label>
                    <input type="checkbox" class="filter-checkbox" value="${cat.slug}">
                    ${cat.name}
                </label>
            `;
            list.appendChild(li);
        });

    } catch (e) {
        console.error(e);
        list.innerHTML = '<li>Lỗi tải danh mục</li>';
    }
}

async function loadAllCategories() {
    const list = document.getElementById('categoryList');
    if (!list) return;

    try {
        let allCategories = [];
        let page = 1;
        let lastPage = 1;

        do {
            const res = await fetch(`/api/categories?page=${page}`, {
                headers: { Accept: 'application/json' }
            });

            const json = await res.json();

            allCategories = allCategories.concat(json.data || []);
            lastPage = json.last_page || 1;
            page++;

        } while (page <= lastPage);

        // ❌ Ẩn "Chưa phân loại"
        allCategories = allCategories.filter(cat => cat.id !== 1);

        // Render
        list.innerHTML = '';

        allCategories.forEach(cat => {
            const li = document.createElement('li');
            li.innerHTML = `
                <label>
                    <input type="checkbox"
                           class="filter-checkbox"
                           value="${cat.slug}">
                    ${cat.name}
                </label>
            `;
            list.appendChild(li);
        });

    } catch (e) {
        console.error(e);
        list.innerHTML = '<li>Lỗi tải danh mục</li>';
    }
}


/* ================= FILTER POSTS (EVENT DELEGATION) ================= */

document.addEventListener('change', function (e) {
    if (!e.target.classList.contains('filter-checkbox')) return;

    const checkedValues = Array.from(
        document.querySelectorAll('.filter-checkbox:checked')
    ).map(cb => cb.value);

    const posts = document.querySelectorAll('.post-card');

    posts.forEach(post => {
        const category = post.dataset.category;

        post.style.display =
            checkedValues.length === 0 || checkedValues.includes(category)
                ? 'block'
                : 'none';
    });
});



// post

async function loadPosts() {
    const grid = document.getElementById('postGrid');
    if (!grid) return;

    try {
        const res = await fetch('/api/posts', {
            headers: { Accept: 'application/json' }
        });

        if (!res.ok) throw new Error('API error');

        const json = await res.json();
        const posts = Array.isArray(json.data) ? json.data : json;

        grid.innerHTML = '';

        posts
            // ❌ BỎ CHƯA PHÂN LOẠI (id = 1)
            .filter(post => post.category && Number(post.category.id) !== 1)
            .forEach(post => {
                const article = document.createElement('article');
                article.className = 'post-card';

                // ✅ GÁN data-category (slug)
                article.dataset.category = post.category.slug;

                const image = post.thumbnail || '/images/default.jpg';
                const date = new Date(post.created_at).toLocaleDateString('vi-VN');

                article.innerHTML = `
                    <a href="/bai-viet/${post.slug}">
                        <div class="thumb">
                            <img src="${image}" alt="${post.title}">
                        </div>
                        <h2>${post.title}</h2>
                        <div class="meta">
                            ${date} · ${post.category.name}
                        </div>
                    </a>
                `;

                grid.appendChild(article);
            });

    } catch (e) {
        console.error(e);
        grid.innerHTML = '<p>Lỗi tải bài viết</p>';
    }
}






function formatDate(dateString) {
    return new Date(dateString).toLocaleDateString('vi-VN');
}

