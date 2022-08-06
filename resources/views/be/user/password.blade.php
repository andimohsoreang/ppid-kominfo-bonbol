@extends('be.layouts.app')

@section('container')
@include('sweetalert::alert')

<div class="main-content container-fluid">
    <div class="page-title">
        <div class="d-flex gap-2 align-items-center">
            @if(request()->routeIs('admin.petugas.password'))
                <a href="{{ route('admin.petugas') }}" class="btn icon btn-dark"><i data-feather="chevron-left"></i></a>
            @else
                <a href="{{ route('admin.pemohon') }}" class="btn icon btn-dark"><i data-feather="chevron-left"></i></a>
            @endif
            <div>
                <h3 class="m-0">Ganti Password</h3>
            </div>
        </div>
    </div>
    <section class="section mt-3">
        <div class="row">
            <div class="col-12 col-lg-6">
           
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form action="{{ route('admin.password.update', $user->id) }}" method="POST" onsubmit="return confirm('Yakin mengganti password baru?')"> 
                                @csrf
                                @method('put')
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="basicInput" class="fw-bold">Nama Petugas</label>
                                                <p class="m-0">{{ $user->name }}</p>
                                            </div>
                                            <div class="form-group">
                                                <label for="basicInput" class="fw-bold">Password Baru</label>
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