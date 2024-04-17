<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>@yield('title') | {{ env('APP_NAME') }}</title>
	<meta name="description" content="Haptic - Web And Agency HTML Template">
	<meta name="keywords" content="agency, app, business, company, corporate, designer, freelance, fullpage, modern, office, personal, portfolio, professional, web, web agency">
	<meta name="author" content="Themexriver">
    <link rel="shortcut icon" href="{{ asset('ico.png')}}">
	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css')}}">
	<link rel="stylesheet" href="{{ asset('assets/css/animate.css')}}">
	<link rel="stylesheet" href="{{ asset('assets/css/global.css')}}">
	<link rel="stylesheet" href="{{ asset('assets/css/swiper.min.css')}}">
	<link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css')}}">
	<link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">

    @livewireStyles
</head>
@yield('body')

	<div id="preloader"></div>
	<div class="up">
		<a href="#" class="scrollup text-center"><i class="fas fa-chevron-up"></i></a>
	</div>
	<div class="cursor"></div>

    @yield('content')

    <script src="{{ asset('assets/js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('assets/js/swiper-bundle.min.js')}}"></script>
    <script src="{{ asset('assets/js/appear.js')}}"></script>
    <script src="{{ asset('assets/js/counter.js')}}"></script>
    <script src="{{ asset('assets/js/gsap.min.js')}}"></script>
    <script src="{{ asset('assets/js/knob.js')}}"></script>
    <script src="{{ asset('assets/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{ asset('assets/js/jquery.counterup.min.js')}}"></script>
    <script src="{{ asset('assets/js/waypoints.min.js')}}"></script>
    <script src="{{ asset('assets/js/parallax.min.js')}}"></script>
    <script src="{{ asset('assets/js/ScrollTrigger.min.js')}}"></script>
    <script src="{{ asset('assets/js/ScrollToPlugin.min.js')}}"></script>
    <script src="{{ asset('assets/js/ScrollSmoother.min.js')}}"></script>
    <script src="{{ asset('assets/js/SplitText.min.js')}}"></script>
    <script src="{{ asset('assets/js/jquery.filterizr.js')}}"></script>
    <script src="{{ asset('assets/js/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{ asset('assets/js/hover-revel.js')}}"></script>
    <script src="{{ asset('assets/js/split-type.min.js')}}"></script>
    <script src="{{ asset('assets/js/parallax-scroll.js')}}"></script>
    <script src="{{ asset('assets/js/jquery.marquee.min.js')}}"></script>
    <script src="{{ asset('assets/js/wow.min.js')}}"></script>
    <script src="{{ asset('assets/js/jquery.meanmenu.min.js')}}"></script>
    <script src="{{ asset('assets/js/tilt.jquery.min.js')}}"></script>
    <script src="{{ asset('assets/js/matter.min.js')}}"></script>
    <script src="{{ asset('assets/js/script.js')}}"></script>
    @livewireScripts
    </body>
    </html>	