@extends('admin.layout')

@section('customCss')
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <style>
        .card-gradient .card-header {
            background: linear-gradient(45deg, #3c8dbc, #367fa9);
            border-bottom: none;
        }
        .table-actions {
            min-width: 120px;
        }
        .btn-table-action {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }
        .status-badge {
            padding: 0.25rem 0.5rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        .badge-student { background: #4CAF50; color: white; }
        .badge-teacher { background: #2196F3; color: white; }
        .badge-parent { background: #9C27B0; color: white; }
    </style>
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="m-0 text-dark">
                        <i class="fas fa-bullhorn mr-2"></i>Announcements
                    </h1>
                    <a href="{{ route('announcement.create') }}" class="btn btn-success">
                        <i class="fas fa-plus-circle mr-1"></i>
                        New Announcement
                    </a>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-gradient">
                            @if (Session::has('success'))
                            <div class="alert alert-success alert-dismissible fade show mx-3 mt-3">
                                <i class="icon fas fa-check-circle mr-2"></i>
                                {{ Session::get('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif

                            <div class="card-body">
                                <table id="announcements-table" class="table table-bordered table-hover table-striped">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th style="width: 50px">#</th>
                                            <th>Message</th>
                                            <th style="width: 120px">Audience</th>
                                            <th style="width: 160px">Created At</th>
                                            <th style="width: 100px" class="text-center">Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($announcements as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="text-truncate" style="max-width: 400px">{{ $item->message }}</td>
                                            <td>
                                                <span class="status-badge badge-{{ $item->type }}">
                                                    {{ ucfirst($item->type) }}
                                                </span>
                                            </td>
                                            <td>{{ $item->created_at->format('d M Y H:i') }}</td>
                                            <td class="table-actions text-center">
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a href="{{ route('announcement.edit', $item->id) }}" 
                                                       class="btn btn-sm btn-primary btn-table-action"
                                                       data-toggle="tooltip" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('announcement.delete', $item->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                                class="btn btn-sm btn-danger btn-table-action"
                                                                data-toggle="tooltip" 
                                                                title="Delete"
                                                                onclick="return confirm('Are you sure you want to delete this announcement?')">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('customJs')
    <!-- DataTables & Plugins -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="plugins/pdfmake/pdfmake.min.js"></script>
    <script src="plugins/pdfmake/vfs_fonts.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

    <script>
        $(function() {
            $('#announcements-table').DataTable({
                "responsive": true,
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "dom": "<'row'<'col-md-6'l><'col-md-6'f>>" +
                       "<'row'<'col-12'tr>>" +
                       "<'row'<'col-md-5'i><'col-md-7'p>>",
                "columnDefs": [
                    { "orderable": false, "targets": [4] },
                    { "className": "align-middle", "targets": "_all" }
                ],
                "language": {
                    "search": "_INPUT_",
                    "searchPlaceholder": "Search announcements...",
                    "lengthMenu": "Show _MENU_ entries",
                    "paginate": {
                        "previous": "<i class='fas fa-chevron-left'></i>",
                        "next": "<i class='fas fa-chevron-right'></i>"
                    }
                },
                "buttons": [
                    {
                        extend: 'collection',
                        text: '<i class="fas fa-download mr-1"></i> Export',
                        className: 'btn-sm',
                        buttons: [
                            'copyHtml5',
                            'excelHtml5',
                            'csvHtml5',
                            'pdfHtml5',
                            'print'
                        ]
                    },
                    {
                        extend: 'colvis',
                        text: '<i class="fas fa-columns mr-1"></i> Columns',
                        className: 'btn-sm'
                    }
                ]
            });

            // Initialize tooltips
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection