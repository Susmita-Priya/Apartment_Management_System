@extends('master')

@section('content')
    @push('title')
        <title>Edit Stall</title>
    @endpush

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Edit Stall</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('building') }}">Buildings</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('floor.index') }}">Floors</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('stall.index') }}">Stalls</a></li>
                            <li class="breadcrumb-item active">Edit Stall</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <form action="{{ route('stall.update', $stall->id) }}" enctype="multipart/form-data" method="POST">
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
                            {{-- <div class="form-group">
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
                            </div> --}}

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

                            <!-- Stall/Suite Number -->
                            <div class="form-group">
                                <label for="stall_no">Stall NO</label>
                                <input type="text" name="stall_no" id="stall_no" class="form-control"
                                    value="{{ $stall->stall_no }}" required>
                            </div>

                            <div class="form-group">
                                <label for="type">Stall Type</label>
                                <select name="type" id="dynamic-selectboxs" class="form-control" required>
                                    <option value="">Select Stall Type</option>
                                    <option value="parking lot" {{ old('type', $stall->type) === 'parking lot' ? 'selected' : '' }}>
                                        Parking Stall
                                    </option>
                                    <option value="storage lot" {{ old('type', $stall->type) === 'storage lot' ? 'selected' : '' }}>
                                        Storage Locker
                                    </option>
                                    
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="capacity">Capacity</label>
                                <input type="number" name="capacity" id="capacity" class="form-control"
                                    placeholder="Enter Capacity (Only Number)" value="{{ $stall->capacity }}">
                            </div>


                            <!-- Building Details -->
                            <div class="form-group col-md-12">
                                <label class="col-form-label">Details Information</label>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Building ID</th>
                                        <td id="building_no_display"></td>
                                    </tr>
                                    <tr>
                                        <th>Building Type</th>
                                        <td id="building_type_display"></td>
                                    </tr>
                                    {{-- <tr>
                                        <th>Block ID</th>
                                        <td id="block_no_display"></td>
                                    </tr> --}}
                                    <tr>
                                        <th>Floor Name</th>
                                        <td id="floor_name_display"></td>
                                    </tr>
                                </table>
                            </div>

                            <button type="submit" class="btn waves-effect waves-light btn-sm"
                                style="background-color: rgb(100, 197, 177); border-color: rgb(100, 197, 177); color: white;">
                                Update Stall</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const typeFullForm = @json($typeFullForm); // Encode PHP array to JSON
        const buildings = @json($buildings);
        const floors = @json($floors);

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
        //                <option value="${block.id}" ${block.id == '{{ $block->id ?? '' }}' ? 'selected' : ''}>${block.name}</option>
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
            }
        }

        function showFloorDetails() {
            const selectedFloorId = document.getElementById('floor_id').value;
            const floor = floors.find(f => f.id == selectedFloorId);

            if (floor) {
                document.getElementById('floor_name_display').innerText = floor.name;

                const dynamicSelectBox = document.getElementById('dynamic-selectboxs');

                // Clear previous select box content
                dynamicSelectBox.innerHTML = '';

                    // Generate the appropriate options for the select box
                    if (floor.is_parking_lot_exist) {
                        dynamicSelectBox.innerHTML += `
                        <option value="parking lot" {{ old('type', $stall->type) === 'parking lot' ? 'selected' : ''  }}>Parking Stall</option>
                        `;
                    }

                    if (floor.is_storage_lot_exist) {
                        dynamicSelectBox.innerHTML += `
                        <option value="storage lot" {{ old('type', $stall->type) === 'storage lot' ? 'selected' : ''  }}>Storage Locker</option>
                        `;
                    }

            }else {
                document.getElementById('floor_name_display').innerText = '';
            }
        }

        window.onload = function() {
            showBuildingDetails();
            showFloorDetails();
        }
    </script>
@endsection
