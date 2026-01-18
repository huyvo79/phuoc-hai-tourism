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
                <aside class="sidebar">`

                    <h3 class="sidebar-title">Danh mục bài viết</h3>

                    <ul class="category-list" id="categoryList">
                        {{-- <li>
                            <label>
                                <input type="checkbox" class="filter-checkbox" value="thong-cao">
                                Địa Điểm Check In
                            </label>
                        </li> --}}
                    </ul>

                </aside>


                <!-- CONTENT -->
                <main class="content">

                    <div class="post-grid"  id="postGrid">

                        {{-- <article class="post-card" data-category="thong-cao">
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
                        </article> --}}


                    </div>

                </main>

            </div>

        </div>
    </div>

    {{-- <section class="categories-section" id="categories">
        <div class="categories-container">

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
    </section> --}}

    {{-- <script src="{{ asset('js/index.js') }}"></script> --}}
    <script src="{{ asset('js/archive.js') }}"></script>
@endsection
