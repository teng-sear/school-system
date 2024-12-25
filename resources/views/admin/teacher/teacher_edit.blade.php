@extends('admin.layout')

@section('content')
    {{-- content form --}}
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Teacher</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Edit Teacher</li>
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
                                <h3 class="card-title">Edit Teacher</h3>
                            </div>

                            {{-- metode default HTML hanya mendukung GET dan POST --}}
                            <form action="{{ route('teacher.update', $teacher->id) }}" method="post">

                                @csrf
                                @method('PUT') <!-- Mengubah metode menjadi PUT -->

                                <div class="card-body">
                                    <div class="row">
                                        {{-- teacher name --}}
                                        <div class="form-group col-md-4">
                                            <label for="exampleInput">Teacher Name</label>
                                            <input type="text" name="name" class="form-control" id="exampleInput"
                                                placeholder="Enter teacher name" value="{{ old('name', $teacher->name) }}">
                                            @error('name')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        {{-- teacher's father name --}}
                                        <div class="form-group col-md-4">
                                            <label for="exampleInput">Teacher's Father Name</label>
                                            <input type="text" name="father_name" class="form-control" id="exampleInput"
                                                placeholder="Enter teacher Father name"
                                                value="{{ old('name', $teacher->father_name) }}">
                                            @error('father_name')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        {{-- teacher's mother name --}}
                                        <div class="form-group col-md-4">
                                            <label for="exampleInput">Teacher's Mother Name</label>
                                            <input type="text" name="mother_name" class="form-control" id="exampleInput"
                                                placeholder="Enter teacher Mother name"
                                                value="{{ old('name', $teacher->mother_name) }}">
                                            @error('mother_name')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        {{-- dob --}}
                                        <div class="form-group col-md-6">
                                            <label for="exampleInput">Date Of Birth</label>
                                            <input type="date" name="dob" class="form-control" id="exampleInput"
                                                value="{{ old('name', $teacher->dob) }}">
                                            @error('dob')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        {{-- mobno --}}
                                        <div class="form-group col-md-6">
                                            <label for="exampleInput">Mobile Number</label>
                                            <input type="text" name="mobno" class="form-control" id="exampleInput"
                                                placeholder="Enter Mobile Number"
                                                value="{{ old('name', $teacher->mobno) }}">
                                            @error('mobno')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        {{-- email addreess --}}
                                        <div class="form-group col-md-6">
                                            <label for="exampleInput">Email Address</label>
                                            <input type="text" name="email" class="form-control" id="exampleInput"
                                                placeholder="Enter Email Address"
                                                value="{{ old('name', $teacher->email) }}">
                                            @error('email')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update teacher</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
