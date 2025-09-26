<!-- header -->
<header id="header_main" class="header header-fixed type-home8 style-no-bg style-container">
    <div class="header-inner"> 
        <div class="header-inner-wrap">
            <div id="site-logo">
                <a href="{{ route('home') }}" rel="home">
                    <img class="d-block" id="logo-header" src="{{ asset('images/logo/logo.svg') }}" alt="Strategic Pillars">
                </a>
            </div>
            <nav class="main-menu">
                <ul class="navigation">
                    <li class="{{ request()->is('/') ? 'current' : '' }}">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="has-children {{ request()->is('company*') ? 'current' : '' }}">
                        <a href="javascript:void(0);">Company</a>
                        <ul>
                            <li><a href="{{ route('company.about') }}">About Us</a></li>
                            <li><a href="{{ route('company.contact') }}">Contact</a></li>
                        </ul>
                    </li>
                    <li class="has-children {{ request()->is('properties*') || request()->is('estates*') ? 'current' : '' }}">
                        <a href="javascript:void(0);">Properties</a>
                        <ul class="mega-menu">
                            <li>
                                <ul>
                                    <li class="title">List view</li>
                                    <li><a href="{{ route('properties.index') }}">Property List</a></li>
                                    <li><a href="{{ route('estates.index') }}">Estates</a></li>
                                </ul>
                            </li>
                            <li>
                                <ul>
                                    <li class="title">Property Types</li>
                                    <li><a href="{{ route('properties.index', ['type' => 'apartment']) }}">Apartments</a></li>
                                    <li><a href="{{ route('properties.index', ['type' => 'office']) }}">Office</a></li>
                                    <li><a href="{{ route('properties.index', ['type' => 'duplex']) }}">Duplex</a></li>
                                    <li><a href="{{ route('properties.index', ['type' => 'bungalow']) }}">Bungalow</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="{{ request()->is('agents*') ? 'current' : '' }}">
                        <a href="{{ route('agents.index') }}">Realtor</a>
                    </li>
                    
                    <li class="{{ request()->is('shortlets*') ? 'current' : '' }}">
                        <a href="{{ route('shortlets.index') }}">Shortlets</a>
                    </li>
                    <li class="{{ request()->is('interiors*') ? 'current' : '' }}">
                        <a href="{{ route('interiors.index') }}">Interiors</a>
                    </li>
                </ul>
            </nav>
            <div class="header-right">
                {{-- <div class="header-call">
                    <div class="icon">
                        <i class="flaticon-phone"></i>
                    </div>
                    <div class="number">+234-800-555-6789</div>
                </div> --}}
                <div onclick="return location.href='{{route('login')}}'" class="header-user">
                    <div class="icon">
                        <i class="flaticon-user"></i>
                    </div>
                </div>
                <div class="header-btn">
                    <a href="{{ route('company.contact') }}" class="tf-button-default type-1">Request Quote</a>
                </div>
            </div>
            <a class="mobile-nav-toggler mobile-button" href="#menu"></a>
        </div>
    </div>
    <nav id="menu">
        <a class="close" aria-label="Close menu" href="#mm-22">
            <i class="icon-close"></i>
        </a>
        <ul>
            <li class="{{ request()->is('/') ? 'current' : '' }}">
                <a href="{{ route('home') }}">Home</a>
            </li>
            <li class="{{ request()->is('properties*') || request()->is('estates*') ? 'current' : '' }}">
                <span>Properties</span>
                <ul>
                    <li>
                        <span>List view</span>
                        <ul>
                            <li><a href="{{ route('properties.index') }}">Property List</a></li>
                            <li><a href="{{ route('estates.index') }}">Estates</a></li>
                        </ul>
                    </li>
                    <li>
                        <span>Property Types</span>
                        <ul>
                            <li><a href="{{ route('properties.index', ['type' => 'apartment']) }}">Apartments</a></li>
                            <li><a href="{{ route('properties.index', ['type' => 'office']) }}">Office</a></li>
                            <li><a href="{{ route('properties.index', ['type' => 'duplex']) }}">Duplex</a></li>
                            <li><a href="{{ route('properties.index', ['type' => 'bungalow']) }}">Bungalow</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="{{ request()->is('agents*') ? 'current' : '' }}">
               <a href="{{ route('agents.index') }}">Realtors</a>
            </li>
            <li class="{{ request()->is('company*') ? 'current' : '' }}">
                <span>Company</span>
                <ul>
                    <li><a href="{{ route('company.about') }}">About Us</a></li>
                    <li><a href="{{ route('company.contact') }}">Contact Us</a></li>
                </ul>
            </li>
            <li class="{{ request()->is('shortlets*') ? 'current' : '' }}">
                <a href="{{ route('shortlets.index') }}">Shortlets</a>
            </li>
            <li class="{{ request()->is('interiors*') ? 'current' : '' }}">
                <a href="{{ route('interiors.index') }}">Interiors</a>
            </li>
        </ul>
    </nav>
</header>
<!-- /header --> 