<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>@yield('title', 'Realtor') | Strategic Pillars</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/icon/flaticon_just-home.css') }}">
    <link rel="shortcut icon" href="{{ asset('/images/favicon.png') }}">
    <style>
        .dz-button { font-size: 2rem !important; }
        .realtor-nav a { margin-right: 1rem; }
    </style>
    @stack('styles')
</head>
<body class="body dashboard">
    <div id="wrapper">
        <div id="page" class="layout-wrap background-F9F9F9">
            <header class="header style-fixed">
                <div class="header-inner background-white">
                    <div class="header-inner-wrap px-20 py-15 flex justify-between align-items-center flex-wrap gap15">
                        <div id="site-logo">
                            <a href="{{ route('home') }}"><img src="{{ asset('/images/logo/logo.svg') }}" alt="Strategic Pillars" style="max-height: 40px;"></a>
                        </div>
                        <nav class="realtor-nav flex align-items-center flex-wrap gap10">
                            <a href="{{ route('realtor.dashboard') }}">Dashboard</a>
                            <a href="{{ route('realtor.properties.index') }}">My listings</a>
                            <a href="{{ route('profile.edit') }}">Account</a>
                            <a href="{{ route('home') }}">Website</a>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        </nav>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                    </div>
                </div>
            </header>
            <div class="main-content spacing-20 px-20 pb-40">
                @yield('content')
            </div>
        </div>
    </div>
    <script src="{{ asset('/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/js/main.js') }}"></script>
    @stack('scripts')
</body>
</html>
