@extends('template.app')

@section('title', 'Data Anak')

@push('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.12.1/datatables.min.css"/>
@endpush

@section('breadcrumb')
    <li class="breadcrumb-item active font-size-14">Data Anak</li>
@endsection

@section('content')
    @if(session('success'))
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-success font-size-14 font-weight-bold rounded-0">{{ session('success') }}</div>
            </div>
        </div>
    @endif

    <div class="row {{ session('success') ? 'mt-4' : '' }}">
        <div class="col-lg-12">
            <div class="card rounded-0">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="card-title mb-0 font-weight-bold">Data Anak</h6>
                    <a href="{{ route('anak.create') }}" class="btn btn-sm btn-danger rounded-0 font-size-14">Tambah Data</a>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="font-weight-bold">No</th>
                                <th class="font-weight-bold">Nama</th>
                                <th class="font-weight-bold">Jenis Kelamin</th>
                                <th class="font-weight-bold">Tgl Lahir</th>
                                <th class="font-weight-bold">Usia</th>
                                <th class="font-weight-bold">Orang Tua</th>
                                <th class="font-weight-bold">Created At</th>
                                <th class="font-weight-bold">Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
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
                    url: "{{ route('anak.datatable-json') }}",
                    method: 'GET'
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'nama', name: 'nama' },
                    { data: 'jk', name: 'jk' },
                    { data: 'tgl_lahir', name: 'tgl_lahir' },
                    { data: 'usia', name: 'usia' },
                    { data: 'nama_orang_tua', name: 'nama_orang_tua' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'aksi', name: 'aksi' }
                ],
                columnDefs: [
                    {
                        targets: [7, 0],
                        orderable: false,
                        searchable: false
                    },
                    {
                        targets: [6],
                        visible: false
                    }
                ],
                createdRow: function(row, data, dataIndex, cells) {
                    $(row).addClass('font-size-14');
                },
                order: [[6, 'desc']]
            });
        });
    </script>
@endpush
