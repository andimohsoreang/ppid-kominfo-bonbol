@extends('be.layouts.app')

@section('container')
@include('sweetalert::alert')

<div class="page-title">
    <h3>Akun & Pengaturan</h3>
    <p class="text-subtitle text-muted">Informasi & Pengaturan Akun</p>
</div>
<section class="section">
    <div class="row mb-2">
        <div class="col-12 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5>Detail Akun</h5>
                    <hr>
                    @role('admin')
                    <div class="form-group">
                        <label class="fw-bold">Nama</label>
                        <p>{{ Auth::user()->name }}</p>
                    </div>
                    <div class="form-group">
                        <label class="fw-bold">Email</label>
                        <p>{{ Auth::user()->email }}</p>
                    </div>
                    @endrole
                    @role('petugas')
                    <div class="form-group">
                        <label class="fw-bold">Nama</label>
                        <p>{{ Auth::user()->name }}</p>
                    </div>
                    <div class="form-group">
                        <label class="fw-bold">Email</label>
                        <p>{{ Auth::user()->email }}</p>
                    </div>
                    @endrole
                    @role('user')
                    <div class="form-group">
                        @if( Auth::user()->biodata->kategori_pemohon == 1)
                        <label class="fw-bold">Nama Lembaga/Instansi</label>
                        @else
                        <label class="fw-bold">Nama Lengkap</label>
                        @endif
                        <p class="m-0">{{ Auth::user()->name }}</p>
                    </div>
                    <div class="form-group">
                        @if( Auth::user()->biodata->kategori_pemohon == 1)
                        <label class="fw-bold">NIK/Nomor Identitas Lembaga</label>
                        @else
                        <label class="fw-bold">NIK/Nomor Identitas Pribadi</label>
                        @endif
                        <p>{{ Auth::user()->biodata->no_identitas }}</p>
                    </div>
                    <div class="form-group">
                        <label class="fw-bold">Alamat</label>
                        <p>{{ Auth::user()->biodata->alamat }}</p>
                    </div>
                    <div class="form-group">
                        <label class="fw-bold">Nomor Telepon</label>
                        <p>{{ Auth::user()->biodata->no_telp }}</p>
                    </div>
                    <div class="form-group">
                        <label class="fw-bold">Pekerjaan</label>
                        <p>{{ Auth::user()->biodata->pekerjaan }}</p>
                    </div>
                    <div class="form-group">
                        <label class="fw-bold">Email</label>
                        <p>{{ Auth::user()->email }}</p>
                    </div>
                    <div class="form-group">
                        @if( Auth::user()->biodata->kategori_pemohon == 1)
                        <label class="fw-bold">Akta Notaris Lembaga/Organisasi</label>
                        <p><a href="{{ asset(Auth::user()->biodata->file_path) }}" target="_blank" class="btn icon btn-primary"><i data-feather="file"></i> File Anda</a></p>
                        @else
                        <label class="fw-bold">KTP Pribadi</label>
                        <p><a href="{{ asset(Auth::user()->biodata->file_path) }}" target="_blank" class="btn icon btn-primary"><i data-feather="credit-card"></i> KTP</a></p>
                        @endif
                    </div>
                    @endrole
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="m-0">Pengaturan Akun</h5>
                        @role('admin')
                        <a href="{{ route('admin.password') }}" class="btn icon btn-primary fw-bold"><i data-feather="key"></i> Ganti Password</a>
                        @endrole
                        @role('petugas')
                        <a href="{{ route('petugas.password') }}" class="btn icon btn-primary fw-bold"><i data-feather="key"></i> Ganti Password</a>
                        @endrole
                        @role('user')
                        <a href="{{ route('user.password') }}" class="btn icon btn-primary fw-bold"><i data-feather="key"></i> Ganti Password</a>
                        @endrole
                    </div>
                    <hr>
                    @role('admin')
                    <form action="{{ route('admin.akun.update', Auth::user()->id) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label class="fw-bold">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ Auth::user()->name }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="fw-bold">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ Auth::user()->email }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-4 mb-0">
                            <button type="reset" class="btn btn-secondary fw-bold">Reset</button>
                            <button type="submit" class="btn btn-success fw-bold">Update</button>   
                        </div>
                    </form>
                    @endrole
                    @role('petugas')
                    <form action="{{ route('petugas.akun.update', Auth::user()->id) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label class="fw-bold">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ Auth::user()->name }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="fw-bold">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ Auth::user()->email }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-4 mb-0">
                            <button type="reset" class="btn btn-secondary fw-bold">Reset</button>
                            <button type="submit" class="btn btn-success fw-bold">Update</button>   
                        </div>
                    </form>
                    @endrole
                    @role('user')
                    <form action="{{ route('user.akun.update', Auth::user()->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <input type="hidden" name="kategori" value="{{ Auth::user()->biodata->kategori_pemohon }}">
                        <div class="form-group">
                            @if( Auth::user()->biodata->kategori_pemohon == 1)
                            <label class="fw-bold">Nama Lembaga/Instansi</label>
                            @else
                            <label class="fw-bold">Nama Lengkap</label>
                            @endif
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ Auth::user()->name }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            @if( Auth::user()->biodata->kategori_pemohon == 1)
                            <label class="fw-bold">NIK/Nomor Identitas Lembaga</label>
                            @else
                            <label class="fw-bold">NIK/Nomor Identitas Pribadi</label>
                            @endif
                            <input type="text" name="no_identitas" class="form-control @error('no_identitas') is-invalid @enderror" value="{{ Auth::user()->biodata->no_identitas }}">
                            @error('no_identitas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            @if( Auth::user()->biodata->kategori_pemohon == 1)
                            <label class="fw-bold">Akta Notaris Lembaga / Organisasi</label>
                            @else
                            <label class="fw-bold">KTP Pribadi</label>
                            @endif
                            <div class="form-file">
                                <input type="hidden" name="file_lama" value="{{ Auth::user()->biodata->file_path }}">
                                <input type="file" name="file" class="form-control-file">
                            </div>
                            @error('file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="fw-bold">Alamat</label>
                            <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" value="{{ Auth::user()->biodata->alamat }}">
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="fw-bold">Nomor Telepon</label>
                            <input type="text" name="no_telp" class="form-control @error('no_telp') is-invalid @enderror" value="{{ Auth::user()->biodata->no_telp }}">
                            @error('no_telp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="fw-bold">Pekerjaan</label>
                            <input type="text" name="pekerjaan" class="form-control @error('pekerjaan') is-invalid @enderror" value="{{ Auth::user()->biodata->pekerjaan }}">
                            @error('pekerjaan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="fw-bold">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ Auth::user()->email }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-4 mb-0">
                            <button type="reset" class="btn btn-secondary fw-bold">Reset</button>
                            <button type="submit" class="btn btn-success fw-bold">Update</button>   
                        </div>
                    </form>
                    @endrole
                </div>
            </div>
        </div>
    </div>
</section>
@endsection