<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>@yield('title') | {{ env('APP_NAME') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully responsive admin theme which can be used to build CRM, CMS,ERP etc." name="description" />
    <meta content="Techzaa" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('ico.png')}}">

    <!-- Theme Config Js -->
    <script src="{{ asset('js/config.js')}}"></script>
     {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
   
     <script src="https://kit.fontawesome.com/0154e08647.js" crossorigin="anonymous"></script>
    <!-- App css -->
    <link href="{{ asset('css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="{{ asset('css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    @stack('styles')
</head>
@yield('body')
@yield('content')

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

<script src="{{asset('js/pages/profile.init.js')}}"></script>

{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> --}}


<script src="{{asset('assets/vendor/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/vendor/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/vendor/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/vendor/datatables.net-fixedcolumns-bs5/js/fixedColumns.bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/vendor/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}"></script>
<script src="{{asset('assets/vendor/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/vendor/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/vendor/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/vendor/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
<script src="{{asset('assets/vendor/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('assets/vendor/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
<script src="{{asset('assets/vendor/datatables.net-select/js/dataTables.select.min.js')}}"></script>
<script src="{{asset('assets/js/pages/datatable.init.js')}}"></script>

<script>
    $(function(){

        // Counter for dashboard stats
        $('.counter').counterUp({
            delay: 10,
            time: 1000
        });
    });
</script>

<script>
    $(".alert").fadeTo(2000, 1000).slideUp(1000, function(){
    $(".alert").slideUp(1000);
    });
</script>

@yield('timeout-js')
@yield('extra-js')
@stack('scripts')

<script src="{{ asset('js/vendor.min.js')}}"></script>

    <!-- App js -->
    <script src="{{ asset('js/app.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>