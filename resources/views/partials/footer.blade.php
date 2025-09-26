            <!-- footer -->
            <footer class="footer style-full bg-white">
                <div class="footer-inner">
                    <div class="footer-inner-wrap style-container">
                        <div class="top-footer">
                            <div class="logo-footer">
                                <a href="{{route('home')}}">
                                    <img id="logo-footer" src="{{asset('images/logo/logo.svg')}}" alt="Strategic Pillars Logo">
                                </a>
                            </div>
                            <div class="wg-social style-black">
                                <span>Follow Us</span>
                                <ul class="list-social">
                                    <li>
                                        <a href="https://facebook.com/strategicpillars" target="_blank" rel="noopener">
                                            <i class="icon-facebook"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://twitter.com/strategicpillars" target="_blank" rel="noopener">
                                            <i class="icon-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://instagram.com/strategicpillars" target="_blank" rel="noopener">
                                            <i class="icon-instagram"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://linkedin.com/company/strategicpillars" target="_blank" rel="noopener">
                                            <i class="icon-linkedin2"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="center-footer">
                            <div class="footer-cl-1">
                                <div class="ft-title">Stay Updated</div>
                                <form class="form-subscribe style-line-bottom" action="{{ route('newsletter.subscribe') }}" method="POST">
                                    @csrf
                                    <fieldset class="email">
                                        <input type="email" placeholder="Your email address" class="style-1" name="email" tabindex="2" value="" aria-required="true" required="">
                                    </fieldset>
                                    <div class="button-submit style-absolute-right">
                                        <button class="tf-button-bg type-secondary" type="submit">Subscribe <i class="icon-arrow-right-add"></i></button>
                                    </div>
                                </form>
                                <div class="text">Get exclusive access to luxury properties and real estate insights in Lagos.</div>
                            </div>
                            <div class="footer-cl-2">
                                <div class="ft-title">Prime Locations</div>
                                <ul class="navigation-menu-footer">
                                    <li><a href="{{ route('properties.index', ['location' => 'victoria-island']) }}">Victoria Island</a></li>
                                    <li><a href="{{ route('properties.index', ['location' => 'ikoyi']) }}">Ikoyi</a></li>
                                    <li><a href="{{ route('properties.index', ['location' => 'lekki']) }}">Lekki</a></li>
                                    <li><a href="{{ route('properties.index', ['location' => 'banana-island']) }}">Banana Island</a></li>
                                    <li><a href="{{ route('properties.index', ['location' => 'ajah']) }}">Ajah</a></li>
                                    <li><a href="{{ route('properties.index', ['location' => 'surulere']) }}">Surulere</a></li>
                                </ul>
                            </div>
                            <div class="footer-cl-3">
                                <div class="ft-title">Quick Links</div>
                                <ul class="navigation-menu-footer">
                                    <li><a href="{{ route('home') }}">Home</a></li>
                                    <li><a href="{{ route('estates.index') }}">Estates</a></li>
                                    <li><a href="{{ route('interiors.index') }}">Interiors</a></li>
                                    <li><a href="{{ route('agents.index') }}">Our Team</a></li>
                                    <li><a href="{{ route('company.about') }}">About Us</a></li>
                                    <li><a href="{{ route('company.contact') }}">Contact</a></li>
                                </ul>
                            </div>
                            <div class="footer-cl-4">
                                <div class="ft-title">Our Services</div>
                                <ul class="navigation-menu-footer">
                                    <li><a href="{{ route('properties.index') }}">Property Sales</a></li>
                                    <li><a href="{{ route('shortlets.index') }}">Luxury Shortlets</a></li>
                                    <li><a href="{{ route('interiors.index') }}">Interior Design</a></li>
                                    <li><a href="{{ route('estates.index') }}">Estate Management</a></li>
                                    <li><a href="{{ route('company.contact') }}">Property Investment</a></li>
                                    <li><a href="{{ route('company.contact') }}">Consultation</a></li>
                                </ul>
                            </div>
                            <div class="footer-cl-5">
                                <div class="ft-title">Contact Information</div>
                                <ul class="navigation-menu-footer">
                                    <li><div class="text">info@strategicpillars.com</div></li>
                                    <li><div class="text">+234 (0) 812 345 6789</div></li>
                                    <li><div class="text">+234 (0) 701 234 5678</div></li>
                                    <li><div class="text">1234 Victoria Island, Lagos, Nigeria</div></li>
                                </ul>
                            </div>
                        </div>
                        <div class="bottom-footer">
                            <div class="text"><p>&copy; {{ date('Y') }} Strategic Pillars. All rights reserved. | Revolutionizing Real Estate with Class, Comfort, and Purpose in Lagos.</p></div>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- /footer -->

        </div>
        <!-- /#page -->
    </div>
