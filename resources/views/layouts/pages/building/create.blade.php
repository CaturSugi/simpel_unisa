<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Tambah Gedung</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/building/store" method="POST" id="createBuildingForm">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <div id="successMessage" class="alert alert-success d-none" role="alert">
                        Data berhasil ditambahkan!
                    </div>
                    <div class="form-group">
                        <label for="name">Nama Gedung</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Masukan nama gedung" required pattern="[A-Za-z0-9\s]+" title="Hanya huruf dan angka tanpa simbol">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>