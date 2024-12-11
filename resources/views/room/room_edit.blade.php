@extends('master')

@section('content')
    @push('title')
        <title>Edit Room</title>
    @endpush

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Edit Room</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('building') }}">Buildings</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('floor.index') }}">Floors</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('unit.index') }}">Units</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('room.index') }}">Rooms</a></li>
                            <li class="breadcrumb-item active">Edit Room</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <form action="{{ route('room.update',$room->id) }}" enctype="multipart/form-data" method="POST">
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
                            {{-- <div class="form-group">
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
                            </div> --}}

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
                                <label for="room_type_id">Room Type</label>
                                <select name="room_type_id" id="room_type_id" class="form-control" required>
                                    <option value="">Select Room Type</option>
                                    @foreach ($roomTypes as $roomType)
                                        <option value="{{ $roomType->id }}" {{ $roomType && $roomType->id == $room->room_type_id ? 'selected' : '' }}>{{ $roomType->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="room_no">Room NO</label>
                                <input type="number" name="room_no" id="room_no" class="form-control"
                                    value={{ $room->room_no }} required>
                            </div>

                            <div class="form-group">
                                <label for="amenities" class="form-label">Amenities</label>
                                <div id="amenities-container">
                                    @php
                                        $existingAssets = json_decode($room->amenities ?? '[]', true);
                                    @endphp
                                    @foreach ($existingAssets ?? [['id' => '', 'quantity' => '']] as $index => $existingAsset)
                                        <div class="amenity-row d-flex mb-2">
                                            <select name="amenities[{{ $index }}][id]" class="form-control amenity-select mr-2">
                                                <option value="">Select Amenity</option>
                                                @foreach ($amenities as $amenity)
                                                    <option value="{{ $amenity->id }}" {{ $amenity->id == $existingAsset['id'] ? 'selected' : '' }}>
                                                        {{ $amenity->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <input type="number" name="amenities[{{ $index }}][quantity]" class="form-control amenity-quantity"
                                                placeholder="Quantity" min="1" value="{{ $existingAsset['quantity'] }}">
                                            <button type="button" class="btn btn-danger remove-amenity ml-2">Remove</button>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" class="btn btn-primary mt-2" id="add-amenity">Add More</button>
                            </div>

                            {{-- status --}}
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1" {{ $room->status == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $room->status == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
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
                                    {{-- <tr>
                                        <th>Block No</th>
                                        <td id="block_no_display"></td>
                                    </tr> --}}
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
                                Edit Room</button>
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
        const floors = @json($floors);
        const units = @json($units);

        // function showBuildingDetails() {
        //     const selectedBuildingId = document.getElementById('building_id').value;
        //     const building = buildings.find(b => b.id == selectedBuildingId);

        //     if (building) {
        //         document.getElementById('building_no_display').innerText = building.building_no;
        //         document.getElementById('building_type_display').innerText = typeFullForm[building.type] || 'Other';

        //         const buildingBlocks = blocks.filter(b => b.building_id == selectedBuildingId);
        //         const blockSelect = document.getElementById('block_id');
        //         blockSelect.innerHTML = '<option value="">Select Block</option>';

        //         buildingBlocks.forEach(block => {
        //             blockSelect.innerHTML += `
        //             <option value="${block.id}" ${block.id == '{{ $block->id ?? '' }}' ? 'selected' : ''}>${block.name}</option>
        //         `;
        //         });

        //         if (buildingBlocks.length === 0) {
        //             blockSelect.innerHTML = '<option value="">No blocks available for the selected building.</option>';
        //         }

        //         document.getElementById('block_no_display').innerText = '';
        //     } else {
        //         document.getElementById('building_no_display').innerText = '';
        //         document.getElementById('building_type_display').innerText = '';
        //         document.getElementById('block_id').innerHTML =
        //             '<option value="">Select a building to see blocks.</option>';
        //         document.getElementById('block_no_display').innerText = '';
        //         document.getElementById('floor_id').innerHTML = '<option value="">Select a block to see floors.</option>';
        //         document.getElementById('floor_name_display').innerText = '';
        //         document.getElementById('unit_id').innerHTML = '<option value="">Select a floor to see units.</option>';
        //         document.getElementById('unit_type_display').innerText = '';
        //     }
        // }

        // function showBlockDetails() {
        //     const selectedBlockId = document.getElementById('block_id').value;
        //     const block = blocks.find(b => b.id == selectedBlockId);

        //     if (block) {
        //         document.getElementById('block_no_display').innerText = block.block_no;

        //         const blockFloors = floors.filter(f => f.block_id == selectedBlockId);
        //         const floorSelect = document.getElementById('floor_id');
        //         floorSelect.innerHTML = '<option value="">Select Floor</option>';

        //         blockFloors.forEach(floor => {
        //             let suffix = 'th';
        //             if (floor.floor_no == 1) {
        //                 suffix = 'st';
        //             } else if (floor.floor_no == 2) {
        //                 suffix = 'nd';
        //             } else if (floor.floor_no == 3) {
        //                 suffix = 'rd';
        //             } else {
        //                 suffix = 'th'; // For all other cases
        //             }
        //             floorSelect.innerHTML += `
        //             <option value="${floor.id}" ${floor.id == '{{ $floor->id ?? '' }}' ? 'selected' : ''}>${floor.floor_no}<sup>${suffix}</sup> (${floor.type} floor)</option>
        //         `;
        //         });


        //         if (blockFloors.length === 0) {
        //             floorSelect.innerHTML = '<option value="">No floors available for the selected block.</option>';
        //         }

        //     } else {
        //         document.getElementById('block_no_display').innerText = '';
        //         document.getElementById('floor_id').innerHTML = '<option value="">Select a block to see floors.</option>';
        //         document.getElementById('floor_name_display').innerText = '';
        //         document.getElementById('unit_id').innerHTML = '<option value="">Select a floor to see units.</option>';
        //         document.getElementById('unit_type_display').innerText = '';
        //     }
        // }

        function showBuildingDetails() {
            const selectedBuildingId = document.getElementById('building_id').value;
            const building = buildings.find(b => b.id == selectedBuildingId);

            if (building) {
                document.getElementById('building_no_display').innerText = building.building_no;
                document.getElementById('building_type_display').innerText = typeFullForm[building.type] || 'Other';


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
                    floorSelect.innerHTML += `
                    <option value="${floor.id}" ${floor.id == '{{ $floor->id ?? '' }}' ? 'selected' : ''}>${floor.floor_no}<sup>${suffix}</sup> (${floor.type} floor)</option>
                `;
                });

                if (buildingFloors.length === 0) {
                    floorSelect.innerHTML = '<option value="">No floors available for the selected building.</option>';
                }
            } else {
                document.getElementById('building_no_display').innerText = '';
                document.getElementById('building_type_display').innerText = '';
                document.getElementById('floor_id').innerHTML = '<option value="">Select a building to see floors.</option>';
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
            showUnitDetails(); // Show initial unit details if a unit is pre-selected

        });

        //assest add remove
        document.addEventListener('DOMContentLoaded', function () {
    let assetCount = document.querySelectorAll('.amenity-row').length;

    document.getElementById('add-amenity').addEventListener('click', function () {
        const container = document.getElementById('amenities-container');
        const row = `
            <div class="amenity-row d-flex mb-2">
                <select name="amenities[${assetCount}][id]" class="form-control amenity-select mr-2">
                    <option value="">Select Amenity</option>
                    @foreach ($amenities as $amenity)
                        <option value="{{ $amenity->id }}">{{ $amenity->name }}</option>
                    @endforeach
                </select>
                <input type="number" name="amenities[${assetCount}][quantity]" class="form-control amenity-quantity"
                    placeholder="Quantity" min="1">
                <button type="button" class="btn btn-danger remove-amenity ml-2">Remove</button>
            </div>`;
        container.insertAdjacentHTML('beforeend', row);
        assetCount++;
    });

    document.getElementById('amenities-container').addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-amenity')) e.target.closest('.amenity-row').remove();
    });
});

    </script>
@endsection
