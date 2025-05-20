@extends('student.layout')

@section('content')
    {{-- content form --}}
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Change Password</h1>
                    </div>

                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">

                            {{-- alert sukses --}}
                            @if (Session::has('success'))
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                </div>
                            @endif

                            {{-- alert gagal --}}
                            @if (Session::has('error'))
                                <div class="alert alert-danger">
                                    {{ Session::get('error') }}
                                </div>
                            @endif

                            <div class="card-header">
                                <h3 class="card-title">Update Password</h3>
                            </div>

                            <form action="{{ route('student.update-password') }}" method="post">

                                @csrf

                                <div class="card-body row">

                                    {{-- old password --}}
                                    <div class="form-group col-md-4">
                                        <label for="exampleInput">Old Password</label>
                                        <input type="password" name="old_password" class="form-control" id="exampleInput"
                                            placeholder="Enter Password old">
                                        @error('old_password')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    {{-- new password --}}
                                    <div class="form-group col-md-4">
                                        <label for="exampleInput">New Password</label>
                                        <input type="password" name="new_password" class="form-control" id="exampleInput"
                                            placeholder="Enter Password New">
                                        @error('new_password')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    {{-- confirm password --}}
                                    <div class="form-group col-md-4">
                                        <label for="exampleInput">Confirm Password</label>
                                        <input type="password" name="confirm_password" class="form-control"
                                            id="exampleInput" placeholder="Enter Confirm Password">
                                        @error('confirm_password')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>


                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary text-sm">Change Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
