<header class="site-header">
    <div class="utility-bar">
        <div class="container d-flex flex-wrap justify-content-between align-items-center gap-2 py-2">
            <span>Đồng hành cùng nhà thầu, đại lý và nhà máy trên toàn quốc</span>
            <div class="d-flex flex-wrap gap-3">
                <a href="tel:0906236863"><i class="fa-solid fa-phone"></i> 0906 23 6863</a>
                <a href="mailto:gicovn186@gmail.com"><i class="fa-regular fa-envelope"></i> gicovn186@gmail.com</a>
            </div>
        </div>
    </div>
    <div class="container header-main">
        <a href="{{ route('xylo.home') }}" class="brand-lockup" aria-label="Gia Hưng - Trang chủ">
            <img src="{{ asset('favicon.png') }}" alt="Logo Công ty Cổ phần Gia Hưng">
            <span><strong>Công ty Cổ phần Gia Hưng</strong><small>Gia Hung Joint Stock Company</small></span>
        </a>
        <form class="header-search" action="{{ route('product.index') }}" method="GET">
            <label class="visually-hidden" for="site-search">Tìm kiếm sản phẩm</label>
            <input id="site-search" name="q" value="{{ request('q') }}" placeholder="Tìm dây đồng, cáp điện, quy cách...">
            <button aria-label="Tìm kiếm"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
        <button class="menu-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavigation" aria-label="Mở trình đơn"><i class="fa-solid fa-bars"></i></button>
    </div>
    <div class="nav-wrap">
        <div class="container collapse d-lg-flex" id="mainNavigation">
            <nav class="main-nav" aria-label="Điều hướng chính">
                <a class="{{ request()->routeIs('xylo.home') ? 'active' : '' }}" href="{{ route('xylo.home') }}">Trang chủ</a>
                <a class="{{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">Giới thiệu</a>
                <a class="{{ request()->routeIs('product.*') ? 'active' : '' }}" href="{{ route('product.index') }}">Sản phẩm</a>
                <a class="{{ request()->routeIs('document.*') ? 'active' : '' }}" href="{{ route('document.index') }}">Tài liệu kỹ thuật</a>
                <a class="{{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Liên hệ</a>
            </nav>
            <button class="btn-inquiry js-open-inquiry" type="button"><i class="fa-regular fa-comments"></i> Yêu cầu báo giá</button>
        </div>
    </div>
</header>
