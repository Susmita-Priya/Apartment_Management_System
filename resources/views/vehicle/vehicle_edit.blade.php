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
                            <li class="breadcrumb-item"><a href="{{ route('vehicle.index') }}">Vehicles</a></li>
                            <li class="breadcrumb-item active">Edit Vehicle</li>
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
                                    Edit Vehicle
                                </h1>
                            </div>
                        </div>
                        <form action="{{ route('vehicle.update', $vehicle->id) }}" enctype="multipart/form-data"
                            method="POST">
                            @csrf
                            
                            <div class="form-group">
                                <label for="stall_id">Stall</label>
                                <select class="form-control" id="stall_id" name="stall_id">
                                    <option value="">Select Stall</option>
                                    @foreach($stalls as $stall)
                                        <option value="{{ $stall->id }}" {{ $vehicle->stall_id == $stall->id ? 'selected' : '' }}>{{ $stall->stall_no }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="vehicle_type_id">Vehicle Type</label>
                                <select class="form-control" id="vehicle_type_id" name="vehicle_type_id">
                                    <option value="">Select Vehicle Type</option>
                                    @foreach($vehicleTypes as $vehicleType)
                                        <option value="{{ $vehicleType->id }}" {{ $vehicle->vehicle_type_id == $vehicleType->id ? 'selected' : '' }}>{{ $vehicleType->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="vehicle_owner_id">Vehicle Owner</label>
                                <select class="form-control" id="vehicle_owner_id" name="vehicle_owner_id">
                                    <option value="">Select Vehicle Owner</option>
                                    @foreach($vehicleOwners as $vehicleOwner)
                                        <option value="{{ $vehicleOwner->id }}" {{ $vehicle->vehicle_owner_id == $vehicleOwner->id ? 'selected' : '' }}>{{ $vehicleOwner->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="model">Model</label>
                                <input type="text" class="form-control" id="model" name="model" value="{{ $vehicle->model }}" required placeholder="Enter Model (e.g. Toyota)">
                            </div>

                            <div class="form-group">
                                <label for="registration_no">Registration Number</label>
                                <input type="text" class="form-control" id="registration_no" name="registration_no" value="{{ $vehicle->registration_no }}" required placeholder="Enter Registration Number (e.g. DHAKA-5678)">
                            </div>

                            <div class="form-group">
                                <label for="vehicle_image">Vehicle Image</label>
                                <input type="file" class="form-control" id="vehicle_image" name="vehicle_image">
                                <span class="text-danger">
                                    @error('vehicle_image')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="form-group">
                                <label for="vehicle_image">Previous Image</label>
                                @if ($vehicle->vehicle_image)
                                    <div>
                                        <img src="{{ asset($vehicle->vehicle_image) }}" alt="Vehicle Image"
                                            style="max-width: 200px; max-height: 200px;">
                                    </div>
                                @else
                                    <p>No image uploaded.</p>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for = "status">Status</label>
                                <select class="form-control" name="status" id="status">
                                    <option value="">Select Status</option>
                                    <option value="1" {{ $vehicle->status == '1' ? 'selected' : '' }}>Stored</option>
                                    <option value="0" {{ $vehicle->status == '0' ? 'selected' : '' }}>Not Stored</option>
                                </select>
                                <span class="text-danger">
                                    @error('status')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            

                            <button type="submit" class="btn waves-effect waves-light btn-sm submitbtn">Update
                                Vehicle</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection



