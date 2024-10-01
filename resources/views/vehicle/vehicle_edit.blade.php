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
                            <!-- Vehicle Number -->
                            <div class="form-group">
                                <label for="vehicle_no">Vehicle Number</label>
                                <input type="text" name="vehicle_no" id="vehicle_no" class="form-control" readonly
                                    value="{{ $vehicle->vehicle_no }}" required>
                                <span class="text-danger">
                                    @error('vehicle_no')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <!-- Stall No -->
                            <div class="form-group">
                                <label for="stall_no">Stall Number</label>
                                <input type="text" name="stall_no" id="stall_no" class="form-control"
                                    value="{{ $vehicle->stall_no ?? null }}" readonly>
                                <span class="text-danger">
                                    @error('stall_no')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <!-- Vehicle Name -->
                            <div class="form-group">
                                <label for="vehicle_name">Vehicle Name</label>
                                <input type="text" name="vehicle_name" id="vehicle_name" class="form-control"
                                    value="{{ $vehicle->vehicle_name }}" required>
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
                                        <option value="Car" {{ $vehicle->vehicle_type == 'Car' ? 'selected' : '' }}>Car
                                        </option>
                                        <option value="Bike" {{ $vehicle->vehicle_type == 'Bike' ? 'selected' : '' }}>
                                            Bike</option>
                                    </select>
                                </div>
                                <span class="text-danger">
                                    @error('vehicle_type')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <!-- Previous Image -->
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

                            <!-- New Image Upload -->
                            <div class="form-group">
                                <label for="vehicle_image">Change Vehicle Image</label>
                                <input type="file" name="vehicle_image" id="vehicle_image" class="form-control">
                                <span class="text-danger">
                                    @error('vehicle_image')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <!-- Owner Name -->
                            <div class="form-group">
                                <label for="owner_name">Owner Name</label>
                                <input type="text" name="owner_name" id="owner_name" class="form-control"
                                    value="{{ $vehicle->owner_name }}" required>
                                <span class="text-danger">
                                    @error('owner_name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <!-- Owner Phone -->
                            <div class="form-group">
                                <label for="owner_phn">Owner Phone</label>
                                <input type="text" name="owner_phn" id="owner_phn" class="form-control"
                                    value="{{ $vehicle->owner_phn }}" required>
                                <span class="text-danger">
                                    @error('owner_phn')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <!-- Driver Name -->
                            <div class="form-group">
                                <label for="driver_name">Driver Name</label>
                                <input type="text" name="driver_name" id="driver_name" class="form-control"
                                    value="{{ $vehicle->driver_name }}" required>
                                <span class="text-danger">
                                    @error('driver_name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <!-- Driver Phone -->
                            <div class="form-group">
                                <label for="driver_phn">Driver Phone</label>
                                <input type="text" name="driver_phn" id="driver_phn" class="form-control"
                                    value="{{ $vehicle->driver_phn }}" required>
                                <span class="text-danger">
                                    @error('driver_phn')
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
                                        <option value="{{ $stall->id }}" {{ $vehicle->stall_no == $stall->id ? 'selected' : '' }}>
                                            {{ $vehicle->stall_no }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-danger">
                                    @error('stall_no')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <small class="form-text text-muted">If no stall is selected, the vehicle will be unassigned from any stall.</small>
                            </div> --}}

                            <!-- Vehicle Status -->
                            <input type="hidden" name="status" value="{{ $vehicle->status }}" id="status">

                            <button type="submit" class="btn waves-effect waves-light btn-sm submitbtn">Update
                                Vehicle</button>
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

        // // Preview the selected image
        // document.getElementById('vehicle_image').addEventListener('change', function(event) {
        //     const imagePreview = document.getElementById('imagePreview');
        //     const file = event.target.files[0];

        //     if (file) {
        //         const reader = new FileReader();
        //         reader.onload = function(e) {
        //             imagePreview.src = e.target.result;
        //             imagePreview.style.display = 'block';
        //         }
        //         reader.readAsDataURL(file);
        //     } else {
        //         imagePreview.style.display = 'none';
        //     }
        // });
    </script>
@endsection
