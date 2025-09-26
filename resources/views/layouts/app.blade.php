<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Strategic Pillars - No. 1 Realty in Lagos')</title>
    <meta name="description" content="@yield('description', 'Strategic Pillars - Luxury Real Estate, Interiors, and Shortlets in Lagos')">
    <meta name="author" content="OSHIO'S HOLDING">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="@yield('og_title', 'Strategic Pillars - No. 1 Realty in Lagos')">
    <meta property="og:description" content="@yield('og_description', 'Strategic Pillars - Luxury Real Estate, Interiors, and Shortlets in Lagos')">
    <meta property="og:image" content="@yield('og_image', asset('images/logo/logo.svg'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('twitter_title', 'Strategic Pillars - No. 1 Realty in Lagos')">
    <meta name="twitter:description" content="@yield('twitter_description', 'Strategic Pillars - Luxury Real Estate, Interiors, and Shortlets in Lagos')">
    <meta name="twitter:image" content="@yield('twitter_image', asset('images/logo/logo.svg'))">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('images/favicon.png') }}">

    <!-- Theme Style -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/animate.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/animation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/nouislider.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/nice-select.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/magnific-popup.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/mmenu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">

    <!-- Font -->
    <link rel="stylesheet" href="{{ asset('font/fonts.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <!-- Icon -->
    <link rel="stylesheet" type="text/css" href="{{ asset('icon/flaticon_just-home.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('icon/icomoon/style.css') }}">

    <!-- Tailwind CSS -->
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

    @stack('styles')
</head>
<body class="body counter-scroll">
    <div class="preload preload-container">
        <div class="middle"></div>
    </div>
    <div id="wrapper">
        <div id="page" class="{{ Route::is('home') ? 'home-1' : (Route::is('interiors') ? 'home-1' : '') }}">
            @include('partials.header')
            <div class="main-content {{ Route::is('home') ? 'default px-60' : '' }}">
                @yield('content')
            </div>
            @include('partials.footer')
        </div>
    </div>
    <!-- go top button -->
    <div class="progress-wrap active-progress">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewbox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 286.138;"></path>
        </svg>
    </div>
    <!-- /go top button -->
    <script src="{{ asset('/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('/js/swiper.js') }}"></script>
    <script src="{{ asset('/js/countto.js') }}"></script>
    <script src="{{ asset('/js/circletype.min.js') }}"></script>
    <script src="{{ asset('/js/maps.js') }}"></script>
    <script src="{{ asset('/js/marker.js') }}"></script>
    <script src="{{ asset('/js/infobox.min.js') }}"></script>
    <script src="{{ asset('/js/magnific-popup.min.js') }}"></script>
    <script src="{{ asset('/js/apexcharts.js') }}"></script>
    <script src="{{ asset('/js/area-chart.js') }}"></script>
    <script src="{{ asset('/js/morris.min.js') }}"></script>
    <script src="{{ asset('/js/raphael.min.js') }}"></script>
    <script src="{{ asset('/js/morris.js') }}"></script>
    <script src="{{ asset('/js/nouislider.min.js') }}"></script>
    <script src="{{ asset('/js/rangle-slider.js') }}"></script>
    <script src="{{ asset('/js/mmenu.js') }}"></script>
    <script src="{{ asset('/js/wow.min.js') }}"></script>
    <script src="{{ asset('/js/scrollmagic.js') }}"></script>
    <script src="{{ asset('/js/main.js') }}"></script>
        <script>new Mmenu(document.querySelector("#menu"));</script>

    @stack('scripts')
</body>
</html>
