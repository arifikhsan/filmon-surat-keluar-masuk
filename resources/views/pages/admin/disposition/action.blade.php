<a class="btn btn-success btn-xs" href="{{ route('dispositions.show', $disposition->id) }}">
  <i class="fa fa-search-plus"></i> &nbsp; Detail
</a>
@if (Auth::user()->role->name == 'Ketua')
<a class="btn btn-primary btn-xs" href="{{ route('dispositions.edit', $disposition->id) }}">
  <i class="fas fa-edit"></i> &nbsp; Ubah
</a>
<form action="{{route('dispositions.destroy', $disposition->id) }}" method="POST"
  onsubmit="return confirm('Anda akan menghapus item ini dari situs anda?')">
  {{ method_field('DELETE') }}
  @csrf
  <button class="btn btn-danger btn-xs">
    <i class="far fa-trash-alt"></i> &nbsp; Hapus
  </button>
</form>
@endif
