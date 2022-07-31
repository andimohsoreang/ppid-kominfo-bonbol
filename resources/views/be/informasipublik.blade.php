@extends('be.layouts.app')

@section('container')
<div class="main-content container-fluid">
    <div class="page-title">
        <div class="d-flex justify-content-between align-items-center">
            <div class="">
                <h3>Informasi Publik</h3>
                <p class="text-subtitle text-muted">Upload Informasi dan Dokumentasi</a>.</p>
            </div>
            <div class="">
                <a href={{ route('petugas.informasipublik.create') }} class="btn btn-outline-primary block fw-bold px-5">
                    Tambah Informasi
                </a>
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
                            <th>No</th>
                            <th>Informasi</th>
                            <th>Judul</th>
                            <th>Ringkasan</th>
                            <th>Waktu</th>
                            <th>Petugas</th>
                            <th>File</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Serta Merta</td>
                            <td>Siaran Pers 1</td>
                            <td>Siaran pers Adalah bla bla bla</td>
                            <td>Aco</td>
                            <td>PDF</td>
                            <td>
                                <span class="badge bg-success">Active</span>
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Serta Merta</td>
                            <td>Siaran Pers 1</td>
                            <td>Siaran pers Adalah bla bla bla</td>
                            <td>Aco</td>
                            <td>PDF</td>
                            <td>
                                <span class="badge bg-success">Active</span>
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Serta Merta</td>
                            <td>Siaran Pers 1</td>
                            <td>Siaran pers Adalah bla bla bla</td>
                            <td>Aco</td>
                            <td>PDF</td>
                            <td>
                                <span class="badge bg-danger">PDF</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>

<!--Basic Modal -->
<div class="modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel1">Basic Modal</h5>
                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form action={{ route('informasipublik.store') }} method="POST" enctype="multipart/form-data"> 
            <div class="modal-body">
                    @csrf
                    <div class="col-lg-12">
                        <h6>Klasifikasi Infirmasi</h6>
                        <fieldset class="form-group">
                            <select class="form-select" name="klasifikasi" id="basicSelect" required>
                                <option value="Tersedia Setiap Saat">Tersedia Setiap Saat</option>
                                <option value="Serta Merta">Serta Merta</option>
                                <option value="Berkala">Berkala</option>
                            </select>
                        </fieldset>
                    </div>
                    <div class="form-group">
                        <label for="basicInput">Judul</label>
                        <input type="text" class="form-control @error('judul') is-invalid @enderror" name="judul" id="basicInput" required>
                        @error('judul')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                          <label for="exampleFormControlTextarea1" class="form-label fw-bold">Ringkasan</label>
                          <textarea class="form-control" name="ringkasan" id="exampleFormControlTextarea1" required></textarea>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <p class="fw-bold">Upload Informasi</p>
                        <div class="form-file">
                            <input type="file" class="form-file-input" name="file" id="customFile">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                    <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Simpan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>




@endsection