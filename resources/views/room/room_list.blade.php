@extends('master')

@push('title')
    <title>Rooms List</title>
@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Rooms</h4>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Rooms list</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <h4 class="header-title m-b-15 m-t-0">Rooms List</h4>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="text-right m-b-20">
                                    <button type="button" class="btn waves-effect waves-light greenbtn"
                                        onclick="window.location.href='{{ route('room.create') }}'">
                                        <i class="mdi mdi-plus m-r-5"></i> Add Room
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Building Selection -->
                        <div class="form-group col-md-12">
                            <label for="building-select" class="col-form-label">Select Building</label>
                            <select id="building-select" name="building_id" class="form-control">
                                <option value="">Select a Building</option>
                                @foreach ($buildings as $building)
                                    <option value="{{ $building->id }}">{{ $building->name }} ({{ $building->building_no }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Floor Selection -->
                        <div class="form-group col-md-12">
                            <label for="floor-select" class="col-form-label">Select Floor</label>
                            <select id="floor-select" name="floor_id" class="form-control">
                                <option value="">Select a Floor</option>
                            </select>
                        </div>

                        <!-- Unit Selection -->
                        <div class="form-group col-md-12">
                            <label for="unit-select" class="col-form-label">Select Unit</label>
                            <select id="unit-select" name="unit_id" class="form-control">
                                <option value="">Select a Unit</option>
                            </select>
                        </div>

                        {{-- room-table --}}
                        <table class="table table-hover m-0 tickets-list table-actions-bar dt-responsive nowrap"
                            cellspacing="0" width="100%" id="datatable">
                            <thead>
                                <tr>
                                    <th>Serial</th>
                                    <th>Room No</th>
                                    <th>Unit Type</th>
                                    <th>Status</th>
                                    <th class="hidden-sm">Action</th>
                                </tr>
                            </thead>
                            <tbody id="rooms-table-body"></tbody>
                        </table>
                    </div>
                </div><!-- end col -->
            </div>
        </div> <!-- container -->
    </div> <!-- content -->

    <script>
        // document.getElementById('building-select').addEventListener('change', function() {
        //     const buildingId = this.value;
        //     const blockSelect = document.getElementById('block-select');
        //     const floorSelect = document.getElementById('floor-select');
        //     const unitSelect = document.getElementById('unit-select');
        //     const tableBody = document.getElementById('rooms-table-body');

        //     blockSelect.innerHTML = '<option value="">Select a Block</option>';
        //     floorSelect.innerHTML = '<option value="">Select a Floor</option>';
        //     unitSelect.innerHTML = '<option value="">Select a Unit</option>';
        //     tableBody.innerHTML = '';

        //     if (buildingId) {
        //         fetch(`/blocks/${buildingId}`)
        //             .then(response => response.json())
        //             .then(blocks => {
        //                 if (blocks.length > 0) {
        //                     blocks.forEach(block => {
        //                         const option = document.createElement('option');
        //                         option.value = block.id;
        //                         option.textContent = `${block.name} (${block.block_no})`;
        //                         blockSelect.appendChild(option);
        //                     });
        //                 } else {
        //                     swal("Sorry !!", "No blocks found for the selected building.", 'error', {
        //                         button: "OK",
        //                     });
        //                 }
        //             })
        //             .catch(error => console.error('Error fetching blocks:', error));
        //     }
        // });

        // document.getElementById('block-select').addEventListener('change', function() {
        //     const blockId = this.value;
        //     const floorSelect = document.getElementById('floor-select');
        //     const unitSelect = document.getElementById('unit-select');
        //     const tableBody = document.getElementById('rooms-table-body');

        //     floorSelect.innerHTML = '<option value="">Select a Floor</option>';
        //     unitSelect.innerHTML = '<option value="">Select a Unit</option>';
        //     tableBody.innerHTML = '';

        //     if (blockId) {
        //         fetch(`/blocks/${blockId}/floors`)
        //             .then(response => response.json())
        //             .then(data => {
        //                 const floors = data.floors;
        //                 const block = data.block;

        //                 if (floors.length > 0) {
        //                     floors.forEach(floor => {

        //                         let suffix =
        //                             floor.floor_no == 1 ? 'st' :
        //                             (floor.floor_no == 2 ? 'nd' :
        //                                 (floor.floor_no == 3 ? 'rd' : 'th'));

        //                         const option = document.createElement('option');
        //                         option.value = floor.id;
        //                         option.textContent = `${floor.floor_no}${suffix} (${floor.type} floor)`;
        //                         floorSelect.appendChild(option);
        //                     });
        //                 } else {
        //                     swal("Sorry !!", "No floors found for the selected block.", 'error', {
        //                         button: "OK"
        //                     });

        //                 }
        //             })
        //             .catch(error => console.error('Error fetching floors:', error));
        //     }
        // });

        document.getElementById('building-select').addEventListener('change', function() {
            const buildingId = this.value;
            const floorSelect = document.getElementById('floor-select');
            const unitSelect = document.getElementById('unit-select');
            const tableBody = document.getElementById('rooms-table-body');

            floorSelect.innerHTML = '<option value="">Select a Floor</option>';
            unitSelect.innerHTML = '<option value="">Select a Unit</option>';
            tableBody.innerHTML = '';

            if (buildingId) {
                fetch(`/buildings/${buildingId}/floorsUpper`)
                    .then(response => response.json())
                    .then(data => {
                        const floors = data.floors;
                        const building = data.building;

                        console.log(building);
                        if (floors.length > 0) {
                            floors.forEach(floor => {

                                let suffix =
                                    floor.floor_no == 1 ? 'st' :
                                    (floor.floor_no == 2 ? 'nd' :
                                        (floor.floor_no == 3 ? 'rd' : 'th'));

                                const option = document.createElement('option');
                                option.value = floor.id;
                                option.textContent = `${floor.floor_no}${suffix} (${floor.type} floor)`;
                                floorSelect.appendChild(option);
                            });
                        } else {
                            swal("Sorry !!", "No floors found for the selected block.", 'error', {
                                button: "OK"
                            });
                        }
                    })
                    .catch(error => console.error('Error fetching floors:', error));
            }
        });

        document.getElementById('floor-select').addEventListener('change', function() {
            const floorId = this.value;
            const unitSelect = document.getElementById('unit-select');
            const tableBody = document.getElementById('rooms-table-body');

            unitSelect.innerHTML = '<option value="">Select a Unit</option>';
            tableBody.innerHTML = '';


            if (floorId) {
                fetch(`/floors/${floorId}/units`)
                    .then(response => response.json())
                    .then(data => {
                        const units = data.units;
                        const floor = data.floor;

                        if (units.length > 0) {
                            units.forEach(unit => {
                                const option = document.createElement('option');
                                option.value = unit.id;
                                option.textContent = `Unit - ${unit.unit_no}`;
                                unitSelect.appendChild(option);
                            });
                        } else {
                            swal("Sorry !!", "No units found for the selected floor.", 'error', {
                                button: "OK"
                            });
                        }
                    })
                    .catch(error => console.error('Error fetching units:', error));
            }
        });


        document.getElementById('unit-select').addEventListener('change', function() {
            const unitId = this.value;
            const tableBody = document.getElementById('rooms-table-body');

            tableBody.innerHTML = '';

            if (unitId) {
                fetch(`/units/${unitId}/rooms`)
                    .then(response => response.json())
                    .then(data => {
                        const rooms = data.rooms;
                        const unit = data.unit;
                        const roomTypes = data.roomTypes;

                        if(rooms.length > 0) {
                            rooms.forEach((room, index) => {
                                roomTypes.forEach(roomType => {
                                    if (roomType.id == room.room_type_id) {
                                         roomTypeName = roomType.name;
                                    }
                                });
                                const row = document.createElement('tr');
                                row.innerHTML = `
                                    <td>${index + 1}</td>
                                    <td>${roomTypeName} ${room.room_no}</td>
                                    <td>${unit.type.charAt(0).toUpperCase() + unit.type.slice(1)} Unit</td>
                                    <td>
                                        <span class="badge bg-${room.status == 0 ? 'danger' : 'success'}">
                                            ${room.status == 0 ? 'Inactive' : 'Active'}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group dropdown">
                                            <a href="javascript:void(0);" class="table-action-btn dropdown-toggle"
                                                data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                @can('room-view')
                                                    <a class="dropdown-item" href="show/${room.id}">
                                                        <i class="mdi mdi-eye m-r-10 font-18 text-muted vertical-middle"></i> View Details
                                                    </a>
                                                @endcan
                                                @can('room-edit')
                                                    <a class="dropdown-item" href="edit/${room.id}">
                                                        <i class="mdi mdi-pencil m-r-10 text-muted font-18 vertical-middle"></i> Edit Unit
                                                    </a>
                                                @endcan
                                                @can('room-delete')
                                                    <a class="dropdown-item" href="#" onclick="confirmDelete('delete/${room.id}')">
                                                        <i class="mdi mdi-delete m-r-10 text-muted font-18 vertical-middle"></i>Delete
                                                    </a>
                                                    <form id="delete-form" action="delete/${room.id}" method="GET" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                @endcan
                                            </div>
                                        </div>
                                    </td>
                                `;
                                tableBody.appendChild(row);
                            });
                        } else {
                            swal("Sorry !!", "No rooms found for the selected unit.", 'error', {
                                button: "OK"
                            });
                        }
                        
                    })
                    .catch(error => console.error('Error fetching rooms:', error));
            }
        });
    </script>
@endsection
