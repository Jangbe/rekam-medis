<div class="col-md-6 col-12">
    <div class="alert alert-primary">Pemeriksaan {{ $patient->patient->name }} ({{ $patient->patient->age }})</div>
    <form class="card" action="{{ route('pemeriksaan.receipt', $patient) }}" method="POST" id="form-pemeriksaan">
        @csrf
        <input type="hidden" name="type">
        <div class="card-body">
            <h3 id="register" class="text-center">Pemeriksaan</h3>
            <div class="tab" id="outer">
                <div class="form-group pb-3">
                    <label for="">Anamnesa</label>
                    <div class="input-group input-group-outline">
                        <textarea name="anamnesa" id="anamnesa" rows="2" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-4">
                        <label for="">Tinggi Badan</label>
                        <div class="input-group input-group-outline">
                            <input type="number" value="{{ json_decode($patient->physical_check, true)['tb']??'' }}" name="physical_check[tb]" id="physical_check" class="form-control">
                        </div>
                    </div>
                    <div class="col-4">
                        <label for="">Berat Badan</label>
                        <div class="input-group input-group-outline">
                            <input type="number" value="{{ json_decode($patient->physical_check, true)['bb']??'' }}" name="physical_check[bb]" id="physical_check" class="form-control">
                        </div>
                    </div>
                    <div class="col-4">
                        <label for="">Suhu Badan</label>
                        <div class="input-group input-group-outline">
                            <input type="number" value="{{ json_decode($patient->physical_check, true)['suhu']??'' }}" name="physical_check[suhu]" id="physical_check" class="form-control">
                        </div>
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
            <div class="form-check my-2">
                <input class="form-check-input" type="checkbox" name="is_rujukan" id="is_rujukan">
                <label class="form-check-label mb-0 ms-2" for="is_rujukan">Buat Surat Rujukan</label>
            </div>
            <div class="tab" style="display: none" id="surat-rujukan">
                <div class="form-group">
                    <label for="rujukan">Rujukan Kepada</label>
                    <div class="input-group input-group-outline">
                        <textarea disabled name="rujukan[kepada]" id="rujukan" cols="30" rows="3" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <div class="input-group input-group-outline">
                        <textarea disabled name="rujukan[keterangan]" id="keterangan" cols="30" rows="3" class="form-control"></textarea>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end" id="nextprevious">
                <div class="mt-3">
                    <button class="btn btn-success" id="nextBtn">Simpan Data</button>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="modal fade" id="pilih-resep" tabindex="-1" aria-labelledby="pilih-resep-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-surat-rujukan-label">Pilih Tipe Pemeriksaan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex justify-content-between">
                <button class="btn btn-primary" style="width: 48%" id="biasa">Biasa</button>
                <button class="btn btn-info" style="width: 48%" id="canvas">Canvas</button>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        function setRujukan(is_checked){
            $('#rujukan').attr('disabled', !is_checked)
            $('#keterangan').attr('disabled', !is_checked)
            if(is_checked){
                $('#surat-rujukan').fadeIn()
            }else{
                $('#surat-rujukan').fadeOut()
            }
        }
        setRujukan($('#is_rujukan').prop('checked'))
        $('#is_rujukan').on('click', function(){
            let checked = $(this).prop('checked')
            setRujukan(checked)
        })
        $('#nextBtn').on('click', function(e){
            if(!$('#is_rujukan').prop('checked')){
                e.preventDefault()
                $('#pilih-resep').modal('show')
            }
        })
        $('#biasa').on('click', function(){
            $('input[name=type]').val('biasa')
            $('#form-pemeriksaan').submit()
        })
        $('#canvas').on('click', function(){
            $('input[name=type]').val('canvas')
            $('#form-pemeriksaan').submit()
        })
    </script>
@endpush
