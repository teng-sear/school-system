@extends('admin.layout')

@section('content')
    {{-- content form --}}
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Jadwal</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <a href="{{ route('timetable.read') }}" style="display: inline;">
                                <button type="submit" class="btn btn-secondary text-sm">
                                    <i class="nav-icon fas fa-solid fa-arrow-left text-xs"></i>
                                    Back
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
                    <div class="col-md-12">
                        <div class="card card-primary">

                            @if (Session::has('success'))
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                </div>
                            @endif

                            <div class="card-header">
                                <h3 class="card-title">Add Jadwal</h3>
                            </div>

                            <form action="{{ route('timetable.store') }}" method="post">

                                @csrf

                                <div class="card-body">
                                    {{-- class --}}
                                    <div class="form-group">
                                        <select name="class_id" id="class_id" class="form-control">
                                            <option disabled selected>Pilih Kelas</option>
                                            @foreach ($classes as $class)
                                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('class_id')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    {{-- subject --}}
                                    <div class="form-group">
                                        <select name="subject_id" id="subject_id" class="form-control">
                                            <option disabled selected>Pilih Subjek</option>

                                        </select>
                                        @error('subject_id')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    {{-- table time --}}
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Hari</th>
                                                <th>Waktu Mulai</th>
                                                <th>Waktu Berhenti</th>
                                                <th>Nomor Ruangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 1;
                                            @endphp
                                            @foreach ($days as $day)
                                                <tr>
                                                    <td>{{ $day->name }}</td>
                                                    <input type="hidden" name="timetable[{{ $i }}][day_id]"
                                                        value="{{ $day->id }}">
                                                    <td><input type="time"
                                                            name="timetable[{{ $i }}][start_time]"></td>
                                                    <td><input type="time"
                                                            name="timetable[{{ $i }}][end_time]"></td>
                                                    <td><input type="number"
                                                            name="timetable[{{ $i }}][room_no]" placeholder="0"
                                                            min="0"></td>
                                                </tr>
                                                @php
                                                    $i++;
                                                @endphp
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary text-sm">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

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
