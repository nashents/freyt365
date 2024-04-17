@extends('website.layouts.app')

@section('title')
	Landing Page 
@endsection

@section('body')
<body class="home-3">
@endsection

@section('content')
	


<!-- Start of header section
	============================================= -->
	@include('website.includes.header')
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
		<div class="xs-sidebar-widget"  data-background={{asset('assets/img/bg/texture.png')}}>
			<div class="sidebar-widget-container">
				<div class="widget-heading">
					<a href="#" class="close-side-widget text-uppercase">
						<i class="fal fa-times"></i> Close
					</a>
				</div>
				<div class="sidebar-textwidget">
					<!-- Sidebar Info Content -->
					<div class="sidebar-info-contents headline pera-content">
						<div class="content-inner">
							<div class="sidebar-logo">
								<a href="#"><img src={{asset('assets/img/logo/logo2.png')}} alt=""></a>
							</div>
							<div class="sidebar-menu ul-li-block">
								<ul>
									{{-- <li><a href="#"><i class="fal fa-home"></i> About Us </a></li>
									<li><a href="#"><i class="fal fa-cogs"></i> Service </a></li>
									<li><a href="#"><i class="fal fa-comments-alt"></i> Testimonial </a></li>
									<li><a href="#"><i class="fal fa-users"></i> Our Team </a></li>
									<li><a href="#"><i class="fal fa-blog"></i> News & Updates </a></li> --}}
									<li><a href="{{ route('contact_us') }}"><i class="fal fa-envelope"></i> Contact </a></li>
								</ul>
							</div>
							<div class="sidebar-more-menu text-uppercase d-flex ul-li">
								<span>More:</span>
								<ul>
									<li><a href="{{ route('login') }}">My Account </a></li>
								</ul> 
							</div>
							<div class="sidebar-social ul-li-block">
								<span>Social:</span>
								<ul>
									<li><a href="#"><i class="fab fa-facebook-f"></i> Facebook</a></li>
									<li><a href="#"><i class="fab fa-twitter"></i> Twitter</a></li>
									<li><a href="#"><i class="fab fa-instagram"></i> Instagram</a></li>
								</ul>
							</div>
							<div class="sidebar-copyright text-center">
								© Copyright {{ date('Y') }}. All Rights Reserved. 
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- sidebar cart start -->
	
	
<!-- End of header section
	============================================= -->
	<div data-bs-spy="scroll" data-bs-target=".main-navigation"  data-bs-smooth-scroll="true">
