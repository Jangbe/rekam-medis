@extends('layouts.app')

@section('content')
    <style>
        .dotted {
            border-bottom: 1px dotted black;
        }

    </style>
    @isset($medical_record)
        <div class="row">
            <div class="col-md-5 col-12">
                <div class="card mb-3">
                    <img class="card-img-top" src="{{ asset('storage/' . $medical_record->med_rec->receipt) }}"
                        alt="Belum Ada Resep Obat" />
                    <hr class="my-0 py-0">
                    <div class="card-body">
                        <h5 class="card-title">{{ $medical_record->name }}</h5>
                        <p class="card-text">
                            <p class="mb-0"><b>Anamnesa : </b> {{ $medical_record->med_rec->anamnesa }}</p>
                            <p class="my-0"><b>Diagnosa : </b> {{ $medical_record->med_rec->diagnose }}</p>
                            <p class="mt-0"><b>Theraphy : </b> {{ $medical_record->med_rec->theraphy }}</p>
                        </p>
                        <p class="card-text">
                            <small class="text-muted">{{ $medical_record->created_at->diffForHumans() }}</small>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-7 col-12">
                <small class="text-light fw-semibold">Histori Rekam Medis</small>
                <div class="accordion mt-3" id="accordionExample">
                    @foreach ($med_recs->sortByDesc('created_at') as $med_rec)
                        <div class="card accordion-item">
                            <h2 class="accordion-header" id="heading{{ $med_rec->id }}">
                                <button type="button" class="accordion-button{{ $loop->first?'':' collapsed' }}" data-bs-toggle="collapse"
                                    data-bs-target="#accordion{{ $loop->iteration }}" aria-expanded="true"
                                    aria-controls="accordion{{ $loop->iteration }}">
                                    {{ $med_rec->created_at }}
                                </button>
                            </h2>
                            <div id="accordion{{ $loop->iteration }}" class="accordion-collapse collapse{{ $loop->first?' show':'' }}"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p class="mb-0"><b>Anamnesa : </b>{{ $med_rec->anamnesa ?? '-' }}</p>
                                    <p class="mb-0"><b>Diangnosa : </b>{{ $med_rec->diagnose ?? '-' }}</p>
                                    <p class="mb-0"><b>Theraphy : </b>{{ $med_rec->theraphy ?? '-' }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-warning">Tidak ada data pemberian obat</div>
    @endisset
@endsection
