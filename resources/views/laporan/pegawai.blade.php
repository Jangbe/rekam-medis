@extends('layouts.app')

@section('content')
    <style>
        .dotted {
            border-bottom: 1px dotted black;
        }

    </style>
    @isset($medical_record)
        <div class="row">
            <div class="col-md-8 col-12">
                <div class="card">
                    <div class="card-body p-1">
                        <table class="table table-bordered table-primary">
                            <thead>
                                <th colspan="2" class="bg-primary text-center">
                                    <h3 class="mb-0 text-white">Data Pasien</h3>
                                </th>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>Nama</th>
                                    <td><span id="patient-name">{{ $medical_record->name }}</span></td>
                                </tr>
                                <tr>
                                    <th>Tgl Lahir (umur)</th>
                                    <td><span id="patient-date_birth">{{ $medical_record->birth }}</span></td>
                                </tr>
                                <tr>
                                    <th>Nama Ortu</th>
                                    <td><span id="patient-parent">{{ $medical_record->parent }}</span></td>
                                </tr>
                                <tr>
                                    <th>No HP</th>
                                    <td><span id="patient-phone">{{ $medical_record->med_rec->patient->phone ?? '' }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Provinsi</th>
                                    <td><span
                                            id="patient-provincy">{{ $medical_record->med_rec->patient->provincy ?? '' }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Kabupaten</th>
                                    <td><span id="patient-regency">{{ $medical_record->med_rec->patient->regency ?? '' }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Kecamatan</th>
                                    <td><span
                                            id="patient-district">{{ $medical_record->med_rec->patient->district ?? '' }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Kelurahan</th>
                                    <td><span id="patient-village">{{ $medical_record->med_rec->patient->village ?? '' }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td><span id="patient-address">{{ $medical_record->med_rec->patient->address ?? '' }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Tanggal Pendaftaran</th>
                                    <td><span id="patient-address">Hari {{ $medical_record->created_at->isoFormat('dddd') }} ( {{ $medical_record->created_at ?? '' }} ) </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-12">
                <div class="list-group mt-1">
                    <span href="" class="list-group-item active text-center">Histori Rekam Medis</span>
                    @foreach ($med_recs->sortByDesc('created_at') as $med_rec)
                        <a href="/laporan/{{ $med_rec->id }}" class="list-group-item list-group-item-action">{{ $med_rec->created_at }} ( {{ $med_rec->created_at->isoFormat('dddd') }} )</a>
                    @endforeach
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-warning">Tidak ada data pemberian obat</div>
    @endisset
@endsection
