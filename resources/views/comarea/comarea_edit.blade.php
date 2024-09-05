@extends('master')

@section('content')
    @push('title')
        <title>Edit Common Area</title>
    @endpush

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Edit Common Area</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('building') }}">Buildings</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('block.show', $block->id) }}">Block</a></li>
                            <li class="breadcrumb-item active">Edit Common Area</li>
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
                        <form action="{{ route('comarea.update', $comarea->id) }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="block_id" value="{{ $block->id }}">

                            <!-- Common area fields with checkboxes -->
                            <div class="form-group">
                                <label for="firelane">
                                    <input type="checkbox" name="firelane_enabled" value="1" {{ $comarea->firelane_enabled ? 'checked' : '' }}> Firelane
                                </label>
                            </div>

                            <div class="form-group">
                                <label for="building_entrance">
                                    <input type="checkbox" name="building_entrance_enabled" value="1" {{ $comarea->building_entrance_enabled ? 'checked' : '' }}> Building Entrance
                                </label>
                            </div>

                            <div class="form-group">
                                <label for="corridors">
                                    <input type="checkbox" name="corridors_enabled" value="1" {{ $comarea->corridors_enabled ? 'checked' : '' }}> Corridors
                                </label>
                            </div>

                            <div class="form-group">
                                <label for="driveways">
                                    <input type="checkbox" name="driveways_enabled" value="1" {{ $comarea->driveways_enabled ? 'checked' : '' }}> Driveways
                                </label>
                            </div>

                            <div class="form-group">
                                <label for="emergency_stairways">
                                    <input type="checkbox" name="emergency_stairways_enabled" value="1" {{ $comarea->emergency_stairways_enabled ? 'checked' : '' }}> Emergency Stairways
                                </label>
                            </div>

                            <div class="form-group">
                                <label for="garden">
                                    <input type="checkbox" name="garden_enabled" value="1" {{ $comarea->garden_enabled ? 'checked' : '' }}> Garden
                                </label>
                            </div>

                            <div class="form-group">
                                <label for="hallway">
                                    <input type="checkbox" name="hallway_enabled" value="1" {{ $comarea->hallway_enabled ? 'checked' : '' }}> Hallway
                                </label>
                            </div>

                            <div class="form-group">
                                <label for="loading_dock">
                                    <input type="checkbox" name="loading_dock_enabled" value="1" {{ $comarea->loading_dock_enabled ? 'checked' : '' }}> Loading Dock
                                </label>
                            </div>

                            <div class="form-group">
                                <label for="lobby">
                                    <input type="checkbox" name="lobby_enabled" value="1" {{ $comarea->lobby_enabled ? 'checked' : '' }}> Lobby
                                </label>
                            </div>

                            <div class="form-group">
                                <label for="parking_entrance">
                                    <input type="checkbox" name="parking_entrance_enabled" value="1" {{ $comarea->parking_entrance_enabled ? 'checked' : '' }}> Parking Entrance
                                </label>
                            </div>

                            <div class="form-group">
                                <label for="patio">
                                    <input type="checkbox" name="patio_enabled" value="1" {{ $comarea->patio_enabled ? 'checked' : '' }}> Patio
                                </label>
                            </div>

                            <div class="form-group">
                                <label for="rooftop">
                                    <input type="checkbox" name="rooftop_enabled" value="1" {{ $comarea->rooftop_enabled ? 'checked' : '' }}> Rooftop
                                </label>
                            </div>

                            <div class="form-group">
                                <label for="stairways">
                                    <input type="checkbox" name="stairways_enabled" value="1" {{ $comarea->stairways_enabled ? 'checked' : '' }}> Stairways
                                </label>
                            </div>

                            <div class="form-group">
                                <label for="walkways">
                                    <input type="checkbox" name="walkways_enabled" value="1" {{ $comarea->walkways_enabled ? 'checked' : '' }}> Walkways
                                </label>
                            </div>

                            <!-- Existing extra fields -->
                            @if ($comarea->extra_fields)
                                @foreach ($comarea->extra_fields as $index => $extra_field)
                                    <div class="form-group dynamic-extra-field">
                                        <label for="extra_field_{{ $index }}">
                                            <input type="checkbox" name="extra_fields[{{ $index }}][enabled]" value="1" {{ $extra_field['enabled'] ? 'checked' : '' }}> Area Name
                                        </label>
                                        <input type="text" name="extra_fields[{{ $index }}][field_name]" class="form-control"
                                            value="{{ $extra_field['field_name'] }}" placeholder="Enter area name">
                                        <button type="button" class="btn btn-danger mt-2 remove-extra-field">Remove</button>
                                    </div>
                                @endforeach
                            @endif

                            <!-- Add new extra field button -->
                            <button type="button" class="btn btn-primary" id="add-extra-field" style="margin-bottom: 20px;">Add Extra Area</button>
                            <div id="dynamic-extra-fields"></div>

                            <button type="submit" class="btn waves-effect waves-light" style="background-color: rgb(100, 197, 177); border-color: rgb(100, 197, 177); color: white;">Update</button>
                        </form>
                    </div>
                </div>
            </div>

            <script>
                let index = {{ count($comarea->extra_fields ?? []) }};

                document.getElementById('add-extra-field').addEventListener('click', function() {
                    let div = document.createElement('div');
                    div.classList.add('form-group');
                    div.classList.add('dynamic-extra-field');

                    div.innerHTML = `
                    <label for="extra_field_${index}">
                        <input type="checkbox" name="extra_fields[${index}][enabled]" value="1"> Area Name
                    </label>
                    <input type="text" name="extra_fields[${index}][field_name]" class="form-control" placeholder="Enter area name">
                    <button type="button" class="btn btn-danger mt-2 remove-extra-field">Remove</button>
                `;

                    document.getElementById('dynamic-extra-fields').appendChild(div);
                    index++;
                });

                document.addEventListener('click', function(e) {
                    if (e.target && e.target.classList.contains('remove-extra-field')) {
                        e.target.parentElement.remove();
                    }
                });
            </script>
        </div>
    </div>
@endsection
