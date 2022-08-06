@extends('layouts.app')

@section('content')
@include('sweetalert::alert')
<section class="section mt-5">
  <div class="container">

    <h6 class="xs-font mb-0 text-center">PPID Bone Bolango</h6>
    <h3 class="section-title mb-4 text-center">Permohonan Informasi Publik</h3>
    <div class="my-5">
      <h5 class="text-center">PILIH KATEGORI PEMOHON</h5>
      <hr>
      <div class="row mt-4">
        <div class="col-lg-6">
          <a href="{{ route('lembaga.register') }}">
            <div class="card shadow-sm bg-primary border-0">
              <div class="card-body text-light">
                <div class="d-flex flex-column align-items-center justify-content-center py-4">
                  <h1 class="mb-1"><i class="ti-write"></i></h1>
                  <h3 class="m-0">LEMBAGA/INSTANSI</h3>
                  <p class="mt-3 mb-0 text-light">Registrasi akun sebagai lembaga atau instansi.</p>
                </div>
              </div>
            </div>
          </a>
        </div>
        <div class="col-lg-6">
          <a href="{{ route('perorangan.register') }}">
            <div class="card shadow-sm bg-primary border-0">
              <div class="card-body text-light">
                <div class="d-flex flex-column align-items-center justify-content-center py-4">
                  <h1 class="mb-1"><i class="ti-write"></i></h1>
                  <h3 class="m-0">PERORANGAN</h3>
                  <p class="mt-3 mb-0 text-light">Registrasi akun perorangan.</p>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>

    <div class="row justify-content-center mb-5">
      <div class="col-12 col-md-6 col-lg-4">
        <div class="card shadow-lg border border-primary">
          <div class="card-body">
            <div class="d-flex align-items-center">
              <h1 class="m-0">
                <i class="ti-user"></i>
              </h1>
              <div class="ml-3">
                <p class="m-0 font-weight-bold text-primary">
                  Total Pengguna
                </p>
                <h4 class="m-0">{{ $total_user ?? '' }}</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-6 col-lg-4">
        <div class="card shadow-lg border border-primary">
          <div class="card-body">
            <div class="d-flex align-items-center">
              <h1 class="m-0">
                <i class="ti-user"></i>
              </h1>
              <div class="ml-3">
                <p class="m-0 font-weight-bold text-primary">
                  Lembaga/Instansi
                </p>
                <h4 class="m-0">{{ $total_lembaga ?? '' }}</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-6 col-lg-4">
        <div class="card shadow-lg border border-primary">
          <div class="card-body">
            <div class="d-flex align-items-center">
              <h1 class="m-0">
                <i class="ti-user"></i>
              </h1>
              <div class="ml-3">
                <p class="m-0 font-weight-bold text-primary">
                  Perorangan
                </p>
                <h4 class="m-0">{{ $total_perorangan ?? '' }}</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    {{-- <form action="{{ route('pemohon.register.store') }}" method="post" enctype="multipart/form-data">
      @csrf
      <div class="row">
        <div class="col-lg-6">
          <div class="form-group">
            <label for="kategori">Kategori Pemohon</label>
            <select class="form-control @error('kategori_pemohon') is-invalid @enderror" name="kategori_pemohon"
              id="kategori" onchange="showDiv(this)">
              <option value="" hidden>Pilih Kategori</option>
              <option value=1>Lembaga/Instansi</option>
              <option value=2>Perorangan</option>
            </select>
            @error('kategori_pemohon')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div id="hidden_div_lembaga" style="display: none;" class="form-group">
            <label for="no_identitas1">NIK/No.Identitas Lembaga</label>
            <input type="text" name="no_identitas" class="form-control @error('no_identitas') is-invalid @enderror"
              id="no_identitas1" placeholder="" value="{{ old('no_identitas1') }}">
            @error('no_identitas1')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div id="hidden_div_pribadi" style="display: none;" class="form-group">
            <label for="no_identitas2">NIK/No.Identitas Pribadi</label>
            <input type="text" name="no_identitas" class="form-control @error('no_identitas') is-invalid @enderror"
              id="no_identitas2" placeholder="" value="{{ old('no_identitas2') }}">
            @error('no_identitas2')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div id="hidden_div_lembaga_1" style="display: none;" class="form-group">
            <label for="nama1">Nama Lembaga / Organisasi</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="nama1"
              placeholder="" value="{{ old('nama1') }}">
            @error('name')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div id="hidden_div_pribadi_1" style="display: none;" class="form-group">
            <label for="nama2">Nama Lengkap</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="nama2"
              placeholder="" value="{{ old('nama2') }}">
            @error('name2')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div id="hidden_div_pribadi_2" style="display: none;" class="form-group">
            <label>Upload KTP Pribadi</label>
            <input type="file" name="file_path" class="form-control-file @error('file_path') is-invalid @enderror">
            <p class="font-italic text-muted small">*File yang boleh diupload jpg, jpeg, png dan maksimal 2MB.</p>
            @error('file_path')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div id="hidden_div_lembaga_2" style="display: none;" class="form-group">
            <label>Upload Akta Notaris Lembaga / Organisasi</label>
            <input type="file" name="file_path" class="form-control-file @error('file_path') is-invalid @enderror">
            <p class="font-italic text-muted small">*File yang boleh diupload jpg, jpeg, png dan maksimal 2MB.</p>
            @error('file_path')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" placeholder="..."
              id="alamat">{{ old('alamat') }}</textarea>
            @error('alamat')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-group">
            <label for="no_telp">Nomor Telepon</label>
            <input type="text" name="no_telp" class="form-control @error('no_telp') is-invalid @enderror" id="no_telp"
              placeholder="08XX-XXXX-XXXX" value="{{ old('no_telp') }}">
            @error('no_telp')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-group">
            <label for="pekerjaan">Pekerjaan</label>
            <input type="text" name="pekerjaan" class="form-control @error('pekerjaan') is-invalid @enderror"
              id="pekerjaan" placeholder="Masukan pekerjaan anda :)" value="{{ old('pekerjaan') }}">
            @error('pekerjaan')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email"
              placeholder="Masukan email anda :)" value="{{ old('email') }}">
            @error('email')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
              id="password">
            @error('password')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-group">
            <label for="konfirmasi_password">Konfirmasi Password</label>
            <input type="password" name="konfirmasi_password"
              class="form-control @error('konfirmasi_password') is-invalid @enderror" id="konfirmasi_password">
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
    </form> --}}

  </div>
</section>
@endsection

{{-- @section('scripts')
<script type="text/javascript">
  function showDiv(select){
       if(select.value==2){
           document.getElementById('hidden_div_pribadi').style.display = "block";
           document.getElementById('hidden_div_pribadi_1').style.display = "block";
           document.getElementById('hidden_div_pribadi_2').style.display = "block";

           document.getElementById('hidden_div_lembaga').style.display = "none";
           document.getElementById('hidden_div_lembaga_1').style.display = "none";
           document.getElementById('hidden_div_lembaga_2').style.display = "none";
       }else if(select.value==1){
           document.getElementById('hidden_div_lembaga').style.display = "block";
           document.getElementById('hidden_div_lembaga_1').style.display = "block";
           document.getElementById('hidden_div_lembaga_2').style.display = "block";
   
           document.getElementById('hidden_div_pribadi').style.display = "none";
           document.getElementById('hidden_div_pribadi_1').style.display = "none";
           document.getElementById('hidden_div_pribadi_2').style.display = "none";
       }else if(select.value=="") {
           document.getElementById('hidden_div_pribadi').style.display = "none";
           document.getElementById('hidden_div_pribadi_1').style.display = "none";
           document.getElementById('hidden_div_pribadi_2').style.display = "none";
   
           document.getElementById('hidden_div_lembaga').style.display = "none";
           document.getElementById('hidden_div_lembaga_1').style.display = "none";
           document.getElementById('hidden_div_lembaga_2').style.display = "none";
       }
    }
</script>
@endsection --}}