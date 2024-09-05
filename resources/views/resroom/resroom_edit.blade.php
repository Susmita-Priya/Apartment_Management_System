@extends('master')

@section('content')
    @push('title')
        <title>Edit Residential Room</title>
    @endpush

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Edit Residential Room</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('building') }}">Buildings</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('block.show', $block->id) }}">Block</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('floor.show', $floor->id) }}">Floor</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('unit.show', $unit->id) }}">Unit</a></li>
                            <li class="breadcrumb-item active">Edit Residential Room</li>
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
                        @if ($unit->type == 'Residential Suite')
                            <form action="{{ route('resroom.update', $resroom->id) }}" enctype="multipart/form-data"
                                method="POST">
                                @csrf

                                <input type="hidden" name="unit_id" value="{{ $unit->id }}">

                                <!-- Common room fields -->
                                <div class="form-group">
                                    <label for="bedroom">Bedroom</label>
                                    <input type="number" name="bedroom" class="form-control"
                                        value="{{ $resroom->bedroom }}" placeholder="Enter number of bedrooms">
                                </div>

                                <div class="form-group">
                                    <label for="bathroom">Bathroom</label>
                                    <input type="number" name="bathroom" class="form-control"
                                        value="{{ $resroom->bathroom }}" placeholder="Enter number of bathrooms">
                                </div>

                                <div class="form-group">
                                    <label for="balcony">Balcony</label>
                                    <input type="number" name="balcony" class="form-control"
                                        value="{{ $resroom->balcony }}" placeholder="Enter number of balconies">
                                </div>

                                <div class="form-group">
                                    <label for="dining_room">Dining Room</label>
                                    <input type="number" name="dining_room" class="form-control"
                                        value="{{ $resroom->dining_room }}" placeholder="Enter number of dining rooms">
                                </div>

                                <div class="form-group">
                                    <label for="library_room">Library Room</label>
                                    <input type="number" name="library_room" class="form-control"
                                        value="{{ $resroom->library_room }}" placeholder="Enter number of library rooms">
                                </div>

                                <div class="form-group">
                                    <label for="kitchen">Kitchen</label>
                                    <input type="number" name="kitchen" class="form-control"
                                        value="{{ $resroom->kitchen }}" placeholder="Enter number of kitchens">
                                </div>

                                <div class="form-group">
                                    <label for="storeroom">Storeroom</label>
                                    <input type="number" name="storeroom" class="form-control"
                                        value="{{ $resroom->storeroom }}" placeholder="Enter number of storerooms">
                                </div>

                                <div class="form-group">
                                    <label for="laundry">Laundry</label>
                                    <input type="number" name="laundry" class="form-control"
                                        value="{{ $resroom->laundry }}" placeholder="Enter number of laundries">
                                </div>

                                <div class="form-group">
                                    <label for="solarium">Solarium</label>
                                    <input type="number" name="solarium" class="form-control"
                                        value="{{ $resroom->solarium }}" placeholder="Enter number of solariums">
                                </div>

                                <div class="form-group">
                                    <label for="washroom">Washroom</label>
                                    <input type="number" name="washroom" class="form-control"
                                        value="{{ $resroom->washroom }}" placeholder="Enter number of washrooms">
                                </div>

                                <!-- Extra room fields -->
                                <div id="dynamic-room-fields">
                                    @foreach ($resroom->extraRooms as $index => $extraRoom)
                                        <div class="form-group dynamic-room">
                                            <input type="hidden" name="extra_rooms[{{ $index }}][id]"
                                                value="{{ $extraRoom->id }}">
                                            <label for="room_name">Room Name</label>
                                            <input type="text" name="extra_rooms[{{ $index }}][room_name]"
                                                class="form-control" value="{{ $extraRoom->room_name }}"
                                                placeholder="Enter room name">
                                            <label for="quantity">How Many?</label>
                                            <input type="number" name="extra_rooms[{{ $index }}][quantity]"
                                                class="form-control" value="{{ $extraRoom->quantity }}"
                                                placeholder="Enter number of rooms">
                                            <button type="button"
                                                class="btn btn-danger mt-2 remove-room-field">Remove</button>
                                        </div>
                                    @endforeach
                                </div>

                                <button type="button" class="btn btn-primary" id="add-room-field"
                                    style="margin-bottom: 20px;">Add Extra Room</button>

                                <button type="submit" class="btn waves-effect waves-light"
                                    style="background-color: rgb(100, 197, 177); border-color: rgb(100, 197, 177); color: white;">Update</button>
                            </form>
                        @else
                            <p>This page is only applicable for Residential Suites.</p>
                        @endif
                    </div>
                </div>
            </div>

            <script>
                let index = {{ count($resroom->extra_rooms ?? []) }};

                document.getElementById('add-room-field').addEventListener('click', function() {
                    let div = document.createElement('div');
                    div.classList.add('form-group');
                    div.classList.add('dynamic-room');

                    div.innerHTML = `
                    <label for="room_name">Room Name</label>
                    <input type="text" name="extra_rooms[\${index}][room_name]" class="form-control" placeholder="Enter room name">
                    <label for="quantity">How Many?</label>
                    <input type="number" name="extra_rooms[\${index}][quantity]" class="form-control" placeholder="Enter number of rooms">
                    <button type="button" class="btn btn-danger mt-2 remove-extra-field">Remove</button>
                `;

                    document.getElementById('dynamic-room-fields').appendChild(div);
                    index++;
                });

                // document.addEventListener('click', function(e) {
                //     if (e.target && e.target.classList.contains('remove-room-field')) {
                //         e.target.parentElement.remove();
                //     }
                // });
            </script>
        @endsection
