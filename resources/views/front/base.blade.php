<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- SEO Meta Tags -->
    <title>@yield('title', 'Horde Sports - En Güncel Spor Haberleri')</title>
    <meta name="description" content="@yield('description', 'Horde Sports - Spor dünyasının nabzını tutan, en güncel haberler ve analizler sunan modern bir web uygulaması')">
    <meta name="keywords" content="@yield('keywords', 'spor, haber, futbol, basketbol, maç, skor, analiz, Horde Sports')">
    
    <!-- Open Graph Meta Tags - Sosyal medya paylaşımları için -->
    <meta property="og:title" content="@yield('title', 'Horde Sports - En Güncel Spor Haberleri')">
    <meta property="og:description" content="@yield('description', 'Horde Sports - Spor dünyasının nabzını tutan, en güncel haberler ve analizler sunan modern bir web uygulaması')">
    <meta property="og:image" content="@yield('og-image', asset('front/assets/images/og-image.jpg'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="@yield('og-type', 'website')">
    <meta property="og:site_name" content="Horde Sports">
    <meta property="og:locale" content="tr_TR">
    
    <!-- Twitter Card Meta Tags - Twitter paylaşımları için -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'Horde Sports - En Güncel Spor Haberleri')">
    <meta name="twitter:description" content="@yield('description', 'Horde Sports - Spor dünyasının nabzını tutan, en güncel haberler ve analizler sunan modern bir web uygulaması')">
    <meta name="twitter:image" content="@yield('og-image', asset('front/assets/images/og-image.jpg'))">
    
    <!-- Canonical URL - Duplicate content önleme -->
    <link rel="canonical" href="{{ url()->current() }}">
    
    <!-- CSS Dosyaları -->
    <link rel="stylesheet" href="{{ asset('front/assets/css/main.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <!-- Fancybox CSS - Lightbox galeri için -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css">
</head>
<body class="@auth logged-in @endauth">
    

@include('front.partials.header')

@yield('content')

@include('front.partials.admin-bar')

@include('front.partials.footer')
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<!-- Fancybox JS - Lightbox galeri için -->
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script src="{{ asset('front/assets/js/main.js') }}"></script>
</body>
</html>