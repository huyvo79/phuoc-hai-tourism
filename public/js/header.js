document.addEventListener('DOMContentLoaded', () => {
    /* --- 1. KHAI BÁO BIẾN --- */
    const menuToggle = document.getElementById('menuToggle');
    const mobileMenu = document.getElementById('mobileMenu');
    const mobileOverlay = document.getElementById('mobileOverlay');
    const mobileSearchBtn = document.getElementById('mobileSearchBtn');
    const mobileSearchPanel = document.getElementById('mobileSearch');
    const header = document.getElementById('header');

    // Hàm đóng tất cả (Dùng chung cho gọn)
    function closeAll() {
        if (menuToggle) menuToggle.classList.remove('active');
        if (mobileMenu) mobileMenu.classList.remove('active');
        if (mobileOverlay) mobileOverlay.classList.remove('active');
        if (mobileSearchPanel) mobileSearchPanel.classList.remove('active');
    }

    /* --- 2. XỬ LÝ MENU TRÁI --- */
    if (menuToggle) {
        menuToggle.addEventListener('click', (e) => {
            e.stopPropagation();
            // Đóng search nếu đang mở
            if (mobileSearchPanel && mobileSearchPanel.classList.contains('active')) {
                mobileSearchPanel.classList.remove('active');
            }
            menuToggle.classList.toggle('active');
            mobileMenu.classList.toggle('active');
            mobileOverlay.classList.toggle('active');
        });
    }

    // [QUAN TRỌNG] Bấm vào link bên trong menu -> Đóng menu ngay
    const menuLinks = document.querySelectorAll('.mobile-menu a');
    menuLinks.forEach(link => {
        link.addEventListener('click', () => {
            closeAll();
        });
    });

    /* --- 3. XỬ LÝ SEARCH PHẢI --- */
    if (mobileSearchBtn) {
        mobileSearchBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            // Đóng menu nếu đang mở
            if (mobileMenu && mobileMenu.classList.contains('active')) {
                menuToggle.classList.remove('active');
                mobileMenu.classList.remove('active');
                mobileOverlay.classList.remove('active');
            }
            mobileSearchPanel.classList.toggle('active');

            // Focus vào ô input
            if (mobileSearchPanel.classList.contains('active')) {
                const input = mobileSearchPanel.querySelector('input');
                if (input) setTimeout(() => input.focus(), 100);
            }
        });
    }

    /* --- 4. XỬ LÝ CLICK RA NGOÀI (Overlay & Body) --- */
    document.addEventListener('click', (e) => {
        const target = e.target;
        // Nếu click KHÔNG TRÚNG menu, nút menu, search panel, nút search
        const isClickInsideMenu = mobileMenu && mobileMenu.contains(target);
        const isClickInsideSearch = mobileSearchPanel && mobileSearchPanel.contains(target);
        const isClickToggle = menuToggle && menuToggle.contains(target);
        const isClickSearchBtn = mobileSearchBtn && mobileSearchBtn.contains(target);

        if (!isClickInsideMenu && !isClickInsideSearch && !isClickToggle && !isClickSearchBtn) {
            closeAll();
        }
    });

    /* --- 5. HIỆU ỨNG CUỘN HEADER --- */
    if (header) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    }
});

document.addEventListener('DOMContentLoaded', () => {
    // Cấu hình
    const API_URL = '/api/posts/search'; // Route backend
    const DEBOUNCE_TIME = 400; // 0.4 giây sau khi ngừng gõ mới tìm

    // Hàm Debounce (Trì hoãn thực thi)
    function debounce(func, wait) {
        let timeout;
        return function (...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), wait);
        };
    }

    // Hàm render kết quả
    function renderResults(posts, container) {
        container.innerHTML = ''; // Xóa cũ

        if (posts.length === 0) {
            container.innerHTML = '<div class="search-message">Không tìm thấy kết quả nào.</div>';
            return;
        }

        posts.forEach(post => {
            // Xử lý link (giả sử route chi tiết là /bai-viet/{slug})
            const url = `/bai-viet/${post.slug}`;
            // Xử lý ảnh (nếu ko có ảnh thì dùng placeholder)
            const imgUrl = post.thumbnail ? post.thumbnail : '/images/placeholder.jpg';
            const date = new Date(post.created_at).toLocaleDateString('vi-VN');

            const item = document.createElement('a');
            item.href = url;
            item.className = 'search-item';
            item.innerHTML = `
                <img src="${imgUrl}" alt="${post.title}">
                <div class="search-info">
                    <h4>${post.title}</h4>
                    <span>${date}</span>
                </div>
            `;
            container.appendChild(item);
        });
    }

    // Hàm xử lý chính cho từng cặp Input - Result
    function setupLiveSearch(inputId, resultId) {
        const input = document.getElementById(inputId);
        const results = document.getElementById(resultId);

        if (!input || !results) return;

        // Sự kiện khi gõ (Debounced)
        input.addEventListener('input', debounce(async (e) => {
            const query = e.target.value.trim();

            if (query.length < 2) {
                results.classList.remove('active');
                results.innerHTML = '';
                return;
            }

            // Hiện loading (tùy chọn)
            results.classList.add('active');
            results.innerHTML = '<div class="search-message">Đang tìm kiếm...</div>';

            try {
                const response = await fetch(`${API_URL}?q=${encodeURIComponent(query)}`);
                const data = await response.json();
                renderResults(data, results);
            } catch (error) {
                console.error('Lỗi tìm kiếm:', error);
                results.innerHTML = '<div class="search-message">Có lỗi xảy ra.</div>';
            }
        }, DEBOUNCE_TIME));

        // Sự kiện click ra ngoài thì đóng dropdown
        document.addEventListener('click', (e) => {
            if (!input.contains(e.target) && !results.contains(e.target)) {
                results.classList.remove('active');
            }
        });

        // Sự kiện focus lại input thì mở lại dropdown (nếu có kết quả cũ)
        input.addEventListener('focus', () => {
            if (results.innerHTML.trim() !== '') {
                results.classList.add('active');
            }
        });
    }

    // Kích hoạt cho cả Desktop và Mobile
    setupLiveSearch('desktopSearchInput', 'desktopSearchResults');
    setupLiveSearch('mobileSearchInput', 'mobileSearchResults');
});