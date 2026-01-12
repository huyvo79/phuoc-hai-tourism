@extends('layouts.layouts')

@section('title', 'Sự Kiện Du Lịch')

@section('body_class', 'events-page')

@section('content')
<div class="events-container">
    <div class="container">
        <!-- Hero Section -->
        <div class="events-hero">
            <h1>Sự Kiện Khu Du Lịch</h1>
            <p>Tham gia các sự kiện đặc sắc và hoạt động thú vị tại các khu vực khác nhau trong khu du lịch của chúng tôi</p>
        </div>

        <!-- Filter Tabs -->
        <div class="events-filters">
            <button class="filter-btn active" data-category="all">Tất Cả</button>
            <button class="filter-btn" data-category="upcoming">Sắp Diễn Ra</button>
            <button class="filter-btn" data-category="ongoing">Đang Diễn Ra</button>
            <button class="filter-btn" data-category="entertainment">Khu Vui Chơi</button>
            <button class="filter-btn" data-category="cultural">Khu Văn Hóa</button>
            <button class="filter-btn" data-category="nature">Khu Sinh Thái</button>
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
                    <img src="https://images.unsplash.com/photo-1594736797933-d0401ba2fe65?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Lễ hội mùa hè">
                    <span class="event-status upcoming">Sắp Diễn Ra</span>
                    <span class="event-price">200.000 VNĐ</span>
                </div>
                <div class="event-content">
                    <h2 class="event-title">Lễ Hội Mùa Hè Khu Du Lịch 2024</h2>
                    <div class="event-meta">
                        <div class="event-meta-item">
                            <i class="bi bi-calendar-event"></i>
                            <span>15-20 Tháng 6, 2024</span>
                        </div>
                        <div class="event-meta-item">
                            <i class="bi bi-geo-alt"></i>
                            <span>Khu Trung Tâm - Sân khấu chính</span>
                        </div>
                        <div class="event-meta-item">
                            <i class="bi bi-people"></i>
                            <span>500+ người tham gia</span>
                        </div>
                    </div>
                    <p class="event-description">Tham gia lễ hội mùa hè sôi động với các hoạt động giải trí, biểu diễn nghệ thuật, trò chơi dân gian và ẩm thực đặc sắc tại khu trung tâm của khu du lịch.</p>
                    <div class="event-actions">
                        <a href="#" class="event-btn event-btn-primary">Đăng Ký Ngay</a>
                        <a href="#" class="event-btn event-btn-secondary">Xem Chi Tiết</a>
                    </div>
                </div>
            </article>

            <!-- Regular Events -->
            <article class="event-card" data-category="cultural">
                <div class="event-card-image">
                    <img src="https://images.unsplash.com/photo-1578662996442-48f60103fc96?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Khu văn hóa dân tộc">
                    <span class="event-status upcoming">Sắp Diễn Ra</span>
                    <span class="event-price">150.000 VNĐ</span>
                </div>
                <div class="event-content">
                    <h3 class="event-title">Đêm Văn Hóa Dân Tộc - Khu C</h3>
                    <div class="event-meta">
                        <div class="event-meta-item">
                            <i class="bi bi-calendar-event"></i>
                            <span>25-27 Tháng 1</span>
                        </div>
                        <div class="event-meta-item">
                            <i class="bi bi-geo-alt"></i>
                            <span>Khu C - Không gian văn hóa</span>
                        </div>
                    </div>
                    <p class="event-description">Trải nghiệm văn hóa đặc sắc với các tiết mục biểu diễn dân gian, thưởng thức ẩm thực truyền thống và tham gia các hoạt động thủ công mỹ nghệ.</p>
                    <div class="event-actions">
                        <a href="#" class="event-btn event-btn-primary">Đăng Ký</a>
                        <a href="#" class="event-btn event-btn-secondary">Chi Tiết</a>
                    </div>
                </div>
            </article>

            <article class="event-card" data-category="entertainment">
                <div class="event-card-image">
                    <img src="https://images.unsplash.com/photo-1594736797933-d0401ba2fe65?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Khu vui chơi">
                    <span class="event-status ongoing">Đang Diễn Ra</span>
                    <span class="event-price">100.000 VNĐ</span>
                </div>
                <div class="event-content">
                    <h3 class="event-title">Ngày Hội Trò Chơi - Khu A</h3>
                    <div class="event-meta">
                        <div class="event-meta-item">
                            <i class="bi bi-calendar-event"></i>
                            <span>Cuối tuần</span>
                        </div>
                        <div class="event-meta-item">
                            <i class="bi bi-geo-alt"></i>
                            <span>Khu A - Khu vui chơi giải trí</span>
                        </div>
                    </div>
                    <p class="event-description">Tham gia các trò chơi hấp dẫn, thi đấu thể thao và các hoạt động giải trí dành cho cả gia đình tại khu vui chơi trung tâm.</p>
                    <div class="event-actions">
                        <a href="#" class="event-btn event-btn-primary">Tham Gia</a>
                        <a href="#" class="event-btn event-btn-secondary">Xem Thêm</a>
                    </div>
                </div>
            </article>

            <article class="event-card" data-category="nature">
                <div class="event-card-image">
                    <img src="https://images.unsplash.com/photo-1441974231531-c6227db76b6e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Khu sinh thái">
                    <span class="event-status upcoming">Sắp Diễn Ra</span>
                    <span class="event-price free">Miễn Phí</span>
                </div>
                <div class="event-content">
                    <h3 class="event-title">Đêm Quan Sát Thiên Nhiên - Khu D</h3>
                    <div class="event-meta">
                        <div class="event-meta-item">
                            <i class="bi bi-calendar-event"></i>
                            <span>24 Tháng 1</span>
                        </div>
                        <div class="event-meta-item">
                            <i class="bi bi-geo-alt"></i>
                            <span>Khu D - Khu sinh thái</span>
                        </div>
                    </div>
                    <p class="event-description">Khám phá đời sống động vật về đêm, quan sát các loài chim và côn trùng, tìm hiểu về hệ sinh thái địa phương trong không gian yên tĩnh.</p>
                    <div class="event-actions">
                        <a href="#" class="event-btn event-btn-primary">Tham Gia</a>
                        <a href="#" class="event-btn event-btn-secondary">Tìm Hiểu</a>
                    </div>
                </div>
            </article>

            <article class="event-card" data-category="entertainment">
                <div class="event-card-image">
                    <img src="https://images.unsplash.com/photo-1528127269322-539801943592?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Khu thể thao nước">
                    <span class="event-status upcoming">Sắp Diễn Ra</span>
                    <span class="event-price">80.000 VNĐ</span>
                </div>
                <div class="event-content">
                    <h3 class="event-title">Giải Bơi Lội Mùa Hè - Khu B</h3>
                    <div class="event-meta">
                        <div class="event-meta-item">
                            <i class="bi bi-calendar-event"></i>
                            <span>30 Tháng 1 - 2 Tháng 2</span>
                        </div>
                        <div class="event-meta-item">
                            <i class="bi bi-geo-alt"></i>
                            <span>Khu B - Khu thể thao nước</span>
                        </div>
                    </div>
                    <p class="event-description">Tham gia giải bơi lội với nhiều nội dung thi đấu phù hợp cho mọi lứa tuổi, cùng các hoạt động thể thao dưới nước thú vị.</p>
                    <div class="event-actions">
                        <a href="#" class="event-btn event-btn-primary">Đăng Ký</a>
                        <a href="#" class="event-btn event-btn-secondary">Xem Chi Tiết</a>
                    </div>
                </div>
            </article>

            <article class="event-card" data-category="nature">
                <div class="event-card-image">
                    <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Khu sinh thái">
                    <span class="event-status upcoming">Sắp Diễn Ra</span>
                    <span class="event-price">120.000 VNĐ</span>
                </div>
                <div class="event-content">
                    <h3 class="event-title">Tour Khám Phá Sinh Thái - Khu D</h3>
                    <div class="event-meta">
                        <div class="event-meta-item">
                            <i class="bi bi-calendar-event"></i>
                            <span>5-7 Tháng 2</span>
                        </div>
                        <div class="event-meta-item">
                            <i class="bi bi-geo-alt"></i>
                            <span>Khu D - Khu bảo tồn sinh thái</span>
                        </div>
                    </div>
                    <p class="event-description">Khám phá đa dạng sinh học với hướng dẫn viên chuyên nghiệp, tìm hiểu về các loài động thực vật bản địa và tham gia bảo vệ môi trường.</p>
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