@extends('website.layouts.app')

@section('title')
	Contact
@endsection

@section('body')
<body class="home-1">
@endsection

@section('content')
	
<!-- Start of header section
	============================================= -->
	<header id="bi-header" class="bi-header-section header-style-one">
		<div class="bi-header-content">
			<div class="bi-header-logo-main-menu d-flex align-items-center justify-content-between">
				<div class="brand-logo">
					<a href="#"><img src="{{ asset('assets/img/logo/logo-header.png')}}" alt=""></a>
				</div>
				<div class="bi-header-main-menu-cta-area d-flex align-items-center">
					<div class="bi-header-main-navigation">
						<nav class="main-navigation clearfix ul-li">
							<ul id="main-nav" class="nav navbar-nav clearfix">
								<li><a href="{{ route('landing_page') }}" target="_blank">Home</a></li>
							</ul>
						</nav>
					</div>
					<div class="bi-header-social">
						<a href="#"> <i class="fab fa-instagram"></i></a>
						<a href="#"> <i class="fab fa-linkedin-in"></i></a>
						<a href="#"> <i class="fab fa-facebook"></i></a>
						<a href="#"> <i class="fab fa-youtube"></i></a>
					</div>
					<div class="bi-header-cta-btn-grp d-flex align-items-center">
						<div class="cart-btn position-relative header-cart-btn">
							
						</div>
						<div class="offcanves-btn navSidebar-button">
							{{-- <button><i class="fal fa-bars"></i></button> --}}
						</div>
					</div>
				</div>
			</div>
			<div class="mobile_menu position-relative">
				<div class="mobile_menu_button open_mobile_menu">
					<i class="fal fa-bars"></i>
				</div>
				<div class="mobile_menu_wrap">
					<div class="mobile_menu_overlay open_mobile_menu"></div>
					<div class="mobile_menu_content">
						<div class="mobile_menu_close open_mobile_menu">
							<i class="fal fa-times"></i>
						</div>
						<div class="m-brand-logo">
							<a href="!#"><img src="{{ asset('assets/img/logo/logo2.png')}}" alt=""></a>
						</div>
						<div class="mobile-search-bar position-relative">
							<form action="#">
								<input type="text" name="search" placeholder="Keywords">
								<button><i class="fal fa-search"></i></button>
							</form>
						</div>
						<nav class="mobile-main-navigation  clearfix ul-li">
							<ul id="m-main-nav" class="nav navbar-nav clearfix">
								
								<li><a href="{{ route('landing_page') }}" target="_blank">Home</a></li>
								
							</ul>
						</nav>
						<div class="bi-mobile-header-social text-center">
							<a href="#"> <i class="fab fa-instagram"></i></a>
							<a href="#"> <i class="fab fa-linkedin-in"></i></a>
							<a href="#"> <i class="fab fa-facebook"></i></a>
							<a href="#"> <i class="fab fa-youtube"></i></a>
						</div>
					</div>
				</div>
				<!-- /Mobile-Menu -->
			</div>
		</div>
	</header>
	<!-- Sidebar sidebar Item -->
	<div class="xs-sidebar-group info-group">
		<div class="xs-overlay xs-bg-black">
			<div class="row loader-area">
				<div class="col-3 preloader-wrap">
					<div class="loader-bg"></div>
				</div>
				<div class="col-3 preloader-wrap">
					<div class="loader-bg"></div>
				</div>
				<div class="col-3 preloader-wrap">
					<div class="loader-bg"></div>
				</div>
				<div class="col-3 preloader-wrap">
					<div class="loader-bg"></div>
				</div>
			</div>
		</div>
		
	</div>
	<!-- sidebar cart start -->
	
<!-- End of header section
	============================================= -->


<!-- Start of breadcrumb section
	============================================= -->
	<section id="bi-breadcrumbs" class="bi-bredcrumbs-section position-relative" data-background="{{ asset('assets/img/contact-bg.jpg')}}">
		<div class="background_overlay"></div>
		<div class="container">
			<div class="bi-breadcrumbs-content headline ul-li text-center">
				<h2>Contact</h2>
				<ul>
					<li><a href="{{ route('landing_page') }}">Home</a></li>
					<li>Contact</li>
				</ul>
			</div>
		</div>
	</section>	