<!-- Start of Slider section
	============================================= -->
	<section id="bi-slider-3" class="bi-slider-section-3" data-background={{asset('assets/img/bg/slider-bg.png')}}>
		<div class="bi-slider-content-3 position-relative">
			<span class="slider_shape shape_1 position-absolute" data-parallax='{"y" : -60}'><img src={{asset('assets/img/icon/shape_1.png')}} alt=""></span>
			<span class="slider_shape shape_2 position-absolute"><img src={{asset('assets/img/icon/shape_2.png')}} alt=""></span>
			<span class="slider_shape shape_3 position-absolute"><img src={{asset('assets/img/icon/shape_3.png')}} alt=""></span>
			<span class="slider_shape shape_4 position-absolute"><img src={{asset('assets/img/icon/shape_4.png')}} alt=""></span>
			<span class="slider_shape shape_5 position-absolute" data-parallax='{"y" : 60, "rotateY":800}'><img src={{asset('assets/img/icon/shape_5.png')}} alt=""></span>
			<div class="bi-slider-social position-absolute">
				<span>Social Media</span>
				<a href="#"><i class="fab fa-facebook"></i></a>
				<a href="#"><i class="fab fa-twitter"></i></a>
				<a href="#"><i class="fab fa-youtube"></i></a>
				<a href="#"><i class="fab fa-pinterest"></i></a>
			</div>
			<div class="bi-slider-wrapper-3">
				<div class="swiper-wrapper">
					<div class="swiper-slide">
						<div class="bi-slider-item-3 position-relative">
							<div class="bi-slider-img3_1 position-absolute"><img src={{asset('assets/img/slider-1.jpg')}} alt=""></div>
							<div class="bi-slider-img3_2 position-absolute"><img src={{asset('assets/img/slider-1.jpg')}} alt=""></div>
							<div class="container">
								<div class="bi-slider-text-3 headline pera-content">
									<div class="slider-sub-title text-uppercase">Welcome Freyt365</div>
									<h1>
										<span style="font-size: 85%" >Empowering</span>
										 Trucking Businesses 
									</h1>
									<div class="slider-img-desc d-flex align-items-center">
										<div class="inner-img">
											<img src={{asset('assets/img/slider-1.jpg')}} alt="">
										</div>
										<div class="inner-text">
											Streamlined Funding Solutions and Financial Management Tools for Truckers.
										</div>
									</div>
									<div class="slider-btn-grp d-flex align-items-center">
										<div class="bi-btn-3 text-uppercase">
											<a href="{{ route('contact_us') }}">get Started <img src="{{ asset('assets/img/icon/arrow.svg') }}" alt=""></a>
										</div>
										<div class="bi-slider-video-play">
											<a class="d-flex align-items-center video_box" href="https://www.youtube.com/watch?v=Nv7RgGpu6ME"><i class="fal fa-play-circle"></i> Watch Video</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
				</div>
			</div>
			<div class="bi-main-arrow-next-prev position-absolute d-flex align-items-center justify-content-center">
				<span class="arrow-bg-zooming position-absolute"><img src={{asset('assets/img/bg/arrow-bg.jpg')}} alt=""></span>
				<div class="bi-slider-arrow d-flex justify-content-center align-items-center bi-main-button-prev_3"><i class="fal fa-long-arrow-up"></i></div>
				<div class="swiper-paginations text-center"></div>
				<div class="bi-slider-arrow d-flex justify-content-center align-items-center bi-main-button-next_3"><i class="fal fa-long-arrow-down"></i></div>
			</div>
		</div>
	</section>	
<!-- End of Slider section
	============================================= -->

<!-- Start of What We offer section
	============================================= -->
	<section id="bi-what-we-offer" class="bi-what-we-offer-section position-relative">
		<span class="bi-shape-anim anim_1 position-absolute"><img src={{asset('assets/img/icon/is1.png')}} alt=""></span>
		<span class="bi-shape-anim anim_2 position-absolute" ><img src={{asset('assets/img/icon/is2.png')}} alt=""></span>
		<span class="bi-shape-anim anim_3 position-absolute" data-parallax='{"y" : 60}'><img src={{asset('assets/img/icon/is3.png')}} alt=""></span>
		<span class="bi-shape-anim anim_4 position-absolute" data-parallax='{"y" : 60, "rotateY":800}'><img src={{asset('assets/img/icon/is4.png')}} alt=""></span>
		<div class="container">
			<div class="bi-what-we-offer-top-content d-flex flex-wrap justify-content-between align-items-end">
				<div class="bi-section-title-3 headline">
					<div class="bi-subtitle text-uppercase wow fadeInRight"  data-wow-delay="200ms" data-wow-duration="1500ms">
						WHAT WE OFFER
					</div>
					<h2 class="tx-split-text split-in-right">Unlock Revenue 
					Growth for your Business</h2>
				</div>
				@if ($services->count()>0)
				<div class="bi-btn-3 text-uppercase wow fadeInRight"  data-wow-delay="300ms" data-wow-duration="1000ms">
					<a href="#">See all <img src={{asset('assets/img/icon/arrow.svg')}} alt=""></a>
				</div>
				@endif
				
			</div>
			<div class="bi-what-we-offer-content">
				@foreach ($services as $service)
					<div class="bi-what-we-offer-item d-flex justify-content-between align-items-center wow fadeInUp"  data-wow-delay="300ms" data-wow-duration="1500ms">
						<div class="bi-what-we-offer-img-title d-flex align-items-center">
							<div class="offer-img">
								<img src={{asset('assets/img/about/of1.png')}} alt="">
							</div>
							<div class="offer-title text-capitalize headline">
								<h3><a href="{{ route('services.show',$service->id) }}">{{ $service->title }}</a></h3>
							</div>
						</div>
						<div class="bi-what-we-offer-desc">
							{{ $service->body }}
						</div>
						<div class="offer-btn text-uppercase">
							<a href="{{ route('services.show',$service->id) }}">Read more</a>
						</div>
					</div>
				@endforeach
	
			
			</div>
		</div>
	</section>		
