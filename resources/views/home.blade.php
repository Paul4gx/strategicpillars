@extends('layouts.app')

@section('title', 'Home | Strategic Pillars')
@section('meta_description', 'Revolutionizing Real Estate with Class, Comfort, and Purpose in Lagos. Discover luxury properties, shortlets, and interiors.')

@section('content')
    @include('components.hero')

    <!-- flat-explore -->
    <section class="tf-section flat-explore">
        <div class="cl-container">
            <div class="row">
                <div class="col-12">
                    <div class="heading-section text-center">
                        <h2 class="wow fadeInUp">Explore Our Properties</h2>
                        <div class="text wow fadeInUp">Discover our curated collection of premium properties</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="wrap">
                        <div class="cities-item style-3 wow fadeInUp">
                            <img src="{{ asset('images/house/our-properties-1.jpg') }}" alt="Town House">
                            <div class="content">
                                <h4>Town House</h4>
                                <p>{{ \App\Models\Property::where('property_type', 'townhouse')->count() }} Properties</p>
                            </div>
                            <a href="{{ route('properties.index', ['type' => 'townhouse']) }}" class="button-arrow-right"><i class="icon-arrow-right-add"></i></a>
                        </div>
                        <div class="cities-item style-3 wow fadeInUp" data-wow-delay="0.1s">
                            <img src="{{ asset('images/house/our-properties-2.jpg') }}" alt="Modern Villa">
                            <div class="content">
                                <h4>Modern Villa</h4>
                                <p>{{ \App\Models\Property::where('property_type', 'villa')->count() }} Properties</p>
                            </div>
                            <a href="{{ route('properties.index', ['type' => 'villa']) }}" class="button-arrow-right"><i class="icon-arrow-right-add"></i></a>
                        </div>
                        <div class="cities-item style-3 wow fadeInUp" data-wow-delay="0.15s">
                            <img src="{{ asset('images/house/our-properties-3.jpg') }}" alt="Apartment">
                            <div class="content">
                                <h4>Apartment</h4>
                                <p>{{ \App\Models\Property::where('property_type', 'apartment')->count() }} Properties</p>
                            </div>
                            <a href="{{ route('properties.index', ['type' => 'apartment']) }}" class="button-arrow-right"><i class="icon-arrow-right-add"></i></a>
                        </div>
                        <div class="cities-item style-3 wow fadeInUp" data-wow-delay="0.2s">
                            <img src="{{ asset('images/house/our-properties-4.jpg') }}" alt="Duplex">
                            <div class="content">
                                <h4>Duplex</h4>
                                <p>{{ \App\Models\Property::where('property_type', 'duplex')->count() }} Properties</p>
                            </div>
                            <a href="{{ route('properties.index', ['type' => 'duplex']) }}" class="button-arrow-right"><i class="icon-arrow-right-add"></i></a>
                        </div>
                        <div class="cities-item style-3 wow fadeInUp" data-wow-delay="0.25s">
                            <img src="{{ asset('images/house/our-properties-5.jpg') }}" alt="Luxury Shortlets">
                            <div class="content">
                                <h4>Luxury Shortlets</h4>
                                <p>{{ \App\Models\Property::whereIn('property_type', config('property_types.shortlet_types', []))->count() }} Properties</p>
                            </div>
                            <a href="{{ route('shortlets.index') }}" class="button-arrow-right"><i class="icon-arrow-right-add"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /flat-explore -->

    <!-- flat-homes -->
    <section class="tf-section flat-homes">
        <div class="cl-container">
            <div class="row">
                <div class="col-12">
                    <div class="heading-section text-center">
                        <h2 class="wow fadeInUp">Properties For You</h2>
                        <div class="text wow fadeInUp">Handpicked properties that match your lifestyle</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class=" arrow-style-1 arrow-over">
                        <div class="swiper-container slider-homes">
                            <div class="swiper-wrapper">
                                @foreach($featuredProperties as $property)
                                    <x-property-card2 :property="$property" />
                                @endforeach
                            </div>
                        </div>
                        <div class="homes-prev has-border swiper-button-prev"></div>
                        <div class="homes-next has-border swiper-button-next"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /flat-homes -->
                <!-- download-app -->
                <section class="tf-section-default">
                    <div class="cl-container">
                        <div class="row">
                            <div class="col-12">
                                <div class="download-app">
                                    <div class="content-right col-md-6">
                                        <div class="sub wow fadeInUp">Our Story</div>
                                        <div class="heading wow fadeInUp" style="font-size: 2rem; line-height: 1.2;margin-bottom:20px">Meet Yewande Akinyemi — Founder, SP Group</div>
                                        <p class="wow fadeInUp">
                                            A visionary entrepreneur and modern-day trailblazer, Yewande Akinyemi leads SP Group, a dynamic brand spanning real estate, interior decoration, cleaning and fumigation, and fashion design. Since beginning her real estate journey in 2017, she has helped over 500 families in Nigeria and the diaspora become proud homeowners — earning multiple awards from leading firms like Landwey Investment, Bricks and Fabrics, Softwaves Innovative Concept, and Bold Consulting.
                                        </p><p class="wow fadeInUp">
