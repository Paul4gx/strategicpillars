@extends('layouts.app')

@section('title', 'Contact | Strategic Pillars')
@section('meta_description', 'Contact Strategic Pillars for property inquiries, bookings, or interior design services in Lagos.')

@push('styles')
<style>
    #backdrop-hero {
        height: 60vh;
        min-height: 300px;
        max-height: 500px;
        background-position: center !important;
        background-size: cover !important;
        background-repeat: no-repeat !important;
        background-attachment: scroll;
        position: relative;
    }
    
    @media (max-width: 768px) {
        #backdrop-hero {
            height: 50vh;
            min-height: 250px;
            max-height: 350px;
            background-attachment: scroll;
        }
    }
    
    @media (max-width: 480px) {
        #backdrop-hero {
            height: 40vh;
            min-height: 200px;
            max-height: 300px;
        }
    }
    
    .wrap-map-v5 {
        position: relative;
        overflow: hidden;
    }
</style>
@endpush

@section('content')
<div class="wrap-map-v5">
                    <div id="backdrop-hero" style="background-image:url('/images/contact.webp');background-size:100%;background-repeat:no-repeat;"></div>
                    <div class="grid-contact">
                        <div class="contact-item wow fadeInUp">
                            <div class="icon">
                                <i class="flaticon-location-pin"></i>
                            </div>
                            <div class="content">
                                <h4>Our Address</h4>
                                <p>{{ config('settings.address', '123 Victoria Island, Lagos, Nigeria') }}</p>
                            </div>
                            <div class="bot">
                                <div class="text-content">View on Map</div>
                            </div>
                        </div>
                        <div class="contact-item wow fadeInUp" data-wow-delay="0.1s">
                            <div class="icon">
                                <i class="flaticon-phone"></i>
                            </div>
                            <div class="content">
                                <h4>Phone Number</h4>
                                <p>{{ config('settings.phone', '+234 800 000 0000') }}</p>
                            </div>
                            <div class="bot">
                                <div class="text-content">Call Now</div>
                            </div>
                        </div>
                        <div class="contact-item wow fadeInUp" data-wow-delay="0.2s">
                            <div class="icon">
                                <i class="flaticon-video-chat"></i>
                            </div>
                            <div class="content">
                                <h4>Email Address</h4>
                                <p>{{ config('settings.email', 'info@strategicpillars.com') }}</p>
                            </div>
                            <div class="bot">
                                <div class="text-content">Send Email</div>
                            </div>
                        </div>
                    </div>
</div>
                <!-- send-message -->
                <section class="tf-section send-message">
                    <div class="cl-container">
                        <div class="row">
                            <div class="col-12">
                                <div class="heading-section text-center">
                                    <h2 class="wow fadeInUp">Get In Touch With Us</h2>
                                    <div class="text wow fadeInUp">Ready to transform your space or find your dream property? Contact our expert team for personalized consultation and exceptional service.</div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-center">
                            <div class="col-xxl-8">
                                <form class="form-send-message" method="POST" action="{{ route('company.contact.send') }}">
                                    <div class="cols">
                                        <fieldset class="name wow fadeInUp has-top-title">
                                            <input type="text" placeholder="Your Full Name" class="" name="name" tabindex="2" value="" aria-required="true" required="">
                                            <label for="">Full Name</label>
                                        </fieldset>
                                        <fieldset class="phone wow fadeInUp has-top-title">
                                            <input type="tel" placeholder="Phone Number" class="" name="phone" tabindex="2" value="" aria-required="true" required="">
                                            <label for="">Phone Number</label>
                                        </fieldset>
                                    </div>
                                    <fieldset class="email wow fadeInUp has-top-title">
                                        <input type="email" placeholder="Email Address" class="" name="email" tabindex="2" value="" aria-required="true" required="">
                                        <label for="">Email Address</label>
                                    </fieldset>
                                    <fieldset class="message wow fadeInUp has-top-title">
                                        <textarea name="message" rows="4" placeholder="Tell us about your project or property needs..." class="" tabindex="2" aria-required="true" required=""></textarea>
                                        <label for="">Your Message</label>
                                  </fieldset>
                                    <div class="checkbox-item wow fadeInUp">
                                        <label>
                                            <p>I consent to having this website store my submitted information</p>
                                            <input type="checkbox">
                                            <span class="btn-checkbox"></span>
                                        </label>
                                    </div>
                                    <div class="button-submit wow fadeInUp">
                                        <button class="tf-button-primary w-full" type="submit">Send Message<i class="icon-arrow-right-add"></i></button>
                                    </div>
                                                    {{-- <div class="mt-4">
                    <a href="https://wa.me/{{ config('settings.whatsapp', '2340000000') }}" class="btn btn-success me-2" target="_blank"><i class="flaticon-whatsapp"></i> WhatsApp</a>
                    <a href="tel:{{ config('settings.phone', '+2340000000') }}" class="btn btn-outline-primary"><i class="flaticon-phone"></i> Call Us</a>
                </div> --}}
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- /send-message -->
@endsection 