@extends('admin.layout')

@section('content')
    {{-- content form --}}
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Set Subject</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <a href="{{ route('assign-subject.read') }}" style="display: inline;">
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
                                <h3 class="card-title">Add Set Subject</h3>
                            </div>

                            <form action="{{ route('assign-subject.store') }}" method="post">

                                @csrf

                                <div class="card-body">
                                    <select name="class_id" class="form-control">
                                        <option disabled selected>Select Class</option>
                                        @foreach ($classes as $class)
                                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('class_id')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                @foreach ($subjects as $subject)
                                    <div class="form-check">
                                        <input type="checkbox" id="subject-{{ $subject->id }}" name="subject_id[]"
                                            value="{{ $subject->id }}">
                                        <label for="subject-{{ $subject->id }}">{{ $subject->name }}</label>
                                    </div>
                                @endforeach
                                @error('subject_id')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror

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
