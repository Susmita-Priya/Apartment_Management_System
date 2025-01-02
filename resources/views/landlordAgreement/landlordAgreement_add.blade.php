@extends('master')

@section('content')
    @push('title')
        <title>Landlord Agreement</title>
    @endpush

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Landlord Agreement</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Landlord Agreement</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <form action="{{ route('landlord.agreement.store') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="container mt-5">
                                <div class="col-md-12">
                                    <div class="card-box">
                                        <h1 class="d-flex justify-content-center mt-4">LANDLORD AGREEMENT</h1>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="landlord_id" class="col-form-label">Landlord</label>
                                                <select class="form-control" name="landlord_id" id="landlord_id">
                                                    <option value="">Select Landlord</option>
                                                    @foreach ($landlords as $lndlrd)
                                                        <option value="{{ $lndlrd->id }}"
                                                            {{ $lndlrd && $lndlrd->id == ($landlord->id ?? '') ? 'selected' : '' }}>
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
                                                            {{ $cmpny && $cmpny->id == ($company->id ?? '') ? 'selected' : '' }}>
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
                                                <select name="building_id" id="building_id" class="form-control"
                                                    onchange="showBuildingDetails()">
                                                    <option value="">Select Building</option>
                                                    @foreach ($buildings as $bldg)
                                                        <option value="{{ $bldg->id }}">{{ $bldg->name }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="text-danger">
                                                    @error('building_id')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>

                                            <!-- Floor Selection -->
                                            <div class="form-group col-md-12">
                                                <label for="floor_id">Floor</label>
                                                <select name="floor_id" id="floor_id" class="form-control"
                                                    onchange="showFloorDetails()">
                                                    <option value="">Select Floor</option>
                                                </select>
                                                <span class="text-danger">
                                                    @error('floor_id')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>

                                            <!-- Unit Selection -->
                                            <div class="form-group col-md-12">
                                                <label for="unit_id">Unit</label>
                                                <select name="unit_id" id="unit_id" class="form-control"
                                                    onchange="showUnitDetails()">
                                                    <option value="">Select Unit</option>
                                                </select>
                                                <span class="text-danger">
                                                    @error('unit_id')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>

                                            <!-- Document Upload -->
                                            <div class="form-group col-md-12">
                                                <label for="document" class="col-form-label">Document</label>
                                                <input type="file" class="form-control" name="document" id="document">
                                                <span class="text-danger">
                                                    @error('document')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>

                                            <!-- Amount Input -->
                                            <div class="form-group col-md-12">
                                                <label for="amount" class="col-form-label">Amount</label>
                                                <input type="number" class="form-control" name="amount" id="amount"
                                                    placeholder="Enter Amount">
                                                <span class="text-danger">
                                                    @error('amount')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>

                                            <!-- Submit Button -->
                                            <button type="submit"
                                                class="btn waves-effect waves-light btn-sm submitbtn">Done</button>
                                        </div>
                                    </div>

                        </form>
                    </div>
                </div>
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
                const suffix = (floor.floor_no % 10 == 1 && floor.floor_no % 100 != 11) ? 'st' :
                               (floor.floor_no % 10 == 2 && floor.floor_no % 100 != 12) ? 'nd' :
                               (floor.floor_no % 10 == 3 && floor.floor_no % 100 != 13) ? 'rd' : 'th';
                floorSelect.innerHTML +=
                    `<option value="${floor.id}">${floor.floor_no}<sup>${suffix}</sup> (${floor.type})</option>`;
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
