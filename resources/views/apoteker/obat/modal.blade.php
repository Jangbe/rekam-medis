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
                    <div class="row">
                        <div class="col-12 mb-4">
                            <label for="" class="form-label">Nama</label>
                            <div class="input-group input-group-outline">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name',$obat->name??'') }}">
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-12 mb-4">
                            <label for="" class="form-label">Sediaan Obat</label>
                            <div class="input-group input-group-outline">
                                <select name="unit" id="unit" class="form-control @error('unit') is-invalid @enderror">
                                    <option value="">--Pilih Sediaan--</option>
                                    @foreach (['Sirup','Serbuk','Kapsul','Tablet'] as $opt)
                                        <option value="{{ $opt }}">{{ $opt }}</option>
                                    @endforeach
                                </select>
                                @error('unit') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-12 mb-4">
                            <label for="" class="form-label">Harga</label>
                            <div class="input-group input-group-outline">
                                <input type="text" inputmode="numeric" class="form-control price @error('price') is-invalid @enderror" name="price" value="{{ old('price',$obat->price??'') }}">
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

@push('js')
    <script>
        $('.price').on('keyup', function(){
            let number = to_number($(this).val())
            let price = number_format(number)
            $(this).val(price)
        })
        function number_format(x) {
            x = x.toString();
            var pattern = /(-?\d+)(\d{3})/;
            while (pattern.test(x))
                x = x.replace(pattern, "$1.$2");
            return x;
        }
        function to_number(x){
            x = x.split('.').join('')
            return x
        }
    </script>
@endpush
