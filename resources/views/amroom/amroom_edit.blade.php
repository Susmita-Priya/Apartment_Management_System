@extends('master')

@section('content')
    @push('title')
        <title>Edit Amenity Room</title>
    @endpush

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Edit Amenity Room</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('building') }}">Buildings</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('block.show', $block->id) }}">Block</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('floor.show', $floor->id) }}">Floor</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('unit.show', $unit->id) }}">Unit</a></li>
                            <li class="breadcrumb-item active">Edit Amenity Room</li>
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
                        @if ($unit->type == 'Supporting and Servicing Unit')
                            <form action="{{ route('amroom.update', $amroom->id) }}" enctype="multipart/form-data"
                                method="POST">
                                @csrf

                                <input type="hidden" name="unit_id" value="{{ $unit->id }}">

                                <!-- Amenity room fields -->
                                <div class="form-group">
                                    <label for="balcony">Balcony</label>
                                    <input type="number" name="balcony" class="form-control" value="{{ $amroom->balcony }}"
                                        placeholder="Enter number of balconies">
                                </div>

                                <div class="form-group">
                                    <label for="business_center">Business Center</label>
                                    <input type="number" name="business_center" class="form-control"
                                        value="{{ $amroom->business_center }}"
                                        placeholder="Enter number of business centers">
                                </div>

                                <div class="form-group">
                                    <label for="gym">Gym</label>
                                    <input type="number" name="gym" class="form-control" value="{{ $amroom->gym }}"
                                        placeholder="Enter number of gyms">
                                </div>

                                <div class="form-group">
                                    <label for="hot_tub">Hot Tub</label>
                                    <input type="number" name="hot_tub" class="form-control"
                                        value="{{ $amroom->hot_tub }}" placeholder="Enter number of hot tubs">
                                </div>

                                <div class="form-group">
                                    <label for="laundry_room">Laundry Room</label>
                                    <input type="number" name="laundry_room" class="form-control"
                                        value="{{ $amroom->laundry_room }}" placeholder="Enter number of laundry rooms">
                                </div>

                                <div class="form-group">
                                    <label for="library">Library</label>
                                    <input type="number" name="library" class="form-control"
                                        value="{{ $amroom->library }}" placeholder="Enter number of libraries">
                                </div>

                                <div class="form-group">
                                    <label for="meeting_room">Meeting Room</label>
                                    <input type="number" name="meeting_room" class="form-control"
                                        value="{{ $amroom->meeting_room }}" placeholder="Enter number of meeting rooms">
                                </div>

                                <div class="form-group">
                                    <label for="mens_changing_room">Men's Changing Room</label>
                                    <input type="number" name="mens_changing_room" class="form-control"
                                        value="{{ $amroom->mens_changing_room }}"
                                        placeholder="Enter number of men's changing rooms">
                                </div>

                                <div class="form-group">
                                    <label for="restaurant">Restaurant</label>
                                    <input type="number" name="restaurant" class="form-control"
                                        value="{{ $amroom->restaurant }}" placeholder="Enter number of restaurants">
                                </div>

                                <div class="form-group">
                                    <label for="room_deck">Room Deck</label>
                                    <input type="number" name="room_deck" class="form-control"
                                        value="{{ $amroom->room_deck }}" placeholder="Enter number of room decks">
                                </div>

                                <div class="form-group">
                                    <label for="sauna">Sauna</label>
                                    <input type="number" name="sauna" class="form-control"
                                        value="{{ $amroom->sauna }}" placeholder="Enter number of saunas">
                                </div>

                                <div class="form-group">
                                    <label for="swimming_pool">Swimming Pool</label>
                                    <input type="number" name="swimming_pool" class="form-control"
                                        value="{{ $amroom->swimming_pool }}"
                                        placeholder="Enter number of swimming pools">
                                </div>

                                <div class="form-group">
                                    <label for="theater_room">Theater Room</label>
                                    <input type="number" name="theater_room" class="form-control"
                                        value="{{ $amroom->theater_room }}" placeholder="Enter number of theater rooms">
                                </div>

                                <div class="form-group">
                                    <label for="womens_changing_room">Woman's Changing Room</label>
                                    <input type="number" name="womens_changing_room" class="form-control"
                                        value="{{ $amroom->womens_changing_room }}"
                                        placeholder="Enter number of woman's changing rooms">
                                </div>

                                <div class="form-group">
                                    <label for="patio">Patio</label>
                                    <input type="number" name="patio" class="form-control"
                                        value="{{ $amroom->patio }}" placeholder="Enter number of patios">
                                </div>

                                <!-- Extra room fields -->
                                <button type="button" class="btn btn-primary" id="add-room-field"
                                    style="margin-bottom: 20px;">Add Extra Room</button>
                                <div id="dynamic-room-fields">
                                    @foreach ($amroom->extraRooms as $index => $extraRoom)
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

                                <button type="submit" class="btn waves-effect waves-light"
                                    style="background-color: rgb(100, 197, 177); border-color: rgb(100, 197, 177); color: white;">Update</button>
                            </form>
                        @else
                            <p>This page is only applicable for Amenity Units.</p>
                        @endif
                    </div>
                </div>
            </div>

            <script>
                let index = {{ count($amroom->extraRooms) }};

                document.getElementById('add-room-field').addEventListener('click', function() {
                    let div = document.createElement('div');
                    div.classList.add('form-group');
                    div.classList.add('dynamic-room');

                    div.innerHTML = `
                    <label for="room_name">Room Name</label>
                    <input type="text" name="extra_rooms[${index}][room_name]" class="form-control" placeholder="Enter room name">
                    <label for="quantity">How Many?</label>
                    <input type="number" name="extra_rooms[${index}][quantity]" class="form-control" placeholder="Enter number of rooms">
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
        </div>
    </div>
@endsection
