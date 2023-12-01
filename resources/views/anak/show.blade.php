@extends('template.app')

@section('title', 'Data Anak')

@section('breadcrumb')
    <li class="breadcrumb-item font-size-14"><a href="{{ route('anak.index') }}">Data Anak</a></li>
    <li class="breadcrumb-item active font-size-14">Detail Data</li>
@endsection

@section('content')
    @if (session('error'))
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-danger font-size-14 font-weight-bold rounded-0">{{ session('error') }}</div>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-6">
            <div class="card rounded-0">
                <div class="card-header py-3">
                    <h6 class="card-title mb-0 font-weight-bold">Data Anak</h6>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item justify-content-between d-flex mb-1">
                            <span class="font-size-14 font-weight-bold">Nama Lengkap</span>
                            <span class="font-size-14">{{ $anak->nama }}</span>
                        </li>
                        <li class="list-group-item justify-content-between d-flex mb-1">
                            <span class="font-size-14 font-weight-bold">Tanggal Lahir</span>
                            <span class="font-size-14">{{ $anak->tgl_lahir->format('d/m/Y') }}</span>
                        </li>
                        <li class="list-group-item justify-content-between d-flex mb-1">
                            <span class="font-size-14 font-weight-bold">Usia</span>
                            <span class="font-size-14">{{ $anak->usia . ' ' . $anak->satuan_usia }}</span>
                        </li>
                        <li class="list-group-item justify-content-between d-flex mb-1">
                            <span class="font-size-14 font-weight-bold">Jenis Kelamin</span>
                            <span class="font-size-14">{{ $anak->jk }}</span>
                        </li>
                        <li class="list-group-item justify-content-between d-flex mb-1">
                            <span class="font-size-14 font-weight-bold">Nama Orang Tua</span>
                            <span class="font-size-14">{{ $anak->nama_orang_tua }}</span>
                        </li>
                        <li class="list-group-item justify-content-between d-flex flex-column">
                            <span class="font-size-14 font-weight-bold mb-1">Alamat</span>
                            <span class="font-size-14">{{ $anak->alamat }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card rounded-0">
                <div class="card-header py-3">
                    <h6 class="card-title mb-0 font-weight-bold">Data Akun</h6>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item justify-content-between d-flex mb-1">
                            <span class="font-size-14 font-weight-bold">Username</span>
                            <span class="font-size-14">{{ $anak->user->username }}</span>
                        </li>
                    </ul>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item justify-content-between d-flex mb-1">
                            <span class="font-size-14 font-weight-bold">Password</span>
                            <span class="font-size-14">********</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card rounded-0 mt-3">
                <div class="card-body text-end">
                    <form action="{{ route('anak.destroy', $anak->id) }}" method="POST">
                        @csrf

                        @method('DELETE')
                        <a href="{{ route('anak.index') }}" class="btn btn-sm btn-light rounded-0 font-size-14">Kembali</a>
                        <button type="submit" class="btn btn-sm btn-danger rounded-0 font-size-14">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
