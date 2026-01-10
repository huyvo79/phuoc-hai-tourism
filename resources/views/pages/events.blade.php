@extends('layouts.layouts')

@section('title', 'Sự Kiện Du Lịch')

@section('body_class', 'events-page')

@section('content')
<div class="events-container">
    <div class="container">
        <!-- Hero Section -->
        <div class="events-hero">
            <h1>Sự Kiện Du Lịch</h1>
            <p>Khám phá những sự kiện du lịch hấp dẫn, lễ hội văn hóa và trải nghiệm độc đáo khắp Việt Nam</p>
        </div>

        <!-- Filter Tabs -->
        <div class="events-filters">
            <button class="filter-btn active" data-category="all">Tất Cả</button>
            <button class="filter-btn" data-category="upcoming">Sắp Diễn Ra</button>
            <button class="filter-btn" data-category="ongoing">Đang Diễn Ra</button>
            <button class="filter-btn" data-category="festival">Lễ Hội</button>
            <button class="filter-btn" data-category="tour">Tour</button>
        </div>

        <!-- Calendar Widget -->
        <div class="calendar-widget">
            <div class="calendar-header">
                <h3>Lịch Sự Kiện Tháng 1/2024</h3>
                <p>Nhấp vào ngày có sự kiện để xem chi tiết</p>
            </div>
            <div class="calendar-nav">
                <button id="prevMonth">‹</button>
                <span id="currentMonth">Tháng 1, 2024</span>
                <button id="nextMonth">›</button>
            </div>
            <div class="calendar-grid">
                <div class="calendar-day header">CN</div>
                <div class="calendar-day header">T2</div>
                <div class="calendar-day header">T3</div>
                <div class="calendar-day header">T4</div>
                <div class="calendar-day header">T5</div>
                <div class="calendar-day header">T6</div>
                <div class="calendar-day header">T7</div>
                
                <div class="calendar-day">31</div>
                <div class="calendar-day">1</div>
                <div class="calendar-day">2</div>
                <div class="calendar-day">3</div>
                <div class="calendar-day">4</div>
                <div class="calendar-day has-event">5</div>
                <div class="calendar-day">6</div>
                <div class="calendar-day">7</div>
                <div class="calendar-day">8</div>
                <div class="calendar-day">9</div>
                <div class="calendar-day">10</div>
                <div class="calendar-day">11</div>
                <div class="calendar-day has-event">12</div>
                <div class="calendar-day">13</div>
                <div class="calendar-day">14</div>
                <div class="calendar-day has-event">15</div>
                <div class="calendar-day">16</div>
                <div class="calendar-day">17</div>
                <div class="calendar-day">18</div>
                <div class="calendar-day">19</div>
                <div class="calendar-day has-event">20</div>
                <div class="calendar-day">21</div>
                <div class="calendar-day">22</div>
                <div class="calendar-day">23</div>
                <div class="calendar-day">24</div>
                <div class="calendar-day has-event">25</div>
                <div class="calendar-day">26</div>
                <div class="calendar-day">27</div>
                <div class="calendar-day">28</div>
                <div class="calendar-day">29</div>
                <div class="calendar-day has-event">30</div>
                <div class="calendar-day">31</div>
            </div>
        </div>

        <!-- Events Grid -->
        <div class="events-grid">
            <!-- Featured Event -->
            <article class="event-card featured-event" data-category="upcoming">
                <div class="event-card-image">
                    <img src="https://images.unsplash.com/photo-1533174072545-7a4b6ad7a6c3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Lễ hội hoa anh đào">
                    <span class="event-status upcoming">Sắp Diễn Ra</span>
                    <span class="event-price">500.000 VNĐ</span>
                </div>
                <div class="event-content">
                    <h2 class="event-title">Lễ Hội Hoa Anh Đào Đà Lạt 2024</h2>
                    <div class="event-meta">
                        <div class="event-meta-item">
                            <i class="bi bi-calendar-event"></i>
                            <span>15-20 Tháng 1, 2024</span>
                        </div>
                        <div class="event-meta-item">
                            <i class="bi bi-geo-alt"></i>
                            <span>Đà Lạt, Lâm Đồng</span>
                        </div>
                        <div class="event-meta-item">
                            <i class="bi bi-people"></i>
                            <span>1000+ người tham gia</span>
                        </div>
                    </div>
                    <p class="event-description">Tham gia lễ hội hoa anh đào lớn nhất Việt Nam tại thành phố ngàn hoa Đà Lạt. Chiêm ngưỡng vẻ đẹp rực rỡ của hàng nghìn cây hoa anh đào nở rộ, thưởng thức ẩm thực địa phương và tham gia các hoạt động văn hóa đặc sắc.</p>
                    <div class="event-actions">
                        <a href="#" class="event-btn event-btn-primary">Đăng Ký Ngay</a>
                        <a href="#" class="event-btn event-btn-secondary">Xem Chi Tiết</a>
                    </div>
                </div>
            </article>

            <!-- Regular Events -->
            <article class="event-card" data-category="festival">
                <div class="event-card-image">
                    <img src="https://images.unsplash.com/photo-1578662996442-48f60103fc96?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Lễ hội Sapa">
                    <span class="event-status upcoming">Sắp Diễn Ra</span>
                    <span class="event-price">300.000 VNĐ</span>
                </div>
                <div class="event-content">
                    <h3 class="event-title">Lễ Hội Mùa Đông Sapa - Tết Hmong</h3>
                    <div class="event-meta">
                        <div class="event-meta-item">
                            <i class="bi bi-calendar-event"></i>
                            <span>25-27 Tháng 1</span>
                        </div>
                        <div class="event-meta-item">
                            <i class="bi bi-geo-alt"></i>
                            <span>Sapa, Lào Cai</span>
                        </div>
                    </div>
                    <p class="event-description">Trải nghiệm văn hóa độc đáo của đồng bào Hmong trong lễ hội truyền thống, thưởng thức ẩm thực núi rừng và chiêm ngưỡng cảnh sắc mùa đông Sapa.</p>
                    <div class="event-actions">
                        <a href="#" class="event-btn event-btn-primary">Đăng Ký</a>
                        <a href="#" class="event-btn event-btn-secondary">Chi Tiết</a>
                    </div>
                </div>
            </article>

            <article class="event-card" data-category="tour">
                <div class="event-card-image">
                    <img src="https://images.unsplash.com/photo-1559827260-dc66d52bef19?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Tour Hạ Long">
                    <span class="event-status ongoing">Đang Diễn Ra</span>
                    <span class="event-price">1.200.000 VNĐ</span>
                </div>
                <div class="event-content">
                    <h3 class="event-title">Tour Khám Phá Vịnh Hạ Long 3N2Đ</h3>
                    <div class="event-meta">
                        <div class="event-meta-item">
                            <i class="bi bi-calendar-event"></i>
                            <span>Hàng ngày</span>
                        </div>
                        <div class="event-meta-item">
                            <i class="bi bi-geo-alt"></i>
                            <span>Quảng Ninh</span>
                        </div>
                    </div>
                    <p class="event-description">Du thuyền sang trọng khám phá kỳ quan thiên nhiên thế giới, tham quan động Thiên Cung, làng chài Cửa Vạn và thưởng thức hải sản tươi ngon.</p>
                    <div class="event-actions">
                        <a href="#" class="event-btn event-btn-primary">Đặt Tour</a>
                        <a href="#" class="event-btn event-btn-secondary">Xem Thêm</a>
                    </div>
                </div>
            </article>

            <article class="event-card" data-category="festival">
                <div class="event-card-image">
                    <img src="https://images.unsplash.com/photo-1583417319070-4a69db38a482?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Lễ hội đèn lồng Hội An">
                    <span class="event-status upcoming">Sắp Diễn Ra</span>
                    <span class="event-price free">Miễn Phí</span>
                </div>
                <div class="event-content">
                    <h3 class="event-title">Lễ Hội Đèn Lồng Hội An - Rằm Tháng Giêng</h3>
                    <div class="event-meta">
                        <div class="event-meta-item">
                            <i class="bi bi-calendar-event"></i>
                            <span>24 Tháng 1</span>
                        </div>
                        <div class="event-meta-item">
                            <i class="bi bi-geo-alt"></i>
                            <span>Hội An, Quảng Nam</span>
                        </div>
                    </div>
                    <p class="event-description">Đêm hội đèn lồng rực rỡ tại phố cổ Hội An, thả đèn hoa đăng trên sông Hoài và thưởng thức các món ăn truyền thống trong không khí lễ hội.</p>
                    <div class="event-actions">
                        <a href="#" class="event-btn event-btn-primary">Tham Gia</a>
                        <a href="#" class="event-btn event-btn-secondary">Tìm Hiểu</a>
                    </div>
                </div>
            </article>

            <article class="event-card" data-category="tour">
                <div class="event-card-image">
                    <img src="https://images.unsplash.com/photo-1528127269322-539801943592?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Tour Phú Quốc">
                    <span class="event-status upcoming">Sắp Diễn Ra</span>
                    <span class="event-price">2.500.000 VNĐ</span>
                </div>
                <div class="event-content">
                    <h3 class="event-title">Tour Đảo Ngọc Phú Quốc 4N3Đ</h3>
                    <div class="event-meta">
                        <div class="event-meta-item">
                            <i class="bi bi-calendar-event"></i>
                            <span>30 Tháng 1 - 2 Tháng 2</span>
                        </div>
                        <div class="event-meta-item">
                            <i class="bi bi-geo-alt"></i>
                            <span>Phú Quốc, Kiên Giang</span>
                        </div>
                    </div>
                    <p class="event-description">Khám phá đảo ngọc với những bãi biển tuyệt đẹp, tham quan vườn tiêu, làng chài và thưởng thức hải sản tươi sống tại chợ đêm Dinh Cậu.</p>
                    <div class="event-actions">
                        <a href="#" class="event-btn event-btn-primary">Đặt Ngay</a>
                        <a href="#" class="event-btn event-btn-secondary">Xem Tour</a>
                    </div>
                </div>
            </article>

            <article class="event-card" data-category="festival">
                <div class="event-card-image">
                    <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Lễ hội Nghinh Ông">
                    <span class="event-status upcoming">Sắp Diễn Ra</span>
                    <span class="event-price free">Miễn Phí</span>
                </div>
                <div class="event-content">
                    <h3 class="event-title">Lễ Hội Nghinh Ông - Cầu Ngư An Thịnh</h3>
                    <div class="event-meta">
                        <div class="event-meta-item">
                            <i class="bi bi-calendar-event"></i>
                            <span>5-7 Tháng 2</span>
                        </div>
                        <div class="event-meta-item">
                            <i class="bi bi-geo-alt"></i>
                            <span>Phan Thiết, Bình Thuận</span>
                        </div>
                    </div>
                    <p class="event-description">Tham gia lễ hội truyền thống của ngư dân miền Trung, chứng kiến lễ rước cá Ông và thưởng thức các món hải sản đặc sản vùng biển.</p>
                    <div class="event-actions">
                        <a href="#" class="event-btn event-btn-primary">Tham Gia</a>
                        <a href="#" class="event-btn event-btn-secondary">Tìm Hiểu</a>
                    </div>
                </div>
            </article>
        </div>
    </div>
