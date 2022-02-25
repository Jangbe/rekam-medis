@extends('layouts.app')

@section('content')
<div class="card mt-4">
    <div class="card-header pb-0 p-3">
      <div class="row">
        <div class="col-6 d-flex align-items-center">
          <h6 class="mb-0">{{ $title }}</h6>
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
            <x-form-patient :patient="$patient"/>
            <button class="btn btn-primary">Simpan</button>
        </form>
    </div>
  </div>
@endsection
