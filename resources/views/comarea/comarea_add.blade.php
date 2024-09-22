@extends('master')

@section('content')
    @push('title')
        <title>Add Common Area</title>
    @endpush

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Add Common Area</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('building') }}">Buildings</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('block.index') }}">Blocks</a></li>

                            <li class="breadcrumb-item active">Add Common Area</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <!-- Display error messages if any -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <form action="{{ route('comarea.store') }}" enctype="multipart/form-data" method="POST">
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


                            <label>Common Areas</label>
                            <div class="form-group">
                                <lable for="hide"> </lable>
                                <input type ="hidden" id="hide">

                            </div>
                            <!-- Common area fields with checkboxes -->
                            @foreach (['firelane' => 'Firelane', 'building_entrance' => 'Building Entrance', 'corridors' => 'Corridors', 'driveways' => 'Driveways', 'emergency_stairways' => 'Emergency Stairways', 'garden' => 'Garden', 'hallway' => 'Hallway', 'loading_dock' => 'Loading Dock', 'lobby' => 'Lobby', 'parking_entrance' => 'Parking Entrance', 'patio' => 'Patio', 'rooftop' => 'Rooftop', 'stairways' => 'Stairways', 'walkways' => 'Walkways'] as $key => $label)
                                <div class="form-group">
                                    <label>
                                        <input type="checkbox" name="{{ $key }}_enabled"
                                            class="common-area-checkbox" value="1"> {{ $label }}
                                    </label>
                                </div>
                            @endforeach

                            <!-- Select All Checkbox -->
                            <div class="form-group">
                                <label style="font-weight: bold; font-size: 18px;">
                                    <i class="mdi mdi-arrow-up rotate-left-up"></i>
                                    <input type="checkbox" id="select-all"> Select All
                                </label>
                            </div>

                            <!-- Extra field button and container -->
                            <button type="button" class="btn btn-primary" id="add-extra-field"
                                style="margin-bottom: 20px;">Add Extra Area</button>
                            <div id="dynamic-extra-fields"></div>

                            <button type="submit" class="btn waves-effect waves-light submitbtn">Submit</button>
                        </form>
                    </div>
                </div>
            </div>

            <script>
                // Handle the "Select All" checkbox functionality
                document.getElementById('select-all').addEventListener('change', function() {
                    let checked = this.checked;
                    document.querySelectorAll('.common-area-checkbox').forEach(checkbox => {
                        checkbox.checked = checked;
                    });
                });

                let index = 0;

                document.getElementById('add-extra-field').addEventListener('click', function() {
                    let div = document.createElement('div');
                    div.classList.add('form-group');
                    div.innerHTML = `
                    <label for="extra_field_${index}">
                         Area Name
                    </label>
                    <input type="text" name="extra_fields[${index}][field_name]" class="form-control" placeholder="Enter area name">
                    <button type="button" class="btn btn-danger mt-2 remove-extra-field">Remove</button>
                    `;
                    document.getElementById('dynamic-extra-fields').appendChild(div);
                    index++;
                });



                // for building and block details

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

                        // // Clear block ID display if no block is selected
                        // document.getElementById('block_id_display').innerText = '';

                        // // Update checkboxes based on building type
                        // const dynamicCheckboxes = document.getElementById('dynamic-checkboxes');
                        // dynamicCheckboxes.innerHTML = ''; // Clear previous checkboxes


                    } else {
                        document.getElementById('building_id_display').innerText = '';
                        document.getElementById('building_type_display').innerText = '';
                        document.getElementById('block_id').innerHTML =
                            '<option value="">Select a building to see blocks.</option>';
                        document.getElementById('block_id_display').innerText = '';
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
        </div>
    </div>
@endsection
