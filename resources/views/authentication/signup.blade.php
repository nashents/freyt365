@extends('layouts.auth')
@section('title')
    Signup
@endsection

@section('body')
<body class="authentication-bg">
@endsection

@section('content')
    
    <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5 position-relative">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-8 col-lg-10">
                    <div class="card overflow-hidden bg-opacity-25">
                        <div class="row g-0">
                            {{-- <div class="col-lg-6 d-none d-lg-block p-2">
                                <img src="{{ asset('images/auth.jpg')}}" alt="" class="img-fluid rounded h-100">
                            </div> --}}
                            <div class="d-flex flex-column h-100">
                                <div class="auth-brand p-4">
                                    <center>
                                        <a href="#" class="logo-light">
                                            <img src="{{ asset('images/logo-2.png')}}" alt="logo" style="width: 40%; height:40%">
                                        </a>
                                        <a href="#" class="logo-dark">
                                            <img src="{{ asset('images/logo-2.png')}}" style="width: 40%; height:40%" alt="dark logo" >
                                        </a>
                                    </center>
                                   
                                </div>
                                <div class="p-4 my-auto">
                                    <h4 class="fs-20">Freyt365 Sign Up</h4>
                                    <p class="text-muted mb-3">Enter your email address and password to access
                                        account.</p>
                                    <!-- form -->
                                    <div>
                                        @include('includes.messages')
                                   </div>
                                    @livewire('authentication.signup')
                                    <!-- end form-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <p class="text-dark-emphasis">Already have account? <a href="{{ route('login') }}"
                            class="text-dark fw-bold ms-1 link-offset-3 text-decoration-underline"><b>Log In</b></a>
                    </p>
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

  @include('includes.auth-footer')

@endsection