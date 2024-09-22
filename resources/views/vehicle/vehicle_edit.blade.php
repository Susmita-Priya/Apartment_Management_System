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
                        <form action="{{ route('vehicle.update', $vehicle->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Vehicle Number -->
                            <div class="form-group">
                                <label for="vehicle_no">Vehicle Number</label>
                                <input type="text" name="vehicle_no" id="vehicle_no" class="form-control" value="{{ $vehicle->vehicle_no }}" required>
                                <span class="text-danger">
                                    @error('vehicle_no')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <!-- Vehicle Name -->
                            <div class="form-group">
                                <label for="vehicle_name">Vehicle Name</label>
                                <input type="text" name="vehicle_name" id="vehicle_name" class="form-control" value="{{ $vehicle->vehicle_name }}" required>
                                <span class="text-danger">
                                    @error('vehicle_name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <!-- Vehicle Type -->
                            <div class="form-group">
                                <label for="vehicle_type">Vehicle Type</label>
                                <div class="input-group">
                                    <select name="vehicle_type" id="vehicle_type" class="form-control" required>
                                        <option value="Car" {{ $vehicle->vehicle_type == 'Car' ? 'selected' : '' }}>Car</option>
                                        <option value="Bike" {{ $vehicle->vehicle_type == 'Bike' ? 'selected' : '' }}>Bike</option>
                                    </select>
                                </div>
                                <span class="text-danger">
                                    @error('vehicle_type')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <!-- Owner Name -->
                            <div class="form-group">
                                <label for="owner_name">Owner Name</label>
                                <input type="text" name="owner_name" id="owner_name" class="form-control" value="{{ $vehicle->owner_name }}" required>
                                <span class="text-danger">
                                    @error('owner_name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <!-- Stall Number -->
                            <div class="form-group">
                                <label for="stall_no">Stall Number</label>
                                <select name="stall_id" id="stall_no" class="form-control">
                                    <option value="">No Stall Assigned</option>
                                    @foreach ($stalls as $stall)
                                        <option value="{{ $stall->id }}" {{ $vehicle->stall_id == $stall->id ? 'selected' : '' }}>
                                            {{ $stall->stall_number }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-danger">
                                    @error('stall_id')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <small class="form-text text-muted">If no stall is selected, the vehicle will be unassigned from any stall.</small>
                            </div>

                            <!-- Vehicle Status -->
                            <input type="hidden" name="status" value="{{ $vehicle->status }}" id="status">

                            <button type="submit" class="btn waves-effect waves-light btn-sm submitbtn">Update Vehicle</button>
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
