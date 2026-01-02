@extends('layouts.layouts')

@section('title', 'Phước Hải - Trang chủ')
@section('body_class', 'page-single')

@section('content')

    <link rel="stylesheet" href="{{ asset('css/single.css') }}">
     <link rel="stylesheet" href="{{ asset(path: 'css/index.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <div class="page-content">
    <div class="container">

        <!-- ===== BÀI VIẾT CHÍNH ===== -->
        <div class="content">
            <h1>Khám Phá Vẻ Đẹp Thiên Nhiên Việt Nam</h1>

            <p>
                Việt Nam sở hữu những cảnh quan thiên nhiên tuyệt đẹp, từ núi non hùng vĩ,
                bãi biển trải dài đến những cánh rừng nguyên sinh đầy bí ẩn.
            </p>

            <img src="https://images.unsplash.com/photo-1501785888041-af3ef285b470" alt="Thiên nhiên">

            <p>
                Du lịch không chỉ mang lại trải nghiệm thư giãn mà còn giúp chúng ta
                hiểu thêm về văn hóa, con người và lịch sử từng vùng miền.
            </p>

            <p>
                Hãy dành thời gian để khám phá những điểm đến mới, lưu giữ những khoảnh khắc
                đáng nhớ và tận hưởng vẻ đẹp của cuộc sống.
            </p>
        </div>

        <!-- ===== BÀI VIẾT LIÊN QUAN ===== -->
        <aside class="sidebar">
            <h2>Bài viết liên quan</h2>

            <div class="related-item" onclick="openArticle('Bài viết 1')">
                <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e" alt="">
                <h4>Những bãi biển đẹp nhất Việt Nam</h4>
            </div>

            <div class="related-item" onclick="openArticle('Bài viết 2')">
                <img src="https://images.unsplash.com/photo-1500530855697-b586d89ba3ee" alt="">
                <h4>Top điểm du lịch miền núi</h4>
            </div>

            <div class="related-item" onclick="openArticle('Bài viết 3')">
                <img src="https://images.unsplash.com/photo-1521295121783-8a321d551ad2" alt="">
                <h4>Hành trình khám phá rừng nguyên sinh</h4>
            </div>
        </aside>
    </div>
    </div>
    
    <script src="{{ asset('js/index.js') }}"></script>
@endsection