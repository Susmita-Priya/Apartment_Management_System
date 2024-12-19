@extends('master')

@section('content')
    @push('title')
        <title>Add Parker</title>
    @endpush

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Add Parker</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('parker.index') }}">Parkers</a></li>
                            <li class="breadcrumb-item active">Add Parker</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <div class="card-head">
                            <div class="kt-portlet__head-label">
                                <h1 class="text-center">
                                    Add New Parker
                                </h1>
                            </div>
                        </div>
                        <form action="{{ route('parker.store') }}" enctype="multipart/form-data" method="POST">
                            @csrf

                            {{-- parker no
                            <div class="form-group">
                                <label for="parker_no">Parker No</label>
                                <input type="text" name="parker_no" id="parker_no" class="form-control" required placeholder="Enter parker no(eg. P0001)">
                                <span class="text-danger">
                                    @error('parker_no')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div> --}}

                            <!-- Parker Name -->
                            <div class="form-group">
                                <label for="full_name">Full Name</label>
                                <input type="text" name="full_name" id="full_name" class="form-control" required placeholder="Enter full name">
                                <span class="text-danger">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <!-- Parker Email -->
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" required placeholder="Enter email">
                                <span class="text-danger">
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <!-- Parker Phone -->
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" name="phone" id="phone" class="form-control" required placeholder="Enter phone number">
                                <span class="text-danger">
                                    @error('phn')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <!-- Stall Number -->
                            <div class="form-group">
                                <label for="stall_no">Stall Number</label>
                                {{-- <input type="text" name="stall_no" id="stall_no" class="form-control"> --}}
                                <select name="stall_no" id="stall_no" class="form-control">
                                    <option value="">Select Stall</option>
                                    @foreach ($stalls as $stall)
                                        <option value="{{ $stall->id }}">{{ $stall->stall_no }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">
                                    @error('stall_no')
                                        {{ $message }}
                                    @enderror
                                </span>
                            {{--     <!-- Show if no stall selected -->
                                <small class="form-text text-muted">If no stall is selected, vehicle will be unassigned to any stall.</small> --}}
                            </div>

                            <!-- Parker Status -->
                            {{-- <input type="hidden" name="status" value="not_assigned" id="status"> --}}

                            <button type="submit" class="btn waves-effect waves-light btn-sm submitbtn">Add Parker</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
