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
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Sediaan Obat</th>
              {{-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Type</th>
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Satuan</th> --}}
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Harga</th>
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Stok</th>
              <th class="text-secondary opacity-7 text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>

          </tbody>
        </table>
      </div>
    </div>
  </div>

  @include('apoteker.obat.modal')
  @include('apoteker.obat._modal-stock')
@endsection

@push('js')
    <script>
        var table = $('#table-obat').DataTable({
            "processing": true,
            "serverSide": true,
            "sort":false,
            "ajax": "/apoteker/obat/ajax",
            "columns": [
                {"data":"name", 'className':'text-center'},
                {"data":"unit", 'className':'text-center'},
                // {"data":"type", 'className':'text-center'},
                // {"data":"satuan", 'className':'text-center'},
                {"data":"price", 'className':'text-center'},
                {"data":"stock", 'className':'text-center'},
                {"data":"action","searchable":false, "className":"w-20"},
            ]
        });
        function create(){
            $('#title').html('Tambah Data Obat');
            $('#form').attr('action', '/apoteker/obat');
            ['name','type','satuan','price'].forEach(v => {
                $('input[name='+v+'],select[name='+v+']').val('')
            })
            $('#modal-obat').modal('toggle')
        }
        function edit(data){
            $('#title').html('Edit Obat '+data.name);
            $('#form').attr('action', '/apoteker/obat/'+data.id);
            for(var i in data){
                $('input[name='+i+'],select[name='+i+']').val(data[i])
            }
            $('input[name=price]').val(number_format(data.price))
            $('#modal-obat').modal('toggle')
        }
        function stock(data){
            $('#form-stock').attr('action', `/apoteker/update-stok-obat/${data.id}`);
            $('#title-stock').text(`Stok Obat ${data.name} (Sisa Stok: ${data.stock})`);
            $('#modal-stock').modal('toggle');
        }
        $('#form-stock').on('submit', function(e){
            e.preventDefault()
            let url = $(this).attr('action');
            $.ajax({
                url,
                method: 'post',
                data: $(this).serializeArray(),
                success: (title) => {
                    Toast.fire({
                        icon:'success',
                        title
                    })
                    table.draw()
                    $('#modal-stock').modal('toggle')
                }
            })
        })
        $('#form').on('submit', function(e){
            e.preventDefault()
            let url = $(this).attr('action');
            let data = $(this).serializeArray();
            data.push({name: '_method',value:url=='/apoteker/obat'?'post':'put'})
            $.ajax({
                url,
                method: 'post',
                data,
                success: (result)=>{
                    Toast.fire({
                        icon: 'success',
                        title: result
                    })
                    table.draw()
                    $('#modal-obat').modal('toggle')
                },error: ({responseJSON})=>{
                    $('.is-invalid').removeClass('is-invalid');
                    let errors = responseJSON.errors
                    for(let i in errors){
                        $(`input[name=${i}]`).addClass('is-invalid').parent().append(
                            `<div class="invalid-feedback">${errors[i][0]}</div>`
                        )
                        console.log(errors[i]);
                    }
                }
            })
        })
    </script>
@endpush
