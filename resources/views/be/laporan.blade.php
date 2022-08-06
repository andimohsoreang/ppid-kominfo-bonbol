@extends('be.layouts.app')

@section('linkcss')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
@endsection

@section('container')
@include('sweetalert::alert')
<div class="main-content container-fluid">
    <div class="page-title">
        <div class="d-flex justify-content-between align-items-center">
            <div class="">
                <h3>Laporan</h3>
                <p class="text-subtitle text-muted">Download laporan</a>.</p>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5>Cari Laporan</h5>
                        <hr>
                        <form action="{{ route('admin.laporan.search') }}" method="get" role="search">
                            @csrf
                            <div class="row">
                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label class="fw-bold">Data Laporan</label>
                                        <select id="pilihLaporan" name="pilih_laporan" class="form-control">
                                            <option value="" hidden>-Pilih Data-</option>
                                            <option value="Informasi Publik" {{
                                                (request('pilih_laporan')=="Informasi Publik" ) ? 'selected' : '' }}>
                                                Informasi Publik</option>
                                            <option value="Permohonan Informasi" {{
                                                (request('pilih_laporan')=="Permohonan Informasi" ) ? 'selected' : ''
                                                }}>Permohonan Informasi</option>
                                            <option value="Pengajuan Keberatan" {{
                                                (request('pilih_laporan')=="Pengajuan Keberatan" ) ? 'selected' : '' }}>
                                                Pengajuan Keberatan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label class="fw-bold">Dari</label>
                                        <input type="date" name="dari" class="form-control"
                                            value="{{ request('dari') ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label class="fw-bold">Sampai</label>
                                        <input type="date" name="sampai" class="form-control"
                                            value="{{ request('sampai') ?? '' }}">
                                    </div>
                                </div>
                                <div id="forStatusPermoinfo" class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <select name="status_permoinfo" class="form-control">
                                            <option value="">-Pilih Status-</option>
                                            <option value="0" {{ (request('status_permoinfo')=="0" ) ? 'selected' : ''
                                                }}>Belum Diproses</option>
                                            <option value="1" {{ (request('status_permoinfo')=="1" ) ? 'selected' : ''
                                                }}>Diproses</option>
                                            <option value="2" {{ (request('status_permoinfo')=="2" ) ? 'selected' : ''
                                                }}>Diterima</option>
                                            <option value="3" {{ (request('status_permoinfo')=="3" ) ? 'selected' : ''
                                                }}>Ditolak</option>
                                            <option value="4" {{ (request('status_permoinfo')=="4" ) ? 'selected' : ''
                                                }}>Keberatan Diproses</option>
                                        </select>
                                    </div>
                                </div>
                                <div id="forStatusPengkeb" class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <select name="status_pengkeb" class="form-control">
                                            <option value="">-Pilih Status-</option>
                                            <option value="0" {{ (request('status_pengkeb')=="0" ) ? 'selected' : '' }}>
                                                Belum Diproses</option>
                                            <option value="1" {{ (request('status_pengkeb')=="1" ) ? 'selected' : '' }}>
                                                Diterima</option>
                                            <option value="2" {{ (request('status_pengkeb')=="2" ) ? 'selected' : '' }}>
                                                Ditolak</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-block btn-primary"><i
                                                data-feather="search"></i> Cari</button>
                                    </div>
                                </div>
                                @if (request()->routeIs('admin.laporan.search'))
                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <a href="{{ route('admin.laporan') }}" class="btn btn-block btn-secondary"><i
                                                data-feather="refresh-cw"></i> Refresh</a>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            @if(request()->routeIs('admin.laporan.search'))
                @if (request('pilih_laporan') == "Permohonan Informasi")
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-striped" id="example">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pemohon</th>
                                        <th>Kategori</th>
                                        <th>Rincian Informasi</th>
                                        <th>Tujuan Penggunaan Informasi</th>
                                        <th>Tanggal Permohonan</th>
                                        <th>Petugas</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($datas as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>
                                            @if($item->user->biodata->kategori_pemohon == 1)
                                            Lembaga/Instansi
                                            @else
                                            Perorangan
                                            @endif
                                        </td>
                                        <td>{{ $item->rincian }}</td>
                                        <td>{{ $item->tujuan }}</td>
                                        <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->isoFormat('dddd, D MMMM Y') }}</td>
                                        <td>{{ $item->petugas->name ?? '-' }}</td>
                                        <td>
                                            @if($item->status == 0)
                                                <span class="badge bg-warning">Belum Diprose</span>
                                            @elseif($item->status == 1)
                                                <span class="badge bg-info">Diproses</span>
                                            @elseif($item->status == 2)
                                                <span class="badge bg-success">Diterima</span>
                                            @elseif($item->status == 3)
                                                <span class="badge bg-danger">Ditolak</span>
                                            @elseif($item->status == 4)
                                                <span class="badge bg-info">Keberatan Diproses</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @elseif (request('pilih_laporan') == "Pengajuan Keberatan")
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-striped" id="example">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Rincian Informasi</th>
                                        <th>Pesan</th>
                                        <th>Tanggal Pengajuan</th>
                                        <th>Waktu Pengajuan</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($datas as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->permohonaninformasi->rincian }}</td>
                                        <td>{{ $item->pesan }}</td>
                                        <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->isoFormat('dddd, D MMMM Y') }}</td>
                                        <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->isoFormat('HH:mm') }}</td>
                                        <td>
                                            @if($item->status == 0)
                                                <span  class="badge bg-warning">Dikirim</span>
                                            @elseif($item->status == 1)
                                                <span  class="badge bg-success">Diterima</span>
                                            @elseif($item->status == 2)
                                                <span  class="badge bg-danger">Ditolak</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @else
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-striped" id="example">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Informasi</th>
                                        <th>Judul</th>
                                        <th>Ringkasan</th>
                                        <th>Petugas</th>
                                        <th>Dibuat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($datas as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->klasifikasi->klasifikasi }}</td>
                                        <td>{{ $item->judul }}</td>
                                        <td>{{ $item->ringkasan }}</td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',
                                            $item->created_at)->isoFormat('LLLL') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endif
            @endif
        </div>
    </section>
