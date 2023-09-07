@extends('template.app')

@section('title', 'Data Anak')

@section('breadcrumb')
    <li class="breadcrumb-item font-size-14"><a href="{{ route('anak.index') }}">Data Anak</a></li>
    <li class="breadcrumb-item active font-size-14">Edit Data</li>
@endsection

@section('content')
    @if(session('error'))
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-danger font-size-14 font-weight-bold rounded-0">{{ session('error') }}</div>
            </div>
        </div>
    @endif

    @include('anak.partials._form')
@endsection
