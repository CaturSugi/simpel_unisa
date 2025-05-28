@extends('layouts.main')

@section('header')

@endsection

@section('content')
    <!-- Content Row -->
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="h3 mb-2 text-gray-800">Jenis Sampah</h1>
            </div>
            <div class="col-sm-6 ml-auto text-right">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active">Jenis Sampah</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card shadow mb-5">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Tabel Jenis Sampah</h6>
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#createModal">
                            Tambah Kategori
                        </button>
                        <!-- Modal Create-->
                        @include('layouts.pages.category.create')
                        <!-- Modal Create-->
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="table-Categori">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Nama Kategori</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $item)
                                        <tr>
                                            <td class="text-center">{{ ($categories->currentPage() - 1) * $categories->perPage() + $loop->iteration }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-sm btn-warning mr-2" data-toggle="modal" data-target="#editModal{{ $item->id }}">
                                                        Edit
                                                    </button>
                                                    <!-- Modal Edit-->
                                                    @include('layouts.pages.category.edit')


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
                                                                    <form action="/category/{{ $item->id }}" method="POST">
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
                                {{ $categories->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection