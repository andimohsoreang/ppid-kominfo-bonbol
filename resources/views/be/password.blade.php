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
                        <h5 class="m-0">Pengaturan Password</h5>
                        @role('admin')
                        <a href="{{ route('admin.akun') }}" class="btn icon btn-primary fw-bold"><i data-feather="settings"></i> Pengaturan Akun</a>
                        @endrole
                        @role('petugas')
                        <a href="{{ route('petugas.akun') }}" class="btn icon btn-primary fw-bold"><i data-feather="settings"></i> Pengaturan Akun</a>
                        @endrole
                        @role('user')
                        <a href="{{ route('user.akun') }}" class="btn icon btn-primary fw-bold"><i data-feather="settings"></i> Pengaturan Akun</a>
                        @endrole
                    </div>
                    <hr>
                    @role('admin')
                    <form action="{{ route('admin.password.update', Auth::user()->id) }}" method="post">
                    @endrole
                    @role('petugas')
                    <form action="{{ route('petugas.password.update', Auth::user()->id) }}" method="post">
                    @endrole
                    @role('user')
                    <form action="{{ route('user.password.update', Auth::user()->id) }}" method="post">
                    @endrole
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label class="fw-bold">Password Sekarang</label>
                            <input type="password" name="password" class="form-control mypassword @error('password') is-invalid @enderror">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="fw-bold">Password Baru</label>
                            <input type="password" name="password_baru" class="form-control mypassword @error('password_baru') is-invalid @enderror">
                            @error('password_baru')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="fw-bold">Konfirmasi Password Baru</label>
                            <input type="password" name="konfirmasi_password_baru" class="form-control mypassword @error('konfirmasi_password_baru') is-invalid @enderror">
                            @error('konfirmasi_password_baru')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="checkbox" id="lihatpassword">
                            <label for="lihatpassword">Lihat Password</label>
                        </div>
                        <div class="form-group mt-4 mb-0">
                            <button type="reset" class="btn btn-secondary fw-bold">Reset</button>
                            <button type="submit" class="btn btn-success fw-bold">Update</button>   
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script type="text/javascript">
	$(document).ready(function(){		
		$('#lihatpassword').click(function(){
			if($(this).is(':checked')){
				$('.mypassword').attr('type','text');
			}else{
				$('.mypassword').attr('type','password');
			}
		});
	});
</script>
@endsection