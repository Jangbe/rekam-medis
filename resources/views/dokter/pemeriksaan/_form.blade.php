<div class="col-md-6 col-12">
    <div class="alert alert-primary">Pemeriksaan {{ $patient->patient->name }} ({{ $patient->patient->age }})</div>
    <form class="card" action="{{ route('pemeriksaan.receipt', $patient) }}" method="POST" id="form-pemeriksaan">
        @csrf
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
            <div class="d-flex justify-content-end" id="nextprevious">
                <div class="mt-3">
                    <button class="btn btn-warning" type="button" id="surat-rujukan">Surat Rujukan</button>
                    <button class="btn btn-success" id="nextBtn">Resep Obat</button>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="modal fade" id="modal-surat-rujukan" tabindex="-1" aria-labelledby="modal-surat-rujukan-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="post">
                @csrf
                <input type="hidden" name="anamnesa" id="m_anamnesa">
                <input type="hidden" name="physical_check[tb]" id="m_physical_check_tb">
                <input type="hidden" name="physical_check[bb]" id="m_physical_check_bb">
                <input type="hidden" name="physical_check[suhu]" id="m_physical_check_suhu">
                <input type="hidden" name="diagnose" id="m_diagnose">
                <input type="hidden" name="theraphy" id="m_theraphy">
                <input type="hidden" name="is_rujukan" value="1">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-surat-rujukan-label">Buat Surat Rujukan Untuk {{ $patient->patient->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="rujukan">Rujukan Kepada</label>
                        <div class="input-group input-group-outline">
                            <textarea name="rujukan[kepada]" id="rujukan" cols="30" rows="3" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <div class="input-group input-group-outline">
                            <textarea name="rujukan[keterangan]" id="keterangan" cols="30" rows="3" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button id="btn-surat-rujukan" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('js')
    <script>
        $('#surat-rujukan').on('click', function(){
            let data = $('#form-pemeriksaan').serializeArray()
            data.forEach(v => {
                let idx = v.name.replace('[', '_').replace(']', '');
                $('#modal-surat-rujukan').find(`#m_${idx}`).val(v.value)
            })
            // console.log(data);
            $('#modal-surat-rujukan').modal('toggle')
        })
        $('#btn-surat-rujukan').on('click', function(){
            let data = $('#form-pemeriksaan').serializeArray()
            data.push({
                name: 'rujukan',
                value: $('#rujukan').val()
            })
            data.push({
                name: 'keterangan',
                value: $('#keterangan').val()
            })
            data.push({
                name: 'is_rujukan',
                value: true
            })
            $.ajax({
                url: '/dokter/pemeriksaan',
                method: 'post',
                data,
                success: (result)=>{
                    console.log(e);
                },
                error: (e)=>{
                    console.log(e);
                }
            })
        })
    </script>
@endpush
