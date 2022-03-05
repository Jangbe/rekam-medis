<div>
    <button class="btn btn-sm btn-info" type="button" wire:click="addObat"><i class="fa fa-plus"></i></button>
    @foreach ($obats as $i => $obat)
        <div class="form-group">
            <label for="obat" class="input-group-label">Nama Obat</label>
            <div class="input-group input-group-outline">
                <input type="text" class="form-control" name="obat[{{ $i }}]">
            </div>
        </div>
    @endforeach
</div>
