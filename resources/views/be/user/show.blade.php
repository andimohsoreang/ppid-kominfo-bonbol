@extends('be.layouts.app')

@section('container')
<div class="main-content container-fluid">
    <div class="page-title">
        <div class="d-flex gap-2 align-items-center">
            @if(request()->routeIs('admin.petugas.show'))
            <a href="{{ route('admin.petugas') }}" class="btn icon btn-dark"><i data-feather="chevron-left"></i></a>
            <div class="">
                <h3 class="m-0">Detail Petugas</h3>
            </div>
            @else
            <a href="{{ route('admin.pemohon') }}" class="btn icon btn-dark"><i data-feather="chevron-left"></i></a>
            <div>
                <h3 class="m-0">Detail Pemohon</h3>
            </div>
            @endif
        </div>
    </div>
    <section class="section mt-3">
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                @if(request()->routeIs('admin.petugas.show'))
                                <h3 class="m-0">Biodata Petugas</h3>
                                @else
                                <h3 class="m-0">Biodata Pemohon</h3>
                                @endif
                            </div>
                            @if(request()->routeIs('admin.petugas.show'))
                            <a href="{{ route('admin.petugas.edit', $user->id) }}" class="btn icon btn-warning"><i data-feather="edit"></i> Edit</a>
                            @else
                            <a href="{{ route('admin.pemohon.edit', $user->id) }}" class="btn icon btn-warning"><i data-feather="edit"></i> Edit</a>
                            @endif
                        </div>
                        <hr>
                        @if(request()->routeIs('admin.pemohon.show'))
                        <div class="form-group">
                            <label class="fw-bold">
                                @if($user->biodata->kategori_pemohon == 1)
                                NIK/No. Identitas Lembaga
                                @else
                                NIK/No. Identitas Pribadi
                                @endif
                            </label>
                            <p class="m-0">{{ $user->biodata->no_identitas }}</p>
                        </div>
                        @endif
                        <div class="form-group">
                            <label class="fw-bold">
                                @if(request()->routeIs('admin.pemohon.show'))
                                    @if($user->biodata->kategori_pemohon == 1)
                                    Nama Lembaga/Instansi
                                    @else
                                    Nama Lengkap
                                    @endif
                                @else
                                Nama Lengkap
                                @endif
                            </label>
                            <p class="m-0">{{ $user->name }}</p>
                        </div>
                        @if(request()->routeIs('admin.pemohon.show'))
                        <div class="form-group">
                            <label class="fw-bold">
                                @if($user->biodata->kategori_pemohon == 1)
                                Akta Notaris Lembaga/Organisasi
                                @else
                                KTP Pribadi
                                @endif
                            </label>
                            <br>
                            <a href="{{ asset($user->biodata->file_path) }}" target="_blank" class="btn icon btn-primary">
                                <i data-feather="image"></i>
                            </a>
                        </div>
                        <div class="form-group">
                            <label class="fw-bold">
                                Nomor Telepon
                            </label>
                            <p class="m-0">{{ $user->biodata->no_telp }}</p>
                        </div>
                        <div class="form-group">
                            <label class="fw-bold">
                                Pekerjaan
                            </label>
                            <p class="m-0">{{ $user->biodata->pekerjaan }}</p>
                        </div>
                        <div class="form-group">
                            <label class="fw-bold">
                                Alamat
                            </label>
                            <p class="m-0">{{ $user->biodata->alamat }}</p>
                        </div>
                        @endif
                        <div class="form-group">
                            <label class="fw-bold">
                                Email
                            </label>
                            <p class="m-0">{{ $user->email }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection