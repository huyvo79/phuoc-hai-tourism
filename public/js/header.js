document.addEventListener('DOMContentLoaded', () => {
    // --- 1. XỬ LÝ HEADER CUỘN (SCROLL) ---
    const header = document.getElementById('main-header');
    
    const handleScroll = () => {
        if (window.scrollY > 50) {
            header.classList.remove('bg-transparent', 'text-white', 'py-4');
            header.classList.add('bg-white/90', 'backdrop-blur-md', 'text-slate-900', 'shadow-md', 'py-2');
        } else {
            header.classList.add('bg-transparent', 'text-white', 'py-4');
            header.classList.remove('bg-white/90', 'backdrop-blur-md', 'text-slate-900', 'shadow-md', 'py-2');
        }
    };

    window.addEventListener('scroll', handleScroll);
    // Gọi ngay 1 lần để check trạng thái khi f5 trang mà đang ở giữa trang
    handleScroll();

    // --- 2. XỬ LÝ MOBILE MENU (LOGIC HIDDEN) ---
    const mobileBtn = document.getElementById('mobile-menu-btn');
    const mobileOverlay = document.getElementById('mobile-menu-overlay');
    const closeMobileBtn = document.getElementById('close-mobile-menu');
    const mobileLinks = document.querySelectorAll('.mobile-link');
    const mobileSearchBtn = document.getElementById('mobile-search-btn');
    const mobileSearchInput = document.getElementById('mobile-search-input');

    // Hàm MỞ menu
    const openMenu = () => {
        // Bước 1: Hiển thị element trước (nhưng vẫn đang ở ngoài màn hình)
        mobileOverlay.classList.remove('hidden');
        
        // Bước 2: Dùng setTimeout nhỏ để trình duyệt kịp nhận ra element đã hiện
        // sau đó mới kích hoạt transition trượt vào
        setTimeout(() => {
            mobileOverlay.classList.remove('translate-x-full');
        }, 10);
    };

    // Hàm ĐÓNG menu
    const closeMenu = () => {
        // Bước 1: Trượt ra ngoài trước
        mobileOverlay.classList.add('translate-x-full');
        
        // Bước 2: Đợi chạy xong animation (300ms) rồi mới ẩn hoàn toàn
        setTimeout(() => {
            mobileOverlay.classList.add('hidden');
        }, 300);
    };

    // Gán sự kiện
    if (mobileBtn) mobileBtn.addEventListener('click', openMenu);
    if (closeMobileBtn) closeMobileBtn.addEventListener('click', closeMenu);

    // Đóng khi click vào link bên trong
    mobileLinks.forEach(link => {
        link.addEventListener('click', closeMenu);
    });

    // Đóng khi tìm kiếm
    if (mobileSearchBtn) {
        mobileSearchBtn.addEventListener('click', closeMenu);
    }
    
    if (mobileSearchInput) {
        mobileSearchInput.addEventListener('keyup', (e) => {
            if (e.key === 'Enter') closeMenu();
        });
    }
});