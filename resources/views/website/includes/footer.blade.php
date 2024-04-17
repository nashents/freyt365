<footer id="bi-footer" class="bi-footer-section" data-background={{asset('assets/img/bg/footer-bg.png')}}>
    <div class="bi-footer-cta black-footer position-relative">
        <div class="container">
            <div class="bi-footer-cta-content headline d-flex align-items-center  justify-content-between flex-wrap" data-background="{{ asset('assets/img/footer.png')}}">
                <div class="bi-footer-cta-text"> 
                    <h3>Transportation Partner?</h3>
                </div>
                <div class="bi-cta-btn">
                    <div class="bi-btn-1  bi-btn-area text-uppercase">
                        <a class="bi-btn-main  bi-btn-hover bi-btn-item" href="{{ route('contact_us') }}">  <span></span> Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bi-footer-widget-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="bi-footer-widget headline pera-content ul-li-block">
                        <div class="about-widget">
                            <h3>Empowering Trucking Business Growth with Freyt365</h3>
                            <p>
                                Welcome to Freyt365, a subsidiary of Raysun Capital. Our mission is to provide truckers like you with easy access to funding and innovative financial management tools. With a dedication to trust, innovation, speed, and reliability, we stand as unwavering allies in your pursuit of success in the competitive transportation industry. 
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="bi-footer-widget headline pera-content ul-li-block">
                        <div class="menu-widget">
                            <h3 class="widget-title">Quick Links</h3>
                            <ul>
                                <li><a href="#">Home</a></li>
                                <li><a href="#">Team</a></li>
                                <li><a href="#">Testimonial</a></li>
                                <li><a href="#">FAQ</a></li>
                                <li><a href="#">Contact </a></li>
                                
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="bi-footer-widget headline pera-content ul-li-block">
                        <div class="menu-widget">
                            <h3 class="widget-title">Services</h3>
                            <ul>
                                @php
                                    $services = App\Models\Service::latest()->take(4)->get();
                                @endphp
                                @foreach ($services as $service)
                                    <li><a href="#">{{ $service->title }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    
                </div>
            </div>
        </div>
    </div>
    <div class="bi-footer-social">
        <div class="container">
            <div class="bi-footer-social-content ul-li">
                <ul>
                    <li><a href="#"><i class="fab fa-twitter"></i>  Twitter  </a></li>
                    <li><a href="#"><i class="fab fa-linkedin-in"></i> Linked In    </a></li>
                    <li><a href="#"><i class="fab fa-facebook-f"></i> Facebook  </a></li>
                    <li><a href="#"><i class="fab fa-instagram"></i> Instagram  </a></li>
                    <li><a href="#"><i class="fab fa-youtube"></i> Youtube </a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="bi-footer-logo-area">
        <div class="container">
            <div class="bi-footer-logo">
                <div class="brand-logo text-center">
                    <a href="#"><img src={{asset('assets/img/logo/logo-footer.png')}} alt=""></a>
                </div>
                <div class="logo-mail text-center headline">
                    <h3><a href="#">enquires@raysuncapital.com</a></h3>
                </div>
            </div>
        </div>
    </div>
    <div class="bi-footer-copyright text-center">
        {{ date('Y') }} © {{ env('APP_NAME') }} - Developed by <a href="http://" target="_blank" rel="noopener noreferrer" style="color: white">Basilmark Software Solutions</a>
    </div>
</footer>	