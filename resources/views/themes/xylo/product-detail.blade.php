@extends('themes.xylo.layouts.master')
@php
    $translation = $product->translations->firstWhere('language_code', app()->getLocale()) ?? $product->translations->firstWhere('language_code','vi') ?? $product->translations->firstWhere('language_code','en') ?? $product->translations->first();
    $productName = $translation->name ?? $product->slug;
    $mainImage = optional($product->images->firstWhere('type','thumb') ?? $product->images->first())->image_url;
    $mainImageUrl = $mainImage ? (\Illuminate\Support\Str::startsWith($mainImage, ['http://','https://']) ? $mainImage : Storage::url($mainImage)) : asset('favicon.png');
    $groupedAttributes = $product->attributeValues->groupBy('attribute_id');
    $seoDescription = \Illuminate\Support\Str::limit(strip_tags($translation->short_description ?? $translation->description ?? ''), 155);
    $productSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'Product',
        '@id' => route('product.show', $product->slug).'#product',
        'name' => $productName,
        'url' => route('product.show', $product->slug).(app()->getLocale() === 'en' ? '?lang=en' : ''),
        'image' => [$mainImageUrl],
        'description' => $seoDescription,
        'sku' => optional($product->primaryVariant)->SKU,
        'category' => optional(optional($product->category)->translation)->name,
        'offers' => [
            '@type' => 'Offer',
            'url' => route('product.show', $product->slug),
            'priceCurrency' => $product->currency ?: 'USD',
            'price' => optional($product->primaryVariant)->price,
            'availability' => $inStock ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock',
            'itemCondition' => 'https://schema.org/NewCondition',
            'seller' => ['@id' => route('xylo.home').'#organization'],
        ],
    ];
    if ($product->reviews_count > 0 && $product->reviews_avg_rating) {
        $productSchema['aggregateRating'] = [
            '@type' => 'AggregateRating',
            'ratingValue' => round($product->reviews_avg_rating, 1),
            'reviewCount' => $product->reviews_count,
        ];
    }
@endphp
@section('title', $productName . ' | ' . (app()->getLocale() === 'en' ? 'Gia Hung JSC' : 'Gia Hưng JSC'))
@section('meta_description', $seoDescription)
@section('seo_image', $mainImageUrl)
@section('seo_type', 'product')
@push('structured_data')
<script type="application/ld+json">@json($productSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)</script>
@endpush
@section('content')
<div class="breadcrumb-bar"><div class="container"><a href="{{ route('xylo.home') }}">Trang chủ</a><i class="fa-solid fa-chevron-right"></i><a href="{{ route('product.index') }}">Sản phẩm</a><i class="fa-solid fa-chevron-right"></i><span>{{ $productName }}</span></div></div>
<section class="detail-section"><div class="container detail-layout">
    <div class="detail-gallery">
        <div class="detail-main-image"><img id="detailMainImage" src="{{ $mainImageUrl }}" onerror="this.onerror=null;this.src='{{ asset('favicon.png') }}'" alt="{{ $productName }}"><span><i class="fa-solid fa-magnifying-glass-plus"></i> Hình ảnh sản phẩm</span></div>
        @if($product->images->count() > 1)<div class="detail-thumbs">@foreach($product->images as $image) @php $url = \Illuminate\Support\Str::startsWith($image->image_url, ['http://','https://']) ? $image->image_url : Storage::url($image->image_url); @endphp <button onclick="document.getElementById('detailMainImage').src='{{ $url }}'"><img src="{{ $url }}" alt="Ảnh {{ $loop->iteration }}"></button>@endforeach</div>@endif
    </div>
    <div class="detail-summary">
        <span class="product-code">Mã sản phẩm: {{ optional($product->primaryVariant)->SKU ?? strtoupper(substr($product->slug,0,12)) }}</span>
        <h1>{{ $productName }}</h1>
        <p class="detail-lead">{!! $translation->short_description ?? 'Dây cáp chất lượng cao, phù hợp cho công trình dân dụng và công nghiệp.' !!}</p>
        <div class="quote-notice"><div><small>Giá bán</small><strong>Liên hệ để nhận báo giá</strong></div><span>Giá được tối ưu theo tiết diện, chiều dài và khối lượng đặt hàng.</span></div>
        @if($groupedAttributes->isNotEmpty())<div class="spec-options">
            @foreach($groupedAttributes as $values)<div><strong>{{ optional($values->first()->attribute)->name }}</strong><div>@foreach($values as $value)<span>{{ $value->translations->firstWhere('language_code','vi')->translated_value ?? $value->value }}</span>@endforeach</div></div>@endforeach
        </div>@endif
        <div class="detail-actions"><button class="btn-primary-copper js-open-inquiry" data-product-id="{{ $product->id }}" data-product-name="{{ $productName }}"><i class="fa-regular fa-comments"></i> Chat nhận báo giá</button><a class="btn-outline-copper" href="mailto:gicovn186@gmail.com?subject={{ rawurlencode('Yêu cầu báo giá: '.$productName) }}&body={{ rawurlencode('Xin chào bộ phận bán hàng, tôi muốn nhận báo giá cho '.$productName.'.') }}"><i class="fa-regular fa-envelope"></i> Gửi email</a></div>
        <div class="detail-contact"><span><i class="fa-solid fa-phone"></i><small>Tư vấn trực tiếp</small><a href="tel:0906236863">0906 23 6863</a></span><span><i class="fa-solid fa-truck-fast"></i><small>Phạm vi giao hàng</small><strong>Toàn quốc</strong></span></div>
    </div>
</div></section>
<section class="detail-information"><div class="container detail-info-grid">
    <article><span class="section-label">Thông tin kỹ thuật</span><h2>Đặc tính & ứng dụng</h2><div class="rich-content">{!! $translation->description ?? '<p>Liên hệ Gia Hưng để nhận datasheet và thông số chi tiết theo quy cách.</p>' !!}</div></article>
    <aside><h3>Hồ sơ cung cấp</h3><ul><li><i class="fa-solid fa-check"></i> Catalogue và datasheet</li><li><i class="fa-solid fa-check"></i> Chứng nhận CO/CQ theo lô</li><li><i class="fa-solid fa-check"></i> Hướng dẫn lựa chọn tiết diện</li><li><i class="fa-solid fa-check"></i> Báo giá và tiến độ giao hàng</li></ul><button class="js-open-inquiry" data-product-id="{{ $product->id }}" data-product-name="{{ $productName }}">Yêu cầu tài liệu <i class="fa-solid fa-arrow-right"></i></button></aside>
</div></section>
<section class="detail-bottom-cta"><div class="container"><div><small>Cần quy cách khác?</small><h2>Gia Hưng hỗ trợ lựa chọn theo bản vẽ & tải thực tế.</h2></div><button class="btn-primary-copper js-open-inquiry" data-product-id="{{ $product->id }}" data-product-name="{{ $productName }}">Trao đổi ngay</button></div></section>
@endsection
