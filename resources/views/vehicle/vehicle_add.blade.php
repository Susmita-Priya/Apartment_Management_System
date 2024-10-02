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

                            {{-- <!-- Vehicle Number -->
                            <div class="form-group">
                                <label for="vehicle_no">Vehicle Number</label>
                                <input type="text" name="vehicle_no" id="vehicle_no" class="form-control" required>
                                <span class="text-danger">
                                    @error('vehicle_no')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div> --}}

                            <!-- Vehicle Name -->
                            <div class="form-group">
                                <label for="vehicle_name">Vehicle Name</label>
                                <input type="text" name="vehicle_name" id="vehicle_name" class="form-control" required>
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
                                        <option value="Car">Car</option>
                                        <option value="Bike">Bike</option>
                                    </select>
                                    <div class="input-group-append">
                                        <button type="button" class="submitbtn" id="addVehicleType">+ New Vehicle Type</button>
                                    </div>
                                </div>
                                <span class="text-danger">
                                    @error('vehicle_type')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <!-- Dynamic Vehicle Type Input -->
                            <div id="newVehicleTypeContainer" class="form-group" style="display: none;">
                                <label for="new_vehicle_type">New Vehicle Type</label>
                                <div class="input-group">
                                    <input type="text" id="new_vehicle_type" class="form-control">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-success" id="saveVehicleType"><i class="fa fa-check"></i></button>
                                        <button type="button" class="btn btn-danger" id="removeVehicleType"><i class="fa fa-trash"></i></button>
                                    </div>
                                </div>
                            </div>

                             <!-- Vehicle Image -->
                             <div class="form-group">
                                <label for="vehicle_image">Vehicle Image</label>
                                <input type="file" name="vehicle_image" id="vehicle_image" class="form-control" accept="image/*" required>
                                <span class="text-danger">
                                    @error('vehicle_image')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <img id="imagePreview" src="#" alt="Image Preview" style="display: none; margin-top: 10px; max-width: 200px;">
                            </div>

                            <!-- Owner Name -->
                            <div class="form-group">
                                <label for="owner_name">Owner Name</label>
                                <input type="text" name="owner_name" id="owner_name" class="form-control" required>
                                <span class="text-danger">
                                    @error('owner_name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <!-- Owner Phone -->
                            <div class="form-group">
                                <label for="owner_phn">Owner Phone</label>
                                <input type="text" name="owner_phn" id="owner_phn" class="form-control" required>
                                <span class="text-danger">
                                    @error('owner_phn')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            
                            <!-- Driver Name -->
                            <div class="form-group">
                                <label for="driver_name">Driver Name</label>
                                <input type="text" name="driver_name" id="driver_name" class="form-control" required>
                                <span class="text-danger">
                                    @error('driver_name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <!-- Driver Phone -->
                            <div class="form-group">
                                <label for="driver_phn">Driver Phone</label>
                                <input type="text" name="driver_phn" id="driver_phn" class="form-control" required>
                                <span class="text-danger">
                                    @error('driver_phn')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <!-- Stall Number -->
                            <div class="form-group">
                                <label for="stall_no">Stall Number</label>
                                <input type="text" name="stall_no" id="stall_no" class="form-control" readonly placeholder="vehicle will be assigned to any stall">
                                {{-- <select name="stall_no" id="stall_no" class="form-control">
                                    <option value="">No Stall Assigned</option>
                                    @foreach ($stalls as $stall)
                                        <option value="{{ $stall->id }}">{{ $stall->stall_number }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">
                                    @error('stall_no')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <!-- Show if no stall selected -->
                                <small class="form-text text-muted">If no stall is selected, vehicle will be unassigned to any stall.</small> --}}
                            </div>

                            <!-- Vehicle Status -->
                            <input type="hidden" name="status" value="not_assigned" id="status">

                            <button type="submit" class="btn waves-effect waves-light btn-sm submitbtn">Add Vehicle</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('addVehicleType').addEventListener('click', function() {
            document.getElementById('newVehicleTypeContainer').style.display = 'block';
        });

        document.getElementById('saveVehicleType').addEventListener('click', function() {
            const newVehicleType = document.getElementById('new_vehicle_type').value;

            if (newVehicleType) {
                const vehicleTypeSelect = document.getElementById('vehicle_type');
                const newOption = document.createElement('option');
                newOption.value = newVehicleType;
                newOption.innerText = newVehicleType;
                vehicleTypeSelect.appendChild(newOption);

                vehicleTypeSelect.value = newVehicleType;
                document.getElementById('newVehicleTypeContainer').style.display = 'none';
                document.getElementById('new_vehicle_type').value = '';
            }
        });

        document.getElementById('removeVehicleType').addEventListener('click', function() {
            document.getElementById('newVehicleTypeContainer').style.display = 'none';
            document.getElementById('new_vehicle_type').value = '';
        });

        // Update the vehicle status based on stall selection
        document.getElementById('stall_no').addEventListener('change', function() {
            const stallNo = this.value;
            document.getElementById('status').value = stallNo ? 'assigned' : 'not_assigned';
        });

        // Preview the selected image
        document.getElementById('vehicle_image').addEventListener('change', function(event) {
            const imagePreview = document.getElementById('imagePreview');
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            } else {
                imagePreview.style.display = 'none';
            }
        });
        
    </script>
@endsection