<!-- End of What We offer section
	============================================= -->

<!-- Start of About section
	============================================= -->
	<section id="bi-about-3" class="bi-about-section-3 position-relative">
		<span class="bi-shape-anim anim_1 position-absolute"><img src={{asset('assets/img/icon/is5.png')}} alt=""></span>
		<span class="bi-shape-anim anim_2 position-absolute" data-parallax='{"y" : -60, "rotateY":800}'><img src={{asset('assets/img/icon/is6.png')}} alt=""></span>
		<span class="bi-shape-anim anim_3 position-absolute" data-parallax='{"y" : 60, "rotateY": -800}'><img src={{asset('assets/img/icon/is7.png')}} alt=""></span>
		<div class="container">
			<div class="bi-about-content-3">
				<div class="row">
					<div class="col-lg-5">
						<div class="bi-about-text-area-3">
							<div class="bi-section-title-3 headline pera-content">
								<div class="bi-subtitle text-uppercase wow fadeInRight"  data-wow-delay="200ms" data-wow-duration="1000ms">
									WHAT WE OFFER
								</div>
								<h3 class="tx-split-text split-in-right">Your Trusted Partner In Archiving Trucking Business Excellence</h3>
								<div class="bins-text">
									<p>
										Welcome to Freyt365, a subsidiary of Raysun Capital. Our mission is to provide truckers like you with easy access to funding and innovative financial management tools. With a dedication to trust, innovation, speed, and reliability, we stand as unwavering allies in your pursuit of success in the competitive transportation industry. We understand the challenges you face and are committed to making your journey smoother
									</p>
								</div>
							</div>
							<div class="bi-abut-feature-list ul-li wow fadeInUp"  data-wow-delay="300ms" data-wow-duration="1000ms">
								<ul>
									<li><i class="fal fa-users"></i> Dedicated Team</li>
									<li><i class="fal fa-cogs"></i> Clean Setup</li>
									<li><i class="fal fa-user-headset"></i> 24/7  Support</li>
									<li><i class="fal fa-award"></i> Winning Award</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-lg-7">
						<div class="bi-about-img-3  position-relative">
							<div class="about-img bi-img-animation">
								<img src={{asset('assets/img/about-bg.jpg')}} alt="">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="bi-about-video-play-area position-relative">
				<div class="bi-about-exp-area position-absolute headline text-center wow zoomIn"  data-wow-delay="500ms" data-wow-duration="1500ms" data-background={{asset('assets/img/bg/exp-bg.png')}}>
					<h3>7</h3>
					<span>Years Of Working
					Experiance</span>
				</div>
				<div class="row">
					<div class="col-lg-6">
						<div class="bi-about-video-play position-relative  bi-img-animation">
							<div class="video-play-btn position-absolute">
								<a class="video_box justify-content-center  align-items-center d-flex" href="https://www.youtube.com/watch?v=Nv7RgGpu6ME"><i class="fas fa-play"></i></a>
								<span class="video_btn_border border_wrap-1"></span>
								<span class="video_btn_border border_wrap-2"></span>
								<span class="video_btn_border border_wrap-3"></span>
							</div>
							<div class="video-play-img">
								<img src={{asset('assets/img/feedback.jpg')}} alt="">
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="bi-about-text-quote-area bins-text headline pera-content">
							<p>“This is a platform all tranporters should use. We have been using the platform for our regional transactions for a year now, never looked back eversince.” </p>
							<div class="quote-author text-uppercase wow fadeInUp"  data-wow-delay="300ms" data-wow-duration="1500ms">
								<h3>Farai Munyawarara</h3>
								<span>Executive Director OF (FBM Haulage)</span>
							</div>
							<div class="bi-btn-3 text-uppercase wow fadeInUp"  data-wow-delay="400ms" data-wow-duration="1500ms">
								{{-- <a href="about.html">Learn More <img src={{asset('assets/img/icon/arrow.svg')}} alt=""></a> --}}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<!-- End of About section
	============================================= -->

