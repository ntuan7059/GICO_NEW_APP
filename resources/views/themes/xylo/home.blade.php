@extends('themes.xylo.layouts.master')
@section('title', app()->getLocale() === 'en' ? 'Copper Wire & Magnet Wire Supplier in Vietnam | Gia Hung JSC' : 'Dây đồng, dây điện từ & vật liệu cách điện | Gia Hưng JSC')
@section('meta_description', app()->getLocale() === 'en' ? 'Gia Hung supplies copper wire, enamelled magnet wire, bare copper wire and insulation materials with technical documentation and nationwide delivery in Vietnam.' : 'Gia Hưng cung cấp dây đồng, dây điện từ, dây đồng enamel, đồng trần và vật liệu cách điện có hồ sơ kỹ thuật, giao hàng toàn quốc.')
@section('seo_image', asset('gicobanner1.png'))
@section('content')
<section class="home-banner-section">
    <div class="container">
        @php
            $english = app()->getLocale() === 'en';
            $copy = $english ? [
                'carousel' => 'Gia Hung products and solutions', 'previous' => 'Previous banner', 'next' => 'Next banner',
                'eyebrow' => 'Reliable connections · Consistent conductivity', 'hero_title' => 'Copper wire solutions for industry and projects',
                'hero_text' => 'Specification-focused advice, complete technical documents and competitive quotations for factories, contractors and distributors.',
                'products' => 'Explore products', 'quote' => 'Request a quotation', 'experience' => 'Years of experience', 'coverage' => 'Provinces served', 'documents' => 'Transparent documents',
                'category_label' => 'Core categories', 'category_title' => 'Conductors for every application', 'view_all' => 'View all',
                'product_label' => 'Recommended products', 'product_title' => 'Options for your project', 'product_intro' => 'Multiple specifications with custom spool and length support.',
                'selected' => 'Selected by Gia Hung', 'pricing' => 'Quotation by specification and quantity', 'view_detail' => 'View details', 'chat' => 'Sales chat', 'email' => 'Email sales',
                'empty' => 'The product catalogue is being updated. Contact us for assistance.', 'business' => 'For contractors and businesses',
                'project_title' => 'Need a bill of materials and project quotation?', 'project_text' => 'Send your material schedule or drawings. Gia Hung will recommend suitable specifications and respond promptly.', 'consult' => 'Talk to a specialist',
            ] : [
                'carousel' => 'Sản phẩm và giải pháp Gia Hưng', 'previous' => 'Banner trước', 'next' => 'Banner tiếp theo',
                'eyebrow' => 'Kết nối bền vững · Dẫn truyền tin cậy', 'hero_title' => 'Giải pháp dây đồng cho mọi công trình Việt',
                'hero_text' => 'Tư vấn đúng quy cách, đầy đủ hồ sơ kỹ thuật và báo giá cạnh tranh cho nhà thầu, đại lý, nhà máy.',
                'products' => 'Khám phá sản phẩm', 'quote' => 'Nhận báo giá nhanh', 'experience' => 'Năm kinh nghiệm', 'coverage' => 'Tỉnh thành phục vụ', 'documents' => 'Hồ sơ minh bạch',
                'category_label' => 'Danh mục tiêu biểu', 'category_title' => 'Dây dẫn cho từng nhu cầu', 'view_all' => 'Xem toàn bộ',
                'product_label' => 'Sản phẩm đề xuất', 'product_title' => 'Lựa chọn cho dự án của bạn', 'product_intro' => 'Quy cách đa dạng, hỗ trợ cắt theo mét và đóng cuộn theo yêu cầu.',
                'selected' => 'Gia Hưng chọn lọc', 'pricing' => 'Giá theo quy cách & số lượng', 'view_detail' => 'Xem chi tiết', 'chat' => 'Chat mua hàng', 'email' => 'Gửi email mua hàng',
                'empty' => 'Danh mục sản phẩm đang được cập nhật. Vui lòng liên hệ để nhận tư vấn.', 'business' => 'Dành cho nhà thầu & doanh nghiệp',
                'project_title' => 'Cần bóc tách khối lượng và báo giá theo dự án?', 'project_text' => 'Gửi danh mục vật tư hoặc bản vẽ. Đội ngũ Gia Hưng sẽ đề xuất quy cách phù hợp và phản hồi sớm.', 'consult' => 'Trao đổi với chuyên viên',
            ];
            $trustItems = $english ? [
                ['fa-shield-halved', 'Verified quality', 'IEC and TCVN standards'], ['fa-file-circle-check', 'Project documentation', 'Catalogues, CO/CQ, datasheets'],
                ['fa-truck-fast', 'Nationwide delivery', 'Support for project schedules'], ['fa-headset', 'Technical advice', 'Correct gauge and load selection'],
            ] : [
                ['fa-shield-halved', 'Chất lượng kiểm chứng', 'Tiêu chuẩn IEC, TCVN'], ['fa-file-circle-check', 'Đủ hồ sơ dự án', 'Catalogue, CO/CQ, datasheet'],
                ['fa-truck-fast', 'Giao hàng toàn quốc', 'Chủ động tiến độ công trình'], ['fa-headset', 'Tư vấn kỹ thuật', 'Chọn đúng tiết diện, đúng tải'],
            ];
            $featuredCategories = $english ? [
                ['Low voltage & buildings', 'PVC insulated copper wire', 'Reliable conductivity and flexible installation for buildings and equipment.'],
                ['Industrial applications', 'Enamelled magnet wire', 'Heat-resistant winding wire for motors, transformers and coils.'],
                ['Earthing & safety', 'Bare copper wire', 'High conductivity for grounding, lightning protection and industrial systems.'],
            ] : [
                ['Hạ thế & dân dụng', 'Dây đồng bọc PVC', 'Dẫn điện ổn định, thi công linh hoạt cho nhà ở và công trình.'],
                ['Công nghiệp & sản xuất', 'Dây điện từ enamel', 'Khả năng chịu nhiệt cho động cơ, máy biến áp và cuộn dây.'],
                ['An toàn & tiếp địa', 'Dây đồng trần', 'Độ dẫn điện cao cho hệ thống chống sét và nối đất.'],
            ];
            $fallbackBanners = [
                ['image' => asset('gicobanner1.png'), 'title' => 'Dây đồng chất lượng cho sản xuất', 'description' => 'Nguồn vật tư ổn định, tư vấn đúng quy cách.'],
                ['image' => asset('gicobanner2.jpg'), 'title' => 'Vật liệu kim loại công nghiệp', 'description' => 'Giải pháp phù hợp cho nhà máy và công trình.'],
                ['image' => asset('gicobanner3.jpg'), 'title' => 'Đồng công nghiệp đa dạng quy cách', 'description' => 'Hồ sơ minh bạch, giao hàng trên toàn quốc.'],
            ];
            $slides = $banners->map(function ($banner) {
                $translation = $banner->translations->firstWhere('language_code', app()->getLocale())
                    ?? $banner->translations->firstWhere('language_code', 'vi')
                    ?? $banner->translations->firstWhere('language_code', 'en')
                    ?? $banner->translations->first();
                if (! $translation || ! $translation->image_url) {
                    return null;
                }
                $image = $translation->resolved_image_url;
                $link = \Illuminate\Support\Str::startsWith((string) $banner->link_url, ['/', 'http://', 'https://']) ? $banner->link_url : null;

                return ['image' => $image, 'title' => $translation->title, 'description' => strip_tags($translation->description ?? ''), 'link' => $link];
            })->filter()->values();
            if ($slides->isEmpty()) {
                $slides = collect($fallbackBanners);
            }
        @endphp
        <div id="homeBannerCarousel" class="carousel slide home-banner-carousel" data-bs-ride="carousel" data-bs-interval="5500" data-bs-touch="true" aria-label="{{ $copy['carousel'] }}">
            <div class="carousel-indicators">
                @foreach ($slides as $slide)
                    <button type="button" data-bs-target="#homeBannerCarousel" data-bs-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}" @if($loop->first) aria-current="true" @endif aria-label="Banner {{ $loop->iteration }}"></button>
                @endforeach
            </div>
            <div class="carousel-inner">
                @foreach ($slides as $slide)
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                        @if (! empty($slide['link']))<a class="banner-slide-link" href="{{ $slide['link'] }}">@endif
                        <img src="{{ $slide['image'] }}" class="d-block w-100" alt="{{ $slide['title'] }}">
                        <div class="banner-slide-shade"></div>
                        <div class="banner-slide-caption"><span>Gia Hưng JSC</span><h2>{{ $slide['title'] }}</h2>@if($slide['description'])<p>{{ $slide['description'] }}</p>@endif</div>
                        @if (! empty($slide['link']))</a>@endif
                    </div>
                @endforeach
            </div>
            @if ($slides->count() > 1)
            <button class="carousel-control-prev" type="button" data-bs-target="#homeBannerCarousel" data-bs-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="visually-hidden">{{ $copy['previous'] }}</span></button>
            <button class="carousel-control-next" type="button" data-bs-target="#homeBannerCarousel" data-bs-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="visually-hidden">{{ $copy['next'] }}</span></button>
            @endif
        </div>

        <div class="home-hero-panel">
            <div class="hero-copy">
                <span class="eyebrow">{{ $copy['eyebrow'] }}</span>
                <h1>{{ $copy['hero_title'] }}</h1>
                <p>{{ $copy['hero_text'] }}</p>
                <div class="hero-actions"><a href="{{ route('product.index', $english ? ['lang' => 'en'] : []) }}" class="btn-primary-copper">{{ $copy['products'] }} <i class="fa-solid fa-arrow-right"></i></a><button class="btn-ghost js-open-inquiry">{{ $copy['quote'] }}</button></div>
            </div>
            <div class="hero-proof"><span><strong>18+</strong>{{ $copy['experience'] }}</span><span><strong>63</strong>{{ $copy['coverage'] }}</span><span><strong>CO/CQ</strong>{{ $copy['documents'] }}</span></div>
        </div>
    </div>
