<div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $user->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{ $user->id }}">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/users/{{ $user->id }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name{{ $user->id }}">Nama</label>
                        <input type="text" class="form-control" id="name{{ $user->id }}" name="name" value="{{ $user->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="email{{ $user->id }}">Email</label>
                        <input type="email" class="form-control" id="email{{ $user->id }}" name="email" value="{{ $user->email }}" required>
                    </div>
                    <div class="form-group">
                        <label for="role{{ $user->id }}">Role</label>
                        <select class="form-control" id="role{{ $user->id }}" name="role" required>
                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="password{{ $user->id }}">Password</label>
                        <input type="password" class="form-control" id="password{{ $user->id }}" name="password" value="{{ $user->password }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>