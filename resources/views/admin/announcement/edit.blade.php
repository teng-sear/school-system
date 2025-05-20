@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="m-0 text-dark">Edit Announcement</h1>
                    <a href="{{ route('announcement.read') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left mr-1"></i>
                        Return to List
                    </a>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8 col-lg-6 mx-auto">
                        @if (Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <i class="icon fas fa-check-circle mr-2"></i>
                            {{ Session::get('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        <div class="card card-gradient">
                            <div class="card-header bg-primary">
                                <h3 class="card-title font-weight-bold">
                                    <i class="fas fa-bullhorn mr-1"></i>
                                    Announcement Details
                                </h3>
                            </div>

                            <form action="{{ route('announcement.update', $announcement->id) }}" method="post">
                                @csrf
                                @method('PUT')

                                <div class="card-body">
                                    <!-- Message Input -->
                                    <div class="form-group">
                                        <label for="messageInput" class="form-label">
                                            Announcement Message
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-comment-dots"></i>
                                                </span>
                                            </div>
                                            <input type="text" 
                                                   name="message" 
                                                   id="messageInput"
                                                   class="form-control @error('message') is-invalid @enderror"
                                                   placeholder="Enter your announcement message"
                                                   value="{{ old('message', $announcement->message) }}"
                                                   required>
                                        </div>
                                        @error('message')
                                        <div class="invalid-feedback d-block">
                                            <i class="fas fa-exclamation-circle mr-1"></i>
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <!-- Broadcast To Selection -->
                                    <div class="form-group">
                                        <label for="typeSelect" class="form-label">
                                            Target Audience
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-broadcast-tower"></i>
                                                </span>
                                            </div>
                                            <select name="type" 
                                                    id="typeSelect"
                                                    class="custom-select @error('type') is-invalid @enderror"
                                                    required>
                                                <option value="" disabled>Select Target Audience</option>
                                                <option value="student" {{ $announcement->type === 'student' ? 'selected' : '' }}>
                                                    Students
                                                </option>
                                                <option value="teacher" {{ $announcement->type === 'teacher' ? 'selected' : '' }}>
                                                    Teachers
                                                </option>
                                                <option value="parent" {{ $announcement->type === 'parent' ? 'selected' : '' }}>
                                                    Parents
                                                </option>
                                            </select>
                                        </div>
                                        @error('type')
                                        <div class="invalid-feedback d-block">
                                            <i class="fas fa-exclamation-circle mr-1"></i>
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-success px-4">
                                        <i class="fas fa-save mr-1"></i>
                                        Update Announcement
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('styles')
    <style>
        .card-gradient .card-header {
            background: linear-gradient(45deg, #3c8dbc, #367fa9);
        }
        .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 0.5rem;
        }
        .custom-select {
            border-radius: 0 0.25rem 0.25rem 0;
        }
        .input-group-text {
            background-color: #f8f9fa;
            border-right: none;
        }
        .input-group-prepend + .form-control {
            border-left: none;
        }
    </style>
@endpush