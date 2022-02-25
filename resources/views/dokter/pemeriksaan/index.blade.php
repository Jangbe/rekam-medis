@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="alert alert-primary text-white">Pemeriksaan {{ $patient->patient->name }} ({{ $patient->patient->age }})</div>
    </div>
    <div class="col-md-6 col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3 d-flex justify-content-between" style="padding-right: 20px">
                        Anamnesa
                    </h6>
                </div>
            </div>
            <div class="card-body pb-2">
                <div class="form-group">
                    <label for="">Anamnesa</label>
                    <div class="input-group input-group-outline">
                        <textarea name="anamnesa" id="anamnesa" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Pemeriksaan Fisik</label>
                    <div class="input-group input-group-outline">
                        <textarea name="physical_check" id="physical_check" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Diagnosa</label>
                    <div class="input-group input-group-outline">
                        <textarea name="diagnosa" id="diagnosa" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Therapie</label>
                    <div class="input-group input-group-outline">
                        <textarea name="therapie" id="therapie" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                </div>
                <button class="btn btn-primary mt-3">Simpan</button>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3 d-flex justify-content-between" style="padding-right: 20px">
                        Pemeriksaan Fisik
                    </h6>
                </div>
            </div>
            <div class="card-body pb-2">
                <div class="form-group">
                    <label for="">Anamnesa</label>
                    <div class="input-group input-group-outline">
                        <textarea name="anamnesa" id="anamnesa" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Pemeriksaan Fisik</label>
                    <div class="input-group input-group-outline">
                        <textarea name="physical_check" id="physical_check" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Diagnosa</label>
                    <div class="input-group input-group-outline">
                        <textarea name="diagnosa" id="diagnosa" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Therapie</label>
                    <div class="input-group input-group-outline">
                        <textarea name="therapie" id="therapie" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                </div>
                <button class="btn btn-primary mt-3">Simpan</button>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3 d-flex justify-content-between" style="padding-right: 20px">
                        Diagnosa & Therapie
                    </h6>
                </div>
            </div>
            <div class="card-body pb-2">
                <div class="form-group">
                    <label for="">Anamnesa</label>
                    <div class="input-group input-group-outline">
                        <textarea name="anamnesa" id="anamnesa" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Pemeriksaan Fisik</label>
                    <div class="input-group input-group-outline">
                        <textarea name="physical_check" id="physical_check" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Diagnosa</label>
                    <div class="input-group input-group-outline">
                        <textarea name="diagnosa" id="diagnosa" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Therapie</label>
                    <div class="input-group input-group-outline">
                        <textarea name="therapie" id="therapie" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                </div>
                <button class="btn btn-primary mt-3">Simpan</button>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3 d-flex justify-content-between" style="padding-right: 20px">
                        Resep Obat
                    </h6>
                </div>
            </div>
            <div class="card-body pb-2">
                <div class="form-group">
                    <label for="">Anamnesa</label>
                    <div class="input-group input-group-outline">
                        <textarea name="anamnesa" id="anamnesa" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Pemeriksaan Fisik</label>
                    <div class="input-group input-group-outline">
                        <textarea name="physical_check" id="physical_check" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Diagnosa</label>
                    <div class="input-group input-group-outline">
                        <textarea name="diagnosa" id="diagnosa" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Therapie</label>
                    <div class="input-group input-group-outline">
                        <textarea name="therapie" id="therapie" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                </div>
                <button class="btn btn-primary mt-3">Simpan</button>
            </div>
        </div>
    </div>
</div>
@endsection
