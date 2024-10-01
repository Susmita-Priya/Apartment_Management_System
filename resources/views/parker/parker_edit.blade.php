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
                                    Edit Parker
                                </h1>
                            </div>
                        </div>
                        <form action="{{ route('parker.update', $parker->id) }}" enctype="multipart/form-data" method="POST">
                            @csrf

                            <!-- Parker Number -->
                            <div class="form-group">
                                <label for="parker_no">Parker Number</label>
                                <input type="text" name="parker_no" id="parker_no" class="form-control" readonly value="{{ $parker->parker_no }}" required>
                                <span class="text-danger">
                                    @error('parker_no')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <!-- Stall No -->
                            <div class="form-group">
                                <label for="stall_no">Stall Number</label>
                                <input type="text" name="stall_no" id="stall_no" class="form-control"
                                    value="{{ $vehicle->stall_no ?? 'No Stall Assigned' }}" readonly required>
                                <span class="text-danger">
                                    @error('stall_no')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                             <!-- Parker Name -->
                             <div class="form-group">
                                <label for="name">Parker Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $parker->parker_name }}" required>
                                <span class="text-danger">
                                    @error('name')
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
                                <label for="phn">Phone</label>
                                <input type="text" name="phn" id="phn" class="form-control" value="{{ $parker->phn }}" required>
                                <span class="text-danger">
                                    @error('phn')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            {{-- <!-- Stall Number -->
                            <div class="form-group">
                                <label for="stall_no">Stall Number</label>
                                <select name="stall_no" id="stall_no" class="form-control">
                                    <option value="">No Stall Assigned</option>
                                    @foreach ($stalls as $stall)
                                        <option value="{{ $stall->id }}" {{ $parker->stall_id == $stall->id ? 'selected' : '' }}>
                                            {{ $stall->stall_number }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-danger">
                                    @error('stall_no')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <small class="form-text text-muted">If no stall is selected, the parker will be unassigned from any stall.</small>
                            </div> --}}

                            <!-- Vehicle Status -->
                            <input type="hidden" name="status" value="{{ $parker->status }}" id="status">

                            <button type="submit" class="btn waves-effect waves-light btn-sm submitbtn">Update parker</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('stall_no').addEventListener('change', function() {
            const stallNo = this.value;
            document.getElementById('status').value = stallNo ? 'assigned' : 'not_assigned';
        });
    </script>
@endsection
