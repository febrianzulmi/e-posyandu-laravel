@extends('template.app')

@section('title', 'Halaman Utama')

@push('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.12.1/datatables.min.css"/>
@endpush

@section('breadcrumb')
    <li class="breadcrumb-item active font-size-14">Halaman Utama</li>
@endsection

@section('content')
    @can('isAdmin')
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-danger font-size-14 font-weight-bold rounded-0">Rekapitulasi Per Tanggal
                    {{ date('d/m/Y') }}</div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-3">
                <a href="{{ route('anak.index') }}" class="text-decoration-none text-dark">
                    <div class="card rounded-0">
                        <div class="card-body text-center">
                            <h1 class="card-title font-weight-bold">{{ $anak }}</h1>
                            <h5 class="card-text font-size-14">Data Anak</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3">
                <a href="{{ route('perkembangan-anak.index') }}" class="text-decoration-none text-dark">
                    <div class="card rounded-0">
                        <div class="card-body text-center">
                            <h1 class="card-title font-weight-bold">{{ $perkembangan_anak }}</h1>
                            <h5 class="card-text font-size-14">Perkembangan Anak</h5>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    @elsecan('isUser')
        <div class="row">
            <div class="col-lg-12">
                <div class="card rounded-0">
                    <div class="card-header py-3">
                        <h6 class="card-title mb-0 font-weight-bold">Data Diri</h6>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item justify-content-between d-flex mb-1">
                                <span class="font-size-14 font-weight-bold">Nama Lengkap</span>
                                <span class="font-size-14">{{ auth()->user()->anak->nama }}</span>
                            </li>
                            <li class="list-group-item justify-content-between d-flex mb-1">
                                <span class="font-size-14 font-weight-bold">Tanggal Lahir</span>
                                <span class="font-size-14">{{ auth()->user()->anak->tgl_lahir->format('d/m/Y') }}</span>
                            </li>
                            <li class="list-group-item justify-content-between d-flex mb-1">
                                <span class="font-size-14 font-weight-bold">Usia</span>
                                <span class="font-size-14">{{ auth()->user()->anak->usia.' Bulan' }}</span>
                            </li>
                            <li class="list-group-item justify-content-between d-flex mb-1">
                                <span class="font-size-14 font-weight-bold">Jenis Kelamin</span>
                                <span class="font-size-14">{{ auth()->user()->anak->jk }}</span>
                            </li>
                            <li class="list-group-item justify-content-between d-flex mb-1">
                                <span class="font-size-14 font-weight-bold">Nama Orang Tua</span>
                                <span class="font-size-14">{{ auth()->user()->anak->nama_orang_tua }}</span>
                            </li>
                            <li class="list-group-item justify-content-between d-flex flex-wrap">
                                <span class="font-size-14 font-weight-bold">Alamat</span>
                                <span class="font-size-14">{{ auth()->user()->anak->alamat }}</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="card rounded-0 mt-4">
                    <div class="card-header py-3">
                        <h6 class="card-title mb-0 font-weight-bold">Data Perkembangan Anak</h6>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="font-weight-bold">No</th>
                                    <th class="font-weight-bold">Tgl Penimbangan</th>
                                    <th class="font-weight-bold">Berat Badan</th>
                                    <th class="font-weight-bold">Tinggi Badan</th>
                                    <th class="font-weight-bold">Created At</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endcan
@endsection

@push('scripts')
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.12.1/datatables.min.js"></script>
    <script>
        $(function() {
            const table = $("table").DataTable({
                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
                serverSide: true,
                processing: true,
                responsive: true,
                ajax: {
                    url: "{{ route('perkembangan-anak.datatable-json') }}",
                    method: 'GET'
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'tgl_penimbangan', name: 'tgl_penimbangan' },
                    { data: 'berat_badan', name: 'berat_badan' },
                    { data: 'tinggi_badan', name: 'tinggi_badan' },
                    { data: 'created_at', name: 'created_at' }
                ],
                columnDefs: [
                    {
                        targets: [0],
                        orderable: false,
                        searchable: false
                    },
                    {
                        targets: [4],
                        visible: false
                    }
                ],
                createdRow: function(row, data, dataIndex, cells) {
                    $(row).addClass('font-size-14');
                },
                order: [[4, 'desc']]
            });
        });
    </script>
@endpush
