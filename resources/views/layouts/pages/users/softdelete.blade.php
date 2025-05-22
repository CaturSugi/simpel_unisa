@extends('layouts.main')

@section('header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Data User</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                <li class="breadcrumb-item active">User</li>
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
                        <h6 class="m-0 font-weight-bold text-primary">Tabel Data User Terhapus</h6>
                        <div class="d-flex">
                            <a href="{{ url('/users') }}" class="btn btn-sm btn-primary">
                                Kembali
                            </a>
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
                                                    <button type="button" class="btn btn-sm btn-warning mr-2" data-toggle="modal" data-target="#restoreModal{{ $user->id }}">
                                                        Kembalikan Data
                                                    </button>
                                                    <!-- Modal Restore-->
                                                    <div class="modal fade" id="restoreModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="restoreModalLabel{{ $user->id }}" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="restoreModalLabel{{ $user->id }}">Konfirmasi Restore</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Apakah anda yakin ingin mengembalikan data ini?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                                    <form action="{{ url('/users/restore/' . $user->id) }}" method="POST">
                                                                        @csrf
                                                                        @method('GET')
                                                                        <button type="submit" class="btn btn-primary">Kembalikan</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#forcedeleteModal{{ $user->id }}">
                                                        Hapus Permanen
                                                    </button>
                                                    <!-- Modal Force Delete-->
                                                    <div class="modal fade" id="forcedeleteModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $user->id }}" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="deleteModalLabel{{ $user->id }}">Konfirmasi Hapus</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Apakah anda yakin ingin menghapus data ini secara permanen?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                                    <form action="{{ url('/users/forceDelete/' . $user->id) }}" method="POST">
                                                                        @csrf
                                                                        @method('GET')
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