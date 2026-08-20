@extends('themes.xylo.layouts.master')
@section('title', app()->getLocale() === 'en' ? 'Copper Wire Products & Specifications | Gia Hung JSC' : 'Sản phẩm dây đồng & dây điện từ | Gia Hưng JSC')
@section('meta_description', app()->getLocale() === 'en' ? 'Browse copper wire spools, PVC and silicone insulated wire, bare copper, THHN and enamelled magnet wire supplied by Gia Hung in Vietnam.' : 'Danh mục cuộn dây đồng, dây đồng bọc PVC, silicone, đồng trần, THHN và dây điện từ enamel do Gia Hưng cung cấp.')
@section('content')
@php
    $english = app()->getLocale() === 'en';
@endphp
<section class="page-hero"><div class="container"><span class="eyebrow">{{ $english ? 'Product catalogue' : 'Danh mục sản phẩm' }}</span><h1>{!! $english ? 'Copper wire &amp; magnet wire<br>for industrial applications' : 'Dây đồng &amp; dây điện từ<br>cho mọi quy mô dự án' !!}</h1><p>{{ $english ? 'From bare copper and PVC wire to enamelled winding wire—selected by gauge, temperature and application.' : 'Từ đồng trần, dây bọc PVC đến dây điện từ enamel—được tư vấn theo tiết diện, nhiệt độ và ứng dụng thực tế.' }}</p></div></section>
<section class="catalog-section"><div class="container catalog-layout">
    <aside class="catalog-sidebar"><div><span class="section-label">{{ $english ? 'Catalogue filter' : 'Bộ lọc danh mục' }}</span><h2>{{ $english ? 'Select an application' : 'Chọn nhu cầu' }}</h2></div><a class="{{ request('category') ? '' : 'active' }}" href="{{ route('product.index', $english ? ['lang' => 'en'] : []) }}">{{ $english ? 'All products' : 'Tất cả sản phẩm' }}</a>
        @foreach($categories as $category)
            @php $catTranslation = $category->translations->firstWhere('language_code', app()->getLocale()) ?? $category->translations->firstWhere('language_code','vi') ?? $category->translations->firstWhere('language_code','en') ?? $category->translations->first(); @endphp
            <a class="{{ request('category') === $category->slug ? 'active' : '' }}" href="{{ route('product.index', array_filter(['category' => $category->slug, 'lang' => $english ? 'en' : null])) }}">{{ $catTranslation->name ?? $category->slug }} <span>{{ $category->products_count }}</span></a>
        @endforeach
        <div class="sidebar-help"><i class="fa-regular fa-comments"></i><h3>{{ $english ? 'Unsure about specifications?' : 'Chưa rõ quy cách?' }}</h3><p>{{ $english ? 'Tell us the gauge, length, temperature and intended application.' : 'Cho chúng tôi biết tiết diện, chiều dài, nhiệt độ và ứng dụng.' }}</p><button class="js-open-inquiry">{{ $english ? 'Get advice' : 'Nhờ tư vấn' }}</button></div>
    </aside>
    <div class="catalog-content">
        <form class="catalog-search" action="{{ route('product.index') }}" method="GET">
            @if(request('category'))<input type="hidden" name="category" value="{{ request('category') }}">@endif
            @if($english)<input type="hidden" name="lang" value="en">@endif
            <label class="visually-hidden" for="catalog-query">{{ $english ? 'Search catalogue' : 'Tìm trong danh mục' }}</label>
            <i class="fa-solid fa-magnifying-glass"></i><input id="catalog-query" name="q" value="{{ request('q') }}" placeholder="{{ $english ? 'Search by name, CU-SPOOL code or AWG size' : 'Tìm theo tên, mã CU-SPOOL hoặc cỡ AWG' }}"><button>{{ $english ? 'Search products' : 'Tìm sản phẩm' }}</button>
        </form>
        <div class="catalog-toolbar"><div><strong>{{ $products->total() }}</strong> {{ $english ? 'matching products' : 'sản phẩm phù hợp' }}</div><span>{{ $english ? 'Quotations are confirmed by specification and quantity' : 'Báo giá được xác nhận theo quy cách và số lượng' }}</span></div>
        <div class="product-cards catalog-cards">
        @forelse($products as $product)
            @php
                $translation = $product->translations->firstWhere('language_code', app()->getLocale()) ?? $product->translations->firstWhere('language_code','vi') ?? $product->translations->firstWhere('language_code','en') ?? $product->translations->first();
                $image = optional($product->images->firstWhere('type','thumb') ?? $product->images->first())->image_url;
                $imageUrl = $image ? (\Illuminate\Support\Str::startsWith($image, ['http://','https://']) ? $image : Storage::url($image)) : asset('favicon.png');
            @endphp
            @php $productUrl = route('product.show', [$product->slug] + ($english ? ['lang' => 'en'] : [])); @endphp
            <article class="product-card-new"><a class="product-card-image" href="{{ $productUrl }}"><img loading="lazy" src="{{ $imageUrl }}" onerror="this.onerror=null;this.src='{{ asset('favicon.png') }}'" alt="{{ $translation->name ?? ($english ? 'Copper wire' : 'Dây cáp điện') }}"><span>{{ optional($product->primaryVariant)->stock > 0 ? ($english ? 'In stock' : 'Sẵn hàng') : ($english ? 'Check availability' : 'Liên hệ tồn kho') }}</span></a><div class="product-card-body"><small>{{ optional(optional($product->category)->translations->firstWhere('language_code', app()->getLocale()))->name ?? optional($product->category)->slug ?? ($english ? 'Copper wire' : 'Dây & cáp điện') }}</small><h3><a href="{{ $productUrl }}">{{ $translation->name ?? $product->slug }}</a></h3><p>{{ \Illuminate\Support\Str::limit(strip_tags($translation->short_description ?? $translation->description ?? ''), 96) }}</p><div class="product-card-meta"><span>{{ optional($product->primaryVariant)->SKU ?? ($english ? 'Request a quotation' : 'Báo giá theo yêu cầu') }}</span><a href="{{ $productUrl }}" aria-label="{{ $english ? 'View details' : 'Xem chi tiết' }}"><i class="fa-solid fa-arrow-right"></i></a></div><div class="product-card-actions"><button type="button" class="js-open-inquiry" data-product-id="{{ $product->id }}" data-product-name="{{ $translation->name ?? $product->slug }}"><i class="fa-regular fa-comments"></i> {{ $english ? 'Sales enquiry' : 'Chat mua hàng' }}</button><a href="mailto:gicovn186@gmail.com?subject={{ rawurlencode(($english ? 'Quotation request: ' : 'Yêu cầu báo giá: ').($translation->name ?? $product->slug)) }}"><i class="fa-regular fa-envelope"></i><span class="visually-hidden">{{ $english ? 'Email sales' : 'Gửi email mua hàng' }}</span></a></div></div></article>
        @empty <div class="empty-state">{{ $english ? 'No products match this selection.' : 'Chưa có sản phẩm trong danh mục này.' }}</div> @endforelse
        </div>
        <div class="pagination-wrap">{{ $products->links() }}</div>
    </div>
</div></section>
@endsection
