
<form action="{{route('absensi.create')}}" method="post">
    @csrf
    @method('POST')
    <div class="row" style="width: 100%;">
            <input type="hidden" name="id_karyawan" value="{{auth()->user()->nip}}">
        <div class="col col-3">
            <input name="tanggal_masuk" id="tglMasuk" type="date" class="form-control" placeholder="First name" aria-label="First name">
        </div>
        <div class="col col-2">
            <select name="keterangan" class="form-select" aria-label="Default select example">
                <option selected>Keterangan</option>
                <option value="Masuk">Masuk</option>
                <option value="Izin">Izin</option>
                <option value="Tanpa_keterangan">Tanpa Keterangan</option>
            </select>
        </div>
        @if (auth()->user()->nip == '')
        <div class="col col-2">
            <button type="submit" class="btn btn-primary" disabled>Submit</button>
        </div>
        @else
        <div class="col col-2">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        @endif
    </div>
</form>

<script>
    const picker = document.getElementById('tglMasuk');
    picker.addEventListener('input', function(e) {
        let day = new Date(this.value).getUTCDay();
        if([6,0].includes(day)) {
            e.preventDefault();
            this.value = '';
            alert('Weekend not Allowed!');
        }
    });
</script>
