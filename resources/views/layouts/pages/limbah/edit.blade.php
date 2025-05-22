<div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{ $item->id }}">Edit Limbah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/limbah/{{ $item->id }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name{{ $item->id }}">Nama Limbah</label>
                        <input type="text" class="form-control" id="name{{ $item->id }}" name="name" value="{{ $item->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="category{{ $item->id }}">Jenis Limbah</label>
                        <select class="form-control" id="category{{ $item->id }}" name="category_id" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $item->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="weight{{ $item->id }}">Volume (Kg)</label>
                        <input type="number" class="form-control" id="weight{{ $item->id }}" name="weight" value="{{ $item->weight }}" required placeholder="Ketikkan dengan angka" step="0.01" min="0">
                        <small class="form-text text-muted">Ketikkan dengan angka atau desimal, misal: 1.25</small>
                        @error('weight')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="building{{ $item->id }}">Sumber Limbah</label>
                        <select class="form-control" id="building_id{{ $item->id }}" name="building_id" required>
                            @foreach($buildings as $building)
                                <option value="{{ $building->id }}" {{ $item->building_id == $building->id ? 'selected' : '' }}>{{ $building->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- <div class="form-group">
                        <label for="collection_date{{ $item->id }}">Tanggal Masuk</label>
                        <input type="date" class="form-control" id="collection_date{{ $item->id }}" name="collection_date" value="{{ $item->collection_date }}" required>
                    </div> --}}
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>