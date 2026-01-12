document.addEventListener('DOMContentLoaded', () => {

    // --- LƯU Ý: Phần xử lý Header và Menu Mobile đã được chuyển sang file js/header.js
    // để tương thích với giao diện Tailwind mới.

    /* ==================== SCROLL ANIMATION (HIỆU ỨNG HIỆN KHI CUỘN) ==================== */
    // Áp dụng cho phần Intro và ảnh
    const animatedElements = document.querySelectorAll('.intro-images, .intro-content');

    if (animatedElements.length) {
        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate');
                }
            });
        }, { threshold: 0.2 });

        animatedElements.forEach(el => observer.observe(el));
    }

    /* ==================== COUNTER ANIMATION (HIỆU ỨNG SỐ NHẢY) ==================== */
    // Áp dụng cho phần thống kê (300+, 1000+, 10+)
    const counters = document.querySelectorAll('.stat-number');
    let countersAnimated = false;

    function animateCounters() {
        if (countersAnimated) return;
        countersAnimated = true;

        counters.forEach(counter => {
            const target = parseInt(counter.dataset.target, 10);
            if (!target) return;

            const duration = 2000; // Thời gian chạy (ms)
            const step = target / (duration / 16);
            let current = 0;

            const update = () => {
                current += step;
                if (current < target) {
                    counter.textContent = Math.floor(current) + '+';
                    requestAnimationFrame(update);
                } else {
                    counter.textContent = target + '+';
                }
            };

            update();
        });
    }

    if (counters.length) {
        const counterObserver = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounters();
                }
            });
        }, { threshold: 0.3 });

        counters.forEach(el => counterObserver.observe(el));
    }

    /* ==================== CATEGORY TABS (CHUYỂN TAB KHÁM PHÁ) ==================== */
    // Áp dụng cho phần "Khám phá theo chủ đề"
    const categoryTabs = document.querySelectorAll('.category-tab');
    const categoryContents = document.querySelectorAll('.category-content');
    const categorySelect = document.getElementById('categorySelect');

    if (categoryTabs.length && categoryContents.length) {

        const switchCategory = id => {
            // Xử lý nút bấm Desktop
            categoryTabs.forEach(tab =>
                tab.classList.toggle('active', tab.dataset.category === id)
            );

            // Xử lý nội dung hiển thị
            categoryContents.forEach(content =>
                content.classList.toggle('active', content.dataset.content === id)
            );

            // Đồng bộ với Select box (Mobile)
            if (categorySelect) categorySelect.value = id;
        };

        // Click vào Tab (Desktop)
        categoryTabs.forEach(tab => {
            tab.addEventListener('click', () => {
                switchCategory(tab.dataset.category);
            });
        });

        // Chọn Option (Mobile)
        if (categorySelect) {
            categorySelect.addEventListener('change', e => {
                switchCategory(e.target.value);
            });
        }
    }

    /* ==================== SMOOTH SCROLL (CUỘN MƯỢT) ==================== */
    // Xử lý khi click vào các link neo (vd: #explore)
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', e => {
            const href = anchor.getAttribute('href');
            if (href === '#') return; // Bỏ qua nếu chỉ là dấu #

            const target = document.querySelector(href);
            if (!target) return;

            e.preventDefault();
            
            // Tính toán vị trí trừ đi chiều cao Header (để không bị che khuất)
            const headerHeight = document.getElementById('main-header')?.offsetHeight || 80;
            const elementPosition = target.getBoundingClientRect().top;
            const offsetPosition = elementPosition + window.pageYOffset - headerHeight;

            window.scrollTo({
                top: offsetPosition,
                behavior: "smooth"
            });
        });
    });

});