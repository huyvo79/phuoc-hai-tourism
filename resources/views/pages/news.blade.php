@extends('layouts.layouts')

@section('title', 'Tin Tức Du Lịch')

@section('body_class', 'news-page')

@section('content')
<div class="news-container">
    <div class="container">
        <!-- Hero Section -->
        <div class="news-hero">
            <h1>Tin Tức Khu Du Lịch</h1>
            <p>Cập nhật những thông tin mới nhất về các hoạt động, sự kiện và dịch vụ tại khu du lịch của chúng tôi</p>
        </div>

        <!-- Filter Tabs -->
        <div class="news-filters">
            <button class="filter-btn active" data-category="all">Tất Cả</button>
            <button class="filter-btn" data-category="announcement">Thông Báo</button>
            <button class="filter-btn" data-category="activity">Hoạt Động</button>
            <button class="filter-btn" data-category="service">Dịch Vụ</button>
            <button class="filter-btn" data-category="promotion">Khuyến Mãi</button>
        </div>

        <!-- News Grid -->
        <div class="news-grid">
            <!-- Featured Article -->
            <article class="news-card featured-article" data-category="announcement">
                <div class="news-card-image">
                    <img src="https://images.unsplash.com/photo-1594736797933-d0401ba2fe65?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Khu du lịch mới">
                    <span class="news-category">Thông Báo</span>
                    <span class="news-date">15 Tháng 1, 2024</span>
                </div>
                <div class="news-content">
                    <h2 class="news-title">Khai Trương Khu Vui Chơi Giải Trí Mới - Khu A</h2>
                    <p class="news-excerpt">Chúng tôi vui mừng thông báo khai trương khu vui chơi giải trí hiện đại với nhiều trò chơi hấp dẫn, phục vụ nhu cầu giải trí của cả gia đình. Khu A sẽ chính thức mở cửa từ ngày 20/1/2024.</p>
                    <a href="#" class="read-more-btn">Đọc Thêm</a>
                </div>
            </article>

            <!-- Regular Articles -->
            <article class="news-card" data-category="activity">
                <div class="news-card-image">
                    <img src="https://images.unsplash.com/photo-1578662996442-48f60103fc96?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Hoạt động thể thao">
                    <span class="news-category">Hoạt Động</span>
                    <span class="news-date">12 Tháng 1, 2024</span>
                </div>
                <div class="news-content">
                    <h3 class="news-title">Khai Mạc Giải Bóng Đá Mini Khu Du Lịch 2024</h3>
                    <p class="news-excerpt">Giải đấu bóng đá mini dành cho du khách và nhân viên khu du lịch chính thức khai mạc tại sân thể thao Khu B. Đây là cơ hội tuyệt vời để giao lưu và rèn luyện sức khỏe.</p>
                    <a href="#" class="read-more-btn">Đọc Thêm</a>
                </div>
            </article>

            <article class="news-card" data-category="service">
                <div class="news-card-image">
                    <img src="https://images.unsplash.com/photo-1559181567-c3190ca9959b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2064&q=80" alt="Nhà hàng">
                    <span class="news-category">Dịch Vụ</span>
                    <span class="news-date">10 Tháng 1, 2024</span>
                </div>
                <div class="news-content">
                    <h3 class="news-title">Ra Mắt Thực Đơn Mới Tại Nhà Hàng Khu Trung Tâm</h3>
                    <p class="news-excerpt">Nhà hàng chính của khu du lịch giới thiệu thực đơn mới với các món ăn đặc sản địa phương và quốc tế, mang đến trải nghiệm ẩm thực phong phú cho du khách.</p>
                    <a href="#" class="read-more-btn">Đọc Thêm</a>
                </div>
            </article>

            <article class="news-card" data-category="promotion">
                <div class="news-card-image">
                    <img src="https://images.unsplash.com/photo-1583417319070-4a69db38a482?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Khuyến mãi">
                    <span class="news-category">Khuyến Mãi</span>
                    <span class="news-date">8 Tháng 1, 2024</span>
                </div>
                <div class="news-content">
                    <h3 class="news-title">Ưu Đãi Đặc Biệt Tháng 1 - Giảm 30% Vé Tham Quan</h3>
                    <p class="news-excerpt">Chương trình khuyến mãi đặc biệt dành cho du khách trong tháng 1, giảm giá 30% cho tất cả vé tham quan các khu vực và 20% cho dịch vụ ăn uống.</p>
                    <a href="#" class="read-more-btn">Đọc Thêm</a>
                </div>
            </article>

            <article class="news-card" data-category="service">
                <div class="news-card-image">
                    <img src="https://images.unsplash.com/photo-1528127269322-539801943592?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Khu nghỉ dưỡng">
                    <span class="news-category">Dịch Vụ</span>
                    <span class="news-date">5 Tháng 1, 2024</span>
                </div>
                <div class="news-content">
                    <h3 class="news-title">Nâng Cấp Khu Nghỉ Dưỡng - Thêm Nhiều Tiện Ích Mới</h3>
                    <p class="news-excerpt">Khu nghỉ dưỡng đã hoàn thành việc nâng cấp với spa, phòng gym hiện đại và khu vực thư giãn bên hồ bơi, mang đến trải nghiệm nghỉ dưỡng cao cấp.</p>
                    <a href="#" class="read-more-btn">Đọc Thêm</a>
                </div>
            </article>

            <article class="news-card" data-category="activity">
                <div class="news-card-image">
                    <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Hoạt động sinh thái">
                    <span class="news-category">Hoạt Động</span>
                    <span class="news-date">3 Tháng 1, 2024</span>
                </div>
                <div class="news-content">
                    <h3 class="news-title">Chương Trình Giáo Dục Môi Trường Tại Khu D</h3>
                    <p class="news-excerpt">Khởi động chương trình giáo dục môi trường dành cho học sinh và du khách, với các hoạt động trồng cây, làm sạch môi trường và tìm hiểu về bảo tồn thiên nhiên.</p>
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