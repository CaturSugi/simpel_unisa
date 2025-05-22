@extends('layouts.main')

@section('header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Profile</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                <li class="breadcrumb-item"><a href="/users">User</a></li>
                <li class="breadcrumb-item active">Profile</li>
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
                        <h6 class="m-0 font-weight-bold text-primary">Edit Profile</h6>
                    </div>
                        {{-- <div class="card-body">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Username</label>
                                <input class="form-control" type="text" value="lucky.jesse">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Email address</label>
                                <input class="form-control" type="email" value="jesse@example.com">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="example-text-input" class="form-control-label">First name</label>
                                <input class="form-control" type="text" value="Jesse">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Last name</label>
                                <input class="form-control" type="text" value="Lucky">
                              </div>
                            </div>
                          </div>
                          <hr class="horizontal dark">
                          <p class="text-uppercase text-sm">Contact Information</p>
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Address</label>
                                <input class="form-control" type="text" value="Bld Mihail Kogalniceanu, nr. 8 Bl 1, Sc 1, Ap 09">
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="example-text-input" class="form-control-label">City</label>
                                <input class="form-control" type="text" value="New York">
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Country</label>
                                <input class="form-control" type="text" value="United States">
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Postal code</label>
                                <input class="form-control" type="text" value="437300">
                              </div>
                            </div>
                          </div>
                          <hr class="horizontal dark">
                          <p class="text-uppercase text-sm">About me</p>
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="example-text-input" class="form-control-label">About me</label>
                                <input class="form-control" type="text" value="A beautiful Dashboard for Bootstrap 5. It is Free and Open Source.">
                              </div>
                            </div>
                        </div> --}}
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <div class="card shadow mb-5">
                                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                            <h6 class="m-0 font-weight-bold text-primary">Edit Data User</h6>
                                        </div>
                                        <form action="/users/{{ $users->id }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <div class="form-group">
                                                        <label for="name">Nama User</label>
                                                        <input type="name" class="form-control" id="name" placeholder="masukan nama" name="name" value="{{ $users->name }}" required>
                                                        @error('name')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="table-responsive">
                                                    <div class="form-group">
                                                        <label for="email">Email</label>
                                                        <input type="email" class="form-control" id="email" placeholder="masukan email" name="email" value="{{ $users->email }}" required>
                                                        @error('email')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="table-responsive">
                                                    <div class="form-group">
                                                        <label for="role">Role</label>
                                                        <select class="form-control" id="role" name="role" required>
                                                            <option disabled selected>Pilih Role</option>
                                                            <option value="admin" {{ $users->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                                            <option value="user" {{ $users->role == 'user' ? 'selected' : '' }}>User</option>
                                                        </select>
                                                        @error('role')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="table-responsive">
                                                    <div class="form-group">
                                                        <label for="password">Password</label>
                                                        <input type="password" class="form-control" id="password" placeholder="masukan password" name="password" value="{{ $users->password }}" required>
                                                        @error('password')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <div class="d-flex justify-content-end">
                                                    <a href="/users" class="btn btn-secondary mr-2">Batal</a>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection