    <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel{{ $item->id }}">Edit Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/category/{{ $item->id }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name{{ $item->id }}">Nama Kategori</label>
                            <input type="text" class="form-control" id="name{{ $item->id }}" name="name" value="{{ $item->name }}" required pattern="[A-Za-z0-9\s]+" title="Hanya huruf dan angka tanpa simbol">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>