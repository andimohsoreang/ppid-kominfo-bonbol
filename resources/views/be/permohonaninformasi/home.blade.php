@extends('be.layouts.app')

@section('container')

@include('sweetalert::alert')
<div class="main-content container-fluid">
    <div class="page-title">
        <div class="d-flex justify-content-between align-items-center">
            <div class="">
                <h3>Permohonan Informasi</h3>
                <p class="text-subtitle text-muted">Buat permohonan informasi</a>.</p>
            </div>
            <div class="">
                @role('user')
                <a href="{{ route('user.permohonaninformasi.create') }}" class="btn btn-outline-primary block fw-bold px-5">
                    Buat Permohonan
                </a>
                @endrole
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <table class='table table-striped' id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            @role('admin|petugas')
                            <th>Nama Pemohon</th>
                            <th>Kategori</th>
                            @endrole
                            <th>Rincian Informasi</th>
                            <th>Tujuan Penggunaan Informasi</th>
                            <th>Tanggal Permohonan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($datapis as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            @role('admin|petugas')
                            <td>{{ $item->user->name }}</td>
                            <td>
                                @if($item->user->biodata->kategori_pemohon == 1)
                                Lembaga/Instansi
                                @else
                                Perorangan
                                @endif
                            </td>
                            @endrole
                            <td>{{ $item->rincian }}</td>
                            <td>{{ $item->tujuan }}</td>
                            <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->isoFormat('dddd, D MMMM Y') }}</td>
                            <td>
                                @if($item->status == 0)
                                    <span class="badge bg-warning">Dikirim</span>
                                @elseif($item->status == 1)
                                    <span class="badge bg-info">Diproses</span>
                                @elseif($item->status == 2)
                                    <span class="badge bg-success">Diterima</span>
                                @elseif($item->status == 3)
                                    <span class="badge bg-danger">Ditolak</span>
                                @elseif($item->status == 4)
                                    <span class="badge bg-info">Keberatan Diproses</span>
                                @endif
                            </td>
                            <td>
                                @role('user')
                                <form action="{{ route('user.permohonaninformasi.destroy', $item->id) }}" method="post" onsubmit="return confirm('Yakin menghapus data permohonan ini?')">
                                    @csrf
                                    @method('delete')
                                    <div class="d-flex justify-content-center align-items-center gap-1">
                                        <a href="{{ route('user.permohonaninformasi.show',$item->id) }}" class="btn btn-dark icon">
                                            <i data-feather="eye" width="20"></i>
                                        </a>
                                        @if($item->status == 0)                                            
                                        <a href="{{ route('user.permohonaninformasi.edit',$item->id) }}" class="btn btn-warning icon">
                                            <i data-feather="edit" width="20"></i>
                                        </a>
                                        <button type="submit" class="btn btn-danger btn-sm icon"> 
                                            <i data-feather="trash" width="20"></i>
                                        </button>
                                        @elseif($item->status == 2)
                                        <button type="submit" class="btn btn-danger btn-sm icon"> 
                                            <i data-feather="trash" width="20"></i>
                                        </button>
                                        @elseif($item->status == 3)
                                        <button type="submit" class="btn btn-danger btn-sm icon"> 
                                            <i data-feather="trash" width="20"></i>
                                        </button>
                                        @endif
    
                                    </div>
                                </form>
                                @endrole
                                @role('admin')
                                <form action="{{ route('admin.permohonaninformasi.destroy', $item->id) }}" method="post" onsubmit="return confirm('Yakin menghapus data permohonan ini?')">
                                    @csrf
                                    @method('delete')
                                    <div class="d-flex align-items-center justify-content-center gap-1 flex-wrap">
                                        @if($item->status == 0)                                    
                                        <a href="{{ route('admin.permohonaninformasi.proses',$item->id) }}" class="btn btn-primary icon" onclick="return confirm('Yakin memproses permohonan ini?')">
                                            <i data-feather="arrow-right" width="20"></i> Proses
                                        </a>
                                        @elseif($item->status == 4)
                                        <a href="{{ route('admin.pengajuankeberatan.show',$item->pengajuankeberatan->id) }}" class="btn bg-info text-white icon">
                                            <i data-feather="arrow-right" width="20"></i> Proses
                                        </a>
                                        @else
                                        <a href="{{ route('admin.permohonaninformasi.show',$item->id) }}" class="btn btn-dark icon">
                                            <i data-feather="eye" width="20"></i>
                                        </a>
                                        @endif
                                        <a href="{{ route('admin.permohonaninformasi.edit',$item->id) }}" class="btn btn-warning icon">
                                            <i data-feather="edit" width="20"></i>
                                        </a>
                                        <button type="submit" class="btn btn-danger btn-sm icon"> 
                                            <i data-feather="trash" width="20"></i>
                                        </button>
                                    </div>
                                </form>
                                @endrole
                                @role('petugas')
                                @if($item->status == 0)                                    
                                <a href="{{ route('petugas.permohonaninformasi.proses',$item->id) }}" class="btn btn-primary icon" onclick="return confirm('Yakin memproses permohonan ini?')">
                                    <i data-feather="arrow-right" width="20"></i> Proses
                                </a>
                                @elseif($item->status == 4)
                                <a href="{{ route('petugas.pengajuankeberatan.show',$item->pengajuankeberatan->id) }}" class="btn bg-info text-white icon">
                                    <i data-feather="arrow-right" width="20"></i> Proses
                                </a>
                                @else
                                <a href="{{ route('petugas.permohonaninformasi.show',$item->id) }}" class="btn btn-dark icon">
                                    <i data-feather="eye" width="20"></i>
                                </a>
                                @endif
                                @endrole
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>

@endsection