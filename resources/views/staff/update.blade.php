<!-- Button trigger modal -->
<button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editUser{{$karyawan->nip}}">
    Update
</button>

<!-- Modal -->
<div class="modal fade" id="editUser{{$karyawan->nip}}" tabindex="-1" aria-labelledby="editUserLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserLabel">Yakin Hapus Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-left">
                <form method="POST" action="{{ route('staff.update', $karyawan->id) }}">
                    @csrf
                    @method('PATCH')
                    <div class="row mb-3">
                        <label for="name" class="col-sm-3 col-form-label">Nama</label>
                        <div class="col-sm-8">
                            <input type="text" name="name" class="form-control" id="createNama" value="{{$karyawan->name}}" readonly >
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="username" class="col-sm-3 col-form-label">Username</label>
                        <div class="col-sm-8">
                            <input type="text" name="username" class="form-control" id="createUsername" value="{{$karyawan->username}}" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-8">
                            <input type="email" name="email" class="form-control" id="createEmail" value="{{$karyawan->email}}" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="nip" class="col-sm-3 col-form-label">NIP</label>
                        <div class="col-sm-8">
                            <input type="text" name="nip" class="form-control" id="createNIP" value="{{$karyawan->nip}}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="salary" class="col-sm-3 col-form-label">Salary</label>
                        <div class="col-sm-8">
                            <input type="number" name="salary" class="form-control" id="createPassword">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Hapus</button>
            </div>
            </form>
        </div>
    </div>
</div>
