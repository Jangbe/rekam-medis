@extends('layouts.app')

@section('content')
@if ($patient)
<div class="row">
    @include('dokter.pemeriksaan._form')
    <div class="col-md-6 col-12">
        <small class="text-light fw-semibold">Histori Rekam Medis</small>
        {{-- <div class="accordion mt-3" id="accordionExample">
            @foreach ($patient->patient->med_recs->sortByDesc('created_at') as $med_rec)
                <div class="card accordion-item active">
                    <h2 class="accordion-header" id="headingOne">
                        <button type="button" class="accordion-button" data-bs-toggle="collapse"
                            data-bs-target="#accordion{{ $loop->iteration }}" aria-expanded="true" aria-controls="accordion{{ $loop->iteration }}">
                            {{ $med_rec->created_at }} 
                        </button>
                    </h2>

                    <div id="accordion{{ $loop->iteration }}" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p class="mb-0"><b>Anamnesa : </b>{{ $med_rec->anamnesa??'-' }}</p>
                            <p class="mb-0"><b>Diangnosa : </b>{{ $med_rec->diagnose??'-' }}</p>
                            <p class="mb-0"><b>Theraphy : </b>{{ $med_rec->theraphy??'-' }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div> --}}
        <div class="accordion my-3" id="accordionExample">
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
        {!! $med_recs->links() !!}
    </div>
</div>
@else
<div class="alert alert-warning">Belum Ada Pasien</div>
@endif
@endsection
