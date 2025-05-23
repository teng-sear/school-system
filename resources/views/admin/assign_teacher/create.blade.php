@extends('admin.layout')

@section('content')
    {{-- content form --}}
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Assign Teachers to Classes</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <a href="{{ route('assign-teacher.read') }}" style="display: inline;">
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
                                <h3 class="card-title">Add Assign Teachers to Classes</h3>
                            </div>

                            <form action="{{ route('assign-teacher.store') }}" method="post">

                                @csrf

                                <div class="card-body">
                                    {{-- class --}}
                                    <div class="form-group">
                                        <select name="class_id" id="class_id" class="form-control">
                                            <option disabled selected>Select Class</option>
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
                                            <option disabled selected>Select Subject</option>
                                        </select>
                                        @error('subject_id')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    {{-- teacher --}}
                                    <div class="form-group">
                                        <select name="teacher_id" class="form-control">
                                            <option disabled selected>Select Teacher</option>
                                            @foreach ($teachers as $teacher)
                                                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('teacher_id')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
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
