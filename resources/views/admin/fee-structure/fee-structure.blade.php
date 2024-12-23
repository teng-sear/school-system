@extends('admin.layout')

@section('content')
    {{-- content form --}}
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Fee Structure</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Fee Structure</li>
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
                                <h3 class="card-title">Add Fee Structure</h3>
                            </div>

                            <form action="{{ route('fee-structure.store') }}" method="post">

                                @csrf

                                <div class="card-body">

                                    <div class="row">
                                        {{-- select class --}}
                                        <div class="form-group col-md-4">
                                            <label>Select Class</label>
                                            <select name="class_id" class="form-control">
                                                <option value="">Select Class</option>
                                                @foreach ($classes as $class)
                                                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('class_id')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        {{-- select academic_years --}}
                                        <div class="form-group col-md-4">
                                            <label>Select Academic Years</label>
                                            <select name="academic_year_id" class="form-control">
                                                <option value="">Select Academic Years</option>
                                                @foreach ($academic_years as $academic_year)
                                                    <option value="{{ $academic_year->id }}">{{ $academic_year->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('academic_year_id')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        {{-- select fee_heads --}}
                                        <div class="form-group col-md-4">
                                            <label>Select Fee Head</label>
                                            <select name="fee_head_id" class="form-control">
                                                <option value="" disabled selected>Select Fee Head</option>
                                                @foreach ($fee_heads as $fee_head)
                                                    <option value="{{ $fee_head->id }}">{{ $fee_head->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('fee_head_id')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <hr class="h-4 bg-black border-none">

                                    <div class="row">
                                        {{-- january --}}
                                        <div class="form-group col-md-4">
                                            <label for="exampleInput">Januari Fee</label>
                                            <input type="text" name="january" class="form-control" id="exampleInput"
                                                placeholder="Enter january Fee">
                                        </div>

                                        {{-- february --}}
                                        <div class="form-group col-md-4">
                                            <label for="exampleInput">Februari Fee</label>
                                            <input type="text" name="february" class="form-control" id="exampleInput"
                                                placeholder="Enter february Fee">
                                        </div>

                                        {{-- macrh --}}
                                        <div class="form-group col-md-4">
                                            <label for="exampleInput">Maret Fee</label>
                                            <input type="text" name="macrh" class="form-control" id="exampleInput"
                                                placeholder="Enter macrh Fee">
                                        </div>
                                    </div>

                                    <div class="row">
                                        {{-- april --}}
                                        <div class="form-group col-md-4">
                                            <label for="exampleInput">April Fee</label>
                                            <input type="text" name="april" class="form-control" id="exampleInput"
                                                placeholder="Enter April Fee">
                                        </div>

                                        {{-- may --}}
                                        <div class="form-group col-md-4">
                                            <label for="exampleInput">Mei Fee</label>
                                            <input type="text" name="may" class="form-control" id="exampleInput"
                                                placeholder="Enter may Fee">
                                        </div>

                                        {{-- june --}}
                                        <div class="form-group col-md-4">
                                            <label for="exampleInput">Juni Fee</label>
                                            <input type="text" name="june" class="form-control" id="exampleInput"
                                                placeholder="Enter june Fee">
                                        </div>
                                    </div>

                                    <div class="row">
                                        {{-- july --}}
                                        <div class="form-group col-md-4">
                                            <label for="exampleInput">Juli Fee</label>
                                            <input type="text" name="july" class="form-control" id="exampleInput"
                                                placeholder="Enter july Fee">
                                        </div>

                                        {{-- august --}}
                                        <div class="form-group col-md-4">
                                            <label for="exampleInput">Agustus Fee</label>
                                            <input type="text" name="august" class="form-control" id="exampleInput"
                                                placeholder="Enter august Fee">
                                        </div>

                                        {{-- september --}}
                                        <div class="form-group col-md-4">
                                            <label for="exampleInput">September Fee</label>
                                            <input type="text" name="september" class="form-control"
                                                id="exampleInput" placeholder="Enter september Fee">
                                        </div>
                                    </div>

                                    <div class="row">
                                        {{-- october --}}
                                        <div class="form-group col-md-4">
                                            <label for="exampleInput">October Fee</label>
                                            <input type="text" name="october" class="form-control" id="exampleInput"
                                                placeholder="Enter october Fee">
                                        </div>

                                        {{-- november --}}
                                        <div class="form-group col-md-4">
                                            <label for="exampleInput">November Fee</label>
                                            <input type="text" name="november" class="form-control" id="exampleInput"
                                                placeholder="Enter november Fee">
                                        </div>

                                        {{-- december --}}
                                        <div class="form-group col-md-4">
                                            <label for="exampleInput">Desember Fee</label>
                                            <input type="text" name="december" class="form-control" id="exampleInput"
                                                placeholder="Enter december Fee">
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Add Fee Structure</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
