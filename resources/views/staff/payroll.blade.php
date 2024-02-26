<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#payrollUser{{ $karyawan->nip }}">
    Payroll
</button>


<!-- Modal -->
<div class="modal fade" id="payrollUser{{ $karyawan->nip }}" tabindex="-1" aria-labelledby="editUserLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserLabel">Yakin Hapus Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-left">
                <form method="POST" action="{{ route('staff.payroll') }}">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="nip_pegawai" class="form-control" id="createNipPegawai"
                        value="{{ $karyawan->nip }}" placeholder="Jumlah Hari">
                    <div class="row mb-3">
                        <label for="name" class="col-sm-3 col-form-label">Tidak masuk (0.5%/hari)</label>
                        <div class="col-sm-4">
                            <input type="number" name="tidak_masuk" class="form-control" id="createTidakMasuk"
                                placeholder="Jumlah Hari">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="name" class="col-sm-3 col-form-label">Terlambat (0.1%/hari)</label>
                        <div class="col-sm-4">
                            <input type="number" name="telat" class="form-control" id="createTidakMasuk"
                                placeholder="Jumlah Hari">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="pph" class="col-sm-3 col-form-label">PPh 21</label>
                        <div class="col-sm-8">
                            <input type="number" name="pph" class="form-control" id="createPph"
                                placeholder="Jumlah Potongan PPh">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">BAYAR</button>
            </div>
            </form>
        </div>
    </div>
</div>
