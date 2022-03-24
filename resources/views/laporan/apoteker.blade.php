@extends('layouts.app')

@section('content')
<style>
    .dotted{
        border-bottom: 1px dotted black;
    }
</style>
@isset($medical_record)
<div class="row">
    <div class="col-md-5 col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="text-center" style="font-size: 21px">dr. H. Marte Robiul Sani, Sp.A,M.Kes</h4>
                <hr style="margin-bottom: 10px; height: 3px">
                <p style="font-size: 14px" class="text-center mb-0">JL. RAYA BARAT PABRIK SINGAPARNA - TASIKMALAYA</p>
                <p style="font-size: 13px" class="text-center">TELP. 0851 0009 9370 HP. 0815 6022 530 - 0821 2972 7253</p>
                <hr style="border-width: 2px; margin-top: 10px; margin-bottom: 3px">
                <hr style="border-width: 1px; margin-top: 3px">
                <img src="{{ asset('storage/'.$medical_record->receipt) }}" style="width: 100%" alt="Belum Ada Resep Obat" class="pb-4" srcset="">
                <table style="width: 90%">
                    <tr>
                        <td style="width: 80px">Pro.</td>
                        <td style="width: 1px">:</td>
                        <td class="dotted">{{ $medical_record->patient->name }}</td>
                    </tr>
                    <tr>
                        <td>Umur</td>
                        <td>:</td>
                        <td class="dotted">{{ $medical_record->patient->age }}</td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top">Alamat</td>
                        <td style="vertical-align: top">:</td>
                        <td class="dotted">{{ $medical_record->patient->address }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-7 col-12">
        <div class="card">
            <div class="card-body table-responsive">
                <table class="table table-striped">
                    <thead>
                        <th>No</th>
                        <th>Nama Obat</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                    </thead>
                    <tbody>
                        @foreach ($medical_record->receipts as $obat)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $obat->obat->name }}</td>
                                <td>Rp. {{ number_format($obat->obat->price, 0, ',', '.') }}</td>
                                <td>{{ $obat->amount }}</td>
                                <td>Rp. {{ number_format($obat->subtotal, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@else
<div class="alert alert-warning">Tidak ada data pemberian obat</div>
@endisset
@endsection
