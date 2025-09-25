<!-- slider -->
<section class="slider home8">
    <div class="wrap-slider">
        <!-- Background Image Slider -->
        <div class="hero-bg-slider">
            <div class="swiper-container hero-bg-swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="hero-bg-image" style="background-image: url('{{ asset('images/slider/slider-1.webp') }}');"></div>
                    </div>
                    <div class="swiper-slide">
                        <div class="hero-bg-image" style="background-image: url('{{ asset('images/slider/slider-2.jpg') }}');"></div>
                    </div>
                    <div class="swiper-slide">
                        <div class="hero-bg-image" style="background-image: url('{{ asset('images/slider/slider-3.jpg') }}');"></div>
                    </div>
                    {{-- <div class="swiper-slide">
                        <div class="hero-bg-image" style="background-image: url('{{ asset('images/slider/slider-4.jpg') }}');"></div>
                    </div>
                    <div class="swiper-slide">
                        <div class="hero-bg-image" style="background-image: url('{{ asset('images/slider/slider-5.jpg') }}');"></div>
                    </div> --}}
                </div>
            </div>
        </div>
        
        <!-- Content Overlay -->
        <div class="slider-item">
            <div class="cl-container">
                <div class="row">
                    <div class="col-12">
                        <div class="slider-content">
                            <div class="sub wow fadeInUp">LET US GUIDE YOUR HOME</div>
                            <h1 class="wow fadeInUp">Enjoy The Finest Homes</h1>
                            <p class="wow fadeInUp">From luxury apartments to modern villas, discover your perfect home in Lagos with Strategic Pillars.</p>
                            <div class="widget-tabs style-5 wow fadeInUp">
                                <ul class="widget-menu-tab">
                                    <li class="item-title active">
                                        <span class="inner">Buy</span>
                                    </li>
                                    <li class="item-title">
                                        <span class="inner">Rent</span>
                                    </li>
                                    <li class="item-title">
                                        <span class="inner">Shortlet</span>
                                    </li>
                                </ul>
                                <div class="widget-content-tab">
                                    <div class="widget-content-inner active">
                                        <form class="form-search-home6" action="{{ route('properties.index') }}" method="GET">
                                            <input type="hidden" name="status" value="available">
                                            <div class="list">
                                                <div class="group-form form-search-content">
                                                    <div class="form-style-has-title">
                                                        <div class="title">Keyword</div>
                                                        <div class="relative">
                                                            <fieldset class="name">
                                                                <input type="text" placeholder="Enter Keyword" class="show-search style-default" name="keyword" tabindex="2" value="{{ request('keyword') }}" aria-required="true">
                                                            </fieldset>
                                                            <div class="style-absolute-right">
                                                                <div class="style-icon-default"><i class="flaticon-magnifiying-glass"></i></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="divider-1"></div>
                                                <div class="group-form">
                                                    <div class="form-style-has-title">
                                                        <div class="title">Type</div>
                                                        <select name="type" class="nice-select style-white">
                                                            <option value="">All Type</option>
                                                            <option value="Apartment" @if(request('type') == 'Apartment') selected @endif>Apartment</option>
                                                            <option value="Villa" @if(request('type') == 'Villa') selected @endif>Villa</option>
                                                            <option value="Townhouse" @if(request('type') == 'Townhouse') selected @endif>Townhouse</option>
                                                            <option value="Single Family" @if(request('type') == 'Single Family') selected @endif>Single Family</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex gap10">
                                                <div class="group-form">
                                                    <div class="wg-filter">
                                                        <div class="tf-button-filter btn-filter"><i class="flaticon-filter"></i>Filter</div>
                                                        <div class="open-filter filter-no-content" id="a1">
                                                            <div>
                                                                <div class="grid-3-cols mb-20">
                                                                    <div class="form-style-has-title">
                                                                        <div class="title">Location</div>
                                                                        <select name="city" class="nice-select">
                                                                            <option value="">All Locations</option>
                                                                            <option value="Victoria Island" @if(request('city') == 'Victoria Island') selected @endif>Victoria Island</option>
                                                                            <option value="Ikoyi" @if(request('city') == 'Ikoyi') selected @endif>Ikoyi</option>
                                                                            <option value="Lekki" @if(request('city') == 'Lekki') selected @endif>Lekki</option>
                                                                            <option value="Banana Island" @if(request('city') == 'Banana Island') selected @endif>Banana Island</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-style-has-title">
                                                                        <div class="title">Bedrooms</div>
                                                                        <select name="bedrooms" class="nice-select">
                                                                            <option value="">Any</option>
                                                                            <option value="1" @if(request('bedrooms') == '1') selected @endif>1+ Bed</option>
                                                                            <option value="2" @if(request('bedrooms') == '2') selected @endif>2+ Beds</option>
                                                                            <option value="3" @if(request('bedrooms') == '3') selected @endif>3+ Beds</option>
                                                                            <option value="4" @if(request('bedrooms') == '4') selected @endif>4+ Beds</option>
                                                                            <option value="5" @if(request('bedrooms') == '5') selected @endif>5+ Beds</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-style-has-title">
                                                                        <div class="title">Bathrooms</div>
                                                                        <select name="bathrooms" class="nice-select">
                                                                            <option value="">Any</option>
                                                                            <option value="1" @if(request('bathrooms') == '1') selected @endif>1+ Bath</option>
                                                                            <option value="2" @if(request('bathrooms') == '2') selected @endif>2+ Baths</option>
                                                                            <option value="3" @if(request('bathrooms') == '3') selected @endif>3+ Baths</option>
                                                                            <option value="4" @if(request('bathrooms') == '4') selected @endif>4+ Baths</option>
                                                                            <option value="5" @if(request('bathrooms') == '5') selected @endif>5+ Baths</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="grid-4-cols">
                                                                    <fieldset class="name">
                                                                        <input type="number" placeholder="Min. Area (sqft)" name="min_area" value="{{ request('min_area') }}" aria-required="true">
                                                                    </fieldset>
                                                                    <fieldset class="name">
                                                                        <input type="number" placeholder="Max. Area (sqft)" name="max_area" value="{{ request('max_area') }}" aria-required="true">
                                                                    </fieldset>
                                                                    <fieldset class="name">
                                                                        <input type="number" placeholder="Min. Price (₦)" name="min_price" value="{{ request('min_price') }}" aria-required="true">
                                                                    </fieldset>
                                                                    <fieldset class="name">
                                                                        <input type="number" placeholder="Max. Price (₦)" name="max_price" value="{{ request('max_price') }}" aria-required="true">
                                                                    </fieldset>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="group-form">
                                                    <div class="button-submit">
                                                        <button class="tf-button-primary" type="submit">Search</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="widget-content-inner">
                                        <form class="form-search-home6" action="{{ route('properties.index') }}" method="GET">
                                            <input type="hidden" name="status" value="rented">
                                            <div class="list">
                                                <div class="group-form form-search-content">
                                                    <div class="form-style-has-title">
                                                        <div class="title">Keyword</div>
                                                        <div class="relative">
                                                            <fieldset class="name">
                                                                <input type="text" placeholder="Enter Keyword" class="show-search style-default" name="keyword" tabindex="2" value="{{ request('keyword') }}" aria-required="true">
                                                            </fieldset>
                                                            <div class="style-absolute-right">
                                                                <div class="style-icon-default"><i class="flaticon-magnifiying-glass"></i></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="divider-1"></div>
                                                <div class="group-form">
                                                    <div class="form-style-has-title">
                                                        <div class="title">Type</div>
                                                        <select name="type" class="nice-select style-white">
                                                            <option value="">All Type</option>
                                                            <option value="Apartment" @if(request('type') == 'Apartment') selected @endif>Apartment</option>
                                                            <option value="Villa" @if(request('type') == 'Villa') selected @endif>Villa</option>
                                                            <option value="Townhouse" @if(request('type') == 'Townhouse') selected @endif>Townhouse</option>
                                                            <option value="Single Family" @if(request('type') == 'Single Family') selected @endif>Single Family</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex gap10">
                                                <div class="group-form">
                                                    <div class="wg-filter">
                                                        <div class="tf-button-filter btn-filter"><i class="flaticon-filter"></i>Filter</div>
                                                        <div class="open-filter filter-no-content" id="a2">
                                                            <div>
                                                                <div class="grid-3-cols mb-20">
                                                                    <div class="form-style-has-title">
                                                                        <div class="title">Location</div>
                                                                        <select name="city" class="nice-select">
                                                                            <option value="">All Locations</option>
                                                                            <option value="Victoria Island" @if(request('city') == 'Victoria Island') selected @endif>Victoria Island</option>
                                                                            <option value="Ikoyi" @if(request('city') == 'Ikoyi') selected @endif>Ikoyi</option>
                                                                            <option value="Lekki" @if(request('city') == 'Lekki') selected @endif>Lekki</option>
                                                                            <option value="Banana Island" @if(request('city') == 'Banana Island') selected @endif>Banana Island</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-style-has-title">
                                                                        <div class="title">Bedrooms</div>
                                                                        <select name="bedrooms" class="nice-select">
                                                                            <option value="">Any</option>
                                                                            <option value="1" @if(request('bedrooms') == '1') selected @endif>1+ Bed</option>
                                                                            <option value="2" @if(request('bedrooms') == '2') selected @endif>2+ Beds</option>
                                                                            <option value="3" @if(request('bedrooms') == '3') selected @endif>3+ Beds</option>
                                                                            <option value="4" @if(request('bedrooms') == '4') selected @endif>4+ Beds</option>
                                                                            <option value="5" @if(request('bedrooms') == '5') selected @endif>5+ Beds</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-style-has-title">
                                                                        <div class="title">Bathrooms</div>
                                                                        <select name="bathrooms" class="nice-select">
                                                                            <option value="">Any</option>
                                                                            <option value="1" @if(request('bathrooms') == '1') selected @endif>1+ Bath</option>
                                                                            <option value="2" @if(request('bathrooms') == '2') selected @endif>2+ Baths</option>
                                                                            <option value="3" @if(request('bathrooms') == '3') selected @endif>3+ Baths</option>
                                                                            <option value="4" @if(request('bathrooms') == '4') selected @endif>4+ Baths</option>
                                                                            <option value="5" @if(request('bathrooms') == '5') selected @endif>5+ Baths</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="grid-4-cols">
                                                                    <fieldset class="name">
                                                                        <input type="number" placeholder="Min. Area (sqft)" name="min_area" value="{{ request('min_area') }}" aria-required="true">
                                                                    </fieldset>
                                                                    <fieldset class="name">
                                                                        <input type="number" placeholder="Max. Area (sqft)" name="max_area" value="{{ request('max_area') }}" aria-required="true">
                                                                    </fieldset>
                                                                    <fieldset class="name">
                                                                        <input type="number" placeholder="Min. Price (₦)" name="min_price" value="{{ request('min_price') }}" aria-required="true">
                                                                    </fieldset>
                                                                    <fieldset class="name">
                                                                        <input type="number" placeholder="Max. Price (₦)" name="max_price" value="{{ request('max_price') }}" aria-required="true">
                                                                    </fieldset>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="group-form">
                                                    <div class="button-submit">
                                                        <button class="tf-button-primary" type="submit">Search</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="widget-content-inner">
                                        <form class="form-search-home6" action="{{ route('shortlets.index') }}" method="GET">
                                            <div class="list">
                                                <div class="group-form form-search-content">
                                                    <div class="form-style-has-title">
                                                        <div class="title">Keyword</div>
                                                        <div class="relative">
                                                            <fieldset class="name">
                                                                <input type="text" placeholder="Enter Keyword" class="show-search style-default" name="keyword" tabindex="2" value="{{ request('keyword') }}" aria-required="true">
                                                            </fieldset>
                                                            <div class="style-absolute-right">
                                                                <div class="style-icon-default"><i class="flaticon-magnifiying-glass"></i></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="divider-1"></div>
                                                <div class="group-form">
                                                    <div class="form-style-has-title">
                                                        <div class="title">City</div>
                                                        <select name="city" class="nice-select style-white">
                                                            <option value="">All Cities</option>
                                                            <option value="Victoria Island" @if(request('city') == 'Victoria Island') selected @endif>Victoria Island</option>
                                                            <option value="Ikoyi" @if(request('city') == 'Ikoyi') selected @endif>Ikoyi</option>
                                                            <option value="Lekki" @if(request('city') == 'Lekki') selected @endif>Lekki</option>
                                                            <option value="Ajah" @if(request('city') == 'Ajah') selected @endif>Ajah</option>
                                                            <option value="Ikeja" @if(request('city') == 'Ikeja') selected @endif>Ikeja</option>
                                                            <option value="Banana Island" @if(request('city') == 'Banana Island') selected @endif>Banana Island</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex gap10">
                                                <div class="group-form">
                                                    <div class="wg-filter">
                                                        <div class="tf-button-filter btn-filter"><i class="flaticon-filter"></i>Filter</div>
                                                        <div class="open-filter filter-no-content" id="a3">
                                                            <div>
                                                                <div class="grid-3-cols mb-20">
                                                                    <div class="form-style-has-title">
                                                                        <div class="title">Bedrooms</div>
                                                                        <select name="bedrooms" class="nice-select">
                                                                            <option value="">Any</option>
                                                                            <option value="1" @if(request('bedrooms') == '1') selected @endif>1+ Bed</option>
                                                                            <option value="2" @if(request('bedrooms') == '2') selected @endif>2+ Beds</option>
                                                                            <option value="3" @if(request('bedrooms') == '3') selected @endif>3+ Beds</option>
                                                                            <option value="4" @if(request('bedrooms') == '4') selected @endif>4+ Beds</option>
                                                                            <option value="5" @if(request('bedrooms') == '5') selected @endif>5+ Beds</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-style-has-title">
                                                                        <div class="title">Bathrooms</div>
                                                                        <select name="bathrooms" class="nice-select">
                                                                            <option value="">Any</option>
                                                                            <option value="1" @if(request('bathrooms') == '1') selected @endif>1+ Bath</option>
                                                                            <option value="2" @if(request('bathrooms') == '2') selected @endif>2+ Baths</option>
                                                                            <option value="3" @if(request('bathrooms') == '3') selected @endif>3+ Baths</option>
                                                                            <option value="4" @if(request('bathrooms') == '4') selected @endif>4+ Baths</option>
                                                                            <option value="5" @if(request('bathrooms') == '5') selected @endif>5+ Baths</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-style-has-title">
                                                                        <div class="title">Area (Sq Ft)</div>
                                                                        <div class="flex gap10">
                                                                            <input type="number" placeholder="Min" name="min_area" value="{{ request('min_area') }}" class="form-control">
                                                                            <input type="number" placeholder="Max" name="max_area" value="{{ request('max_area') }}" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="grid-2-cols">
                                                                    <fieldset class="name">
                                                                        <input type="number" placeholder="Min. Price per Night (₦)" name="min_price" value="{{ request('min_price') }}" aria-required="true">
                                                                    </fieldset>
                                                                    <fieldset class="name">
                                                                        <input type="number" placeholder="Max. Price per Night (₦)" name="max_price" value="{{ request('max_price') }}" aria-required="true">
                                                                    </fieldset>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="group-form">
                                                    <div class="button-submit">
                                                        <button class="tf-button-primary" type="submit">Search</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="counter">
            <div class="number-counter">
                <div class="">
                    <span class="number" data-speed="2500" data-to="150" data-inviewport="yes">150</span>
                </div>
                <p>Properties Sold</p>
            </div>
            <div class="number-counter">
                <div class="">
                    <span class="number" data-speed="2500" data-to="2" data-inviewport="yes">2</span>K+
                </div>
                <p>Happy Clients</p>
            </div>
            <div class="number-counter">
                <div class="">
                    <span class="number" data-speed="2500" data-to="80" data-inviewport="yes">80</span>+
                </div>
                <p>Properties Available</p>
            </div>
        </div>
    </div>
