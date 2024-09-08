@extends('master')

@section('content')
    @push('title')
        <title>Add Service Room</title>
    @endpush

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Add Service Room</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('building') }}">Buildings</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('block.show', $block->id) }}">Block</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('floor.show', $floor->id) }}">Floor</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('unit.show', $unit->id) }}">Unit</a></li>
                            <li class="breadcrumb-item active">Add Service Room</li>
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
                            <form action="{{ route('serroom.store') }}" enctype="multipart/form-data" method="POST">
                                @csrf
                                <input type="hidden" name="unit_id" value="{{ $unit->id }}">

                                <!-- Service room fields -->
                                <div class="form-group">
                                    <label for="garbage_chute">Garbage Chute</label>
                                    <input type="number" name="garbage_chute" class="form-control"
                                        placeholder="Enter number of garbage chutes">
                                </div>

                                <div class="form-group">
                                    <label for="garbage_recycling_room">Garbage Recycling Room</label>
                                    <input type="number" name="garbage_recycling_room" class="form-control"
                                        placeholder="Enter number of garbage recycling rooms">
                                </div>

                                <div class="form-group">
                                    <label for="inventory_rooms">Inventory Rooms</label>
                                    <input type="number" name="inventory_rooms" class="form-control"
                                        placeholder="Enter number of inventory rooms">
                                </div>

                                <div class="form-group">
                                    <label for="janitorial_room">Janitorial Room</label>
                                    <input type="number" name="janitorial_room" class="form-control"
                                        placeholder="Enter number of janitorial rooms">
                                </div>

                                <div class="form-group">
                                    <label for="laundry_room">Laundry Room</label>
                                    <input type="number" name="laundry_room" class="form-control"
                                        placeholder="Enter number of laundry rooms">
                                </div>

                                <div class="form-group">
                                    <label for="loading_dock">Loading Dock</label>
                                    <input type="number" name="loading_dock" class="form-control"
                                        placeholder="Enter number of loading docks">
                                </div>

                                <div class="form-group">
                                    <label for="lobby">Lobby</label>
                                    <input type="number" name="lobby" class="form-control"
                                        placeholder="Enter number of lobbies">
                                </div>

                                <div class="form-group">
                                    <label for="mailroom">Mailroom</label>
                                    <input type="number" name="mailroom" class="form-control"
                                        placeholder="Enter number of mailrooms">
                                </div>

                                <div class="form-group">
                                    <label for="mens_bathroom">Men's Bathroom</label>
                                    <input type="number" name="mens_bathroom" class="form-control"
                                        placeholder="Enter number of men's bathrooms">
                                </div>

                                <div class="form-group">
                                    <label for="mens_washroom">Men's Washroom</label>
                                    <input type="number" name="mens_washroom" class="form-control"
                                        placeholder="Enter number of men's washrooms">
                                </div>

                                <div class="form-group">
                                    <label for="shipping_receiving">Shipping & Receiving</label>
                                    <input type="number" name="shipping_receiving" class="form-control"
                                        placeholder="Enter number of shipping & receiving rooms">
                                </div>

                                <div class="form-group">
                                    <label for="storage_room">Storage Room</label>
                                    <input type="number" name="storage_room" class="form-control"
                                        placeholder="Enter number of storage rooms">
                                </div>

                                <div class="form-group">
                                    <label for="womens_bathroom">Women's Bathroom</label>
                                    <input type="number" name="womens_bathroom" class="form-control"
                                        placeholder="Enter number of women's bathrooms">
                                </div>

                                <div class="form-group">
                                    <label for="womens_washroom">Women's Washroom</label>
                                    <input type="number" name="womens_washroom" class="form-control"
                                        placeholder="Enter number of women's washrooms">
                                </div>

                                <div class="form-group">
                                    <label for="workshop">Workshop</label>
                                    <input type="number" name="workshop" class="form-control"
                                        placeholder="Enter number of workshops">
                                </div>

                                <!-- Extra room fields -->
                                <button type="button" class="btn btn-primary" id="add-room-field"
                                    style="margin-bottom: 20px;">Add Extra Room</button>
                                <div id="dynamic-room-fields"></div>

                                <button type="submit" class="btn waves-effect waves-light greenbtn"
                                    style="background-color: rgb(100, 197, 177); border-color: rgb(100, 197, 177); color: white;">Submit</button>
                            </form>
                        @else
                            <p>This page is only applicable for Service Units.</p>
                        @endif
                    </div>
                </div>
            </div>

            <script>
                let index = 0;

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
