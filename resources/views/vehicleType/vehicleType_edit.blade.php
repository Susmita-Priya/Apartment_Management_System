@extends('master')

@section('content')
    @push('title')
        <title>Edit Vehicle Type</title>
    @endpush

    <div class="content">
        <div class="container-fluid">
            <!-- Breadcrumb -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Edit Vehicle Type</h4>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('vehicleType.index') }}">Vehicle Type List</a></li>
                            <li class="breadcrumb-item active">Edit Vehicle Type</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <!-- Asset Form -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card-box">
                        <form action="{{ route('vehicleType.update',$vehicleType->id) }}" enctype="multipart/form-data" method="POST">
                            @csrf

                            <div class="col-md-12">
                                <div class="card-box">
                                    <h1 class="d-flex justify-content-center mt-4">EDIT VEHICLE TYPE</h1>
    
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="name" class="col-form-label">Name</label>
                                            <input type="text" class="form-control" name="name" id="name"
                                                value="{{ $vehicleType->name }}">
                                            <span class="text-danger">
                                                @error('name')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <input type="text" id="description" name="description" value="{{ $vehicleType->description }}"
                                               class="form-control" placeholder="Enter short description">
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="status" class="col-form-label">Status</label>
                                            <select class="form-control" name="status" id="status">
                                                <option value="">Select Status</option>
                                                <option value="1" {{ $vehicleType->status == '1' ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ $vehicleType->status == '0' ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                            <span class="text-danger">
                                                @error('status')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
    
                                    <button type="submit" class="btn waves-effect waves-light btn-sm submitbtn">
                                        Edit Vehicle Type
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
