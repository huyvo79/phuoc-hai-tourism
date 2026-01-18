<!-- Header -->
<link rel="stylesheet" href="{{ asset('css/header.css') }}">
<header class="header" id="header">
    <div class="menu-toggle" id="menuToggle">
        <span></span>
        <span></span>
        <span></span>
    </div>

    <div class="logo-group">
        <img src="{{ asset('images/doan.png') }}" alt="Logo phụ 1" class="extra-logo1">
        <img src="{{ asset('images/tnvn.png') }}" alt="Logo phụ 2" class="extra-logo2">
        <a href="/" class="logo">Phước Hải</a>
    </div>

    <nav class="nav-container">
        <ul class="nav-menu">
            <li><a href="/#explore">Về phước hải</a></li>
            <li><a href="/#location-highlights">Điểm đến nổi bật</a></li>
            <li><a href="/#categories">khám phá</a></li>
            <li><a href="/#contact">Liên hệ</a></li>
            <li><a href="{{ asset('archive') }}">Danh Mục</a></li>
        </ul>
    </nav>

    <div class="search-box">
        <input type="text" id="desktopSearchInput" placeholder="Tìm kiếm điểm đến...">
        <button type="submit" class="search-btn">
            <svg viewBox="0 0 24 24" width="22" height="22">
                <circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="2" fill="none" />
                <line x1="16.5" y1="16.5" x2="22" y2="22" stroke="currentColor" stroke-width="2" />
            </svg>
        </button>
        <div class="search-results" id="desktopSearchResults"></div>
    </div>

    <button class="mobile-search-trigger" id="mobileSearchBtn">
        <svg viewBox="0 0 24 24" width="26" height="26" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="11" cy="11" r="7" />
            <line x1="16.5" y1="16.5" x2="22" y2="22" />
        </svg>
    </button>
</header>
<div class="mobile-search" id="mobileSearch">
    <div class="mobile-search-inner">
        <input type="text" id="mobileSearchInput" placeholder="Tìm kiếm điểm đến...">
        <button>
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
        </button>
        <div class="search-results" id="mobileSearchResults"></div>
    </div>
</div>
<!-- Mobile Menu -->
<div class="mobile-overlay" id="mobileOverlay"></div>
<div class="mobile-menu" id="mobileMenu">
    <ul>
        <li><a href="/#explore">Về phước hải</a></li>
        <li><a href="/#location-highlights">Điểm đến nổi bật</a></li>
        <li><a href="/#categories">khám phá</a></li>
        <li><a href="/#contact">Liên hệ</a></li>
        <li><a href="{{ asset('archive') }}">Danh Mục</a></li>
    </ul>
</div>
<script src="{{ asset('js/header.js') }}"></script>