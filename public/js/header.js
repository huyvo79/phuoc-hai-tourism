document.addEventListener('DOMContentLoaded', () => {

    const header = document.getElementById('main-header');

    const mobileBtn = document.getElementById('mobile-menu-btn');
    const mobileOverlay = document.getElementById('mobile-menu-overlay');
    const closeMobileBtn = document.getElementById('close-mobile-menu');

    const searchTrigger = document.getElementById('mobile-search-trigger');
    const searchBar = document.getElementById('mobile-search-bar');
    const searchInput = document.getElementById('mobile-search-bar-input');

    /* =====================
       HEADER SCROLL
    ====================== */
    const handleScroll = () => {
        const isSearchOpen =
            searchBar && !searchBar.classList.contains('scale-y-0');

        if (window.scrollY > 50 || isSearchOpen) {
            header.classList.remove('bg-transparent', 'text-white');
            header.classList.add(
                'bg-white/90',
                'backdrop-blur-md',
                'text-slate-900',
                'shadow-md',
            );
        } else {
            header.classList.add('bg-transparent', 'text-white');
            header.classList.remove(
                'bg-white/90',
                'backdrop-blur-md',
                'text-slate-900',
                'shadow-md',
            );
        }
    };

    window.addEventListener('scroll', handleScroll);
    handleScroll();

    /* =====================
       MOBILE MENU
    ====================== */
    const toggleMenu = (open) => {
        if (!mobileOverlay) return;

        if (open) {
            mobileOverlay.classList.remove('hidden');
            // Sửa translate-x-full thành -translate-x-full (thêm dấu trừ)
            setTimeout(() => mobileOverlay.classList.remove('-translate-x-full'), 10);

            document.body.classList.add('overflow-hidden');

            if (searchBar) toggleSearchBar(false);
        } else {
            // Sửa translate-x-full thành -translate-x-full (thêm dấu trừ)
            mobileOverlay.classList.add('-translate-x-full');
            
            setTimeout(() => mobileOverlay.classList.add('hidden'), 300);

            document.body.classList.remove('overflow-hidden');
        }
    };

    if (mobileBtn) mobileBtn.addEventListener('click', () => toggleMenu(true));
    if (closeMobileBtn) closeMobileBtn.addEventListener('click', () => toggleMenu(false));

    // Lấy tất cả các thẻ a có class .mobile-link
    const mobileLinks = document.querySelectorAll('.mobile-link');
    
    // Duyệt qua từng link và gán sự kiện click
    mobileLinks.forEach(link => {
        link.addEventListener('click', () => {
            // Khi click vào link thì gọi hàm đóng menu
            toggleMenu(false); 
        });
    });

    /* =====================
       MOBILE SEARCH
    ====================== */
    const toggleSearchBar = (show) => {
        if (!searchBar) return;

        if (show) {
            searchBar.classList.remove('scale-y-0', 'opacity-0');
            setTimeout(() => searchInput?.focus(), 100);
            toggleMenu(false);
        } else {
            searchBar.classList.add('scale-y-0', 'opacity-0');
        }

        handleScroll();
    };

    if (searchTrigger && searchBar) {
        searchTrigger.addEventListener('click', (e) => {
            e.stopPropagation();
            const isClosed = searchBar.classList.contains('scale-y-0');
            toggleSearchBar(isClosed);
        });

        document.addEventListener('click', (e) => {
            if (
                !header.contains(e.target) &&
                !mobileOverlay.contains(e.target)
            ) {
                toggleSearchBar(false);
            }
        });

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') toggleSearchBar(false);
        });
    }
});


