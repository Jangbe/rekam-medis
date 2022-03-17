@extends('layouts.app')

@section('content')
<div class="card mt-4">
    <div class="card-header pb-0 p-3">
      <div class="row">
        <div class="col-6 d-flex align-items-center">
          <h6 class="mb-0">Pendaftaran Pasien</h6>
        </div>
        <div class="col-6 text-end">
          <a class="btn bg-gradient-dark mb-0" href="{{ route('patients.index') }}"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Kembali</a>
        </div>
      </div>
    </div>
    <div class="card-body p-3">
        <form action="{{ $action }}" method="post">
            @csrf
            @method($method??'post')
            <div class="row d-flex justify-content-center">
                <div class="col-4">
                    <label for="" class="d-block" style="margin-bottom: 13px">Status Pasien</label>
                    <div class="text-center" style="border: 1px solid rgb(210, 214, 218); padding-top: 5px;border-radius: 5px">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" checked id="inlineRadio1" value="baru">
                            <label class="form-check-label mb-1" for="inlineRadio1">Baru</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="lama">
                            <label class="form-check-label mb-1" for="inlineRadio2">Lama</label>
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <label for="" class="form-label">No Urut</label>
                    <div class="input-group input-group-outline">
                        <input type="text" class="form-control" name="order" readonly value="{{ $order }}">
                    </div>
                </div>
            </div>
            <div id="data-lama" style="display: none">
                <hr>
                <h4 class="text-center">Data Pasien Lama</h4>
                <div class="row" >
                    <div class="col-md-6 col-12 mb-4">
                        <label for="" class="form-label">Nama</label>
                        <div class="input-group input-group-outline">
                            <select class="form-control select2 old_patient @error('patient_id') is-invalid @enderror" name="patient_id">
                                <option value="">---Pilih Berdasarkan No RM---</option>
                                @foreach ($patients as $patient)
                                    <option value="{{ $patient->id }}" data-patient="{{ $patient }}">{{ $patient->no_rm }}</option>
                                @endforeach
                            </select>
                            @error('patient_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-12 mb-4">
                        <label for="" class="form-label">Nama</label>
                        <div class="input-group input-group-outline">
                            <select class="form-control select2 old_patient @error('patient_id') is-invalid @enderror" name="patient_id">
                                <option value="">---Pilih Berdasarkan Nama---</option>
                                @foreach ($patients as $patient)
                                    <option value="{{ $patient->id }}" data-patient="{{ $patient }}">{{ $patient->name }}</option>
                                @endforeach
                            </select>
                            @error('patient_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-primary">
                    <thead>
                        <th colspan="2" class="text-center">Data Pasien</th>
                    </thead>
                    <tbody>
                        <tr>
                            <th>Nama</th>
                            <td><span id="patient-name"></span></td>
                        </tr>
                        <tr>
                            <th>Tgl Lahir (umur)</th>
                            <td><span id="patient-date_birth"></span></td>
                        </tr>
                        <tr>
                            <th>Nama Ortu</th>
                            <td><span id="patient-parent"></span></td>
                        </tr>
                        <tr>
                            <th>No HP</th>
                            <td><span id="patient-phone"></span></td>
                        </tr>
                        <tr>
                            <th>Provinsi</th>
                            <td><span id="patient-provincy"></span></td>
                        </tr>
                        <tr>
                            <th>Kabupaten</th>
                            <td><span id="patient-regency"></span></td>
                        </tr>
                        <tr>
                            <th>Kecamatan</th>
                            <td><span id="patient-district"></span></td>
                        </tr>
                        <tr>
                            <th>Kelurahan</th>
                            <td><span id="patient-village"></span></td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td><span id="patient-address"></span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div id="data-baru">
                <hr>
                <h4 class="text-center">Data Pasien Baru</h4>
                <x-form-patient id="patient"/>
            </div>
            <hr class="my-2">
            <div class="form-group row mb-3">
                <div class="col-4">
                    <label for="">Tinggi Badan</label>
                    <div class="input-group input-group-outline">
                        <input type="number" name="physical_check[tb]" id="physical_check" class="form-control">
                    </div>
                </div>
                <div class="col-4">
                    <label for="">Berat Badan</label>
                    <div class="input-group input-group-outline">
                        <input type="number" name="physical_check[bb]" id="physical_check" class="form-control">
                    </div>
                </div>
                <div class="col-4">
                    <label for="">Suhu Badan</label>
                    <div class="input-group input-group-outline">
                        <input type="number" name="physical_check[suhu]" id="physical_check" class="form-control">
                    </div>
                </div>
            </div>
            <button class="btn btn-primary">Simpan</button>
        </form>
    </div>
  </div>
@endsection

@push('js')
    <script>
        $('input[name=status]').on('change', function(){
            if($(this).val()=='baru'){
                $('#data-lama').fadeOut()
                $('#data-baru').fadeIn();
            }else{
                $('#data-baru').fadeOut()
                $('#data-lama').fadeIn();
            }
        })
        $('.old_patient').on('select2:select', function(){
            $('.select2').val($(this).val()).trigger('change')
            let patient = $(this).find(':selected').data('patient')
            if(patient){
                for(let i in patient){
                    $('#patient-'+i).text(patient[i])
                }
            }
        })
    </script>
@endpush
