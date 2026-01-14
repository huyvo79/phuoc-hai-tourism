@extends('layouts.layouts')

@section('title', 'Phước Hải - Trang chủ')

@section('content')

    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <section class="hero">
        <video class="hero-video" autoplay muted loop playsinline>
            <source src="{{ asset('images/855633-hd_1920_1080_25fps.mp4') }}" type="video/mp4">
        </video>
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1>Khám Phá Vẻ Đẹp Phước Hải</h1>
            <p>Hành trình khám phá xã Phước Hải, với những cảnh quan thiên nhiên tuyệt đẹp, văn hóa đa dạng và ẩm thực phong
                phú</p>
            <a href="#explore" class="hero-btn">Bắt đầu hành trình</a>
        </div>
        <div class="scroll-indicator">
            <div class="mouse"></div>
            <span>Cuộn xuống</span>
        </div>
    </section>

    <section class="intro-section" id="explore">
        <div class="intro-container">
            <div class="intro-images">
                <img src="{{ asset('images/du-lich-phuoc-hai-vung-tau.jpg') }}" alt="Du Lịch Phước Hải"
                    class="intro-img-main">
                <img src="{{ asset('images/phuot-phuoc-hai-vung-tau.jpg') }}" alt="Du Lịch Phước Hải"
                    class="intro-img-secondary">
            </div>
            <div class="intro-content">
                <span class="intro-label">Về Phước Hải</span>

                <h2>Viên ngọc thô của <span>Bà Rịa - Vũng Tàu</span></h2>

                <p>
                    Không ồn ào như Vũng Tàu, Phước Hải mang vẻ đẹp bình dị của một làng chài có tuổi đời hơn trăm năm.
                    Nơi đây được mệnh danh là "thủ phủ cá khô", sở hữu cung đường biển đẹp như mơ và những bờ kè chắn sóng
                    đầy chất thơ, thu hút hàng triệu tín đồ du lịch bụi mỗi năm.
                </p>

                <div class="stats-grid">
                    <div class="stat-item">
                        <div class="stat-number" data-target="30">0</div>
                        <div class="stat-label">Điểm tham quan</div>
                    </div>

                    <div class="stat-item">
                        <div class="stat-number" data-target="150">0</div>
                        <div class="stat-label">Năm lịch sử</div>
                    </div>

                    <div class="stat-item">
                        <div class="stat-number" data-target="2">0</div>
                        <div class="stat-label">Triệu lượt khách</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="slider-section" id="location-highlights">
        <div class="slider-header">
            <h2>Những điểm đến nổi bật</h2>
            <p>Khám phá những địa danh được yêu thích nhất Việt Nam</p>
        </div>
        <div class="slider-container">
            <div class="slider-track">
                @for($i = 0; $i < 2; $i++)
                    <div class="slide-item">
                        <img src="{{ asset('images/banhcanhcopho.png') }}" alt="Bánh Canh">
                        <div class="slide-overlay">
                            <h3>Bánh Canh Cô Phờ</h3>
                            <p>Hải sản tươi, rất nhiều topping, vị đậm đà.</p>
                        </div>
                    </div>
                    <div class="slide-item">
                        <img src="{{ asset('images/bokelocan.png') }}" alt="Bờ Kè">
                        <div class="slide-overlay">
                            <h3>Bờ Kè Lộc An</h3>
                            <p>Điểm check-in hóng gió biển tuyệt đẹp.</p>
                        </div>
                    </div>
                    <div class="slide-item">
                        <img src="{{ asset('images/chophuochai.png') }}" alt="Chợ">
                        <div class="slide-overlay">
                            <h3>Chợ Phước Hải</h3>
                            <p>Thiên đường hải sản tươi sống giá rẻ.</p>
                        </div>
                    </div>
                    <div class="slide-item">
                        <img src="{{ asset('images/co-bong-homestay-phuoc-hai-1.jpg') }}" alt="Homestay">
                        <div class="slide-overlay">
                            <h3>Cô Bông Homestay</h3>
                            <p>Homestay view biển, có hồ bơi cực chill.</p>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </section>

    <section class="categories-section" id="categories">
        <div class="categories-container">
            <div class="categories-header">
                <h1>Khám phá theo chủ đề</h1>
                <p>Lựa chọn trải nghiệm phù hợp với sở thích của bạn</p>
            </div>

            <div class="category-tabs" id="categoryTabs">
                <button class="category-tab active">Đang tải danh mục...</button>
            </div>

            <div class="category-select-wrapper">
                <select class="category-select" id="categorySelect"></select>
            </div>

            <div id="categoryContentContainer">
                <div class="category-content">
                    <div class="category-intro" id="categoryIntro">
                    </div>
                    <div class="category-grid" id="categoryGrid">
                        <div style="grid-column: 1/-1; text-align: center;">
                            <p>Đang tải dữ liệu...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('js/index.js') }}"></script>
@endsection