<!-- Start of breadcrumb section
	============================================= -->

<!-- Start of contact info section
	============================================= -->
	<section id="bi-contact-info" class="bi-contact-info-section inner-page-padding">
		<div class="container">
			<div class="bi-contact-info-content">
				<div class="row justify-content-center">
					<div class="col-lg-4 col-md-6">
						<div class="bi-contact-info-item position-relative">
							<span class="info-bg position-absolute" data-background="{{ asset('assets/img/contact-img.png')}}"></span>
							<div class="inner-icon d-flex justify-content-center align-items-center">
								<img src="{{ asset('assets/img/icon/ci2.png')}}" alt="">
							</div>
							<div class="inner-text headline pera-content">
								<h3>Email Address</h3>
								<a href="#">enquires@raysuncapital.com</a>
								<a href="#">info@raysuncapital.com</a>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6">
						<div class="bi-contact-info-item position-relative">
							<span class="info-bg position-absolute" data-background="{{ asset('assets/img/contact-img.png')}}"></span>
							<div class="inner-icon d-flex justify-content-center align-items-center">
								<img src="{{ asset('assets/img/icon/ci1.png')}}" alt="">
							</div>
							<div class="inner-text headline pera-content">
								<h3>Phone Number</h3>
								<a href="#">+263 77 630 0500</a>
								<a href="#">+263 8677 008143</a>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6">
						<div class="bi-contact-info-item position-relative">
							<span class="info-bg position-absolute" data-background="{{ asset('assets/img/contact-img.png')}}"></span>
							<div class="inner-icon d-flex justify-content-center align-items-center">
								<img src="{{ asset('assets/img/icon/ci3.png')}}" alt="">
							</div>
							<div class="inner-text headline pera-content">
								<h3>Location / Address</h3>
								<a href="#">20 Ray Amm Rd, Eastlea, </a>
								<a href="#"> Harare Zimbabwe</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>	
<!-- End of contact info section
	============================================= -->

<!-- Start of contact Form section
	============================================= -->
	<section id="bi-contact-form" class="bi-contact-form-section">
		<div class="bi-contact-map">
			<div class="bi-contact-map-content d-flex flex-wrap">
				<div class="google-map">
					<iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3798.1780994893247!2d31.09453577517524!3d-17.830284083134362!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMTfCsDQ5JzQ5LjAiUyAzMcKwMDUnNDkuNiJF!5e0!3m2!1sen!2szw!4v1711423334624!5m2!1sen!2szw" width="750" height="640" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
			</div>
			<div class="bi-team-details-contact-info headline pera-content">
				<div class="bi-team-details-contact-title">
					<div class="bi-section-title-1 headline pera-content">
						<div class="bi-subtitle text-uppercase wow fadeInRight"  data-wow-delay="200ms" data-wow-duration="1000ms">
							Welcome {{ env('APP_NAME') }}
						</div>
						<h2 class="headline-title">
							Connect With Our Team and Get Assistance and Clarity
						</h2>
					</div>
					<p>Thank you for considering Freyt365 as your partner in achieving trucking business growth. We're excited to hear from you and provide the support you need to thrive in the transportation industry. Feel free to reach out through any of the following channels.</p>
					<div class="bi-team-details-contact-form">
						<form action="sendmail.php" method="post">
							<div class="row">
								<div class="col-md-6">
									<input type="text" name="name" placeholder="First Name">
								</div>
								<div class="col-md-6">
									<input type="text" name="Email" placeholder="Email">
								</div>
								<div class="col-md-6">
									<input type="text" name="phone" placeholder="Phone No.">
								</div>
								<div class="col-md-6">
									<input type="text" name="subject" placeholder="Subject">
								</div>
								<div class="col-md-12">
									<textarea name="message" placeholder="Your Message"></textarea>
								</div>
								<div class="col-md-12">
									<div class="bi-submit-btn">
										<button type="submit">Send messages</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>		
<!-- End of  contact Form section
	============================================= -->	


<!-- Start of Footer  section
	============================================= -->
	<footer id="bi-footer" class="bi-footer-section" data-background="{{ asset('assets/img/bg/footer-bg.jpg')}}">
		<div class="bi-footer-cta position-relative">
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
<!-- End of Footer  section
	============================================= -->	

	
	<!-- For Js Library -->
@endsection		