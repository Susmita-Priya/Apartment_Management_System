@extends('master')

@section('content')
    @push('title')
        <title>Edit Floor</title>
    @endpush

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Edit Floor</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('building') }}">Buildings</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('block.index') }}">Blocks</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('floor.index') }}">Floors</a></li>
                            <li class="breadcrumb-item active">Edit Floor</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <form action="{{ route('floor.update', $floor->id) }}" enctype="multipart/form-data" method="POST">
                            @csrf

                            <!-- Building Selection -->
                            <div class="form-group">
                                <label for="building_id">Building</label>
                                <select name="building_id" id="building_id" class="form-control"
                                    onchange="showBuildingDetails()">
                                    <option value="">Select Building</option>
                                    @foreach ($buildings as $bldg)
                                        <option value="{{ $bldg->id }}"
                                            {{ $building->id == $bldg->id ? 'selected' : '' }}>
                                            {{ $bldg->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-danger">
                                    @error('building_id')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <!-- Block Selection -->
                            <div class="form-group">
                                <label for="block_id">Block</label>
                                <select name="block_id" id="block_id" class="form-control" onchange="showBlockDetails()">
                                    <option value="">Select Block</option>
                                    @foreach ($blocks as $blk)
                                        <option value="{{ $blk->id }}" {{ $block->id == $blk->id ? 'selected' : '' }}>
                                            {{ $blk->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-danger">
                                    @error('block_id')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="form-group">
                                <label for="type">Floor Type</label>
                                <select name="type" id="type" class="form-control" required>
                                    <option value="upper" {{ $floor->type == 'upper' ? 'selected' : '' }}>Upper</option>
                                    <option value="underground" {{ $floor->type == 'underground' ? 'selected' : '' }}>
                                        Underground</option>
                                </select>
                            </div>

                            <!-- Floor info -->
                            <div class="form-group">
                                <label for="floor_no">Floor No</label>
                                <select name="floor_no" id="floor_no" class="form-control" required>
                                    {{-- <option value="{{ $floor->floor_no }}" selected>{{ $floor->floor_no }} th</option> --}}
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="name">Floor Name</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ $floor->name }}" placeholder="Enter Floor name">
                            </div>


                            <label> Floor Features </label>

                            <div id="dynamic-checkboxes">
                                <!-- Dynamic checkboxes will be added here -->
                            </div>

                            <!-- Building Details -->
                            <div class="form-group col-md-12">
                                <label class="col-form-label">Building Details</label>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Building ID</th>
                                        <td id="building_no_display"></td>
                                    </tr>
                                    <tr>
                                        <th>Building Type</th>
                                        <td id="building_type_display"></td>
                                    </tr>
                                    <tr>
                                        <th>Block ID</th>
                                        <td id="block_no_display"></td>
                                    </tr>
                                </table>
                            </div>

                            <button type="submit" class="btn waves-effect waves-light btn-sm"
                                style="background-color: rgb(100, 197, 177); border-color: rgb(100, 197, 177); color: white;">
                                Update Floor
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const typeFullForm = @json($typeFullForm);
        const buildings = @json($buildings);
        const blocks = @json($blocks);
        const existingFloorType = @json($floor->type);
        let existingFloors = []; // Initialize as an empty array
        console.log(existingFloorType);


        function showBuildingDetails() {
            const selectedBuildingId = document.getElementById('building_id').value;
            const building = buildings.find(b => b.id == selectedBuildingId);

            if (building) {
                document.getElementById('building_no_display').innerText = building.building_no;
                document.getElementById('building_type_display').innerText = typeFullForm[building.type] || 'Other';

                const buildingBlocks = blocks.filter(b => b.building_id == selectedBuildingId);
                const blockSelect = document.getElementById('block_id');
                blockSelect.innerHTML = '<option value="">Select Block</option>';

                buildingBlocks.forEach(block => {
                    blockSelect.innerHTML += `
                        <option value="${block.id}" ${block.id == '{{ $floor->block_id }}' ? 'selected' : ''}>${block.name}</option>
                    `;
                });

                if (buildingBlocks.length === 0) {
                    blockSelect.innerHTML = '<option value="">No blocks available for the selected building.</option>';
                }

                document.getElementById('block_no_display').innerText = '';

            } else {
                document.getElementById('building_no_display').innerText = '';
                document.getElementById('building_type_display').innerText = '';
                document.getElementById('block_id').innerHTML = '<option value="">Select Block</option>';
                document.getElementById('block_no_display').innerText = '';
            }
        }

        function showBlockDetails() {
            const selectedBlockId = document.getElementById('block_id').value;
            const block = blocks.find(b => b.id == selectedBlockId);

            if (block) {
                document.getElementById('block_no_display').innerText = block.block_no;
                const upperFloorCount = block.total_upper_floors ?? 0;
                const undergroundFloorCount = block.total_underground_floors ?? 0;

                const typeSelect = document.getElementById('type');
                typeSelect.removeEventListener('change', handleTypeChange); // Remove old listeners to avoid duplication
                typeSelect.addEventListener('change', handleTypeChange);

                function handleTypeChange() {
                    const selectedType = this.value;

                    fetch(`/blocks/${selectedBlockId}/floorsno?type=${selectedType}`) // Pass type as query parameter
                        .then(response => response.json())
                        .then(data => {
                            if (data.error) {
                                console.error(data.error); // Handle errors
                                return;
                            }

                            existingFloors = data.existingFloors; // Update existingFloors with fetched data
                            // Example call
                            const currentFloorNo =
                            {{ $floor->floor_no }}; // Get current floor number from Blade variable

                            const floorCount = selectedType === 'upper' ? upperFloorCount : undergroundFloorCount;
                            populateFloorOptions(floorCount, selectedType, currentFloorNo);
                        })
                        .catch(error => console.error('Error fetching floors:', error));
                }

                typeSelect.dispatchEvent(new Event('change')); // Trigger change to initialize dropdowns
            } else {
                document.getElementById('block_no_display').innerText = '';
            }
        }

        function populateFloorOptions(floorCount, type, currentFloorNo) {
            const floorNoSelect = document.getElementById('floor_no');
            floorNoSelect.innerHTML = '';

            if (type === existingFloorType) {
                if (currentFloorNo) {
                    let suffix = 'th';
                    if (currentFloorNo === 1) suffix = 'st';
                    else if (currentFloorNo === 2) suffix = 'nd';
                    else if (currentFloorNo === 3) suffix = 'rd';
                    floorNoSelect.innerHTML += `<option value="${currentFloorNo}" selected>${currentFloorNo}<sup>${suffix}</sup> </option>`;
                }
            } else {
                floorNoSelect.innerHTML = '<option value="">Select Floor No</option>';
            }


            // Dynamic checkboxes based on type
            const dynamicCheckboxes = document.getElementById('dynamic-checkboxes');
            dynamicCheckboxes.innerHTML = ''; // Clear previous checkboxes

            if (type === 'upper') {
                dynamicCheckboxes.innerHTML = `
        <div class="form-group">
            <label><input type="checkbox" name="is_residential_unit_exist" {{ $floor->is_residential_unit_exist ? 'checked' : '' }}> Residential Suite </label>
        </div>
        <div class="form-group">
            <label><input type="checkbox" name="is_commercial_unit_exist" {{ $floor->is_commercial_unit_exist ? 'checked' : '' }}> Commercial Unit </label>
        </div>
        <div class="form-group">
            <label><input type="checkbox" name="is_supporting_room_exist" {{ $floor->is_supporting_room_exist ? 'checked' : '' }}> Supporting & Service Room </label>
        </div>
        `;
            } else if (type === 'underground') {
                dynamicCheckboxes.innerHTML = `
        <div class="form-group">
            <label><input type="checkbox" name="is_parking_lot_exist" {{ $floor->is_parking_lot_exist ? 'checked' : '' }}> Parking Lot</label>
        </div>
        <div class="form-group">
            <label><input type="checkbox" name="is_storage_lot_exist" {{ $floor->is_storage_lot_exist ? 'checked' : '' }}> Storage Lot</label>
        </div>
        `;
            } // Populate floor numbers excluding the existing ones
            for (let i = 1; i <= floorCount; i++) {
                if (!existingFloors.includes(i.toString())) { // Exclude selected and existing floors
                    let suffix = 'th';
                    if (i === 1) suffix = 'st';
                    else if (i === 2) suffix = 'nd';
                    else if (i === 3) suffix = 'rd';
                    floorNoSelect.innerHTML += `<option value="${i}">${i}<sup>${suffix}</sup></option>`;
                }
            }
        }

        // Initial call to populate the details if there's a pre-selected building and block
        document.addEventListener('DOMContentLoaded', function() {
            showBuildingDetails();
            showBlockDetails();
        });
    </script>
@endsection
