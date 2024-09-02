@extends('master')

@section('content')
@push('title')
    <title>Add Commercial Room</title>
@endpush

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title float-left">Add Commercial Room</h4>

                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('building') }}">Buildings</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('block.show', $block->id) }}">Block</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('floor.show', $floor->id) }}">Floor</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('unit.show', $unit->id) }}">Unit</a></li>
                        <li class="breadcrumb-item active">Add Commercial Room</li>
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
                    @if($unit->type == 'Commercial Unit')
                        <form action="{{ route('comroom.store') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <input type="hidden" name="unit_id" value="{{ $unit->id }}">
                            
                            <!-- Common room fields -->
                            <div class="form-group">
                                <label for="bathroom">Bathroom</label>
                                <input type="number" name="bathroom" class="form-control" placeholder="Enter number of bathrooms">
                            </div>

                            <div class="form-group">
                                <label for="officeroom">Office Room</label>
                                <input type="number" name="officeroom" class="form-control" placeholder="Enter number of office rooms">
                            </div>

                            <div class="form-group">
                                <label for="conferenceroom">Conference Room</label>
                                <input type="number" name="conferenceroom" class="form-control" placeholder="Enter number of conference rooms">
                            </div>

                            <div class="form-group">
                                <label for="dining_room">Dining Room</label>
                                <input type="number" name="dining_room" class="form-control" placeholder="Enter number of dining rooms">
                            </div>

                            <div class="form-group">
                                <label for="kitchen">Kitchen</label>
                                <input type="number" name="kitchen" class="form-control" placeholder="Enter number of kitchens">
                            </div>

                            <div class="form-group">
                                <label for="laundry">Laundry</label>
                                <input type="number" name="laundry" class="form-control" placeholder="Enter number of laundries">
                            </div>

                            <div class="form-group">
                                <label for="solarium">Solarium</label>
                                <input type="number" name="solarium" class="form-control" placeholder="Enter number of solariums">
                            </div>

                            <div class="form-group">
                                <label for="storage">Storage</label>
                                <input type="number" name="storage" class="form-control" placeholder="Enter number of storages">
                            </div>

                            <div class="form-group">
                                <label for="washroom">Washroom</label>
                                <input type="number" name="washroom" class="form-control" placeholder="Enter number of washrooms">
                            </div>

                            <!-- Extra room fields -->
                            <button type="button" class="btn btn-primary" id="add-room-field" style="margin-bottom: 20px;">Add Extra Room</button>
                            <div id="dynamic-room-fields"></div>

                            <button type="submit" class="btn waves-effect waves-light"
                            style="background-color: rgb(100, 197, 177); border-color: rgb(100, 197, 177); color: white;">Submit</button>
                        </form>
                    @else
                        <p>This page is only applicable for Commercial Units.</p>
                    @endif
                </div>
            </div>
        </div>

        <script>
            let index = 0;

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
