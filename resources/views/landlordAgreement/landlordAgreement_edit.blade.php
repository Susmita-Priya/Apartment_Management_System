@extends('master')

@section('content')
    @push('title')
        <title>Edit Landlord Agreement</title>
    @endpush

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Edit Landlord Agreement</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('landlord.agreement.index') }}">Landlord Agreement</a></li>
                            <li class="breadcrumb-item active">Edit Landlord Agreement</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <form action="{{ route('landlord.agreement.update', $landlordAgreement->id) }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="container mt-5">
                                <div class="col-md-12">
                                    <div class="card-box">
                                        <h1 class="d-flex justify-content-center mt-4">EDIT LANDLORD AGREEMENT</h1>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="landlord_id" class="col-form-label">Landlord</label>
                                                <select class="form-control" name="landlord_id" id="landlord_id">
                                                    <option value="">Select Landlord</option>
                                                    @foreach ($landlords as $lndlrd)
                                                        <option value="{{ $lndlrd->id }}"
                                                            {{ $lndlrd->id == $landlordAgreement->landlord_id ? 'selected' : '' }}>
                                                            {{ $lndlrd->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <span class="text-danger">
                                                    @error('landlord_id')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="company_id" class="col-form-label">Company</label>
                                                <select class="form-control" name="company_id" id="company_id">
                                                    <option value="">Select Company</option>
                                                    @foreach ($companies as $cmpny)
                                                        <option value="{{ $cmpny->id }}"
                                                            {{ $cmpny->id == $landlordAgreement->company_id ? 'selected' : '' }}>
                                                            {{ $cmpny->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <span class="text-danger">
                                                    @error('company_id')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                            <!-- Building Selection -->
                                            <div class="form-group col-md-12">
                                                <label for="building_id">Building</label>
                                                <select name="building_id" id="building_id" class="form-control" onchange="showBuildingDetails()">
                                                    <option value="">Select Building</option>
                                                    @foreach ($buildings as $bldg)
                                                        <option value="{{ $bldg->id }}" {{ $bldg->id == $landlordAgreement->building_id ? 'selected' : '' }}>{{ $bldg->name }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="text-danger">
                                                    @error('building_id') {{ $message }} @enderror
                                                </span>
                                            </div>

                                            <!-- Floor Selection -->
                                            <div class="form-group col-md-12">
                                                <label for="floor_id">Floor</label>
                                                <select name="floor_id" id="floor_id" class="form-control" onchange="showFloorDetails()">
                                                    <option value="">Select Floor</option>
                                                @php
                                                 $suffix =
                                                $landlordAgreement->floor_no == 1
                                                    ? 'st'
                                                    : ($landlordAgreement->floor_no == 2
                                                        ? 'nd'
                                                        : ($landlordAgreement->floor_no == 3
                                                            ? 'rd'
                                                            : 'th'));
                                                @endphp
                                                    @foreach ($floors as $floor)

                                                        <option value="{{ $floor->id }}" {{ $floor->id == $landlordAgreement->floor_id ? 'selected' : '' }}>{{ $floor->floor_no }}{{ $suffix }} ({{ $floor->type }})</option>
                                                    @endforeach
                                                </select>
                                                <span class="text-danger">
                                                    @error('floor_id') {{ $message }} @enderror
                                                </span>
                                            </div>

                                            <!-- Unit Selection -->
                                            <div class="form-group col-md-12">
                                                <label for="unit_id">Unit</label>
                                                <select name="unit_id" id="unit_id" class="form-control">
                                                    <option value="">Select Unit</option>
                                                    @foreach ($units as $unit)
                                                        <option value="{{ $unit->id }}" {{ $unit->id == $landlordAgreement->unit_id ? 'selected' : '' }}>Unit-{{ $unit->unit_no }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="text-danger">
                                                    @error('unit_id') {{ $message }} @enderror
                                                </span>
                                            </div>

                                            <!-- Document Upload -->
                                            <div class="form-group col-md-12">
                                                <label for="document" class="col-form-label">Document</label>
                                                <input type="file" class="form-control" name="document" id="document">
                                                <span class="text-danger">
                                                    @error('document') {{ $message }} @enderror
                                                </span>
                                            </div>

                                            <!-- Amount Input -->
                                            <div class="form-group col-md-12">
                                                <label for="amount" class="col-form-label">Amount</label>
                                                <input type="number" class="form-control" name="amount" id="amount" value="{{ $landlordAgreement->amount }}" placeholder="Enter Amount">
                                                <span class="text-danger">
                                                    @error('amount') {{ $message }} @enderror
                                                </span>
                                            </div>

                                            {{-- status --}}
                                            <div class="form-group col-md-12">
                                                <label for="status" class="col-form-label">Status</label>
                                                <select class="form-control" name="status" id="status">
                                                    <option value="">Select Status</option>
                                                    <option value="1" {{ $landlordAgreement->status == 1 ? 'selected' : '' }}>Active</option>
                                                    <option value="0" {{ $landlordAgreement->status == 0 ? 'selected' : '' }}>Inactive</option>
                                                </select>
                                                <span class="text-danger">
                                                    @error('status')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>

                                            <!-- Submit Button -->
                                            <button type="submit" class="btn waves-effect waves-light btn-sm submitbtn">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            const buildings = @json($buildings);
            const floors = @json($floors);
            const units = @json($units);

            function showBuildingDetails() {
                const selectedBuildingId = document.getElementById('building_id').value;
                const buildingFloors = floors.filter(f => f.building_id == selectedBuildingId);

                const floorSelect = document.getElementById('floor_id');
                floorSelect.innerHTML = '<option value="">Select Floor</option>';

                buildingFloors.forEach(floor => {
                    let suffix = 'th';
                    if (floor.floor_no == 1) {
                        suffix = 'st';
                    } else if (floor.floor_no == 2) {
                        suffix = 'nd';
                    } else if (floor.floor_no == 3) {
                        suffix = 'rd';
                    } else {
                        suffix = 'th'; // For all other cases
                    }
                    floorSelect.innerHTML += `<option value="${floor.id}">${floor.floor_no}<sup>${suffix}</sup> (${floor.type})</option>`;
                });
            }

            function showFloorDetails() {
                const selectedFloorId = document.getElementById('floor_id').value;
                const floorUnits = units.filter(u => u.floor_id == selectedFloorId);

                const unitSelect = document.getElementById('unit_id');
                unitSelect.innerHTML = '<option value="">Select Unit</option>';

                floorUnits.forEach(unit => {
                    unitSelect.innerHTML += `<option value="${unit.id}">Unit-${unit.unit_no}</option>`;
                });
            }
        </script>
    @endsection