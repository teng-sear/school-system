@extends('teacher.layout')

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
                        <h1>Teaching Schedule</h1>
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

                            <form action="">
                                <div class="row card-header">
                                    {{-- class --}}
                                    <div class="form-group col-md-4">
                                        <select name="class_id" id="class_id" class="form-control">
                                            <option value="" disabled selected>Select Class</option>
                                            @foreach ($classes as $class)
                                                <option value="{{ $class->id }}"
                                                    {{ $class->id == request('class_id') ? 'selected' : '' }}>
                                                    {{ $class->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- subject --}}
                                    <div class="form-group col-md-4">
                                        <select name="subject_id" id="subject_id" class="form-control">
                                            <option value="" disabled selected>Select Subject</option>
                                            @foreach ($subjects as $subject)
                                                <option value="{{ $subject->subject->id }}"
                                                    {{ $subject->subject->id == request('subject_id') ? 'selected' : '' }}>
                                                    {{ $subject->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <button type="submit" class="btn btn-primary text-sm">Filter Data</button>
                                        <a href="{{ url()->current() }}" class="btn btn-secondary text-sm">Clear Filter</a>
                                    </div>
                                </div>
                            </form>

                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-hover">
                                    {{-- table header --}}
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Class</th>
                                            <th>Subject</th>
                                            <th>Day</th>
                                            <th>Start Time</th>
                                            <th>Time Stops</th>
                                            <th>Room Number</th>
                                        </tr>
                                    </thead>

                                    {{-- table body --}}
                                    <tbody>
                                        @foreach ($tabletimes as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}.</td> <!-- Nomor Urut -->
                                                <td>{{ $item->class->name }}</td>
                                                <td>{{ $item->subject->name }}</td>
                                                <td>{{ $item->day->name }}</td>
                                                <td>{{ \Carbon\Carbon::createFromFormat('H:i', $item->start_time)->format('h:i A') }}
                                                </td>
                                                <td>{{ \Carbon\Carbon::createFromFormat('H:i', $item->end_time)->format('h:i A') }}
                                                </td>
                                                <td>{{ $item->room_no }}</td>
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

@section('customJs')
    <script>
        $('#class_id').change(function() {
            var class_id = $(this).val();

            // Kosongkan dropdown sebelum diisi ulang
            $('#subject_id').empty().append('<option disabled selected>Select Subject</option>');

            // AJAX request
            $.ajax({
                url: "{{ route('findSubject') }}",
                type: "GET",
                data: {
                    class_id: class_id
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status) {
                        $.each(response.subjects, function(key, subject) {
                            $('#subject_id').append(`
                    <option value="${subject.id}">${subject.name}</option>
                `);
                        });
                    } else {
                        console.error('Failed to fetch subjects');
                    }
                },
                error: function(xhr) {
                    console.error('Error fetching subjects:', xhr);
                }
            });
        });
    </script>
@endsection
@endsection
