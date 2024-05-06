@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('content')
    
            <!-- ========== Topbar Start ========== -->
            @include('includes.navbar')
            <!-- ========== Topbar End ========== -->
            

            <!-- ========== Left Sidebar Start ========== -->
            @include('includes.sidebar')
            <!-- ========== Left Sidebar End ========== -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    @livewire('dashboard.index')
                    <!-- container -->

                </div>
                <!-- content -->

                <!-- Footer Start -->
                    @include('includes.footer')
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

        </div>
        <!-- END wrapper -->

        <!-- Theme Settings -->
        @include('includes.theme-settings')        
        
       


@endsection