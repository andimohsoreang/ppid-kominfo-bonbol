@extends('be.layouts.app')

@section('container')

@include('sweetalert::alert')
<div class="main-content container-fluid">
    <div class="page-title">
        <div class="d-flex justify-content-between align-items-center">
            <div class="">
                <h3>Master Klasifikasi</h3>
                <p class="text-subtitle text-muted">Master Data - Klasifikasi.</p>
            </div>
            <a href="" class="btn btn-outline-primary block fw-bold px-5">Tambah Klasifikasi</a>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <table class='table table-striped' id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Klasifikasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($klasifikasis as $klasifikasi)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $klasifikasi->klasifikasi }}</td>
                            <td>
                                <form action={{ route('admin.petugas.destroy',$klasifikasi->id) }} method="post"
                                    onsubmit = "return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('delete')
                                    <a href={{ route('admin.petugas.edit',$klasifikasi->id) }} class="btn
                                        btn-warning icon">
                                        <i data-feather="edit" width="20"></i>
                                    </a>
                                    <button type="submit" class="btn btn-danger btn-sm icon">
                                        <i data-feather="trash" width="20"></i>
                                    </button>
                                </form>
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