@extends('layouts.layouts')

@section('title', 'Phước Hải - Trang chủ')
@section('body_class', 'page-single')

@section('content')

    <link rel="stylesheet" href="{{ asset('css/archive.css') }}">
    <link rel="stylesheet" href="{{ asset(path: 'css/index.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <div class="page-content">
        <div class="page-container">

        <!-- Breadcrumb -->
        <div class="breadcrumb">
            <a href="#">Home</a> /
            <strong>Tìm Kiếm</strong>
        </div>

        <div class="layout">

            <!-- SIDEBAR -->
            <aside class="sidebar">

                <h3 class="sidebar-title">Danh mục bài viết</h3>

                <ul class="category-list">
                    <li>
                        <label>
                            <input type="checkbox" class="filter-checkbox" value="thong-cao">
                            Địa Điểm Check In
                        </label>
                    </li>
                    <li>
                        <label>
                            <input type="checkbox" class="filter-checkbox" value="su-kien">
                            Địa Điểm Khách Sạn và Homestay
                        </label>
                    </li>
                    <li>
                        <label>
                            <input type="checkbox" class="filter-checkbox" value="du-lich">
                            Ẩm Thực
                        </label>
                    </li>
                    <li>
                        <label>
                            <input type="checkbox" class="filter-checkbox" value="van-hoa">
                            Team Building
                        </label>
                    </li>
                </ul>

            </aside>


            <!-- CONTENT -->
            <main class="content">

                <div class="post-grid">

                    <article class="post-card" data-category="thong-cao">
                        <a href="#">
                            <div class="thumb">
                                <img src="https://picsum.photos/400/300?1">
                            </div>
                            <h2>Thông cáo báo chí số 4: Lễ trao giải Marathon Quốc tế TP.HCM</h2>
                            <div class="meta">12/01/2026 · Thông cáo báo chí</div>
                        </a>
                    </article>

                    
                    <article class="post-card" data-category="thong-cao">
                        <a href="#">
                            <div class="thumb">
                                <img src="https://picsum.photos/400/300?1">
                            </div>
                            <h2>Thông cáo báo chí số 4: Lễ trao giải Marathon Quốc tế TP.HCM</h2>
                            <div class="meta">12/01/2026 · Thông cáo báo chí</div>
                        </a>
                    </article>

                    <article class="post-card" data-category="su-kien">
                        <a href="#">
                            <div class="thumb">
                                <img src="https://picsum.photos/400/300?2">
                            </div>
                            <h2>Khai mạc Giải Marathon Quốc tế TP.HCM Techcombank</h2>
                            <div class="meta">08/01/2026 · Sự kiện</div>
                        </a>
                    </article>

                    <article class="post-card" data-category="du-lich">
                        <a href="#">
                            <div class="thumb">
                                <img src="https://picsum.photos/400/300?3">
                            </div>
                            <h2>Chuỗi hoạt động văn hóa – du lịch đầu năm</h2>
                            <div class="meta">02/01/2026 · Du lịch</div>
                        </a>
                    </article>
                    <article class="post-card" data-category="thong-cao">
                        <a href="#">
                            <div class="thumb">
                                <img src="https://picsum.photos/400/300?1">
                            </div>
                            <h2>Thông cáo báo chí số 4: Lễ trao giải Marathon Quốc tế TP.HCM</h2>
                            <div class="meta">12/01/2026 · Thông cáo báo chí</div>
                        </a>
                    </article>

                    
                    <article class="post-card" data-category="thong-cao">
                        <a href="#">
                            <div class="thumb">
                                <img src="https://picsum.photos/400/300?1">
                            </div>
                            <h2>Thông cáo báo chí số 4: Lễ trao giải Marathon Quốc tế TP.HCM</h2>
                            <div class="meta">12/01/2026 · Thông cáo báo chí</div>
                        </a>
                    </article>

                    <article class="post-card" data-category="su-kien">
                        <a href="#">
                            <div class="thumb">
                                <img src="https://picsum.photos/400/300?2">
                            </div>
                            <h2>Khai mạc Giải Marathon Quốc tế TP.HCM Techcombank</h2>
                            <div class="meta">08/01/2026 · Sự kiện</div>
                        </a>
                    </article>

                    <article class="post-card" data-category="du-lich">
                        <a href="#">
                            <div class="thumb">
                                <img src="https://picsum.photos/400/300?3">
                            </div>
                            <h2>Chuỗi hoạt động văn hóa – du lịch đầu năm</h2>
                            <div class="meta">02/01/2026 · Du lịch</div>
                        </a>
                    </article>


                </div>

            </main>

        </div>

    </div>
    </div>

    <script src="{{ asset('js/index.js') }}"></script>
    <script src="{{ asset('js/archive.js') }}"></script>
@endsection