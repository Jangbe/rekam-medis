@extends('layouts.app')

@section('content')
<style>
    .datepicker-container {
      z-index: 1600 !important; /* has to be larger than 1050 */
    }
</style>
    <div class="row">
        <div class="col-12">
            @if ($errors->any())
            <div class="alert alert-warning mb-5">Ada field yang belum diisi</div>
            @endif
            <div class="card my-4">
                <div class="card-header">
                    <form action="{{ route('med-rec.export') }}" method="post" id="form" target="_blank" class="d-flex justify-content-between">
                        @csrf
                        @method('put')
                        <h6 class="card-title my-auto d-inline" style="padding-right: 20px"> Laporan Data Rekam Medis </h6>
                        <div class="w-50 d-flex">
                            <div class="form-check w-50 my-auto">
                                <input class="form-check-input" type="checkbox" name="printAll" id="showAll">
                                <label class="form-check-label mb-0 ms-2" for="showAll">Lihat Semua</label>
                            </div>
                            <div class="form-group w-50">
                                <div class="input-group input-group-outline">
                                    <input type="text" data-toggle="daterangepicker" name="dates" class="form-control filter">
                                </div>
                            </div>
                        </div>
                        <div class="my-auto">
                            <button class="btn btn-success mb-0 pr-3" name="pdf" id="export-pdf"><i class="fa fa-file-pdf"></i> Print
                                PDF</button>
                            <button class="btn btn-success mb-0 pr-3" name="excel" id="export-excel"><i class="fa fa-file-excel"></i> Print
                                Excel</button>
                        </div>
                    </form>
                </div>
                <hr class="my-auto">
                <div class="card-body pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="table-laporan">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Nama</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Tanggal Lahir
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Ortu</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-export" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="post" id="form" target="_blank">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><span id="title"></span></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-5 my-auto">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" name="printAll" id="printAll">
                                    <label class="form-check-label mb-0 ms-2" for="printAll">Print Semua</label>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="form-group">
                                    <div class="input-group input-group-outline">
                                        <input type="text" data-toggle="daterangepicker" class="form-control" name="dateExport" id="dateExport">
                                    </div>
                                    @error('startAt')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
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
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script>
        var table = $('#table-laporan').DataTable({
            "processing": true,
            "serverSide": true,
            "bSort" : false,
            "ajax": {
                url: "",
                data: function(data){
                    data.dates = $('input[name=dates]').val();
                }
            },
            // orderCellsTop: true,
            fixedHeader: false,
            "columns": [
                {data:"created_at"},
                {data:"name"},
                {data:"birth"},
                {data:"parent", className: 'align-middle text-center text-sm'},
            ],
            "language":{
                "oPaginate": {
                    "sFirst":    ("First"),
                    "sLast":     ("Last"),
                    "sPrevious":     (`<i class="tf-icon bx bx-chevrons-left"></i>`),
                    "sNext": (`<i class="tf-icon bx bx-chevrons-right"></i>`)
                },
            }
        })

        $('#showAll').on('click', function(){
            let checked = $(this).prop('checked');
            if(checked){
                $('.filter').val('')
            }
            $('.filter').attr('disabled', checked)
            table.draw()
        })

        $('.filter').on('change', function(){
            table.draw()
        })

        $('#printAll').on('change', function(){
            let printAll = $(this).prop('checked');
            if(printAll){
                $('#dateExport').val('')
            }
            $('#dateExport').attr('disabled', printAll);
        })
        // $('#export-pdf').on('click', function(){
        //     $('#form').attr('action', '/pegawai/medical-records/laporan/pdf')
        //     $('#title').text('Export Ke PDF');
        //     $('#modal-export').modal('toggle')
        // })
        // $('#export-excel').on('click', function(){
        //     $('#form').attr('action', '/pegawai/medical-records/laporan/excel')
        //     $('#title').text('Export Ke Excel');
        //     $('#modal-export').modal('toggle')
        // })
    </script>
@endpush
