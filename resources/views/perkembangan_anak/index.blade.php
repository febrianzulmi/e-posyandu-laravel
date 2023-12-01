@extends('template.app')

@section('title', 'Perkembangan Anak')

@push('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.12.1/datatables.min.css" />
@endpush

@section('breadcrumb')
    <li class="breadcrumb-item active font-size-14">Perkembangan Anak</li>
@endsection

@section('content')
    @if (session('success'))
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
                    <h6 class="card-title mb-0 font-weight-bold">Data Perkembangan Anak</h6>
                    <a href="{{ route('perkembangan-anak.create') }}"
                        class="btn btn-sm btn-danger rounded-0 font-size-14">Tambah Data</a>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="font-weight-bold">No</th>
                                <th class="font-weight-bold">UID</th>
                                <th class="font-weight-bold">Nama</th>
                                <th class="font-weight-bold">Jenis Kelamin</th>
                                <th class="font-weight-bold">Tgl Pemeriksaan</th>
                                <th class="font-weight-bold">Berat Badan</th>
                                <th class="font-weight-bold">Tinggi Badan</th>
                                <th class="font-weight-bold">Suhu</th>
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
                lengthMenu: [
                    [15, 25, 50, -1],
                    [15, 25, 50, "All"]
                ],
                serverSide: true,
                processing: true,
                responsive: true,
                ajax: {
                    url: "{{ route('perkembangan-anak.datatable-json') }}",
                    method: 'GET'
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'uid',
                        name: 'uid'
                    },
                    {
                        data: 'anak.nama',
                        name: 'anak.nama'
                    },
                    {
                        data: 'anak.jk',
                        name: 'anak.jk'
                    },
                    {
                        data: 'tgl_pemeriksaan',
                        name: 'tgl_pemeriksaan'
                    },
                    {
                        data: 'bb',
                        name: 'bb'
                    },
                    {
                        data: 'tb',
                        name: 'tb'
                    },
                    {
                        data: 'suhu',
                        name: 'suhu'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    }
                ],
                columnDefs: [{
                        targets: [9, 0],
                        orderable: false,
                        searchable: false
                    },
                    {
                        targets: [9],
                        visible: false
                    }
                ],
                createdRow: function(row, data, dataIndex, cells) {
                    $(row).addClass('font-size-14');
                },
                order: [
                    [6, 'desc']
                ]
            });

            // delete
            $(document).on('click', '.btn-delete', function(e) {
                const id = $(this).attr('data-id');

                $.ajax({
                    url: "{{ url('/perkembangan-anak') }}/" + id,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    success: function(res) {
                        table.ajax.reload();
                    },
                    error: function(err) {
                        alert('Data gagal dihapus');
                    }
                })
            });
        });
    </script>
@endpush
