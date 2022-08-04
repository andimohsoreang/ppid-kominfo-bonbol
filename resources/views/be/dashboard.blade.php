@extends('be.layouts.app')

@section('container')
<div class="page-title">
    <h3>Dashboard</h3>
    <p class="text-subtitle text-muted">A good dashboard to display your statistics</p>
</div>

{{-- <section class="section">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Bar Chart</h4>
                </div>
                <div class="card-body">
                    <canvas id="bar"></canvas>
                </div>
            </div>
        </div>
    </div>
</section> --}}

<section class="section">
    <div class="row mb-2">
        @role('admin')
        <div class="col-12 col-md-4">
            <div class="card card-statistic">
                <div class="card-body p-0">
                    <div class="d-flex flex-column">
                        <div class='px-4 py-4 d-flex justify-content-between'>
                            <div>
                                <h3 class='card-title'>Informasi Publik</h3>
                                <p class="m-0 text-white">Total informasi publik yang diupload</p>
                            </div>
                            <div class="card-right d-flex align-items-center">
                                <p class="fs-2 fw-bold">{{ $infopub ?? '' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endrole

        @role('petugas')
        <div class="col-12 col-md-4">
            <div class="card card-statistic">
                <div class="card-body p-0">
                    <div class="d-flex flex-column">
                        <div class='px-4 py-4 d-flex justify-content-between'>
                            <div>
                                <h3 class='card-title'>Informasi Publik</h3>
                                <p class="m-0 text-white">Total informasi publik yang diupload</p>
                            </div>
                            <div class="card-right d-flex align-items-center">
                                <p class="fs-2 fw-bold">{{ $infopub ?? '' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endrole

        <div class="col-12 @role('admin') col-md-4 @endrole @role('petugas') col-md-4 @endrole @role('user') col-md-6 @endrole">
            <div class="card card-statistic forHover mb-3">
                <div class="card-body p-0 forTarget1">
                    <div class="d-flex flex-column">
                        <div class='px-4 py-4 d-flex justify-content-between'>
                            <div>
                                <h3 class='card-title'>Permohonan Informasi</h3>
                                @role('admin')
                                <p class="m-0 text-white">Total permohonan informasi</p>
                                @endrole
                                @role('petugas')
                                <p class="m-0 text-white">Total permohonan informasi yang diproses</p>
                                @endrole
                                @role('user')
                                <p class="m-0 text-white">Total permohonan informasi yang diajukan</p>
                                @endrole
                            </div>
                            <div class="card-right d-flex align-items-center">
                                <p class="fs-2 fw-bold">{{ $permoinfo ?? '' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="targetContent">
                <div id="content1" class="target">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            @role('admin')
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="m-0">Belum Diproses</h5>
                                <span class="badge bg-warning badge-pill badge-round ml-1"><h6 class="m-0 text-white">{{ $permoinfo_belum ?? '' }}</h6></span>
                            </div>
                            <hr>
                            @endrole
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="m-0">Diproses</h5>
                                <span class="badge bg-info badge-pill badge-round ml-1"><h6 class="m-0 text-white">{{ $permoinfo_diproses ?? '' }}</h6></span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="m-0">Diterima</h5>
                                <span class="badge bg-success badge-pill badge-round ml-1"><h6 class="m-0 text-white">{{ $permoinfo_diterima ?? '' }}</h6></span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="m-0">Ditolak</h5>
                                <span class="badge bg-danger badge-pill badge-round ml-1"><h6 class="m-0 text-white">{{ $permoinfo_ditolak ?? '' }}</h6></span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="m-0">Keberatan Diproses</h5>
                                <span class="badge bg-info badge-pill badge-round ml-1"><h6 class="m-0 text-white">{{ $permoinfo_keberatan ?? '' }}</h6></span>
                            </div>
                            <div class="d-flex justify-content-center mt-3">
                                @role('admin')
                                <a href="{{ route('admin.permohonaninformasi') }}" class="small">Lihat Detail</a>
                                @endrole
                                @role('petugas')
                                <a href="{{ route('petugas.permohonaninformasi') }}" class="small">Lihat Detail</a>
                                @endrole
                                @role('user')
                                <a href="{{ route('user.permohonaninformasi') }}" class="small">Lihat Detail</a>
                                @endrole
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 @role('admin') col-md-4 @endrole @role('petugas') col-md-4 @endrole @role('user') col-md-6 @endrole">
            <div class="card card-statistic forHover mb-3">
                <div class="card-body p-0 forTarget2">
                    <div class="d-flex flex-column">
                        <div class='px-4 py-4 d-flex justify-content-between'>
                            <div>
                                <h3 class='card-title'>Pengajuan Keberatan</h3>
                                @role('admin|petugas')
                                <p class="m-0 text-white">Total pengajuan keberatan yang diterima</p>
                                @endrole
                                @role('user')
                                <p class="m-0 text-white">Total permohonan informasi yang diajukan</p>
                                @endrole
                            </div>
                            <div class="card-right d-flex align-items-center">
                                <p class="fs-2 fw-bold">{{ $pengkeb ?? '' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="targetContent">
                <div id="content2" class="target">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            @role('admin')
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="m-0">Belum diproses</h5>
                                <span class="badge bg-warning badge-pill badge-round ml-1"><h6 class="m-0 text-white">{{ $pengkeb_belum ?? '' }}</h6></span>
                            </div>
                            <hr>
                            @endrole
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="m-0">Diterima</h5>
                                <span class="badge bg-success badge-pill badge-round ml-1"><h6 class="m-0 text-white">{{ $pengkeb_diterima ?? '' }}</h6></span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="m-0">Ditolak</h5>
                                <span class="badge bg-danger badge-pill badge-round ml-1"><h6 class="m-0 text-white">{{ $pengkeb_ditolak ?? '' }}</h6></span>
                            </div>
                            <div class="d-flex justify-content-center mt-3">
                                @role('admin')
                                <a href="{{ route('admin.pengajuankeberatan') }}" class="small">Lihat Detail</a>
                                @endrole
                                @role('petugas')
                                <a href="{{ route('petugas.pengajuankeberatan') }}" class="small">Lihat Detail</a>
                                @endrole
                                @role('user')
                                <a href="{{ route('user.pengajuankeberatan') }}" class="small">Lihat Detail</a>
                                @endrole
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @role('user')
    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center flex-column flex-lg-row justify-content-center justify-content-lg-between">
                        <h5 class="m-0 mb-2 mb-lg-0">Hi, {{ Auth::user()->name }}</h5>
                        <p class="fst-italic m-0 text-center text-lg-start">
                            SELAMAT DATANG DI PPID BONE BOLANGO
                            <br>
                            SIAP TERBUKA DAN BERWIBAWA
                        </p>
                    </div>
                    <hr>
                    <p>
                        PPID adalah bla bla bla.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="card">
                <div class="card-body pb-3">
                    <h5 class="fw-bold">Pelayan Hanya Pada Hari dan Jam Kerja</h5>
                    <hr>
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div>
                                <h6 class="fw-bold">SENIN - KAMIS</h6>
                                <p>PUKUL 09.00 - 15.30 WITA</p>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div>
                                <h6 class="fw-bold text-danger">ISTRAHAT</h6>
                                <p>PUKUL 12.00 - 13.00 WITA</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div>
                                <h6 class="fw-bold">JUM'AT</h6>
                                <p>PUKUL 09.00 - 11.00 WITA</p>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div>
                                <h6 class="fw-bold text-danger">ISTRAHAT</h6>
                                <p>PUKUL 11.00 - 13.30 WITA</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endrole
</section>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('.target').hide();
        $('.forHover').hover(function() {
            $(this).addClass('shadow').css('cursor', 'pointer');
        }, function() {
            $(this).removeClass('shadow');
        });
        $('.forTarget1').click(function() {
            $('#content2').hide();
            $('#content1').slideToggle(600);
        });
        $('.forTarget2').click(function() {
            $('#content1').hide();
            $('#content2').slideToggle(600);
        });

        $('#contentTarget').hide();
        $('.forHover').hover(function() {
            $(this).addClass('shadow').css('cursor', 'pointer');
        }, function() {
            $(this).removeClass('shadow');
        });
        $('.forTarget').click(function() {
            $('#contentTarget').slideToggle();
        });
    });
</script>
@endsection