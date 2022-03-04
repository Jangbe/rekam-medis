@extends('layouts.app')

@section('content')
@if ($patient)
<div class="row d-flex justify-content-center">
    <div class="col-12 col-md-8">
        <div class="alert alert-primary text-white">Pemeriksaan {{ $patient->patient->name }} ({{ $patient->patient->age }})</div>
    </div>
    @include('dokter.pemeriksaan._form')
</div>
@else
<div class="alert alert-warning text-white">Belum Ada Pasien</div>
@endif
@endsection
