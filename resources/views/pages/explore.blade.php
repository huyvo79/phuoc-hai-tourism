@extends('layouts.layouts')

@section('title', 'Khám Phá Điểm Đến')

@section('body_class', 'explore-page')

@section('content')
<div class="explore-container">
    <div class="container">
        <!-- Hero Section -->
        <div class="explore-hero">
            <h1>Khám Phá Khu Du Lịch</h1>
            <p>Tìm hiểu và khám phá những địa điểm tuyệt vời trong khu du lịch của chúng tôi. Từ khu vui chơi giải trí đến không gian nghỉ dưỡng yên tĩnh.</p>
            
            <!-- Search Bar -->
            <div class="explore-search">
                <div class="search-input-group">
                    <input type="text" class="search-input" placeholder="Tìm kiếm khu vực, hoạt động, dịch vụ...">
                    <button class="search-btn">
                        <i class="bi bi-search"></i> Tìm Kiếm
                    </button>
                </div>
            </div>
        </div>

        <!-- Filter Tabs -->
        <div class="explore-filters">
            <button class="filter-btn active" data-category="all">Tất Cả</button>
            <button class="filter-btn" data-category="entertainment">Vui Chơi</button>
            <button class="filter-btn" data-category="restaurant">Ẩm Thực</button>
            <button class="filter-btn" data-category="accommodation">Nghỉ Dưỡng</button>
            <button class="filter-btn" data-category="activity">Hoạt Động</button>
            <button class="filter-btn" data-category="service">Dịch Vụ</button>
        </div>

        <!-- Destinations Grid -->
        <div class="destinations-grid">
            <!-- Regular Destinations -->
            <article class="destination-card" data-category="activity">
                <div class="destination-image">
                    <img src="https://images.unsplash.com/photo-1528127269322-539801943592?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Khu B">
                    <div class="destination-overlay"></div>
                    <div class="destination-category">Thể Thao Nước</div>
                    <div class="destination-rating">
                        <i class="bi bi-star-fill" style="color: #fbbf24;"></i>
                        4.7
                    </div>
                    <div class="destination-quick-info">
                        <div class="quick-info-item">
                            <i class="bi bi-clock"></i>
                            <span>Mở cửa 9:00 - 21:00</span>
                        </div>
                        <div class="quick-info-item">
                            <i class="bi bi-water"></i>
                            <span>Hồ bơi & trượt nước</span>
                        </div>
                    </div>
                </div>
                <div class="destination-content">
                    <h3 class="destination-title">Khu B - Thể Thao Nước</h3>
                    <div class="destination-location">
                        <i class="bi bi-geo-alt"></i>
                        Khu B - Khu thể thao nước
                    </div>
                    <p class="destination-description">Khu thể thao nước hiện đại với hồ bơi, trượt nước và các hoạt động thể thao dưới nước thú vị cho cả gia đình.</p>
                    <div class="destination-features">
                        <span class="feature-tag">Hồ bơi</span>
                        <span class="feature-tag">Trượt nước</span>
                        <span class="feature-tag">Thể thao nước</span>
                    </div>
                    <div class="destination-meta">
                        <span class="destination-price">Từ 80.000 VNĐ</span>
                        <span class="destination-duration">2-3 giờ</span>
                    </div>
                    <div class="destination-actions">
                        <a href="#" class="destination-btn destination-btn-primary">Đặt Vé</a>
                        <a href="{{ route('home.post_details') }}" class="destination-btn destination-btn-secondary">Chi Tiết</a>
                    </div>
                </div>
            </article>

            <article class="destination-card" data-category="service">
                <div class="destination-image">
                    <img src="https://images.unsplash.com/photo-1578662996442-48f60103fc96?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Khu C">
                    <div class="destination-overlay"></div>
                    <div class="destination-category">Văn Hóa</div>
                    <div class="destination-rating">
                        <i class="bi bi-star-fill" style="color: #fbbf24;"></i>
                        4.6
                    </div>
                    <div class="destination-quick-info">
                        <div class="quick-info-item">
                            <i class="bi bi-clock"></i>
                            <span>Mở cửa 8:00 - 20:00</span>
                        </div>
                        <div class="quick-info-item">
                            <i class="bi bi-palette"></i>
                            <span>Biểu diễn văn hóa</span>
                        </div>
                    </div>
                </div>
                <div class="destination-content">
                    <h3 class="destination-title">Khu C - Không Gian Văn Hóa</h3>
                    <div class="destination-location">
                        <i class="bi bi-geo-alt"></i>
                        Khu C - Khu văn hóa truyền thống
                    </div>
                    <p class="destination-description">Khám phá văn hóa truyền thống với các tiết mục biểu diễn, triển lãm và hoạt động thủ công mỹ nghệ đặc sắc.</p>
                    <div class="destination-features">
                        <span class="feature-tag">Biểu diễn</span>
                        <span class="feature-tag">Thủ công</span>
                        <span class="feature-tag">Triển lãm</span>
                    </div>
                    <div class="destination-meta">
                        <span class="destination-price">Từ 60.000 VNĐ</span>
                        <span class="destination-duration">2-3 giờ</span>
                    </div>
                    <div class="destination-actions">
                        <a href="#" class="destination-btn destination-btn-primary">Đặt Vé</a>
                        <a href="{{ route('home.post_details') }}" class="destination-btn destination-btn-secondary">Chi Tiết</a>
                    </div>
                </div>
            </article>

            <article class="destination-card" data-category="activity">
                <div class="destination-image">
                    <img src="https://images.unsplash.com/photo-1441974231531-c6227db76b6e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Khu D">
                    <div class="destination-overlay"></div>
                    <div class="destination-category">Sinh Thái</div>
                    <div class="destination-rating">
                        <i class="bi bi-star-fill" style="color: #fbbf24;"></i>
                        4.8
                    </div>
                    <div class="destination-quick-info">
                        <div class="quick-info-item">
                            <i class="bi bi-clock"></i>
                            <span>Mở cửa 7:00 - 18:00</span>
                        </div>
                        <div class="quick-info-item">
                            <i class="bi bi-tree"></i>
                            <span>Khu bảo tồn thiên nhiên</span>
                        </div>
                    </div>
                </div>
                <div class="destination-content">
                    <h3 class="destination-title">Khu D - Khu Sinh Thái</h3>
                    <div class="destination-location">
                        <i class="bi bi-geo-alt"></i>
                        Khu D - Khu bảo tồn sinh thái
                    </div>
                    <p class="destination-description">Tìm hiểu về thiên nhiên và động vật hoang dã trong môi trường sinh thái được bảo tồn cẩn thận.</p>
                    <div class="destination-features">
                        <span class="feature-tag">Quan sát động vật</span>
                        <span class="feature-tag">Đường mòn tự nhiên</span>
                        <span class="feature-tag">Giáo dục môi trường</span>
                    </div>
                    <div class="destination-meta">
                        <span class="destination-price">Từ 50.000 VNĐ</span>
                        <span class="destination-duration">2-4 giờ</span>
                    </div>
                    <div class="destination-actions">
                        <a href="#" class="destination-btn destination-btn-primary">Đặt Tour</a>
                        <a href="#" class="destination-btn destination-btn-secondary">Chi Tiết</a>
                    </div>
                </div>
            </article>

            <article class="destination-card" data-category="restaurant">
                <div class="destination-image">
                    <img src="https://images.unsplash.com/photo-1559181567-c3190ca9959b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2064&q=80" alt="Khu ẩm thực">
                    <div class="destination-overlay"></div>
                    <div class="destination-category">Ẩm Thực</div>
                    <div class="destination-rating">
                        <i class="bi bi-star-fill" style="color: #fbbf24;"></i>
                        4.7
                    </div>
                    <div class="destination-quick-info">
                        <div class="quick-info-item">
                            <i class="bi bi-clock"></i>
                            <span>Mở cửa 10:00 - 22:00</span>
                        </div>
                        <div class="quick-info-item">
                            <i class="bi bi-cup-hot"></i>
                            <span>Đa dạng món ăn</span>
                        </div>
                    </div>
                </div>
                <div class="destination-content">
                    <h3 class="destination-title">Khu Ẩm Thực Trung Tâm</h3>
                    <div class="destination-location">
                        <i class="bi bi-geo-alt"></i>
                        Khu trung tâm - Khu ẩm thực
                    </div>
                    <p class="destination-description">Thưởng thức các món ăn đặc sản địa phương và quốc tế tại khu ẩm thực với nhiều lựa chọn phong phú.</p>
                    <div class="destination-features">
                        <span class="feature-tag">Ẩm thực địa phương</span>
                        <span class="feature-tag">Món quốc tế</span>
                        <span class="feature-tag">Không gian thoáng mát</span>
                    </div>
                    <div class="destination-meta">
                        <span class="destination-price">Từ 150.000 VNĐ</span>
                        <span class="destination-duration">1-2 giờ</span>
                    </div>
                    <div class="destination-actions">
                        <a href="#" class="destination-btn destination-btn-primary">Đặt Bàn</a>
                        <a href="#" class="destination-btn destination-btn-secondary">Xem Menu</a>
                    </div>
                </div>
            </article>

            <article class="destination-card" data-category="accommodation">
                <div class="destination-image">
                    <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Khu nghỉ dưỡng">
                    <div class="destination-overlay"></div>
                    <div class="destination-category">Nghỉ Dưỡng</div>
                    <div class="destination-rating">
                        <i class="bi bi-star-fill" style="color: #fbbf24;"></i>
                        4.9
                    </div>
                    <div class="destination-quick-info">
                        <div class="quick-info-item">
                            <i class="bi bi-clock"></i>
                            <span>Phục vụ 24/7</span>
                        </div>
                        <div class="quick-info-item">
                            <i class="bi bi-heart"></i>
                            <span>Spa & Wellness</span>
                        </div>
                    </div>
                </div>
                <div class="destination-content">
                    <h3 class="destination-title">Khu Nghỉ Dưỡng Cao Cấp</h3>
                    <div class="destination-location">
                        <i class="bi bi-geo-alt"></i>
                        Khu nghỉ dưỡng - Khu yên tĩnh
                    </div>
                    <p class="destination-description">Thư giãn tại khu nghỉ dưỡng cao cấp với spa, phòng gym và các tiện ích nghỉ dưỡng hiện đại.</p>
                    <div class="destination-features">
                        <span class="feature-tag">Spa cao cấp</span>
                        <span class="feature-tag">Phòng gym</span>
                        <span class="feature-tag">Hồ bơi riêng</span>
                    </div>
                    <div class="destination-meta">
                        <span class="destination-price">Từ 800.000 VNĐ/đêm</span>
                        <span class="destination-duration">Nghỉ qua đêm</span>
                    </div>
                    <div class="destination-actions">
                        <a href="#" class="destination-btn destination-btn-primary">Đặt Phòng</a>
                        <a href="#" class="destination-btn destination-btn-secondary">Xem Phòng</a>
                    </div>
                </div>
            </article>
        </div>

        <!-- Interactive Map -->
        <div class="explore-map">
            <div class="map-header">
                <h2>Bản Đồ Khu Du Lịch</h2>
                <p>Khám phá vị trí các khu vực khác nhau trong khu du lịch của chúng tôi</p>
            </div>
            <div class="map-container">
                <div class="map-placeholder">
                    <div style="text-align: center;">
                        <i class="bi bi-map" style="font-size: 3rem; margin-bottom: 15px; display: block;"></i>
                        Bản đồ khu du lịch sẽ được hiển thị tại đây<br>
                        <small>Hiển thị vị trí các khu A, B, C, D và các tiện ích</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Load More Section -->
        <div class="load-more-section">
            <button class="load-more-btn">Khám Phá Thêm Khu Vực</button>
        </div>
    </div>