<!-- Start of Team section
	============================================= -->
	<section id="bi-team-3" class="bi-team-section-3 position-relative">
		<span class="bi-shape-anim anim_1 position-absolute"><img src={{asset('assets/img/icon/is8.png')}} alt=""></span>
		<span class="bi-shape-anim anim_2 position-absolute"><img src={{asset('assets/img/icon/is9.png')}} alt=""></span>
		<div class="container">
			<div class="bi-section-title-3 text-center headline pera-content">
				<div class="bi-subtitle text-uppercase wow fadeInRight"  data-wow-delay="200ms" data-wow-duration="1500ms">
					our Team members
				</div>
				<h2 class="headline-title">Our Experiences Team</h2>
			</div>
		</div>
		<div class="bi-team-slider-content-3 d-flex justify-content-end">
			<div class="bi-team-slider-3 swiper-container">
				<div class="swiper-wrapper">
					@foreach ($teams as $team)
					<div class="swiper-slide">
						<div class="bi-team-item-3 text-center">
							<div class="bi-team-img-social position-relative">
								<img src={{asset('assets/img/team/tm3.1.jpg')}} alt="">
								<div class="team-social position-absolute">
									<a href="#"><i class="fab fa-facebook"></i></a>
									<a href="#"><i class="fab fa-twitter"></i></a>
									<a href="#"><i class="fab fa-youtube"></i></a>
								</div>
							</div>
							<div class="bi-team-text headline text-uppercase">
								<h3><a href="{{ route('teams.show',$team->id) }}">{{ $team->name }} {{ $team->surname }}</a></h3>
								<span>{{ $team->position }}</span>
							</div>
						</div>
					</div>
					@endforeach
					
				
				</div>
			</div>
		</div>
		@if ($teams->count()>0)
		<div class="bi-team-pagination-carousel-area">
			<div class="container">
				<div class="bi-team-pagination-carousel d-flex justify-content-between align-items-center">
					<div class="swiper-team-paginations"></div>
					<div class="bi-team-carousel d-flex">
						<div class="bi-slider-arrow d-flex justify-content-center align-items-center bi-team-button-prev_3"><i class="fal fa-long-arrow-left"></i></div>
						<div class="bi-slider-arrow d-flex justify-content-center align-items-center bi-team-button-next_3"><i class="fal fa-long-arrow-right"></i></div>
					</div>
				</div>
			</div>
		</div>
		@endif
		
	</section>		
<!-- End of Team section
	============================================= -->

<!-- Start of Pricing section
	============================================= -->
	
<!-- End of Pricing section
	============================================= -->	

<!-- Start of Testimoial section
	============================================= -->
	<section id="bi-testimonial-3" class="bi-testimonial-section-3 position-relative">
		<span class="bi-shape-anim anim_1 position-absolute"><img src={{asset('assets/img/icon/is13.png')}} alt=""></span>
		<div class="container">
			<div class="bi-section-title-3 text-center headline pera-content">
				<div class="bi-subtitle text-uppercase wow fadeInRight"  data-wow-delay="200ms" data-wow-duration="1500ms">
					Testimonials
				</div>
				<h2 class="headline-title">What Our Clients Say
				About Us</h2>
			</div>
		</div>
		<div class="bi-testimonial-content-3 d-flex justify-content-end position-relative">
			<span class="testimonial-circle position-absolute"></span>
			<div class="bi-testimonial-slider-3 swiper-container">
				<div class="swiper-wrapper">
					@foreach ($testimonials as $testimonial)
						<div class="swiper-slide">
							<div class="bi-testimonial-item-3 position-relative">
								<span class="quote-icon position-absolute"><img src={{asset('assets/img/icon/qt2.png')}} alt=""></span>
								<div class="testimonial-text">
									“{{ $testimonial->message }}” 
								</div>
								<div class="testimonial-author headline text-uppercase">
									<h3>{{ $testimonial->author }}</h3>
									<span>{{ $testimonial->position }}</span>
								</div>
								<div class="testimonial-img position-absolute">
									<img src={{asset('assets/img/team/tm3.1.jpg')}} alt="">
								</div>
							</div>
						</div>
					@endforeach
					
			
				</div>
			</div>
		</div>
		<div class="bins-dot-carousel swiper-testi-paginations text-center"></div>
	</section>
