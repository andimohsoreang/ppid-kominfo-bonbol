@extends('layouts.app')

@section('style')
<style>
    #myDataTable {
        font-size: 13px;
    }

    .dataTables_length {
        font-size: 13px;
    }

    .dataTables_filter {
        font-size: 13px;
    }

    .dataTables_info {
        font-size: 13px;
    }

    .dataTables_paginate {
        font-size: 13px;
    }
</style>
@endsection

@section('content')
<section class="section mt-5">
    
    <div class="container">
        <h6 class="xs-font mb-0 text-center">PPID Bone Bolango</h6>
        <h3 class="section-title mb-4 text-center">Informasi Publik</h3>
        <div class="row">
            <div class="col-12">
                <table id="myDataTable" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Dibuat</th>
                            <th>Informasi</th>
                            <th>Judul</th>
                            <th>SKPD</th>
                            <th>File</th>
                            <th>Ukuran</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($datas as $item)                            
                        <tr>
                            <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$item->created_at)->isoFormat('D MMMM Y HH:mm') }}</td>
                            <td>{{ $item->klasifikasi->klasifikasi }}</td>
                            <td>{{ $item->judul }}</td>
                            <td>KOMINFO</td>
                            <td>{{ pathinfo(storage_path().$item->file, PATHINFO_EXTENSION) }}</td>
                            <td>{{ HumanReadable::bytesToHuman($item->filesize) }}</td>
                            <td><a href="{{ route('download.infopub', $item->id) }}" target="_blank" class="btn btn-sm btn-primary circle"> <i class="ti-download"></i> </a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</section>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $('#myDataTable').DataTable({
            // responsive: true,
            // pagingType: "listbox"
        });
    });
</script>
@endsection