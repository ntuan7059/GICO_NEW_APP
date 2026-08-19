@extends('themes.xylo.layouts.master')
@section('title', 'Gia Hưng JSC | Dây đồng và cáp điện cho công trình Việt')
@section('content')
<section class="home-hero">
    <img class="hero-media" src="{{ asset('banner.gif') }}" alt="Dây và cáp điện Gia Hưng">
    <div class="hero-overlay"></div>
    <div class="container hero-content">
        <div class="hero-copy">
            <span class="eyebrow">Kết nối bền vững · Dẫn truyền tin cậy</span>
            <h1>Giải pháp dây đồng<br>cho mọi công trình Việt</h1>
            <p>Tư vấn đúng quy cách, đầy đủ hồ sơ kỹ thuật và báo giá cạnh tranh cho nhà thầu, đại lý, nhà máy.</p>
            <div class="hero-actions"><a href="{{ route('product.index') }}" class="btn-primary-copper">Khám phá sản phẩm <i class="fa-solid fa-arrow-right"></i></a><button class="btn-ghost js-open-inquiry">Nhận báo giá nhanh</button></div>
        </div>
        <div class="hero-proof"><span><strong>15+</strong>Năm kinh nghiệm</span><span><strong>63</strong>Tỉnh thành phục vụ</span><span><strong>CO/CQ</strong>Hồ sơ minh bạch</span></div>
    </div>
</section>

<section class="trust-strip"><div class="container trust-items">
    <div><i class="fa-solid fa-shield-halved"></i><span><strong>Chất lượng kiểm chứng</strong>Tiêu chuẩn IEC, TCVN</span></div>
    <div><i class="fa-solid fa-file-circle-check"></i><span><strong>Đủ hồ sơ dự án</strong>Catalogue, CO/CQ, datasheet</span></div>
    <div><i class="fa-solid fa-truck-fast"></i><span><strong>Giao hàng toàn quốc</strong>Chủ động tiến độ công trình</span></div>
    <div><i class="fa-solid fa-headset"></i><span><strong>Tư vấn kỹ thuật</strong>Chọn đúng tiết diện, đúng tải</span></div>
</div></section>

<section class="section-space"><div class="container">
    <div class="section-head"><div><span class="section-label">Danh mục tiêu biểu</span><h2>Dây dẫn cho từng nhu cầu</h2></div><a href="{{ route('product.index') }}">Xem toàn bộ <i class="fa-solid fa-arrow-right"></i></a></div>
    <div class="category-showcase">
        <a href="{{ route('product.index') }}" class="category-feature"><span>01</span><div><small>Hạ thế & dân dụng</small><h3>Dây đồng bọc PVC</h3><p>Dẫn điện ổn định, thi công linh hoạt cho nhà ở và công trình.</p></div><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
        <a href="{{ route('product.index') }}" class="category-feature"><span>02</span><div><small>Công nghiệp & dự án</small><h3>Cáp điện lực XLPE</h3><p>Khả năng chịu nhiệt cao, phù hợp tủ điện và hệ thống phân phối.</p></div><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
        <a href="{{ route('product.index') }}" class="category-feature"><span>03</span><div><small>An toàn & tiếp địa</small><h3>Đồng trần, cáp tiếp địa</h3><p>Độ dẫn điện cao cho hệ thống chống sét và nối đất.</p></div><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
    </div>
</div></section>

<section class="section-space products-section"><div class="container">
    <div class="section-head"><div><span class="section-label">Sản phẩm đề xuất</span><h2>Lựa chọn cho dự án của bạn</h2></div><p>Quy cách đa dạng, hỗ trợ cắt theo mét và đóng cuộn theo yêu cầu.</p></div>
    <div class="product-cards">
    @forelse($products->take(6) as $product)
        @php
            $translation = $product->translations->firstWhere('language_code', 'vi') ?? $product->translations->firstWhere('language_code', 'en') ?? $product->translations->first();
            $image = optional($product->thumbnail)->image_url;
            $imageUrl = $image ? (\Illuminate\Support\Str::startsWith($image, ['http://','https://']) ? $image : Storage::url($image)) : asset('favicon.png');
        @endphp
        <article class="product-card-new">
            <a class="product-card-image" href="{{ route('product.show', $product->slug) }}"><img loading="lazy" src="{{ $imageUrl }}" onerror="this.onerror=null;this.src='{{ asset('favicon.png') }}'" alt="{{ $translation->name ?? 'Dây cáp điện' }}"><span>Gia Hưng chọn lọc</span></a>
            <div class="product-card-body"><small>{{ optional(optional($product->category)->translation)->name ?? 'Dây & cáp điện' }}</small><h3><a href="{{ route('product.show', $product->slug) }}">{{ $translation->name ?? 'Dây cáp điện chất lượng cao' }}</a></h3><p>{!! \Illuminate\Support\Str::limit(strip_tags($translation->short_description ?? $translation->description ?? ''), 100) !!}</p><div class="product-card-meta"><span>Giá theo quy cách & số lượng</span><a href="{{ route('product.show', $product->slug) }}" aria-label="Xem chi tiết"><i class="fa-solid fa-arrow-right"></i></a></div><div class="product-card-actions"><button type="button" class="js-open-inquiry" data-product-id="{{ $product->id }}" data-product-name="{{ $translation->name ?? $product->slug }}"><i class="fa-regular fa-comments"></i> Chat mua hàng</button><a href="mailto:tuannm180220@gmail.com?subject={{ rawurlencode('Yêu cầu báo giá: '.($translation->name ?? $product->slug)) }}" aria-label="Gửi email mua hàng"><i class="fa-regular fa-envelope"></i></a></div></div>
        </article>
    @empty
        <div class="empty-state">Danh mục sản phẩm đang được cập nhật. Vui lòng liên hệ để nhận tư vấn.</div>
    @endforelse
    </div>
</div></section>

<section class="project-cta"><div class="container"><div><span class="section-label light">Dành cho nhà thầu & doanh nghiệp</span><h2>Cần bóc tách khối lượng<br>và báo giá theo dự án?</h2></div><div><p>Gửi danh mục vật tư hoặc bản vẽ. Đội ngũ Gia Hưng sẽ đề xuất quy cách phù hợp và phản hồi sớm.</p><button class="btn-primary-copper js-open-inquiry">Trao đổi với chuyên viên <i class="fa-regular fa-comments"></i></button></div></div></section>
@endsection