Yewande’s drive for excellence and integrity reflects in every brand she leads. A Business Administration graduate of Bowen University, with further studies in Real Estate, Interior Design, Pest Control, AI Advancement, and Business Management, she continues to embody her mission
                                        </p>
                                        {{-- <ul class="ft-download style-1">
                                            <li class="wow fadeInUp">
                                                <a href="#">
                                                    <div class="icon">
                                                        <i class="icon-appleinc"></i>
                                                    </div>
                                                    <div class="app">
                                                        <div>Download on the</div>
                                                        <div>Apple Store</div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class=" wow fadeInUp" data-wow-delay="0.1s">
                                                <a href="#">
                                                    <div class="icon">
                                                        <i class="icon-ch-play"></i>
                                                    </div>
                                                    <div class="app">
                                                        <div>Get in on</div>
                                                        <div>Google Play</div>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul> --}}
                                    </div>
                                    <div class="image wow fadeInRight">
                                        <img src="images/section/wande.webp" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- /download-app -->

    <!-- luxury-home -->
    <section class="tf-section luxury-home style-5">
        <div class="cl-container">
            <div class="row justify-between">
                <div class="col-md-6">
                    <div class="image wow fadeInLeft">
                        <img src="{{ asset('images/section/luxury-home-5.jpg') }}" alt="Luxury Home">
                        <div class="box">
                            <div class="icon">
                                <i class="flaticon-customer"></i>
                            </div>
                            <div>
                                <p>Total Clients</p>
                                <h4>2,000+</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-md-6">
                    <div class="content">
                        <h2 class="wow fadeInUp">Your Gateway to <br> Luxury Living in Lagos</h2>
                        <div class="text-content wow fadeInUp mb-0">
                            Strategic Pillars brings over 5 years of experience in Lagos real estate market. We specialize in luxury properties, smart homes, and premium shortlets that redefine modern living.
                            <br><br>
                            Our deep understanding of Lagos's most prestigious neighborhoods—from Victoria Island to Ikoyi, Lekki to Banana Island—ensures we deliver properties that match your lifestyle aspirations. We don't just sell homes; we curate living experiences that combine architectural excellence with cutting-edge technology.
                            <br><br>
                            <strong>Why Choose Strategic Pillars:</strong>
                            <ul class="list-text" style="gap:15px">
                                <li>Exclusive access to off-market luxury properties</li>
                                <li>Smart home integration and automation services</li>
                                <li>Premium shortlet management for investment properties</li>
                                <li>24/7 concierge services for all our clients</li>
                                <li>Comprehensive property investment advisory</li>
                            </ul>
                        </div>
                        <a href="{{ route('company.about') }}" class="tf-button-primary style-black wow fadeInUp">Learn More <i class="icon-arrow-right-add"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /luxury-home -->

    <!-- flat-brand -->
    {{-- <section class="tf-section-default flat-brand background-secondary">
        <div class="cl-container">
            <div class="row">
                <div class="col-12">
                    <p>Trusted by leading companies and individuals across Lagos</p>
                </div>
                <div class="col-12">
                    <div class="swiper-container slider-brand">                            
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="slogan-logo">
                                    <a href="#">
                                        <img src="{{ asset('images/image-box/brand-7.png') }}" alt="Partner 1">
                                    </a>
                                </div>                         
                            </div>
                            <div class="swiper-slide">
                                <div class="slogan-logo">
                                    <a href="#">
                                        <img src="{{ asset('images/image-box/brand-8.png') }}" alt="Partner 2">
                                    </a>
                                </div>                         
                            </div>
                            <div class="swiper-slide">
                                <div class="slogan-logo">
                                    <a href="#">
                                        <img src="{{ asset('images/image-box/brand-9.png') }}" alt="Partner 3">
                                    </a>
                                </div>                         
                            </div>
                            <div class="swiper-slide">
                                <div class="slogan-logo">
                                    <a href="#">
                                        <img src="{{ asset('images/image-box/brand-10.png') }}" alt="Partner 4">
                                    </a>
                                </div>                         
                            </div>
                            <div class="swiper-slide">
                                <div class="slogan-logo">
                                    <a href="#">
                                        <img src="{{ asset('images/image-box/brand-11.png') }}" alt="Partner 5">
                                    </a>
                                </div>                         
                            </div>
                            <div class="swiper-slide">
                                <div class="slogan-logo">
                                    <a href="#">
                                        <img src="{{ asset('images/image-box/brand-12.png') }}" alt="Partner 6">
                                    </a>
                                </div>                         
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- /flat-brand -->
    <!-- recent-properties -->
    {{-- <section class="tf-section recent-properties style-1">
        <div class="cl-container">
            <div class="row">
                <div class="col-12">
                    <div class="heading-section text-center">
                        <h2 class="wow fadeInUp">Featured Properties</h2>
                        <div class="text wow fadeInUp">Based on your view history</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="swiper-container slider-recent-properties pagination-style-2">
                        <div class="swiper-wrapper">
                            @foreach($featuredProperties as $property)
                                <div class="swiper-slide">
                                    <x-property-card :property="$property" />
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination recent-properties-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- /recent-properties -->

    <!-- flat-testimonial -->
    <section class="tf-section flat-testimonial style-5">
        <div class="testimonials">
            <div class="cl-container">
                <div class="row justify-between">
                    <div class="col-12">
                        <div class="testimonials-inner style-row">
                            <div>
                                <h2 class="wow fadeInUp">What our customers are <br> saying us?</h2>
                            </div>
                            <div class="list">
                                <div class="item wow fadeInUp">
                                    <h3>500+</h3>
                                    <p>Luxury Properties Sold</p>
                                </div>
                                <div class="item  wow fadeInUp" data-wow-delay="0.1s">
                                    <h3>4.9</h3>
                                    <p>Customer Rating</p>
                                    <div class="ratings">
                                        <i class="flaticon-star-1"></i>
                                        <i class="flaticon-star-1"></i>
                                        <i class="flaticon-star-1"></i>
                                        <i class="flaticon-star-1"></i>
                                        <i class="flaticon-star-1"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-container slider-testimonials-1">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="testimonials-item background-white wow fadeInUp">
                                        <div class="head">
                                            <div class="image">
                                                <img src="{{ asset('images/user-yellow-circle-20550.svg') }}" alt="Adunni Adebayo">
                                            </div>
                                            <div>
                                                <div class="title">
                                                    <a href="#">Adunni Adebayo</a>
                                                </div>
                                                <p>Victoria Island Resident</p>
                                            </div>
                                        </div>
                                        <div class="description">Strategic Pillars transformed our Ikoyi apartment into a masterpiece. The interior design team understood our vision perfectly and delivered luxury beyond our expectations. Truly exceptional service!</div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="45" height="44" viewbox="0 0 45 44" fill="none">
                                            <g filter="url(#filter0_d_249_14836)">
                                            <path d="M9.67883 38C6.64234 38 4.27007 36.9524 2.56204 34.8571C0.854015 32.6667 0 29.4286 0 25.1429C0 20.6667 0.99635 16.381 2.98905 12.2857C5.07664 8.19048 8.01825 4.14286 11.8139 0.142864C11.9088 0.0476213 12.0511 0 12.2409 0C12.5255 0 12.7153 0.142858 12.8102 0.428574C13 0.619048 13.0474 0.857143 12.9526 1.14286C10.6752 4.19048 9.10949 7.14286 8.25548 10C7.49635 12.7619 7.11679 15.8571 7.11679 19.2857C7.11679 21.8571 7.44891 23.8571 8.11314 25.2857C8.77737 26.7143 9.67883 28 10.8175 29.1429L5.40876 30.1429C5.31387 28.5238 5.74088 27.2857 6.68978 26.4286C7.73358 25.5714 9.06205 25.1429 10.6752 25.1429C12.6679 25.1429 14.1861 25.7143 15.2299 26.8571C16.3686 28 16.938 29.5714 16.938 31.5714C16.938 33.6667 16.2737 35.2857 14.9453 36.4286C13.7117 37.4762 11.9562 38 9.67883 38ZM31.5985 38C28.562 38 26.1898 36.9524 24.4818 34.8571C22.8686 32.6667 22.062 29.4286 22.062 25.1429C22.062 20.5714 23.0584 16.2381 25.0511 12.1429C27.0438 8.04762 29.9854 4.04762 33.8759 0.142864C33.9708 0.0476213 34.1131 0 34.3029 0C34.5876 0 34.7774 0.142858 34.8723 0.428574C35.062 0.619048 35.1095 0.857143 35.0146 1.14286C32.7372 4.19048 31.1715 7.14286 30.3175 10C29.5584 12.7619 29.1788 15.8571 29.1788 19.2857C29.1788 21.8571 29.4635 23.9048 30.0328 25.4286C30.6971 26.8571 31.5985 28.0952 32.7372 29.1429L27.4708 30.1429C27.3759 28.5238 27.8029 27.2857 28.7518 26.4286C29.7007 25.5714 31.0292 25.1429 32.7372 25.1429C34.7299 25.1429 36.2482 25.7143 37.292 26.8571C38.4307 28 39 29.5714 39 31.5714C39 33.6667 38.3358 35.2857 37.0073 36.4286C35.7737 37.4762 33.9708 38 31.5985 38Z" fill="#1A1A1A"></path>
                                            </g>
                                        </svg>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="testimonials-item background-white wow fadeInUp" data-wow-delay="0.1s">
                                        <div class="head">
                                            <div class="image">
                                                <img src="{{ asset('images/user-yellow-circle-20550.svg') }}" alt="Chinedu Okonkwo">
                                            </div>
                                            <div>
                                                <div class="title">
                                                    <a href="#">Chinedu Okonkwo</a>
                                                </div>
                                                <p>Lekki Business Owner</p>
                                            </div>
                                        </div>
                                        <div class="description">As a business owner in Lekki, I needed a property that reflects success. Strategic Pillars delivered a stunning villa with modern amenities that impresses all my clients. The investment was worth every naira!</div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="45" height="44" viewbox="0 0 45 44" fill="none">
                                            <g filter="url(#filter0_d_249_14836)">
                                            <path d="M9.67883 38C6.64234 38 4.27007 36.9524 2.56204 34.8571C0.854015 32.6667 0 29.4286 0 25.1429C0 20.6667 0.99635 16.381 2.98905 12.2857C5.07664 8.19048 8.01825 4.14286 11.8139 0.142864C11.9088 0.0476213 12.0511 0 12.2409 0C12.5255 0 12.7153 0.142858 12.8102 0.428574C13 0.619048 13.0474 0.857143 12.9526 1.14286C10.6752 4.19048 9.10949 7.14286 8.25548 10C7.49635 12.7619 7.11679 15.8571 7.11679 19.2857C7.11679 21.8571 7.44891 23.8571 8.11314 25.2857C8.77737 26.7143 9.67883 28 10.8175 29.1429L5.40876 30.1429C5.31387 28.5238 5.74088 27.2857 6.68978 26.4286C7.73358 25.5714 9.06205 25.1429 10.6752 25.1429C12.6679 25.1429 14.1861 25.7143 15.2299 26.8571C16.3686 28 16.938 29.5714 16.938 31.5714C16.938 33.6667 16.2737 35.2857 14.9453 36.4286C13.7117 37.4762 11.9562 38 9.67883 38ZM31.5985 38C28.562 38 26.1898 36.9524 24.4818 34.8571C22.8686 32.6667 22.062 29.4286 22.062 25.1429C22.062 20.5714 23.0584 16.2381 25.0511 12.1429C27.0438 8.04762 29.9854 4.04762 33.8759 0.142864C33.9708 0.0476213 34.1131 0 34.3029 0C34.5876 0 34.7774 0.142858 34.8723 0.428574C35.062 0.619048 35.1095 0.857143 35.0146 1.14286C32.7372 4.19048 31.1715 7.14286 30.3175 10C29.5584 12.7619 29.1788 15.8571 29.1788 19.2857C29.1788 21.8571 29.4635 23.9048 30.0328 25.4286C30.6971 26.8571 31.5985 28.0952 32.7372 29.1429L27.4708 30.1429C27.3759 28.5238 27.8029 27.2857 28.7518 26.4286C29.7007 25.5714 31.0292 25.1429 32.7372 25.1429C34.7299 25.1429 36.2482 25.7143 37.292 26.8571C38.4307 28 39 29.5714 39 31.5714C39 33.6667 38.3358 35.2857 37.0073 36.4286C35.7737 37.4762 33.9708 38 31.5985 38Z" fill="#1A1A1A"></path>
                                            </g>
                                        </svg>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="testimonials-item background-white wow fadeInUp" data-wow-delay="0.2s">
                                        <div class="head">
                                            <div class="image">
                                                <img src="{{ asset('images/user-yellow-circle-20550.svg') }}" alt="Funmi Okafor">
                                            </div>
                                            <div>
                                                <div class="title">
                                                    <a href="#">Funmi Okafor</a>
                                                </div>
                                                <p>Banana Island Resident</p>
                                            </div>
                                        </div>
                                        <div class="description">Moving to Banana Island was a dream come true, and Strategic Pillars made it seamless. Their shortlet service during our transition was impeccable, and the interior design team created a home that truly reflects our family's values and lifestyle.</div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="45" height="44" viewbox="0 0 45 44" fill="none">
                                            <g filter="url(#filter0_d_249_14836)">
                                            <path d="M9.67883 38C6.64234 38 4.27007 36.9524 2.56204 34.8571C0.854015 32.6667 0 29.4286 0 25.1429C0 20.6667 0.99635 16.381 2.98905 12.2857C5.07664 8.19048 8.01825 4.14286 11.8139 0.142864C11.9088 0.0476213 12.0511 0 12.2409 0C12.5255 0 12.7153 0.142858 12.8102 0.428574C13 0.619048 13.0474 0.857143 12.9526 1.14286C10.6752 4.19048 9.10949 7.14286 8.25548 10C7.49635 12.7619 7.11679 15.8571 7.11679 19.2857C7.11679 21.8571 7.44891 23.8571 8.11314 25.2857C8.77737 26.7143 9.67883 28 10.8175 29.1429L5.40876 30.1429C5.31387 28.5238 5.74088 27.2857 6.68978 26.4286C7.73358 25.5714 9.06205 25.1429 10.6752 25.1429C12.6679 25.1429 14.1861 25.7143 15.2299 26.8571C16.3686 28 16.938 29.5714 16.938 31.5714C16.938 33.6667 16.2737 35.2857 14.9453 36.4286C13.7117 37.4762 11.9562 38 9.67883 38ZM31.5985 38C28.562 38 26.1898 36.9524 24.4818 34.8571C22.8686 32.6667 22.062 29.4286 22.062 25.1429C22.062 20.5714 23.0584 16.2381 25.0511 12.1429C27.0438 8.04762 29.9854 4.04762 33.8759 0.142864C33.9708 0.0476213 34.1131 0 34.3029 0C34.5876 0 34.7774 0.142858 34.8723 0.428574C35.062 0.619048 35.1095 0.857143 35.0146 1.14286C32.7372 4.19048 31.1715 7.14286 30.3175 10C29.5584 12.7619 29.1788 15.8571 29.1788 19.2857C29.1788 21.8571 29.4635 23.9048 30.0328 25.4286C30.6971 26.8571 31.5985 28.0952 32.7372 29.1429L27.4708 30.1429C27.3759 28.5238 27.8029 27.2857 28.7518 26.4286C29.7007 25.5714 31.0292 25.1429 32.7372 25.1429C34.7299 25.1429 36.2482 25.7143 37.292 26.8571C38.4307 28 39 29.5714 39 31.5714C39 33.6667 38.3358 35.2857 37.0073 36.4286C35.7737 37.4762 33.9708 38 31.5985 38Z" fill="#1A1A1A"></path>
                                            </g>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /flat-testimonial -->

    <!-- flat-experts -->
    <section class="tf-section flat-experts style-1">
        <div class="cl-container">
            <div class="row">
                <div class="col-12">
                    <div class="heading-section text-center">
                        <h2 class="wow fadeInUp">Meet Our Team Of Experts</h2>
                        <div class="text wow fadeInUp">Professional real estate agents dedicated to your success</div>
                    </div>
                </div>
            </div>
            <div class="row wrap-experts">
                <div class="col-12">
                    <div class="swiper-container slider-news slider-auto">
                        <div class="swiper-wrapper">
                            @foreach($agents as $index => $agent)
                            <div class="swiper-slide">
                                <div class="experts-item wow fadeInUp" @if($index > 0) data-wow-delay="{{ $index * 0.1 }}s" @endif>
                                    <div class="image">
                                        <img src="{{ asset('/storage/uploads/team/'.$agent->photo) }}" alt="{{ $agent->name }}">
                                        <ul class="wg-social-1">
                                            @if($agent->social_links && is_array($agent->social_links))
                                                @foreach($agent->social_links as $social)
                                                    @if($social['platform'] === 'facebook')
                                                        <li><a href="https://facebook.com/{{ $social['username'] }}" target="_blank"><i class="flaticon-facebook"></i></a></li>
                                                    @elseif($social['platform'] === 'twitter')
                                                        <li><a href="https://twitter.com/{{ $social['username'] }}" target="_blank"><i class="flaticon-twitter"></i></a></li>
                                                    @elseif($social['platform'] === 'instagram')
                                                        <li><a href="https://instagram.com/{{ $social['username'] }}" target="_blank"><i class="flaticon-instagram"></i></a></li>
                                                    @elseif($social['platform'] === 'linkedin')
                                                        <li><a href="https://linkedin.com/in/{{ $social['username'] }}" target="_blank"><i class="flaticon-linkedin"></i></a></li>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                    <h4><a href="#">{{ $agent->name }}</a></h4>
                                    <p>{{ $agent->role }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /flat-experts -->

    <!-- finest-selection -->
    <section class="tf-section-default finest-selection">
        <div class="cl-container">
            <div class="row">
                <div class="col-12">
                    <div class="inner">
                        <div class="content">
                            <h2 class="wow fadeInUp">Transform Your Space Into <br> A Masterpiece</h2>
                            <div class="text-content wow fadeInUp">
                                Step into a world where every corner tells a story of elegance and sophistication. Our award-winning interior design team specializes in creating breathtaking spaces that blend contemporary luxury with timeless appeal. From minimalist modern aesthetics to opulent traditional designs, we craft environments that not only look stunning but feel like home.
                                <br><br>
                                Whether you're envisioning a sleek corporate office, a cozy family living room, or a luxurious bedroom retreat, our expert designers bring your dreams to life with meticulous attention to detail and unparalleled creativity.
                            </div>
                            <div class="cta-buttons wow fadeInUp">
                                <a href="{{ route('interiors.index') }}" class="tf-button-primary style-black">Explore Our Portfolio <i class="icon-arrow-right-add"></i></a>
                            </div>
                        </div>
                        <div class="image">
                            <img src="{{ asset('images/section/img-half-1.jpg') }}" alt="Interior Design Showcase">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /finest-selection -->
@endsection

@push('styles')
<style>
/* Team Section Image Fixes */
.experts-item .image {
    position: relative;
    overflow: hidden;
    height: 300px; /* Fixed height for consistency */
    border-radius: 8px;
}

.experts-item .image img {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Maintains aspect ratio and covers the container */
    object-position: center; /* Centers the image within the container */
    transition: transform 0.3s ease;
}

.experts-item:hover .image img {
    transform: scale(1.05); /* Subtle zoom effect on hover */
}

/* Social links overlay positioning */
.experts-item .image .wg-social-1 {
    position: absolute;
    bottom: 15px;
    left: 50%;
    transform: translateX(-50%);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.experts-item:hover .image .wg-social-1 {
    opacity: 1;
}

/* Ensure consistent card heights */
.experts-item {
    height: 100%;
    display: flex;
    flex-direction: column;
}

.experts-item h4 {
    margin-top: 20px;
    margin-bottom: 8px;
    font-size: 18px;
    font-weight: 600;
}

.experts-item p {
    margin-bottom: 0;
    color: #666;
    font-size: 14px;
}

/* Responsive adjustments */
/* @media (max-width: 768px) {
    .experts-item .image {
        height: 250px;
    }
}

@media (max-width: 576px) {
    .experts-item .image {
        height: 200px;
    }
} */
</style>
@endpush 