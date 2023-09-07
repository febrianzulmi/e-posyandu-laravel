<form action="{{ isset($perkembangan_anak) ? route('perkembangan-anak.update', $perkembangan_anak->id) : route('perkembangan-anak.store') }}" method="POST">
    @csrf

    @if(isset($perkembangan_anak))
        @method('PUT')
    @endif

    <div class="row {{ session('error') ? 'mt-4' : '' }} justify-content-center">
        <div class="col-lg-7">
            <div class="card rounded-0">
                <div class="card-header py-3">
                    <h6 class="card-title mb-0 font-weight-bold">Data Perkembangan Anak</h6>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-lg-8">
                            <label for="anak_id" class="font-size-14 form-label">Anak <span class="text-danger">*</span></label>
                            <select type="text" class="form-select font-size-14 rounded-0" name="anak_id" id="anak_id" required>
                                <option value="">Pilih Anak</option>
                                @foreach($anak as $a)
                                    <option {{ (isset($perkembangan_anak) && $perkembangan_anak->anak_id == $a->id) || old('anak_id') == $a->id ? 'selected' : '' }} value="{{ $a->id }}">{{ $a->nama }} ({{ $a->jk }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-4">
                            <label for="tgl_penimbangan" class="font-size-14 form-label">Tanggal Penimbangan <span class="text-danger">*</span></label>
                            <input type="date" class="form-control font-size-14 rounded-0" name="tgl_penimbangan" id="tgl_penimbangan" value="{{ isset($perkembangan_anak) ? $perkembangan_anak->tgl_penimbangan->format('Y-m-d') : date('Y-m-d') }}" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label for="berat_badan" class="font-size-14 form-label">Berat Badan <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" step="any" class="form-control font-size-14 rounded-0" name="berat_badan" id="berat_badan" value="{{ isset($perkembangan_anak) ? $perkembangan_anak->berat_badan : old('berat_badan') }}" required>
                                <span class="input-group-text rounded-0" id="basic-addon2">KG</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label for="tinggi_badan" class="font-size-14 form-label">Tinggi Badan <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" step="any" class="form-control font-size-14 rounded-0" name="tinggi_badan" id="tinggi_badan" value="{{ isset($perkembangan_anak) ? $perkembangan_anak->tinggi_badan : old('tinggi_badan') }}" required>
                                <span class="input-group-text rounded-0" id="basic-addon2">CM</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card rounded-0 mt-3">
                <div class="card-body text-end">
                    <a href="{{ route('perkembangan-anak.index') }}" class="btn btn-sm btn-light rounded-0 font-size-14">Kembali</a>
                    <button type="submit" class="btn btn-sm btn-danger rounded-0 font-size-14">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>