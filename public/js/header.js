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