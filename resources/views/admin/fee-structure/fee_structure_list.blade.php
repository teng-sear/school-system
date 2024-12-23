@extends('admin.layout')

@section('customCss')
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Fee Structure</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Fee Structure List</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        {{-- table 2 --}}
                        <div class="card">

                            @if (Session::has('success'))
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                </div>
                            @endif

                            <div class="card-body">
                                <div class="overflow-x-auto">
                                    <table id="example1"
                                        class="min-w-full table table-bordered table-hover border text-sm">
                                        {{-- table header --}}
                                        <thead class="bg-gray-100">
                                            <tr>
                                                <th class="border px-4 py-2 text-left">ID</th>
                                                <th class="border px-4 py-2 text-left">Academic Year</th>
                                                <th class="border px-4 py-2 text-left">Class</th>
                                                <th class="border px-4 py-2 text-left">Fee Head</th>
                                                <th class="border px-4 py-2 text-left">Januari</th>
                                                <th class="border px-4 py-2 text-left">Februari</th>
                                                <th class="border px-4 py-2 text-left">Maret</th>
                                                <th class="border px-4 py-2 text-left">April</th>
                                                <th class="border px-4 py-2 text-left">Mei</th>
                                                <th class="border px-4 py-2 text-left">Juni</th>
                                                <th class="border px-4 py-2 text-left">Juli</th>
                                                <th class="border px-4 py-2 text-left">Agustus</th>
                                                <th class="border px-4 py-2 text-left">September</th>
                                                <th class="border px-4 py-2 text-left">Oktober</th>
                                                <th class="border px-4 py-2 text-left">November</th>
                                                <th class="border px-4 py-2 text-left">Desember</th>
                                                <th class="border px-4 py-2 text-left">Action</th>
                                            </tr>
                                        </thead>

                                        {{-- table body --}}
                                        <tbody>
                                            @foreach ($fee_structure as $item)
                                                <tr class="hover:bg-gray-50">
                                                    <td class="border px-4 py-2">{{ $item->id }}</td>
                                                    <td class="border px-4 py-2">{{ $item->AcademicYear->name }}</td>
                                                    <td class="border px-4 py-2">{{ $item->Classes->name }}</td>
                                                    <td class="border px-4 py-2">{{ $item->FeeHead->name }}</td>
                                                    <td class="border px-4 py-2">{{ $item->january }}</td>
                                                    <td class="border px-4 py-2">{{ $item->february }}</td>
                                                    <td class="border px-4 py-2">{{ $item->march }}</td>
                                                    <td class="border px-4 py-2">{{ $item->april }}</td>
                                                    <td class="border px-4 py-2">{{ $item->may }}</td>
                                                    <td class="border px-4 py-2">{{ $item->june }}</td>
                                                    <td class="border px-4 py-2">{{ $item->july }}</td>
                                                    <td class="border px-4 py-2">{{ $item->august }}</td>
                                                    <td class="border px-4 py-2">{{ $item->september }}</td>
                                                    <td class="border px-4 py-2">{{ $item->october }}</td>
                                                    <td class="border px-4 py-2">{{ $item->november }}</td>
                                                    <td class="border px-4 py-2">{{ $item->december }}</td>
                                                    <td class="border px-4 py-2">
                                                        <div class="flex space-x-2">
                                                            <a href="{{ route('fee-structure.edit', $item->id) }}"
                                                                class="btn btn-primary px-3 py-1 text-white bg-blue-500 rounded hover:bg-blue-600">
                                                                Edit
                                                            </a>
                                                            <form action="{{ route('fee-structure.delete', $item->id) }}"
                                                                method="POST"
                                                                onsubmit="return confirm('Are you sure you want to delete this fee structure?');">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-danger px-3 py-1 text-white bg-red-500 rounded hover:bg-red-600">
                                                                    Delete
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
            </div>
        </section>
    </div>
@endsection

@section('customJs')
    <script src="plugins/jquery/jquery.min.js"></script>

    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="plugins/jszip/jszip.min.js"></script>
    <script src="plugins/pdfmake/pdfmake.min.js"></script>
    <script src="plugins/pdfmake/vfs_fonts.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

    <script src="dist/js/adminlte.min2167.js?v=3.2.0"></script>

    <script src="dist/js/demo.js"></script>

    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection
