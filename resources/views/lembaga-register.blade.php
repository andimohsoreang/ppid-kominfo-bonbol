@extends('layouts.app')

@section('content')
@include('sweetalert::alert')
<section class="section mt-5">
    <div class="container">

        <h6 class="xs-font mb-0 text-center">PPID Bone Bolango</h6>
        <h3 class="section-title mb-4 text-center">Permohonan Informasi Publik</h3>
        <h5> Form Registrasi Lembaga/Instansi</h5>

        <form action="{{ route('lembaga.register.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <div id="hidden_div_lembaga" class="form-group">
                        <label for="no_identitas1">NIK/No.Identitas Lembaga</label>
                        <input type="text" name="no_identitas"
                            class="form-control @error('no_identitas') is-invalid @enderror" id="no_identitas1"
                            placeholder="" value="{{ old('no_identitas1') }}">
                        @error('no_identitas1')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div id="hidden_div_lembaga_1" class="form-group">
                        <label for="nama1">Nama Lembaga / Organisasi</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            id="nama1" placeholder="" value="{{ old('nama1') }}">
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div id="hidden_div_lembaga_2" class="form-group">
                        <label>Upload Akta Notaris Lembaga / Organisasi</label>
                        <input type="file" name="file_path"
                            class="form-control-file @error('file_path') is-invalid @enderror">
                        <p class="font-italic text-muted small">*File yang boleh diupload jpg, jpeg, png dan maksimal
                            2MB.</p>
                        @error('file_path')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="no_telp">Nomor Telepon</label>
                        <input type="text" name="no_telp" class="form-control @error('no_telp') is-invalid @enderror"
                            id="no_telp" placeholder="08XX-XXXX-XXXX" value="{{ old('no_telp') }}">
                        @error('no_telp')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="pekerjaan">Pekerjaan</label>
                        <input type="text" name="pekerjaan"
                            class="form-control @error('pekerjaan') is-invalid @enderror" id="pekerjaan"
                            placeholder="Masukan pekerjaan anda :)" value="{{ old('pekerjaan') }}">
                        @error('pekerjaan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat"
                            placeholder="..." id="alamat">{{ old('alamat') }}</textarea>
                        @error('alamat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            id="email" placeholder="Masukan email anda :)" value="{{ old('email') }}">
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password"
                            class="form-control @error('password') is-invalid @enderror" id="password">
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="konfirmasi_password">Konfirmasi Password</label>
                        <input type="password" name="konfirmasi_password"
                            class="form-control @error('konfirmasi_password') is-invalid @enderror"
                            id="konfirmasi_password">
                        @error('konfirmasi_password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-12">
                    <div class="float-right">
                        <button type="reset" class="btn btn-secondary">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </form>

    </div>
</section>
@endsection