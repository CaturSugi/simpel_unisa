@extends('layouts.main')

@section('header')
    <div class="row mb-2">
        {{-- <div class="col-sm-6">
            <h1>Data Limbah</h1>
        </div> --}}
        <div class="col-sm-6 ml-auto text-right">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item active">Data Limbah</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <!-- Content Row -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card shadow mb-5">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Tabel Limbah Terhapus</h6>
                        <div class="d-flex">
                            <a href="{{ url('/limbah') }}" class="btn btn-sm btn-primary">
                                Kembali
                            </a>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="table-limbah">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Nama Limbah</th>
                                        <th class="text-center">Jenis Limbah</th>
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
                                            <td class="text-center">{{ ($trashes->currentPage() - 1) * $trashes->perPage() + $loop->iteration }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->category->name }}</td>
                                            <td>{{ $item->description }}</td>
                                            <td>{{ $item->weight }}</td>
                                            <td>{{ $item->building?->name ?? 'N/A' }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('Y-m-d') }}</td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-sm btn-warning mr-2" data-toggle="modal" data-target="#restoreModal{{ $item->id }}">
                                                        Kembalikan Data
                                                    </button>
                                                    <!-- Modal Restore-->
                                                    <div class="modal fade" id="restoreModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="restoreModalLabel{{ $item->id }}" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="restoreModalLabel{{ $item->id }}">Konfirmasi Kembalikan</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Apakah anda yakin ingin mengembalikan data ini?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                                    <form action="{{ url('/limbah/restore/' . $item->id) }}" method="GET">
                                                                        @csrf
                                                                        <button type="submit" class="btn btn-primary">Kembalikan</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#forcedeleteModal{{ $item->id }}">
                                                        Hapus Permanen
                                                    </button>
                                                    <!-- Modal Delete-->
                                                    <div class="modal fade" id="forcedeleteModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="forcedeleteModalLabel{{ $item->id }}" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="forcedeleteModalLabel{{ $item->id }}">Konfirmasi Hapus</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Apakah anda yakin ingin menghapus data ini secara permanen?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                                    <form action="{{ url('/limbah/forceDelete/' . $item->id) }}" method="POST">
                                                                        @csrf
                                                                        @method('GET')
                                                                        <button type="submit" class="btn btn-danger">Hapus Permanen</button>
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
                                {{ $trashes->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection