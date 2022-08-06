@extends('be.layouts.app')

@section('container')
<div class="main-content container-fluid">
    <div class="page-title">
        <div class="d-flex gap-2 align-items-center">
            @if(request()->routeIs('admin.petugas.edit'))
            <a href="{{ route('admin.petugas') }}" class="btn icon btn-dark"><i data-feather="chevron-left"></i></a>
            <div class="">
                <h3 class="m-0">Detail Petugas</h3>
            </div>
            @else
            <a href="{{ route('admin.pemohon') }}" class="btn icon btn-dark"><i data-feather="chevron-left"></i></a>
            <div>
                <h3 class="m-0">Detail Pemohon</h3>
            </div>
            @endif
        </div>
    </div>
    <section class="section mt-3">
        <div class="row">
            <div class="col-12 col-lg-6">
           
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form action="{{ route('admin.petugas.store') }}" method="POST"> 
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="basicInput" class="fw-bold">Nama Lengkap</label>
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="basicInput">
                                                @error('name')
                                                    <div class="alert alert-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="basicInput" class="fw-bold">Email</label>
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="basicInput">
                                                @error('email')
                                                    <div class="alert alert-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="basicInput" class="fw-bold">Password</label>
                                                <input type="password" class="form-control mypassword @error('password') is-invalid @enderror" name="password" id="basicInput">
                                                @error('password')
                                                    <div class="alert alert-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <input type="checkbox" id="lihatpassword">
                                                <label for="lihatpassword">Lihat Password</label>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
	$(document).ready(function(){		
		$('#lihatpassword').click(function(){
			if($(this).is(':checked')){
				$('.mypassword').attr('type','text');
			}else{
				$('.mypassword').attr('type','password');
			}
		});
	});
</script>
@endsection