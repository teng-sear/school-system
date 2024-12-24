@extends('admin.layout')

@section('content')
    {{-- content form --}}
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Announcement</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Announcement Management</li>
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
                                <h3 class="card-title">Edit Announcement</h3>
                            </div>

                            {{-- metode default HTML hanya mendukung GET dan POST --}}
                            <form action="{{ route('announcement.update', $announcement->id) }}" method="post">
                                @csrf
                                @method('PUT') <!-- Mengubah metode menjadi PUT -->

                                {{-- <input type="hidden" name="id" value="{{ $announcement->id }}"> --}}

                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInput">Message</label>
                                        <input type="text" name="message" class="form-control" id="exampleInput"
                                            placeholder="Enter Message" value="{{ $announcement->message }}">
                                        @error('message')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    {{-- broadcast to --}}
                                    <div class="form-group">
                                        <label for="exampleInput">Broadcast To</label>
                                        <select name="type" id="" class="form-control">
                                            <option value="" disabled
                                                {{ $announcement->type === null ? 'selected' : '' }}>Select List
                                            </option>
                                            <option value="student"
                                                {{ $announcement->type === 'student' ? 'selected' : '' }}>student
                                            </option>
                                            <option value="teacher"
                                                {{ $announcement->type === 'teacher' ? 'selected' : '' }}>teacher
                                            </option>
                                            <option value="parent" {{ $announcement->type === 'parent' ? 'selected' : '' }}>
                                                parent</option>
                                        </select>
                                        @error('type')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update Announcement</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
