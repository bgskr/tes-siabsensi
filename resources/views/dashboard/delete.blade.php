<!-- Button trigger modal -->
<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteUser{{$user->id}}">
    Hapus
</button>

<!-- Modal -->
<div class="modal fade" id="deleteUser{{$user->id}}" tabindex="-1" aria-labelledby="deleteUserLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteUserLabel">Yakin Hapus Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('auth.delete', $user->id) }}">
                    @csrf
                    {{ method_field('DELETE') }}
                    <h1>Apakah Anda Yakin ingin menghapus User ini?</h1>
                    {{-- <input type="hidden" name="" value="{{$user->id}}"> --}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Hapus</button>
            </div>
            </form>
        </div>
    </div>
</div>
