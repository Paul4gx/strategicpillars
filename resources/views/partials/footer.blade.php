            <!-- footer -->
            <footer class="footer style-full bg-white">
                <div class="footer-inner">
                    <div class="footer-inner-wrap style-container">
                        <div class="top-footer">
                            <div class="logo-footer">
                                <a href="{{route('home')}}">
                                    <img id="logo-footer" src="{{asset('images/logo/logo.svg')}}" alt="images">
                                </a>
                            </div>
                            <div class="wg-social style-black">
                                <span>Follow Us</span>
                                <ul class="list-social">
                                    <li>
                                        <a href="#">
                                            <i class="icon-facebook"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="icon-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="icon-instagram"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="icon-linkedin2"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="center-footer">
                            <div class="footer-cl-1">
                                <div class="ft-title">Subscribe</div>
                                <form class="form-subscribe style-line-bottom">
                                    <fieldset class="email">
                                        <input type="email" placeholder="Your e-mail" class="style-1" name="email" tabindex="2" value="" aria-required="true" required="">
                                    </fieldset>
                                    <div class="button-submit style-absolute-right">
                                        <button class="tf-button-bg type-secondary" type="submit">Send <i class="icon-arrow-right-add"></i></button>
                                    </div>
                                </form>
                                <div class="text">Subscribe to our newsletter to receive our weekly feed.</div>
                            </div>
                            <div class="footer-cl-2">
                                <div class="ft-title">Estates</div>
                                <ul class="navigation-menu-footer">
                                    <li><a href="property-map-v1.html">Miami</a></li>
                                    <li><a href="property-map-v1.html">New York</a></li>
                                    <li><a href="property-map-v1.html">Chicago</a></li>
                                    <li><a href="property-map-v1.html">Sacramento</a></li>
                                    <li><a href="#">Los Angeles</a></li>
                                    <li><a href="#">San Francisco</a></li>
                                </ul>
                            </div>
                            <div class="footer-cl-3">
                                <div class="ft-title">Quick Links</div>
                                <ul class="navigation-menu-footer">
                                    <li><a href="{{ url('/') }}">Home</a></li>
                                    <li><a href="{{ route('estates.index') }}">Estates</a></li>
                                    <li><a href="{{ route('interiors.index') }}">Interiors</a></li>
                                    <li><a href="{{ route('agents.index') }}">Agents</a></li>
                                    <li><a href="{{ route('company.about') }}">About</a></li>
                                    <li><a href="{{ route('company.contact') }}">Contact</a></li>
                                </ul>
                            </div>
                            <div class="footer-cl-4">
                                <div class="ft-title">Properties</div>
                                <ul class="navigation-menu-footer">
                                    <li><a href="{{ route('properties.index') }}">All Properties</a></li>
                                    <li><a href="{{ route('properties.index') }}">Our Properties</a></li>
                                    <li><a href="{{ route('shortlets.index') }}">Shortlets</a></li>
                                    <li><a href="{{ route('shortlets.index') }}">Apartments</a></li>
                                    <li><a href="{{ route('shortlets.index') }}">Lands</a></li>
                                </ul>
                            </div>
                            <div class="footer-cl-5">
                                <div class="ft-title">Our Address</div>
                                <ul class="navigation-menu-footer">
                                    <li><div class="text">info@spillargroup.com (123) 456-7890</div></li>
                                    <li><div class="text">90 Fifth Avenue, 3rd Floor San Francisco, CA 1980</div></li>
                                </ul>
                            </div>
                        </div>
                        <div class="bottom-footer">
                            <div class="text"><p>&copy; {{ date('Y') }} Strategic Pillars. All rights reserved.</p></div>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- /footer -->

        </div>
        <!-- /#page -->
    </div>
