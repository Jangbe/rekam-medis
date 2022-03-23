@extends('layouts.app')

@section('content')
@if ($patient)
<div class="row">
    @include('dokter.pemeriksaan._form')
    <div class="col-md-6 col-12">
        <div class="alert alert-primary">Riwayat Pemeriksaan</div>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <th>Tgl</th>
                            <th>Anamnesa</th>
                            <th>Diagnosa</th>
                            <th>Theraphy</th>
                        </thead>
                        @foreach ($patient->patient->med_recs as $med_rec)
                            <tr>
                                <td>{{ $med_rec->created_at }}</td>
                                <td>{{ $med_rec->anamnesa }}</td>
                                <td>{{ $med_rec->diagnose }}</td>
                                <td>{{ $med_rec->theraphy }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="alert alert-warning">Belum Ada Pasien</div>
@endif
@endsection
