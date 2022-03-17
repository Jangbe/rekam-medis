<button onclick="stock({{ $o }})" class="btn btn-sm btn-dark text-info mb-0 font-weight-bold text-xs mr-3">Stok Obat</button>
<a href="#" onclick="edit({{ $o }})" class="btn btn-sm btn-dark text-warning mb-0 font-weight-bold text-xs mr-3" data-toggle="tooltip" data-original-title="Edit user">
    Edit
</a>
<form action="{{ route('obat.destroy', $o) }}" method="post" class="d-inline">
    @csrf
    @method('delete')
    <button class="btn btn-sm btn-dark delete-data text-danger mb-0 font-weight-bold text-xs" data-ajax="true" data-toggle="tooltip" data-original-title="Edit user">
        Delete
    </button>
</form>
