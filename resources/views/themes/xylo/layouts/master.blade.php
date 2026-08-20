@php
    $seoLocale = app()->getLocale() === 'en' ? 'en' : 'vi';
    $siteSettings = \App\Models\SiteSetting::query()->first();
    $defaultTitles = [
        'vi' => $siteSettings->meta_title ?? 'Dây đồng, dây điện từ & vật liệu cách điện | Gia Hưng JSC',
        'en' => 'Copper Wire, Magnet Wire & Insulation Materials | Gia Hung JSC',
    ];
    $defaultDescriptions = [
        'vi' => $siteSettings->meta_description ?? 'Gia Hưng cung cấp dây đồng, dây điện từ, dây đồng enamel và vật liệu cách điện cho nhà máy, đại lý và dự án trên toàn quốc.',
        'en' => 'Gia Hung supplies copper wire, enamelled magnet wire and electrical insulation materials for factories, distributors and industrial projects in Vietnam.',
    ];
    $decodeSeo = fn (string $value) => html_entity_decode(trim($value), ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $seoTitle = $decodeSeo($__env->yieldContent('title', $defaultTitles[$seoLocale]));
    $seoDescription = $decodeSeo($__env->yieldContent('meta_description', $defaultDescriptions[$seoLocale]));
    $seoImage = $decodeSeo($__env->yieldContent('seo_image', asset('gicobanner1.png')));
    $seoType = $decodeSeo($__env->yieldContent('seo_type', 'website'));
    $filteredRequest = request()->hasAny(['q', 'category', 'brand', 'min_price', 'max_price', 'sort']);
    $privateRoute = request()->routeIs('search*', 'shop.*', 'cart.*', 'checkout.*', 'customer.*', 'wishlist.*');
    $seoRobots = $decodeSeo($__env->yieldContent('seo_robots', ($filteredRequest || $privateRoute) ? 'noindex,follow' : 'index,follow'));
    $canonicalQuery = [];
    if ($seoLocale === 'en') $canonicalQuery['lang'] = 'en';
    if (request()->integer('page') > 1 && ! $filteredRequest) $canonicalQuery['page'] = request()->integer('page');
    $canonicalBase = url()->current();
    $seoCanonical = $canonicalBase.($canonicalQuery ? '?'.http_build_query($canonicalQuery) : '');
    $localeUrl = function (string $locale) use ($canonicalBase) {
        $query = [];
        if ($locale === 'en') $query['lang'] = 'en';
        if (request()->integer('page') > 1) $query['page'] = request()->integer('page');
        return $canonicalBase.($query ? '?'.http_build_query($query) : '');
    };
    $organizationId = route('xylo.home').'#organization';
    $organizationSchema = [
                '@type' => 'Organization',
                '@id' => $organizationId,
                'name' => 'Công ty Cổ phần Gia Hưng',
                'alternateName' => 'Gia Hung Joint Stock Company',
                'url' => route('xylo.home'),
                'logo' => asset('favicon.png'),
                'email' => 'mailto:gicovn186@gmail.com',
                'telephone' => '+84-906-236-863',
                'foundingDate' => '2006-05-17',
                'taxID' => '0101948457',
                'address' => [
                    '@type' => 'PostalAddress',
                    'streetAddress' => '186 Nguyễn Tuân',
                    'addressLocality' => 'Thanh Xuân',
                    'addressRegion' => 'Hà Nội',
                    'addressCountry' => 'VN',
                ],
                'contactPoint' => [[
                    '@type' => 'ContactPoint',
                    'telephone' => '+84-906-236-863',
                    'contactType' => 'sales',
                    'availableLanguage' => ['Vietnamese', 'English'],
                    'areaServed' => 'VN',
                ]],
            ];
    $websiteSchema = [
                '@type' => 'WebSite',
                '@id' => route('xylo.home').'#website',
                'url' => route('xylo.home'),
                'name' => 'Gia Hưng JSC',
                'publisher' => ['@id' => $organizationId],
                'inLanguage' => ['vi-VN', 'en'],
                'potentialAction' => [
                    '@type' => 'SearchAction',
                    'target' => route('product.index').'?q={search_term_string}',
                    'query-input' => 'required name=search_term_string',
                ],
            ];
    $globalGraph = request()->routeIs('xylo.home')
        ? [$organizationSchema, $websiteSchema]
        : (request()->routeIs('about') ? [$organizationSchema] : []);
    $globalSchema = $globalGraph ? ['@context' => 'https://schema.org', '@graph' => $globalGraph] : null;
@endphp
<!doctype html>
<html lang="{{ $seoLocale }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $seoTitle }}</title>
    <meta name="description" content="{{ $seoDescription }}">
    <meta name="robots" content="{{ $seoRobots }},max-image-preview:large,max-snippet:-1,max-video-preview:-1">
    @if (config('services.google.site_verification'))
        <meta name="google-site-verification" content="{{ config('services.google.site_verification') }}">
    @endif
    <link rel="canonical" href="{{ $seoCanonical }}">
    <link rel="alternate" hreflang="vi" href="{{ $localeUrl('vi') }}">
    <link rel="alternate" hreflang="en" href="{{ $localeUrl('en') }}">
    <link rel="alternate" hreflang="x-default" href="{{ $localeUrl('vi') }}">

    <meta property="og:type" content="{{ $seoType }}">
    <meta property="og:site_name" content="Gia Hưng JSC">
    <meta property="og:title" content="{{ $seoTitle }}">
    <meta property="og:description" content="{{ $seoDescription }}">
    <meta property="og:url" content="{{ $seoCanonical }}">
    <meta property="og:image" content="{{ $seoImage }}">
    <meta property="og:image:alt" content="{{ $seoTitle }}">
    <meta property="og:locale" content="{{ $seoLocale === 'en' ? 'en_US' : 'vi_VN' }}">
    <meta property="og:locale:alternate" content="{{ $seoLocale === 'en' ? 'vi_VN' : 'en_US' }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $seoTitle }}">
    <meta name="twitter:description" content="{{ $seoDescription }}">
    <meta name="twitter:image" content="{{ $seoImage }}">

    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700&family=Lora:wght@500;600;700&display=swap&subset=vietnamese" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    @if($globalSchema)<script type="application/ld+json">@json($globalSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)</script>@endif
    @stack('structured_data')
    @if (!App::environment('testing'))
        @vite(['resources/views/themes/xylo/css/custom.css', 'resources/views/themes/xylo/css/refinements.css'])
    @endif
    @yield('css')
</head>
<body class="storefront-theme">
    @include('themes.xylo.layouts.header')
    <main>@yield('content')</main>
    @include('themes.xylo.layouts.footer')
    @include('themes.xylo.partials.inquiry-widget')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('js')
</body>
</html>
