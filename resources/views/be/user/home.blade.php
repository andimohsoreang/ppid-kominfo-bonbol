@extends('be.layouts.app')

@section('container')

@include('sweetalert::alert')
<div class="main-content container-fluid">
    <div class="page-title">
        <div class="d-flex justify-content-between align-items-center">
            <div class="">
                @if(request()->routeIs('admin.petugas'))
                <h3>Petugas</h3>
                <p class="text-subtitle text-muted">List Data Petugas.</p>
                @else
                <h3>Pemohon</h3>
                <p class="text-subtitle text-muted">List Data pemohon.</p>
                @endif
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
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if(request()->routeIs('admin.petugas'))
                                <form action={{ route('admin.petugas.destroy',$user->id) }} method="post"
                                    onsubmit = "return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('delete')
                                    <a href={{ route('admin.petugas.show',$user->id) }} class="btn btn-dark
                                        icon">
                                        <i data-feather="eye" width="20"></i>
                                    </a>
                                    <a href={{ route('admin.petugas.edit',$user->id) }} class="btn
                                        btn-warning icon">
                                        <i data-feather="edit" width="20"></i>
                                    </a>
                                    <button type="submit" class="btn btn-danger btn-sm icon">
                                        <i data-feather="trash" width="20"></i>
                                    </button>
                                </form>
                                @elseif(request()->routeIs('admin.pemohon'))
                                <form action={{ route('admin.pemohon.destroy',$user->id) }} method="post"
                                    onsubmit = "return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('delete')
                                    <a href={{ route('admin.pemohon.show',$user->id) }} class="btn btn-dark
                                        icon">
                                        <i data-feather="eye" width="20"></i>
                                    </a>
                                    <a href={{ route('admin.pemohon.edit',$user->id) }} class="btn
                                        btn-warning icon">
                                        <i data-feather="edit" width="20"></i>
                                    </a>
                                    <button type="submit" class="btn btn-danger btn-sm icon">
                                        <i data-feather="trash" width="20"></i>
                                    </button>
                                </form>
                                @endif
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