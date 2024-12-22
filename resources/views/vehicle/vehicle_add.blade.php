@extends('master')

@section('content')
    @push('title')
        <title>Add Vehicle</title>
    @endpush

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Add Vehicle</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('vehicle.index') }}">Vehicles</a></li>
                            <li class="breadcrumb-item active">Add Vehicle</li>
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
                                    Add New Vehicle
                                </h1>
                            </div>
                        </div>
                        <form action="{{ route('vehicle.store') }}" enctype="multipart/form-data" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="stall_id">Stall</label>
                                <select class="form-control" id="stall_id" name="stall_id">
                                    <option value="">Select Stall</option>
                                    @foreach($stalls as $stall)
                                        <option value="{{ $stall->id }}">{{ $stall->stall_no }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="vehicle_type_id">Vehicle Type</label>
                                <select class="form-control" id="vehicle_type_id" name="vehicle_type_id">
                                    <option value="">Select Vehicle Type</option>
                                    @foreach($vehicleTypes as $vehicleType)
                                        <option value="{{ $vehicleType->id }}">{{ $vehicleType->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="vehicle_owner_id">Vehicle Owner</label>
                                <select class="form-control" id="vehicle_owner_id" name="vehicle_owner_id">
                                    <option value="">Select Vehicle Owner</option>
                                    @foreach($vehicleOwners as $vehicleOwner)
                                        <option value="{{ $vehicleOwner->id }}">{{ $vehicleOwner->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="model">Model</label>
                                <input type="text" class="form-control" id="model" name="model" required placeholder="Enter Model (e.g. Toyota)">
                            </div>

                            <div class="form-group">
                                <label for="registration_no">Registration Number</label>
                                <input type="text" class="form-control" id="registration_no" name="registration_no" required placeholder="Enter Registration Number (e.g. DHAKA-5678)">
                            </div>

                            <div class="form-group">
                                <label for="vehicle_image">Vehicle Image</label>
                                <input type="file" class="form-control" id="vehicle_image" name="vehicle_image">
                            </div>

                            <button type="submit" class="btn waves-effect waves-light btn-sm submitbtn">Add Vehicle</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
