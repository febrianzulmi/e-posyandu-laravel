<form
    action="{{ isset($perkembangan_anak) ? route('perkembangan-anak.update', $perkembangan_anak->id) : route('perkembangan-anak.store') }}"
    method="POST">
    @csrf

    @if (isset($perkembangan_anak))
        @method('PUT')
    @endif
    <!-- Tambahkan elemen notifikasi -->

    <div class="row {{ session('error') ? 'mt-4' : '' }} justify-content-center">
        <div class="col-lg-7">
            <div id="notification" style="display: none;" class="alert alert-info" role="alert">
                Data berhasil diperbarui!
            </div>
            <div class="card rounded-0">
                <div class="card-header py-3">
                    <h6 class="card-title mb-0 font-weight-bold">Data Perkembangan Anak</h6>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <label for="anak_id" class="font-size-14 form-label">Anak <span
                                    class="text-danger">*</span></label>
                            <select type="text" class="form-select font-size-14 rounded-0" name="anak_id"
                                id="anak_id" required>
                                <option value="">Pilih Anak</option>
                                @foreach ($anak as $a)
                                    <option
                                        {{ (isset($perkembangan_anak) && $perkembangan_anak->anak_id == $a->id) || old('anak_id') == $a->id ? 'selected' : '' }}
                                        value="{{ $a->id }}">{{ $a->nama }} ({{ $a->jk }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-12">
                            <label for="tgl_pemeriksaan" class="font-size-14 form-label">Tanggal Pemeriksaan <span
                                    class="text-danger">*</span></label>
                            <input type="date" class="form-control font-size-14 rounded-0" name="tgl_pemeriksaan"
                                id="tgl_pemeriksaan"
                                value="{{ isset($perkembangan_anak) ? $perkembangan_anak->tgl_pemeriksaan->format('Y-m-d') : date('Y-m-d') }}"
                                required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label for="bb" class="font-size-14 form-label">Berat Badan <span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" step="any" class="form-control font-size-14 rounded-0"
                                    name="bb" id="bb" value="" required>
                                <span class="input-group-text rounded-0" id="basic-addon2">KG</span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <label for="uid" class="font-size-14 form-label">UID<span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" step="any" class="form-control font-size-14 rounded-0"
                                    name="uid" id="nokartu" value=""required>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <label for="tinggi" class="font-size-14 form-label">Tinggi Badan <span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" step="any" class="form-control font-size-14 rounded-0"
                                    name="tb" id="tinggi" value="" required>
                                <span class="input-group-text rounded-0" id="basic-addon2">CM</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label for="suhu" class="font-size-14 form-label">Suhu <span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" step="any" class="form-control font-size-14 rounded-0"
                                    name="suhu" id="suhu" value="" required>
                                <span class="input-group-text rounded-0" id="basic-addon2">&degC</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card rounded-0 mt-3">
                <div class="card-body d-flex justify-content-between">
                    <button type="button" class="btn btn-sm btn-primary rounded-0 font-size-14" id="updateValue">Update
                        Data</button>
                    <div>
                        <a href="{{ route('perkembangan-anak.index') }}"
                            class="btn btn-sm btn-light rounded-0 font-size-14">Kembali</a>
                        <button type="submit" class="btn btn-sm btn-danger rounded-0 font-size-14">Simpan</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</form>

<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.12.1/datatables.min.js"></script>
{{-- <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script> --}}

<script>
    function updateElementValue(elementId, url) {
        var element = document.getElementById(elementId);
        var oldValue = element.value; // Simpan nilai sebelum pembaruan

        // Menggunakan Fetch API untuk mengambil data dari URL
        fetch(url)
            .then(response => response.text())
            .then(data => {
                // Mengisi nilai elemen dengan data dari URL
                element.value = data;

                // Membandingkan nilai sebelum dan setelah pembaruan
                if (oldValue !== data) {
                    // Menampilkan elemen notifikasi
                    var notificationElement = document.getElementById('notification');
                    notificationElement.style.display = 'block';

                    // Menutup elemen notifikasi setelah beberapa detik atau ketika tombol diklik
                    var timeoutId = setTimeout(function() {
                        notificationElement.style.display = 'none';
                    }, 5000);

                    // Menambahkan event listener untuk menutup notifikasi jika tombol diklik
                    document.getElementById('updateValuesButton').addEventListener('click', function() {
                        clearTimeout(timeoutId);
                        notificationElement.style.display = 'none';
                    });
                }
            })
            .catch(error => console.error('Terjadi kesalahan:', error));
    }

    document.getElementById('updateValue').addEventListener('click', function() {
        // Memanggil updateElementValue sekaligus saat halaman dimuat
        $(document).ready(function() {
            updateElementValue("nokartu", "{{ url('nokartu') }}");
            updateElementValue("suhu", "{{ url('suhu') }}");
            updateElementValue("tinggi", "{{ url('tinggi') }}");
            updateElementValue("bb", "{{ url('berat') }}");
        });

    });
</script>
