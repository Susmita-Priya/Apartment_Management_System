@extends('master')

@section('content')
    @push('title')
        <title>Add Room</title>
    @endpush

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Add Room</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('building') }}">Buildings</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('block.index') }}">Blocks</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('floor.index') }}">Floors</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('unit.index') }}">Units</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('room.index') }}">Rooms</a></li>
                            <li class="breadcrumb-item active">Add Room</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <form action="{{ route('room.store') }}" enctype="multipart/form-data" method="POST">
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

                            <!-- Floor Selection -->
                            <div class="form-group">
                                <label for="floor_id">Floor</label>
                                <select name="floor_id" id="floor_id" class="form-control" onchange="showFloorDetails()">
                                    <option value="">Select Floor</option>
                                    @foreach ($floors as $flr)
                                        @php
                                            $suffix =
                                                $flr->floor_no == 1
                                                    ? 'st'
                                                    : ($flr->floor_no == 2
                                                        ? 'nd'
                                                        : ($flr->floor_no == 3
                                                            ? 'rd'
                                                            : 'th'));
                                        @endphp
                                        <option value="{{ $flr->id }}"
                                            {{ $floor && $floor->id == $flr->id ? 'selected' : '' }}>
                                            {{ $flr->floor_no }}<sup>{{ $suffix }}</sup> ({{ $flr->type }}
                                            floor)
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-danger">
                                    @error('floor_id')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            {{-- unit selection --}}
                            <div class="form-group">
                                <label for="unit_id">Unit</label>
                                <select name="unit_id" id="unit_id" class="form-control" onchange="showUnitDetails()">
                                    <option value="">Select Unit</option>
                                    @foreach ($units as $unt)
                                        <option value="{{ $unt->id }}"
                                            {{ $unit && $unit->id == $unt->id ? 'selected' : '' }}>
                                            {{ $unt->unit_no }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-danger">
                                    @error('unit_id')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            {{-- room info --}}

                            <div class="form-group">
                                <label for="type">Room Type</label>
                                <input type="text" name="type" id="type" class="form-control"
                                    placeholder="Enter Room Type (e.g, Bedroom)" required>
                            </div>

                            <div class="form-group">
                                <label for="room_no">Room NO</label>
                                <input type="number" name="room_no" id="room_no" class="form-control"
                                    placeholder="Enter Room No (e.g, 1, 2)" required>
                            </div>

                            <div class="form-group">
                                <label for="assets">Assets</label>
                                <div id="assets-container">
                                    <div class="asset-row d-flex mb-2">
                                        <select name="assets[0][id]" class="form-control asset-select mr-2">
                                            <option value="">Select Asset</option>
                                            @foreach ($assets as $asset)
                                                <option value="{{ $asset->id }}">{{ $asset->name }}</option>
                                            @endforeach
                                        </select>
                                        <input type="number" name="assets[0][quantity]" class="form-control asset-quantity"
                                            placeholder="Quantity" min="1">
                                        <button type="button" class="btn btn-danger remove-asset ml-2"
                                            style="display: none;">Remove</button>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary mt-2" id="add-asset">Add More</button>
                            </div>

                            <!-- Building Details -->
                            <div class="form-group col-md-12">
                                <label class="col-form-label">Details Information</label>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Building No</th>
                                        <td id="building_no_display"></td>
                                    </tr>
                                    <tr>
                                        <th>Building Type</th>
                                        <td id="building_type_display"></td>
                                    </tr>
                                    <tr>
                                        <th>Block No</th>
                                        <td id="block_no_display"></td>
                                    </tr>
                                    <tr>
                                        <th>Floor Name</th>
                                        <td id="floor_name_display"></td>
                                    </tr>
                                    <tr>
                                        <th>Unit Type</th>
                                        <td id="unit_type_display"></td>
                                    </tr>
                                </table>
                            </div>

                            <button type="submit" class="btn waves-effect waves-light btn-sm  submitbtn">
                                Add Room</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // for building, block, floor, unit selection
        const typeFullForm = @json($typeFullForm); // Encode PHP array to JSON
        const buildings = @json($buildings);
        const blocks = @json($blocks);
        const floors = @json($floors);
        const units = @json($units);

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
                    <option value="${block.id}" ${block.id == '{{ $block->id ?? '' }}' ? 'selected' : ''}>${block.name}</option>
                `;
                });

                if (buildingBlocks.length === 0) {
                    blockSelect.innerHTML = '<option value="">No blocks available for the selected building.</option>';
                }

                document.getElementById('block_no_display').innerText = '';
            } else {
                document.getElementById('building_no_display').innerText = '';
                document.getElementById('building_type_display').innerText = '';
                document.getElementById('block_id').innerHTML =
                    '<option value="">Select a building to see blocks.</option>';
                document.getElementById('block_no_display').innerText = '';
                document.getElementById('floor_id').innerHTML = '<option value="">Select a block to see floors.</option>';
                document.getElementById('floor_name_display').innerText = '';
                document.getElementById('unit_id').innerHTML = '<option value="">Select a floor to see units.</option>';
                document.getElementById('unit_type_display').innerText = '';
            }
        }

        function showBlockDetails() {
            const selectedBlockId = document.getElementById('block_id').value;
            const block = blocks.find(b => b.id == selectedBlockId);

            if (block) {
                document.getElementById('block_no_display').innerText = block.block_no;

                const blockFloors = floors.filter(f => f.block_id == selectedBlockId);
                const floorSelect = document.getElementById('floor_id');
                floorSelect.innerHTML = '<option value="">Select Floor</option>';

                blockFloors.forEach(floor => {
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
                    floorSelect.innerHTML += `
                    <option value="${floor.id}" ${floor.id == '{{ $floor->id ?? '' }}' ? 'selected' : ''}>${floor.floor_no}<sup>${suffix}</sup> (${floor.type} floor)</option>
                `;
                });


                if (blockFloors.length === 0) {
                    floorSelect.innerHTML = '<option value="">No floors available for the selected block.</option>';
                }

            } else {
                document.getElementById('block_no_display').innerText = '';
                document.getElementById('floor_id').innerHTML = '<option value="">Select a block to see floors.</option>';
                document.getElementById('floor_name_display').innerText = '';
                document.getElementById('unit_id').innerHTML = '<option value="">Select a floor to see units.</option>';
                document.getElementById('unit_type_display').innerText = '';
            }
        }

        function showFloorDetails() {
            const selectedFloorId = document.getElementById('floor_id').value;
            const floor = floors.find(f => f.id == selectedFloorId);

            if (floor) {
                document.getElementById('floor_name_display').innerText = floor.name;

                const floorUnits = units.filter(u => u.floor_id == selectedFloorId);
                const unitSelect = document.getElementById('unit_id');
                unitSelect.innerHTML = '<option value="">Select Unit</option>';

                floorUnits.forEach(unit => {
                    unitSelect.innerHTML += `
                    <option value="${unit.id}" ${unit.id == '{{ $unit->id ?? '' }}' ? 'selected' : ''}>Unit-${unit.unit_no}</option>
                `;
                });

                if (unitSelect.length === 0) {
                    unitSelect.innerHTML = '<option value="">No units available for the selected floor.</option>';
                }
            } else {
                document.getElementById('floor_name_display').innerText = '';
                document.getElementById('unit_id').innerHTML = '<option value="">Select a floor to see units.</option>';
                document.getElementById('unit_type_display').innerText = '';
            }
        }

        function showUnitDetails() {
            const selectedUnitId = document.getElementById('unit_id').value;
            const unit = units.find(u => u.id == selectedUnitId);

            console.log(unit);

            if (unit) {
                document.getElementById('unit_type_display').innerText = unit.type.charAt(0).toUpperCase() + unit.type
                    .slice(1) + ' Unit';
            } else {
                document.getElementById('unit_type_display').innerText = '';
            }

        }

        document.addEventListener('DOMContentLoaded', function() {
            showFloorDetails(); // Show initial floor details if a floor is pre-selected
            showBuildingDetails(); // Show initial building details if a building is pre-selected
            showBlockDetails(); // Show initial block details if a block is pre-selected
            showUnitDetails(); // Show initial unit details if a unit is pre-selected

        });

        //assest add remove
        document.addEventListener('DOMContentLoaded', function() {
            let assetCount = 1;

            document.getElementById('add-asset').addEventListener('click', function() {
                const container = document.getElementById('assets-container');
                const newAssetRow = document.createElement('div');
                newAssetRow.classList.add('asset-row', 'd-flex', 'mb-2');

                newAssetRow.innerHTML = `
                <select name="assets[${assetCount}][id]" class="form-control asset-select mr-2">
                    <option value="">Select Asset</option>
                    @foreach ($assets as $asset)
                        <option value="{{ $asset->id }}">{{ $asset->name }}</option>
                    @endforeach
                </select>
                <input type="number" name="assets[${assetCount}][quantity]" class="form-control asset-quantity" placeholder="Quantity" min="1">
                <button type="button" class="btn btn-danger remove-asset ml-2">Remove</button>
                `;

                container.appendChild(newAssetRow);
                assetCount++;
            });

            document.getElementById('assets-container').addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-asset')) {
                    e.target.closest('.asset-row').remove();
                }
            });
        });
    </script>
@endsection