</section>

<section class="trust-strip"><div class="container trust-items">
    @foreach($trustItems as $item)<div><i class="fa-solid {{ $item[0] }}"></i><span><strong>{{ $item[1] }}</strong>{{ $item[2] }}</span></div>@endforeach
</div></section>

<section class="section-space"><div class="container">
    <div class="section-head"><div><span class="section-label">{{ $copy['category_label'] }}</span><h2>{{ $copy['category_title'] }}</h2></div><a href="{{ route('product.index', $english ? ['lang' => 'en'] : []) }}">{{ $copy['view_all'] }} <i class="fa-solid fa-arrow-right"></i></a></div>
    <div class="category-showcase">
        @foreach($featuredCategories as $category)<a href="{{ route('product.index', $english ? ['lang' => 'en'] : []) }}" class="category-feature"><span>{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span><div><small>{{ $category[0] }}</small><h3>{{ $category[1] }}</h3><p>{{ $category[2] }}</p></div><i class="fa-solid fa-arrow-up-right-from-square"></i></a>@endforeach
    </div>
</div></section>

<section class="section-space products-section"><div class="container">
    <div class="section-head"><div><span class="section-label">{{ $copy['product_label'] }}</span><h2>{{ $copy['product_title'] }}</h2></div><p>{{ $copy['product_intro'] }}</p></div>
    <div class="product-cards">
    @forelse($products->take(6) as $product)
        @php
            $translation = $product->translations->firstWhere('language_code', app()->getLocale()) ?? $product->translations->firstWhere('language_code', 'vi') ?? $product->translations->firstWhere('language_code', 'en') ?? $product->translations->first();
            $image = optional($product->thumbnail)->image_url;
            $imageUrl = $image ? (\Illuminate\Support\Str::startsWith($image, ['http://','https://']) ? $image : Storage::url($image)) : asset('favicon.png');
        @endphp
        <article class="product-card-new">
            <a class="product-card-image" href="{{ route('product.show', [$product->slug] + ($english ? ['lang' => 'en'] : [])) }}"><img loading="lazy" src="{{ $imageUrl }}" onerror="this.onerror=null;this.src='{{ asset('favicon.png') }}'" alt="{{ $translation->name ?? 'Copper wire' }}"><span>{{ $copy['selected'] }}</span></a>
            <div class="product-card-body"><small>{{ optional(optional($product->category)->translation)->name ?? ($english ? 'Copper wire' : 'Dây & cáp điện') }}</small><h3><a href="{{ route('product.show', [$product->slug] + ($english ? ['lang' => 'en'] : [])) }}">{{ $translation->name ?? ($english ? 'Quality copper wire' : 'Dây cáp điện chất lượng cao') }}</a></h3><p>{!! \Illuminate\Support\Str::limit(strip_tags($translation->short_description ?? $translation->description ?? ''), 100) !!}</p><div class="product-card-meta"><span>{{ $copy['pricing'] }}</span><a href="{{ route('product.show', [$product->slug] + ($english ? ['lang' => 'en'] : [])) }}" aria-label="{{ $copy['view_detail'] }}"><i class="fa-solid fa-arrow-right"></i></a></div><div class="product-card-actions"><button type="button" class="js-open-inquiry" data-product-id="{{ $product->id }}" data-product-name="{{ $translation->name ?? $product->slug }}"><i class="fa-regular fa-comments"></i> {{ $copy['chat'] }}</button><a href="mailto:gicovn186@gmail.com?subject={{ rawurlencode(($english ? 'Quotation request: ' : 'Yêu cầu báo giá: ').($translation->name ?? $product->slug)) }}" aria-label="{{ $copy['email'] }}"><i class="fa-regular fa-envelope"></i></a></div></div>
        </article>
    @empty
        <div class="empty-state">{{ $copy['empty'] }}</div>
    @endforelse
    </div>
</div></section>

<section class="project-cta"><div class="container"><div><span class="section-label light">{{ $copy['business'] }}</span><h2>{{ $copy['project_title'] }}</h2></div><div><p>{{ $copy['project_text'] }}</p><button class="btn-primary-copper js-open-inquiry">{{ $copy['consult'] }} <i class="fa-regular fa-comments"></i></button></div></div></section>
@endsection
