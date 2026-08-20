@php($english = app()->getLocale() === 'en')
<header class="site-header">
    <div class="utility-bar">
        <div class="container d-flex flex-wrap justify-content-between align-items-center gap-2 py-2">
            <span>{{ $english ? 'Copper wire supply for factories, distributors and projects across Vietnam' : 'Đồng hành cùng nhà thầu, đại lý và nhà máy trên toàn quốc' }}</span>
            <div class="d-flex flex-wrap gap-3">
                <span class="language-links" aria-label="Language">
                    <a href="{{ url()->current() }}" hreflang="vi" lang="vi" class="{{ app()->getLocale() === 'vi' ? 'active' : '' }}">VI</a>
                    <span aria-hidden="true">/</span>
                    <a href="{{ url()->current() }}?lang=en" hreflang="en" lang="en" class="{{ app()->getLocale() === 'en' ? 'active' : '' }}">EN</a>
                </span>
                <a href="tel:0906236863"><i class="fa-solid fa-phone"></i> 0906 23 6863</a>
                <a href="mailto:gicovn186@gmail.com"><i class="fa-regular fa-envelope"></i> gicovn186@gmail.com</a>
            </div>
        </div>
    </div>
    <div class="container header-main">
        <a href="{{ route('xylo.home', $english ? ['lang' => 'en'] : []) }}" class="brand-lockup" aria-label="{{ $english ? 'Gia Hung - Home' : 'Gia Hưng - Trang chủ' }}">
            <img src="{{ asset('favicon.png') }}" alt="Logo Công ty Cổ phần Gia Hưng">
            <span><strong>Công ty Cổ phần Gia Hưng</strong><small>Gia Hung Joint Stock Company</small></span>
        </a>
        <form class="header-search" action="{{ route('product.index') }}" method="GET">
            @if($english)<input type="hidden" name="lang" value="en">@endif
            <label class="visually-hidden" for="site-search">{{ $english ? 'Search products' : 'Tìm kiếm sản phẩm' }}</label>
            <input id="site-search" name="q" value="{{ request('q') }}" placeholder="{{ $english ? 'Search copper wire, gauge or specification...' : 'Tìm dây đồng, cáp điện, quy cách...' }}">
            <button aria-label="{{ $english ? 'Search' : 'Tìm kiếm' }}"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
        <button class="menu-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavigation" aria-label="Mở trình đơn"><i class="fa-solid fa-bars"></i></button>
    </div>
    <div class="nav-wrap">
        <div class="container collapse d-lg-flex" id="mainNavigation">
            <nav class="main-nav" aria-label="{{ $english ? 'Main navigation' : 'Điều hướng chính' }}">
                <a class="{{ request()->routeIs('xylo.home') ? 'active' : '' }}" href="{{ route('xylo.home', $english ? ['lang' => 'en'] : []) }}">{{ $english ? 'Home' : 'Trang chủ' }}</a>
                <a class="{{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about', $english ? ['lang' => 'en'] : []) }}">{{ $english ? 'About' : 'Giới thiệu' }}</a>
                <a class="{{ request()->routeIs('product.*') ? 'active' : '' }}" href="{{ route('product.index', $english ? ['lang' => 'en'] : []) }}">{{ $english ? 'Products' : 'Sản phẩm' }}</a>
                <a class="{{ request()->routeIs('document.*') ? 'active' : '' }}" href="{{ route('document.index', $english ? ['lang' => 'en'] : []) }}">{{ $english ? 'Documents' : 'Tài liệu kỹ thuật' }}</a>
                <a class="{{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact', $english ? ['lang' => 'en'] : []) }}">{{ $english ? 'Contact' : 'Liên hệ' }}</a>
            </nav>
            <button class="btn-inquiry js-open-inquiry" type="button"><i class="fa-regular fa-comments"></i> {{ $english ? 'Request a quote' : 'Yêu cầu báo giá' }}</button>
        </div>
    </div>
</header>
