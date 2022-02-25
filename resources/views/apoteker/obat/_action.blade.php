<a href="#" onclick="edit({{ $o }})" class="btn btn-sm btn-dark text-warning font-weight-bold text-xs mr-3" data-toggle="tooltip" data-original-title="Edit user">
    Edit
</a>
<form action="{{ route('obat.destroy', $o) }}" method="post" class="d-inline">
    @csrf
    @method('delete')
    <button class="btn btn-sm btn-dark text-danger font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
        Delete
    </button>
</form>
