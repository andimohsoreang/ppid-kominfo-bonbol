@extends('be.layouts.app')


@section('container')
<div class="page-title">
    <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex mb-4 gap-3 align-items-center">
            @role('admin')
            <a href="{{ route('admin.pengajuankeberatan') }}" class="btn btn-dark icon">
                <i data-feather="arrow-left" width="20"></i>
            </a>
            @endrole
            @role('petugas')
            <a href="{{ route('petugas.pengajuankeberatan') }}" class="btn btn-dark icon">
                <i data-feather="arrow-left" width="20"></i>
            </a>
            @endrole
            @role('user')
            <a href="{{ route('user.pengajuankeberatan') }}" class="btn btn-dark icon">
                <i data-feather="arrow-left" width="20"></i>
            </a>
            @endrole
            <div class="">
                <h3 class="mb-0">Pengajuan Keberatan</h3>
                <p class="text-subtitle text-muted mb-0">Detail Pengajuan Keberatan</a></p>
            </div>
        </div>
        <div class="">
        </div>
    </div>
</div>
<!-- Basic Vertical form layout section start -->
<section id="basic-vertical-layouts">
    <div class="row match-height">
        <div class="@role('admin') @if($data->status != 0) col-lg-6 @else col-lg-4 @endif @endrole @role('petugas') @if($data->status != 0) col-lg-6 @else col-lg-4 @endif @endrole @role('user') col-lg-4 @endrole col-12">
            <div class="card mb-4">
                <div class="card-content">
                    <div class="card-body">
                        <h4>Detail Pengajuan</h4>
                        <hr>
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <h6 class="fw-bold">Pesan</h6>
                                        <p>{{ $data->pesan }}</p>
                                    </div>
                                    <div class="form-group">
                                        <h6 class="fw-bold">Tanggal Pengajuan</h6>
                                        <p>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->isoFormat('dddd, D MMMM Y') }}</p>
                                    </div>
                                    <div class="form-group">
                                        <h6 class="fw-bold">Waktu Pengajuan</h6>
                                        <p>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->isoFormat('HH:mm') }} WITA</p>
                                    </div>
                                    <div class="form-group">
                                        <h6 class="fw-bold">Status</h6>
                                        @if($data->status == 0)
                                        <p class="badge bg-warning">Dikirim</p>
                                        @elseif($data->status == 1)
                                        <p class="badge bg-success">Diterima</p>
                                        @elseif($data->status == 2)
                                        <p class="badge bg-danger">Ditolak</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @role('admin')
            @if($data->status == 0)  
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex gap-2 justify-content-between">
                                <form action="{{ route('admin.pengajuankeberatan.tolak', $data->id) }}" method="post" onsubmit="return confirm('Yakin tolak pengajuan ini?')">
                                    @csrf
                                    @method('put')
                                    <button type="submit" class="btn btn-danger fw-bold btn-block">
                                        <i data-feather="x"></i>
                                        Tolak Pengajuan
                                    </button>
                                </form>
                                <form action="{{ route('admin.pengajuankeberatan.terima', $data->id) }}" method="post" onsubmit="return confirm('Yakin terima pengajuan ini?')">
                                    @csrf
                                    @method('put')
                                    <button type="submit" class="btn btn-success fw-bold btn-block">
                                        <i data-feather="check"></i>
                                        Terima Pengajuan
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endrole
            @role('petugas')
            @if($data->status == 0)  
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex gap-2 justify-content-between">
                                <form action="{{ route('petugas.pengajuankeberatan.tolak', $data->id) }}" method="post" onsubmit="return confirm('Yakin tolak pengajuan ini?')">
                                    @csrf
                                    @method('put')
                                    <button type="submit" class="btn btn-danger fw-bold btn-block">
                                        <i data-feather="x"></i>
                                        Tolak Pengajuan
                                    </button>
                                </form>
                                <form action="{{ route('petugas.pengajuankeberatan.terima', $data->id) }}" method="post" onsubmit="return confirm('Yakin terima pengajuan ini?')">
                                    @csrf
                                    @method('put')
                                    <button type="submit" class="btn btn-success fw-bold btn-block">
                                        <i data-feather="check"></i>
                                        Terima Pengajuan
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endrole
        </div>
        @if($data->status == 1)
            @if(!empty($data->permohonaninformasi->pesan) && !empty($data->permohonaninformasi->file) )
            <div class="@role('admin') col-lg-6 @endrole @role('petugas') col-lg-6 @endrole @role('user') col-lg-4 @endrole col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4>Pesan & File</h4>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label class="fw-bold">Pesan</label>
                            <p>{{ $data->permohonaninformasi->pesan }}</p>
                        </div>
                        <div class="form-group">
                            <label class="fw-bold">File</label>
                            <p><a href="{{ asset($data->permohonaninformasi->file) }}" target="_blank"><i data-feather="file-text"></i>{{ $data->permohonaninformasi->file }}</a></p>
                        </div>
                    </div>
                </div>
            </div>
            @else
            @role('admin')
            <div class="col-lg-6 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4>Form Input Pesan & File</h4>
                        </div>
                        <hr>
                        <form id="mySend" action="{{ route('admin.pengajuankeberatan.sendterima', $data->permohonaninformasi->id) }}" method="post" enctype="multipart/form-data" onsubmit="return confirm('Data yang anda masukkan sudah benar?')">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label class="fw-bold">pesan</label>
                                <textarea name="pesan" rows="5" class="form-control @error('pesan') is-invalid @enderror"></textarea>
                                @error('pesan')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="fw-bold">File</label>
                                <div class="form-file">
                                    <input type="file" name="file" class="form-control-file">
                                </div>
                                @error('file')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                            <button type="submit" class="btn btn-primary fw-bold">
                                <i data-feather="send"></i> Kirim
                            </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endrole
            @role('petugas')
            <div class="col-lg-6 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4>Form Input Pesan & File</h4>
                        </div>
                        <hr>
                        <form id="mySend" action="{{ route('petugas.pengajuankeberatan.sendterima', $data->permohonaninformasi->id) }}" method="post" enctype="multipart/form-data" onsubmit="return confirm('Data yang anda masukkan sudah benar?')">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label class="fw-bold">pesan</label>
                                <textarea name="pesan" rows="5" class="form-control @error('pesan') is-invalid @enderror"></textarea>
                                @error('pesan')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="fw-bold">File</label>
                                <div class="form-file">
                                    <input type="file" name="file" class="form-control-file">
                                </div>
                                @error('file')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                            <button type="submit" class="btn btn-primary fw-bold">
                                <i data-feather="send"></i> Kirim
                            </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endrole
            @endif 
        @elseif($data->status == 2)
            @if(!empty($data->alasan))
            <div class="@role('admin') col-lg-6 @endrole @role('petugas') col-lg-6 @endrole @role('user') col-lg-4 @endrole col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4>Pesan / Alasan Pengajuan ditolak</h4>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label class="fw-bold">Pesan</label>
                            <p>{{ $data->alasan }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @else
            @role('admin')
            <div class="col-lg-6 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4>Form Input Alasan Pengajuan Ditolak</h4>
                        </div>
                        <hr>
                        <form id="mySend2" action="{{ route('admin.pengajuankeberatan.sendtolak', $data->id) }}" method="post" onsubmit="confirm('Data yang anda masukkan sudah benar?')">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label class="fw-bold">Alasan pengajuan ditolak</label>
                                <textarea name="alasan" rows="5" class="form-control @error('alasan') is-invalid @enderror"></textarea>
                                @error('alasan')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary fw-bold">
                                    <i data-feather="send"></i> Kirim
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endrole
            @role('petugas')
            <div class="col-lg-6 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4>Form Input Alasan Pengajuan Ditolak</h4>
                        </div>
                        <hr>
                        <form id="mySend2" action="{{ route('petugas.pengajuankeberatan.sendtolak', $data->id) }}" method="post" onsubmit="confirm('Data yang anda masukkan sudah benar?')">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label class="fw-bold">Alasan pengajuan ditolak</label>
                                <textarea name="alasan" rows="5" class="form-control @error('alasan') is-invalid @enderror"></textarea>
                                @error('alasan')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary fw-bold">
                                    <i data-feather="send"></i> Kirim
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endrole
            @endif 
        @endif
        <div class="@role('admin') @if($data->status != 0) col-lg-6 @else col-lg-4 @endif @endrole @role('petugas') @if($data->status != 0) col-lg-6 @else col-lg-4 @endif @endrole @role('user') col-lg-4 @endrole col-12">
            <div class="card">
                <div class="card-body">
                    <h4>Detail Permohonan</h4>
                    <hr>
                    <div class="form-group">
                        <label class="fw-bold">Rincian Informasi</label>
                        <p>{{ $data->permohonaninformasi->rincian }}</p>
                    </div>
                    <div class="form-group">
                        <label class="fw-bold">Tujuan Penggunaan Informasi</label>
                        <p>{{ $data->permohonaninformasi->tujuan }}</p>
                    </div>
                    <div class="form-group">
                        <label class="fw-bold">Mendapatkan Salinan Informasi</label>
                        <p>{{ $data->permohonaninformasi->mendapat }}</p>
                    </div>
                    <div class="form-group">
                        <label class="fw-bold">Cara Mendapatkan Salinan Informasi</label>
                        <p>{{ $data->permohonaninformasi->cara }}</p>
                    </div>
                    <div class="form-group">
                        <label class="fw-bold">Tanggal Permohonan</label>
                        <p>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $data->permohonaninformasi->created_at)->isoFormat('dddd, D MMMM Y') }}</p>
                    </div>
                    <div class="form-group">
                        <label class="fw-bold">Waktu Permohonan</label>
                        <p>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $data->permohonaninformasi->created_at)->isoFormat('H:m') }} WITA</p>
                    </div>
                    <div class="form-group">
                        <label class="fw-bold">Pesan / Alasan ditolak</label>
                        <p>{{ $data->permohonaninformasi->alasan_tolak }}</p>
                    </div>
                </div>
            </div>
        </div>
        @role('admin')
        <div class="@role('admin') @if($data->status != 0) col-lg-6 @else col-lg-4 @endif @endrole @role('user') col-lg-6 @endrole col-12">
            <div class="card">
                <div class="card-body">
                    <h4>Biodata Pemohon</h4>
                    <hr>
                    <div class="form-group">
                        @if( $data->user->biodata->kategori_pemohon == 1)
                        <label class="fw-bold">Nama Lembaga/Instansi</label>
                        @else
                        <label class="fw-bold">Nama Lengkap</label>
                        @endif
                        <p>{{ $data->user->name }}</p>
                    </div>
                    <div class="form-group">
                        @if( $data->user->biodata->kategori_pemohon == 1)
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
        </div>
        @endrole
        @role('petugas')
        <div class="@role('petugas') @if($data->status != 0) col-lg-6 @else col-lg-4 @endif @endrole @role('user') col-lg-6 @endrole col-12">
            <div class="card">
                <div class="card-body">
                    <h4>Biodata Pemohon</h4>
                    <hr>
                    <div class="form-group">
                        @if( $data->user->biodata->kategori_pemohon == 1)
                        <label class="fw-bold">Nama Lembaga/Instansi</label>
                        @else
                        <label class="fw-bold">Nama Lengkap</label>
                        @endif
                        <p>{{ $data->user->name }}</p>
                    </div>
                    <div class="form-group">
                        @if( $data->user->biodata->kategori_pemohon == 1)
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
        </div>
        @endrole
    </div>
</section>
@endsection