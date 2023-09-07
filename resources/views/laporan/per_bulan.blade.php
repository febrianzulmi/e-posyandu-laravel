@extends('template.app')

@section('title', 'Laporan')

@push('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jq-3.6.0/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-html5-2.2.3/b-print-2.2.3/datatables.min.css"/>
@endpush

@section('breadcrumb')
    <li class="breadcrumb-item font-size-14">Laporan</li>
    <li class="breadcrumb-item active font-size-14">Per Bulan</li>
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
                <div class="card-header py-3">
                    <h6 class="card-title mb-0 font-weight-bold">Data Laporan</h6>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="font-weight-bold">No</th>
                                <th class="font-weight-bold">Nama</th>
                                <th class="font-weight-bold">Jenis Kelamin</th>
                                <th class="font-weight-bold">Alamat</th>
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
@endsection

@push('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jq-3.6.0/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-html5-2.2.3/b-print-2.2.3/datatables.min.js"></script>

    <script>
        $(function() {
            const table = $("table").DataTable({
                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
                serverSide: true,
                processing: true,
                responsive: true,
                ajax: {
                    url: "{{ route('perkembangan-anak.datatable-json') }}",
                    method: 'GET',
                    data: function(d) {
                        d.month_filter = $('.dataTables_filter input').val();
                    }
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'anak.nama', name: 'anak.nama' },
                    { data: 'anak.jk', name: 'anak.jk' },
                    { data: 'anak.alamat', name: 'anak.alamat' },
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
                        targets: [1, 2, 3, 4, 5, 6],
                        searchable: false
                    },
                    {
                        targets: [7],
                        visible: false
                    }
                ],
                createdRow: function(row, data, dataIndex, cells) {
                    $(row).addClass('font-size-14');
                },
                order: [[7, 'desc']],
                buttons: [
                    { 
                        extend: 'pdf', 
                        text: 'Download PDF',
                        className: 'btn btn-sm btn-danger font-size-14 rounded-0 me-2',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        },
                        customize: function (doc) {
                            doc.content[2].table.widths = "*";
                        },
                        messageTop: function() {
                            const bulan = $('.dataTables_filter input').val();
                            
                            if(bulan) {
                                return 'Bulan : '+bulan;
                            }

                            return 'Semua';
                        },
                    },
                    { 
                        extend: 'print',
                        className: 'btn btn-sm btn-danger font-size-14 rounded-0',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        },
                        messageTop: function() {
                            const bulan = $('.dataTables_filter input').val();
                            
                            if(bulan) {
                                return 'Bulan : '+bulan;
                            }

                            return 'Semua';
                        }
                    }
                ],
                dom: "<'row'<'col-md-12 mb-4'B>>" + 
                    "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6 filter'>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>"
            });

            $('div.filter').html(`
                <div id="DataTables_Table_0_filter" class="dataTables_filter">
                    <label>
                        Filter:
                        <input type="month" class="form-control form-control-sm" placeholder="" aria-controls="DataTables_Table_0">
                    </label>
                </div>
            `);

            $(document).on('change', '.dataTables_filter input', function() {
                const val = $(this).val();

                table.draw();
            });
        });
    </script>
@endpush
