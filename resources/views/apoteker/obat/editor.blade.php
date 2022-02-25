@extends('layouts.app')

@section('content')
<div class="card mt-4">
    <div class="card-header pb-0 p-3">
      <div class="row">
        <div class="col-6 d-flex align-items-center">
          <h6 class="mb-0">{{ $title }}</h6>
        </div>
        <div class="col-6 text-end">
          <a class="btn bg-gradient-dark mb-0" href="{{ route('obat.index') }}"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Kembali</a>
        </div>
      </div>
    </div>
    <div class="card-body p-3">
        <form action="{{ $action }}" method="post">
            @csrf
            @method($method??'post')
            <div class="row">
                <div class="col-md-6 col-12 mb-4">
                    <div class="input-group input-group-outline">
                        <label for="" class="form-label">Nama</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name',$obat->name??'') }}">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="col-md-6 col-12 mb-4">
                    <div class="input-group input-group-outline">
                        <label for="" class="form-label">Type</label>
                        <input type="text" class="form-control @error('type') is-invalid @enderror" name="type" value="{{ old('type',$obat->type??'') }}">
                        @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="col-md-6 col-12 mb-4">
                    <div class="input-group input-group-outline">
                        <label for="" class="form-label">Satuan</label>
                        <input type="text" class="form-control @error('satuan') is-invalid @enderror" name="satuan" value="{{ old('satuan',$obat->satuan??'') }}">
                        @error('satuan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="col-md-6 col-12 mb-4">
                    <div class="input-group input-group-outline">
                        <label for="" class="form-label">Harga</label>
                        <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price',$obat->price??'') }}">
                        @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>
            <button class="btn btn-primary">Simpan</button>
        </form>
    </div>
  </div>
@endsection
