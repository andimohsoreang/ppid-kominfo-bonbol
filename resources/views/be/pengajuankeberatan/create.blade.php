@extends('be.layouts.app')


@section('container')
<div class="page-title">
    <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex mb-4 gap-3 align-items-center">
            <a href={{ url()->previous() }} class="btn btn-dark icon">
                <i data-feather="arrow-left" width="20"></i>
            </a>
            <div class="">
                <h3 class="mb-0">Pengajuan Keberatan</h3>
                <p class="text-subtitle text-muted mb-0">Form Pengajuan Keberatan</a></p>
            </div>
        </div>
        <div class="">
        </div>
    </div>
</div>
<!-- Basic Vertical form layout section start -->
<section id="basic-vertical-layouts">
    <div class="row match-height">
        <div class="col-lg-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <form action="{{ route('user.pengajuankeberatan.store') }}" method="POST">
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <h6 class="fw-bold">Pilih Permohonan Informasi</h6>
                                        <div class="form-group">
                                            <select class="choices form-select @error('permoinfo_id') is-invalid @enderror" name="permoinfo_id" id="permoInfo">
                                                <option value="" hidden>Pilih</option>
                                                @foreach($datas as $data)
                                                <option value="{{ $data->id }}">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->isoFormat('dddd, D MMMM Y') }} - {{ $data->rincian }}</option>
                                                @endforeach
                                            </select>
                                            @error('permoinfo_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <h6 class="fw-bold">Pesan</h6>
                                            <textarea name="pesan" rows="5"
                                                class="form-control @error('pesan') is-invalid @enderror">{{ old('pesan') }}</textarea>
                                            @error('pesan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <div class="d-flex gap-2 float-end">
                                                <button type="reset"
                                                    class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                                <button type="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-12">
            <div class="card" id="myCard">
                <div class="card-body">
                    <h4>Detail Permohonan</h4>
                    <hr>
                    <div class="form-group">
                        <label class="fw-bold">Rincian Informasi</label>
                        <div id="forRincian"></div>
                    </div>
                    <div class="form-group">
                        <label class="fw-bold">Tujuan Penggunaan Informasi</label>
                        <p id="forTujuan"></p>
                    </div>
                    <div class="form-group">
                        <label class="fw-bold">Mendapatkan Salinan Informasi</label>
                        <p id="forMendapat"></p>
                    </div>
                    <div class="form-group">
                        <label class="fw-bold">Cara Mendapatkan Salinan Informasi</label>
                        <p id="forCara"></p>
                    </div>
                    <div class="form-group">
                        <label class="fw-bold">Tanggal Permohonan</label>
                        <div id="forTanggal"></div>
                    </div>
                    <div class="form-group">
                        <label class="fw-bold">Pesan / Alasan ditolak</label>
                        <div id="forAlasan"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    $("#myCard").hide();
    $('#permoInfo').change(function() {
        const permoId = $(this).val();
        if (permoId) {
            $.ajax({
                type:"GET",
                url:"/user/getpermohonaninformasi/"+permoId,
                dataType: 'JSON',
                success:function(data){   
                    if(data){
                        $.each(data, function(index, element){      
                            console.log(element.created_at);

                            const myDate = new Date(element.created_at);
                            const myYear = new Intl.DateTimeFormat('id', { year: 'numeric' }).format(myDate);
                            const myMonth = new Intl.DateTimeFormat('id', { month: 'long' }).format(myDate);
                            const myDay= new Intl.DateTimeFormat('id', { day: 'numeric' }).format(myDate);
                            const myWeekDay = new Intl.DateTimeFormat('id', { weekday: 'long' }).format(myDate);

                            const myFullDate = `${myWeekDay}, ${myDay} ${myMonth} ${myYear}`;

                            $("#myCard").hide();
                            $("#forRincian").empty();
                            $("#forTujuan").empty();
                            $("#forMendapat").empty();
                            $("#forCara").empty();
                            $("#forTanggal").empty();
                            $("#forAlasan").empty();

                            $("#myCard").show();
                            $("#forRincian").append('<p>'+element.rincian+'</p>');
                            $("#forTujuan").append('<p>'+element.tujuan+'</p>');
                            $("#forMendapat").append('<p>'+element.mendapat+'</p>');
                            $("#forCara").append('<p>'+element.cara+'</p>');
                            $("#forTanggal").append('<p>'+myFullDate+'</p>');
                            $("#forAlasan").append('<p>'+element.alasan_tolak+'</p>');
                        });
                    }else{
                        $("#myCard").hide();
                        $("#forRincian").empty();
                        $("#forTujuan").empty();
                        $("#forMendapat").empty();
                        $("#forCara").empty();
                        $("#forTanggal").empty();
                        $("#forAlasan").empty();
                    }
                }
            });
        } else {
            $("#myCard").hide();
            $("#forRincian").empty();
            $("#forTujuan").empty();
            $("#forMendapat").empty();
            $("#forCara").empty();
            $("#forTanggal").empty();
            $("#forAlasan").empty();
        }
    });
</script>
@endsection