</div>

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Filter functionality
    const filterBtns = document.querySelectorAll('.filter-btn');
    const eventCards = document.querySelectorAll('.event-card');
    
    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Remove active class from all buttons
            filterBtns.forEach(b => b.classList.remove('active'));
            // Add active class to clicked button
            this.classList.add('active');
            
            const category = this.getAttribute('data-category');
            
            // Filter event cards
            eventCards.forEach(card => {
                if (category === 'all' || card.getAttribute('data-category') === category) {
                    card.style.display = 'block';
                    card.style.animation = 'fadeInUp 0.6s ease';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
    
    // Calendar navigation
    const prevBtn = document.getElementById('prevMonth');
    const nextBtn = document.getElementById('nextMonth');
    const currentMonthSpan = document.getElementById('currentMonth');
    
    let currentMonth = 0; // January = 0
    const months = [
        'Tháng 1, 2024', 'Tháng 2, 2024', 'Tháng 3, 2024', 'Tháng 4, 2024',
        'Tháng 5, 2024', 'Tháng 6, 2024', 'Tháng 7, 2024', 'Tháng 8, 2024',
        'Tháng 9, 2024', 'Tháng 10, 2024', 'Tháng 11, 2024', 'Tháng 12, 2024'
    ];
    
    prevBtn.addEventListener('click', function() {
        if (currentMonth > 0) {
            currentMonth--;
            currentMonthSpan.textContent = months[currentMonth];
        }
    });
    
    nextBtn.addEventListener('click', function() {
        if (currentMonth < 11) {
            currentMonth++;
            currentMonthSpan.textContent = months[currentMonth];
        }
    });
    
    // Calendar day click events
    document.querySelectorAll('.calendar-day.has-event').forEach(day => {
        day.addEventListener('click', function() {
            // Add pulse animation
            this.classList.add('pulse-animation');
            setTimeout(() => {
                this.classList.remove('pulse-animation');
            }, 2000);
            
            // Show event details (you can implement a modal here)
            alert(`Sự kiện ngày ${this.textContent}: Xem chi tiết sự kiện`);
        });
    });
    
    // Event registration buttons
    document.querySelectorAll('.event-btn-primary').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            // Add registration logic here
            this.textContent = 'Đang xử lý...';
            setTimeout(() => {
                this.textContent = 'Đã đăng ký';
                this.style.background = 'linear-gradient(135deg, #10b981, #059669)';
            }, 1500);
        });
    });
    
    // Smooth scroll for detail buttons
    document.querySelectorAll('.event-btn-secondary').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            // Add navigation logic here
        });
    });
});
</script>
@endsection
@endsection