 // ==================== HEADER SCROLL EFFECT ====================
        const header = document.getElementById('header');

        window.addEventListener('scroll', () => {
            if (window.scrollY > 100) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });

        // ==================== MOBILE MENU ====================
        const menuToggle = document.getElementById('menuToggle');
        const mobileMenu = document.getElementById('mobileMenu');
        const mobileOverlay = document.getElementById('mobileOverlay');

        menuToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('active');
            mobileOverlay.classList.toggle('active');
        });

        mobileOverlay.addEventListener('click', () => {
            mobileMenu.classList.remove('active');
            mobileOverlay.classList.remove('active');
        });

        // Close mobile menu on link click
        document.querySelectorAll('.mobile-menu a').forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.remove('active');
                mobileOverlay.classList.remove('active');
            });
        });

        // ==================== SCROLL ANIMATIONS ====================
        const observerOptions = {
            threshold: 0.2,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate');

                    // Trigger counter animation for stats
                    if (entry.target.classList.contains('intro-content')) {
                        animateCounters();
                    }
                }
            });
        }, observerOptions);

        document.querySelectorAll('.intro-images, .intro-content').forEach(el => {
            observer.observe(el);
        });

        // ==================== COUNTER ANIMATION ====================
        let countersAnimated = false;

        function animateCounters() {
            if (countersAnimated) return;
            countersAnimated = true;

            const counters = document.querySelectorAll('.stat-number');

            counters.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-target'));
                const duration = 2000;
                const step = target / (duration / 16);
                let current = 0;

                const updateCounter = () => {
                    current += step;
                    if (current < target) {
                        counter.textContent = Math.floor(current) + '+';
                        requestAnimationFrame(updateCounter);
                    } else {
                        counter.textContent = target + (target === 10 ? 'M+' : '+');
                    }
                };

                updateCounter();
            });
        }

        // ==================== CATEGORY TABS ====================
        const categoryTabs = document.querySelectorAll('.category-tab');
        const categoryContents = document.querySelectorAll('.category-content');
        const categorySelect = document.getElementById('categorySelect');

        function switchCategory(categoryId) {
            // Update tabs
            categoryTabs.forEach(tab => {
                tab.classList.remove('active');
                if (tab.dataset.category === categoryId) {
                    tab.classList.add('active');
                }
            });

            // Update content
            categoryContents.forEach(content => {
                content.classList.remove('active');
                if (content.dataset.content === categoryId) {
                    content.classList.add('active');
                }
            });

            // Update select
            categorySelect.value = categoryId;
        }

        categoryTabs.forEach(tab => {
            tab.addEventListener('click', () => {
                switchCategory(tab.dataset.category);
            });
        });

        categorySelect.addEventListener('change', (e) => {
            switchCategory(e.target.value);
        });

        // ==================== SMOOTH SCROLL ====================
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        const searchToggle = document.querySelector('.search-btn');
        const mobileSearch = document.getElementById('mobileSearch');

        searchToggle.addEventListener('click', (e) => {
            e.stopPropagation();
            mobileSearch.classList.toggle('active');
        });

        /* click ra ngoài thì đóng */
        document.addEventListener('click', () => {
            mobileSearch.classList.remove('active');
        });

        mobileSearch.addEventListener('click', e => e.stopPropagation());