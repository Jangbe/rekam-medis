@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h6 class="card-title my-auto" style="padding-right: 20px">
            Data Obat
        </h6>
        <a class="btn btn-success text-white mb-0 pr-3" onclick="create()">
            <i class="fa fa-circle-plus" style="margin-right: 5px"></i> Tambah
        </a>
    </div>
    <hr class="my-auto">
    <div class="card-body pb-2">
      <div class="table-responsive p-0">
        <table class="table align-items-center table-striped mb-0" id="table-obat">
          <thead>
            <tr>
              <th class="bg-primary text-uppercase text-white text-xxs font-weight-bolder opacity-7">Nama</th>
              <th class="bg-primary text-uppercase text-white text-xxs font-weight-bolder opacity-7 ps-2">Sediaan Obat</th>
              <th class="bg-primary text-center text-uppercase text-white text-xxs font-weight-bolder opacity-7">Harga</th>
              <th class="bg-primary text-center text-uppercase text-white text-xxs font-weight-bolder opacity-7">Stok</th>
              <th class="bg-primary text-white opacity-7 text-center">Aksi</th>
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
                {"data":"price", 'className':'text-center'},
                {"data":"stock", 'className':'text-center'},
                {"data":"action","searchable":false, "className":"w-20 text-center"},
            ],
            "language":{
                "oPaginate": {
                    "sFirst":    ("First"),
                    "sLast":     ("Last"),
                    "sPrevious":     (`<i class="tf-icon bx bx-chevrons-left"></i>`),
                    "sNext": (`<i class="tf-icon bx bx-chevrons-right"></i>`)
                },
            }
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
                    // Toast.fire({
                    //     icon:'success',
                    //     title
                    // })
                    showToast(title)
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
                    // Toast.fire({
                    //     icon: 'success',
                    //     title: result
                    // })
                    showToast(result)
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
