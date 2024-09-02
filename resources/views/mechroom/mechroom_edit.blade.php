@extends('master')

@section('content')
@push('title')
    <title>Edit Mechanical Room</title>
@endpush

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title float-left">Edit Mechanical Room</h4>

                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('building') }}">Buildings</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('block.show', $block->id) }}">Block</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('floor.show', $floor->id) }}">Floor</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('unit.show', $unit->id) }}">Unit</a></li>
                        <li class="breadcrumb-item active">Edit Mechanical Room</li>
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
                    @if($unit->type == 'Supporting and Servicing Unit')
                        <form action="{{ route('mechroom.update', $mechroom->id) }}" enctype="multipart/form-data" method="POST">
                            @csrf
                  
                            <input type="hidden" name="unit_id" value="{{ $unit->id }}">
                            
                            <!-- Mechanical room fields -->
                            <div class="form-group">
                                <label for="backup_generator">Backup Generator</label>
                                <input type="number" name="backup_generator" class="form-control" value="{{ $mechroom->backup_generator }}" placeholder="Enter number of backup generators">
                            </div>

                            <div class="form-group">
                                <label for="boilers_room">Boilers Room</label>
                                <input type="number" name="boilers_room" class="form-control" value="{{ $mechroom->boilers_room }}" placeholder="Enter number of boilers rooms">
                            </div>

                            <div class="form-group">
                                <label for="compactor_room">Compactor Room</label>
                                <input type="number" name="compactor_room" class="form-control" value="{{ $mechroom->compactor_room }}" placeholder="Enter number of compactor rooms">
                            </div>

                            <div class="form-group">
                                <label for="electrical_room">Electrical Room</label>
                                <input type="number" name="electrical_room" class="form-control" value="{{ $mechroom->electrical_room }}" placeholder="Enter number of electrical rooms">
                            </div>

                            <div class="form-group">
                                <label for="elevator_mechanical_room">Elevator Mechanical Room</label>
                                <input type="number" name="elevator_mechanical_room" class="form-control" value="{{ $mechroom->elevator_mechanical_room }}" placeholder="Enter number of elevator mechanical rooms">
                            </div>

                            <div class="form-group">
                                <label for="elevators_pit_room">Elevators Pit Room</label>
                                <input type="number" name="elevators_pit_room" class="form-control" value="{{ $mechroom->elevators_pit_room }}" placeholder="Enter number of elevators pit rooms">
                            </div>

                            <div class="form-group">
                                <label for="elevators_room">Elevators Room</label>
                                <input type="number" name="elevators_room" class="form-control" value="{{ $mechroom->elevators_room }}" placeholder="Enter number of elevators rooms">
                            </div>

                            <div class="form-group">
                                <label for="emergency_hydro_room">Emergency Hydro Room</label>
                                <input type="number" name="emergency_hydro_room" class="form-control" value="{{ $mechroom->emergency_hydro_room }}" placeholder="Enter number of emergency hydro rooms">
                            </div>

                            <div class="form-group">
                                <label for="fan_room">Fan Room</label>
                                <input type="number" name="fan_room" class="form-control" value="{{ $mechroom->fan_room }}" placeholder="Enter number of fan rooms">
                            </div>

                            <div class="form-group">
                                <label for="fire_extinguishers">Fire Extinguishers</label>
                                <input type="number" name="fire_extinguishers" class="form-control" value="{{ $mechroom->fire_extinguishers }}" placeholder="Enter number of fire extinguishers">
                            </div>

                            <div class="form-group">
                                <label for="fire_panel">Fire Panel</label>
                                <input type="number" name="fire_panel" class="form-control" value="{{ $mechroom->fire_panel }}" placeholder="Enter number of fire panels">
                            </div>

                            <div class="form-group">
                                <label for="garbage_chute">Garbage Chute</label>
                                <input type="number" name="garbage_chute" class="form-control" value="{{ $mechroom->garbage_chute }}" placeholder="Enter number of garbage chutes">
                            </div>

                            <div class="form-group">
                                <label for="hvac_mechanical_room">HVAC Mechanical Room</label>
                                <input type="number" name="hvac_mechanical_room" class="form-control" value="{{ $mechroom->hvac_mechanical_room }}" placeholder="Enter number of HVAC mechanical rooms">
                            </div>

                            <div class="form-group">
                                <label for="hydro_room">Hydro Room</label>
                                <input type="number" name="hydro_room" class="form-control" value="{{ $mechroom->hydro_room }}" placeholder="Enter number of hydro rooms">
                            </div>

                            <div class="form-group">
                                <label for="mechanical_room">Mechanical Room</label>
                                <input type="number" name="mechanical_room" class="form-control" value="{{ $mechroom->mechanical_room }}" placeholder="Enter number of mechanical rooms">
                            </div>

                            <div class="form-group">
                                <label for="phone_cable_room">Phone & Cable Room</label>
                                <input type="number" name="phone_cable_room" class="form-control" value="{{ $mechroom->phone_cable_room }}" placeholder="Enter number of phone & cable rooms">
                            </div>

                            <div class="form-group">
                                <label for="recycling_room">Recycling Room</label>
                                <input type="number" name="recycling_room" class="form-control" value="{{ $mechroom->recycling_room }}" placeholder="Enter number of recycling rooms">
                            </div>

                            <div class="form-group">
                                <label for="sprinklers_room">Sprinklers Room</label>
                                <input type="number" name="sprinklers_room" class="form-control" value="{{ $mechroom->sprinklers_room }}" placeholder="Enter number of sprinklers rooms">
                            </div>

                            <div class="form-group">
                                <label for="swimming_pool_mechanical_room">Swimming Pool Mechanical Room</label>
                                <input type="number" name="swimming_pool_mechanical_room" class="form-control" value="{{ $mechroom->swimming_pool_mechanical_room }}" placeholder="Enter number of swimming pool mechanical rooms">
                            </div>

                            <div class="form-group">
                                <label for="water_pump_room">Water Pump Room</label>
                                <input type="number" name="water_pump_room" class="form-control" value="{{ $mechroom->water_pump_room }}" placeholder="Enter number of water pump rooms">
                            </div>

                            <!-- Extra room fields -->
                            <button type="button" class="btn btn-primary" id="add-room-field" style="margin-bottom: 20px;">Add Extra Room</button>
                            <div id="dynamic-room-fields">
                                @foreach($mechroom->extraRooms as $index => $extraRoom)
                                    <div class="form-group dynamic-room">
                                        <input type="hidden" name="extra_rooms[{{ $index }}][id]" value="{{ $extraRoom->id }}">
                                        <label for="room_name">Room Name</label>
                                        <input type="text" name="extra_rooms[{{ $index }}][room_name]" class="form-control" value="{{ $extraRoom->room_name }}" placeholder="Enter room name">
                                        <label for="quantity">How Many?</label>
                                        <input type="number" name="extra_rooms[{{ $index }}][quantity]" class="form-control" value="{{ $extraRoom->quantity }}" placeholder="Enter number of rooms">
                                        <button type="button" class="btn btn-danger mt-2 remove-room-field">Remove</button>
                                    </div>
                                @endforeach
                            </div>
                            
                            

                            <button type="submit" class="btn waves-effect waves-light"
                            style="background-color: rgb(100, 197, 177); border-color: rgb(100, 197, 177); color: white;">Update</button>
                        </form>
                    @else
                        <p>This page is only applicable for Mechanical Units.</p>
                    @endif
                </div>
            </div>
        </div>

        <script>
            let index = {{ count($mechroom->extraRooms) }};

            document.getElementById('add-room-field').addEventListener('click', function () {
                let div = document.createElement('div');
                div.classList.add('form-group');
                div.classList.add('dynamic-room');

                div.innerHTML = `
                    <label for="room_name">Room Name</label>
                    <input type="text" name="extra_rooms[${index}][room_name]" class="form-control" placeholder="Enter room name">
                    <label for="quantity">How Many?</label>
                    <input type="number" name="extra_rooms[${index}][quantity]" class="form-control" placeholder="Enter number of rooms">
                    <button type="button" class="btn btn-danger mt-2 remove-room-field">Remove</button>
                `;

                document.getElementById('dynamic-room-fields').appendChild(div);
                index++;
            });

            document.addEventListener('click', function (e) {
                if (e.target && e.target.classList.contains('remove-room-field')) {
                    e.target.parentElement.remove();
                }
            });
        </script>
    </div>
</div>
@endsection
