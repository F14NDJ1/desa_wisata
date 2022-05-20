<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Argon Dashboard PRO - Premium Bootstrap 4 Admin Template</title>
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <!-- Favicon -->
    <link rel="icon" href="../../../assets/img/brand/favicon.png" type="image/png">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="../../../assets/vendor/nucleo/css/nucleo.css" type="text/css">
    <link rel="stylesheet" href="../../../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
    <!-- Page plugins -->
    <!-- Argon CSS -->
    <link rel="stylesheet" href="../../../assets/css/argon.css?v=1.1.0" type="text/css">

</head>

<body>
    <div> 

    </div>

    <div class="main-content" id="panel">
        
    @include('admin.template.header')
        @yield('container')
    </div>

    </div>

    <script src="../../../assets/vendor/jquery/dist/jquery.min.js"></script>
    <script src="../../../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../../assets/vendor/js-cookie/js.cookie.js"></script>
    <script src="../../../assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
    <script src="../../../assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
    <!-- Optional JS -->
    <script src="../../../assets/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="../../../assets/vendor/chart.js/dist/Chart.extension.js"></script>
    <!-- Argon JS -->
    <script src="../../../assets/js/argon.js?v=1.1.0"></script>
    <!-- Demo JS - remove this in your project -->
    <script src="../../../assets/js/demo.min.js"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
    <script>
        // get a new date (locale machine date time)
        var date = new Date();
        // get the date as a string
        var n = date.toDateString();
        // get the time as a string
        var time = date.toLocaleTimeString();

        // find the html element with the id of time
        // set the innerHTML of that element to the date a space the time
        document.getElementById('time').innerHTML = n + ' ' + time;
    </script>

    @yield('script')

</body>

</html>