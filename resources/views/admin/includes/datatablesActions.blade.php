
<a class="btn btn-sm btn-info" href="{{ route('admin.' . $crudRoutePart . '.show', $row->id) }}" title="View"><i class="fas fa-eye"></i></a>


<a class="btn btn-sm btn-primary" href="{{ route('admin.' . $crudRoutePart . '.edit', $row->id) }}" title="Edit"><i class="fas fa-edit"></i></a>


<form action="{{ route('admin.' . $crudRoutePart . '.destroy', $row->id) }}" method="POST" style="display:inline-block;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-danger delete-confirmation" title="Delete"><i class="fas fa-trash"></i></button>
</form>
