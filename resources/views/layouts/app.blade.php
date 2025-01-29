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
        <script src="https://kit.fontawesome.com/0154e08647.js" crossorigin="anonymous"></script>
       
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
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @yield('extra-css')
       
        @stack('styles')
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

     window.addEventListener('alert',(event) =>{
       let data = event.detail;
        Toast.fire({
            icon: data.type,
            title: data.title,
            });
     })
 </script>




<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('show-documentModal', (event) => {
        $('#documentModal').modal('show');
       });
    });
</script>
<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('hide-documentModal', (event) => {
        $('#documentModal').modal('hide');
       });
    });
</script>
<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('show-folderModal', (event) => {
        $('#folderModal').modal('show');
       });
    });
</script>
<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('hide-folderModal', (event) => {
        $('#folderModal').modal('hide');
       });
    });
</script>


<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('show-transaction_confirmationModal', (event) => {
        $('#transaction_confirmationModal').modal('show');
       });
    });
</script>
<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('hide-transaction_confirmationModal', (event) => {
        $('#transaction_confirmationModal').modal('hide');
       });
    });
</script>

<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('show-walletModal', (event) => {
        $('#walletModal').modal('show');
       });
    });
</script>
<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('hide-walletModal', (event) => {
        $('#walletModal').modal('hide');
       });
    });
</script>
<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('show-walletEditModal', (event) => {
        $('#walletEditModal').modal('show');
       });
    });
</script>
<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('hide-walletEditModal', (event) => {
        $('#walletEditModal').modal('hide');
       });
    });
</script>
<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('show-currencyModal', (event) => {
        $('#currencyModal').modal('show');
       });
    });
</script>

<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('hide-currencyModal', (event) => {
        $('#currencyModal').modal('hide');
       });
    });
</script>

<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('show-currencyEditModal', (event) => {
        $('#currencyEditModal').modal('show');
       });
    });
</script>

<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('hide-currencyEditModal', (event) => {
        $('#currencyEditModal').modal('hide');
       });
    });
</script>

<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('show-verificationModal', (event) => {
        $('#verificationModal').modal('show');
       });
    });
</script>

<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('hide-verificationModal', (event) => {
        $('#verificationModal').modal('hide');
       });
    });
</script>

<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('show-authorizationModal', (event) => {
        $('#authorizationModal').modal('show');
       });
    });
</script>

<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('hide-authorizationModal', (event) => {
        $('#authorizationModal').modal('hide');
       });
    });
</script>

<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('show-officeModal', (event) => {
        $('#officeModal').modal('show');
       });
    });
</script>

<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('hide-officeModal', (event) => {
        $('#officeModal').modal('hide');
       });
    });
</script>

<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('show-officeEditModal', (event) => {
        $('#officeEditModal').modal('show');
       });
    });
</script>

<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('hide-officeEditModal', (event) => {
        $('#officeEditModal').modal('hide');
       });
    });
</script>
<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('show-serviceModal', (event) => {
        $('#serviceModal').modal('show');
       });
    });
</script>

<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('hide-serviceModal', (event) => {
        $('#serviceModal').modal('hide');
       });
    });
</script>

<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('show-serviceEditModal', (event) => {
        $('#serviceEditModal').modal('show');
       });
    });
</script>

<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('hide-serviceEditModal', (event) => {
        $('#serviceEditModal').modal('hide');
       });
    });
</script>

<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('show-transactionModal', (event) => {
        $('#transactionModal').modal('show');
       });
    });
</script>

<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('hide-transactionModal', (event) => {
        $('#transactionModal').modal('hide');
       });
    });
</script>

<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('show-transactionEditModal', (event) => {
        $('#transactionEditModal').modal('show');
       });
    });
</script>

<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('hide-transactionEditModal', (event) => {
        $('#transactionEditModal').modal('hide');
       });
    });
</script>

<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('show-chargeModal', (event) => {
        $('#chargeModal').modal('show');
       });
    });
</script>

<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('hide-chargeModal', (event) => {
        $('#chargeModal').modal('hide');
       });
    });
