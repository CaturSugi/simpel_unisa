<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Cetak Laporan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="GET" action="/laporan/print">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="mb-1">Rentang Tanggal:</label>
                        <div class="d-flex align-items-center flex-wrap mb-2">
                            <input type="date" name="start_date" class="form-control form-control-sm mr-2 mb-2" id="startDate" value="{{ request('start_date') }}">
                            <span class="mx-2 mb-2">ke</span>
                            <input type="date" name="end_date" class="form-control form-control-sm mr-2 mb-2" id="endDate" value="{{ request('end_date') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="mb-1" for="filterCategory">Jenis Sampah</label>
                        <select name="category_id" class="form-control form-control-sm mb-2" id="filterCategory">
                            <option value="all" {{ request('category_id') === 'all' ? 'selected' : '' }}>Semua Jenis Sampah</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="mb-1" for="filterBuilding">Pilih Gedung</label>
                        <select name="building_id" class="form-control form-control-sm mb-2" id="filterBuilding">
                            <option value="all" {{ request('building_id') === 'all' ? 'selected' : '' }}>Semua Jenis Gedung</option>
                            @foreach ($buildings as $building)
                                <option value="{{ $building->id }}" {{ request('building_id') == $building->id ? 'selected' : '' }}>
                                    {{ $building->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="fileType">File Type:</label>
                        <select class="form-control" id="fileType" name="file_type">
                            <option value="pdf">PDF</option>
                            <option value="csv">CSV</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Cetak</button>
                </div>
            </form>
        </div>
    </div>
</div>