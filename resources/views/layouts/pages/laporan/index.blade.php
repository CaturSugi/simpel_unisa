@extends('layouts.main')

@section('header')

@endsection

@section('content')
    <!-- Content Row -->
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="h3 mb-2 text-gray-800">Laporan Sampah</h1>
            </div>
            <div class="col-sm-6 text-right">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active">Laporan Sampah</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-6">
                <div class="card border-left-primary shadow h-100">
                    <div class="card-body d-flex align-items-center">
                        <div class="mr-3 flex-grow-1">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-2">
                                Jumlah Sampah
                            </div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800">{{ \App\Models\Trash::count() }}</div>
                        </div>
                        <div>
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-6 ml-auto">
                <div class="card border-left-success shadow h-100">
                    <div class="card-body d-flex align-items-center">
                        <div class="mr-3 flex-grow-1">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-2">
                                Total Berat Sampah
                            </div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800">{{ \App\Models\Trash::sum('weight') }} Kg</div>
                        </div>
                        <div>
                            <i class="fas fa-weight fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card shadow mb-5">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Laporan Sampah</h6>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#createModal">
                            Cetak Laporan
                        </button>
                        <!-- Modal Create -->
                        @include('layouts.pages.laporan.printpdf')
                    </div>
                    
                    <div class="card-body">
                        <div class="mb-3 d-flex justify-content-between align-items-center">
                            <div>
                                <form method="GET" action="{{ url('/laporan') }}" id="perPageForm" class="form-inline">
                                    <label for="perPage" class="mr-2">Tampilkan</label>
                                    <select name="perPage" id="perPage" class="form-control form-control-sm" onchange="document.getElementById('perPageForm').submit()">
                                        <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                                        <option value="25" {{ request('perPage') == 25 || is_null(request('perPage')) ? 'selected' : '' }}>25</option>
                                        <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50</option>
                                        <option value="100" {{ request('perPage') == 100 ? 'selected' : '' }}>100</option>
                                        <option value="all" {{ request('perPage') == 'all' ? 'selected' : '' }}>Semua</option>
                                    </select>

                                    {{-- Tambahkan semua parameter kecuali perPage dan page agar tetap terbawa --}}
                                    @foreach(request()->except(['perPage', 'page']) as $key => $value)
                                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                    @endforeach
                                </form>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <div class="d-flex justify-content-between mb-2">
                                    <div class="d-flex align-items-center">
                                        <form method="GET" action="/laporan" class="d-flex align-items-center">
                                            <label class="mr-2">Rentang tanggal:</label>
                                            <input type="date" name="start_date" class="form-control form-control-sm" id="startDate" value="{{ request('start_date') }}">
                                            <span class="mx-2">ke</span>
                                            <input type="date" name="end_date" class="form-control form-control-sm" id="endDate" value="{{ request('end_date') }}">
                                            <select name="category_id" class="form-control form-control-sm mx-2" id="filterCategory">
                                                <option value="all" {{ request('category_id') === 'all' ? 'selected' : '' }}>Semua Jenis Sampah</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <select name="building_id" class="form-control form-control-sm mx-2" id="filterBuilding">
                                                <option value="all" {{ request('building_id') === 'all' ? 'selected' : '' }}>Semua Jenis Gedung</option>
                                                @foreach ($buildings as $building)
                                                    <option value="{{ $building->id }}" {{ request('building_id') == $building->id ? 'selected' : '' }}>
                                                        {{ $building->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <button type="submit" class="btn btn-sm btn-primary ml-2" id="filterButton">
                                                <i class="bi bi-filter"></i> Filter
                                            </button>
                                            <button type="button" class="btn btn-sm btn-secondary ml-2" id="resetButton">
                                                <i class="bi bi-x-circle"></i> Reset
                                            </button>
                                            <script>
                                                document.getElementById('resetButton').addEventListener('click', function() {
                                                    document.getElementById('startDate').value = '';
                                                    document.getElementById('endDate').value = '';
                                                    document.getElementById('filterCategory').value = '';
                                                    document.getElementById('filterBuilding').value = '';
                                                });
                                            </script>
                                        </form>
                                    </div>
                                    <div class="d-flex align-items-center ml-2">
                                        <label class="d-flex align-items-center">Search:<input type="search" class="form-control form-control-sm ml-2" placeholder="Search" aria-controls="dataTable" id="searchInput"></label>
                                    </div>
                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            const searchInput = document.getElementById('searchInput');
                                            searchInput.addEventListener('input', function() {
                                                const filter = searchInput.value.toLowerCase();
                                                const rows = document.querySelectorAll('#dataTable tbody tr');
                                                rows.forEach(row => {
                                                    const cells = row.querySelectorAll('td');
                                                    let match = false;
                                                    cells.forEach(cell => {
                                                        if (cell.textContent.toLowerCase().includes(filter)) {
                                                            match = true;
                                                        }
                                                    });
                                                    if (match) {
                                                        row.style.display = '';
                                                    } else {
                                                        row.style.display = 'none';
                                                    }
                                                });
                                            });
                                        });
                                    </script>
                                </div>
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Nama Sampah</th>
                                        <th class="text-center">Jenis Sampah</th>
                                        <th class="text-center">Sumber Sampah</th>
                                        <th class="text-center">Volume (Kg)</th>
                                        <th class="text-center">Tanggal Masuk</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($trashes as $item)
                                        <tr>
                                            <td class="text-center">
                                                {{ (request('perPage') == 'all' ? $trashes->count() : $trashes->total()) - (($trashes->currentPage() - 1) * $trashes->perPage()) - $loop->index }}
                                            </td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->category->name }}</td>
                                            <td>{{ $item->building->name }}</td>
                                            <td>{{ $item->weight }}</td>
                                            <td>{{ $item->created_at }}</td>
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
@endsection