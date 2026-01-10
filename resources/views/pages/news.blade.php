@extends('layouts.layouts')

@section('title', 'Tin Tức Du Lịch')

@section('body_class', 'news-page')

@section('content')
<div class="news-container">
    <div class="container">
        <!-- Hero Section -->
        <div class="news-hero">
            <h1>Tin Tức Du Lịch</h1>
            <p>Khám phá những điểm đến tuyệt vời, kinh nghiệm du lịch và xu hướng mới nhất trong thế giới du lịch Việt Nam</p>
        </div>

        <!-- Filter Tabs -->
        <div class="news-filters">
            <button class="filter-btn active" data-category="all">Tất Cả</button>
            <button class="filter-btn" data-category="destination">Điểm Đến</button>
            <button class="filter-btn" data-category="experience">Trải Nghiệm</button>
            <button class="filter-btn" data-category="food">Ẩm Thực</button>
            <button class="filter-btn" data-category="culture">Văn Hóa</button>
        </div>

        <!-- News Grid -->
        <div class="news-grid">
            <!-- Featured Article -->
            <article class="news-card featured-article" data-category="destination">
                <div class="news-card-image">
                    <img src="https://images.unsplash.com/photo-1559827260-dc66d52bef19?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Vịnh Hạ Long">
                    <span class="news-category">Điểm Đến</span>
                    <span class="news-date">15 Tháng 1, 2024</span>
                </div>
                <div class="news-content">
                    <h2 class="news-title">Vịnh Hạ Long - Kỳ Quan Thiên Nhiên Thế Giới Tại Việt Nam</h2>
                    <p class="news-excerpt">Khám phá vẻ đẹp huyền bí của Vịnh Hạ Long với hàng nghìn đảo đá vôi nhô lên từ mặt nước xanh biếc. Tìm hiểu lịch sử hình thành, những hoạt động thú vị và kinh nghiệm du lịch tại kỳ quan thiên nhiên thế giới này.</p>
                    <a href="#" class="read-more-btn">Đọc Thêm</a>
                </div>
            </article>

            <!-- Regular Articles -->
            <article class="news-card" data-category="experience">
                <div class="news-card-image">
                    <img src="https://images.unsplash.com/photo-1578662996442-48f60103fc96?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Sapa">
                    <span class="news-category">Trải Nghiệm</span>
                    <span class="news-date">12 Tháng 1, 2024</span>
                </div>
                <div class="news-content">
                    <h3 class="news-title">Trekking Sapa: Chinh Phục Đỉnh Fansipan Nóc Nhà Đông Dương</h3>
                    <p class="news-excerpt">Hành trình chinh phục đỉnh Fansipan cao 3.143m với những thử thách thú vị và cảnh quan tuyệt đẹp. Chia sẻ kinh nghiệm chuẩn bị, lộ trình và những điều cần lưu ý.</p>
                    <a href="#" class="read-more-btn">Đọc Thêm</a>
                </div>
            </article>

            <article class="news-card" data-category="food">
                <div class="news-card-image">
                    <img src="https://images.unsplash.com/photo-1559181567-c3190ca9959b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2064&q=80" alt="Phở Việt Nam">
                    <span class="news-category">Ẩm Thực</span>
                    <span class="news-date">10 Tháng 1, 2024</span>
                </div>
                <div class="news-content">
                    <h3 class="news-title">Hành Trình Khám Phá Ẩm Thực Đường Phố Hà Nội</h3>
                    <p class="news-excerpt">Từ tô phở nóng hổi buổi sáng đến chén chè đậu xanh mát lạnh buổi chiều, khám phá tinh hoa ẩm thực đường phố Thủ đô với những món ăn truyền thống đậm đà hương vị.</p>
                    <a href="#" class="read-more-btn">Đọc Thêm</a>
                </div>
            </article>

            <article class="news-card" data-category="culture">
                <div class="news-card-image">
                    <img src="https://images.unsplash.com/photo-1583417319070-4a69db38a482?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Hội An">
                    <span class="news-category">Văn Hóa</span>
                    <span class="news-date">8 Tháng 1, 2024</span>
                </div>
                <div class="news-content">
                    <h3 class="news-title">Hội An - Thành Phố Cổ Với Nét Đẹp Văn Hóa Đa Dạng</h3>
                    <p class="news-excerpt">Tìm hiểu về lịch sử hình thành và phát triển của phố cổ Hội An, nơi giao thoa văn hóa Việt - Trung - Nhật tạo nên một bức tranh văn hóa độc đáo và phong phú.</p>
                    <a href="#" class="read-more-btn">Đọc Thêm</a>
                </div>
            </article>

            <article class="news-card" data-category="destination">
                <div class="news-card-image">
                    <img src="https://images.unsplash.com/photo-1528127269322-539801943592?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Phú Quốc">
                    <span class="news-category">Điểm Đến</span>
                    <span class="news-date">5 Tháng 1, 2024</span>
                </div>
                <div class="news-content">
                    <h3 class="news-title">Phú Quốc - Đảo Ngọc Với Bãi Biển Tuyệt Đẹp</h3>
                    <p class="news-excerpt">Khám phá vẻ đẹp hoang sơ của đảo Phú Quốc với những bãi biển cát trắng, nước biển trong xanh và hệ sinh thái biển phong phú. Cùng tìm hiểu các hoạt động du lịch hấp dẫn tại đây.</p>
                    <a href="#" class="read-more-btn">Đọc Thêm</a>
                </div>
            </article>

            <article class="news-card" data-category="experience">
                <div class="news-card-image">
                    <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Mekong Delta">
                    <span class="news-category">Trải Nghiệm</span>
                    <span class="news-date">3 Tháng 1, 2024</span>
                </div>
                <div class="news-content">
                    <h3 class="news-title">Du Ngoạn Đồng Bằng Sông Cửu Long Trên Thuyền</h3>
                    <p class="news-excerpt">Trải nghiệm cuộc sống sông nước miền Tây qua chuyến du ngoạn trên các kênh rạch, thăm vườn trái cây và khám phá chợ nổi độc đáo của vùng đất phù sa màu mỡ.</p>
                    <a href="#" class="read-more-btn">Đọc Thêm</a>
                </div>
            </article>
        </div>

        <!-- Load More Button -->
        <div class="load-more-section">
            <button class="load-more-btn">Xem Thêm Tin Tức</button>
        </div>
    </div>
</div>

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Filter functionality
    const filterBtns = document.querySelectorAll('.filter-btn');
    const newsCards = document.querySelectorAll('.news-card');
    
    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Remove active class from all buttons
            filterBtns.forEach(b => b.classList.remove('active'));
            // Add active class to clicked button
            this.classList.add('active');
            
            const category = this.getAttribute('data-category');
            
            // Filter news cards
            newsCards.forEach(card => {
                if (category === 'all' || card.getAttribute('data-category') === category) {
                    card.style.display = 'block';
                    card.style.animation = 'fadeInUp 0.6s ease';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
    
    // Load more functionality
    const loadMoreBtn = document.querySelector('.load-more-btn');
    loadMoreBtn.addEventListener('click', function() {
        // Simulate loading more content
        this.textContent = 'Đang tải...';
        setTimeout(() => {
            this.textContent = 'Xem Thêm Tin Tức';
            // Here you would typically load more articles via AJAX
        }, 1000);
    });
    
    // Smooth scroll for read more buttons
    document.querySelectorAll('.read-more-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            // Add your navigation logic here
        });
    });
});
</script>
@endsection
@endsection