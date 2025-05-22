@extends('layouts.main')

@section('header')
    <div class="row mb-2">
        {{-- <div class="col-sm-6">
            <h1>Laporan</h1>
        </div> --}}
        {{-- <div class="col-sm-6 ml-auto text-right">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item active">Laporan Sampah</li>
            </ol>
        </div> --}}
    </div>
@endsection

@section('content')
    <!-- Content Row -->
    <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="h3 mb-2 text-gray-800">Laporan Sampah Chart</h1>
            </div>
            <div class="col-sm-6 text-right">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active">Laporan Sampah Chart</li>
                </ol>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-sm-12">
                <div class="alert alert-info" role="alert">
                    <strong>Info!</strong> Halaman ini digunakan untuk melihat laporan produksi sampah pergedung yang masuk ke dalam sistem.
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card shadow mb-5">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Laporan Chart</h6>
                        <a href="{{ url('/laporan') }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                    
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="card p-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <canvas id="limbahChart" height="100"></canvas>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Gedung</th>
                                                    <th>Plastik</th>
                                                    <th>Kertas</th>
                                                    <th>Basah</th>
                                                    <th>Tisu</th>
                                                    <th>Elektronik</th>
                                                    <th>Kaca</th>
                                                    <th>Logam</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($buildings as $index => $building)
                                                    <tr>
                                                        <td>{{ $building->name }}</td>
                                                        <td>{{ $chartData[0]['data'][$index] ?? 0 }}</td>
                                                        <td>{{ $chartData[1]['data'][$index] ?? 0 }}</td>
                                                        <td>{{ $chartData[2]['data'][$index] ?? 0 }}</td>
                                                        <td>{{ $chartData[3]['data'][$index] ?? 0 }}</td>
                                                        <td>{{ $chartData[4]['data'][$index] ?? 0 }}</td>
                                                        <td>{{ $chartData[5]['data'][$index] ?? 0 }}</td>
                                                        <td>{{ $chartData[6]['data'][$index] ?? 0 }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        
                            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                        
                            <script>
                                const ctx = document.getElementById('limbahChart').getContext('2d');
                                const chartData = @json($chartData);
                        
                                const limbahChart = new Chart(ctx, {
                                    type: 'line',
                                    data: {
                                        labels: @json($buildings->pluck('name')->values()), // Nama gedung terbaru
                                        datasets: @json($chartData) // Data terbaru dari Controller
                                    },
                                    options: {
                                        responsive: true,
                                        plugins: {
                                            title: {
                                                display: true,
                                                text: 'Produksi Sampah per Gedung'
                                            }
                                        },
                                        scales: {
                                            y: {
                                                beginAtZero: true
                                            }
                                        }
                                    }
                                });
                            </script>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

