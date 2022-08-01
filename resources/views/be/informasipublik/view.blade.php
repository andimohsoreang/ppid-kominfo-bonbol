@extends('be.layouts.app')

@section('container')

 
<div class="d-flex mb-4 gap-3 align-items-center">
    <a href={{ url()->previous() }} class="btn btn-dark icon">
        <i data-feather="arrow-left" width="20"></i>
    </a>
    <h3 class="mb-0">Detail informasi Publik</h3>

</div>

<div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-body p-0 shadow-lg">
                <iframe src="{{ asset($data->file) }}" width="100%" height="600px" frameborder="0"></iframe>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <h3 class="fw-bold">Detail Data</h3>
                <br>
                <div class="form-group">
                    <h4>Judul</h4>
                    <h5 class="fw-bold text-decoration-underline">{{ $data->judul }}</h5>
                </div>
                <div class="form-group">
                    <h5>Ringkasan</h5>
                    <p>{{ $data->ringkasan }}</p>
                </div>
                <div class="form-group">
                    <h5>Klasifikasi</h5>
                    <p>{{ $data->klasifikasi }}</p>
                </div>
                <div class="form-group">
                    <h5>Petugas</h5>
                    <p>{{ $data->user->name; }}</p>
                </div>
            </div>
        </div>
       
    </div>
</div>
   



@endsection