</script>

<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('show-chargeEditModal', (event) => {
        $('#chargeEditModal').modal('show');
       });
    });
</script>

<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('hide-chargeEditModal', (event) => {
        $('#chargeEditModal').modal('hide');
       });
    });
</script>

<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('show-driverModal', (event) => {
        $('#driverModal').modal('show');
       });
    });
</script>

<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('hide-driverModal', (event) => {
        $('#driverModal').modal('hide');
       });
    });
</script>

<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('show-driverEditModal', (event) => {
        $('#driverEditModal').modal('show');
       });
    });
</script>

<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('hide-driverEditModal', (event) => {
        $('#driverEditModal').modal('hide');
       });
    });
</script>

<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('show-customerModal', (event) => {
        $('#customerModal').modal('show');
       });
    });
</script>

<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('hide-customerModal', (event) => {
        $('#customerModal').modal('hide');
       });
    });
</script>

<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('show-customerEditModal', (event) => {
        $('#customerEditModal').modal('show');
       });
    });
</script>

<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('hide-customerEditModal', (event) => {
        $('#customerEditModal').modal('hide');
       });
    });
</script>

<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('show-clearing_agentModal', (event) => {
        $('#clearing_agentModal').modal('show');
       });
    });
</script>

<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('hide-clearing_agentModal', (event) => {
        $('#clearing_agentModal').modal('hide');
       });
    });
</script>

<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('show-clearing_agentEditModal', (event) => {
        $('#clearing_agentEditModal').modal('show');
       });
    });
</script>

<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('hide-clearing_agentEditModal', (event) => {
        $('#clearing_agentEditModal').modal('hide');
       });
    });
</script>

<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('show-trailerModal', (event) => {
        $('#trailerModal').modal('show');
       });
    });
</script>

<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('hide-trailerModal', (event) => {
        $('#trailerModal').modal('hide');
       });
    });
</script>

<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('show-trailerEditModal', (event) => {
        $('#trailerEditModal').modal('show');
       });
    });
</script>

<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('hide-trailerEditModal', (event) => {
        $('#trailerEditModal').modal('hide');
       });
    });
</script>

<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('show-userModal', (event) => {
        $('#userModal').modal('show');
       });
    });
</script>

<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('hide-userModal', (event) => {
        $('#userModal').modal('hide');
       });
    });
</script>

<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('show-userEditModal', (event) => {
        $('#userEditModal').modal('show');
       });
    });
</script>

<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('hide-userEditModal', (event) => {
        $('#userEditModal').modal('hide');
       });
    });
</script>
<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('show-horseModal', (event) => {
        $('#horseModal').modal('show');
       });
    });
</script>

<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('hide-horseModal', (event) => {
        $('#horseModal').modal('hide');
       });
    });
</script>

<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('show-horseEditModal', (event) => {
        $('#horseEditModal').modal('show');
       });
    });
</script>

<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('hide-horseEditModal', (event) => {
        $('#horseEditModal').modal('hide');
       });
    });
</script>

<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('show-vendorModal', (event) => {
        $('#vendorModal').modal('show');
       });
    });
</script>
<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('hide-vendorModal', (event) => {
        $('#vendorModal').modal('hide');
       });
    });
</script>
<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('show-vendorEditModal', (event) => {
        $('#vendorEditModal').modal('show');
       });
    });
</script>
<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('hide-vendorEditModal', (event) => {
        $('#vendorEditModal').modal('hide');
       });
    });
</script>

<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('show-service_providerModal', (event) => {
        $('#service_providerModal').modal('show');
       });
    });
</script>
<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('hide-service_providerModal', (event) => {
        $('#service_providerModal').modal('hide');
       });
    });
</script>
<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('show-service_providerEditModal', (event) => {
        $('#service_providerEditModal').modal('show');
       });
    });
</script>
<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('hide-service_providerEditModal', (event) => {
        $('#service_providerEditModal').modal('hide');
       });
    });
</script>

