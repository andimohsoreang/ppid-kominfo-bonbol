@extends('be.layouts.app')


@section('container')
<div class="page-title">
    <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex mb-4 gap-3 align-items-center">
            <a href={{ url()->previous() }} class="btn btn-dark icon">
                <i data-feather="arrow-left" width="20"></i>
            </a>
            <div class="">
                <h3 class="mb-0">Master Klasifikasi</h3>
                <p class="text-subtitle text-muted mb-0">Form edit master klasifikasi</p>
            </div>
        </div>
        <div class="">
        </div>
    </div>
</div>
<!-- Basic Vertical form layout section start -->
<section id="basic-vertical-layouts">
    <div class="row match-height">
        <div class="col-md-12 col-lg-6">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <form action="{{ route('admin.klasifikasi.update', $data->id) }}" method="POST"> 
                            @csrf
                            @method('put')
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="basicInput" class="fw-bold">Klasifikasi</label>
                                            <input type="text" class="form-control @error('klasifikasi') is-invalid @enderror" name="klasifikasi" id="basicInput" value="{{ $data->klasifikasi }}">
                                            @error('klasifikasi')
                                                <div class="alert alert-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
        @endsection