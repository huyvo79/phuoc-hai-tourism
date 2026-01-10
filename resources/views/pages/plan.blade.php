@extends('layouts.layouts')

@section('title', 'Kế Hoạch Du Lịch')

@section('body_class', 'plan-page')

@section('content')
<div class="plan-container">
    <div class="container">
        <!-- Hero Section -->
        <div class="plan-hero">
            <h1>Lập Kế Hoạch Du Lịch</h1>
            <p>Tạo ra chuyến đi hoàn hảo với công cụ lập kế hoạch thông minh của chúng tôi. Từ việc chọn điểm đến đến sắp xếp lịch trình chi tiết.</p>
        </div>

        <!-- Planning Steps -->
        <div class="planning-steps">
            <div class="step-card">
                <div class="step-number">1</div>
                <h3 class="step-title">Chọn Điểm Đến</h3>
                <p class="step-description">Khám phá và lựa chọn những điểm đến phù hợp với sở thích và ngân sách của bạn</p>
            </div>
            <div class="step-card">
                <div class="step-number">2</div>
                <h3 class="step-title">Lên Lịch Trình</h3>
                <p class="step-description">Sắp xếp thời gian, hoạt động và các điểm tham quan theo từng ngày một cách hợp lý</p>
            </div>
            <div class="step-card">
                <div class="step-number">3</div>
                <h3 class="step-title">Đặt Dịch Vụ</h3>
                <p class="step-description">Đặt vé máy bay, khách sạn, tour và các dịch vụ cần thiết cho chuyến đi</p>
            </div>
            <div class="step-card">
                <div class="step-number">4</div>
                <h3 class="step-title">Chuẩn Bị</h3>
                <p class="step-description">Chuẩn bị hành lý, giấy tờ và mọi thứ cần thiết cho một chuyến đi hoàn hảo</p>
            </div>
        </div>

        <!-- Trip Planner Form -->
        <div class="trip-planner">
            <div class="planner-header">
                <h2>Tạo Kế Hoạch Du Lịch Của Bạn</h2>
                <p>Điền thông tin dưới đây để chúng tôi gợi ý những điểm đến và lịch trình phù hợp nhất</p>
            </div>

            <form class="planner-form" id="tripPlannerForm">
                <div class="form-row">
                    <div class="form-group">
                        <label for="departure">Điểm Khởi Hành</label>
                        <select class="form-control form-control-select" id="departure" required>
                            <option value="">Chọn điểm khởi hành</option>
                            <option value="hanoi">Hà Nội</option>
                            <option value="hcm">TP. Hồ Chí Minh</option>
                            <option value="danang">Đà Nẵng</option>
                            <option value="haiphong">Hải Phòng</option>
                            <option value="cantho">Cần Thơ</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="destination">Điểm Đến Mong Muốn</label>
                        <select class="form-control form-control-select" id="destination">
                            <option value="">Để trống nếu chưa quyết định</option>
                            <option value="sapa">Sapa</option>
                            <option value="halong">Vịnh Hạ Long</option>
                            <option value="hoian">Hội An</option>
                            <option value="dalat">Đà Lạt</option>
                            <option value="phuquoc">Phú Quốc</option>
                            <option value="nhatrang">Nha Trang</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="startDate">Ngày Bắt Đầu</label>
                        <input type="date" class="form-control" id="startDate" required>
                    </div>
                    <div class="form-group">
                        <label for="endDate">Ngày Kết Thúc</label>
                        <input type="date" class="form-control" id="endDate" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="travelers">Số Người Tham Gia</label>
                        <select class="form-control form-control-select" id="travelers" required>
                            <option value="">Chọn số người</option>
                            <option value="1">1 người</option>
                            <option value="2">2 người</option>
                            <option value="3-4">3-4 người</option>
                            <option value="5-8">5-8 người</option>
                            <option value="9+">Trên 9 người</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="travelStyle">Phong Cách Du Lịch</label>
                        <select class="form-control form-control-select" id="travelStyle" required>
                            <option value="">Chọn phong cách</option>
                            <option value="budget">Tiết kiệm</option>
                            <option value="comfort">Thoải mái</option>
                            <option value="luxury">Sang trọng</option>
                            <option value="adventure">Phiêu lưu</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>Ngân Sách Dự Kiến (VNĐ/người)</label>
                    <div class="budget-range">
                        <input type="number" class="form-control" placeholder="Từ" id="budgetMin">
                        <span class="budget-separator">đến</span>
                        <input type="number" class="form-control" placeholder="Đến" id="budgetMax">
                    </div>
                </div>

                <div class="form-group">
                    <label>Sở Thích & Hoạt Động</label>
                    <div class="interests-grid">
                        <div class="interest-item">
                            <input type="checkbox" id="nature" value="nature">
                            <label for="nature">Thiên nhiên</label>
                        </div>
                        <div class="interest-item">
                            <input type="checkbox" id="culture" value="culture">
                            <label for="culture">Văn hóa</label>
                        </div>
                        <div class="interest-item">
                            <input type="checkbox" id="food" value="food">
                            <label for="food">Ẩm thực</label>
                        </div>
                        <div class="interest-item">
                            <input type="checkbox" id="beach" value="beach">
                            <label for="beach">Biển đảo</label>
                        </div>
                        <div class="interest-item">
                            <input type="checkbox" id="mountain" value="mountain">
                            <label for="mountain">Núi rừng</label>
                        </div>
                        <div class="interest-item">
                            <input type="checkbox" id="city" value="city">
                            <label for="city">Thành phố</label>
                        </div>
                        <div class="interest-item">
                            <input type="checkbox" id="history" value="history">
                            <label for="history">Lịch sử</label>
                        </div>
                        <div class="interest-item">
                            <input type="checkbox" id="shopping" value="shopping">
                            <label for="shopping">Mua sắm</label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="plan-btn">Tạo Kế Hoạch Du Lịch</button>
            </form>
        </div>

        <!-- Suggested Destinations -->
        <div class="suggested-destinations">
            <div class="destinations-header">
                <h2>Điểm Đến Được Gợi Ý</h2>
                <p>Những điểm đến phổ biến và được yêu thích nhất hiện tại</p>
            </div>

            <div class="destinations-grid">
                <div class="destination-card" data-destination="sapa">
                    <div class="destination-image">
                        <img src="https://images.unsplash.com/photo-1578662996442-48f60103fc96?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Sapa">
                        <div class="destination-badge">Núi rừng</div>
                    </div>
                    <div class="destination-content">
                        <h3 class="destination-title">Sapa - Thị Trấn Trong Mây</h3>
                        <p class="destination-description">Khám phá vẻ đẹp hùng vĩ của dãy Hoàng Liên Sơn, chinh phục đỉnh Fansipan và trải nghiệm văn hóa độc đáo của các dân tộc thiểu số.</p>
                        <div class="destination-meta">
                            <span class="destination-price">Từ 2.500.000 VNĐ</span>
                            <span class="destination-duration">3-4 ngày</span>
                        </div>
                        <button class="destination-btn">Chọn Điểm Đến Này</button>
                    </div>
                </div>

                <div class="destination-card" data-destination="halong">
                    <div class="destination-image">
                        <img src="https://images.unsplash.com/photo-1559827260-dc66d52bef19?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Vịnh Hạ Long">
                        <div class="destination-badge">Biển đảo</div>
                    </div>
                    <div class="destination-content">
                        <h3 class="destination-title">Vịnh Hạ Long - Kỳ Quan Thế Giới</h3>
                        <p class="destination-description">Du thuyền trên vịnh biển tuyệt đẹp với hàng nghìn đảo đá vôi, khám phá các hang động kỳ bí và thưởng thức hải sản tươi ngon.</p>
                        <div class="destination-meta">
                            <span class="destination-price">Từ 1.800.000 VNĐ</span>
                            <span class="destination-duration">2-3 ngày</span>
                        </div>
                        <button class="destination-btn">Chọn Điểm Đến Này</button>
                    </div>
                </div>

                <div class="destination-card" data-destination="hoian">
                    <div class="destination-image">
                        <img src="https://images.unsplash.com/photo-1583417319070-4a69db38a482?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Hội An">
                        <div class="destination-badge">Văn hóa</div>
                    </div>
                    <div class="destination-content">
                        <h3 class="destination-title">Hội An - Phố Cổ Thơ Mộng</h3>
                        <p class="destination-description">Dạo bước trên những con phố cổ kính, thưởng thức ẩm thực đặc sắc và tham gia lễ hội đèn lồng đầy màu sắc.</p>
                        <div class="destination-meta">
                            <span class="destination-price">Từ 2.000.000 VNĐ</span>
                            <span class="destination-duration">2-3 ngày</span>
                        </div>
                        <button class="destination-btn">Chọn Điểm Đến Này</button>
                    </div>
                </div>

                <div class="destination-card" data-destination="dalat">
                    <div class="destination-image">
                        <img src="https://images.unsplash.com/photo-1533174072545-7a4b6ad7a6c3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Đà Lạt">
                        <div class="destination-badge">Thành phố</div>
                    </div>
                    <div class="destination-content">
                        <h3 class="destination-title">Đà Lạt - Thành Phố Ngàn Hoa</h3>
                        <p class="destination-description">Tận hưởng khí hậu mát mẻ quanh năm, khám phá những vườn hoa rực rỡ và thưởng thức các món ăn đặc sản miền núi.</p>
                        <div class="destination-meta">
                            <span class="destination-price">Từ 1.500.000 VNĐ</span>
                            <span class="destination-duration">2-3 ngày</span>
                        </div>
                        <button class="destination-btn">Chọn Điểm Đến Này</button>
                    </div>
                </div>

                <div class="destination-card" data-destination="phuquoc">
                    <div class="destination-image">
                        <img src="https://images.unsplash.com/photo-1528127269322-539801943592?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Phú Quốc">
                        <div class="destination-badge">Biển đảo</div>
                    </div>
                    <div class="destination-content">
                        <h3 class="destination-title">Phú Quốc - Đảo Ngọc Việt Nam</h3>
                        <p class="destination-description">Thư giãn trên những bãi biển cát trắng tuyệt đẹp, khám phá rừng nguyên sinh và thưởng thức hải sản tươi sống.</p>
                        <div class="destination-meta">
                            <span class="destination-price">Từ 3.000.000 VNĐ</span>
                            <span class="destination-duration">3-5 ngày</span>
                        </div>
                        <button class="destination-btn">Chọn Điểm Đến Này</button>
                    </div>
                </div>

                <div class="destination-card" data-destination="nhatrang">
                    <div class="destination-image">
                        <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Nha Trang">
                        <div class="destination-badge">Biển đảo</div>
                    </div>
                    <div class="destination-content">
                        <h3 class="destination-title">Nha Trang - Thiên Đường Biển</h3>
                        <p class="destination-description">Tham gia các hoạt động thể thao biển, khám phá đảo Hon Mun và tận hưởng cuộc sống về đêm sôi động.</p>
                        <div class="destination-meta">
                            <span class="destination-price">Từ 2.200.000 VNĐ</span>
                            <span class="destination-duration">3-4 ngày</span>
                        </div>
                        <button class="destination-btn">Chọn Điểm Đến Này</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Interest checkboxes interaction
    const interestItems = document.querySelectorAll('.interest-item');
    interestItems.forEach(item => {
        const checkbox = item.querySelector('input[type="checkbox"]');
        
        item.addEventListener('click', function(e) {
            if (e.target.type !== 'checkbox') {
                checkbox.checked = !checkbox.checked;
            }
            
            if (checkbox.checked) {
                item.classList.add('checked');
            } else {
                item.classList.remove('checked');
            }
        });
        
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                item.classList.add('checked');
            } else {
                item.classList.remove('checked');
            }
        });
    });
    
    // Form submission
    const form = document.getElementById('tripPlannerForm');
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const submitBtn = form.querySelector('.plan-btn');
        const originalText = submitBtn.textContent;
        
        // Show loading state
        submitBtn.textContent = 'Đang tạo kế hoạch...';
        submitBtn.disabled = true;
        
        // Simulate processing
        setTimeout(() => {
            submitBtn.textContent = 'Kế hoạch đã được tạo!';
            submitBtn.style.background = 'linear-gradient(135deg, #10b981, #059669)';
            
            // Show success message
            alert('Kế hoạch du lịch của bạn đã được tạo thành công! Chúng tôi sẽ gửi chi tiết qua email trong vài phút.');
            
            // Reset after 3 seconds
            setTimeout(() => {
                submitBtn.textContent = originalText;
                submitBtn.disabled = false;
                submitBtn.style.background = 'linear-gradient(135deg, var(--primary, #0f766e), var(--primary-dark, #0d5c56))';
            }, 3000);
        }, 2000);
    });
    
    // Destination card selection
    const destinationCards = document.querySelectorAll('.destination-card');
    destinationCards.forEach(card => {
        const btn = card.querySelector('.destination-btn');
        
        btn.addEventListener('click', function() {
            const destination = card.getAttribute('data-destination');
            const title = card.querySelector('.destination-title').textContent;
            
            // Update form with selected destination
            const destinationSelect = document.getElementById('destination');
            destinationSelect.value = destination;
            
            // Visual feedback
            this.textContent = 'Đã chọn!';
            this.style.background = 'linear-gradient(135deg, #10b981, #059669)';
            
            // Scroll to form
            document.querySelector('.trip-planner').scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
            
            // Reset button after 2 seconds
            setTimeout(() => {
                this.textContent = 'Chọn Điểm Đến Này';
                this.style.background = 'linear-gradient(135deg, var(--primary, #0f766e), var(--primary-dark, #0d5c56))';
            }, 2000);
        });
    });
    
    // Date validation
    const startDate = document.getElementById('startDate');
    const endDate = document.getElementById('endDate');
    
    // Set minimum date to today
    const today = new Date().toISOString().split('T')[0];
    startDate.min = today;
    endDate.min = today;
    
    startDate.addEventListener('change', function() {
        endDate.min = this.value;
        if (endDate.value && endDate.value < this.value) {
            endDate.value = this.value;
        }
    });
    
    // Budget formatting
    const budgetInputs = document.querySelectorAll('#budgetMin, #budgetMax');
    budgetInputs.forEach(input => {
        input.addEventListener('input', function() {
            // Format number with thousand separators
            let value = this.value.replace(/\D/g, '');
            if (value) {
                this.value = parseInt(value).toLocaleString('vi-VN');
            }
        });
        
        input.addEventListener('blur', function() {
            // Remove formatting for form submission
            this.value = this.value.replace(/\D/g, '');
        });
    });
});
</script>
@endsection
@endsection