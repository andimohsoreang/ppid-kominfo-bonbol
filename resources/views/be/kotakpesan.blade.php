@extends('be.layouts.app')

@section('container')

@include('sweetalert::alert')
<div class="main-content container-fluid">
    <div class="page-title">
        <div class="d-flex justify-content-between align-items-center">
            <div class="">
                <h3>Kotak Pesan</h3>
                <p class="text-subtitle text-muted">Daftar pesan</a>.</p>
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
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Pesan</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($datas as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->pesan }}</td>
                            <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->isoFormat('D MMMM Y')}}</td>
                            <td>
                                <form action={{ route('admin.kotakpesan.destroy',$item->id) }} method="post" onsubmit = "return confirm('Yakin ingin menghapus pesan ini?')">
                                    @csrf
                                    @method('delete')
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