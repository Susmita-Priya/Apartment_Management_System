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
                                <label for="building_id">Select Building</label>
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
                                <label for="block_id">Select Block</label>
                                <select name="block_id" id="block_id" class="form-control" onchange="showBlockDetails()">
                                    <option value="">Select Block</option>
                                    @foreach ($blocks as $blk)
                                        <option value="{{ $blk->id }}"
                                            {{ $block->id == $blk->id ? 'selected' : '' }}>
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
                                <input type="number" name="floor_no" id="floor_no" class="form-control" value="{{ $floor->floor_no }}" required>
                            </div>

                            <div class="form-group">
                                <label for="name">Floor Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $floor->name }}">
                            </div>

                            <div class="form-group">
                                <label for="type">Floor Type</label>
                                <select name="type" id="type" class="form-control" required>
                                    <option value="rooftop" {{ $floor->type == 'rooftop' ? 'selected' : '' }}>Rooftop</option>
                                    <option value="upper" {{ $floor->type == 'upper' ? 'selected' : '' }}>Upper</option>
                                    <option value="ground" {{ $floor->type == 'ground' ? 'selected' : '' }}>Ground</option>
                                    <option value="underground" {{ $floor->type == 'underground' ? 'selected' : '' }}>Underground</option>
                                </select>
                            </div>
                            <label> Floor Features </label>
                            <div class="alert alert-primary">
                                <ul>
                                    <li>{{ 'Please select one of the following: Residential Suite, Commercial Unit, or Supporting & Service Room.' }}</li>
                                    <li>{{ 'Alternatively, you may select Parking Lot or Storage options.' }}</li>
                                </ul>
                            </div>

                            <!-- Checkbox placeholders -->
                            <div id="dynamic-checkboxes">
                                @if ($floor->building->type === 'RESB')
                                    <div class="form-group">
                                        <label><input type="checkbox" name="residential_suite" {{ $floor->residential_suite ? 'checked' : '' }}> Residential Suite</label>
                                    </div>
                                @elseif ($floor->building->type === 'COMB')
                                    <div class="form-group">
                                        <label><input type="checkbox" name="commercial_unit" {{ $floor->commercial_unit ? 'checked' : '' }}> Commercial Unit</label>
                                    </div>
                                @elseif ($floor->building->type === 'RECB')
                                    <div class="form-group">
                                        <label><input type="checkbox" name="residential_suite" {{ $floor->residential_suite ? 'checked' : '' }}> Residential Suite</label>
                                    </div>
                                    <div class="form-group">
                                        <label><input type="checkbox" name="commercial_unit" {{ $floor->commercial_unit ? 'checked' : '' }}> Commercial Unit</label>
                                    </div>
                                @endif
                            </div>

                            <!-- Supporting checkboxes -->
                            <div class="form-group">
                                <label><input type="checkbox" name="supporting_service_room" {{ $floor->supporting_service_room ? 'checked' : '' }}> Supporting & Service Room</label>
                            </div>
                            <div class="form-group">
                                <label><input type="checkbox" name="parking_lot" {{ $floor->parking_lot ? 'checked' : '' }}> Parking Lot</label>
                            </div>
                            {{-- <div class="form-group">
                                <label><input type="checkbox" name="bike_lot" {{ $floor->bike_lot ? 'checked' : '' }}> Bike Lot</label>
                            </div> --}}
                            <div class="form-group">
                                <label><input type="checkbox" name="storage_lot" {{ $floor->storage_lot ? 'checked' : '' }}> Storage Lot</label>
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
                        <option value="${block.id}" ${block.id == '{{ $floor->block_id }}' ? 'selected' : ''}>${block.name}</option>
                    `;
                });

                if (buildingBlocks.length === 0) {
                    blockSelect.innerHTML = '<option value="">No blocks available for the selected building.</option>';
                }

                document.getElementById('block_id_display').innerText = '';

                const dynamicCheckboxes = document.getElementById('dynamic-checkboxes');
                dynamicCheckboxes.innerHTML = '';

                if (building.type === 'RESB') {
                    dynamicCheckboxes.innerHTML = `
                        <div class="form-group">
                            <label><input type="checkbox" name="residential_suite" ${'{{ $floor->residential_suite }}' ? 'checked' : ''}> Residential Suite</label>
                        </div>
                    `;
                } else if (building.type === 'COMB') {
                    dynamicCheckboxes.innerHTML = `
                        <div class="form-group">
                            <label><input type="checkbox" name="commercial_unit" ${'{{ $floor->commercial_unit }}' ? 'checked' : ''}> Commercial Unit</label>
                        </div>
                    `;
                } else if (building.type === 'RECB') {
                    dynamicCheckboxes.innerHTML = `
                        <div class="form-group">
                            <label><input type="checkbox" name="residential_suite" ${'{{ $floor->residential_suite }}' ? 'checked' : ''}> Residential Suite</label>
                        </div>
                        <div class="form-group">
                            <label><input type="checkbox" name="commercial_unit" ${'{{ $floor->commercial_unit }}' ? 'checked' : ''}> Commercial Unit</label>
                        </div>
                    `;
                }
            } else {
                document.getElementById('building_id_display').innerText = '';
                document.getElementById('building_type_display').innerText = '';
                document.getElementById('block_id').innerHTML = '<option value="">Select Block</option>';
                document.getElementById('block_id_display').innerText = '';
            }
        }

        function showBlockDetails() {
            const selectedBlockId = document.getElementById('block_id').value;
            const block = blocks.find(b => b.id == selectedBlockId);

            if (block) {
                document.getElementById('block_id_display').innerText = block.block_id;
            } else {
                document.getElementById('block_id_display').innerText = '';
            }
        }

        // Initial call to populate the details if there's a pre-selected building and block
        document.addEventListener('DOMContentLoaded', function() {
            showBuildingDetails();
            showBlockDetails();
        });
    </script>
@endsection