<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('show-tripModal', (event) => {
        $('#tripModal').modal('show');
       });
    });
</script>
<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('hide-tripModal', (event) => {
        $('#tripModal').modal('hide');
       });
    });
</script>
<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('show-tripEditModal', (event) => {
        $('#tripEditModal').modal('show');
       });
    });
</script>
<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('hide-tripEditModal', (event) => {
        $('#tripEditModal').modal('hide');
       });
    });
</script>

<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('show-invoiceModal', (event) => {
        $('#invoiceModal').modal('show');
       });
    });
</script>
<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('hide-invoiceModal', (event) => {
        $('#invoiceModal').modal('hide');
       });
    });
</script>
<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('show-invoiceEditModal', (event) => {
        $('#invoiceEditModal').modal('show');
       });
    });
</script>
<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('hide-invoiceEditModal', (event) => {
        $('#invoiceEditModal').modal('hide');
       });
    });
</script>

<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('show-orderModal', (event) => {
        $('#orderModal').modal('show');
       });
    });
</script>
<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('hide-orderModal', (event) => {
        $('#orderModal').modal('hide');
       });
    });
</script>
<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('show-orderEditModal', (event) => {
        $('#orderEditModal').modal('show');
       });
    });
</script>
<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('hide-orderEditModal', (event) => {
        $('#orderEditModal').modal('hide');
       });
    });
</script>

<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('show-fuel_priceModal', (event) => {
        $('#fuel_priceModal').modal('show');
       });
    });
</script>
<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('hide-fuel_priceModal', (event) => {
        $('#fuel_priceModal').modal('hide');
       });
    });
</script>
<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('show-fuel_priceEditModal', (event) => {
        $('#fuel_priceEditModal').modal('show');
       });
    });
</script>
<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('hide-fuel_priceEditModal', (event) => {
        $('#fuel_priceEditModal').modal('hide');
       });
    });
</script>

<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('show-fuel_stationModal', (event) => {
        $('#fuel_stationModal').modal('show');
       });
    });
</script>
<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('hide-fuel_stationModal', (event) => {
        $('#fuel_stationModal').modal('hide');
       });
    });
</script>
<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('show-fuel_stationEditModal', (event) => {
        $('#fuel_stationEditModal').modal('show');
       });
    });
</script>
<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('hide-fuel_stationEditModal', (event) => {
        $('#fuel_stationEditModal').modal('hide');
       });
    });
</script>

<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('show-fuel_stationModal', (event) => {
        $('#fuel_stationModal').modal('show');
       });
    });
</script>
<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('hide-fuel_stationModal', (event) => {
        $('#fuel_stationModal').modal('hide');
       });
    });
</script>
<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('show-fuel_stationEditModal', (event) => {
        $('#fuel_stationEditModal').modal('show');
       });
    });
</script>
<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('hide-fuel_stationEditModal', (event) => {
        $('#fuel_stationEditModal').modal('hide');
       });
    });
</script>

<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('show-branchModal', (event) => {
        $('#branchModal').modal('show');
       });
    });
</script>


<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('hide-branchModal', (event) => {
        $('#branchModal').modal('hide');
       });
    });
</script>

<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('show-branchEditModal', (event) => {
        $('#branchEditModal').modal('show');
       });
    });
</script>
<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('hide-branchEditModal', (event) => {
        $('#branchEditModal').modal('hide');
       });
    });
</script>

<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('show-bank_accountModal', (event) => {
        $('#bank_accountModal').modal('show');
       });
    });
</script>


<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('hide-bank_accountModal', (event) => {
        $('#bank_accountModal').modal('hide');
       });
    });
</script>

<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('show-bank_accountEditModal', (event) => {
        $('#bank_accountEditModal').modal('show');
       });
    });
</script>
<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('hide-bank_accountEditModal', (event) => {
        $('#bank_accountEditModal').modal('hide');
       });
    });
</script>


<script>
    function goBack() {
      window.history.back();
    }
</script>


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
@stack('scripts')


    @livewireScripts
</body>
</html> 