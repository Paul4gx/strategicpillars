@extends('layouts.app')

@section('title', 'Interiors | Strategic Pillars')
@section('meta_description', 'Explore luxury interior design projects by Strategic Pillars.')

@section('content')
<!-- slider -->
                <section class="slider home5">
                    <div class="wrap-slider">
                        <div class="slider-item">
                            <div class="cl-container">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="slider-content">
                                            <p class="relative z-5 wow fadeInUp">Transform your space into a masterpiece of luxury and sophistication.</p>
                                            <h1 class="wow fadeInUp">Luxury <span style="font-style: bold">Interior</span><br>Design <strong>Excellence</strong></h1>
                                            <div class="flex gap30 items-center flex-wrap relative z-5 wow fadeInUp">
                                                <div class="text-1">Featured Projects</div>
                                                <div class="list-links">
                                                    <a href="#" class="text-center">Modern Luxury</a>
                                                    <a href="#" class="text-center">Contemporary Elegance</a>
                                                    <a href="#" class="text-center">Classic Sophistication</a>
                                                </div>
                                            </div>
                                            <div class="left">
                                                <div class="wrap-img flex gap10">
                                                    <div class="flex gap10 flex-column">
                                                        <img class="img-1" src="images/image-box/grid-img-1.jpg" alt="">
                                                        <img class="img-2" src="images/image-box/grid-img-2.jpg" alt="">
                                                    </div>
                                                    <div class="flex gap10 flex-column">
                                                        <img class="img-3" src="images/image-box/grid-img-3.jpg" alt="">
                                                        <img class="img-4" src="images/image-box/interior-1.webp" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- /slider -->
                <!-- luxury-home -->
                <section class="tf-section luxury-home style-3">
                    <div class="image">
                        <img src="images/section/img-half-1.jpg" alt="">
                    </div>
                    <div class="content">
                        <h2 class="wow fadeInUp">Crafting Extraordinary <br>
                            Living Spaces</h2>
                        <div class="text-content wow fadeInUp">At Strategic Pillars, we believe that luxury is not just about expensive materials—it's about creating spaces that reflect your unique personality and lifestyle. Our award-winning design team combines timeless elegance with contemporary innovation to transform your vision into reality.</div>
                        <ul>
                            <li class="wow fadeInUp">
                                <h4>Bespoke Design Solutions</h4>
                                <p>Every project is uniquely tailored to your <br>
                                    lifestyle, preferences, and architectural vision.</p>
                            </li>
                            <li class=" wow fadeInUp" data-wow-delay="0.1s">
                                <h4>Premium Materials & Craftsmanship</h4>
                                <p>We source only the finest materials from <br>
                                    renowned international suppliers and artisans.</p>
                            </li>
                        </ul>
                        <a href="#" class="tf-button-primary wow fadeInUp">Explore Our Portfolio<i class="icon-arrow-right-add"></i></a>
                    </div>
                </section>
                <!-- /luxury-home -->
                
                <!-- Interior Design Services -->
                {{-- <section class="tf-section flat-services style-2">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="heading-section text-center">
                                    <h2 class="wow fadeInUp">Our Interior Design Services</h2>
                                    <p class="wow fadeInUp">From concept to completion, we deliver exceptional interior design solutions that exceed expectations</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <div class="services-box style-2 wow fadeInUp">
                                    <div class="icon">
                                        <i class="flaticon-home"></i>
                                    </div>
                                    <h4>Residential Design</h4>
                                    <p>Transform your home into a sanctuary of luxury and comfort with our bespoke residential interior design services.</p>
                                    <ul>
                                        <li>Custom furniture design</li>
                                        <li>Space planning & optimization</li>
                                        <li>Color scheme consultation</li>
                                        <li>Lighting design</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="services-box style-2 wow fadeInUp" data-wow-delay="0.1s">
                                    <div class="icon">
                                        <i class="flaticon-building"></i>
                                    </div>
                                    <h4>Commercial Spaces</h4>
                                    <p>Create impressive commercial environments that reflect your brand identity and enhance productivity.</p>
                                    <ul>
                                        <li>Office design & layout</li>
                                        <li>Retail space planning</li>
                                        <li>Hospitality interiors</li>
                                        <li>Brand integration</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="services-box style-2 wow fadeInUp" data-wow-delay="0.2s">
                                    <div class="icon">
                                        <i class="flaticon-palette"></i>
                                    </div>
                                    <h4>Luxury Renovations</h4>
                                    <p>Breathe new life into existing spaces with our comprehensive renovation and remodeling services.</p>
                                    <ul>
                                        <li>Kitchen & bathroom design</li>
                                        <li>Structural modifications</li>
                                        <li>Premium finishes</li>
                                        <li>Project management</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </section> --}}
                <!-- /Interior Design Services -->
                
                <!-- Design Process -->
                {{-- <section class="tf-section flat-process style-2">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="heading-section text-center">
                                    <h2 class="wow fadeInUp">Our Design Process</h2>
                                    <p class="wow fadeInUp">A systematic approach to delivering exceptional interior design results</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-6">
                                <div class="process-box wow fadeInUp">
                                    <div class="number">01</div>
                                    <h4>Consultation & Discovery</h4>
                                    <p>We begin with an in-depth consultation to understand your vision, lifestyle, and requirements.</p>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="process-box wow fadeInUp" data-wow-delay="0.1s">
                                    <div class="number">02</div>
                                    <h4>Concept Development</h4>
                                    <p>Our design team creates initial concepts and mood boards that capture your aesthetic preferences.</p>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="process-box wow fadeInUp" data-wow-delay="0.2s">
                                    <div class="number">03</div>
                                    <h4>Design & Planning</h4>
                                    <p>Detailed design development including 3D visualizations, material selection, and project planning.</p>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="process-box wow fadeInUp" data-wow-delay="0.3s">
                                    <div class="number">04</div>
                                    <h4>Implementation</h4>
                                    <p>Professional project management ensures seamless execution with attention to every detail.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section> --}}
                <!-- /Design Process -->
                
                <!-- Portfolio Gallery -->
                <section class="tf-section flat-portfolio style-2 py-5 mt-5 pb-0">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="heading-section text-center">
                                    <h2 class="wow fadeInUp">Featured Interior Projects</h2>
                                    <p class="wow fadeInUp">Discover our portfolio of exceptional interior design projects across Lagos</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- /Portfolio Gallery -->
                
                <!-- Portfolio Image Gallery -->
                <div class="swiper-container slider-3-center">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img src="images/slider/slider-properties-detail-8.jpg" alt="Luxury Living Room Design">
                        </div>
                        <div class="swiper-slide">
                            <img src="images/slider/slider-properties-detail-9.jpg" alt="Modern Kitchen Interior">
                        </div>
                        <div class="swiper-slide">
                            <img src="images/slider/slider-properties-detail-10.jpg" alt="Elegant Bedroom Design">
                        </div>
                        <div class="swiper-slide">
                            <img src="images/slider/slider-properties-detail-8.jpg" alt="Contemporary Office Space">
                        </div>
                        <div class="swiper-slide">
                            <img src="images/slider/slider-properties-detail-9.jpg" alt="Luxury Bathroom Design">
                        </div>
                        <div class="swiper-slide">
                            <img src="images/slider/slider-properties-detail-10.jpg" alt="Executive Dining Room">
                        </div>
                    </div>
                </div>
                
                <!-- Client Testimonials -->
                {{-- <section class="tf-section flat-testimonials style-2">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="heading-section text-center">
                                    <h2 class="wow fadeInUp">What Our Clients Say</h2>
                                    <p class="wow fadeInUp">Hear from satisfied clients who have experienced our exceptional interior design services</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <div class="testimonial-box wow fadeInUp">
                                    <div class="content">
                                        <p>"Strategic Pillars transformed our home into a masterpiece. Their attention to detail and luxury finishes exceeded all our expectations. The team's professionalism and creativity are unmatched."</p>
                                    </div>
                                    <div class="author">
                                        <div class="avatar">
                                            <img src="images/author/author-1.png" alt="Sarah Johnson">
                                        </div>
                                        <div class="info">
                                            <h5>Sarah Johnson</h5>
                                            <span>Victoria Island Resident</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="testimonial-box wow fadeInUp" data-wow-delay="0.1s">
                                    <div class="content">
                                        <p>"Working with Strategic Pillars was an absolute pleasure. They understood our vision perfectly and delivered a commercial space that perfectly represents our brand. Highly recommended!"</p>
                                    </div>
                                    <div class="author">
                                        <div class="avatar">
                                            <img src="images/author/author-2.png" alt="Michael Chen">
                                        </div>
                                        <div class="info">
                                            <h5>Michael Chen</h5>
                                            <span>CEO, Tech Innovations</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="testimonial-box wow fadeInUp" data-wow-delay="0.2s">
                                    <div class="content">
                                        <p>"The renovation of our penthouse was flawless. Strategic Pillars managed every aspect with precision and delivered results that surpassed our wildest dreams. Truly exceptional service."</p>
                                    </div>
                                    <div class="author">
                                        <div class="avatar">
                                            <img src="images/author/author-3.png" alt="Adebayo Okafor">
                                        </div>
                                        <div class="info">
                                            <h5>Adebayo Okafor</h5>
                                            <span>Ikoyi Property Owner</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section> --}}
                <!-- /Client Testimonials -->
                
                <!-- Call to Action -->
                <section class="tf-section flat-cta style-2 py-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="cta-content text-center">
                                    <h2 class="wow fadeInUp">Ready to Transform Your Space?</h2>
                                    <p class="wow fadeInUp">Let our expert design team create the luxury interior of your dreams. Schedule a consultation today and discover the Strategic Pillars difference.</p>
                                    <div class="cta-buttons wow fadeInUp d-flex justify-content-center">
                                        <a href="{{route('company.contact')}}" class="tf-button-primary mt-4">Schedule Consultation</a>
                                        {{-- <a href="#" class="tf-button-secondary">View Portfolio</a> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- /Call to Action -->
                    
@endsection 