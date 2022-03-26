@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h3 class="card-title my-auto"> Data Pasien </h3>
            @if (auth()->user()->role == 'pegawai')
                <a class="btn btn-success mb-0 pr-3" href="{{ route('medical-records.create') }}">
                    <i class="fa fa-circle-plus" style="margin-right: 5px"></i> Tambah
                </a>
            @endif
        </div>
        <hr class="my-0">
        <div class="card-body pb-2">
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0 table-striped" id="table-patient">
                    <thead>
                        <tr>
                            <th class="bg-primary text-uppercase text-white text-sm font-weight-bolder opacity-7">NO Urut</th>
                            <th class="bg-primary text-uppercase text-white text-sm font-weight-bolder opacity-7">NO RM</th>
                            <th class="bg-primary text-uppercase text-white text-sm font-weight-bolder opacity-7 ps-2">Nama</th>
                            <th class="bg-primary text-center text-uppercase text-white text-sm font-weight-bolder opacity-7">Tgl
                                Lahir</th>
                            <th class="bg-primary text-center text-uppercase text-white text-sm font-weight-bolder opacity-7">Ortu
                            </th>
                            <th class="bg-primary text-white opacity-7"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($med_recs->sortBy('order') as $med_rec)
                            <tr>
                                <td>{{ $med_rec->order }}</td>
                                <td>{{ $med_rec->patient->no_rm }}</td>
                                <td>{{ $med_rec->patient->name }}</td>
                                <td>{{ $med_rec->patient->date_birth }}</td>
                                <td>{{ $med_rec->patient->parent }}</td>
                                <td>
                                    <a class="surat_sakit" href="{{ route('pemeriksaan.show', $med_rec) }}">Periksa</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        var table = $('#table-patient').DataTable({
            sort: false,
            "language":{
                "oPaginate": {
                    "sFirst":    ("First"),
                    "sLast":     ("Last"),
                    "sPrevious":     (`<i class="tf-icon bx bx-chevrons-left"></i>`),
                    "sNext": (`<i class="tf-icon bx bx-chevrons-right"></i>`)
                },
            }
        })
    </script>
@endpush