</div>
@endsection

@section('scripts')
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>

<script>
    $(document).ready(function() {
        $('#example').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf',
                {
                    extend: 'pdfHtml5',
                    text: 'PDF HTML5',
                    download: 'open'
                }, 
                {
                    extend: 'print',
                    title: 'Laporan Informasi Publik',
                    customize: function (win) {

                        $(win.document.body).find('h1')
                            .css('font-size', '20px');
                        
                        $(win.document.body).find('h1')
                            .css('text-align', 'center');

                        $(win.document.body).find('h1')
                            .css('font-weight', 'bold');

                        $(win.document.body).find('h1')
                            .css('margin', '30px 0');
        
                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                    }
                }
            ]
        } );
    } );

    @if(request('pilih_laporan') == "Permohonan Informasi")
        $('#forStatusPengkeb').hide();
        $('#forStatusPermoinfo').show();
    @elseif(request('pilih_laporan') == "Pengajuan Keberatan")
        $('#forStatusPermoinfo').hide();
        $('#forStatusPengkeb').show();
    @else
        $('#forStatusPengkeb').hide();
        $('#forStatusPermoinfo').hide();
    @endif

    $('#pilihLaporan').change(function() {
        if($(this).val() == "Permohonan Informasi") {
            $('#forStatusPengkeb').hide();
            $('#forStatusPermoinfo').show();
        } else if($(this).val() == "Pengajuan Keberatan") {
            $('#forStatusPermoinfo').hide();
            $('#forStatusPengkeb').show();
        } else {
            $('#forStatusPermoinfo').hide();
            $('#forStatusPengkeb').hide();
        }
    });
</script>
@endsection