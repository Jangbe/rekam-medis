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
    </style>
    <div class="card">
        <div class="card-header d-flex justify-content-between pb-0">
            <div class="card-title">Input Resep Obat</div>
            <button class="btn btn-sm btn-info" type="button" wire:click="addObat"><i class="fa fa-plus"></i></button>
        </div>
        <div class="card-body pt-0">
            <div class="table-responsive">
                <table class="table table-bordered" style="vertical-align: middle">
                    <thead>
                        <tr>
                            <th>Nama Obat</th>
                            <th>Harga</th>
                            <th style="width: 50px">Beli</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($receipts as $i => $receipt)
                            <tr>
                                <td>
                                    <div class="input-group input-group-outline">
                                        <select wire:model="receipts.{{ $i }}.obat_id" class="obat_id @error("receipts.$i.obat_id") is-invalid @enderror" data-i="{{ $i }}">
                                            <option value="">--Pilih Obat--</option>
                                            @foreach ($obats as $obat)
                                                <option value="{{ $obat->id }}">{{ $obat->name }}</option>
                                            @endforeach
                                        </select>
                                        @error("receipts.$i.obat_id") <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </td>
                                <td>Rp. {{ number_format($receipt['price'], 0, ',', '.') }}</td>
                                <td>
                                    <div class="input-group input-group-outline">
                                        <input type="number" class="form-group @error("receipts.$i.amount") is-invalid @enderror" wire:change='setSubtotal({{ $i }})' wire:model='receipts.{{ $i }}.amount' min="0" style="max-width: 50px">
                                        @error("receipts.$i.amount") <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </td>
                                <td>Rp. {{ number_format(intval($receipt['price'])*intval($receipt['amount']), 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="3" style="text-align: right">Harga Dokter</td>
                            <td>
                                <div class="input-group input-group-outline">
                                    <input type="number" class="form-control" wire:model='harga_dokter'>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align: right">Total</td>
                            <td>

                                Rp. {{ number_format(collect($receipts)->sum('subtotal')+intval($harga_dokter) ,0,',','.') }}
                            </td>
                        </tr>
                        <tr></tr>
                    </tbody>
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
        document.addEventListener('DOMContentLoaded',function() {
            window.initSelectCompanyDrop=()=>{
                $('.obat_id').select2({
                    placeholder: 'Pilih Obat',
                    allowClear: true,
                    theme: 'bootstrap'
                });
            }
            initSelectCompanyDrop();
            $('.obat_id').on('change', function (e) {
                // livewire.emit('setPrice', e.target.dataset.i)
            });
            window.livewire.on('select2',()=>{
                initSelectCompanyDrop();
            });

        });
    </script>
@endpush
