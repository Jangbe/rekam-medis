<div class="modal fade" id="modal-obat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ $action??'' }}" method="post" id="form">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><span id="title"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    @method($method??'post')
                    <div class="row">
                        <div class="col-md-6 col-12 mb-4">
                            <div class="input-group input-group-outline">
                                <label for="" class="form-label">Nama</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name',$obat->name??'') }}">
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-12 mb-4">
                            <div class="input-group input-group-outline">
                                <label for="" class="form-label">Type</label>
                                <input type="text" class="form-control @error('type') is-invalid @enderror" name="type" value="{{ old('type',$obat->type??'') }}">
                                @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-12 mb-4">
                            <div class="input-group input-group-outline">
                                <label for="" class="form-label">Satuan</label>
                                <input type="text" class="form-control @error('satuan') is-invalid @enderror" name="satuan" value="{{ old('satuan',$obat->satuan??'') }}">
                                @error('satuan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-12 mb-4">
                            <div class="input-group input-group-outline">
                                <label for="" class="form-label">Harga</label>
                                <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price',$obat->price??'') }}">
                                @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
