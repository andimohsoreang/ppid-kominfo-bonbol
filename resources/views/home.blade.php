@extends('layouts.app')

@section('content')
<header id="home" class="header">
    <div class="overlay"></div>

    <div id="header-carousel" class="carousel slide carousel-fade" data-ride="carousel">
        <div class="container">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="carousel-caption d-none d-md-block">
                        <img src="" alt="">
                        <h1 class="carousel-title">Selamat Datang Di <br>PPID DISKOMINFO BONE BOLANGO</h1>
                        <button class="btn btn-primary btn-rounded">Learn More</button>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="carousel-title">Pejabat Pengelola Informasi & Dokumentasi
                        </h1>
                        <button class="btn btn-primary btn-rounded">Learn More</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="infos container mb-4 mb-md-2">
        <div class="title">
            <h6 class="subtitle font-weight-normal">Are locking for</h6>
            <h5>Lorem inpsum</h5>
            <p class="font-small">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
        </div>
        <div class="socials text-right">
            <div class="row justify-content-between">
                <div class="col">
                    <a class="d-block subtitle"><i class="ti-microphone pr-2"></i> (123) 456-7890</a>
                    <a class="d-block subtitle"><i class="ti-email pr-2"></i> info@website.com</a>
                </div>
                <div class="col">
                    <h6 class="subtitle font-weight-normal mb-2">Social Media</h6>
                    <div class="social-links">
                        <a href="javascript:void(0)" class="link pr-1"><i class="ti-facebook"></i></a>
                        <a href="javascript:void(0)" class="link pr-1"><i class="ti-twitter-alt"></i></a>
                        <a href="javascript:void(0)" class="link pr-1"><i class="ti-google"></i></a>
                        <a href="javascript:void(0)" class="link pr-1"><i class="ti-pinterest-alt"></i></a>
                        <a href="javascript:void(0)" class="link pr-1"><i class="ti-instagram"></i></a>
                        <a href="javascript:void(0)" class="link pr-1"><i class="ti-rss"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<section class="section" id="about">

    <div class="container">
        <div class="row align-items-center mr-auto">
            <div class="col-sm-6 col-md-4">
                <div class="widget shadow-lg">
                    <div class="icon-wrapper">
                        <i class="ti-layout-list-thumb"></i>
                    </div>
                    <div class="infos-wrapper">
                        <a href={{ route('infopub') }}>
                            <h5 class="text-primary">Informasi Publik</h5>
                            <p>Informasi Publik</p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="widget shadow-lg">
                    <div class="icon-wrapper">
                        <i class="ti-layout-media-right"></i>
                    </div>
                    <div class="infos-wrapper">
                        <a href={{ route('pemohon.register') }}>
                            <h5 class="text-primary ">Permohonan Informasi</h5>
                            <p>Permohonan Informasi</p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="widget shadow-lg">
                    <div class="icon-wrapper">
                        <i class="ti-bar-chart"></i>
                    </div>
                    <div class="infos-wrapper">
                        <h5 class="text-primary">Statistik</h5>
                        <p>Infografik</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<section class="section bg-overlay">

    <div class="container">
        <div class="infos mb-4 mb-md-2">
            <div class="title">
                <h6 class="subtitle font-weight-normal">Are locking for</h6>
                <h5>Lorem inpsum</h5>
                <p class="font-small">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
            </div>
            <div class="socials">
                <div class="row justify-content-between">
                    <div class="col">
                        <a class="d-block subtitle"><i class="ti-microphone"></i> (123) 456-7890</a>
                        <a class="d-block subtitle"><i class="ti-email"></i> info@website.com</a>
                    </div>
                    <div class="col">
                        <h6 class="subtitle font-weight-normal mb-1">Social Media</h6>
                        <div class="social-links">
                            <a href="javascript:void(0)" class="link pr-1"><i class="ti-facebook"></i></a>
                            <a href="javascript:void(0)" class="link pr-1"><i class="ti-twitter-alt"></i></a>
                            <a href="javascript:void(0)" class="link pr-1"><i class="ti-google"></i></a>
                            <a href="javascript:void(0)" class="link pr-1"><i class="ti-pinterest-alt"></i></a>
                            <a href="javascript:void(0)" class="link pr-1"><i class="ti-instagram"></i></a>
                            <a href="javascript:void(0)" class="link pr-1"><i class="ti-rss"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection