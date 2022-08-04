@extends('be.layouts.app')


@section('container')
<div class="page-title">
    <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex mb-4 gap-3 align-items-center">
            <a href={{ url()->previous() }} class="btn btn-dark icon">
                <i data-feather="arrow-left" width="20"></i>
            </a>
            <div class="">
                <h3 class="mb-0">Permohonan Informasi</h3>
                <p class="text-subtitle text-muted mb-0">Form Edit Permohonan Informasi</a></p>
            </div>
        </div>
        <div class="">
        </div>
    </div>
</div>
<!-- Basic Vertical form layout section start -->
<section id="basic-vertical-layouts">
    <div class="row match-height">
        <div class="col-lg-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        @role('admin')
                        <form action="{{ route('admin.permohonaninformasi.update', $data->id) }}" method="POST">
                        @endrole
                        @role('user')
                        <form action="{{ route('user.permohonaninformasi.update', $data->id) }}" method="POST">
                        @endrole
                            @csrf
                            @method('put')
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <h6 class="fw-bold">Rincian Informasi</h6>
                                            <textarea name="rincian" rows="5"
                                                class="form-control @error('rincian') is-invalid @enderror">{{ $data->rincian }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <h6 class="fw-bold">Tujuan Penggunaan Informasi</h6>
                                            <textarea name="tujuan" rows="5"
                                                class="form-control @error('tujuan') is-invalid @enderror">{{ $data->tujuan }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <h6 class="fw-bold">Mendapatkan Salinan Informasi</h6>
                                            <div class="d-flex gap-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="Soft Copy" name="mendapat"
                                                        id="mendapat1" {{ $data->mendapat == 'Soft Copy' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="mendapat1">
                                                        Soft Copy
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="Hard Copy" name="mendapat"
                                                        id="mendapat2" {{ $data->mendapat == 'Hard Copy' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="mendapat2">
                                                        Hard Copy
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <h6 class="fw-bold">Cara Mendapatkan Salinan Informasi</h6>
                                            <div class="d-flex gap-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="Mengambil Langsung" name="cara"
                                                        id="cara1" {{ $data->cara == 'Mengambil Langsung' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="cara1">
                                                        Mengambil Langsung
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="Online By System" name="cara"
                                                        id="cara2" {{ $data->cara == 'Online By System' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="cara2">
                                                        Online By System
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="d-flex gap-2 float-end">
                                                <button type="reset"
                                                    class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                                <button type="submit" class="btn btn-primary me-1 mb-1">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-12">
            @role('admin')
            <div class="card">
                <div class="card-body">
                    <h4>Biodata</h4>
                    <hr>
                    <div class="form-group">
                        @if($data->user->biodata->kategori_pemohon == 1)
                        <label class="fw-bold">Nama Lembaga/Instansi</label>
                        @else
                        <label class="fw-bold">Nama Lengkap</label>
                        @endif
                        <p>{{ $data->user->name }}</p>
                    </div>
                    <div class="form-group">
                        @if($data->user->biodata->kategori_pemohon == 1)
                        <label class="fw-bold">NIK/Nomor Identitas Lembaga</label>
                        @else
                        <label class="fw-bold">NIK/Nomor Identitas Pribadi</label>
                        @endif
                        <p>{{ $data->user->biodata->no_identitas }}</p>
                    </div>
                    <div class="form-group">
                        <label class="fw-bold">Alamat</label>
                        <p>{{ $data->user->biodata->alamat }}</p>
                    </div>
                    <div class="form-group">
                        <label class="fw-bold">Nomor Telepon</label>
                        <p>{{ $data->user->biodata->no_telp }}</p>
                    </div>
                    <div class="form-group">
                        <label class="fw-bold">Pekerjaan</label>
                        <p>{{ $data->user->biodata->pekerjaan }}</p>
                    </div>
                    <div class="form-group">
                        <label class="fw-bold">Email</label>
                        <p>{{ $data->user->email }}</p>
                    </div>
                </div>
            </div>
            @endrole
            @role('user')
            <div class="card">
                <div class="card-body">
                    <h4>Biodata</h4>
                    <hr>
                    <div class="form-group">
                        @if(Auth::user()->biodata->kategori_pemohon == 1)
                        <label class="fw-bold">Nama Lembaga/Instansi</label>
                        @else
                        <label class="fw-bold">Nama Lengkap</label>
                        @endif
                        <p>{{ Auth::user()->name }}</p>
                    </div>
                    <div class="form-group">
                        @if(Auth::user()->biodata->kategori_pemohon == 1)
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
                </div>
            </div>
            @endrole
        </div>
    </div>
</section>
@endsection