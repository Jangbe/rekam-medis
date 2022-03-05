<div>
    <div class="row">
        <div class="col-md-6 col-12 mb-4">
            <label for="" class="form-label">Nama</label>
            <div class="input-group input-group-outline">
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name',$patient->name??'') }}">
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>
        <div class="col-md-2 col-6">
            <label for="gender">Jenis Kelamin</label>
            <div class="input-group input-group-outline">
                <select name="gender" id="gender" class="form-control">
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>
        </div>
        <div class="col-md-4 col-6 mb-4">
            <label for="" class="form-label">Tgl Lahir</label>
            <div class="input-group input-group-outline">
                <input type="date" class="form-control @error('birth') is-invalid @enderror" name="birth" value="{{ old('birth',$patient->birth??'') }}">
                <input type="text" class="form-control" style="border-top-right-radius: 5px; border-bottom-right-radius: 5px;" readonly id="umur" placeholder="Umur">
                @error('birth') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>
        <div class="col-md-3 col-6 mb-4">
            <label for="" class="form-label">Nama Ayah</label>
            <div class="input-group input-group-outline">
                <input type="text" class="form-control @error('father_name') is-invalid @enderror" name="father_name" value="{{ old('father_name',$patient->father_name??'') }}">
                @error('father_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>
        <div class="col-md-3 col-6 mb-4">
            <label for="" class="form-label">Nama Ibu</label>
            <div class="input-group input-group-outline">
                <input type="text" class="form-control @error('mother_name') is-invalid @enderror" name="mother_name" value="{{ old('mother_name',$patient->mother_name??'') }}">
                @error('mother_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>
        <div class="col-md-6 col-12 mb-4">
            <label for="" class="form-label">No HP</label>
            <div class="input-group input-group-outline">
                <input type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone',$patient->phone??'') }}">
                @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>
        <div class="col-md-6 col-12 mb-4">
            <label for="" class="form-label">Provinsi</label>
            <div class="input-group input-group-outline">
                <select id="provincy" class="form-control @error('provincy') is-invalid @enderror" name="provincy">
                </select>
                @error('provincy') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>
        <div class="col-md-6 col-12 mb-4">
            <label for="" class="form-label">Kab / Kota</label>
            <div class="input-group input-group-outline">
                <select id="regency" class="form-control @error('regency') is-invalid @enderror" name="regency">
                </select>
                @error('regency') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>
        <div class="col-md-6 col-12 mb-4">
            <label for="" class="form-label">Kecamatan</label>
            <div class="input-group input-group-outline">
                <select id="district" class="form-control @error('district') is-invalid @enderror" name="district"></select>
                @error('district') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>
        <div class="col-md-6 col-12 mb-4">
            <label for="" class="form-label">Kelurahan</label>
            <div class="input-group input-group-outline">
                <select id="village" class="form-control @error('village') is-invalid @enderror" name="village"></select>
                @error('village') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>
        <div class="col-12 mb-4">
            <label for="" class="form-label">Alamat</label>
            <div class="input-group input-group-outline">
                <textarea class="form-control @error('address') is-invalid @enderror" name="address">{{ old('address',$patient->address??'') }}</textarea>
                @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>
    </div>
</div>

@push('js')
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script>
        $('#provincy').on('change', function(){
            let id = $(this).find(':selected').data('id')
            setData('regencies/'+id+'.json', 'regency');
        })
        $('#regency').on('change', function(){
            let id = $(this).find(':selected').data('id')
            setData('districts/'+id+'.json', 'district');
        })
        $('#district').on('change', function(){
            let id = $(this).find(':selected').data('id')
            setData('villages/'+id+'.json', 'village');
        })
        var api = 'http://www.emsifa.com/api-wilayah-indonesia/api/';
        async function setData(region, node){
            $.ajax({
                url: api+region,
                async: false,
                success: (data) => {
                    $('#'+node).empty().append(`<option>---pilih ${node}---</option>`)
                    data.forEach((v,i)=>{
                        $('#'+node).append(`<option data-id="${v.id}">${v.name}</option>`)
                    })
                }
            })
        }
        $('input[name=birth]').on('change', function(){
            var startDate = new Date($(this).val());
            var diffDate = new Date(new Date() - startDate);
            var result =  ((diffDate.toISOString().slice(0, 4) - 1970) + " tahun " +
                diffDate.getMonth() + " bulan " + (diffDate.getDate()-1) + " hari");
            $('#umur').val(result)
        })
        setData('provinces.json', 'provincy')
    </script>
    @foreach (['provincy','regency','district','village'] as $select)
        @if (old($select))
            <script>
                console.log('{{ old($select) }}');
                $('#{{ $select }}').val('{{ old($select) }}').trigger('change')
            </script>
        @endif
    @endforeach
    @if (isset($patient))
        @foreach ($patient->only('provincy','regency','district','village') as $key => $item)
        <script>
            $('#{{ $key }}').val("{{ $item }}").trigger('change')
        </script>
        @endforeach
    @endif
@endpush
