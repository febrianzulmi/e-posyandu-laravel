@extends('template.app')

@section('title', 'Perkembangan Anak')

@section('breadcrumb')
    <li class="breadcrumb-item font-size-14"><a href="{{ route('perkembangan-anak.index') }}">Perkembangan Anak</a></li>
    <li class="breadcrumb-item active font-size-14">Tambah Data</li>
@endsection

@section('content')
    @if (session('error'))
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-danger font-size-14 font-weight-bold rounded-0">{{ session('error') }}</div>
            </div>
        </div>
    @endif

    @include('perkembangan_anak.partials._form')
@endsection
