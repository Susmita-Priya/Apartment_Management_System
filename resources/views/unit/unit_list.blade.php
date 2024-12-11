@extends('master')

@push('title')
    <title>Units List</title>
@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Units</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Units list</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <h4 class="header-title m-b-15 m-t-0">Units List</h4>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="text-right m-b-20">
                                    <button type="button" class="btn waves-effect waves-light greenbtn"
                                        onclick="window.location.href='{{ route('unit.create') }}'">
                                        <i class="mdi mdi-plus m-r-5"></i> Add Unit
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Building Selection -->
                        <div class="form-group col-md-12">
                            <label for="building_id" class="col-form-label">Select Building</label>
                            <select id="building-select" name="building_id" class="form-control">
                                <option value="">Select a Building</option>
                                @foreach ($buildings as $building)
                                    <option value="{{ $building->id }}">{{ $building->name }} (
                                        {{ $building->building_no }} )</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- floor-select --}}
                        <div class="form-group col-md-12">
                            <label for="floor-select" class="col-form-label">Select Floor</label>
                            <select id="floor-select" name="floor_id" class="form-control">
                                <option value="">Select a Floor</option>
                                {{-- @foreach ($floors as $floor)
                                    <option value="{{ $floor->id }}">{{ $floor->floor_no }}<sup>{{ $suffix }}</sup> ({{ $floor->type }} floor)</option>
                                @endforeach --}}
                            </select>
                        </div>


                        <table class="table table-hover m-0 tickets-list table-actions-bar dt-responsive nowrap"
                            cellspacing="0" width="100%" id="datatable">
                            <thead>
                                <tr>
                                    <th>Unit NO</th>
                                    <th>Type</th>
                                    <th>Rent</th>
                                    <th>Price</th>
                                    <th>Floor</th>
                                    <th>Status</th>
                                    <th class="hidden-sm">Action</th>
                                </tr>
                            </thead>
                            <tbody id="units-table-body">
                            </tbody>

                        </table>
                    </div>
                </div><!-- end col -->
            </div>
            <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->


    <script>
        // document.getElementById('building-select').addEventListener('change', function() {
        //     const buildingId = this.value;
        //     const floorSelect = document.getElementById('floor-select');
        //     const tableBody = document.getElementById('units-table-body');

        //     floorSelect.innerHTML = '<option value="">Select a Floor</option>';
        //     tableBody.innerHTML = '';

        //     if (buildingId) {
        //         fetch(`/buildings/${buildingId}`)
        //             .then(response => response.json())
        //             .then(buildings => {
        //                 if (buildings.length > 0) {
        //                     buildings.forEach(building => {
        //                         const option = document.createElement('option');
        //                         option.value = building.id;
        //                         option.textContent = `${building.name} (${building.block_no})`;
        //                         buildingSelect.appendChild(option);
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

        document.getElementById('building-select').addEventListener('change', function() {
            const buildingId = this.value;
            const floorSelect = document.getElementById('floor-select');
            const tableBody = document.getElementById('units-table-body');

            floorSelect.innerHTML = '<option value="">Select a Floor</option>';
            tableBody.innerHTML = '';

            if (buildingId) {
                fetch(`/buildings/${buildingId}/floors`)
                    .then(response => response.json())
                    .then(data => {
                        const floors = data.floors;
                        const building = data.building;

                        if (floors.length > 0) {
                            floors.forEach(floor => {

                                l et suffix =
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
            const tableBody = document.getElementById('units-table-body');

            tableBody.innerHTML = '';

            if (floorId) {
                fetch(`/floors/${floorId}/units`)
                    .then(response => response.json())
                    .then(data => {
                        const units = data.units;
                        const floor = data.floor;

                        if (units.length > 0) {
                            units.forEach(unit => {
                                console.log(unit.unit_no);

                                const row = document.createElement('tr');

                                row.innerHTML = `
                            <td>Unit - ${unit.unit_no}</td>
                            <td>${unit.type}</td>
                            <td>${unit.rent} TK</td>
                            <td>${unit.price} TK</td>
                            <td>${floor.name}</td>
                            <td>
                                  <span class="badge bg-${unit.status == 0 ? 'danger' : (unit.status == 1 ? 'primary' : 'success')}">
                                    ${unit.status == 0 ? 'Vacant' : (unit.status == 1 ? 'Pending' : 'Occupied')}
                              
                            </td>
                            <td>
                                <div class="btn-group dropdown">
                                    <a href="javascript: void(0);" class="table-action-btn dropdown-toggle"
                                        data-toggle="dropdown" aria-expanded="false"><i
                                            class="mdi mdi-dots-horizontal"></i></a>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                        @can('unit-view')
                                        <a class="dropdown-item"
                                            href="show/${unit.id}"><i
                                                class="mdi mdi-eye m-r-10 font-18 text-muted vertical-middle"></i>View
                                            Details</a>
                                        @endcan
                                        @can('unit-edit')
                                        <a class="dropdown-item"
                                            href="edit/${unit.id}"
                                            type="submit"><i
                                                class="mdi mdi-pencil m-r-10 text-muted font-18 vertical-middle"></i>
                                            Edit Unit</a>
                                        @endcan
                                        @can('unit-delete')
                                        <a class="dropdown-item" href="#"
                                            onclick="confirmDelete('delete/${unit.id}'))"><i
                                                class="mdi mdi-delete m-r-10 text-muted font-18 vertical-middle"></i>
                                            Delete
                                        </a>
                                        <!-- Hidden form for deletion -->
                                        <form id="delete-form"
                                            action="delete/${unit.id}"
                                            method="GET" style="display: none;">
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
                            swal("Sorry !!", "No units found for the selected floor.", 'error', {
                                button: "OK"
                            });

                        }
                    })
                    .catch(error => console.error('Error fetching units:', error));
            }
        });
    </script>
@endsection
