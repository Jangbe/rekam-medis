@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h3 class="card-title my-auto"> Data Pendaftaran Hari Ini </h3>
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
                            @if (auth()->user()->role == 'pegawai')
                            <th class="bg-primary text-white opacity-7"></th>
                            @endif
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
                            @if (auth()->user()->role == 'pegawai')
                            <td>
                                    @if ($med_rec->rujukan)
                                        <a target="_blank" href="{{ route('med-rec.surat-rujukan', $med_rec) }}">Print
                                            Rujukan</a> |
                                    @endif
                                    <a data-detail="{{ $med_rec }}" class="surat_sakit" href="#">Surat Sakit</a>
                                </td>
                            </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-surat-sakit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="post" id="form-surat-sakit" target="_blank">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Buat / Print Surat Sakit</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="">Pekerjaan</label>
                            <div class="input-group input-group-outline"><input type="text" name="pekerjaan"
                                    class="form-control"></div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="">Berapa Hari</label>
                                    <div class="input-group input-group-outline"><input type="number" min="0" name="hari"
                                            class="form-control"></div>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="form-group">
                                    <label for="">Dari Tanggal</label>
                                    <div class="input-group input-group-outline"><input type="date" name="tanggal"
                                            class="form-control"></div>
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
@endsection

@push('js')
    <script>
        var table = $('#table-patient').DataTable({
            sort: false,
            "language": {
                "oPaginate": {
                    "sFirst": ("First"),
                    "sLast": ("Last"),
                    "sPrevious": (`<i class="tf-icon bx bx-chevrons-left"></i>`),
                    "sNext": (`<i class="tf-icon bx bx-chevrons-right"></i>`)
                },
            }
        })
        $('.surat_sakit').on('click', function(e) {
            let data = $(this).data('detail')
            e.preventDefault()
            $('#form-surat-sakit').attr('action', `/pegawai/medical-records/${data.id}/surat-sakit`)
            $('#modal-surat-sakit').modal('toggle')
        })
    </script>
@endpush
