<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Du Lịch Phước Hải')</title>
    <meta name="description"
        content="@yield('description', 'Chào Mừng Đến Với Phước Hải - Viên Ngọc Thô Của Bà Rịa - Vũng Tàu. Khám Phá Những Điểm Đến Nổi Bật, Văn Hóa Đặc Sắc Và Trải Nghiệm Du Lịch Độc Đáo Tại Làng Chài Truyền Thống Này.')">

    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">

</head>

<body class="@yield('body_class')">
    <div id="page-loader">
        <div class="spinning-logo">

        </div>
        <div class="loader"></div>
    </div>
    {{-- Header --}}
    @include('partials.header')

    {{-- Nội dung từng trang --}}
    @yield('content')

    {{-- Footer --}}
    @include('partials.footer')

    {{-- Scripts --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mark.js/8.11.1/mark.min.js"></script>
    <script src="{{ asset('js/index.js') }}"></script>

    @yield('scripts')
</body>

</html>