@extends('layouts.layouts')

@section('title', 'Kế Hoạch Du Lịch')

@section('body_class', 'plan-page')

@section('content')
<div class="plan-container">
    <div class="container">
        <!-- Hero Section -->
        <div class="plan-hero">
            <h1>Lập Kế Hoạch Tham Quan</h1>
            <p>Tạo ra lịch trình tham quan hoàn hảo cho chuyến thăm khu du lịch của bạn. Từ việc chọn khu vực đến sắp xếp thời gian tham quan hợp lý.</p>
        </div>

        <!-- Planning Steps -->
        <div class="planning-steps">
            <div class="step-card">
                <div class="step-number">1</div>
                <h3 class="step-title">Chọn Khu Vực</h3>
                <p class="step-description">Lựa chọn các khu vực phù hợp với sở thích: vui chơi giải trí, văn hóa, sinh thái hay nghỉ dưỡng</p>
            </div>
            <div class="step-card">
                <div class="step-number">2</div>
                <h3 class="step-title">Lên Lịch Trình</h3>
                <p class="step-description">Sắp xếp thời gian tham quan các khu vực và hoạt động theo từng giờ một cách hợp lý</p>
            </div>
            <div class="step-card">
                <div class="step-number">3</div>
                <h3 class="step-title">Đặt Dịch Vụ</h3>
                <p class="step-description">Đặt vé tham quan, bữa ăn, và các dịch vụ bổ sung cần thiết cho chuyến thăm</p>
            </div>
            <div class="step-card">
                <div class="step-number">4</div>
                <h3 class="step-title">Chuẩn Bị</h3>
                <p class="step-description">Chuẩn bị đồ dùng cá nhân và mọi thứ cần thiết cho một ngày tham quan thú vị</p>
            </div>
        </div>

        <!-- Trip Planner Form -->
        <div class="trip-planner">
            <div class="planner-header">
                <h2>Tạo Kế Hoạch Tham Quan Của Bạn</h2>
                <p>Điền thông tin dưới đây để chúng tôi gợi ý lịch trình tham quan phù hợp nhất cho bạn</p>
            </div>

            <form class="planner-form" id="tripPlannerForm">
                <div class="form-row">
                    <div class="form-group">
                        <label for="visitDate">Ngày Tham Quan</label>
                        <input type="date" class="form-control" id="visitDate" required>
                    </div>
                    <div class="form-group">
                        <label for="visitTime">Thời Gian Bắt Đầu</label>
                        <select class="form-control form-control-select" id="visitTime" required>
                            <option value="">Chọn giờ bắt đầu</option>
                            <option value="08:00">08:00 - Sáng sớm</option>
                            <option value="09:00">09:00 - Buổi sáng</option>
                            <option value="10:00">10:00 - Sáng muộn</option>
                            <option value="13:00">13:00 - Buổi chiều</option>
                            <option value="15:00">15:00 - Chiều muộn</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="duration">Thời Gian Tham Quan</label>
                        <select class="form-control form-control-select" id="duration" required>
                            <option value="">Chọn thời gian</option>
                            <option value="half-day">Nửa ngày (4 giờ)</option>
                            <option value="full-day">Cả ngày (8 giờ)</option>
                            <option value="evening">Buổi tối (3 giờ)</option>
                            <option value="custom">Tùy chỉnh</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="groupSize">Số Người Tham Gia</label>
                        <select class="form-control form-control-select" id="groupSize" required>
                            <option value="">Chọn số người</option>
                            <option value="1">1 người</option>
                            <option value="2">2 người</option>
                            <option value="3-5">3-5 người</option>
                            <option value="6-10">6-10 người</option>
                            <option value="10+">Trên 10 người</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>Ngân Sách Dự Kiến (VNĐ/người)</label>
                    <div class="budget-range">
                        <input type="number" class="form-control" placeholder="Từ 100.000" id="budgetMin">
                        <span class="budget-separator">đến</span>
                        <input type="number" class="form-control" placeholder="Đến 500.000" id="budgetMax">
                    </div>
                </div>

                <div class="form-group">
                    <label>Khu Vực Quan Tâm</label>
                    <div class="interests-grid">
                        <div class="interest-item">
                            <input type="checkbox" id="entertainment" value="entertainment">
                            <label for="entertainment">Khu A - Vui chơi giải trí</label>
                        </div>
                        <div class="interest-item">
                            <input type="checkbox" id="sports" value="sports">
                            <label for="sports">Khu B - Thể thao nước</label>
                        </div>
                        <div class="interest-item">
                            <input type="checkbox" id="culture" value="culture">
                            <label for="culture">Khu C - Văn hóa</label>
                        </div>
                        <div class="interest-item">
                            <input type="checkbox" id="nature" value="nature">
                            <label for="nature">Khu D - Sinh thái</label>
                        </div>
                        <div class="interest-item">
                            <input type="checkbox" id="restaurant" value="restaurant">
                            <label for="restaurant">Khu ẩm thực</label>
                        </div>
                        <div class="interest-item">
                            <input type="checkbox" id="accommodation" value="accommodation">
                            <label for="accommodation">Khu nghỉ dưỡng</label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="plan-btn">Tạo Lịch Trình Tham Quan</button>
            </form>
        </div>

        <!-- Suggested Destinations -->
        <div class="suggested-destinations">
            <div class="destinations-header">
                <h2>Khu Vực Được Gợi Ý</h2>
                <p>Những khu vực phổ biến và được yêu thích nhất trong khu du lịch</p>
            </div>

            <div class="destinations-grid">
                <div class="destination-card" data-destination="entertainment">
                    <div class="destination-image">
                        <img src="https://images.unsplash.com/photo-1594736797933-d0401ba2fe65?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Khu A">
                        <div class="destination-badge">Vui chơi</div>
                    </div>
                    <div class="destination-content">
                        <h3 class="destination-title">Khu A - Vui Chơi Giải Trí</h3>
                        <p class="destination-description">Khu vui chơi hiện đại với đầy đủ trò chơi hấp dẫn cho mọi lứa tuổi, từ tàu lượn siêu tốc đến khu vui chơi trẻ em an toàn.</p>
                        <div class="destination-meta">
                            <span class="destination-price">Từ 100.000 VNĐ</span>
                            <span class="destination-duration">3-4 giờ</span>
                        </div>
                        <button class="destination-btn">Chọn Khu Vực Này</button>
                    </div>
                </div>

                <div class="destination-card" data-destination="sports">
                    <div class="destination-image">
                        <img src="https://images.unsplash.com/photo-1528127269322-539801943592?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Khu B">
                        <div class="destination-badge">Thể thao</div>
                    </div>
                    <div class="destination-content">
                        <h3 class="destination-title">Khu B - Thể Thao Nước</h3>
                        <p class="destination-description">Khu thể thao nước với hồ bơi, trượt nước và các hoạt động thể thao dưới nước thú vị cho cả gia đình.</p>
                        <div class="destination-meta">
                            <span class="destination-price">Từ 80.000 VNĐ</span>
                            <span class="destination-duration">2-3 giờ</span>
                        </div>
                        <button class="destination-btn">Chọn Khu Vực Này</button>
                    </div>
                </div>

                <div class="destination-card" data-destination="culture">
                    <div class="destination-image">
                        <img src="https://images.unsplash.com/photo-1578662996442-48f60103fc96?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Khu C">
                        <div class="destination-badge">Văn hóa</div>
                    </div>
                    <div class="destination-content">
                        <h3 class="destination-title">Khu C - Không Gian Văn Hóa</h3>
                        <p class="destination-description">Khám phá văn hóa truyền thống với các tiết mục biểu diễn, triển lãm và hoạt động thủ công mỹ nghệ.</p>
                        <div class="destination-meta">
                            <span class="destination-price">Từ 60.000 VNĐ</span>
                            <span class="destination-duration">2-3 giờ</span>
                        </div>
                        <button class="destination-btn">Chọn Khu Vực Này</button>
                    </div>
                </div>

                <div class="destination-card" data-destination="nature">
                    <div class="destination-image">
                        <img src="https://images.unsplash.com/photo-1441974231531-c6227db76b6e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Khu D">
                        <div class="destination-badge">Sinh thái</div>
                    </div>
                    <div class="destination-content">
                        <h3 class="destination-title">Khu D - Khu Sinh Thái</h3>
                        <p class="destination-description">Tìm hiểu về thiên nhiên và động vật hoang dã trong môi trường sinh thái được bảo tồn cẩn thận.</p>
                        <div class="destination-meta">
                            <span class="destination-price">Từ 50.000 VNĐ</span>
                            <span class="destination-duration">2-4 giờ</span>
                        </div>
                        <button class="destination-btn">Chọn Khu Vực Này</button>
                    </div>
                </div>

                <div class="destination-card" data-destination="restaurant">
                    <div class="destination-image">
                        <img src="https://images.unsplash.com/photo-1559181567-c3190ca9959b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2064&q=80" alt="Khu ẩm thực">
                        <div class="destination-badge">Ẩm thực</div>
                    </div>
                    <div class="destination-content">
                        <h3 class="destination-title">Khu Ẩm Thực Trung Tâm</h3>
                        <p class="destination-description">Thưởng thức các món ăn đặc sản địa phương và quốc tế tại khu ẩm thực với nhiều lựa chọn phong phú.</p>
                        <div class="destination-meta">
                            <span class="destination-price">Từ 150.000 VNĐ</span>
                            <span class="destination-duration">1-2 giờ</span>
                        </div>
                        <button class="destination-btn">Chọn Khu Vực Này</button>
                    </div>
                </div>

                <div class="destination-card" data-destination="accommodation">
                    <div class="destination-image">
                        <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Khu nghỉ dưỡng">
                        <div class="destination-badge">Nghỉ dưỡng</div>
                    </div>
                    <div class="destination-content">
                        <h3 class="destination-title">Khu Nghỉ Dưỡng</h3>
                        <p class="destination-description">Thư giãn tại khu nghỉ dưỡng cao cấp với spa, phòng gym và các tiện ích nghỉ dưỡng hiện đại.</p>
                        <div class="destination-meta">
                            <span class="destination-price">Từ 300.000 VNĐ</span>
                            <span class="destination-duration">Cả ngày</span>
                        </div>
                        <button class="destination-btn">Chọn Khu Vực Này</button>
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