<!-- End of Testimoial section
	============================================= -->

<!-- Start of Portfolio section
	============================================= -->

<!-- End of Portfolio section
	============================================= -->

<!-- Start of sponsor section
	============================================= -->
	<section id="bi-sponsor-3" class="bi-sponsor-section-3 position-relative">
		<span class="sponsor-bg position-absolute"><img src={{asset('assets/img/blog-bg.jpg')}} alt=""></span>
		<div class="bi-sponsor-slider-3 swiper-container">
			<div class="swiper-wrapper">
				@foreach ($partners as $partner)
				<div class="swiper-slide">
					<div class="slider-img">
						<img src={{asset('assets/img/uploads/'.$partner->filename)}} alt="">
					</div>
				</div>
				@endforeach

			</div>
		</div>
	</section>		
<!-- End of sponsor section
	============================================= -->

<!-- Start of Blog section
	============================================= -->
	<section id="bi-blog-3" class="bi-blog-section-3 position-relative" data-background={{asset('assets/img/bg/blog-bg.png')}}>
		<span class="bi-shape-anim anim_1 position-absolute"><img src={{asset('assets/img/icon/is14.png')}} alt=""></span>
		<span class="bi-shape-anim anim_2 position-absolute"><img src={{asset('assets/img/icon/is15.png')}} alt=""></span>
		<div class="container">
			<div class="bi-section-title-3  headline text-center pera-content">
				<div class="bi-subtitle text-centert text-uppercase wow fadeInRight"  data-wow-delay="200ms" data-wow-duration="1500ms">
					News & Updates
				</div>
				<h2 class="headline-title">Updates From the Freyt365</h2>
			</div>
			<div class="bi-blog-content-3">
				<div class="bi-blog-slider-3 swiper-container">
					<div class="swiper-wrapper">
						@foreach ($posts as $post)
						<div class="swiper-slide">
							<div class="bi-blog-item-3 headline pera-content position-relative" data-background={{asset('assets/img/uploads/'.$post->filename)}}>
								<div class="bi-blog-author d-flex align-items-center">
									<div class="inner-img">
										<img src={{asset('assets/img/blog/ba1.jpg')}} alt="">
									</div>
									<div class="inner-text">
										<span>Writen by</span>
										<h3>{{ $post->user ? $post->user->name : "" }} {{ $post->user ? $post->user->surname : "" }}</h3>
									</div>
								</div>
								<div class="bi-blog-text">
									<div class="blog-meta text-uppercase">
										<i class="fas fa-calendar-alt"></i> {{ $post->created_at }}
									</div>
									<h3><a href="{{ route('posts.show',$post->id) }}">{{ $post->title }}</a></h3>
									<p>{{ $post->body }}</p>
								</div>
								<a class="more_btn d-flex justify-content-between align-items-center position-absolute text-uppercase" href="blog-single.html">Learn More <i class="fal fa-long-arrow-right"></i></a>
							</div>
						</div>
						@endforeach
				
					
					</div>
				</div>
				<div class="bins-dot-carousel swiper-blog-paginations text-center"></div>
			</div>
		</div>
	</section>		
<!-- End of Blog section
	============================================= -->	

<!-- Start of Footer  section
	============================================= -->
	@include('website.includes.footer')
<!-- End of Footer  section
	============================================= -->		
</div>


<!-- For Js Library -->
	

@endsection