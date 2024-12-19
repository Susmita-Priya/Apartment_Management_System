@extends('master')

@section('content')
    @push('title')
        <title>Edit Vehicle</title>
    @endpush

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Edit Vehicle</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('parker.index') }}">Parkers</a></li>
                            <li class="breadcrumb-item active">Edit Parker</li>
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
                                    Edit Parker
                                </h1>
                            </div>
                        </div>
                        <form action="{{ route('parker.update', $parker->id) }}" enctype="multipart/form-data" method="POST">
                            @csrf

                            <!-- Parker No -->
                            <div class="form-group">
                                <label for="parker_no">Parker No</label>
                                <input type="text" name="parker_no" id="parker_no" class="form-control" value="{{ $parker->parker_no }}" readonly>
                                <span class="text-danger">
                                    @error('parker_no')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                             <!-- Parker Name -->
                             <div class="form-group">
                                <label for="full_name">Parker Name</label>
                                <input type="text" name="full_name" id="full_name" class="form-control" value="{{ $parker->full_name }}" required>
                                <span class="text-danger">
                                    @error('full_name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <!-- Parker Email -->
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ $parker->email }}" required>
                                <span class="text-danger">
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <!-- Parker Phone -->
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" name="phone" id="phone" class="form-control" value="{{ $parker->phone }}" required>
                                <span class="text-danger">
                                    @error('phone')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <!-- Stall Number -->
                            <div class="form-group">
                                <label for="stall_no">Stall Number</label>
                                <select name="stall_no" id="stall_no" class="form-control">
                                    <option value="">Select Stall</option>
                                    @foreach ($stalls as $stall)
                                        <option value="{{ $stall->id }}" {{ $parker->stall_no== $stall->id ? 'selected' : '' }}>
                                            Stall - {{ $stall->stall_no }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-danger">
                                    @error('stall_no')
                                        {{ $message }}
                                    @enderror
                                </span>
                               
                            </div>

                            <!-- Vehicle Status -->
                            {{-- <input type="hidden" name="status" value="{{ $parker->status }}" id="status"> --}}

                            <button type="submit" class="btn waves-effect waves-light btn-sm submitbtn">Update parker</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <script>
        document.getElementById('stall_no').addEventListener('change', function() {
            const stallNo = this.value;
            document.getElementById('status').value = stallNo ? 'assigned' : 'not_assigned';
        });
    </script> --}}
@endsection
