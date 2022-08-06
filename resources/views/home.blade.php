@extends('layouts.app')

@section('content')
<header id="home" class="header">
    <div class="overlay"></div>

    <div id="header-carousel" class="carousel slide carousel-fade" data-ride="carousel">
        <div class="container">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="carousel-title">Selamat Datang Di <br>PPID DISKOMINFO BONE BOLANGO</h1>
                        <a href="{{ route('infopub') }}" class="btn btn-primary btn-rounded"><i class="ti-info-alt"></i> Informasi Publik</a>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="carousel-title">Pejabat Pengelola Informasi & Dokumentasi
                        </h1>
                        <a href="{{ route('pemohon.register') }}" class="btn btn-primary btn-rounded"><i class="ti-upload"></i> Permohonan Informasi</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<section class="section" id="about">

    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="row align-items-center">
                    <div class="col-12">
                        <div class="widget shadow-lg">
                            <div class="icon-wrapper">
                                <i class="ti-info-alt"></i>
                            </div>
                            <div class="infos-wrapper">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="text-primary">Informasi Publik</h5>
                                        <p>Total Informasi Publik</p>
                                    </div>
                                    <h1 class="m-0 text-dark">{{ $infopub_total }}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="widget shadow-lg">
                            <div class="icon-wrapper">
                                <i class="ti-upload"></i>
                            </div>
                            <div class="infos-wrapper">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="text-primary">Permohonan Informasi</h5>
                                        <p>Total Permohonan Informasi</p>
                                    </div>
                                    <h1 class="m-0 text-dark">{{ $permoinfo_total }}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="widget shadow-lg">
                            <div class="icon-wrapper">
                                <i class="ti-alert"></i>
                            </div>
                            <div class="infos-wrapper">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="text-primary">Pengajuan Keberatan</h5>
                                        <p>Total Pengajuan Keberatan</p>
                                    </div>
                                    <h1 class="m-0 text-dark">{{ $pengkeb_total }}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="row align-items-center">
                    <div class="col-12">
                        <div class="widget bg-primary text-white shadow-lg">
                            <div class="icon-wrapper">
                                <i class="ti-info-alt"></i>
                            </div>
                            <div class="infos-wrapper">
                                <a href={{ route('infopub') }}>
                                    <h5 class="text-white">Informasi Publik</h5>
                                    <p class="text-white">Informasi Publik</p>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="widget bg-primary text-white shadow-lg">
                            <div class="icon-wrapper">
                                <i class="ti-upload"></i>
                            </div>
                            <div class="infos-wrapper">
                                <a href={{ route('pemohon.register') }}>
                                    <h5 class="text-white">Permohonan Informasi</h5>
                                    <p class="text-white">Permohonan Informasi</p>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="widget bg-primary text-white shadow-lg">
                            <div class="icon-wrapper">
                                <i class="ti-bar-chart"></i>
                            </div>
                            <div class="infos-wrapper">
                                <a href={{ route('statistik') }}>
                                    <h5 class="text-white">Statistik</h5>
                                    <p class="text-white">Infografik</p>
                                </a>
                            </div>
                        </div>
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
                <h6 class="subtitle font-weight-normal">{{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }}</h6>
                <h5>PPID BONE BOLANGO</h5>
            </div>
            <div class="socials">
                <div class="row justify-content-between">
                    <div class="col">
                        <a class="d-block subtitle"><i class="ti-microphone"></i> {{ $profilkantor->telepon ?? '' }}</a>
                        <a class="d-block subtitle"><i class="ti-email"></i> {{ $profilkantor->email ?? '' }}</a>
                    </div>
                    <div class="col">
                        <h6 class="subtitle font-weight-normal mb-1">Social Media</h6>
                        <div class="social-links">
                            <a href="{{ $profilkantor->fb ?? '' }}" class="link pr-1" target="_blank"><i class="ti-facebook"></i></a>
                            <a href="{{ $profilkantor->tw ?? '' }}" class="link pr-1" target="_blank"><i class="ti-twitter-alt"></i></a>
                            <a href="{{ $profilkantor->ig ?? '' }}" class="link pr-1" target="_blank"><i class="ti-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection