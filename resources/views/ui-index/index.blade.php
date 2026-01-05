@extends('layouts.layouts')

@section('title', 'Phước Hải - Trang chủ')

@section('content')

    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

     <!-- Hero Section -->
    <section class="hero">
        <video class="hero-video" autoplay muted loop playsinline>
            <source
                src="https://assets.mixkit.co/videos/preview/mixkit-aerial-view-of-a-beach-in-vietnam-4046-large.mp4"
                type="video/mp4">
        </video>
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1>Khám Phá Vẻ Đẹp Việt Nam</h1>
            <p>Hành trình khám phá đất nước hình chữ S với những cảnh quan thiên nhiên tuyệt đẹp, văn hóa đa dạng và ẩm
                thực phong phú</p>
            <a href="#explore" class="hero-btn">Bắt đầu hành trình</a>
        </div>
        <div class="scroll-indicator">
            <div class="mouse"></div>
            <span>Cuộn xuống</span>
        </div>
    </section>

    <!-- Section 1: Intro + Stats -->
    <section class="intro-section" id="explore">
        <div class="intro-container">
            <div class="intro-images">
                <img src="https://images.unsplash.com/photo-1583417319070-4a69db38a482?w=600&h=800&fit=crop"
                    alt="Vịnh Hạ Long" class="intro-img-main">
                <img src="https://images.unsplash.com/photo-1557750255-c76072a7aad1?w=400&h=300&fit=crop"
                    alt="Phố cổ Hội An" class="intro-img-secondary">
            </div>
            <div class="intro-content">
                <span class="intro-label">Về Việt Nam</span>
                <h2>Điểm đến hàng đầu <span>Đông Nam Á</span></h2>
                <p>Việt Nam - đất nước với hơn 4000 năm lịch sử văn hiến, nơi hội tụ của những di sản văn hóa độc đáo,
                    cảnh quan thiên nhiên hùng vĩ và nền ẩm thực được thế giới công nhận. Từ những ruộng bậc thang Tây
                    Bắc đến bãi biển xanh ngọc miền Trung.</p>
                <div class="stats-grid">
                    <div class="stat-item">
                        <div class="stat-number" data-target="300">0</div>
                        <div class="stat-label">Điểm đến</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number" data-target="1000">0</div>
                        <div class="stat-label">Sự kiện/năm</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number" data-target="10">0</div>
                        <div class="stat-label">Triệu du khách</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 2: Image Slider -->
    <section class="slider-section">
        <div class="slider-header">
            <h2>Những điểm đến nổi bật</h2>
            <p>Khám phá những địa danh được yêu thích nhất Việt Nam</p>
        </div>
        <div class="slider-container">
            <div class="slider-track">
                <!-- Slide 1 -->
                <div class="slide-item">
                    <img src="https://images.unsplash.com/photo-1528127269322-539801943592?w=400&h=500&fit=crop"
                        alt="Vịnh Hạ Long">
                    <div class="slide-overlay">
                        <h3>Vịnh Hạ Long</h3>
                        <p>Di sản thiên nhiên thế giới UNESCO</p>
                    </div>
                </div>
                <!-- Slide 2 -->
                <div class="slide-item">
                    <img src="https://images.unsplash.com/photo-1559592413-7cec4d0cae2b?w=400&h=500&fit=crop"
                        alt="Phố cổ Hội An">
                    <div class="slide-overlay">
                        <h3>Phố cổ Hội An</h3>
                        <p>Thành phố đèn lồng cổ kính</p>
                    </div>
                </div>
                <!-- Slide 3 -->
                <div class="slide-item">
                    <img src="https://images.unsplash.com/photo-1464817739973-0128fe77aaa1?w=400&h=500&fit=crop"
                        alt="Sapa">
                    <div class="slide-overlay">
                        <h3>Sapa</h3>
                        <p>Ruộng bậc thang tuyệt đẹp</p>
                    </div>
                </div>
                <!-- Slide 4 -->
                <div class="slide-item">
                    <img src="https://images.unsplash.com/photo-1583417319070-4a69db38a482?w=400&h=500&fit=crop"
                        alt="Đà Nẵng">
                    <div class="slide-overlay">
                        <h3>Đà Nẵng</h3>
                        <p>Thành phố đáng sống nhất Việt Nam</p>
                    </div>
                </div>
                <!-- Duplicate for seamless loop -->
                <div class="slide-item">
                    <img src="https://images.unsplash.com/photo-1528127269322-539801943592?w=400&h=500&fit=crop"
                        alt="Vịnh Hạ Long">
                    <div class="slide-overlay">
                        <h3>Vịnh Hạ Long</h3>
                        <p>Di sản thiên nhiên thế giới UNESCO</p>
                    </div>
                </div>
                <div class="slide-item">
                    <img src="https://images.unsplash.com/photo-1559592413-7cec4d0cae2b?w=400&h=500&fit=crop"
                        alt="Phố cổ Hội An">
                    <div class="slide-overlay">
                        <h3>Phố cổ Hội An</h3>
                        <p>Thành phố đèn lồng cổ kính</p>
                    </div>
                </div>
                <div class="slide-item">
                    <img src="https://images.unsplash.com/photo-1464817739973-0128fe77aaa1?w=400&h=500&fit=crop"
                        alt="Sapa">
                    <div class="slide-overlay">
                        <h3>Sapa</h3>
                        <p>Ruộng bậc thang tuyệt đẹp</p>
                    </div>
                </div>
                <div class="slide-item">
                    <img src="https://images.unsplash.com/photo-1583417319070-4a69db38a482?w=400&h=500&fit=crop"
                        alt="Đà Nẵng">
                    <div class="slide-overlay">
                        <h3>Đà Nẵng</h3>
                        <p>Thành phố đáng sống nhất Việt Nam</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 3: Categories -->
    <section class="categories-section" id="categories">
        <div class="categories-container">
            <div class="categories-header">
                <h1>Khám phá theo chủ đề</h1>
                <p>Lựa chọn trải nghiệm phù hợp với sở thích của bạn</p>
            </div>

            <!-- Desktop Tabs -->
            <div class="category-tabs">
                <button class="category-tab active" data-category="culture">Văn hóa</button>
                <button class="category-tab" data-category="food">Ẩm thực</button>
                <button class="category-tab" data-category="entertainment">Giải trí</button>
                <button class="category-tab" data-category="shopping">Mua sắm</button>
                <button class="category-tab" data-category="nature">Thiên nhiên</button>
            </div>

            <!-- Mobile Select -->
            <div class="category-select-wrapper">
                <select class="category-select" id="categorySelect">
                    <option value="culture">Văn hóa</option>
                    <option value="food">Ẩm thực</option>
                    <option value="entertainment">Giải trí</option>
                    <option value="shopping">Mua sắm</option>
                    <option value="nature">Thiên nhiên</option>
                </select>
            </div>

            <!-- Category Contents -->
            <div class="category-content active" data-content="culture">
                <div class="category-intro">
                    <h3>Văn hóa Việt Nam</h3>
                    <p>Khám phá di sản văn hóa phong phú với hàng ngàn năm lịch sử</p>
                </div>
                <div class="category-grid">
                    <div class="category-card">
                        <div class="category-card-img">
                            <img src="https://images.unsplash.com/photo-1555400038-63f5ba517a47?w=400&h=300&fit=crop"
                                alt="Hoàng thành Huế">
                        </div>
                        <div class="category-card-content">
                            <h4>Hoàng thành Huế</h4>
                            <p>Di sản văn hóa thế giới với kiến trúc cung đình độc đáo thời Nguyễn.</p>
                        </div>
                    </div>
                    <div class="category-card">
                        <div class="category-card-img">
                            <img src="https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=400&h=300&fit=crop"
                                alt="Văn Miếu">
                        </div>
                        <div class="category-card-content">
                            <h4>Văn Miếu Quốc Tử Giám</h4>
                            <p>Trường đại học đầu tiên của Việt Nam, biểu tượng của nền giáo dục.</p>
                        </div>
                    </div>
                    <div class="category-card">
                        <div class="category-card-img">
                            <img src="https://images.unsplash.com/photo-1559592413-7cec4d0cae2b?w=400&h=300&fit=crop"
                                alt="Hội An">
                        </div>
                        <div class="category-card-content">
                            <h4>Phố cổ Hội An</h4>
                            <p>Đô thị cổ được bảo tồn nguyên vẹn với những ngôi nhà trăm năm tuổi.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="category-content" data-content="food">
                <div class="category-intro">
                    <h3>Ẩm thực Việt Nam</h3>
                    <p>Thưởng thức những món ăn đặc sắc nhất của nền ẩm thực Việt</p>
                </div>
                <div class="category-grid">
                    <div class="category-card">
                        <div class="category-card-img">
                            <img src="https://images.unsplash.com/photo-1582878826629-29b7ad1cdc43?w=400&h=300&fit=crop"
                                alt="Phở Hà Nội">
                        </div>
                        <div class="category-card-content">
                            <h4>Phở Hà Nội</h4>
                            <p>Món ăn biểu tượng với nước dùng thanh ngọt và bánh phở mềm mịn.</p>
                        </div>
                    </div>
                    <div class="category-card">
                        <div class="category-card-img">
                            <img src="https://images.unsplash.com/photo-1529692236671-f1f6cf9683ba?w=400&h=300&fit=crop"
                                alt="Bánh mì">
                        </div>
                        <div class="category-card-content">
                            <h4>Bánh mì Việt Nam</h4>
                            <p>Được CNN bình chọn là một trong những món sandwich ngon nhất thế giới.</p>
                        </div>
                    </div>
                    <div class="category-card">
                        <div class="category-card-img">
                            <img src="https://images.unsplash.com/photo-1562565652-a0d8f0c59eb4?w=400&h=300&fit=crop"
                                alt="Bún chả">
                        </div>
                        <div class="category-card-content">
                            <h4>Bún chả Hà Nội</h4>
                            <p>Món ăn được Tổng thống Obama thưởng thức khi đến thăm Việt Nam.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="category-content" data-content="entertainment">
                <div class="category-intro">
                    <h3>Giải trí & Vui chơi</h3>
                    <p>Những trải nghiệm giải trí độc đáo và thú vị</p>
                </div>
                <div class="category-grid">
                    <div class="category-card">
                        <div class="category-card-img">
                            <img src="https://images.unsplash.com/photo-1596422846543-75c6fc197f07?w=400&h=300&fit=crop"
                                alt="Vinpearl Land">
                        </div>
                        <div class="category-card-content">
                            <h4>VinWonders</h4>
                            <p>Công viên giải trí hàng đầu Việt Nam với nhiều trò chơi hiện đại.</p>
                        </div>
                    </div>
                    <div class="category-card">
                        <div class="category-card-img">
                            <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=400&h=300&fit=crop"
                                alt="Bà Nà Hills">
                        </div>
                        <div class="category-card-content">
                            <h4>Bà Nà Hills</h4>
                            <p>Khu du lịch nổi tiếng với Cầu Vàng và cáp treo dài nhất thế giới.</p>
                        </div>
                    </div>
                    <div class="category-card">
                        <div class="category-card-img">
                            <img src="https://images.unsplash.com/photo-1540202404-a2f29016b523?w=400&h=300&fit=crop"
                                alt="Múa rối nước">
                        </div>
                        <div class="category-card-content">
                            <h4>Múa rối nước</h4>
                            <p>Nghệ thuật truyền thống độc đáo chỉ có tại Việt Nam.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="category-content" data-content="shopping">
                <div class="category-intro">
                    <h3>Mua sắm</h3>
                    <p>Điểm đến mua sắm hấp dẫn từ truyền thống đến hiện đại</p>
                </div>
                <div class="category-grid">
                    <div class="category-card">
                        <div class="category-card-img">
                            <img src="https://images.unsplash.com/photo-1555529669-e69e7aa0ba9a?w=400&h=300&fit=crop"
                                alt="Chợ Bến Thành">
                        </div>
                        <div class="category-card-content">
                            <h4>Chợ Bến Thành</h4>
                            <p>Biểu tượng của Sài Gòn với hàng ngàn mặt hàng đa dạng.</p>
                        </div>
                    </div>
                    <div class="category-card">
                        <div class="category-card-img">
                            <img src="https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=400&h=300&fit=crop"
                                alt="Trung tâm thương mại">
                        </div>
                        <div class="category-card-content">
                            <h4>Vincom Center</h4>
                            <p>Trung tâm thương mại hiện đại với các thương hiệu quốc tế.</p>
                        </div>
                    </div>
                    <div class="category-card">
                        <div class="category-card-img">
                            <img src="https://images.unsplash.com/photo-1568254183919-78a4f43a2877?w=400&h=300&fit=crop"
                                alt="Làng nghề">
                        </div>
                        <div class="category-card-content">
                            <h4>Làng nghề truyền thống</h4>
                            <p>Mua sản phẩm thủ công mỹ nghệ từ các làng nghề nổi tiếng.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="category-content" data-content="nature">
                <div class="category-intro">
                    <h3>Thiên nhiên</h3>
                    <p>Chiêm ngưỡng vẻ đẹp hùng vĩ của thiên nhiên Việt Nam</p>
                </div>
                <div class="category-grid">
                    <div class="category-card">
                        <div class="category-card-img">
                            <img src="https://images.unsplash.com/photo-1528127269322-539801943592?w=400&h=300&fit=crop"
                                alt="Vịnh Hạ Long">
                        </div>
                        <div class="category-card-content">
                            <h4>Vịnh Hạ Long</h4>
                            <p>Kỳ quan thiên nhiên với hơn 1,600 hòn đảo đá vôi.</p>
                        </div>
                    </div>
                    <div class="category-card">
                        <div class="category-card-img">
                            <img src="https://images.unsplash.com/photo-1464817739973-0128fe77aaa1?w=400&h=300&fit=crop"
                                alt="Sapa">
                        </div>
                        <div class="category-card-content">
                            <h4>Ruộng bậc thang Sapa</h4>
                            <p>Những thửa ruộng bậc thang đẹp như tranh vẽ vùng Tây Bắc.</p>
                        </div>
                    </div>
                    <div class="category-card">
                        <div class="category-card-img">
                            <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=400&h=300&fit=crop"
                                alt="Biển Phú Quốc">
                        </div>
                        <div class="category-card-content">
                            <h4>Đảo Phú Quốc</h4>
                            <p>Hòn đảo ngọc với bãi biển trong xanh và hoàng hôn tuyệt đẹp.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="{{ asset('js/index.js') }}"></script>
@endsection
