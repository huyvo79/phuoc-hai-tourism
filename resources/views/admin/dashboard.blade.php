<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard')</title>

    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
    <link rel="shortcut icon" href="/favicon.ico" />

    {{-- Bootstrap, fonts, icons --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    {{-- Custom CSS (Nếu chưa có file này thì giao diện có thể bị vỡ nhẹ, nhưng không ảnh hưởng logic) --}}
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 sidebar p-0">
                <div class="sidebar-brand text-center py-4">
                    <a href="{{ route('admin.dashboard') }}" class="text-decoration-none">
                        <h4 class="text-white font-weight-bold mb-0" style="letter-spacing: 1px;">PHƯỚC HẢI</h4>
                        <small class="text-muted" style="font-size: 0.75rem; text-transform: uppercase;">Travel
                            Management</small>
                    </a>
                </div>
                <hr style="border-color: #4b545c; margin-top: 0;">

                <ul class="list-unstyled">
                    <li class="category-title">
                        <a href="{{ route('admin.dashboard') }}"
                            class="{{ request()->routeIs('admin.dashboard') ? 'text-white' : '' }}">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                    </li>
                    <hr style="border-color: #4b545c;">

                    <li class="category-title">
                        <a href="#">
                            <i class="fas fa-layer-group"></i> Quản lý Danh mục
                        </a>
                    </li>

                    <li class="category-title">
                        <a href="#">
                            <i class="fas fa-map-marked-alt"></i> Địa điểm / Bài viết
                        </a>
                    </li>

                    <li class="category-title">
                        <a href="#">
                            <i class="fas fa-images"></i> Thư viện ảnh
                        </a>
                    </li>

                    <hr style="border-color: #4b545c; margin: 10px 15px;">

                    <li class="category-title">
                        <a href="#">
                            <i class="fas fa-users-cog"></i> Tài khoản Admin
                        </a>
                    </li>

                    <li class="category-title">
                        <form action="{{ route('admin.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="logout-btn">
                                <i class="fa fa-sign-out-alt"></i> Đăng xuất
                            </button>
                        </form>
                    </li>
                </ul>

                @php
                    $user = Auth::user();
                    $avatarUrl = "https://ui-avatars.com/api/?name=" . urlencode($user->name ?? 'Admin') . "&background=random";
                @endphp
                <div class="sidebar-avatar">
                    <div class="user-avatar">
                        <img src="{{ $avatarUrl }}" alt="User Avatar">
                    </div>
                    <div class="user-info">
                        <span class="user-name">{{ $user->name ?? 'Admin User' }}</span>
                        <span class="user-role">@Username: {{ $user->username ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>

            <div class="col-md-10 content-section bg-white">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Tổng quan</h1>
                </div>

                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Xin chào, {{ $user->name }}!</h5>
                        <p class="card-text">Bạn đã đăng nhập thành công vào hệ thống quản trị.</p>
                        <p>Thông tin tài khoản hiện tại:</p>
                        <ul>
                            <li><strong>ID:</strong> {{ $user->id }}</li>
                            <li><strong>Username:</strong> {{ $user->username }}</li>
                            <li><strong>Ngày tạo:</strong> {{ $user->created_at }}</li>
                        </ul>
                    </div>
                </div>

                @yield('content')
            </div>
        </div>
    </div>

    {{-- JS --}}
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    @stack('scripts')
</body>

</html>