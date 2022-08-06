@extends('be.layouts.app')

@section('container')
<div class="main-content container-fluid">
    <div class="page-title">
        <div class="d-flex gap-2 align-items-center">
            @if(request()->routeIs('admin.petugas.edit'))
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
                    <div class="card-content">
                        <div class="card-body">
                            @if(request()->routeIs('admin.petugas.edit'))
                            <form action="{{ route('admin.petugas.update', $user->id) }}" method="POST"> 
                                @csrf
                                @method('put')
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="basicInput" class="fw-bold">Nama Lengkap</label>
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="basicInput" value="{{ $user->name }}">
                                                @error('name')
                                                    <div class="alert alert-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="basicInput" class="fw-bold">Email</label>
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="basicInput" value="{{ $user->email }}">
                                                @error('email')
                                                    <div class="alert alert-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            @else
                            <form action="{{ route('admin.pemohon.update', $user->id) }}" method="POST" enctype="multipart/form-data"> 
                                @csrf
                                @method('put')
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="basicInput" class="fw-bold">
                                                    @if($user->biodata->kategori_pemohon == 1)
                                                    NIK/No. Identitas Lembaga
                                                    @else
                                                    NIK/No. Identitas Pribadi
                                                    @endif
                                                </label>
                                                <input type="text" class="form-control @error('no_identitas') is-invalid @enderror" name="no_identitas" id="basicInput" value="{{ $user->biodata->no_identitas }}">
                                                @error('no_identitas')
                                                    <div class="alert alert-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="basicInput" class="fw-bold">
                                                    @if($user->biodata->kategori_pemohon == 1)
                                                    Nama Lembaga/Organisasi
                                                    @else
                                                    Nama Lengkap
                                                    @endif
                                                </label>
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="basicInput" value="{{ $user->name }}">
                                                @error('name')
                                                    <div class="alert alert-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="basicInput" class="fw-bold">
                                                    @if($user->biodata->kategori_pemohon == 1)
                                                    Akta Notaris Lembaga/Organisasi
                                                    @else
                                                    KTP Pribadi
                                                    @endif
                                                </label>
                                                <div class="form-file">
                                                    <input type="hidden" name="file_lama" value="{{ $user->biodata->file_path }}">
                                                    <input type="file" class="form-control-file" name="file" id="basicInput">
                                                </div>
                                                <small>*File yang boleh diupload jpg, jpeg, png dan maksimal 2MB.</small>
                                                @error('file')
                                                    <div class="alert alert-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="basicInput" class="fw-bold">
                                                   Nomor Telepon
                                                </label>
                                                <input type="text" class="form-control @error('no_telp') is-invalid @enderror" name="no_telp" id="basicInput" value="{{ $user->biodata->no_telp }}">
                                                @error('no_telp')
                                                    <div class="alert alert-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="basicInput" class="fw-bold">
                                                   Pekerjaan
                                                </label>
                                                <input type="text" class="form-control @error('pekerjaan') is-invalid @enderror" name="pekerjaan" id="basicInput" value="{{ $user->biodata->pekerjaan }}">
                                                @error('pekerjaan')
                                                    <div class="alert alert-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="basicInput" class="fw-bold">
                                                   Alamat
                                                </label>
                                                <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="basicInput" value="{{ $user->biodata->alamat }}">
                                                @error('alamat')
                                                    <div class="alert alert-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="basicInput" class="fw-bold">Email</label>
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="basicInput" value="{{ $user->email }}">
                                                @error('email')
                                                    <div class="alert alert-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>
@endsection