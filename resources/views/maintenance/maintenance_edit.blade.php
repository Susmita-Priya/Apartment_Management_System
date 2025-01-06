@extends('master')

@section('content')
    @push('title')
        <title>Edit Maintenance Request</title>
    @endpush

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Edit Maintenance Request</h4>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('maintenance.index') }}">Maintenance Requests</a></li>
                            <li class="breadcrumb-item active">Edit Maintenance Request</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <form action="{{ route('maintenance.update', $maintenance->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="container mt-5">
                                <div class="col-md-12">
                                    <div class="card-box">
                                        <h1 class="d-flex justify-content-center mt-4">EDIT MAINTENANCE REQUEST</h1>
                                        <div class="form-row">
                                            <!-- status -->
                                            <div class="form-group
                                                col-md-12">
                                                <label for="status" class="col-form-label">Status</label>
                                                <select class="form-control" name="status" id="status">
                                                    <option value="">Select Status</option>
                                                    <option value=0 {{ $maintenance->status == 0 ? 'selected' : '' }}>Pending</option>
                                                    <option value=1 {{ $maintenance->status == 1 ? 'selected' : '' }}>In Progress</option>
                                                    <option value=2 {{ $maintenance->status == 2 ? 'selected' : '' }}>Completed</option>
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