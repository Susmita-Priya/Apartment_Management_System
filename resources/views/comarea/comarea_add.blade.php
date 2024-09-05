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
                            <li class="breadcrumb-item"><a href="{{ route('block.show', $block->id) }}">Block</a></li>
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
                            <input type="hidden" name="unit_id" value="{{ $unit->id }}">

                            <!-- Common area fields with checkboxes -->
                            <div class="form-group">
                                <label for="firelane">
                                    <input type="checkbox" name="firelane_enabled" value="1"> Firelane
                                </label>
                            </div>

                            <div class="form-group">
                                <label for="building_entrance">
                                    <input type="checkbox" name="building_entrance_enabled" value="1"> Building Entrance
                                </label>
                            </div>

                            <div class="form-group">
                                <label for="corridors">
                                    <input type="checkbox" name="corridors_enabled" value="1"> Corridors
                                </label>
                            </div>

                            <div class="form-group">
                                <label for="driveways">
                                    <input type="checkbox" name="driveways_enabled" value="1"> Driveways
                                </label>
                            </div>

                            <div class="form-group">
                                <label for="emergency_stairways">
                                    <input type="checkbox" name="emergency_stairways_enabled" value="1"> Emergency Stairways
                                </label>
                            </div>

                            <div class="form-group">
                                <label for="garden">
                                    <input type="checkbox" name="garden_enabled" value="1"> Garden
                                </label>
                            </div>

                            <div class="form-group">
                                <label for="hallway">
                                    <input type="checkbox" name="hallway_enabled" value="1"> Hallway
                                </label>
                            </div>

                            <div class="form-group">
                                <label for="loading_dock">
                                    <input type="checkbox" name="loading_dock_enabled" value="1"> Loading Dock
                                </label>
                            </div>

                            <div class="form-group">
                                <label for="lobby">
                                    <input type="checkbox" name="lobby_enabled" value="1"> Lobby
                                </label>
                            </div>

                            <div class="form-group">
                                <label for="parking_entrance">
                                    <input type="checkbox" name="parking_entrance_enabled" value="1"> Parking Entrance
                                </label>
                            </div>

                            <div class="form-group">
                                <label for="patio">
                                    <input type="checkbox" name="patio_enabled" value="1"> Patio
                                </label>
                            </div>

                            <div class="form-group">
                                <label for="rooftop">
                                    <input type="checkbox" name="rooftop_enabled" value="1"> Rooftop
                                </label>
                            </div>

                            <div class="form-group">
                                <label for="stairways">
                                    <input type="checkbox" name="stairways_enabled" value="1"> Stairways
                                </label>
                            </div>

                            <div class="form-group">
                                <label for="walkways">
                                    <input type="checkbox" name="walkways_enabled" value="1"> Walkways
                                </label>
                            </div>

                            <!-- Extra field button and container -->
                            <button type="button" class="btn btn-primary" id="add-extra-field"
                                style="margin-bottom: 20px;">Add Extra Area</button>
                            <div id="dynamic-extra-fields"></div>

                            <button type="submit" class="btn waves-effect waves-light"
                                style="background-color: rgb(100, 197, 177); border-color: rgb(100, 197, 177); color: white;">Submit</button>
                        </form>
                    </div>
                </div>
            </div>

            <script>
                let index = 0;

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
