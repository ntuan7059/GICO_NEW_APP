@extends('themes.xylo.layouts.master')
@section('title', 'Sản phẩm dây đồng & cáp điện | Gia Hưng JSC')
@section('content')
<section class="page-hero"><div class="container"><span class="eyebrow">Danh mục sản phẩm</span><h1>Dây đồng & cáp điện<br>cho mọi quy mô dự án</h1><p>Từ dây dân dụng đến cáp điện lực công nghiệp—được tư vấn theo tải, môi trường lắp đặt và ngân sách thực tế.</p></div></section>
<section class="catalog-section"><div class="container catalog-layout">
    <aside class="catalog-sidebar"><div><span class="section-label">Bộ lọc danh mục</span><h2>Chọn nhu cầu</h2></div><a class="{{ request('category') ? '' : 'active' }}" href="{{ route('product.index') }}">Tất cả sản phẩm</a>
        @foreach($categories as $category)
            @php $catTranslation = $category->translations->firstWhere('language_code','vi') ?? $category->translations->firstWhere('language_code','en') ?? $category->translations->first(); @endphp
            <a class="{{ request('category') === $category->slug ? 'active' : '' }}" href="{{ route('product.index', ['category' => $category->slug]) }}">{{ $catTranslation->name ?? $category->slug }} <span>{{ $category->products_count }}</span></a>
        @endforeach
        <div class="sidebar-help"><i class="fa-regular fa-comments"></i><h3>Chưa rõ quy cách?</h3><p>Cho chúng tôi biết tải điện, chiều dài và môi trường lắp đặt.</p><button class="js-open-inquiry">Nhờ tư vấn</button></div>
    </aside>
    <div class="catalog-content">
        <form class="catalog-search" action="{{ route('product.index') }}" method="GET">
            @if(request('category'))<input type="hidden" name="category" value="{{ request('category') }}">@endif
            <label class="visually-hidden" for="catalog-query">Tìm trong danh mục</label>
            <i class="fa-solid fa-magnifying-glass"></i><input id="catalog-query" name="q" value="{{ request('q') }}" placeholder="Tìm theo tên, mã CU-SPOOL hoặc cỡ AWG"><button>Tìm sản phẩm</button>
        </form>
        <div class="catalog-toolbar"><div><strong>{{ $products->total() }}</strong> sản phẩm phù hợp</div><span>Báo giá được xác nhận theo quy cách và số lượng</span></div>
        <div class="product-cards catalog-cards">
        @forelse($products as $product)
            @php
                $translation = $product->translations->firstWhere('language_code','vi') ?? $product->translations->firstWhere('language_code','en') ?? $product->translations->first();
                $image = optional($product->images->firstWhere('type','thumb') ?? $product->images->first())->image_url;
                $imageUrl = $image ? (\Illuminate\Support\Str::startsWith($image, ['http://','https://']) ? $image : Storage::url($image)) : asset('favicon.png');
            @endphp
            <article class="product-card-new"><a class="product-card-image" href="{{ route('product.show', $product->slug) }}"><img loading="lazy" src="{{ $imageUrl }}" onerror="this.onerror=null;this.src='{{ asset('favicon.png') }}'" alt="{{ $translation->name ?? 'Dây cáp điện' }}"><span>{{ optional($product->primaryVariant)->stock > 0 ? 'Sẵn hàng' : 'Liên hệ tồn kho' }}</span></a><div class="product-card-body"><small>{{ optional(optional($product->category)->translations->firstWhere('language_code','vi'))->name ?? optional($product->category)->slug ?? 'Dây & cáp điện' }}</small><h3><a href="{{ route('product.show', $product->slug) }}">{{ $translation->name ?? $product->slug }}</a></h3><p>{{ \Illuminate\Support\Str::limit(strip_tags($translation->short_description ?? $translation->description ?? ''), 96) }}</p><div class="product-card-meta"><span>{{ optional($product->primaryVariant)->SKU ?? 'Báo giá theo yêu cầu' }}</span><a href="{{ route('product.show', $product->slug) }}" aria-label="Xem chi tiết"><i class="fa-solid fa-arrow-right"></i></a></div><div class="product-card-actions"><button type="button" class="js-open-inquiry" data-product-id="{{ $product->id }}" data-product-name="{{ $translation->name ?? $product->slug }}"><i class="fa-regular fa-comments"></i> Chat mua hàng</button><a href="mailto:gicovn186@gmail.com?subject={{ rawurlencode('Yêu cầu báo giá: '.($translation->name ?? $product->slug)) }}"><i class="fa-regular fa-envelope"></i><span class="visually-hidden">Gửi email mua hàng</span></a></div></div></article>
        @empty <div class="empty-state">Chưa có sản phẩm trong danh mục này.</div> @endforelse
        </div>
        <div class="pagination-wrap">{{ $products->links() }}</div>
    </div>
</div></section>
@endsection
