@extends('layouts.main')

@section('header')

@endsection

@section('content')
    <!-- Content Row -->
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="h3 mb-2 text-gray-800">Laporan Sampah Gedung</h1>
            </div>
            <div class="col-sm-6 text-right">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active">Laporan Gedung</li>
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
                        <h6 class="m-0 font-weight-bold text-primary">Laporan Gedung</h6>
                        <a href="{{ url('/laporan') }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                    
                    <div class="card-body">
                        <div class="mb-4">
                            <form method="GET" action="{{ url('/charts/building') }}" class="form-inline">
                                <label for="building_id" class="mr-2">Filter Gedung:</label>
                                <select name="building_id" id="building_id" class="form-control mr-2">
                                    <option value="">Pilih Gedung</option>
                                    <option value="all" {{ request('building_id') == 'all' ? 'selected' : '' }}>Semua Gedung</option>
                                    @foreach($buildings as $building)
                                        <option value="{{ $building->id }}" {{ request('building_id') == $building->id ? 'selected' : '' }}>
                                            {{ $building->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-primary">Tampilkan</button>
                            </form>
                        </div>

                        @if(request('building_id') && request('building_id') != '')
                        <div class="table-responsive">
                            <div class="card p-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <canvas id="limbahBarChart" height="100"></canvas>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Jenis Sampah</th>
                                                    @if(request('building_id') == 'all')
                                                        @foreach($buildings as $building)
                                                            <th>{{ $building->name }}</th>
                                                        @endforeach
                                                    @endif
                                                    <th>Total Berat (Kg)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($chartData as $data)
                                                    <tr>
                                                        <td>{{ $data['label'] }}</td>
                                                        @if(request('building_id') == 'all')
                                                            @foreach($data['data'] as $berat)
                                                                <td>{{ $berat }}</td>
                                                            @endforeach
                                                        @endif
                                                        <td>{{ array_sum($data['data']) }}</td>
                                                    </tr>
                                                @endforeach
                                                <tr class="font-weight-bold">
                                                    <td>Total Semua Sampah</td>
                                                    @if(request('building_id') == 'all')
                                                        @foreach($buildings as $idx => $building)
                                                            <td>
                                                                {{
                                                                    collect($chartData)->reduce(function($carry, $item) use ($idx) {
                                                                        return $carry + ($item['data'][$idx] ?? 0);
                                                                    }, 0)
                                                                }}
                                                            </td>
                                                        @endforeach
                                                    @endif
                                                    <td>
                                                        {{ collect($chartData)->reduce(function($carry, $item) {
                                                            return $carry + array_sum($item['data']);
                                                        }, 0) }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                            <script>
                                const barCtx = document.getElementById('limbahBarChart').getContext('2d');
                                const chartData = @json($chartData);
                                const buildings = @json($buildings->pluck('name'));

                                @if(request('building_id') == 'all')
                                    // Chart untuk semua gedung (stacked bar per jenis sampah per gedung)
                                    const labels = chartData.map(item => item.label);
                                    const datasets = buildings.map((building, idx) => ({
                                        label: building,
                                        data: chartData.map(item => item.data[idx] ?? 0),
                                        backgroundColor: [
                                            '#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b', '#858796', '#5a5c69'
                                        ][idx % 7],
                                        borderColor: [
                                            '#2e59d9', '#17a673', '#2c9faf', '#dda20a', '#be2617', '#6c757d', '#343a40'
                                        ][idx % 7],
                                        borderWidth: 1
                                    }));

                                    new Chart(barCtx, {
                                        type: 'bar',
                                        data: {
                                            labels: labels,
                                            datasets: datasets
                                        },
                                        options: {
                                            responsive: true,
                                            plugins: {
                                                title: {
                                                    display: true,
                                                    text: 'Total Berat Sampah per Jenis per Gedung'
                                                },
                                                tooltip: {
                                                    mode: 'index',
                                                    intersect: false,
                                                }
                                            },
                                            scales: {
                                                x: {
                                                    stacked: true
                                                },
                                                y: {
                                                    beginAtZero: true,
                                                    stacked: true,
                                                    title: {
                                                        display: true,
                                                        text: 'Berat (Kg)'
                                                    }
                                                }
                                            }
                                        }
                                    });
                                @else
                                    // Chart untuk satu gedung saja
                                    const labels = chartData.map(item => item.label);
                                    const data = chartData.map(item => item.data.reduce((a, b) => a + b, 0));

                                    new Chart(barCtx, {
                                        type: 'bar',
                                        data: {
                                            labels: labels,
                                            datasets: [{
                                                label: 'Total Berat Sampah (Kg)',
                                                data: data,
                                                backgroundColor: [
                                                    '#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b', '#858796', '#5a5c69'
                                                ],
                                                borderColor: [
                                                    '#2e59d9', '#17a673', '#2c9faf', '#dda20a', '#be2617', '#6c757d', '#343a40'
                                                ],
                                                borderWidth: 1
                                            }]
                                        },
                                        options: {
                                            responsive: true,
                                            plugins: {
                                                title: {
                                                    display: true,
                                                    text: 'Total Berat Sampah per Jenis'
                                                }
                                            },
                                            scales: {
                                                y: {
                                                    beginAtZero: true,
                                                    title: {
                                                        display: true,
                                                        text: 'Berat (Kg)'
                                                    }
                                                }
                                            }
                                        }
                                    });
                                @endif
                            </script>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