</section>
            {{-- </div>
        </div>
        
    </div>
</section> --}}
<!-- /slider -->

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Hero Background Slider
    const heroBgSwiper = new Swiper('.hero-bg-swiper', {
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        effect: 'fade',
        fadeEffect: {
            crossFade: true
        },
        speed: 1000,
        allowTouchMove: false, // Disable touch/swipe for background slider
        on: {
            init: function () {
                // Add fade-in effect when slide changes
                this.slides.forEach((slide, index) => {
                    slide.style.opacity = index === 0 ? '1' : '0';
                });
            },
            slideChange: function () {
                // Smooth transition between slides
                this.slides.forEach((slide, index) => {
                    if (index === this.activeIndex) {
                        slide.style.opacity = '1';
                    } else {
                        slide.style.opacity = '0';
                    }
                });
            }
        }
    });
});

document.addEventListener('DOMContentLoaded', function() {
    // Tab switching functionality
    const tabItems = document.querySelectorAll('.widget-menu-tab .item-title');
    const tabContents = document.querySelectorAll('.widget-content-tab .widget-content-inner');
    
    tabItems.forEach((item, index) => {
        item.addEventListener('click', function() {
            // Remove active class from all tabs and contents
            tabItems.forEach(tab => tab.classList.remove('active'));
            tabContents.forEach(content => content.classList.remove('active'));
            
            // Add active class to clicked tab and corresponding content
            this.classList.add('active');
            tabContents[index].classList.add('active');
        });
    });
    
    // Filter toggle functionality
    const filterButtons = document.querySelectorAll('.tf-button-filter');
    const filterContents = document.querySelectorAll('.open-filter');
    
    filterButtons.forEach((button, index) => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const filterContent = filterContents[index];
            
            // Toggle the filter content
            if (filterContent.classList.contains('filter-no-content')) {
                filterContent.classList.remove('filter-no-content');
                filterContent.classList.add('filter-content');
            } else {
                filterContent.classList.remove('filter-content');
                filterContent.classList.add('filter-no-content');
            }
        });
    });
    
    // Nice select functionality (if not already handled by existing JS)
    const niceSelects = document.querySelectorAll('.nice-select');
    niceSelects.forEach(select => {
        const current = select.querySelector('.current');
        const options = select.querySelectorAll('.option');
        const hiddenInput = select.querySelector('input[type="hidden"]');
        
        if (current && options.length > 0) {
            select.addEventListener('click', function(e) {
                e.stopPropagation();
                select.classList.toggle('open');
            });
            
            options.forEach(option => {
                option.addEventListener('click', function(e) {
                    e.stopPropagation();
                    
                    // Update current text
                    current.textContent = option.textContent;
                    
                    // Update hidden input value
                    if (hiddenInput) {
                        hiddenInput.value = option.dataset.value || '';
                    }
                    
                    // Update selected option
                    options.forEach(opt => opt.classList.remove('selected'));
                    option.classList.add('selected');
                    
                    // Close dropdown
                    select.classList.remove('open');
                });
            });
        }
    });
    
    // Close dropdowns when clicking outside
    document.addEventListener('click', function() {
        niceSelects.forEach(select => {
            select.classList.remove('open');
        });
    });
});
</script>
@endpush

@push('styles')
<style>
/* Hero Background Slider Styles */
.hero-bg-slider {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
}

.hero-bg-swiper {
    width: 100%;
    height: 100%;
}

.hero-bg-image {
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    position: relative;
}

.hero-bg-image::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(0, 0, 0, 0.4) 0%, rgba(0, 0, 0, 0.2) 100%);
    z-index: 1;
}

.slider-item {
    position: relative;
    z-index: 2;
}

.slider-content {
    position: relative;
    z-index: 3;
}

/* Ensure proper layering */
.wrap-slider {
    position: relative;
    overflow: hidden;
}

/* Smooth transitions for background images */
.swiper-slide {
    transition: opacity 1s ease-in-out;
}

/* Responsive adjustments */
@media (max-width: 1024px) {
    .hero-bg-image {
        background-position: center center;
        height: 80%;
    }
}
/* Responsive adjustments */
@media (max-width: 768px) {
    .hero-bg-image {
        background-position: center center;
                height: 75%;
    }
}

@media (max-width: 480px) {
    .hero-bg-image {
        background-size: cover;
        background-position: center center;
        height: 70%;
    }
}
</style>
@endpush

