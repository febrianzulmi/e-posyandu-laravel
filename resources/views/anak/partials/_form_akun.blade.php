<div class="col-lg-5">
    <div class="card rounded-0">
        <div class="card-header py-3">
            <h6 class="card-title mb-0 font-weight-bold">Data Akun</h6>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="username" class="font-size-14 form-label">Username <span class="text-danger">*</span></label>
                <input type="text" class="form-control font-size-14 rounded-0 @error('username') is-invalid @enderror" name="username" id="username" placeholder="Username" value="{{ isset($anak) ? $anak->user->username : old('username') }}" required>
                @error('username')
                    <div class="invalid-feedback font-size-12">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="font-size-14 form-label">Password {{ isset($anak) ? 'Baru' : '' }} @if(empty($anak)) <span class="text-danger">*</span> @endif</label>
                <input type="password" class="form-control font-size-14 rounded-0 @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password {{ isset($anak) ? 'Baru' : '' }}" @if(empty($anak)) required @endif>
                @error('password')
                    <div class="invalid-feedback font-size-12">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="font-size-14 form-label">Ulangi Password {{ isset($anak) ? 'Baru' : '' }} @if(empty($anak)) <span class="text-danger">*</span> @endif</label>
                <input type="password" class="form-control font-size-14 rounded-0" name="password_confirmation" id="password_confirmation" placeholder="Ulangi Password {{ isset($anak) ? 'Baru' : '' }}" @if(empty($anak)) required @endif>
            </div>
        </div>
    </div>
    <div class="card rounded-0 mt-3">
        <div class="card-body text-end">
            <a href="{{ route('anak.index') }}" class="btn btn-sm btn-light rounded-0 font-size-14">Kembali</a>
            <button type="submit" class="btn btn-sm btn-danger rounded-0 font-size-14">Simpan</button>
        </div>
    </div>
</div>