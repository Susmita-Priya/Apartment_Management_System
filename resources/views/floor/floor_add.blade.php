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
                                </table>
                            </div>

                            <!-- Floor info -->
                            <div class="form-group">
                                <label for="floor_no">Floor Number</label>
                                <input type="number" name="floor_no" id="floor_no" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="name">Floor Name</label>
                                <input type="text" name="name" id="name" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="type">Floor Type</label>
                                <select name="type" id="type" class="form-control" required>
                                    <option value="rooftop">Rooftop</option>
                                    <option value="upper">Upper</option>
                                    <option value="ground">Ground</option>
                                    <option value="underground">Underground</option>
                                </select>
                            </div>
                            <label> Floor Features </label>
                            <div class="alert alert-primary">                           
                                <ul> {{ 'You can select one from the following options:' }}
                                    <li>{{ 'Residential Suite, Commercial Unit, or Supporting & Service Room.' }}</li>
                                    <li>{{ 'Parking Lot.' }}</li>
                                    <li>{{ 'Storage Lot.' }}</li>
                                </ul>                               
                            </div>

                            <!-- Checkbox placeholders -->
                            <div id="dynamic-checkboxes"></div>

                            <!-- Supporting checkboxes -->
                            <div class="form-group">
                                <label><input type="checkbox" name="supporting_service_room"> Supporting & Service Room</label>
                            </div>
                            <div class="form-group">
                                <label><input type="checkbox" name="parking_lot"> Parking Lot</label>
                            </div>
                            {{-- <div class="form-group">
                                <label><input type="checkbox" name="bike_lot"> Bike Lot</label>
                            </div> --}}
                            <div class="form-group">
                                <label><input type="checkbox" name="storage_lot"> Storage Lot</label>
                            </div>

                            <button type="submit" class="btn waves-effect waves-light btn-sm submitbtn" >
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

        function showBuildingDetails() {
            const selectedBuildingId = document.getElementById('building_id').value;
            const building = buildings.find(b => b.id == selectedBuildingId);

            // Update building details
            if (building) {
                document.getElementById('building_id_display').innerText = building.building_id;
                document.getElementById('building_type_display').innerText = typeFullForm[building.type] || 'Other';

                // Populate blocks based on selected building
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

                // Clear block ID display if no block is selected
                document.getElementById('block_id_display').innerText = '';

                // Update checkboxes based on building type
                const dynamicCheckboxes = document.getElementById('dynamic-checkboxes');
                dynamicCheckboxes.innerHTML = ''; // Clear previous checkboxes

                if (building.type === 'RESB') {
                    dynamicCheckboxes.innerHTML = `
                        <div class="form-group">
                            <label><input type="checkbox" name="residential_suite"> Residential Suite</label>
                        </div>
                    `;
                } else if (building.type === 'COMB') {
                    dynamicCheckboxes.innerHTML = `
                        <div class="form-group">
                            <label><input type="checkbox" name="commercial_unit"> Commercial Unit</label>
                        </div>
                    `;
                } else if (building.type === 'RECB') {
                    dynamicCheckboxes.innerHTML = `
                        <div class="form-group">
                            <label><input type="checkbox" name="residential_suite"> Residential Suite</label>
                        </div>
                        <div class="form-group">
                            <label><input type="checkbox" name="commercial_unit"> Commercial Unit</label>
                        </div>
                    `;
                }

            } else {
                document.getElementById('building_id_display').innerText = '';
                document.getElementById('building_type_display').innerText = '';
                document.getElementById('block_id').innerHTML =
                    '<option value="">Select a building to see blocks.</option>';
                document.getElementById('block_id_display').innerText = '';
                document.getElementById('dynamic-checkboxes').innerHTML = ''; // Clear checkboxes if no building is selected
            }
        }

        function showBlockDetails() {
            const selectedBlockId = document.getElementById('block_id').value;
            const block = blocks.find(b => b.id == selectedBlockId);

            // Update block details
            if (block) {
                document.getElementById('block_id_display').innerText = block.block_id;
            } else {
                document.getElementById('block_id_display').innerText = '';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            showBuildingDetails(); // Show initial building details if a building is pre-selected
            showBlockDetails(); // Show initial block details if a block is pre-selected
        });
    </script>
@endsection
