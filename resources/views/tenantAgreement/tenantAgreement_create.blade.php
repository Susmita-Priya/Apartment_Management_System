@extends('master')

@section('content')
@push('title')
    <title>Tenant Agreement</title>
@endpush

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title float-left">Tenant Agreement</h4>
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Tenant Agreement</li>
                    </ol>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <form action="{{ route('tenant.agreement.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="container mt-5">
                            <div class="col-md-12">
                                <div class="card-box">
                                    <h1 class="d-flex justify-content-center mt-4">TENANT AGREEMENT</h1>

                                    <!-- Landlord Selection -->
                                    <div class="form-group">
                                        <label for="landlord_id" class="col-form-label">Landlord</label>
                                        <select class="form-control" name="landlord_id" id="landlord_id" onchange="filterBuildings()">
                                            <option value="">Select Landlord</option>
                                            @foreach ($landlords as $landlord)
                                                <option value="{{ $landlord->id }}">{{ $landlord->name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger">@error('landlord_id') {{ $message }} @enderror</span>
                                    </div>

                                    <!-- Building Selection -->
                                    <div class="form-group">
                                        <label for="building_id" class="col-form-label">Building</label>
                                        <select class="form-control" name="building_id" id="building_id" onchange="filterFloors()">
                                            <option value="">Select Building</option>
                                        </select>
                                        <span class="text-danger">@error('building_id') {{ $message }} @enderror</span>
                                    </div>

                                    <!-- Floor Selection -->
                                    <div class="form-group">
                                        <label for="floor_id" class="col-form-label">Floor</label>
                                        <select class="form-control" name="floor_id" id="floor_id" onchange="filterUnits()">
                                            <option value="">Select Floor</option>
                                        </select>
                                        <span class="text-danger">@error('floor_id') {{ $message }} @enderror</span>
                                    </div>

                                    <!-- Unit Selection -->
                                    <div class="form-group">
                                        <label for="unit_id" class="col-form-label">Unit</label>
                                        <select class="form-control" name="unit_id" id="unit_id">
                                            <option value="">Select Unit</option>
                                        </select>
                                        <span class="text-danger">@error('unit_id') {{ $message }} @enderror</span>
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

                                    <!-- Rent Input -->
                                    <div class="form-group col-md-12">
                                        <label for="rent" class="col-form-label">Rent</label>
                                        <input type="number" class="form-control" name="rent" id="rent"
                                            placeholder="Enter Rent">
                                        <span class="text-danger">
                                            @error('rent')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>

                                    {{-- rent-advance --}}
                                    <div class="form-group col-md-12">
                                        <label for="rent_advance_received" class="col-form-label">Rent Advance</label>
                                        <input type="number" class="form-control" name="rent_advance_received"
                                            id="rent_advance_received" placeholder="Enter Rent Advance">
                                        <span class="text-danger">
                                            @error('rent_advance_received')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>

                                    <!-- Start Date Input -->
                                    <div class="form-group col-md-12">
                                        <label for="lease_start_date" class="col-form-label">Start Date</label>
                                        <input type="date" class="form-control" name="lease_start_date"
                                            id="lease_start_date">
                                        <span class="text-danger">
                                            @error('start_date')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>

                                    <!-- End Date Input -->
                                    <div class="form-group col-md-12">
                                        <label for="lease_end_date" class="col-form-label">End Date</label>
                                        <input type="date" class="form-control" name="lease_end_date" id="lease_end_date">
                                        <span class="text-danger">
                                            @error('lease_end_date')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>

                                    <!-- Submit Button -->
                                    <button type="submit" class="btn waves-effect waves-light btn-sm submitbtn">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const landlordAgreements = @json($landlordAgreements);

    function filterBuildings() {
        const landlordId = document.getElementById('landlord_id').value;
        const buildings = landlordAgreements
            .filter(agreement => agreement.landlord_id == landlordId)
            .map(agreement => agreement.building)
            .filter((value, index, self) => self.findIndex(v => v.id === value.id) === index); // Remove duplicates

        populateOptions('building_id', buildings);
        clearOptions(['floor_id', 'unit_id']);
    }

    function filterFloors() {
        const buildingId = document.getElementById('building_id').value;
        const floors = landlordAgreements
            .filter(agreement => agreement.building_id == buildingId)
            .map(agreement => agreement.floor)
            .filter((value, index, self) => self.findIndex(v => v.id === value.id) === index); // Remove duplicates

        populateOptions('floor_id', floors);
        clearOptions(['unit_id']);
    }

    function filterUnits() {
        const floorId = document.getElementById('floor_id').value;
        const units = landlordAgreements
            .filter(agreement => agreement.floor_id == floorId)
            .map(agreement => agreement.unit)
            .filter((value, index, self) => self.findIndex(v => v.id === value.id) === index); // Remove duplicates

        populateOptions('unit_id', units);
    }

    function populateOptions(selectId, items) {
        const selectElement = document.getElementById(selectId);
        selectElement.innerHTML = '<option value="">Select Option</option>';
        items.forEach(item => {
            if (item) {
                const displayText = selectId === 'floor_id' 
                    ? `${item.floor_no}${item.floor_no == 1 ? 'st' : (item.floor_no == 2 ? 'nd' : (item.floor_no == 3 ? 'rd' : 'th'))} Floor` 
                    : (item.name || item.unit_no);
                selectElement.innerHTML += `<option value="${item.id}">${displayText}</option>`;
            }
        });
    }

    function clearOptions(selectIds) {
        selectIds.forEach(id => {
            document.getElementById(id).innerHTML = '<option value="">Select Option</option>';
        });
    }
</script>
@endsection
