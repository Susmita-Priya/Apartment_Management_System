@extends('master')

@section('content')
    @push('title')
        <title>Edit Unit/Suite</title>
    @endpush

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Edit Unit/Suite</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('building') }}">Buildings</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('block.index') }}">Blocks</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('floor.index') }}">Floors</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('unit.index') }}">Units</a></li>
                            <li class="breadcrumb-item active">Edit Unit/Suite</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <form action="{{ route('unit.update', $unit->id) }}" enctype="multipart/form-data" method="POST">
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

                            <!-- Unit/Suite Number -->
                            <div class="form-group">
                                <label for="unit_no">Unit/Suite NO</label>
                                <input type="number" name="unit_no" id="unit_no" class="form-control"
                                    value="{{ $unit->unit_no }}" required>
                            </div>

                            <!-- Checkbox placeholders -->
                            <div id="dynamic-selectboxs"></div>

                            <button type="submit" class="btn waves-effect waves-light btn-sm"
                                style="background-color: rgb(100, 197, 177); border-color: rgb(100, 197, 177); color: white;">
                                Update Unit/Suite</button>
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

                const dynamicSelectBox = document.getElementById('dynamic-selectboxs');
                dynamicSelectBox.innerHTML = '';

                let selectBoxContent = `
                    <div class="form-group">
                        <label for="type">Unit/Suite Type</label>
                        <select name="type" id="type" class="form-control" required>
                `;

                if (floor.residential_suite) {
                    selectBoxContent += `
                        <option value="Residential Suite"
                                            {{ old('type', $unit->type) === 'Residential Suite' ? 'selected' : '' }}>
                                            Residential Suite</option>
                    `;
                }

                if (floor.commercial_unit) {
                    selectBoxContent += `
                        <option value="Commercial Unit"
                                            {{ old('type', $unit->type) === 'Commercial Unit' ? 'selected' : '' }}>
                                            Commercial Unit</option>
                    `;
                }

                if (floor.supporting_service_room) {
                    selectBoxContent += `
                        <option value="Supporting and Servicing Unit"
                                            {{ old('type', $unit->type) === 'Supporting and Servicing Unit' ? 'selected' : '' }}>
                                            Supporting & Service Room</option>
                    `;
                }

                selectBoxContent += `
                        </select>
                    </div>
                `;

                dynamicSelectBox.innerHTML = selectBoxContent;
            } else {
                document.getElementById('floor_name_display').innerText = '';
            }
        }

        window.onload = function() {
            showBuildingDetails();
            showBlockDetails();
            showFloorDetails();
        }
    </script>
@endsection
