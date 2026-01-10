@extends('layouts.layouts')

@section('title', 'Khám Phá Điểm Đến')

@section('body_class', 'explore-page')

@section('content')
<div class="explore-container">
    <div class="container">
        <!-- Hero Section -->
        <div class="explore-hero">
            <h1>Khám Phá Việt Nam</h1>
            <p>Tìm kiếm và khám phá những điểm đến tuyệt vời nhất trên khắp đất nước Việt Nam. Từ núi rừng hùng vĩ đến biển đảo thơ mộng.</p>
            
            <!-- Search Bar -->
            <div class="explore-search">
                <div class="search-input-group">
                    <input type="text" class="search-input" placeholder="Tìm kiếm điểm đến, thành phố, hoạt động...">
                    <button class="search-btn">
                        <i class="bi bi-search"></i> Tìm Kiếm
                    </button>
                </div>
            </div>
        </div>

        <!-- Filter Tabs -->
        <div class="explore-filters">
            <button class="filter-btn active" data-category="all">Tất Cả</button>
            <button class="filter-btn" data-category="mountain">Núi Rừng</button>
            <button class="filter-btn" data-category="beach">Biển Đảo</button>
            <button class="filter-btn" data-category="city">Thành Phố</button>
            <button class="filter-btn" data-category="culture">Văn Hóa</button>
            <button class="filter-btn" data-category="nature">Thiên Nhiên</button>
        </div>

        <!-- Destinations Grid -->
        <div class="destinations-grid">
            <!-- Featured Destination -->
            <article class="destination-card featured-destination" data-category="nature">
                <div class="destination-image">
                    <img src="https://images.unsplash.com/photo-1559827260-dc66d52bef19?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Vịnh Hạ Long">
                    <div class="destination-overlay"></div>
                    <div class="destination-category">Kỳ Quan Thế Giới</div>
                    <div class="destination-rating">
                        <i class="bi bi-star-fill" style="color: #fbbf24;"></i>
                        4.9
                    </div>
                    <div class="destination-quick-info">
                        <div class="quick-info-item">
                            <i class="bi bi-geo-alt"></i>
                            <span>Quảng Ninh, Việt Nam</span>
                        </div>
                        <div class="quick-info-item">
                            <i class="bi bi-clock"></i>
                            <span>2-3 ngày khám phá</span>
                        </div>
                        <div class="quick-info-item">
                            <i class="bi bi-people"></i>
                            <span>Phù hợp mọi lứa tuổi</span>
                        </div>
                    </div>
                </div>
                <div class="destination-content">
                    <h2 class="destination-title">Vịnh Hạ Long - Kỳ Quan Thiên Nhiên Thế Giới</h2>
                    <div class="destination-location">
                        <i class="bi bi-geo-alt"></i>
                        Quảng Ninh, Việt Nam
                    </div>
                    <p class="destination-description">Khám phá vẻ đẹp huyền bí của Vịnh Hạ Long với hàng nghìn đảo đá vôi nhô lên từ mặt nước xanh biếc. Du thuyền qua các hang động kỳ bí, thưởng thức hải sản tươi ngon và chiêm ngưỡng cảnh hoàng hôn tuyệt đẹp trên vịnh.</p>
                    <div class="destination-features">
                        <span class="feature-tag">Du thuyền</span>
                        <span class="feature-tag">Hang động</span>
                        <span class="feature-tag">Hải sản</span>
                        <span class="feature-tag">Nhiếp ảnh</span>
                    </div>
                    <div class="destination-meta">
                        <span class="destination-price">Từ 1.800.000 VNĐ</span>
                        <span class="destination-duration">2-3 ngày</span>
                    </div>
                    <div class="destination-actions">
                        <a href="#" class="destination-btn destination-btn-primary">Đặt Tour Ngay</a>
                        <a href="{{ route('home.post_details') }}" class="destination-btn destination-btn-secondary">Xem Chi Tiết</a>
                    </div>
                </div>
            </article>

            <!-- Regular Destinations -->
            <article class="destination-card" data-category="mountain">
                <div class="destination-image">
                    <img src="https://images.unsplash.com/photo-1578662996442-48f60103fc96?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Sapa">
                    <div class="destination-overlay"></div>
                    <div class="destination-category">Núi Rừng</div>
                    <div class="destination-rating">
                        <i class="bi bi-star-fill" style="color: #fbbf24;"></i>
                        4.8
                    </div>
                    <div class="destination-quick-info">
                        <div class="quick-info-item">
                            <i class="bi bi-thermometer-half"></i>
                            <span>15-20°C quanh năm</span>
                        </div>
                        <div class="quick-info-item">
                            <i class="bi bi-mountain"></i>
                            <span>Đỉnh Fansipan 3,143m</span>
                        </div>
                    </div>
                </div>
                <div class="destination-content">
                    <h3 class="destination-title">Sapa - Thị Trấn Trong Mây</h3>
                    <div class="destination-location">
                        <i class="bi bi-geo-alt"></i>
                        Lào Cai, Việt Nam
                    </div>
                    <p class="destination-description">Khám phá vẻ đẹp hùng vĩ của dãy Hoàng Liên Sơn, chinh phục đỉnh Fansipan và trải nghiệm văn hóa độc đáo của các dân tộc thiểu số.</p>
                    <div class="destination-features">
                        <span class="feature-tag">Trekking</span>
                        <span class="feature-tag">Văn hóa</span>
                        <span class="feature-tag">Ruộng bậc thang</span>
                    </div>
                    <div class="destination-meta">
                        <span class="destination-price">Từ 2.500.000 VNĐ</span>
                        <span class="destination-duration">3-4 ngày</span>
                    </div>
                    <div class="destination-actions">
                        <a href="#" class="destination-btn destination-btn-primary">Đặt Tour</a>
                        <a href="{{ route('home.post_details') }}" class="destination-btn destination-btn-secondary">Chi Tiết</a>
                    </div>
                </div>
            </article>

            <article class="destination-card" data-category="culture">
                <div class="destination-image">
                    <img src="https://images.unsplash.com/photo-1583417319070-4a69db38a482?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Hội An">
                    <div class="destination-overlay"></div>
                    <div class="destination-category">Văn Hóa</div>
                    <div class="destination-rating">
                        <i class="bi bi-star-fill" style="color: #fbbf24;"></i>
                        4.7
                    </div>
                    <div class="destination-quick-info">
                        <div class="quick-info-item">
                            <i class="bi bi-building"></i>
                            <span>Phố cổ 400 năm tuổi</span>
                        </div>
                        <div class="quick-info-item">
                            <i class="bi bi-palette"></i>
                            <span>Lễ hội đèn lồng</span>
                        </div>
                    </div>
                </div>
                <div class="destination-content">
                    <h3 class="destination-title">Hội An - Phố Cổ Thơ Mộng</h3>
                    <div class="destination-location">
                        <i class="bi bi-geo-alt"></i>
                        Quảng Nam, Việt Nam
                    </div>
                    <p class="destination-description">Dạo bước trên những con phố cổ kính, thưởng thức ẩm thực đặc sắc và tham gia lễ hội đèn lồng đầy màu sắc.</p>
                    <div class="destination-features">
                        <span class="feature-tag">Phố cổ</span>
                        <span class="feature-tag">Ẩm thực</span>
                        <span class="feature-tag">Đèn lồng</span>
                    </div>
                    <div class="destination-meta">
                        <span class="destination-price">Từ 2.000.000 VNĐ</span>
                        <span class="destination-duration">2-3 ngày</span>
                    </div>
                    <div class="destination-actions">
                        <a href="#" class="destination-btn destination-btn-primary">Đặt Tour</a>
                        <a href="#" class="destination-btn destination-btn-secondary">Chi Tiết</a>
                    </div>
                </div>
            </article>

            <article class="destination-card" data-category="city">
                <div class="destination-image">
                    <img src="https://images.unsplash.com/photo-1533174072545-7a4b6ad7a6c3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Đà Lạt">
                    <div class="destination-overlay"></div>
                    <div class="destination-category">Thành Phố</div>
                    <div class="destination-rating">
                        <i class="bi bi-star-fill" style="color: #fbbf24;"></i>
                        4.6
                    </div>
                    <div class="destination-quick-info">
                        <div class="quick-info-item">
                            <i class="bi bi-flower1"></i>
                            <span>Thành phố ngàn hoa</span>
                        </div>
                        <div class="quick-info-item">
                            <i class="bi bi-thermometer-snow"></i>
                            <span>Khí hậu mát mẻ</span>
                        </div>
                    </div>
                </div>
                <div class="destination-content">
                    <h3 class="destination-title">Đà Lạt - Thành Phố Ngàn Hoa</h3>
                    <div class="destination-location">
                        <i class="bi bi-geo-alt"></i>
                        Lâm Đồng, Việt Nam
                    </div>
                    <p class="destination-description">Tận hưởng khí hậu mát mẻ quanh năm, khám phá những vườn hoa rực rỡ và thưởng thức các món ăn đặc sản miền núi.</p>
                    <div class="destination-features">
                        <span class="feature-tag">Vườn hoa</span>
                        <span class="feature-tag">Khí hậu mát</span>
                        <span class="feature-tag">Cà phê</span>
                    </div>
                    <div class="destination-meta">
                        <span class="destination-price">Từ 1.500.000 VNĐ</span>
                        <span class="destination-duration">2-3 ngày</span>
                    </div>
                    <div class="destination-actions">
                        <a href="#" class="destination-btn destination-btn-primary">Đặt Tour</a>
                        <a href="#" class="destination-btn destination-btn-secondary">Chi Tiết</a>
                    </div>
                </div>
            </article>

            <article class="destination-card" data-category="beach">
                <div class="destination-image">
                    <img src="https://images.unsplash.com/photo-1528127269322-539801943592?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Phú Quốc">
                    <div class="destination-overlay"></div>
                    <div class="destination-category">Biển Đảo</div>
                    <div class="destination-rating">
                        <i class="bi bi-star-fill" style="color: #fbbf24;"></i>
                        4.8
                    </div>
                    <div class="destination-quick-info">
                        <div class="quick-info-item">
                            <i class="bi bi-water"></i>
                            <span>Bãi biển cát trắng</span>
                        </div>
                        <div class="quick-info-item">
                            <i class="bi bi-fish"></i>
                            <span>Hải sản tươi sống</span>
                        </div>
                    </div>
                </div>
                <div class="destination-content">
                    <h3 class="destination-title">Phú Quốc - Đảo Ngọc Việt Nam</h3>
                    <div class="destination-location">
                        <i class="bi bi-geo-alt"></i>
                        Kiên Giang, Việt Nam
                    </div>
                    <p class="destination-description">Thư giãn trên những bãi biển cát trắng tuyệt đẹp, khám phá rừng nguyên sinh và thưởng thức hải sản tươi sống.</p>
                    <div class="destination-features">
                        <span class="feature-tag">Bãi biển</span>
                        <span class="feature-tag">Lặn biển</span>
                        <span class="feature-tag">Hải sản</span>
                    </div>
                    <div class="destination-meta">
                        <span class="destination-price">Từ 3.000.000 VNĐ</span>
                        <span class="destination-duration">3-5 ngày</span>
                    </div>
                    <div class="destination-actions">
                        <a href="#" class="destination-btn destination-btn-primary">Đặt Tour</a>
                        <a href="#" class="destination-btn destination-btn-secondary">Chi Tiết</a>
                    </div>
                </div>
            </article>

            <article class="destination-card" data-category="beach">
                <div class="destination-image">
                    <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Nha Trang">
                    <div class="destination-overlay"></div>
                    <div class="destination-category">Biển Đảo</div>
                    <div class="destination-rating">
                        <i class="bi bi-star-fill" style="color: #fbbf24;"></i>
                        4.5
                    </div>
                    <div class="destination-quick-info">
                        <div class="quick-info-item">
                            <i class="bi bi-waves"></i>
                            <span>Thể thao biển</span>
                        </div>
                        <div class="quick-info-item">
                            <i class="bi bi-moon-stars"></i>
                            <span>Cuộc sống về đêm</span>
                        </div>
                    </div>
                </div>
                <div class="destination-content">
                    <h3 class="destination-title">Nha Trang - Thiên Đường Biển</h3>
                    <div class="destination-location">
                        <i class="bi bi-geo-alt"></i>
                        Khánh Hòa, Việt Nam
                    </div>
                    <p class="destination-description">Tham gia các hoạt động thể thao biển, khám phá đảo Hon Mun và tận hưởng cuộc sống về đêm sôi động.</p>
                    <div class="destination-features">
                        <span class="feature-tag">Thể thao biển</span>
                        <span class="feature-tag">Đảo Hon Mun</span>
                        <span class="feature-tag">Nightlife</span>
                    </div>
                    <div class="destination-meta">
                        <span class="destination-price">Từ 2.200.000 VNĐ</span>
                        <span class="destination-duration">3-4 ngày</span>
                    </div>
                    <div class="destination-actions">
                        <a href="#" class="destination-btn destination-btn-primary">Đặt Tour</a>
                        <a href="#" class="destination-btn destination-btn-secondary">Chi Tiết</a>
                    </div>
                </div>
            </article>
        </div>

        <!-- Interactive Map -->
        <div class="explore-map">
            <div class="map-header">
                <h2>Bản Đồ Điểm Đến</h2>
                <p>Khám phá vị trí các điểm đến trên bản đồ Việt Nam</p>
            </div>
            <div class="map-container">
                <div class="map-placeholder">
                    <div style="text-align: center;">
                        <i class="bi bi-map" style="font-size: 3rem; margin-bottom: 15px; display: block;"></i>
                        Bản đồ tương tác sẽ được hiển thị tại đây<br>
                        <small>Tích hợp Google Maps hoặc Leaflet</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Load More Section -->
        <div class="load-more-section">
            <button class="load-more-btn">Khám Phá Thêm Điểm Đến</button>
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
        primaryBtn.addEventListener('click', function(e) {
            e.preventDefault();
            const title = card.querySelector('.destination-title').textContent;
            
            this.textContent = 'Đang xử lý...';
            this.style.background = 'linear-gradient(135deg, #f59e0b, #d97706)';
            
            setTimeout(() => {
                this.textContent = 'Đã đặt tour!';
                this.style.background = 'linear-gradient(135deg, #10b981, #059669)';
                
                setTimeout(() => {
                    this.textContent = 'Đặt Tour Ngay';
                    this.style.background = 'linear-gradient(135deg, var(--primary, #0f766e), var(--primary-dark, #0d5c56))';
                }, 2000);
            }, 1500);
        });
        
        // Secondary button (View Details)
        secondaryBtn.addEventListener('click', function(e) {
            e.preventDefault();
            const title = card.querySelector('.destination-title').textContent;
            // Here you would navigate to detail page
            alert(`Xem chi tiết: ${title}`);
        });
    });
    
    // Load more functionality
    const loadMoreBtn = document.querySelector('.load-more-btn');
    loadMoreBtn.addEventListener('click', function() {
        this.textContent = 'Đang tải thêm...';
        
        setTimeout(() => {
            this.textContent = 'Khám Phá Thêm Điểm Đến';
            // Here you would load more destinations
            alert('Tính năng tải thêm điểm đến sẽ được triển khai');
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
        'Sapa', 'Hạ Long', 'Hội An', 'Đà Lạt', 'Phú Quốc', 'Nha Trang',
        'Mũi Né', 'Cần Thơ', 'Huế', 'Đà Nẵng', 'Ninh Bình', 'Mù Cang Chải'
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