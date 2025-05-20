@extends('admin.layout')

@section('content')
    {{-- content form --}}
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Teaching Fee Recipient Structure</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <a href="{{ route('fee-structure.read') }}" style="display: inline;">
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
                                <h3 class="card-title">Add Teaching Fee Recipient Structure</h3>
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
                                            <label>Select Fee Recipient</label>
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
                                            <label for="exampleInput">Costs January</label>
                                            <input type="text" name="january" class="form-control" id="exampleInput"
                                                placeholder="Enter Costs january">
                                        </div>

                                        {{-- february --}}
                                        <div class="form-group col-md-4">
                                            <label for="exampleInput">Costs February</label>
                                            <input type="text" name="february" class="form-control" id="exampleInput"
                                                placeholder="Enter Costs february">
                                        </div>

                                        {{-- macrh --}}
                                        <div class="form-group col-md-4">
                                            <label for="exampleInput">Costs March</label>
                                            <input type="text" name="march" class="form-control" id="exampleInput"
                                                placeholder="Enter Costs march">
                                        </div>
                                    </div>

                                    <div class="row">
                                        {{-- april --}}
                                        <div class="form-group col-md-4">
                                            <label for="exampleInput">Costs April</label>
                                            <input type="text" name="april" class="form-control" id="exampleInput"
                                                placeholder="Enter Costs april">
                                        </div>

                                        {{-- may --}}
                                        <div class="form-group col-md-4">
                                            <label for="exampleInput">Costs May</label>
                                            <input type="text" name="may" class="form-control" id="exampleInput"
                                                placeholder="Enter Costs May">
                                        </div>

                                        {{-- june --}}
                                        <div class="form-group col-md-4">
                                            <label for="exampleInput">Costs June</label>
                                            <input type="text" name="june" class="form-control" id="exampleInput"
                                                placeholder="Enter Costs June">
                                        </div>
                                    </div>

                                    <div class="row">
                                        {{-- july --}}
                                        <div class="form-group col-md-4">
                                            <label for="exampleInput">Costs July</label>
                                            <input type="text" name="july" class="form-control" id="exampleInput"
                                                placeholder="Enter Costs July">
                                        </div>

                                        {{-- august --}}
                                        <div class="form-group col-md-4">
                                            <label for="exampleInput">Costs August</label>
                                            <input type="text" name="august" class="form-control" id="exampleInput"
                                                placeholder="Enter Costs august">
                                        </div>

                                        {{-- september --}}
                                        <div class="form-group col-md-4">
                                            <label for="exampleInput">Costs September</label>
                                            <input type="text" name="september" class="form-control"
                                                id="exampleInput" placeholder="Enter Costs september">
                                        </div>
                                    </div>

                                    <div class="row">
                                        {{-- october --}}
                                        <div class="form-group col-md-4">
                                            <label for="exampleInput">Costs October</label>
                                            <input type="text" name="october" class="form-control" id="exampleInput"
                                                placeholder="Enter Costs october">
                                        </div>

                                        {{-- november --}}
                                        <div class="form-group col-md-4">
                                            <label for="exampleInput">Costs November</label>
                                            <input type="text" name="november" class="form-control" id="exampleInput"
                                                placeholder="Enter Costs november">
                                        </div>

                                        {{-- december --}}
                                        <div class="form-group col-md-4">
                                            <label for="exampleInput">Costs December</label>
                                            <input type="text" name="december" class="form-control" id="exampleInput"
                                                placeholder="Enter Costs december">
                                        </div>
                                    </div>
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
