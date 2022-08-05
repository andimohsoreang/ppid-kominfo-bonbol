<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with Ollie landing page.">
    <meta name="author" content="Devcrud">
    <title>{{ $title ?? '' }} PPID Bone Bolango</title>
    <link rel="shortcut icon" href="{{ asset('be/assets/images/ppidbonebol.png') }}" type="image/x-icon">

     <!-- font icons -->
     <link rel="stylesheet" href={{ asset('fe/assets/vendors/themify-icons/css/themify-icons.css') }}>
    
   <!-- owl carousel -->
   <link rel="stylesheet" href={{ asset('fe/assets/vendors/owl-carousel/css/owl.carousel.css') }}>
   <link rel="stylesheet" href={{ asset('fe/assets/vendors/owl-carousel/css/owl.theme.default.css') }}>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/jquery.dataTables.min.css" integrity="sha512-1k7mWiTNoyx2XtmI96o+hdjP8nn0f3Z2N4oF/9ZZRgijyV4omsKOXEnqL1gKQNPy2MTSP9rIEWGcH/CInulptA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap + Ollie main styles -->
	<link rel="stylesheet" href={{ asset('fe/assets/css/ollie.css') }}>

    @yield('style')

</head>
<body data-spy="scroll" data-target=".navbar" data-offset="40" id="home">
    
    @include('layouts.navbar')

    @yield('content')

    @include('layouts.footer')

	<!-- core  -->
    <script src="{{ asset('fe/assets/vendors/jquery/jquery-3.4.1.js') }}"></script>
    <script src="{{ asset('fe/assets/vendors/bootstrap/bootstrap.bundle.js') }}"></script>

    <!-- bootstrap 3 affix -->
	<script src="{{ asset('fe/assets/vendors/bootstrap/bootstrap.affix.js') }}"></script>
    
    <!-- Owl carousel  -->
    <script src="{{ asset('fe/assets/vendors/owl-carousel/js/owl.carousel.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js" integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Ollie js -->
    <script src="{{ asset('fe/assets/js/Ollie.js') }}"></script> 

    @yield('scripts')

</body>
</html>
