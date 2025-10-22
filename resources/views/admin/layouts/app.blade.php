<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>@yield('title', 'Admin Dashboard') | Strategic Pillars</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/animate.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/animation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/nouislider.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/nice-select.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/magnific-popup.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/mmenu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/icon/flaticon_just-home.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/icon/icomoon/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('/images/favicon.png') }}">
    <style>
        .dz-button{
            font-size: 2rem !important;
        }
    </style>
    @stack('styles')
</head>
<body class="body dashboard">
    <div id="wrapper">
        <div id="page" class="layout-wrap background-F9F9F9">
            <!-- header -->
            <header id="header_main" class="header style-fixed">
                <div class="header-inner background-white">
                    <div class="header-inner-wrap">
                        <div id="site-logo">
                            <a href="{{ route('home') }}" rel="home">
                                <img class="d-block" id="logo-header" src="{{ asset('/images/logo/logo.svg') }}" alt="">
                            </a>
                        </div>
                        <nav class="main-menu">
                            <ul class="navigation">
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li><a href="{{ route('admin.properties.index') }}">Properties</a></li>
                                <li><a href="{{ route('admin.estates.index') }}">Estates</a></li>
                                {{-- <li><a href="{{ route('admin.bookings.index') }}">Bookings</a></li> --}}
                                <li><a href="{{ route('admin.team.index') }}">Team</a></li>
                                <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                            </ul>
                        </nav>
                        <div class="header-right gap30">
                            <div class="header-btn">
                                <a href="{{route('profile.edit')}}" class="tf-button-default"><i class="flaticon-user"></i> {{ auth()->user()->name ?? 'Admin' }}</a>
                            </div>
                        </div>
                        <a class="mobile-nav-toggler mobile-button" href="#menu"></a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                    </div>
                </div>
                <nav id="menu">
                    {{-- <a class="close" aria-label="Close menu" href="#mm-22">
                        <i class="icon-close"></i>
                    </a> --}}
                    <ul>
                        <li class="@if(request()->routeIs('admin.dashboard')) active @endif">
                            <a href="{{ route('admin.dashboard') }}"><i class="flaticon-house"></i> Dashboard</a>
                        </li>
                        <li class="@if(request()->routeIs('admin.team-members.*')) active @endif">
                            <a href="{{ route('admin.team.index') }}"><i class="flaticon-user"></i> Team</a>
                        </li>
                        {{-- <li class="@if(request()->routeIs('admin.bookings.*')) active @endif">
                            <a href="{{ route('admin.bookings.index') }}"><i class="flaticon-chat-bubble"></i>Bookings</a>
                        </li> --}}
                        <li class="@if(request()->routeIs('admin.properties.*')) active @endif">
                            <a href="{{ route('admin.properties.index') }}"><i class="flaticon-home-2"></i> Properties</a>
                        </li>
                        <li class="@if(request()->routeIs('admin.estates.*')) active @endif">
                            <a href="{{ route('admin.estates.index') }}"><i class="flaticon-layers-1"></i> Estates</a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="flaticon-logout"></i> Logout</a>
                        </li>
                    </ul>
                </nav>
            </header>
            <!-- /header -->
            <div class="main-content spacing-20">
                <div class="layout-wrap-inner">
                    <!-- section-menu-left -->
                    <div class="section-menu-left">
                        <div class="menu-content">
                            <ul>
                                <li class="@if(request()->routeIs('home')) active @endif">
                                    <a href="{{ route('home') }}"><i class="flaticon-home"></i>Home</a>
                                </li>
                                <li class="@if(request()->routeIs('admin.dashboard')) active @endif">
                                    <a href="{{ route('admin.dashboard') }}"><i class="flaticon-house"></i>Dashboard</a>
                                </li>
                                <li class="@if(request()->routeIs('admin.team-members.*')) active @endif">
                                    <a href="{{ route('admin.team.index') }}"><i class="flaticon-user"></i>Team</a>
                                </li>
                                {{-- <li class="@if(request()->routeIs('admin.bookings.*')) active @endif">
                                    <a href="{{ route('admin.bookings.index') }}"><i class="flaticon-chat-bubble"></i>Bookings</a>
                                </li> --}}
                                <li class="@if(request()->routeIs('admin.properties.*')) active @endif">
                                    <a href="{{ route('admin.properties.index') }}"><i class="flaticon-home-2"></i>Properties</a>
                                </li>
                                <li class="@if(request()->routeIs('admin.estates.*')) active @endif">
                                    <a href="{{ route('admin.estates.index') }}"><i class="flaticon-layers-1"></i>Estates</a>
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="flaticon-logout"></i>Logout</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /section-menu-left -->
                    <!-- section-content-right -->
                    <div class="section-content-right">
                        @yield('content')
                    </div>
                    <!-- /section-content-right -->
                </div>
            </div>
            <!-- /main-content -->
        </div>
    </div>
    <script src="{{ asset('/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('/js/swiper.js') }}"></script>
    <script src="{{ asset('/js/countto.js') }}"></script>
    <script src="{{ asset('/js/circletype.min.js') }}"></script>
    {{-- <script src="{{ asset('/js/maps.js') }}"></script> --}}
    <script src="{{ asset('/js/marker.js') }}"></script>
    {{-- <script src="{{ asset('/js/infobox.min.js') }}"></script> --}}
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