</div>

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search functionality
    const searchInput = document.querySelector('.search-input');
    const searchBtn = document.querySelector('.search-btn');
    
    searchBtn.addEventListener('click', function() {
        const query = searchInput.value.trim();
        if (query) {
            // Show loading state
            this.innerHTML = '<i class="bi bi-hourglass-split"></i> Đang tìm...';
            
            // Simulate search
            setTimeout(() => {
                this.innerHTML = '<i class="bi bi-search"></i> Tìm Kiếm';
                // Here you would implement actual search logic
                alert(`Tìm kiếm: "${query}"`);
            }, 1500);
        }
    });
    
    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            searchBtn.click();
        }
    });
    
    // Filter functionality
    const filterBtns = document.querySelectorAll('.filter-btn');
    const destinationCards = document.querySelectorAll('.destination-card');
    
    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Remove active class from all buttons
            filterBtns.forEach(b => b.classList.remove('active'));
            // Add active class to clicked button
            this.classList.add('active');
            
            const category = this.getAttribute('data-category');
            
            // Filter destination cards
            destinationCards.forEach(card => {
                if (category === 'all' || card.getAttribute('data-category') === category) {
                    card.style.display = 'block';
                    card.style.animation = 'fadeInUp 0.6s ease';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
    
    // Destination card interactions
    destinationCards.forEach(card => {
        const primaryBtn = card.querySelector('.destination-btn-primary');
        const secondaryBtn = card.querySelector('.destination-btn-secondary');
        
        // Primary button (Book Tour)
        if (primaryBtn) {
            primaryBtn.addEventListener('click', function(e) {
                e.preventDefault();
                const title = card.querySelector('.destination-title').textContent;
                const originalText = this.textContent;
                
                this.textContent = 'Đang xử lý...';
                this.style.background = 'linear-gradient(135deg, #f59e0b, #d97706)';
                
                setTimeout(() => {
                    this.textContent = 'Đã đặt!';
                    this.style.background = 'linear-gradient(135deg, #10b981, #059669)';
                    
                    setTimeout(() => {
                        this.textContent = originalText;
                        this.style.background = 'linear-gradient(135deg, var(--primary, #0f766e), var(--primary-dark, #0d5c56))';
                    }, 2000);
                }, 1500);
            });
        }
        
        // Secondary button (View Details)
        if (secondaryBtn) {
            secondaryBtn.addEventListener('click', function(e) {
                e.preventDefault();
                const title = card.querySelector('.destination-title').textContent;
                // Here you would navigate to detail page
                console.log(`Xem chi tiết: ${title}`);
            });
        }
    });
    
    // Load more functionality
    const loadMoreBtn = document.querySelector('.load-more-btn');
    loadMoreBtn.addEventListener('click', function() {
        this.textContent = 'Đang tải thêm...';
        
        setTimeout(() => {
            this.textContent = 'Khám Phá Thêm Khu Vực';
            // Here you would load more destinations
            alert('Tính năng tải thêm khu vực sẽ được triển khai');
        }, 1000);
    });
    
    // Smooth scroll for destination actions
    document.querySelectorAll('.destination-btn').forEach(btn => {
        btn.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
        });
        
        btn.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
    
    // Auto-suggest for search (simple implementation)
    const suggestions = [
        'Khu A', 'Khu B', 'Khu C', 'Khu D', 'Vui chơi giải trí', 'Thể thao nước',
        'Văn hóa', 'Sinh thái', 'Ẩm thực', 'Nghỉ dưỡng', 'Tàu lượn', 'Hồ bơi'
    ];
    
    searchInput.addEventListener('input', function() {
        const value = this.value.toLowerCase();
        if (value.length > 1) {
            const matches = suggestions.filter(s => 
                s.toLowerCase().includes(value)
            );
            // Here you could show a dropdown with suggestions
        }
    });
});
</script>
@endsection
@endsection