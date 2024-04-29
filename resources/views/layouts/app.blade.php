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

        {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}


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

        <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.min.css" rel="stylesheet">
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

 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js"></script>

 <script>
     const Toast = Swal.mixin({
         toast: true,
         position: 'top',
         showConfirmButton: false,
         showCloseButton: true,
         timer: 10000,
         timerProgressBar:true,
         didOpen: (toast) => {
             toast.addEventListener('mouseenter', Swal.stopTimer)
             toast.addEventListener('mouseleave', Swal.resumeTimer)
         }
     });

     window.addEventListener('alert',({detail:{type,message}})=>{
         Toast.fire({
             icon:type,
             title:message
         })
     })
 </script>

 <script type="text/javascript">
    window.addEventListener('show-bank_accountModal', event => {
        $('#bank_accountModal').modal('show');
    })
</script>

 <script type="text/javascript">
    window.addEventListener('hide-bank_accountModal', event => {
        $('#bank_accountModal').modal('hide');
    })
</script>

<script type="text/javascript">
    window.addEventListener('show-bank_accountEditModal', event => {
        $('#bank_accountEditModal').modal('show');
    })
</script>

<script type="text/javascript">
    window.addEventListener('hide-bank_accountEditModal', event => {
        $('#bank_accountEditModal').modal('hide');
    })
</script>

 @livewireScripts

 <script>
    $(function(){

        // Counter for dashboard stats
        $('.counter').counterUp({
            delay: 10,
            time: 1000
        });
    });
</script>
@yield('timeout-js')
@yield('extra-js')

</body>
</html> 