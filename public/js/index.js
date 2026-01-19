document.addEventListener('DOMContentLoaded', () => {
    /* ==================== CẤU HÌNH CHUNG ==================== */
    const CONFIG = {
        API_URL: '/api', // Đảm bảo route api của bạn đúng
        IMAGE_BASE_URL: '', // Để trống nếu ảnh lưu full path, hoặc điền folder gốc
        DEFAULT_IMAGE: 'images/default-placeholder.png',
        HEADER_ID: 'header' // ID của thanh nav
    };

    /* ==================== 1. UI ANIMATIONS & EFFECTS ==================== */

    // 1.1. Scroll Animation (Hiệu ứng hiện khi cuộn)
    const animatedElements = document.querySelectorAll('.intro-images, .intro-content');
    if (animatedElements.length) {
        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) entry.target.classList.add('animate');
            });
        }, { threshold: 0.2 });
        animatedElements.forEach(el => observer.observe(el));
    }

    // 1.2. Counter Animation (Số nhảy)
    const counters = document.querySelectorAll('.stat-number');
    if (counters.length) {
        const animateCounters = () => {
            counters.forEach(counter => {
                const target = parseInt(counter.dataset.target, 10);
                if (!target || counter.classList.contains('counted')) return; // Tránh chạy lại

                counter.classList.add('counted');
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
        };

        const counterObserver = new IntersectionObserver(entries => {
            if (entries[0].isIntersecting) animateCounters();
        }, { threshold: 0.3 });
        counters.forEach(el => counterObserver.observe(el));
    }

    // 1.3. Header Scroll Effect
    const mainHeader = document.getElementById(CONFIG.HEADER_ID);
    if (mainHeader) {
        window.addEventListener('scroll', () => {
            mainHeader.classList.toggle('scrolled', window.scrollY > 50);
        });
    }

    // 1.4. Smooth Scroll cho thẻ a href="#"
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', e => {
            const href = anchor.getAttribute('href');
            if (href === '#' || href.length < 2) return;

            const target = document.querySelector(href);
            if (!target) return;

            e.preventDefault();
            const headerHeight = mainHeader ? mainHeader.offsetHeight : 80;
            const elementPosition = target.getBoundingClientRect().top;

            window.scrollTo({
                top: elementPosition + window.pageYOffset - headerHeight,
                behavior: "smooth"
            });
        });
    });

    /* ==================== 2. DATA LOGIC (API & RENDERING) ==================== */

    const tabsContainer = document.getElementById('categoryTabs');
    const selectContainer = document.getElementById('categorySelect');
    const introContainer = document.getElementById('categoryIntro');
    const gridContainer = document.getElementById('categoryGrid');

    let categoriesData = [];
    let postsData = [];

    // Hàm khởi tạo dữ liệu
    async function initData() {
        if (!gridContainer) return; // Không chạy nếu không ở trang chủ

        try {
            // Hiển thị loading
            gridContainer.innerHTML = '<p style="text-align:center; width:100%">Đang tải dữ liệu...</p>';

            const [catRes, postRes] = await Promise.all([
                fetch(`${CONFIG.API_URL}/categories`, { headers: { 'Accept': 'application/json' } }),
                fetch(`${CONFIG.API_URL}/posts`, { headers: { 'Accept': 'application/json' } })
            ]);

            if (!catRes.ok || !postRes.ok) throw new Error('Lỗi kết nối Server');

            const catJson = await catRes.json();
            const postJson = await postRes.json();

            // Xử lý dữ liệu trả về (hỗ trợ cả dạng bọc trong data: {} hoặc mảng trực tiếp)
            categoriesData = Array.isArray(catJson.data) ? catJson.data : (Array.isArray(catJson) ? catJson : []);
            postsData = Array.isArray(postJson.data) ? postJson.data : (Array.isArray(postJson) ? postJson : []);

            if (categoriesData.length > 0) {
                renderTabs();
                // Chọn category đầu tiên
                const firstId = parseInt(categoriesData[0].id);
                handleCategoryChange(firstId);
            } else {
                tabsContainer.innerHTML = '<p>Không có danh mục nào.</p>';
                gridContainer.innerHTML = '';
            }

        } catch (error) {
            console.error("Lỗi:", error);
            gridContainer.innerHTML = '<p style="text-align:center; color:red">Không thể tải dữ liệu.</p>';
            if (tabsContainer) tabsContainer.innerHTML = '';
        }
    }

    // Render Tabs (Buttons & Dropdown)
    function renderTabs() {
        if (!tabsContainer) return;

        // Dùng Fragment để tối ưu DOM
        const tabFragment = document.createDocumentFragment();
        const selectFragment = document.createDocumentFragment();

        categoriesData.forEach((cat, index) => {
            const catId = parseInt(cat.id);

            // 1. Desktop Buttons
            const btn = document.createElement('button');
            btn.className = 'category-tab'; // Bỏ active lúc đầu, sẽ set sau
            btn.textContent = cat.name;
            btn.dataset.id = catId;
            btn.onclick = () => handleCategoryChange(catId);
            tabFragment.appendChild(btn);

            // 2. Mobile Options
            const option = document.createElement('option');
            option.value = catId;
            option.textContent = cat.name;
            selectFragment.appendChild(option);
        });

        tabsContainer.innerHTML = '';
        tabsContainer.appendChild(tabFragment);

        if (selectContainer) {
            selectContainer.innerHTML = '';
            selectContainer.appendChild(selectFragment);

            // Sự kiện change cho Mobile
            selectContainer.addEventListener('change', function () {
                handleCategoryChange(parseInt(this.value));
            });
        }
    }

    // Xử lý khi đổi danh mục
    function handleCategoryChange(catId) {
        // 1. Active Tab Desktop
        document.querySelectorAll('.category-tab').forEach(btn => {
            btn.classList.toggle('active', parseInt(btn.dataset.id) === catId);
        });

        // 2. Sync Mobile Dropdown
        if (selectContainer) selectContainer.value = catId;

        // 3. Render Intro
        const currentCat = categoriesData.find(c => parseInt(c.id) === catId);
        if (introContainer && currentCat) {
            introContainer.innerHTML = `
                <h3>${currentCat.name}</h3>
                <p>${currentCat.description || 'Khám phá những điều tuyệt vời nhất.'}</p>
            `;
        }

        // 4. Render Grid Posts
        renderPosts(catId);
    }

    // Render danh sách bài viết
    function renderPosts(catId) {
        gridContainer.innerHTML = '';

        // Lọc bài viết
        const filteredPosts = postsData.filter(post => parseInt(post.category_id) === catId);

        if (filteredPosts.length === 0) {
            gridContainer.innerHTML = `
                <div style="grid-column: 1/-1; text-align: center; padding: 40px;">
                    <p style="color: #64748b;">Chưa có bài viết nào trong mục này.</p>
                </div>`;
            return;
        }

        const postFragment = document.createDocumentFragment();

        filteredPosts.forEach(post => {
            // Xử lý ảnh (giữ nguyên)
            let imageUrl = CONFIG.DEFAULT_IMAGE;
            const imgPath = post.thumbnail || post.image;
            if (imgPath) {
                imageUrl = imgPath.startsWith('http') ? imgPath : CONFIG.IMAGE_BASE_URL + imgPath;
            }

            // === THAY ĐỔI Ở ĐÂY ===
            // 1. Đổi từ 'div' sang 'a'
            const card = document.createElement('a');

            // 2. Thêm đường dẫn (Thay '/chi-tiet/' bằng route thực tế của bạn, ví dụ: /post/ hoặc /tour/)
            // Ưu tiên dùng slug nếu có, nếu không thì dùng id
            // card.href = `/single/${post.slug || post.id}`;
            card.href = `/bai-viet/${post.slug}`;


            card.className = 'category-card';

            // HTML nội dung (Giữ nguyên)
            card.innerHTML = `
                <div class="category-card-img">
                    <img src="${imageUrl}" alt="${post.title}" loading="lazy" onerror="this.src='${CONFIG.DEFAULT_IMAGE}'">
                </div>
                <div class="category-card-content">
                    <h4>${post.title}</h4>
                    ${post.phone ? `<h5>SĐT: ${post.phone}</h5>` : ''}
                    <p class="line-clamp-3">${post.summary || post.description || ''}</p>
                </div>
            `;
            postFragment.appendChild(card);
        });

        gridContainer.appendChild(postFragment);

        // Animation fade-in nhẹ
        gridContainer.animate([
            { opacity: 0, transform: 'translateY(10px)' },
            { opacity: 1, transform: 'translateY(0)' }
        ], { duration: 400, easing: 'ease-out' });
    }

    // Chạy hàm khởi tạo
    initData();
    /* ==================== 3. SLIDER TƯƠNG TÁC KÉO THẢ ==================== */
    const sliderContainer = document.querySelector('.slider-container');
    const sliderTrack = document.querySelector('.slider-track');
    if (!sliderContainer || !sliderTrack) return;

    let isDown = false;
    let startX;
    let scrollLeft;
    let velocity = 0;
    let lastX = 0;
    let lastTime = 0;


    sliderContainer.addEventListener('touchstart', (e) => {
        isDown = true;
        sliderTrack.style.animationPlayState = 'paused';
        startX = e.touches[0].pageX - sliderContainer.offsetLeft;
        scrollLeft = sliderContainer.scrollLeft;
        lastX = e.touches[0].pageX;
        lastTime = Date.now();
    });

    sliderContainer.addEventListener('touchmove', (e) => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.touches[0].pageX - sliderContainer.offsetLeft;
        const walk = (x - startX) * 2;
        sliderContainer.scrollLeft = scrollLeft - walk;

        const now = Date.now();
        const deltaX = e.touches[0].pageX - lastX;
        const deltaTime = now - lastTime;
        velocity = deltaX / deltaTime;
        lastX = e.touches[0].pageX;
        lastTime = now;
    });

    sliderContainer.addEventListener('touchend', () => {
        isDown = false;
        if (Math.abs(velocity) > 0.5) {
            const momentumScroll = () => {
                sliderContainer.scrollLeft -= velocity * 10;
                velocity *= 0.95;

                if (Math.abs(velocity) > 0.1) {
                    requestAnimationFrame(momentumScroll);
                } else {
                    setTimeout(() => {
                        sliderTrack.style.animationPlayState = 'running';
                    }, 1000);
                }
            };
            momentumScroll();
        } else {
            sliderTrack.style.animationPlayState = 'running';
        }
    });

    sliderTrack.addEventListener('mouseenter', () => {
        sliderTrack.style.animationPlayState = 'paused';
    });

    sliderTrack.addEventListener('mouseleave', () => {
        sliderTrack.style.animationPlayState = 'running';
    });

    const track = document.querySelector('.slider-track');

    if (track) {
        const originalCount = track.children.length;

        // nhân đôi để chạy vô hạn
        track.innerHTML += track.innerHTML;

        function setSpeed() {
            const w = window.innerWidth;

            let secondsPerSlide;

            if (w <= 480) {
                secondsPerSlide = 2;   // 📱 mobile rất nhanh
            } else if (w <= 768) {
                secondsPerSlide = 1.3;   // 📱 tablet / mobile lớn
            } else {
                secondsPerSlide = 1;     // 🖥 desktop (nhanh hơn trước)
            }

            track.style.animationDuration = `${originalCount * secondsPerSlide}s`;
        }

        setSpeed();
        window.addEventListener('resize', setSpeed);
    }

});