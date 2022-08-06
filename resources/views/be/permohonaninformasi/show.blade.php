@extends('be.layouts.app')


@section('container')
<div class="page-title">
    <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex mb-4 gap-3 align-items-center">
            @role('admin')
            <a href={{ route('admin.permohonaninformasi') }} class="btn btn-dark icon">
                <i data-feather="arrow-left" width="20"></i>
            </a>
            @endrole
            @role('petugas')
            <a href={{ route('petugas.permohonaninformasi') }} class="btn btn-dark icon">
                <i data-feather="arrow-left" width="20"></i>
            </a>
            @endrole
            @role('user')
            <a href={{ route('user.permohonaninformasi') }} class="btn btn-dark icon">
                <i data-feather="arrow-left" width="20"></i>
            </a>
            @endrole
            <div class="">
                <h3 class="mb-0">Permohonan Informasi</h3>
                <p class="text-subtitle text-muted mb-0">Form Permohonan Informasi</a></p>
            </div>
        </div>
        <div class="">
        </div>
    </div>
</div>
<!-- Basic Vertical form layout section start -->
<section id="basic-vertical-layouts">
    <div class="row match-height">
        <div class="@if($data->status == 2) col-lg-4 @elseif($data->status == 3) col-lg-4 @else col-lg-6 @endif col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>Detail Permohonan</h4>
                        @role('user|admin')
                        <h5 class="m-0" title="Petugas">
                            <i data-feather="user"></i>
                            @if($data->status == 1)
                            <span class="small">Diproses : {{ $data->petugas->name }}</span>
                            @elseif($data->status == 2)
                            <span class="small">Diterima : {{ $data->petugas->name }}</span>
                            @elseif($data->status == 3)
                            <span class="small">Ditolak : {{ $data->petugas->name }}</span>
                            @elseif($data->status == 4)
                            <span class="small">Keberatan Diproses : {{ $data->petugas->name }}</span>
                            @endif
                        </h5>
                        @endrole
                    </div>
                    <hr>
                    <div class="form-group">
                        <label class="fw-bold">Rincian Informasi</label>
                        <p>{{ $data->rincian }}</p>
                    </div>
                    <div class="form-group">
                        <label class="fw-bold">Tujuan Penggunaan Informasi</label>
                        <p>{{ $data->tujuan }}</p>
                    </div>
                    <div class="form-group">
                        <label class="fw-bold">Mendapatkan Salinan Informasi</label>
                        <p>{{ $data->mendapat }}</p>
                    </div>
                    <div class="form-group">
                        <label class="fw-bold">Cara Mendapatkan Salinan Informasi</label>
                        <p>{{ $data->cara }}</p>
                    </div>
                    <div class="form-group">
                        <label class="fw-bold">Tanggal Permohonan</label>
                        <p>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->isoFormat('dddd, D MMMM Y') }}</p>
                    </div>
                    <div class="form-group">
                        @if($data->status == 0)
                            <div class="d-block bg-warning py-3 px-2 text-center">
                                <h6 class="m-0 fw-bold">STATUS DIKIRIM</h6>
                            </div>
                        @elseif($data->status == 1)
                            <div class="d-block bg-info py-3 px-2 text-center">
                                <h6 class="m-0 fw-bold text-white">STATUS DIPROSES</h6>
                            </div>
                        @elseif($data->status == 2)
                            <div class="d-block bg-success py-3 px-2 text-center">
                                <h6 class="m-0 fw-bold text-white">STATUS DITERIMA</h6>
                            </div>
                        @elseif($data->status == 3)
                            <div class="d-block bg-danger py-3 px-2 text-center">
                                <h6 class="m-0 fw-bold text-white">STATUS DITOLAK</h6>
                            </div>
                        @elseif($data->status == 4)
                            <div class="d-block bg-info py-3 px-2 text-center">
                                <h6 class="m-0 fw-bold text-white">STATUS KEBERATAN DIPROSES</h6>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @if($data->status == 2)     
            @if(!empty($data->pesan) && !empty($data->file) )
            <div class="col-lg-4 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4>Pesan & File</h4>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label class="fw-bold">Pesan</label>
                            <p>{{ $data->pesan }}</p>
                        </div>
                        <div class="form-group">
                            <label class="fw-bold">File</label>
                            <p><a href="{{ asset($data->file) }}" target="_blank"><i data-feather="file-text"></i>{{ $data->file }}</a></p>
                        </div>
                    </div>
                </div>
            </div>
            @else
            @role('admin')
            <div class="col-lg-4 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4>Form Input Pesan & File</h4>
                        </div>
                        <hr>
                        <form id="mySend" action="{{ route('admin.permohonaninformasi.sendterima', $data->id) }}" method="post" enctype="multipart/form-data">
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
                        </form>
                        <div class="form-group">
                            <div class="d-flex gap-2">
                                <form action="{{ route('admin.permohonaninformasi.batalterima', $data->id) }}" method="post" onsubmit="return confirm('Yakin membatalkan permohonan informasi ini?')">
                                    @csrf
                                    @method('put')
                                    
                                    <button type="submit" class="btn btn-secondary fw-bold">
                                        <i data-feather="check"></i> Batal Terima
                                    </button>
                                </form>
                                <a href="javascript:{}" class="btn btn-primary fw-bold" onclick="if(!confirm('Data yang anda masukkan sudah benar?')){return false;}else{document.getElementById('mySend').submit();}">
                                    <i data-feather="send"></i> Kirim
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endrole
            @role('petugas')
            <div class="col-lg-4 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4>Form Input Pesan & File</h4>
                        </div>
                        <hr>
                        <form id="mySend" action="{{ route('petugas.permohonaninformasi.sendterima', $data->id) }}" method="post" enctype="multipart/form-data">
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
                        </form>
                        <div class="form-group">
                            <div class="d-flex gap-2">
                                <form action="{{ route('petugas.permohonaninformasi.batalterima', $data->id) }}" method="post" onsubmit="return confirm('Yakin membatalkan permohonan informasi ini?')">
                                    @csrf
                                    @method('put')
                                    
                                    <button type="submit" class="btn btn-secondary fw-bold">
                                        <i data-feather="check"></i> Batal Terima
                                    </button>
                                </form>
                                <a href="javascript:{}" class="btn btn-primary fw-bold" onclick="if(!confirm('Data yang anda masukkan sudah benar?')){return false;}else{document.getElementById('mySend').submit();}">
                                    <i data-feather="send"></i> Kirim
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endrole
            @endif  
        @elseif($data->status == 3) 
            @if(!empty($data->alasan_tolak))
            <div class="col-lg-4 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4>Pesan / Alasan ditolak</h4>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label class="fw-bold">Pesan</label>
                            <p>{{ $data->alasan_tolak }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @else
            @role('admin')
            <div class="col-lg-4 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4>Form Input Pesan / Alasan ditolak</h4>
                        </div>
                        <hr>
                        <form id="mySend2" action="{{ route('admin.permohonaninformasi.sendtolak', $data->id) }}" method="post">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label class="fw-bold">Pesan / Alasan ditolak</label>
                                <textarea name="alasan_tolak" rows="5" class="form-control @error('alasan_tolak') is-invalid @enderror"></textarea>
                                @error('alasan_tolak')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </form>
                        <div class="form-group">
                            <div class="d-flex gap-2">
                                <form action="{{ route('admin.permohonaninformasi.batalterima', $data->id) }}" method="post" onsubmit="return confirm('Yakin membatalkan permohonan informasi ini?')">
                                    @csrf
                                    @method('put')
                                    
                                    <button type="submit" class="btn btn-secondary fw-bold">
                                        Batal Tolak
                                    </button>
                                </form>
                                <a href="javascript:{}" class="btn btn-primary fw-bold" onclick="if(!confirm('Data yang anda masukkan sudah benar?')){return false;}else{document.getElementById('mySend2').submit();}">
                                    <i data-feather="send"></i> Kirim Pesan
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endrole
            @role('petugas')
            <div class="col-lg-4 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4>Form Input Pesan / Alasan ditolak</h4>
                        </div>
                        <hr>
                        <form id="mySend2" action="{{ route('petugas.permohonaninformasi.sendtolak', $data->id) }}" method="post">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label class="fw-bold">Pesan / Alasan ditolak</label>
                                <textarea name="alasan_tolak" rows="5" class="form-control @error('alasan_tolak') is-invalid @enderror"></textarea>
                                @error('alasan_tolak')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </form>
                        <div class="form-group">
                            <div class="d-flex gap-2">
                                <form action="{{ route('petugas.permohonaninformasi.batalterima', $data->id) }}" method="post" onsubmit="return confirm('Yakin membatalkan permohonan informasi ini?')">
                                    @csrf
                                    @method('put')
                                    
                                    <button type="submit" class="btn btn-secondary fw-bold">
                                        Batal Tolak
                                    </button>
                                </form>
                                <a href="javascript:{}" class="btn btn-primary fw-bold" onclick="if(!confirm('Data yang anda masukkan sudah benar?')){return false;}else{document.getElementById('mySend2').submit();}">
                                    <i data-feather="send"></i> Kirim Pesan
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endrole
            @endif  
        @endif
        <div class="@if($data->status == 2) col-lg-4 @elseif($data->status == 3) col-lg-4 @else col-lg-6 @endif col-12">
            <div class="card">
                <div class="card-body">
                    <h4>Biodata</h4>
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
    </div>
    @role('admin')
    @if($data->status == 1)    
    <div class="row">
        <div class="col-12">
            <div class="d-flex gap-2">
                <form action="{{ route('admin.permohonaninformasi.tolak', $data->id) }}" method="post" onsubmit="return confirm('Yakin menolak permohonan informasi ini?')">
                    @csrf
                    @method('put')
                    <button type="submit" class="btn btn-danger fw-bold">
                        <i data-feather="x"></i> Tolak
                    </button>
                </form>
                <form action="{{ route('admin.permohonaninformasi.terima', $data->id) }}" method="post" onsubmit="return confirm('Yakin menerima permohonan informasi ini?')">
                    @csrf
                    @method('put')
                    
                    <button type="submit" class="btn btn-success fw-bold">
                        <i data-feather="check"></i> Terima
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endif
    @endrole
    @role('petugas')
    @if($data->status == 1)    
    <div class="row">
        <div class="col-12">
            <div class="d-flex gap-2">
                <form action="{{ route('petugas.permohonaninformasi.tolak', $data->id) }}" method="post" onsubmit="return confirm('Yakin menolak permohonan informasi ini?')">
                    @csrf
                    @method('put')
                    <button type="submit" class="btn btn-danger fw-bold">
                        <i data-feather="x"></i> Tolak
                    </button>
                </form>
                <form action="{{ route('petugas.permohonaninformasi.terima', $data->id) }}" method="post" onsubmit="return confirm('Yakin menerima permohonan informasi ini?')">
                    @csrf
                    @method('put')
                    
                    <button type="submit" class="btn btn-success fw-bold">
                        <i data-feather="check"></i> Terima
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endif
    @endrole
</section>
@endsection