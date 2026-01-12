@extends('layouts.layouts')

@section('title', 'Phước Hải - Trang chủ')

@section('content')

    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

     <!-- Hero Section -->
    <section class="hero">
        <video class="hero-video" autoplay muted loop playsinline>
            <source
                src="images/855633-hd_1920_1080_25fps.mp4"
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
                <img src="images/du-lich-phuoc-hai-vung-tau.jpg"
                    alt="Du Lịch Phước Hải" class="intro-img-main">
                <img src="images/phuot-phuoc-hai-vung-tau.jpg"
                    alt="Du Lịch Phước Hải" class="intro-img-secondary">
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
    <section class="slider-section" id="location-highlights">
        <div class="slider-header">
            <h2>Những điểm đến nổi bật</h2>
            <p>Khám phá những địa danh được yêu thích nhất Việt Nam</p>
        </div>
        <div class="slider-container">
            <div class="slider-track">
                <!-- Slide 1 -->
                <div class="slide-item">
                    <img src="images/banhcanhcopho.png"
                        alt="Bánh Canh Cô Phờ">
                    <div class="slide-overlay">
                        <h3>Bánh Canh Cô Phờ</h3>
                        <p>Hải sản tươi, rất nhiều topping cho tô thập cẩm, vị đậm đà vừa ăn, cơ đầy đủ nước uống và nước chấm. Bánh canh chả cá có cục giò 35k</p>
                    </div>
                </div>
                <!-- Slide 2 -->
                <div class="slide-item">
                    <img src="images/bokelocan.png"
                        alt="Bờ Kè Lộc An">
                    <div class="slide-overlay">
                        <h3>Bờ Kè Lộc An</h3>
                        <p>điểm chụp ảnh và hóng gió biển được nhiều người dân và du khách yêu thích.</p>
                    </div>
                </div>
                <!-- Slide 3 -->
                <div class="slide-item">
                    <img src="images/chophuochai.png"
                        alt="Chợ Phước Hải">
                    <div class="slide-overlay">
                        <h3>Chợ Phước Hải</h3>
                        <p>thiên đường ẩm thực ven biển, nơi du khách có thể thưởng thức hải sản tươi sống vừa được ngư dân mang về, từ tôm, cua, ghẹ đến cá, mực… đầy phong vị biển cả </p>
                    </div>
                </div>
                <!-- Slide 4 -->
                <div class="slide-item">
                    <img src="images/co-bong-homestay-phuoc-hai-1.jpg"
                        alt="Cô Bông Homestay">
                    <div class="slide-overlay">
                        <h3>Cô Bông Homestay</h3>
                        <p>Phòng được trang bị đầy đủ tiện nghi cùng với vách kính lớn để mọi người tha hồ check in sống ảo.Nhà có khu bếp lớn đầy đủ dụng cụ cùng với sân bbq siêu chill mọi người thoải mái sử dụng. Đặc biệt là có Hồ Bơi lớn trong nhà cho mọi người thoải mái vui chơi.</p>
                    </div>
                </div>
                <!-- Duplicate for seamless loop -->
                 <!-- Slide 1 -->
                <div class="slide-item">
                    <img src="images/banhcanhcopho.png"
                        alt="Bánh Canh Cô Phờ">
                    <div class="slide-overlay">
                        <h3>Bánh Canh Cô Phờ</h3>
                        <p>Hải sản tươi, rất nhiều topping cho tô thập cẩm, vị đậm đà vừa ăn, cơ đầy đủ nước uống và nước chấm. Bánh canh chả cá có cục giò 35k</p>
                    </div>
                </div>
                <!-- Slide 2 -->
                <div class="slide-item">
                    <img src="images/bokelocan.png"
                        alt="Bờ Kè Lộc An">
                    <div class="slide-overlay">
                        <h3>Bờ Kè Lộc An</h3>
                        <p>điểm chụp ảnh và hóng gió biển được nhiều người dân và du khách yêu thích.</p>
                    </div>
                </div>
                <!-- Slide 3 -->
                <div class="slide-item">
                    <img src="images/chophuochai.png"
                        alt="Chợ Phước Hải">
                    <div class="slide-overlay">
                        <h3>Chợ Phước Hải</h3>
                        <p>thiên đường ẩm thực ven biển, nơi du khách có thể thưởng thức hải sản tươi sống vừa được ngư dân mang về, từ tôm, cua, ghẹ đến cá, mực… đầy phong vị biển cả </p>
                    </div>
                </div>
                <!-- Slide 4 -->
                <div class="slide-item">
                    <img src="images/co-bong-homestay-phuoc-hai-1.jpg"
                        alt="Cô Bông Homestay">
                    <div class="slide-overlay">
                        <h3>Cô Bông Homestay</h3>
                        <p>Phòng được trang bị đầy đủ tiện nghi cùng với vách kính lớn để mọi người tha hồ check in sống ảo.Nhà có khu bếp lớn đầy đủ dụng cụ cùng với sân bbq siêu chill mọi người thoải mái sử dụng. Đặc biệt là có Hồ Bơi lớn trong nhà cho mọi người thoải mái vui chơi.</p>
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
                <button class="category-tab active" data-category="culture">Điểm Check In</button>
                <button class="category-tab" data-category="food">Ẩm thực</button>
                <button class="category-tab" data-category="entertainment">Bãi Tắm</button>
                <button class="category-tab" data-category="shopping">Homestay</button>
                <button class="category-tab" data-category="nature">Team Building</button>
            </div>

            <!-- Mobile Select -->
            <div class="category-select-wrapper">
                <select class="category-select" id="categorySelect">
                    <option value="culture">Điểm Check In</option>
                    <option value="food">Ẩm thực</option>
                    <option value="entertainment">Bãi Tắm</option>
                    <option value="shopping">Homestay</option>
                    <option value="nature">Team Building</option>
                </select>
            </div>

            <!-- Category Contents -->
            <div class="category-content active" data-content="culture">
                <div class="category-intro">
                    <h3>ĐIỂM CHECK IN PHƯỚC HẢI FREE</h3>
                    <p>Khám phá những địa điểm du lịch ở Phước Hải</p>
                </div>
                <div class="category-grid">
                    <div class="category-card">
                        <div class="category-card-img">
                            <img src="images/quangtruongphuochai.png"
                                alt="Quảng Trường Phước Hải">
                        </div>
                        <div class="category-card-content">
                            <h4>Quảng Trường Phước Hải</h4>
                            <p>điểm dạo chơi, chụp ảnh và hóng gió biển được nhiều người dân và du khách yêu thích. Mở cửa cả ngày</p>
                        </div>
                    </div>
                    <div class="category-card">
                        <div class="category-card-img">
                            <img src="images/bokelocan.png"
                                alt="Bờ Kè Lộc An">
                        </div>
                        <div class="category-card-content">
                            <h4>Bờ Kè Lộc An</h4>
                            <p>điểm chụp ảnh và hóng gió biển được nhiều người dân và du khách yêu thích.
                                Mở cửa cả ngày
                            </p>
                        </div>
                    </div>
                    <div class="category-card">
                        <div class="category-card-img">
                            <img src="images/hosobong.png"
                                alt="Hồ Sở Bông">
                        </div>
                        <div class="category-card-content">
                            <h4>Hồ Sở Bông</h4>
                            <p>viên ngọc xanh giữa lòng xã Phước Hải – là điểm đến lý tưởng cho những ai muốn tìm về không gian yên bình, hòa mình với thiên nhiên .</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="category-content" data-content="food">
                <div class="category-intro">
                    <h3>Ẩm thực Phước Hải</h3>
                    <p>Thưởng thức những món ăn đặc sắc nhất của ẩm thực phước Hải</p>
                </div>
                <div class="category-grid">
                    <div class="category-card">
                        <div class="category-card-img">
                            <img src="images/banhcanhcopho.png"
                                 alt="Bánh Canh Cô Phờ">
                               
                        </div>
                        <div class="category-card-content">
                            <h4>Bánh Canh Cô Phờ</h4>
                            <p>Hải sản tươi, rất nhiều topping cho tô thập cẩm, vị đậm đà vừa ăn, cơ đầy đủ nước uống và nước chấm. Bánh canh chả cá có cục giò 35k.</p>
                        </div>
                    </div>
                    <div class="category-card">
                        <div class="category-card-img">
                            <img src="images/chophuochai.png"
                                alt="Chợ Phước Hải">
                        </div>
                        <div class="category-card-content">
                            <h4>Chợ Phước Hải</h4>
                            <p>thiên đường ẩm thực ven biển, nơi du khách có thể thưởng thức hải sản tươi sống vừa được ngư dân mang về, từ tôm, cua, ghẹ đến cá, mực… đầy phong vị biển cả</p>
                        </div>
                    </div>
                    <div class="category-card">
                        <div class="category-card-img">
                            <img src="images/comnieucaluoi.png"
                                alt="Cơm Nêu Cá Lưới">
                        </div>
                        <div class="category-card-content">
                            <h4>Cơm Nêu Cá Lưới</h4>
                            <p>Đây là lựa chọn lý tưởng cho du khách muốn trải nghiệm bữa cơm quê trọn vẹn giữa hương vị biển cả. </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="category-content" data-content="entertainment">
                <div class="category-intro">
                    <h3>Bãi Tắm</h3>
                    <p>Những trải nghiệm giải trí độc đáo và thú vị</p>
                </div>
                <div class="category-grid">
                    <div class="category-card">
                        <div class="category-card-img">
                            <img src="images/baitamcongcong.png"
                                alt="Bãi Tắm Công Cộng">
                        </div>
                        <div class="category-card-content">
                            <h4>Bãi Tắm Công Cộng</h4>
                            <p>Bãi tắm công cộng tại Phước Hải là nơi lý tưởng để thư giãn và tận hưởng không khí trong lành.</p>
                        </div>
                    </div>
                    <div class="category-card">
                        <div class="category-card-img">
                            <img src="images/baitammoong.png"
                                alt="Bãi Tắm Mộ Ông">
                        </div>
                        <div class="category-card-content">
                            <h4>Bãi Tắm Mộ Ông</h4>
                            <p>Một trong những bãi biển đẹp, hoang sơ của Phước Hải – nổi bật với làn nước trong xanh, bãi cát mịn trải dài cùng không gian yên bình, thoáng đãng .</p>
                        </div>
                    </div>
                    <div class="category-card">
                        <div class="category-card-img">
                            <img src="images/baitamlocan.png"
                                alt="Bãi Tắm Lộc An">
                        </div>
                        <div class="category-card-content">
                            <h4>Bãi Tắm Lộc An</h4>
                            <p>Điểm đến tuyệt vời cho những ai yêu thích biển xanh và không gian yên bình. Với bờ cát trắng mịn, làn nước trong xanh cùng cảnh quan thiên nhiên hoang sơ, nơi đây lý tưởng để tắm biển, cắm trại, picnic và check-in những bức hình ấn tượng khi ghé Phước Hải.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="category-content" data-content="shopping">
                <div class="category-intro">
                    <h3>Homestay</h3>
                    <p>Điểm đến nghỉ dưỡng thân thiện</p>
                </div>
                <div class="category-grid">
                    <div class="category-card">
                        <div class="category-card-img">
                            <img src="images/cobonghomestay.png"
                                alt="Cô Bông Homestay">
                        </div>
                        <div class="category-card-content">
                            <h4>Cô Bông Homestay</h4>
                            <p>Phòng được trang bị đầy đủ tiện nghi cùng với vách kính lớn để mọi người tha hồ check in sống ảo.Nhà có khu bếp lớn đầy đủ dụng cụ cùng với sân bbq siêu chill mọi người thoải mái sử dụng. Đặc biệt là có Hồ Bơi lớn trong nhà cho mọi người thoải mái vui chơi.</p>
                        </div>
                    </div>
                    <div class="category-card">
                        <div class="category-card-img">
                            <img src="images/theleaf.png"
                                alt="The Leaf Homestay">
                        </div>
                        <div class="category-card-content">
                            <h4>The Leaf Homestay</h4>
                            <p>The Leaf Cafe & Glamping mang đến trải nghiệm tuyệt vời với không gian cafe ngoài trời, kết hợp cùng dịch vụ cắm trại Glamping ngay bên bờ hồ và dưới tán rừng tự nhiên. Đây là địa điểm cho những ai muốn thư giãn và tận hưởng bầu không khí trong lành tại các khu camping/ glamping ở Đất Đỏ.</p>
                        </div>
                    </div>
                    <div class="category-card">
                        <div class="category-card-img">
                            <img src="images/langbinhyen.png"
                                alt="Làng Bình Yên">
                        </div>
                        <div class="category-card-content">
                            <h4>Làng Bình Yên</h4>
                            <p>Làng như ôm trọn trong lòng cả một khu vườn xanh mát. Cỏ cây trải dài như tấm thảm tự nhiên, từng tán lá rung rinh dưới ánh nắng nhẹ. Những dải cỏ tươi hòa quyện cùng bóng mát của cây cổ thụ, còn các khóm hoa nhỏ xinh tô điểm thêm sức sống rực rỡ. </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="category-content" data-content="nature">
                <div class="category-intro">
                    <h3>Team Building</h3>
                    <p>Khám phá các địa điểm lý tưởng cho các hoạt động team building tại Phước Hải</p>
                </div>
                <div class="category-grid">
                    <div class="category-card">
                        <div class="category-card-img">
                            <img src="images/natureme.png"
                                alt="Nature Me">
                        </div>
                        <div class="category-card-content">
                            <h4>Nature Me</h4>
                            <h5>SĐT Phone:  0962110192</h5>
                            <p>Nature Me . EVENT – đơn vị tổ chức teambuilding và gala chuyên nghiệp tại Phước Hải – mang đến những chương trình sôi động, gắn kết và sáng tạo. Với đội ngũ nhiệt huyết, kịch bản ấn tượng và dịch vụ trọn gói, Nature Me . EVENT là lựa chọn hoàn hảo cho doanh nghiệp, tập thể muốn tạo nên trải nghiệm đáng nhớ bên bờ biển</p>
                        </div>
                    </div>
                    <div class="category-card">
                        <div class="category-card-img">
                            <img src="images/baithadieu.png"
                                alt="Bãi thả diều">
                        </div>
                        <div class="category-card-content">
                            <h4>Bãi thả diều</h4>
                            <p>Bãi thả diều Phước Hải – không gian rộng lớn, thoáng mát ven biển, là điểm hẹn lý tưởng để du khách thả diều, vui chơi và ngắm hoàng hôn tuyệt đẹp. Nơi đây mang đến cảm giác bình yên, thư giãn và những trải nghiệm tuổi thơ khó quên bên bờ biển Phước Hải.</p>
                        </div>
                    </div>
                    <div class="category-card">
                        <div class="category-card-img">
                            <img src="images/Gozoo_farm_dat_do_cor.jpg"
                                alt="GOZOO FARM">
                        </div>
                        <div class="category-card-content">
                            <h4>GOZOO FARM</h4>
                            <h5>SĐT Phone: 0835 072 072 </h5>
                            <p>GozooFarm Phước Hải – điểm đến xanh dành cho gia đình và bạn trẻ yêu thiên nhiên. Tại đây, du khách được trải nghiệm tham quan nông trại, vui chơi cùng các loài thú dễ thương, tận hưởng không gian trong lành và lưu giữ những khoảnh khắc đáng nhớ. Đây là lựa chọn lý tưởng cho những chuyến đi cuối tuần vừa vui vừa bổ ích</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="{{ asset('js/index.js') }}"></script>
@endsection
