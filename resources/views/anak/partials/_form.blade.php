<form action="{{ isset($anak) ? route('anak.update', $anak->id) : route('anak.store') }}" method="POST">
    @csrf

    @if(isset($anak))
        @method('PUT')
    @endif

    <div class="row {{ session('error') ? 'mt-4' : '' }} {{ isset($anak) ? 'justify-content-center' : '' }}">
        <div class="col-lg-7">
            <div class="card rounded-0">
                <div class="card-header py-3">
                    <h6 class="card-title mb-0 font-weight-bold">Data Anak</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="nama" class="font-size-14 form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" class="form-control font-size-14 rounded-0" name="nama" id="nama" placeholder="Nama Lengkap" value="{{ isset($anak) ? $anak->nama : old('nama') }}" required>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-4">
                            <label for="tgl_lahir" class="font-size-14 form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                            <input type="date" class="form-control font-size-14 rounded-0" name="tgl_lahir" id="tgl_lahir" value="{{ isset($anak) ? $anak->tgl_lahir->format('Y-m-d') : old('tgl_lahir') }}" required>
                        </div>
                        <div class="col-lg-4">
                            <label for="usia" class="font-size-14 form-label">Usia <span class="text-danger">*</span></label>
                            <input type="number" step="any" class="form-control font-size-14 rounded-0" name="usia" id="usia" value="{{ isset($anak) ? $anak->usia : old('usia') }}" placeholder="Usia" required>
                        </div>
                        <div class="col-lg-4">
                            <label for="satuan_usia" class="font-size-14 form-label">Satuan Usia <span class="text-danger">*</span></label>
                            <select class="form-select font-size-14 rounded-0" name="satuan_usia" id="satuan_usia" required>
                                <option value="">Pilih Satuan Usia</option>
                                <option {{ (isset($anak) && $anak->getRawOriginal('satuan_usia') == 'bulan') || old('satuan_usia') == 'bulan' ? 'selected' : '' }} value="bulan">Bulan</option>
                                <option {{ (isset($anak) && $anak->getRawOriginal('satuan_usia') == 'tahun') || old('satuan_usia') == 'tahun' ? 'selected' : '' }} value="tahun">Tahun</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="jk" class="font-size-14 form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jk" id="jk_l" value="l" {{ (isset($anak) && $anak->getRawOriginal('jk') == 'l') || empty($anak) || old('jk') == 'l' ? 'checked' : '' }}>
                                <label class="form-check-label font-size-14" for="jk_l">Laki-laki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jk" id="jk_p" value="p" {{ (isset($anak) && $anak->getRawOriginal('jk') == 'p') || old('jk') == 'p' ? 'checked' : '' }}>
                                <label class="form-check-label font-size-14" for="jk_p">Perempuan</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="nama_orang_tua" class="font-size-14 form-label">Nama Orang Tua <span class="text-danger">*</span></label>
                        <input type="text" class="form-control font-size-14 rounded-0" name="nama_orang_tua" id="nama_orang_tua" placeholder="Nama Orang Tua" value="{{ isset($anak) ? $anak->nama_orang_tua : old('nama_orang_tua') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="font-size-14 form-label">Alamat <span class="text-danger">*</span></label>
                        <input type="text" class="form-control font-size-14 rounded-0" name="alamat" id="alamat" placeholder="Alamat" value="{{ isset($anak) ? $anak->alamat : old('alamat') }}" required>
                    </div>
                </div>
            </div>

            @if(isset($anak))
                <div class="card rounded-0 mt-3">
                    <div class="card-body text-end">
                        <a href="{{ route('anak.index') }}" class="btn btn-sm btn-light rounded-0 font-size-14">Kembali</a>
                        <button type="submit" class="btn btn-sm btn-danger rounded-0 font-size-14">Simpan</button>
                    </div>
                </div>
            @endif
        </div>
        @if(empty($anak))
            @include('anak.partials._form_akun')
        @endif
    </div>
</form>