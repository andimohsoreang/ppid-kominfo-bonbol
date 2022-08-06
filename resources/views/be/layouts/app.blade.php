<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> {{ $title ?? '' }} | PPID Bone Bolango</title>
    <link rel="shortcut icon" href="{{ asset('be/assets/images/ppidbonebol.png') }}" type="image/x-icon">

    <link rel="stylesheet" href={{ asset('be/assets/css/bootstrap.css') }}>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <link rel="stylesheet" href={{ asset('be/assets/vendors/chartjs/Chart.min.css') }}>
    <link rel="stylesheet" href={{ asset('be/assets/vendors/simple-datatables/style.css') }}>
    <link rel="stylesheet" href={{ asset('be/assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}>
    <link rel="stylesheet" href={{ asset('be/assets/css/app.css') }}>
    <!-- Include Choices CSS -->
    <link rel="stylesheet" href="{{ asset('be/assets/vendors/choices.js/choices.min.css') }}" />

    <style>
         .bg-grad {
            background-image: linear-gradient(to right, #1F1C2C 0%, #928DAB  51%, #1F1C2C  100%);
            padding: 15px 15px;
            text-align: center;
            text-transform: uppercase;
            transition: 0.5s;
            background-size: 200% auto;
            color: white;            
            box-shadow: 0 0 20px #eee;
            border-radius: 10px;
            display: block;
          }

          .bg-grad:hover {
            background-position: right center; /* change the direction of the change here */
            color: #fff;
            text-decoration: none;
          }
    </style>

    @yield('linkcss')
</head>

<body>
    <div id="app">
        @include('be.layouts.sidebar')
        <div id="main">
            @include('be.layouts.nav')

            <div class="main-content container-fluid">
                @yield('container')
            </div>

            @include('be.layouts.footer')
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src={{ asset('be/assets/js/feather-icons/feather.min.js') }}></script>
    <script src={{ asset('be/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}></script>
    <script src={{ asset('be/assets/js/app.js') }}></script>
    <script src={{ asset('be/assets/vendors/simple-datatables/simple-datatables.js') }}></script>
    <script src={{ asset('be/assets/vendors/chartjs/Chart.min.js') }}></script>
    <script src={{ asset('be/assets/vendors/apexcharts/apexcharts.min.js') }}></script>
    <script src={{ asset('be/assets/js/pages/dashboard.js') }}></script>
    <script src={{ asset('be/assets/js/vendors.js') }}></script>
    <!-- Include Choices JavaScript -->
    <script src="{{ asset('be/assets/vendors/choices.js/choices.min.js') }}"></script>

    <script src={{ asset('be/assets/js/main.js') }}></script>

    @yield('scripts')
</body>

</html>