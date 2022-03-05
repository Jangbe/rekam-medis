@extends('layouts.app')

@section('content')
<div class="card my-4">
    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
      <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
        <h6 class="text-white text-capitalize ps-3 d-flex justify-content-between" style="padding-right: 20px">
            Data Pasien
            <a class="btn btn-sm btn-success mb-0 pr-3" href="{{ route('medical-records.create') }}">
                <i class="fa fa-circle-plus" style="margin-right: 5px"></i> Tambah
            </a>
        </h6>
      </div>
    </div>
    <div class="card-body pb-2">
      <div class="table-responsive p-0">
        <table class="table align-items-center mb-0 table-striped" id="table-patient">
          <thead>
            <tr>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NO Urut</th>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NO RM</th>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama</th>
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tgl Lahir</th>
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ortu</th>
              {{-- <th class="text-secondary opacity-7"></th> --}}
            </tr>
          </thead>
          <tbody>
            @foreach ($med_recs as $med_rec)
                <tr>
                    <td>{{ $med_rec->order }}</td>
                    <td>{{ $med_rec->patient->no_rm }}</td>
                    <td>{{ $med_rec->patient->name }}</td>
                    <td>{{ $med_rec->patient->date_birth }}</td>
                    <td>{{ $med_rec->patient->parent }}</td>
                </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

@endsection

@push('js')
    <script>$('#table-patient').DataTable({sort:false})</script>
@endpush
