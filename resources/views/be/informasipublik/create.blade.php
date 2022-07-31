@extends('be.layouts.app')

@section('container')
<div class="page-title">
    <div class="d-flex justify-content-between align-items-center">
        <div class="">
            <h3>Informasi Publik</h3>
            <p class="text-subtitle text-muted">Form Upload Informasi Publik</a>.</p>
        </div>
        <div class="">
            <a href={{ route('petugas.informasipublik.create') }} class="btn btn-outline-primary block fw-bold px-5">
                Tambah Informasi
            </a>
        </div>
    </div>
</div>
<!-- Basic Vertical form layout section start -->
<section id="basic-vertical-layouts">
    <div class="row match-height">
        <div class="col-md-6 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Vertical Form</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form form-vertical">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <h6>Klasifikasi Infirmasi</h6>
                                        <fieldset class="form-group">
                                            <select class="form-select" name="klasifikasi" id="basicSelect" required>
                                                <option value="Tersedia Setiap Saat">Tersedia Setiap Saat</option>
                                                <option value="Serta Merta">Serta Merta</option>
                                                <option value="Berkala">Berkala</option>
                                            </select>
                                        </fieldset>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="email-id-vertical">Email</label>
                                            <input type="email" id="email-id-vertical" class="form-control"
                                                name="email-id" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="contact-info-vertical">Mobile</label>
                                            <input type="number" id="contact-info-vertical" class="form-control"
                                                name="contact" placeholder="Mobile">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="password-vertical">Password</label>
                                            <input type="password" id="password-vertical" class="form-control"
                                                name="contact" placeholder="Password">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class='form-check'>
                                            <div class="checkbox">
                                                <input type="checkbox" id="checkbox3" class='form-check-input' checked>
                                                <label for="checkbox3">Remember Me</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
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