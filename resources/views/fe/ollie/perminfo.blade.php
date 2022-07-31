<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with Ollie landing page.">
    <meta name="author" content="Devcrud">
    <title>Ollie Landing page | Free Bootstrap 4.3.x landing page</title>

      <!-- font icons -->
      <link rel="stylesheet" href={{ asset('fe/assets/vendors/themify-icons/css/themify-icons.css') }}>
    
      <!-- owl carousel -->
      <link rel="stylesheet" href={{ asset('fe/assets/vendors/owl-carousel/css/owl.carousel.css') }}>
      <link rel="stylesheet" href={{ asset('fe/assets/vendors/owl-carousel/css/owl.theme.default.css') }}>
  
    {{-- Datatables --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">

    <!-- Bootstrap + Ollie main styles -->
	<link rel="stylesheet" href={{ asset('fe/assets/css/perminfo.css') }}>

</head>
<body data-spy="scroll" data-target=".navbar" data-offset="40" id="home">

    <nav id="scrollspy" class="navbar navbar-light bg-light navbar-expand-lg fixed-top" data-spy="affix" data-offset-top="20">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="assets/imgs/brand.svg" alt="" class="brand-img"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#portfolio">Portfolio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#testmonial">Testmonial</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#blog">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                    <li class="nav-item ml-0 ml-lg-4">
                        <a class="nav-link btn btn-primary" style="color: white;" href="components.html">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <section class="section mt-5">
        <div class="container">
            <h6 class="xs-font mb-0 text-center">PPID Bone Bolango</h6>
            <h3 class="section-title mb-4 text-center" >Permohonan Informasi Publik</h3>
            <div class="row">
                <div class="col-12">
                    <table id="example" class="table " style="width:100%">
                        <thead>
                            <tr>
                                <th>Informasi</th>
                                <th>Judul</th>
                                <th>Dibuat</th>
                                <th>SKPD</th>
                                <th>File</th>
                                <th>Ukuran</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Serta Merta</td>
                                <td>SIARAN PERS SATU DIA TIGA EMPAT LIMA ENAM TUJUH DELAPAN SEMBILAN SEPULUH</td>
                                <td>21-07-2001</td>
                                <td>KOMINFO</td>
                                <td>PDF</td>
                                <td> 320 Kb </td>
                                <td><button class="btn btn-primary circle"> <i class="ti-download"></i> </button></td>
                            </tr>
                            <tr>
                                <td>Serta Merta</td>
                                <td>SIARAN PERS SATU DIA TIGA EMPAT LIMA ENAM TUJUH DELAPAN SEMBILAN SEPULUH</td>
                                <td>21-07-2001</td>
                                <td>KOMINFO</td>
                                <td>PDF</td>
                                <td> 320 Kb </td>
                                <td><button class="btn btn-primary circle"> <i class="ti-download"></i> </button></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>Serta Merta</td>
                                <td>SIARAN PERS SATU DIA TIGA EMPAT LIMA ENAM TUJUH DELAPAN SEMBILAN SEPULUH</td>
                                <td>21-07-2001</td>
                                <td>KOMINFO</td>
                                <td>PDF</td>
                                <td> 320 Kb </td>
                                <td><button class="btn btn-primary circle"> <i class="ti-download"></i> </button></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            </div>
            
    </section>

    

    

    <section id="contact" class="section pb-0">

        <div class="container">
            <h6 class="xs-font mb-0">Culpa perferendis excepturi.</h6>
            <h3 class="section-title mb-5">Contact Us</h3>

            <div class="row align-items-center justify-content-between">
                <div class="col-md-8 col-lg-7">

                    <form class="contact-form">
                        <div class="form-row">
                            <div class="col form-group">
                                <input type="text" class="form-control" placeholder="Name">
                            </div>
                            <div class="col form-group">
                                <input type="email" class="form-control" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea name="" id="" cols="30" rows="5" class="form-control" placeholder="Your Message"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary btn-block" value="Send Message">
                        </div>
                    </form>
                </div>
                <div class="col-md-4 d-none d-md-block order-1">
                    <ul class="list">
                        <li class="list-head">
                            <h6>CONTACT INFO</h6>
                        </li>
                        <li class="list-body">
                            <p class="py-2">Contact us and we'll get back to you within 24 hours.</p>
                            <p class="py-2"><i class="ti-location-pin"></i> 12345 Fake ST NoWhere AB Country</p>
                            <p class="py-2"><i class="ti-email"></i>  info@website.com</p>
                            <p class="py-2"><i class="ti-microphone"></i> (123) 456-7890</p>

                        </li>
                    </ul> 
                </div>
            </div>

            <footer class="footer mt-5 border-top">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-6 text-center text-md-left">
                        <p class="mb-0">Copyright <script>document.write(new Date().getFullYear())</script> &copy; <a target="_blank" href="http://www.devcrud.com">DevCRUD</a></p>
                    </div>
                    <div class="col-md-6 text-center text-md-right">
                        <div class="social-links">
                            <a href="javascript:void(0)" class="link"><i class="ti-facebook"></i></a>
                            <a href="javascript:void(0)" class="link"><i class="ti-twitter-alt"></i></a>
                            <a href="javascript:void(0)" class="link"><i class="ti-google"></i></a>
                            <a href="javascript:void(0)" class="link"><i class="ti-pinterest-alt"></i></a>
                            <a href="javascript:void(0)" class="link"><i class="ti-instagram"></i></a>
                            <a href="javascript:void(0)" class="link"><i class="ti-rss"></i></a>
                        </div>
                    </div>
                </div> 
            </footer>
        </div>
    </section>
	
    
    
	<!-- core  -->
    <script src={{ asset('fe/assets/vendors/jquery/jquery-3.4.1.js') }}></script>
    <script src={{ asset('fe/assets/vendors/bootstrap/bootstrap.bundle.js') }}></script>

    <!-- bootstrap 3 affix -->
	<script src={{ asset('fe/assets/vendors/bootstrap/bootstrap.affix.js') }}></script>
    
    <!-- Owl carousel  -->
    <script src={{ asset('fe/assets/vendors/owl-carousel/js/owl.carousel.js') }}></script>


    <!-- Ollie js -->
    <script src={{ asset('fe/assets/js/Ollie.js') }}></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>


    <script>
        $(document).ready(function () {
        $('#example').DataTable();
        });
    </script>
</body>
</html>
