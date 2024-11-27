@extends('master')

@section('content')
    @push('title')
        <title>Add Floor</title>
    @endpush

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Add Floor</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('building') }}">Buildings</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('block.index') }}">Blocks</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('floor.index') }}">Floors</a></li>
                            <li class="breadcrumb-item active">Add Floor</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <form action="{{ route('floor.store') }}" enctype="multipart/form-data" method="POST">
                            @csrf

                            <!-- Building Selection -->
                            <div class="form-group">
                                <label for="building_id">Building</label>
                                <select name="building_id" id="building_id" class="form-control"
                                    onchange="showBuildingDetails()">
                                    <option value="">Select Building</option>
                                    @foreach ($buildings as $bldg)
                                        <option value="{{ $bldg->id }}"
                                            {{ $building && $building->id == $bldg->id ? 'selected' : '' }}>
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
                                        <option value="{{ $blk->id }}"
                                            {{ $block && $block->id == $blk->id ? 'selected' : '' }}>
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
                                    <option value="">Select Floor Type</option>
                                    <option value="upper">Upper</option>
                                    <option value="underground">Underground</option>
                                </select>
                            </div>

                            <!-- Floor info -->
                            <div class="form-group">
                                <label for="floor_no">Floor No</label>
                                <select name="floor_no" id="floor_no" class="form-control" required>
                                    <option value="">Select Floor No</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="name">Floor Name</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="Enter Floor Name">
                            </div>

                            <label> Available Features </label>

                            <br>
                            <!-- Checkbox placeholders -->
                            <div id="dynamic-checkboxes"></div>

                            <!-- Building Details -->
                            <div class="form-group col-md-12">
                                <label class="col-form-label">Details Information</label>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Building Type</th>
                                        <td id="building_type_display"></td>
                                    </tr>
                                    <tr>
                                        <th>Building No</th>
                                        <td id="building_no_display"></td>
                                    </tr>
                                    <tr>
                                        <th>Block No</th>
                                        <td id="block_no_display"></td>
                                    </tr>
                                </table>
                            </div>

                            <button type="submit" class="btn waves-effect waves-light btn-sm submitbtn">
                                Add Floor
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        const typeFullForm = @json($typeFullForm); // Encode PHP array to JSON
        const buildings = @json($buildings);
        const blocks = @json($blocks);
        let existingFloors = []; // Initialize as an empty array

        function showBuildingDetails() {
            const selectedBuildingId = document.getElementById('building_id').value;
            const building = buildings.find(b => b.id == selectedBuildingId);

            // Update building details
            if (building) {
                document.getElementById('building_no_display').innerText = building.building_no;
                document.getElementById('building_type_display').innerText = typeFullForm[building.type] || 'Other';

                // Populate blocks based on selected building
                const buildingBlocks = blocks.filter(b => b.building_id == selectedBuildingId);
                const blockSelect = document.getElementById('block_id');
                blockSelect.innerHTML = '<option value="">Select Block</option>';

                buildingBlocks.forEach(block => {
                    blockSelect.innerHTML += `
                <option value="${block.id}" ${block.id == '{{ $block->id ?? '' }}' ? 'selected' : ''}>
                    ${block.name}
                </option>
            `;
                });

                if (buildingBlocks.length === 0) {
                    blockSelect.innerHTML = '<option value="">No blocks available for the selected building.</option>';
                }

                document.getElementById('block_no_display').innerText = '';
                document.getElementById('dynamic-checkboxes').innerHTML = ''; // Clear checkboxes
            } else {
                document.getElementById('building_no_display').innerText = '';
                document.getElementById('building_type_display').innerText = '';
                document.getElementById('block_id').innerHTML =
                    '<option value="">Select a building to see blocks.</option>';
                document.getElementById('block_no_display').innerText = '';
                document.getElementById('dynamic-checkboxes').innerHTML = ''; // Clear checkboxes
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
                            populateFloorOptions(
                                selectedType === 'upper' ? upperFloorCount : undergroundFloorCount,
                                selectedType
                            );
                        })
                        .catch(error => console.error('Error fetching floors:', error));
                }

                typeSelect.dispatchEvent(new Event('change')); // Trigger change to initialize dropdowns
            } else {
                document.getElementById('block_no_display').innerText = '';
            }
        }

        function populateFloorOptions(floorCount, type) {
            const floorNoSelect = document.getElementById('floor_no');
            floorNoSelect.innerHTML = '<option value="">Select Floor No</option>';

            const dynamicCheckboxes = document.getElementById('dynamic-checkboxes');
            dynamicCheckboxes.innerHTML = '';

            if (type === 'upper') {
                dynamicCheckboxes.innerHTML = `
            <div class="form-group">
                <label><input type="checkbox" name="is_residential_unit_exist"> Residential Suite </label>
            </div>
            <div class="form-group">
                <label><input type="checkbox" name="is_commercial_unit_exist"> Commercial Unit </label>
            </div>
            <div class="form-group">
                <label><input type="checkbox" name="is_supporting_room_exist"> Supporting & Service Room </label>
            </div>
            `;
            } else if (type === 'underground') {
                dynamicCheckboxes.innerHTML += `
            <div class="form-group">
                <label><input type="checkbox" name="is_parking_lot_exist"> Parking Lot</label>
            </div>
            <div class="form-group">
                <label><input type="checkbox" name="is_storage_lot_exist"> Storage Lot</label>
            </div>
            `;
            }

            // Populate floor numbers excluding existing ones
            for (let i = 1; i <= floorCount; i++) {
                if (!existingFloors.includes(i.toString())) { // Ensure string-based comparison
                let suffix = 'th';
                if (i === 1) suffix = 'st';
                else if (i === 2) suffix = 'nd';
                else if (i === 3) suffix = 'rd';
                floorNoSelect.innerHTML += `<option value="${i}">${i}<sup>${suffix}</sup></option>`;
                }
            }
        }


        document.addEventListener('DOMContentLoaded', function() {
            showBuildingDetails(); // Show initial building details if a building is pre-selected
            showBlockDetails(); // Show initial block details if a block is pre-selected
        });
    </script>
@endsection
