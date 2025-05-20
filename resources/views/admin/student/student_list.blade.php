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
                        <h1>Student</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <a href="{{ route('student.create') }}" style="display: inline;">
                                <button type="submit" class="btn btn-success text-sm">
                                    <i class="nav-icon fas fa-light fa-plus text-xs"></i>
                                    Add
                                </button>
                            </a>
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

                                <form action="">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <select name="academic_year_id" id="" class="form-control">
                                                <option value="" disabled selected>Select Academic Year</option>
                                                @foreach ($academic_year as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $item->id == request('academic_year_id') ? 'selected' : '' }}>
                                                        {{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <select name="class_id" class="form-control">
                                                <option value="" disabled selected>Select Class</option>
                                                @foreach ($classes as $class)
                                                    <option value="{{ $class->id }}"
                                                        {{ $class->id == request('class_id') ? 'selected' : '' }}>
                                                        {{ $class->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <button type="submit" class="btn btn-primary text-sm">Filter Data</button>
                                            <a href="{{ url()->current() }}" class="btn btn-secondary text-sm">Clear
                                                Filter</a>
                                        </div>
                                    </div>
                                </form>

                                <div class="overflow-x-auto">
                                    <table id="example1" class="table table-bordered table-hover">
                                        {{-- table header --}}
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Name</th>
                                                <th>Academic Year</th>
                                                <th>Class</th>
                                                <th>Name Father</th>
                                                <th>Name Mother</th>
                                                <th>Number Telephone</th>
                                                <th>Email</th>
                                                <th>Created Time</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>

                                        {{-- table body --}}
                                        <tbody>
                                            @foreach ($students as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}.</td> <!-- Nomor Urut -->
                                                    <td>{{ $item->name }}</td>
                                                    {{-- "?->"" operator null-safe yang mencegah error --}}
                                                    {{-- akan menampilkan '-' jika name tidak ada --}}
                                                    <td>{{ $item->studentAcademicYear?->name ?? '-' }}</td>
                                                    <td>{{ $item->studentClass?->name ?? '-' }}</td>
                                                    <td>{{ $item->father_name }}</td>
                                                    <td>{{ $item->mother_name }}</td>
                                                    <td>{{ $item->mobno }}</td>
                                                    <td>{{ $item->email }}</td>
                                                    <td>{{ $item->created_at }}</td>
                                                    <td>
                                                        <a href="{{ route('student.edit', $item->id) }}"
                                                            class="btn btn-primary text-sm">Edit</a>
                                                    </td>
                                                    <td>
                                                        <form action="{{ route('student.delete', $item->id) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('Are you sure you want to delete this student?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-danger text-sm">Delete</button>
                                                        </form>
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
