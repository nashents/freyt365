<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>@yield('title') | {{env('APP_NAME')}}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully responsive admin theme which can be used to build CRM, CMS,ERP etc." name="description" />
        <meta content="Techzaa" name="author" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('ico.png')}}">

        <!-- Daterangepicker css -->
        <link rel="stylesheet" href="{{ asset('vendor/daterangepicker/daterangepicker.css')}}">

        <!-- Vector Map css -->
        <link rel="stylesheet" href="{{ asset('vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css')}}">

        <!-- Theme Config Js -->
        <script src="{{ asset('js/config.js')}}"></script>

        <!-- App css -->
        <link href="{{ asset('css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-style" />

        <!-- Icons css -->
        <link href="{{ asset('css/icons.min.css')}}" rel="stylesheet" type="text/css" />

       
        <!-- Icons css -->
        
        <link href="{{ asset( 'assets/vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset( 'assets/vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css')}}" rel="stylesheet"
            type="text/css" />
        <link href="{{ asset( 'assets/vendor/datatables.net-fixedcolumns-bs5/css/fixedColumns.bootstrap5.min.css')}}" rel="stylesheet"
            type="text/css" />
        <link href="{{ asset( 'assets/vendor/datatables.net-fixedheader-bs5/css/fixedHeader.bootstrap5.min.css')}}" rel="stylesheet"
            type="text/css" />
        <link href="{{ asset( 'assets/vendor/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css')}}" rel="stylesheet"
            type="text/css" />
        <link href="{{ asset( 'assets/vendor/datatables.net-select-bs5/css/select.bootstrap5.min.css')}}" rel="stylesheet"
            type="text/css" />

        @yield('extra-css')

        @livewireStyles
    </head>

    <body>
        <!-- Begin page -->
        <div class="wrapper">

            @yield('content')

 <!-- Vendor js -->
 <script src="{{ asset('js/vendor.min.js')}}"></script>

 <!-- Daterangepicker js -->
 <script src="{{ asset('vendor/daterangepicker/moment.min.js')}}"></script>
 <script src="{{ asset('vendor/daterangepicker/daterangepicker.js')}}"></script>
 
 <!-- Apex Charts js -->
 <script src="{{ asset('vendor/apexcharts/apexcharts.min.js')}}"></script>

 <!-- Vector Map js -->
 <script src="{{ asset('vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
 <script src="{{ asset('vendor/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js')}}"></script>

 <!-- Dashboard App js -->
 <script src="{{ asset('js/pages/dashboard.js')}}"></script>

 <!-- App js -->
 <script src="{{ asset('js/app.min.js')}}"></script>


 @livewireScripts

</body>
</html> 