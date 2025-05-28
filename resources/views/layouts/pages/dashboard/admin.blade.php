@extends('layouts.main')

@php
use App\Models\Category;
@endphp

@section('header')
    <div class="row mb-2 mt-4">

    </div>
@endsection

@section('content')
    <div class="container-fluid mt-4">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="h3 mb-2 text-gray-800">Dashboard</h1>
            </div>
            <div class="col-sm-6 text-right">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                </ol>
            </div>
        </div>
        <!-- Content Row -->
        <div class="row">
            <!-- Waste Collected Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    Sampah Terkumpul</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ \App\Models\Trash::count() }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dumpster fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Waste Categories Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Kategori Sampah</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ Category::count() }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-trash-alt fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Weight of Waste Collected Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Berat Sampah Terkumpul</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ \App\Models\Trash::sum('weight') }} Kg</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-weight fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            <!-- Total Users Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Jumlah User</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ \App\Models\User::count() }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Content Row -->
    
        <div class="row">
    
            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Sampah Terkumpul</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-area">
                            {!! $linechart->container() !!}
                        </div>
                    </div>
                </div>
            </div>
    
            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Data User</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        {!! $chart->container() !!}
                    </div>
                </div>
            </div>

            <!-- DataTales Sampah -->
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Data Tabel Sampah</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <div class="mb-3 d-flex flex-wrap justify-content-between align-items-center">
                                    <div>
                                        <form method="GET" action="{{ url('/dashboard') }}" id="perPageForm" class="form-inline">
                                            <label for="perPage" class="mr-2 mb-0">Tampilkan</label>
                                            <select name="perPage" id="perPage" class="form-control form-control-sm mr-2" onchange="document.getElementById('perPageForm').submit()">
                                                <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                                                <option value="25" {{ request('perPage') == 25 || is_null(request('perPage')) ? 'selected' : '' }}>25</option>
                                                <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50</option>
                                                <option value="100" {{ request('perPage') == 100 ? 'selected' : '' }}>100</option>
                                                <option value="all" {{ request('perPage') == 'all' ? 'selected' : '' }}>Semua</option>
                                            </select>
                                            @foreach(request()->except(['perPage', 'page']) as $key => $value)
                                                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                            @endforeach
                                        </form>
                                    </div>
                                    <div>
                                        <label class="d-flex align-items-center mb-0">
                                            <span class="mr-2">Cari:</span>
                                            <input type="search" class="form-control form-control-sm" placeholder="Cari data..." aria-controls="dataTable" id="searchInput" style="min-width: 180px;">
                                        </label>
                                    </div>
                                </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var searchInput = document.getElementById('searchInput');
                                        searchInput.addEventListener('input', function() {
                                            var filter = searchInput.value.toLowerCase();
                                            var rows = document.querySelectorAll('#dataTable tbody tr');
                                            rows.forEach(function(row) {
                                                var cells = row.querySelectorAll('td');
                                                var match = false;
                                                cells.forEach(function(cell) {
                                                    if (cell.textContent.toLowerCase().indexOf(filter) > -1) {
                                                        match = true;
                                                    }
                                                });
                                                row.style.display = match ? '' : 'none';
                                            });
                                        });
                                    });
                                </script>
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Nama Sampah</th>
                                        <th class="text-center">Jenis Sampah</th>
                                        <th class="text-center">Deskripsi</th>
                                        <th class="text-center">Volume (Kg)</th>
                                        <th class="text-center">Tanggal Masuk</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($trashes as $item)
                                        <tr>
                                            <td class="text-center">{{ ($trashes->currentPage() - 1) * $trashes->perPage() + $loop->iteration }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->category->name }}</td>
                                            <td>{{ $item->description }}</td>
                                            <td>{{ $item->weight }}</td>
                                            <td>{{ $item->collection_date }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-end">
                                @if(request('perPage') != 'all' && $trashes instanceof \Illuminate\Pagination\LengthAwarePaginator)
                                    {{ $trashes->appends(request()->except('page'))->links('pagination::bootstrap-4') }}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
    </div>
    <script src="{{ $chart->cdn() }}"></script>
    {{ $chart->script() }}

    <script src="{{ $linechart->cdn() }}"></script>
    {{ $linechart->script() }}
@endsection
