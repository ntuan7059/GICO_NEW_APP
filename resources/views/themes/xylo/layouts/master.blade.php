<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Gia Hưng JSC | Dây và cáp điện')</title>
    <meta name="description" content="@yield('meta_description', 'Gia Hưng cung cấp dây đồng, cáp điện và vật tư công nghiệp đạt tiêu chuẩn cho dự án trên toàn quốc.')">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700&family=Lora:wght@500;600;700&display=swap&subset=vietnamese" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
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
