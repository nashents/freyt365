@extends('layouts.auth')

@section('title')
    Forgot Password
@endsection

@section('body')
<body class="authentication-bg">
@endsection

@section('content')
<div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5 position-relative">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxl-8 col-lg-10">
                <div class="card overflow-hidden">
                <div class="row g-0">
                    <div class="col-lg-6 d-none d-lg-block p-2">
                        <img src="{{ asset('images/auth.jpg')}}" alt="" class="img-fluid rounded h-100">
                    </div>
                        <div class="col-lg-6">
                            <div class="d-flex flex-column h-100">
                                <div class="auth-brand p-4">
                                    <a href="{{route('login')}}" class="logo-light">
                                        <img src="{{ asset('images/logo-2.png')}}" alt="logo" height="22">
                                    </a>
                                    <a href="{{route('login')}}" class="logo-dark">
                                        <img src="{{ asset('images/logo-2.png')}}" style="width:75%; height:75%" alt="dark logo" height="22">
                                    </a>
                                </div>
                                <div class="p-4 my-auto">
                                    <h4 class="fs-20">Forgot Password?</h4>
                                    <p class="text-muted mb-3">Enter your email address and we'll send you an email with instructions to reset your password.</p>
                                    <div>
                                        @include('includes.messages')
                                   </div>
                                    @livewire('authentication.forgot-password')

                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <p class="text-dark-emphasis">Back To <a href="{{route('login')}}" class="text-dark fw-bold ms-1 link-offset-3 text-decoration-underline"><b>Log In</b></a></p>
            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
<!-- end page -->

@include('includes.auth-footer')
@endsection
    