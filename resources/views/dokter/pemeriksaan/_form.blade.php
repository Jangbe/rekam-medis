<div class="col-md-8 col-12">
    <form class="card" action="{{ url('dokter/pemeriksaan') }}" method="POST">
        @csrf
        <div class="card-body">
            <h3 id="register" class="text-center">Pemeriksaan</h3>
            <div class="tab" id="outer">
                <div class="form-group pb-3">
                    <label for="">Anamnesa</label>
                    <div class="input-group input-group-outline">
                        <textarea name="anamnesa[keluhan]" id="anamnesa" rows="2" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Pemeriksaan Fisik</label>
                    <div class="input-group input-group-outline">
                        <textarea name="physical_check" id="physical_check" rows="5" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Diagnosa</label>
                    <div class="input-group input-group-outline">
                        <textarea name="diagnose" id="diagnose" rows="5" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Theraphy</label>
                    <div class="input-group input-group-outline">
                        <textarea name="theraphy" id="theraphy" rows="5" class="form-control"></textarea>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end" id="nextprevious">
                <div class="mt-3">
                    <button class="btn btn-success" id="nextBtn">Resep Obat</button>
                </div>
            </div>
        </div>
    </form>
</div>
