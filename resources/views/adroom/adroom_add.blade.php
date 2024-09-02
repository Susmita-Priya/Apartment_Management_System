@extends('master')

@section('content')
@push('title')
    <title>Add Administrative Room</title>
@endpush

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title float-left">Add Administrative Room</h4>

                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('building') }}">Buildings</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('block.show', $block->id) }}">Block</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('floor.show', $floor->id) }}">Floor</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('unit.show', $unit->id) }}">Unit</a></li>
                        <li class="breadcrumb-item active">Add Administrative Room</li>
                    </ol>

                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

        {{-- <!-- Display error messages if any -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}

        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    @if($unit->type == 'Supporting and Servicing Unit')
                        <form action="{{ route('adroom.store') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <input type="hidden" name="unit_id" value="{{ $unit->id }}">
                            
                            <!-- Administrative room fields -->
                            <div class="form-group">
                                <label for="accounting">Accounting</label>
                                <input type="number" name="accounting" class="form-control" placeholder="Enter number of accounting offices">
                            </div>

                            <div class="form-group">
                                <label for="board_room">Board Room</label>
                                <input type="number" name="board_room" class="form-control" placeholder="Enter number of board rooms">
                            </div>

                            <div class="form-group">
                                <label for="building_manager_office">Building Manager Office</label>
                                <input type="number" name="building_manager_office" class="form-control" placeholder="Enter number of building manager offices">
                            </div>

                            <div class="form-group">
                                <label for="business_center_room">Business Center Room</label>
                                <input type="number" name="business_center_room" class="form-control" placeholder="Enter number of business center rooms">
                            </div>

                            <div class="form-group">
                                <label for="computer_it">Computer & IT</label>
                                <input type="number" name="computer_it" class="form-control" placeholder="Enter number of computer & IT rooms">
                            </div>

                            <div class="form-group">
                                <label for="conference_room">Conference Room</label>
                                <input type="number" name="conference_room" class="form-control" placeholder="Enter number of conference rooms">
                            </div>

                            <div class="form-group">
                                <label for="first_aid_room">First Aid Room</label>
                                <input type="number" name="first_aid_room" class="form-control" placeholder="Enter number of first aid rooms">
                            </div>

                            <div class="form-group">
                                <label for="human_resource">Human Resource</label>
                                <input type="number" name="human_resource" class="form-control" placeholder="Enter number of human resource offices">
                            </div>

                            <div class="form-group">
                                <label for="meeting_room">Meeting Room</label>
                                <input type="number" name="meeting_room" class="form-control" placeholder="Enter number of meeting rooms">
                            </div>

                            <div class="form-group">
                                <label for="property_manager_office">Property Manager Office</label>
                                <input type="number" name="property_manager_office" class="form-control" placeholder="Enter number of property manager offices">
                            </div>

                            <div class="form-group">
                                <label for="registration_office">Registration Office</label>
                                <input type="number" name="registration_office" class="form-control" placeholder="Enter number of registration offices">
                            </div>

                            <div class="form-group">
                                <label for="sales_marketing">Sales & Marketing</label>
                                <input type="number" name="sales_marketing" class="form-control" placeholder="Enter number of sales & marketing offices">
                            </div>

                            <div class="form-group">
                                <label for="security_concierge">Security & Concierge</label>
                                <input type="number" name="security_concierge" class="form-control" placeholder="Enter number of security & concierge offices">
                            </div>

                            <div class="form-group">
                                <label for="shipping_receiving">Shipping & Receiving</label>
                                <input type="number" name="shipping_receiving" class="form-control" placeholder="Enter number of shipping & receiving rooms">
                            </div>

                            <div class="form-group">
                                <label for="workshop_room">Workshop Room</label>
                                <input type="number" name="workshop_room" class="form-control" placeholder="Enter number of workshop rooms">
                            </div>

                            <!-- Extra room fields -->
                            <button type="button" class="btn btn-primary" id="add-room-field" style="margin-bottom: 20px;">Add Extra Room</button>
                            <div id="dynamic-room-fields"></div>

                            <button type="submit" class="btn waves-effect waves-light"
                            style="background-color: rgb(100, 197, 177); border-color: rgb(100, 197, 177); color: white;">Submit</button>
                        </form>
                    @else
                        <p>This page is only applicable for Administrative Units.</p>
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
