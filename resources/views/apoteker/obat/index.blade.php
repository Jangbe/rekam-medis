@extends('layouts.app')

@section('content')
<div class="card my-4">
    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
      <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
        <h6 class="text-white text-capitalize ps-3 d-flex justify-content-between" style="padding-right: 20px">
            Data Obat
            <a class="btn btn-sm btn-success mb-0 pr-3" onclick="create()">
                <i class="fa fa-circle-plus" style="margin-right: 5px"></i> Tambah
            </a>
        </h6>
      </div>
    </div>
    <div class="card-body pb-2">
      <div class="table-responsive p-0">
        <table class="table align-items-center mb-0" id="table-obat">
          <thead>
            <tr>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Type</th>
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Satuan</th>
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Harga</th>
              <th class="text-secondary opacity-7"></th>
            </tr>
          </thead>
          <tbody>
              {{-- @foreach ($obats as $o)
                <tr>
                    <td>

                    </td>
                    <td>

                    </td>
                    <td class="align-middle text-center text-sm">

                    </td>
                    <td class="align-middle text-center">

                    </td>
                    <td class="align-middle">

                    </td>
                </tr>
              @endforeach --}}
          </tbody>
        </table>
      </div>
    </div>
  </div>

  @include('apoteker.obat.modal')
@endsection

@push('js')
    <script>
        var table = $('#table-obat').DataTable({
            "processing": true,
            "serverSide": true,
            "sort":false,
            "ajax": "/apoteker/obat/ajax",
            "columns": [
                {"data":"name"},
                {"data":"type"},
                {"data":"satuan"},
                {"data":"price"},
                {"data":"action","searchable":false},
            ]
        });
        function create(){
            $('#title').html('Tambah Data Obat');
            ['name','type','satuan','price'].forEach(v => {
                $('input[name='+v+']').val('')
            })
            $('#modal-obat').modal('toggle')
        }
        function edit(data){
            $('#title').html('Edit Obat '+data.name);
            for(var i in data){
                $('input[name='+i+']').val(data[i]).focus()
            }
            $('#modal-obat').modal('toggle')
        }
        function store(){

        }
    </script>
@endpush
