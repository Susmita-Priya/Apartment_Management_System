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
                            {{-- <li class="breadcrumb-item"><a href="{{ route('floor.show', $floor->id) }}">Floor</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('unit.show', $unit->id) }}">Unit</a></li> --}}
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
                        <form action="{{ route('comarea.update', $comarea->id) }}" enctype="multipart/form-data"
                            method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="unit_id" value="{{ $unit->id }}">

                            <!-- Common area fields -->
                            <div class="form-group">
                                <label for="firelane">Firelane</label>
                                <input type="number" name="firelane" class="form-control"
                                    placeholder="Enter number of firelanes" value="{{ $comarea->firelane }}">
                            </div>

                            <div class="form-group">
                                <label for="building_entrance">Building Entrance</label>
                                <input type="number" name="building_entrance" class="form-control"
                                    placeholder="Enter number of building entrances"
                                    value="{{ $comarea->building_entrance }}">
                            </div>

                            <div class="form-group">
                                <label for="corridors">Corridors</label>
                                <input type="number" name="corridors" class="form-control"
                                    placeholder="Enter number of corridors" value="{{ $comarea->corridors }}">
                            </div>

                            <div class="form-group">
                                <label for="driveways">Driveways</label>
                                <input type="number" name="driveways" class="form-control"
                                    placeholder="Enter number of driveways" value="{{ $comarea->driveways }}">
                            </div>

                            <div class="form-group">
                                <label for="emergency_stairways">Emergency Stairways</label>
                                <input type="number" name="emergency_stairways" class="form-control"
                                    placeholder="Enter number of emergency stairways"
                                    value="{{ $comarea->emergency_stairways }}">
                            </div>

                            <div class="form-group">
                                <label for="garden">Garden</label>
                                <input type="number" name="garden" class="form-control"
                                    placeholder="Enter number of gardens" value="{{ $comarea->garden }}">
                            </div>

                            <div class="form-group">
                                <label for="hallway">Hallway</label>
                                <input type="number" name="hallway" class="form-control"
                                    placeholder="Enter number of hallways" value="{{ $comarea->hallway }}">
                            </div>

                            <div class="form-group">
                                <label for="loading_dock">Loading Dock</label>
                                <input type="number" name="loading_dock" class="form-control"
                                    placeholder="Enter number of loading docks" value="{{ $comarea->loading_dock }}">
                            </div>

                            <div class="form-group">
                                <label for="lobby">Lobby</label>
                                <input type="number" name="lobby" class="form-control"
                                    placeholder="Enter number of lobbies" value="{{ $comarea->lobby }}">
                            </div>

                            <div class="form-group">
                                <label for="parking_entrance">Parking Entrance</label>
                                <input type="number" name="parking_entrance" class="form-control"
                                    placeholder="Enter number of parking entrances"
                                    value="{{ $comarea->parking_entrance }}">
                            </div>

                            <div class="form-group">
                                <label for="patio">Patio</label>
                                <input type="number" name="patio" class="form-control"
                                    placeholder="Enter number of patios" value="{{ $comarea->patio }}">
                            </div>

                            <div class="form-group">
                                <label for="rooftop">Rooftop</label>
                                <input type="number" name="rooftop" class="form-control"
                                    placeholder="Enter number of rooftops" value="{{ $comarea->rooftop }}">
                            </div>

                            <div class="form-group">
                                <label for="stairways">Stairways</label>
                                <input type="number" name="stairways" class="form-control"
                                    placeholder="Enter number of stairways" value="{{ $comarea->stairways }}">
                            </div>

                            <div class="form-group">
                                <label for="walkways">Walkways</label>
                                <input type="number" name="walkways" class="form-control"
                                    placeholder="Enter number of walkways" value="{{ $comarea->walkways }}">
                            </div>

                            <!-- Extra fields editing section -->
                            @foreach ($comarea->extra_fields as $index => $extraField)
                                <div class="form-group dynamic-extra-field">
                                    <label for="field_name">Field Name</label>
                                    <input type="text" name="extra_fields[{{ $index }}][field_name]"
                                        class="form-control" placeholder="Enter field name"
                                        value="{{ $extraField['field_name'] }}">
                                    <label for="quantity">How Many?</label>
                                    <input type="number" name="extra_fields[{{ $index }}][quantity]"
                                        class="form-control" placeholder="Enter number"
                                        value="{{ $extraField['quantity'] }}">
                                    <button type="button" class="btn btn-danger mt-2 remove-extra-field">Remove</button>
                                </div>
                            @endforeach

                            <!-- Button to add more extra fields -->
                            <button type="button" class="btn btn-primary" id="add-extra-field"
                                style="margin-bottom: 20px;">Add Extra Field</button>
                            <div id="dynamic-extra-fields"></div>

                            <button type="submit" class="btn waves-effect waves-light"
                                style="background-color: rgb(100, 197, 177); border-color: rgb(100, 197, 177); color: white;">Update</button>
                        </form>
                    </div>
                </div>
            </div>

            <script>
                let index = {{ count($comarea->extra_fields) }};

                document.getElementById('add-extra-field').addEventListener('click', function() {
                    let div = document.createElement('div');
                    div.classList.add('form-group');
                    div.classList.add('dynamic-extra-field');

                    div.innerHTML = `
                    <label for="field_name">Field Name</label>
                    <input type="text" name="extra_fields[${index}][field_name]" class="form-control" placeholder="Enter field name">
                    <label for="quantity">How Many?</label>
                    <input type="number" name="extra_fields[${index}][quantity]" class="form-control" placeholder="Enter number">
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
