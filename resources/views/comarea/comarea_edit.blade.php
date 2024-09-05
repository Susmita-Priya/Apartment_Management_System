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
                            <input type="hidden" name="block_id" value="{{ $block->id }}">

                            <!-- Common area fields with checkboxes -->
                            @foreach (['firelane' => 'Firelane', 'building_entrance' => 'Building Entrance', 'corridors' => 'Corridors', 'driveways' => 'Driveways', 'emergency_stairways' => 'Emergency Stairways', 'garden' => 'Garden', 'hallway' => 'Hallway', 'loading_dock' => 'Loading Dock', 'lobby' => 'Lobby', 'parking_entrance' => 'Parking Entrance', 'patio' => 'Patio', 'rooftop' => 'Rooftop', 'stairways' => 'Stairways', 'walkways' => 'Walkways'] as $key => $label)
                                <div class="form-group">
                                    <label>
                                        <input type="checkbox" name="{{ $key }}_enabled"
                                            class="common-area-checkbox" value="0"
                                            {{ $comarea->{$key} ? 'checked' : '' }}> {{ $label }}
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

                            <!-- Extra fields section -->
                            <button type="button" class="btn btn-primary" id="add-extra-field" style="margin-bottom: 20px;">Add Extra Area</button>

                            <!-- Existing extra fields -->
                            <div id="dynamic-extra-fields">
                                @foreach ($comarea->extraFields as $index => $extraField)
                                    <div class="form-group">
                                        <label for="extra_field_{{ $index }}">
                                            Area Name
                                        </label>
                                        <input type="text" name="extra_fields[{{ $index }}][field_name]" class="form-control" value="{{ $extraField->field_name }}">
                                        <button type="button" class="btn btn-danger mt-2 remove-extra-field">Remove</button>
                                    </div>
                                @endforeach
                            </div>

                            <button type="submit" class="btn waves-effect waves-light"
                                style="background-color: rgb(100, 197, 177); border-color: rgb(100, 197, 177); color: white;">Update</button>
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

                let index = {{ $comarea->extraFields->count() }}; // Start with the count of existing extra fields

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

            </script>
        </div>
    </div>
@endsection
