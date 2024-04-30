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
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   
     <script src="https://kit.fontawesome.com/0154e08647.js" crossorigin="anonymous"></script>
    <!-- App css -->
    <link href="{{ asset('css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="{{ asset('css/icons.min.css')}}" rel="stylesheet" type="text/css" />
</head>
@yield('body')
@yield('content')

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

<script src="{{ asset('js/vendor.min.js')}}"></script>

    <!-- App js -->
    <script src="{{ asset('js/app.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>