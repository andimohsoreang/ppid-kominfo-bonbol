@extends('be.layouts.app')

@section('container')

@include('sweetalert::alert')
<div class="main-content container-fluid">
    <div class="page-title">
        <div class="d-flex justify-content-between align-items-center">
            <div class="">
                <h3>Profil Kantor</h3>
            </div>
        </div>
    </div>
    <section class="section mt-2">
        <div class="row">
            <div class="col-12 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h5>Detail Profil</h5>
                        <hr>
                        <div class="form-group">
                            <label class="fw-bold">Tentang</label>
                            <p>{{ $data->tentang ?? '' }}</p>
                        </div>
                        <div class="form-group">
                            <label class="fw-bold">Alamat</label>
                            <p>{{ $data->alamat ?? '' }}</p>
                        </div>
                        <div class="form-group">
                            <label class="fw-bold">Telepon</label>
                            <p>{{ $data->telepon ?? '' }}</p>
                        </div>
                        <div class="form-group">
                            <label class="fw-bold">Email</label>
                            <p>{{ $data->email ?? '' }}</p>
                        </div>
                        <div class="form-group mb-0">
                            <label class="fw-bold">Sosial Media</label>
                            <div class="d-flex gap-2">
                                <a href="{{ $data->fb ?? '' }}" class="btn icon bg-blue text-white" target="_blank"><i data-feather="facebook"></i></a>
                                <a href="{{ $data->tw ?? '' }}" class="btn icon bg-info text-white" target="_blank"><i data-feather="twitter"></i></a>
                                <a href="{{ $data->ig ?? '' }}" class="btn icon bg-red text-white" target="_blank"><i data-feather="instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h5>Edit Profil</h5>
                        <hr>
                        <form action="{{ route('admin.profilkantor.update', $data->id) }}" method="post">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label class="fw-bold">Tentang</label>
                                <textarea name="tentang" class="form-control">{{ $data->tentang ?? '' }}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="fw-bold">Alamat</label>
                                <input type="text" name="alamat" class="form-control" value="{{ $data->alamat ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label class="fw-bold">Telepon</label>
                                <input type="text" name="telepon" class="form-control" value="{{ $data->telepon ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label class="fw-bold">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ $data->email ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label class="fw-bold">Facebook</label>
                                <input type="text" name="fb" class="form-control" value="{{ $data->fb ?? '' }}">
                                <small>*Paste link profil sosial media</small>
                            </div>
                            <div class="form-group">
                                <label class="fw-bold">Twitter</label>
                                <input type="text" name="tw" class="form-control" value="{{ $data->tw ?? '' }}">
                                <small>*Paste link profil sosial media</small>
                            </div>
                            <div class="form-group">
                                <label class="fw-bold">Instagram</label>
                                <input type="text" name="ig" class="form-control" value="{{ $data->ig ?? '' }}">
                                <small>*Paste link profil sosial media</small>
                            </div>
                            <div class="form-group mb-0">
                                <div class="d-flex gap-2 mt-4">
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection