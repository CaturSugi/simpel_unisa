<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Tambah Limbah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/limbah/store" method="POST">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nama Limbah</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Masukan nama limbah" required required pattern="[A-Za-z0-9\s]+" title="Hanya huruf dan angka tanpa simbol">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="category_id">Kategori</label>
                        <select class="form-control" id="category_id" name="category_id" required>
                            <option value="" disabled selected>Pilih Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Deskripsi</label>
                        <textarea class="form-control" id="description" rows="3" name="description"></textarea>
                        <small class="form-text text-muted">Tambahkan Jika Perlu</small>
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="weight">Volume (Kg)</label>
                        <input type="number" class="form-control" id="weight" name="weight" required placeholder="Ketikkan dengan angka" step="0.01" min="0">
                        <small class="form-text text-muted">Ketikkan dengan angka, misal: 1.25</small>
                        @error('weight')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="building_id">Sumber</label>
                        <select class="form-control" id="building_id" name="building_id" required>
                            <option value="" disabled selected>Pilih Sumber Sampah</option>
                            @foreach ($buildings as $building)
                                <option value="{{ $building->id }}">{{ $building->name }}</option>
                            @endforeach
                        </select>
                        @error('building_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- <div class="form-group">
                        <label for="collection_date">Tanggal Masuk</label>
                        <input type="date" class="form-control" id="collection_date" name="collection_date" required>
                        @error('collection_date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>