@extends('be.layouts.app')

@section('container')

@include('sweetalert::alert')
<div class="main-content container-fluid">
    <div class="page-title">
        <div class="d-flex justify-content-between align-items-center">
            <div class="">
                <h3>Informasi Publik</h3>
                <p class="text-subtitle text-muted">Upload Informasi dan Dokumentasi</a>.</p>
            </div>
            <div class="">
                @role('admin')
                <a href="{{ route('admin.informasipublik.create') }}" class="btn btn-outline-primary block fw-bold px-5">
                    Tambah Informasi
                </a>
                @endrole
                @role('petugas')
                <a href="{{ route('petugas.informasipublik.create') }}" class="btn btn-outline-primary block fw-bold px-5">
                    Tambah Informasi
                </a>
                @endrole
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                Informasi dan Dokumentasi
            </div>
            <div class="card-body">
                <table class='table table-striped' id="table1">
                    <thead>
                        <tr>
                            <th width = "3%">No</th>
                            <th width = "10%">Informasi</th>
                            <th width = "25%">Judul</th>
                            <th width = "20%">Ringkasan</th>
                            <th width = "15%">Waktu</th>
                            <th width = "5%">Dokumen</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($informasis as $informasi)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $informasi->klasifikasi }}</td>
                            <td>{{ $informasi->judul }}</td>
                            <td>{{ $informasi->ringkasan }}</td>
                            <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $informasi->created_at)->isoFormat('D MMMM Y')}}</td>
                            <td><span class="badge bg-danger">{{ $ext = pathinfo(storage_path().$informasi->file, PATHINFO_EXTENSION); }}</span></td>
                            <td>
                                @role('admin')
                                <form action={{ route('admin.informasipublik.destroy',$informasi->id) }} method="post" onsubmit = "return confirm('Yakin Ingin Menghapus Informasi ?')">
                                    @csrf
                                    @method('delete')
                                    <a href={{ route('admin.informasipublik.show',$informasi->id) }} class="btn btn-dark icon">
                                        <i data-feather="eye" width="20"></i>
                                    </a>
                                    <a href={{ route('admin.informasipublik.edit',$informasi->id) }} class="btn btn-warning icon">
                                        <i data-feather="edit" width="20"></i>
                                    </a>
                                    <button type="submit" class="btn btn-danger btn-sm icon"> 
                                        <i data-feather="trash" width="20"></i>
                                    </button>
                                </form>
                                @endrole
                                @role('petugas')
                                <form action={{ route('petugas.informasipublik.destroy',$informasi->id) }} method="post" onsubmit = "return confirm('Yakin Ingin Menghapus Informasi ?')">
                                    @csrf
                                    @method('delete')
                                    <a href={{ route('petugas.informasipublik.show',$informasi->id) }} class="btn btn-dark icon">
                                        <i data-feather="eye" width="20"></i>
                                    </a>
                                    <a href={{ route('petugas.informasipublik.edit',$informasi->id) }} class="btn btn-warning icon">
                                        <i data-feather="edit" width="20"></i>
                                    </a>
                                    <button type="submit" class="btn btn-danger btn-sm icon"> 
                                        <i data-feather="trash" width="20"></i>
                                    </button>
                                </form>
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