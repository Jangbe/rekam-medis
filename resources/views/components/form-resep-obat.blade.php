<div>
    <style>
        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        input[type="number"] {
            -moz-appearance: textfield;
        }
        .has-error{
            border-color: red;
        }
    </style>
    <div class="card">
        <div class="card-header d-flex justify-content-between pb-0">
            <div class="card-title">Input Resep Obat</div>
            <button class="btn btn-sm btn-info" type="button" onclick="addTr()"><i class="fa fa-plus"></i></button>
        </div>
        <div class="card-body pt-0">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" style="vertical-align: middle;">
                    <thead>
                        <tr>
                            <th>Nama Obat</th>
                            <th>Harga</th>
                            <th style="width: 50px">Beli</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody id="tr">
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" style="text-align: right">Harga Dokter</td>
                            <td>
                                <div class="input-group input-group-outline">
                                    <input type="number" class="form-control has-error">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align: right">Total</td>
                            <td>
                                Rp.
                            </td>
                        </tr>

                    </tfoot>
                </table>
            </div>
            <div class="d-flex justify-content-end">
                <button class="btn btn-primary" wire:click='save'>Simpan</button>
            </div>
        </div>
    </div>

</div>

@push('js')
    <script>
        let receipts = [{obat_id:'',price: 0, amount: 0, subtotal: 0}]
        let loop = 0;
        function addTr(){
            receipts.push({obat_id:'',price: 0, amount: 0, subtotal: 0})
            $('#tr').append(`
            <tr>
                <td>
                    <div class="input-group input-group-outline">
                        <select class="select2 form-control" data-loop="${loop}">
                            <option value="">--Pilih Obat--</option>
                            @foreach (App\Models\Obat::all() as $obat)
                                <option value="{{ $obat->id }}" data-price="{{ $obat->price }}">{{ $obat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </td>
                <td>Rp. <span class="price">0</span></td>
                <td>
                    <div class="input-group input-group-outline">
                        <input type="number" data-loop="${loop}" class="form-group amount" min="0" value="0" style="max-width: 50px">
                    </div>
                </td>
                <td>Rp. <span class="subtotal">0</span></td>
            </tr>`)
            loop++
        }
        addTr()
        $(document).on('change', '.select2',function(){
            receipts[$(this).data('loop')].obat_id = $(this).val()
            let price = $(this).find(':selected').data('price')
            $(this).parent().parent().parent().find('.price').text('Rp. '+number_format(price))
        })
        $(document).on('change', '.amount',function(){
            let price = $(this).parent().parent().parent().find(':selected').data('price')
            let amount = $(this).val()
            
            $(this).parent().parent().parent().find('.subtotal').text('Rp. '+number_format(price*amount))
        })
        function number_format(x) {
            x = x.toString();
            var pattern = /(-?\d+)(\d{3})/;
            while (pattern.test(x))
                x = x.replace(pattern, "$1.$2");
            return x;
        }
    </script>
@endpush
