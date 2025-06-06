@extends('layouts.auth')

@section('title')
    Login
@endsection

@section('body')
<body class="authentication-bg position-relative">
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
                                        <h4 class="fs-20">Sign In</h4>
                                        <p class="text-muted mb-3">Enter your username and password to login.
                                        </p>
                                        <div>
                                            @include('includes.messages')
                                       </div>
                                        <!-- form -->
                                        <form action="{{route('postLogin')}}" method="POST">
                                            {{ csrf_field() }}
                                            <div class="mb-3">
                                                <label for="emailaddress" class="form-label">Username</label>
                                                <input class="form-control" type="text" name="username" id="emailaddress" required=""
                                                   >
                                            </div>
                                            <div class="mb-3">
                                                <a href="{{route('password.request')}}" class="text-muted float-end"><small>Forgot
                                                        your
                                                        password?</small></a>
                                                <label for="password" class="form-label">Password</label>
                                                <input class="form-control" name="password" type="password" required="" id="password"
                                                   >
                                            </div>
                                            {{-- <div class="mb-3">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input"
                                                        id="checkbox-signin">
                                                    <label class="form-check-label" for="checkbox-signin">Remember
                                                        me</label>
                                                </div>
                                            </div> --}}
                                            <div class="mb-0 text-start">
                                                <button class="btn btn-soft-primary w-100" type="submit"><i
                                                        class="ri-login-circle-fill me-1"></i> <span class="fw-bold">Log
                                                        In</span> </button>
                                            </div>

                                            
                                        </form>
                                        <!-- end form-->
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
                    <p class="text-dark-emphasis">Don't have an account? <a href="{{ route('signup') }}"
                            class="text-dark fw-bold ms-1 link-offset-3 text-decoration-underline"><b>Sign up</b></a>
                    </p>
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

   @include('includes.auth-footer')
    <!-- Vendor js -->
    

@endsection