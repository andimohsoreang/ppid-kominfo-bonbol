@extends('layouts.app')

@section('style')
<style>          
    .bg-grad {
        background-image: linear-gradient(to right, #f06161 0%, #d82137  51%, #f06161  100%);
        text-align: center;
        text-transform: none;
        transition: 0.5s;
        background-size: 200% auto;
        color: white;            
        box-shadow: 0 0 20px #eee;
        border-radius: 10px;
        display: block;
        margin-bottom: 30px;
    }

    .bg-grad:hover {
        background-position: right center; /* change the direction of the change here */
        color: #fff;
        text-decoration: none;
    }
     
    .bg-grad-secondary {
        background-image: linear-gradient(to right, #f0f0f0 0%, #FFFFFF  51%, #f0f0f0  100%);
        text-align: center;
        text-transform: none;
        transition: 0.5s;
        background-size: 200% auto;
        color: white;            
        box-shadow: 0 0 20px #eee;
        border-radius: 10px;
        display: block;
        margin-bottom: 30px;
    }

    .bg-grad-secondary:hover {
        background-position: right center; /* change the direction of the change here */
        color: #fff;
        text-decoration: none;
    } 
</style>
@endsection

@section('content')
<section class="section mt-5">
    <div class="container">
        <h6 class="xs-font mb-0 text-center">PPID Bone Bolango</h6>
        <h3 class="section-title mb-4 text-center">Statistik Layanan Informasi Publik</h3>
        <hr>
        <div class="row mt-4">
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card shadow-lg bg-grad">
                    <div class="card-body text-light p-0">
                        <div class="d-flex flex-column align-items-center justify-content-center py-4">
                            <h1 class="mb-0"><i class="ti-info-alt"></i></h1>
                            <div class="text-center">
                                <h2 class="m-0">{{ $infopub_total }}</h2>
                                <p class="mt-1 mb-0 text-light text-uppercase font-weight-bold">Informasi</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card shadow-lg bg-grad">
                    <div class="card-body text-light p-0">
                        <div class="d-flex flex-column align-items-center justify-content-center py-4">
                            <h1 class="mb-0"><i class="ti-upload"></i></h1>
                            <div class="text-center">
                                <h2 class="m-0">{{ $permoinfo_total }}</h2>
                                <p class="mt-1 mb-0 text-light text-uppercase font-weight-bold">Permohonan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card shadow-lg bg-grad">
                    <div class="card-body text-light p-0">
                        <div class="d-flex flex-column align-items-center justify-content-center py-4">
                            <h1 class="mb-0"><i class="ti-alert"></i></h1>
                            <div class="text-center">
                                <h2 class="m-0">{{ $pengkeb_total }}</h2>
                                <p class="mt-1 mb-0 text-light text-uppercase font-weight-bold">Keberatan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card shadow-lg bg-grad">
                    <div class="card-body text-light p-0">
                        <div class="d-flex flex-column align-items-center justify-content-center py-4">
                            <h1 class="mb-0"><i class="ti-check-box"></i></h1>
                            <div class="text-center">
                                <h2 class="m-0">{{ $permoinfo_selesai_total }}</h2>
                                <p class="mt-1 mb-0 text-light text-uppercase font-weight-bold">Selesai</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12 col-lg-6">
                <div class="card shadow-lg bg-grad-secondary">
                    <div class="card-body">
                        <h5 class="text-dark mb-0 mt-5">Informasi Publik</h5>
                        <canvas id="myChart" width="400" height="400"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="card shadow-lg bg-grad-secondary">
                    <div class="card-body">
                        <h5 class="text-dark mb-0 mt-5">Permohonan Informasi</h5>
                        <canvas id="myChart2" width="400" height="400"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="card shadow-lg bg-grad-secondary">
                    <div class="card-body">
                        <h5 class="text-dark mb-0 mt-5">Jumlah Permohonan</h5>
                        <p class="text-muted small mb-0">Berdasarkan user pada bulan sekarang ({{ \Carbon\Carbon::now()->isoFormat('MMMM') }})</p>
                        <canvas id="myChart3" width="400" height="400"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="card shadow-lg bg-grad-secondary">
                    <div class="card-body">
                        <h5 class="text-dark mb-0 mt-5">Jumlah Keberatan</h5>
                        <p class="text-muted small mb-0">Berdasarkan user pada bulan sekarang ({{ \Carbon\Carbon::now()->isoFormat('MMMM') }})</p>
                        <canvas id="myChart4" width="400" height="400"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: [
                @foreach($infopub as $label)
                    '{{ $label->klasifikasi }}',
                @endforeach
            ],
            datasets: [{
                label: '# of Votes',
                data: [
                    @foreach($infopub as $data)
                    {{ $data->count }},
                    @endforeach
                ],
                backgroundColor: [
                    '#00F2C3',
                    '#ffc107',
                    '#f06161',
                    '#007bff',
                    '#FD5D93',
                    '#17a2b8',
                ],
                hoverOffset: 5,
                borderWidth: 0
            }]
        },
        options: {
            layout: {
                padding: 40
            },
            plugins: {
                responsive:true,
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 10,
                        color: '#000',
                    },
                    title: {
                        display: true,
                    }
                },
            },
        }
    });
</script>

<script>
    const ctx2 = document.getElementById('myChart2').getContext('2d');
    const myChart2 = new Chart(ctx2, {
        type: 'pie',
        data: {
            labels: ['Belum Diproses', 'Diproses', 'Diterima', 'Ditolak'],
            datasets: [{
                label: '# of Votes',
                data: [
                    {{ $permoinfo_belum }},
                    {{ $permoinfo_diproses }},
                    {{ $permoinfo_diberikan }},
                    {{ $permoinfo_ditolak }}
                ],
                backgroundColor: [
                    '#6c757d',
                    '#ffc107',
                    '#00F2C3',
                    '#f06161',
                ],
                hoverOffset: 5,
                borderWidth: 0
            }]
        },
        options: {
            layout: {
                padding: 40
            },
            plugins: {
                responsive:true,
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 10,
                        color: '#000',
                    },
                    title: {
                        display: true,
                    }
                },
            },
        }
    });
</script>

<script>
    const ctx3 = document.getElementById('myChart3').getContext('2d');
    const myChart3 = new Chart(ctx3, {
        type: 'bar',
        data: {
            labels: [
                @foreach($permoinfo as $label_permo)
                    '{{ $label_permo->name }}',
                @endforeach
            ],
            datasets: [{
                data: [
                    @foreach($permoinfo as $data_permo)
                        {{ $data_permo->count }},
                    @endforeach
                ],
                backgroundColor: [
                    '#f06161',
                ],
                borderWidth: 0
            }]
        },
        options: {
            layout: {
                padding: 40
            },
            plugins: {
                responsive:true,
                legend: {
                    display: false,
                },
            },
        }
    });
</script>

<script>
    const ctx4 = document.getElementById('myChart4').getContext('2d');
    const myChart4 = new Chart(ctx4, {
        type: 'bar',
        data: {
            labels: [
                @foreach($pengkeb as $label_pengkeb)
                    '{{ $label_pengkeb->name }}',
                @endforeach
            ],
            datasets: [{
                data: [
                    @foreach($pengkeb as $data_pengkeb)
                        {{ $data_pengkeb->count }},
                    @endforeach
                ],
                backgroundColor: [
                    '#ffc107',
                ],
                borderWidth: 0
            }]
        },
        options: {
            layout: {
                padding: 40
            },
            plugins: {
                responsive:true,
                legend: {
                    display: false,
                },
            },
        }
    });
</script>
@endsection