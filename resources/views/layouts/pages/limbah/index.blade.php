@extends('layouts.main')

@section('header')

@endsection

@section('content')
    <!-- Content Row -->
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="h3 mb-2 text-gray-800">Data Sampah</h1>
            </div>
            <div class="col-sm-6 text-right">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active">Data Sampah</li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card shadow mb-5">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Tabel Sampah</h6>
                    <div class="d-flex">
                        @if(auth()->user()->role === 'admin')
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-sm btn-secondary mr-2" data-toggle="modal" data-target="#softDeleteModal">
                                Data Terhapus
                            </button>
                            <!-- Modal Soft Delete-->
                            <div class="modal fade" id="softDeleteModal" tabindex="-1" role="dialog" aria-labelledby="softDeleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="softDeleteModalLabel">Data Sampah Terhapus</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                    Apakah anda yakin ingin melihat data sampah yang sudah terhapus?
                                    </div> 
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <a href="/limbah/softdelete" class="btn btn-primary">Lihat Data</a>
                                    </div>
                                </div>
                                </div>
                            </div>
                        @endif
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#createModal">
                        Tambah Sampah
                        </button>
                        <!-- Modal Create-->
                        @include('layouts.pages.limbah.create')
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="mb-3 d-flex justify-content-between align-items-center">
                        <div>
                            <form method="GET" action="{{ url('/limbah') }}" id="perPageForm" class="form-inline">
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
                        <table class="table table-bordered" id="table-limbah">
                        <thead>
                            <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Sampah</th>
                            <th class="text-center">Jenis Sampah</th>
                            <th class="text-center">Deskripsi</th>
                            <th class="text-center">Volume (Kg)</th>
                            <th class="text-center">Sumber</th>
                            <th class="text-center">Tanggal Masuk</th>
                            <th class="text-center">Aksi</th>
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
                                <td>{{ $item->description }}</td>
                                <td>{{ $item->weight }}</td>
                                <td>{{ $item->building?->name ?? 'N/A' }}</td>
                                <td>{{ $item->collection_date ? \Carbon\Carbon::parse($item->collection_date)->format('Y-m-d') : 'N/A' }}</td>
                                <td>
                                <div class="d-flex justify-content-center">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-sm btn-warning mr-2" data-toggle="modal" data-target="#editModal{{ $item->id }}">
                                        Edit
                                    </button>
                                    <!-- Modal Edit-->
                                    @include('layouts.pages.limbah.edit')

                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal{{ $item->id }}">
                                        Hapus
                                    </button>
                                    <!-- Modal Delete-->
                                    <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $item->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel{{ $item->id }}">Konfirmasi Hapus</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah anda yakin ingin menghapus data ini?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                    <form action="/limbah/{{ $item->id }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </td>
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