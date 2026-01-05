document.addEventListener('DOMContentLoaded', () => {

    /* ==================== HEADER SCROLL EFFECT ==================== */
    const header = document.getElementById('header');
    if (header) {
        const handleScroll = () => {
            header.classList.toggle('scrolled', window.scrollY > 100);
        };
        handleScroll();
        window.addEventListener('scroll', handleScroll);
    }

    /* ==================== MOBILE MENU ==================== */
    const menuToggle = document.getElementById('menuToggle');
    const mobileMenu = document.getElementById('mobileMenu');
    const mobileOverlay = document.getElementById('mobileOverlay');

    if (menuToggle && mobileMenu && mobileOverlay) {
        menuToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('active');
            mobileOverlay.classList.toggle('active');
        });

        mobileOverlay.addEventListener('click', () => {
            mobileMenu.classList.remove('active');
            mobileOverlay.classList.remove('active');
        });

        document.querySelectorAll('.mobile-menu a').forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.remove('active');
                mobileOverlay.classList.remove('active');
            });
        });
    }

    /* ==================== SEARCH MOBILE ==================== */
    const searchToggle = document.querySelector('.search-btn');
    const mobileSearch = document.getElementById('mobileSearch');

    if (searchToggle && mobileSearch) {
        searchToggle.addEventListener('click', e => {
            e.stopPropagation();
            mobileSearch.classList.toggle('active');
        });

        document.addEventListener('click', () => {
            mobileSearch.classList.remove('active');
        });

        mobileSearch.addEventListener('click', e => e.stopPropagation());
    }

    /* ==================== SCROLL ANIMATION ==================== */
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

    /* ==================== COUNTER ANIMATION ==================== */
    const counters = document.querySelectorAll('.stat-number');
    let countersAnimated = false;

    function animateCounters() {
        if (countersAnimated) return;
        countersAnimated = true;

        counters.forEach(counter => {
            const target = parseInt(counter.dataset.target, 10);
            if (!target) return;

            const duration = 2000;
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

    /* ==================== CATEGORY TABS ==================== */
    const categoryTabs = document.querySelectorAll('.category-tab');
    const categoryContents = document.querySelectorAll('.category-content');
    const categorySelect = document.getElementById('categorySelect');

    if (categoryTabs.length && categoryContents.length && categorySelect) {

        const switchCategory = id => {
            categoryTabs.forEach(tab =>
                tab.classList.toggle('active', tab.dataset.category === id)
            );

            categoryContents.forEach(content =>
                content.classList.toggle('active', content.dataset.content === id)
            );

            categorySelect.value = id;
        };

        categoryTabs.forEach(tab => {
            tab.addEventListener('click', () => {
                switchCategory(tab.dataset.category);
            });
        });

        categorySelect.addEventListener('change', e => {
            switchCategory(e.target.value);
        });
    }

    /* ==================== SMOOTH SCROLL ==================== */
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', e => {
            const target = document.querySelector(anchor.getAttribute('href'));
            if (!target) return;
            e.preventDefault();
            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        });
    });

});
