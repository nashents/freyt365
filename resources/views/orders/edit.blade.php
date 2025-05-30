@extends('layouts.app')

@section('title')
    Orders 
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
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                                        <li class="breadcrumb-item" active><a href="{{route('orders.index')}}">Orders</a></li>
                                    </ol>
                                </div>
                                <h4 class="page-title">Edit Order</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    @livewire('orders.edit',['id' => $order->id])

                </div> <!-- container -->

            </div> <!-- content -->

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

