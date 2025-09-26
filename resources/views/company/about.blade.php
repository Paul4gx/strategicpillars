@extends('layouts.app')

@section('title', 'About Us | Strategic Pillars')
@section('meta_description', 'Learn about Strategic Pillars: our mission, vision, values, and unique approach to real estate and luxury interiors in Lagos.')

@section('content')
                <!-- flat-title -->
                <section class="flat-title inner-page mt-2">
                    <div class="cl-container full">
                        <div class="row">
                            <div class="col-12">
                                <div class="content">
                                    <h2>About Strategic Pillars</h2>
                                    <div class="text">Your trusted partner in luxury real estate and interior design excellence</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- /flat-title -->
                                <!-- vision-mission -->
                <section class="tf-section vision-mission bg-light">
                    <div class="cl-container">
                        <div class="row">
                            <div class="col-12">
                                <div class="content">
                                    <div class="vision">
                                        <h2 class="wow fadeInUp">Our Vision</h2>
                                        <p class="wow fadeInUp">To be Nigeria's premier luxury real estate and interior design company, setting the standard for excellence in creating extraordinary living and working spaces. We envision a future where every property we touch becomes a masterpiece of design, functionality, and luxury, elevating the standards of real estate development across Lagos and beyond.</p>
                                    </div>
                                    <div class="mission">
                                        <h2 class=" wow fadeInUp" data-wow-delay="0.1s">Our Mission</h2>
                                        <p class=" wow fadeInUp" data-wow-delay="0.1s">To deliver exceptional real estate and interior design solutions that exceed our clients' expectations through innovative design, premium materials, and unparalleled service. We are committed to transforming spaces into luxurious sanctuaries that reflect our clients' unique personalities and lifestyles while maintaining the highest standards of quality and craftsmanship.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- /vision-mission -->
                <!-- luxury-home -->
                <section class="tf-section luxury-home style-5">
                    <div class="cl-container">
                        <div class="row justify-between">
                            <div class="col-md-6">
                                <div class="image wow fadeInLeft">
                                    <img src="{{asset('images/section/luxury-home-4.webp')}}" alt="">
                                    <div class="box">
                                        <div class="icon">
                                            <i class="flaticon-customer"></i>
                                        </div>
                                        <div>
                                            <p>Total Clients</p>
                                            <h4>2,000 Clients</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-5 col-md-6">
                                <div class="content">
                                    <h2 class="wow fadeInUp">About Strategic Pillars</h2>
                                    <div class="text-content wow fadeInUp">Strategic Pillars is Nigeria's premier luxury real estate and interior design company, headquartered in Lagos. Since our establishment, we have been at the forefront of creating extraordinary living and working spaces that define luxury and sophistication. Our comprehensive portfolio spans luxury residential properties, commercial developments, shortlet apartments, and bespoke interior design solutions.</div>
                
                <h3 class="wow fadeInUp">Our Unique Approach</h3>
                <div class="text-content wow fadeInUp">We believe that luxury is not just about expensive materials—it's about creating spaces that tell a story, reflect personality, and enhance lifestyle. Our multidisciplinary team of architects, interior designers, and real estate experts work collaboratively to deliver projects that exceed expectations while maintaining the highest standards of quality and craftsmanship.</div> 
                                
                <div class="col-md-12">
                <h3 class="wow fadeInUp">Why Choose Strategic Pillars?</h3>
                <ul class="list-text" style="gap:0;">
                    <li class="wow fadeInUp"><p><strong>Luxury Expertise:</strong> Specialized knowledge in high-end real estate and interior design</p></li>
                    <li class="wow fadeInUp"><p><strong>Innovative Solutions:</strong> Cutting-edge design and technology integration</p></li>
                    <li class="wow fadeInUp"><p><strong>Premium Materials:</strong> Sourcing from renowned international suppliers</p></li>
                    <li class="wow fadeInUp"><p><strong>Proven Track Record:</strong> Successfully completed projects across Lagos' most prestigious locations</p></li>
                    <li class="wow fadeInUp"><p><strong>Personalized Service:</strong> Bespoke solutions tailored to each client's unique vision</p></li>
                </ul>
            </div>
            <a href="{{ route('company.contact') }}" class="tf-button-primary style-black wow fadeInUp">Get In Touch <i class="icon-arrow-right-add"></i></a>
            
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- /luxury-home -->

                <!-- Core Values -->
                <section class="tf-section flat-services style-2">
    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="heading-section text-center">
                                    <h2 class="wow fadeInUp">Our Core Values</h2>
                                    <p class="wow fadeInUp">The principles that guide everything we do at Strategic Pillars</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <div class="services-box style-2 wow fadeInUp">
                                    <div class="icon">
                                        <i class="flaticon-diamond"></i>
                                    </div>
                                    <h4>Excellence</h4>
                                    <p>We strive for perfection in every project, ensuring the highest quality standards and attention to detail in all our real estate and interior design solutions.</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="services-box style-2 wow fadeInUp" data-wow-delay="0.1s">
                                    <div class="icon">
                                        <i class="flaticon-handshake"></i>
                                    </div>
                                    <h4>Integrity</h4>
                                    <p>We conduct business with complete transparency, honesty, and ethical practices, building lasting relationships based on trust and mutual respect.</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="services-box style-2 wow fadeInUp" data-wow-delay="0.2s">
                                    <div class="icon">
                                        <i class="flaticon-lightbulb"></i>
                                    </div>
                                    <h4>Innovation</h4>
                                    <p>We embrace cutting-edge design trends, technology, and creative solutions to deliver unique and forward-thinking real estate and interior projects.</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="services-box style-2 wow fadeInUp" data-wow-delay="0.3s">
                                    <div class="icon">
                                        <i class="flaticon-customer"></i>
                                    </div>
                                    <h4>Customer Focus</h4>
                                    <p>Our clients are at the heart of everything we do. We listen, understand, and deliver personalized solutions that exceed their expectations.</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="services-box style-2 wow fadeInUp" data-wow-delay="0.4s">
                                    <div class="icon">
                                        <i class="flaticon-crown"></i>
                                    </div>
                                    <h4>Luxury</h4>
                                    <p>We specialize in creating extraordinary spaces that define luxury living, using premium materials and sophisticated design principles.</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="services-box style-2 wow fadeInUp" data-wow-delay="0.5s">
                                    <div class="icon">
                                        <i class="flaticon-target"></i>
                                    </div>
                                    <h4>Commitment</h4>
                                    <p>We are dedicated to delivering projects on time, within budget, and to the highest standards, ensuring complete client satisfaction.</p>
                                </div>
            </div>
        </div>
    </div>
                </section>
                <!-- /Core Values -->
@endsection 