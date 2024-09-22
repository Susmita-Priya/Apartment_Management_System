@extends('master')

@section('content')
    @push('title')
        <title>Add Stall/Locker</title>
    @endpush

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Add Stall/Locker</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('building') }}">Buildings</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('block.index') }}">Blocks</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('floor.index') }}">Floors</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('unit.index') }}">Units</a></li>
                            <li class="breadcrumb-item active">Add Stall/Locker</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <form action="{{ route('stall_locker.store') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            {{-- <input type="hidden" name="floor_id" value="{{ $floor->id }}"> --}}

                            <!-- Building Selection -->
                            <div class="form-group">
                                <label for="building_id">Select Building</label>
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
                                <label for="block_id">Select Block</label>
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

                            <!-- Floor Selection -->
                            <div class="form-group">
                                <label for="floor_id">Select Floor</label>
                                <select name="floor_id" id="floor_id" class="form-control" onchange="showFloorDetails()">
                                    <option value="">Select Floor</option>
                                    @foreach ($floors as $flr)
                                        <option value="{{ $flr->id }}"
                                            {{ $floor && $floor->id == $flr->id ? 'selected' : '' }}>
                                            {{ $flr->type }}-{{ $flr->floor_no }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-danger">
                                    @error('floor_id')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <!-- Building Details -->
                            <div class="form-group col-md-12">
                                <label class="col-form-label">Building Details</label>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Building ID</th>
                                        <td id="building_id_display"></td>
                                    </tr>
                                    <tr>
                                        <th>Building Type</th>
                                        <td id="building_type_display"></td>
                                    </tr>
                                    <tr>
                                        <th>Block ID</th>
                                        <td id="block_id_display"></td>
                                    </tr>
                                    <tr>
                                        <th>Floor Name</th>
                                        <td id="floor_name_display"></td>
                                    </tr>
                                </table>
                            </div>

                            <!-- Textbox placeholders -->
                            <div id="dynamic-textbox"></div>

                            <!-- Selectbox placeholders -->
                            <div id="dynamic-selectboxs"></div>

                            <button type="submit" class="btn waves-effect waves-light btn-sm submitbtn"> Add

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
        const floors = @json($floors);

        function showBuildingDetails() {
            const selectedBuildingId = document.getElementById('building_id').value;
            const building = buildings.find(b => b.id == selectedBuildingId);

            if (building) {
                document.getElementById('building_id_display').innerText = building.building_id;
                document.getElementById('building_type_display').innerText = typeFullForm[building.type] || 'Other';

                const buildingBlocks = blocks.filter(b => b.building_id == selectedBuildingId);
                const blockSelect = document.getElementById('block_id');
                blockSelect.innerHTML = '<option value="">Select Block</option>';

                buildingBlocks.forEach(block => {
                    blockSelect.innerHTML += `
                    <option value="${block.id}" ${block.id == '{{ $block->id ?? '' }}' ? 'selected' : ''}>${block.name}</option>
                `;
                });

                if (buildingBlocks.length === 0) {
                    blockSelect.innerHTML = '<option value="">No blocks available for the selected building.</option>';
                }

                document.getElementById('block_id_display').innerText = '';
            } else {
                document.getElementById('building_id_display').innerText = '';
                document.getElementById('building_type_display').innerText = '';
                document.getElementById('block_id').innerHTML =
                    '<option value="">Select a building to see blocks.</option>';
                document.getElementById('block_id_display').innerText = '';
                document.getElementById('floor_id').innerHTML = '<option value="">Select a block to see floors.</option>';
                document.getElementById('floor_name_display').innerText = '';
            }
        }

        function showBlockDetails() {
            const selectedBlockId = document.getElementById('block_id').value;
            const block = blocks.find(b => b.id == selectedBlockId);

            if (block) {
                document.getElementById('block_id_display').innerText = block.block_id;

                const blockFloors = floors.filter(f => f.block_id == selectedBlockId);
                const floorSelect = document.getElementById('floor_id');
                floorSelect.innerHTML = '<option value="">Select Floor</option>';

                blockFloors.forEach(floor => {
                    floorSelect.innerHTML += `
                    <option value="${floor.id}" ${floor.id == '{{ $floor->id ?? '' }}' ? 'selected' : ''}>${floor.type}-${floor.floor_no}</option>
                `;
                });

                if (blockFloors.length === 0) {
                    floorSelect.innerHTML = '<option value="">No floors available for the selected block.</option>';
                }

                // // Clear previous select box if it exists
                // const dynamicSelectBox = document.getElementById('dynamic-selectboxs');
                // dynamicSelectBox.innerHTML = '';
            } else {
                document.getElementById('block_id_display').innerText = '';
                document.getElementById('floor_id').innerHTML = '<option value="">Select a block to see floors.</option>';
                document.getElementById('floor_name_display').innerText = '';
            }
        }

        function showFloorDetails() {
            const selectedFloorId = document.getElementById('floor_id').value;
            const floor = floors.find(f => f.id == selectedFloorId);

            if (floor) {
                document.getElementById('floor_name_display').innerText = floor.name;

                // Clear previous select box if it exists
                const dynamicTextBox = document.getElementById('dynamic-textbox');

                // Clear previous select box content
                dynamicTextBox.innerHTML = '';

                // Start the select box
                let TextBoxContent = `
                    <div class="form-group">
                     <label for="stall_locker_no">
                    `;

                    // Generate the appropriate options for the select box
                    if (floor.parking_lot) {
                        TextBoxContent += `
                             Stall NO
                            `;
                    }

                    if (floor.storage_lot) {
                        TextBoxContent += `
                            Locker NO
                            `;
                    }

                // Close the select box
                TextBoxContent += `
                    </label>
                    <input type="text" name="stall_locker_no" id="stall_locker_no" class="form-control"
                        required>
                    </div>
                    `;

                // Set the innerHTML of dynamicSelectBox to the complete content
                dynamicTextBox.innerHTML = TextBoxContent;


                // Clear previous select box if it exists
                const dynamicSelectBox = document.getElementById('dynamic-selectboxs');

                // Clear previous select box content
                dynamicSelectBox.innerHTML = '';

                // Start the select box
                let selectBoxContent = `
        <div class="form-group">
        <label for="type">Type</label>
        <select name="type" id="type" class="form-control" required>
        `;
                if (floor.parking_lot || floor.storage_lot) {
                    // Generate the appropriate options for the select box
                    if (floor.parking_lot) {
                        selectBoxContent += `
        <option value="Car Parking Stall">Car Parking Stall</option>
        <option value="Bike Parking Stall">Bike Parking Stall</option>
        `;
                    }

                    if (floor.storage_lot) {
                        selectBoxContent += `
        <option value="Storage Locker">Storage Locker</option>
        `;
                    }

                } else {
                    selectBoxContent += `
        <option value="">Please Select Parking or Storage Level. </option>
        `;
                }

                // Close the select box
                selectBoxContent += `
        </select>
        </div>
        `;
                // Set the innerHTML of dynamicSelectBox to the complete content
                dynamicSelectBox.innerHTML = selectBoxContent;

            } else {
                document.getElementById('floor_name_display').innerText = '';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            showFloorDetails(); // Show initial floor details if a floor is pre-selected
            showBuildingDetails(); // Show initial building details if a building is pre-selected
            showBlockDetails(); // Show initial block details if a block is pre-selected

        });
    </script>
@endsection
