document.addEventListener('DOMContentLoaded', () => {
    // Gọi hàm load public thay vì hàm loop phân trang phức tạp
    loadPublicCategories(); 
    loadPosts();
});

/* ================= LOAD CATEGORY (Sửa lại logic) ================= */

async function loadPublicCategories() {
    const list = document.getElementById('categoryList');
    if (!list) return;

    try {
        // SỬA: Gọi đúng route public trong IndexController
        const res = await fetch('/api/category', {
            headers: { Accept: 'application/json' }
        });

        if (!res.ok) throw new Error(`Lỗi tải danh mục: ${res.status}`);

        const json = await res.json();
        // API IndexController trả về mảng trực tiếp hoặc data
        const categories = Array.isArray(json) ? json : (json.data || []);

        list.innerHTML = '';

        // Render
        categories.forEach(cat => {
            // Bỏ qua danh mục "Chưa phân loại" nếu cần (giả sử ID 1)
            if (cat.id == 1) return; 

            const li = document.createElement('li');
            li.innerHTML = `
                <label style="cursor: pointer;">
                    <input type="checkbox" class="filter-checkbox" value="${cat.slug}">
                    ${cat.name}
                </label>
            `;
            list.appendChild(li);
        });

    } catch (e) {
        console.error(e);
        list.innerHTML = '<li>Không thể tải danh mục</li>';
    }
}

/* ================= LOAD POSTS ================= */

async function loadPosts() {
    const grid = document.getElementById('postGrid');
    if (!grid) return;

    // Hiển thị loading trong lúc đợi
    grid.innerHTML = '<p>Đang tải bài viết...</p>';

    try {
        const res = await fetch('/api/posts', {
            headers: { Accept: 'application/json' }
        });

        if (!res.ok) throw new Error('API error');

        const json = await res.json();
        // IndexController trả về mảng trực tiếp, PostController trả về phân trang
        const posts = Array.isArray(json) ? json : (json.data || []);

        grid.innerHTML = '';

        if (posts.length === 0) {
            grid.innerHTML = '<p>Chưa có bài viết nào.</p>';
            return;
        }

        posts
            .filter(post => post.category && Number(post.category.id) !== 1)
            .forEach(post => {
                const article = document.createElement('article');
                article.className = 'post-card';
                
                // DATASET CATEGORY ĐỂ LỌC
                article.dataset.category = post.category.slug;

                const image = post.thumbnail || '/images/default.jpg';
                // Xử lý ngày tháng an toàn hơn
                const date = post.created_at ? new Date(post.created_at).toLocaleDateString('vi-VN') : '';

                article.innerHTML = `
                    <a href="/bai-viet/${post.slug}">
                        <div class="thumb">
                            <img src="${image}" alt="${post.title}" loading="lazy">
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
        grid.innerHTML = '<p>Lỗi tải bài viết. Vui lòng thử lại sau.</p>';
    }
}

/* ================= FILTER LOGIC (EVENT DELEGATION) ================= */

document.addEventListener('change', function (e) {
    if (!e.target.classList.contains('filter-checkbox')) return;

    const checkedValues = Array.from(
        document.querySelectorAll('.filter-checkbox:checked')
    ).map(cb => cb.value);

    const posts = document.querySelectorAll('.post-card');
    let hasVisiblePost = false;

    posts.forEach(post => {
        const category = post.dataset.category;
        
        // Logic: Nếu không tick cái nào HOẶC category bài viết nằm trong list đã tick
        const isVisible = checkedValues.length === 0 || checkedValues.includes(category);

        post.style.display = isVisible ? 'block' : 'none';
        
        if (isVisible) hasVisiblePost = true;
    });

    // Xử lý hiển thị thông báo nếu lọc không ra bài nào
    const noResultMsg = document.getElementById('no-result-msg');
    if (!hasVisiblePost) {
        if (!noResultMsg) {
            const msg = document.createElement('p');
            msg.id = 'no-result-msg';
            msg.textContent = 'Không có bài viết thuộc danh mục này.';
            msg.style.textAlign = 'center';
            msg.style.width = '100%';
            document.getElementById('postGrid').appendChild(msg);
        } else {
            noResultMsg.style.display = 'block';
        }
    } else {
        if (noResultMsg) noResultMsg.style.display = 'none';
    }
});