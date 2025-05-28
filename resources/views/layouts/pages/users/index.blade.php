@extends('layouts.main')

@section('header')

@endsection

@section('content')
    <!-- Content Row -->
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="h3 mb-2 text-gray-800">Data User</h1>
            </div>
            <div class="col-sm-6 ml-auto text-right">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active">Data User</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card shadow mb-5">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Tabel Data User</h6>
                        <div class="d-flex">
                            <button type="button" class="btn btn-sm btn-secondary mr-2" data-toggle="modal" data-target="#softDeleteModal">
                                Data Terhapus
                            </button>
                            <!-- Modal Soft Delete-->
                            <div class="modal fade" id="softDeleteModal" tabindex="-1" role="dialog" aria-labelledby="softDeleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="softDeleteModalLabel">Data User Terhapus</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah anda yakin ingin melihat data user yang sudah terhapus?
                                        </div> 
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            <a href="/users/softdelete" class="btn btn-primary">Lihat Data</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-sm btn-primary mr-2" data-toggle="modal" data-target="#addUserModal">
                                Tambah User
                            </button>
                            <!-- Modal Create-->
                            @include('layouts.pages.users.create')
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="table-Users">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Nama User</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td class="text-center">{{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-sm btn-warning mr-2" data-toggle="modal" data-target="#editModal{{ $user->id }}">
                                                        Edit
                                                    </button>
                                                    <!-- Modal Edit-->
                                                    @include('layouts.pages.users.edit')

                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal{{ $user->id }}">
                                                        Hapus
                                                    </button>
                                                    <!-- Modal Delete-->
                                                    <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $user->id }}" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="deleteModalLabel{{ $user->id }}">Konfirmasi Hapus</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Apakah anda yakin ingin menghapus data ini?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                                    <form action="/users/{{ $user->id }}" method="POST">
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
                                {{ $users->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection