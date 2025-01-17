@extends('admin.layout')

@section('content')
    {{-- content form --}}
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Tahun Akademik</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <a href="{{ route('academic-year.read') }}" style="display: inline;">
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
                                <h3 class="card-title">Add Tahun Akademik</h3>
                            </div>

                            {{-- tahun akademik --}}
                            <form action="{{ route('academic-year.store') }}" method="post">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="tahunAkademik">Tahun Akademik</label>
                                        <input type="text" name="tahunAkademik" class="form-control" id="tahunAkademik"
                                            placeholder="Misal: 2023/2024">
                                    </div>
                                    @error('tahunAkademik')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

{{-- custom js component --}}
{{-- @section('customJs')
    <script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
@endsection --}}
