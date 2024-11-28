@extends('master')

@push('title')
    <title>Floors</title>
@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Floors</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ url('/index') }}">Admin</a></li>
                            {{-- <li class="breadcrumb-item"><a href="#">Floors</a></li> --}}
                            <li class="breadcrumb-item active">Floors List</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <h4 class="header-title m-b-15 m-t-0">Floors List</h4>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="text-right m-b-20">
                                    <button type="button" class="btn waves-effect waves-light greenbtn"
                                        onclick="window.location.href='{{ route('floor.create') }}'">
                                        <i class="mdi mdi-plus m-r-5"></i> Add Floor
                                    </button>
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

                            <!-- Block Selection -->
                            <div class="form-group col-md-12">
                                <label for="block-select" class="col-form-label">Select Block</label>
                                <select id="block-select" name="block_id" class="form-control">
                                    <option value="">Select a Block</option>
                                </select>
                            </div>

                        </div>
                        <!-- Floors Table -->
                        <table class="table table-hover m-0 tickets-list table-actions-bar dt-responsive nowrap"
                            cellspacing="0" width="100%" id="datatable">
                            <thead>
                                <tr>
                                    <th>Floor No</th>
                                    <th>Floor Type</th>
                                    <th>Floor name</th>
                                    <th>Block</th>
                                    <th class="hidden-sm">Action</th>
                                </tr>
                            </thead>
                            <tbody id="floors-table-body">
                            </tbody>
                        </table>
                    </div>
                </div><!-- end col -->
            </div>
            <!-- end row -->
        </div> <!-- container -->
    </div> <!-- content -->


    <script>
        document.getElementById('building-select').addEventListener('change', function() {
            const buildingId = this.value;
            const blockSelect = document.getElementById('block-select');
            const tableBody = document.getElementById('floors-table-body');

            blockSelect.innerHTML = '<option value="">Select a Block</option>';
            tableBody.innerHTML = '';

            if (buildingId) {
                fetch(`/blocks/${buildingId}`)
                    .then(response => response.json())
                    .then(blocks => {
                        if (blocks.length > 0) {
                            blocks.forEach(block => {
                                const option = document.createElement('option');
                                option.value = block.id;
                                option.textContent = `${block.name} (${block.block_no})`;
                                blockSelect.appendChild(option);
                            });
                        } else {
                            swal("Oops...", "No blocks found for the selected building.", 'error', {
                                button: true,
                                button: "OK",
                            })

                            alert('No blocks found for the selected building.');
                        }
                    })
                    .catch(error => console.error('Error fetching blocks:', error));
            }
        });

        document.getElementById('block-select').addEventListener('change', function() {
            const blockId = this.value;
            const tableBody = document.getElementById('floors-table-body');

            tableBody.innerHTML = '';

            if (blockId) {
                fetch(`/blocks/${blockId}/floors`)
                    .then(response => response.json())
                    .then(data => {
                        const floors = data.floors;
                        const block = data.block;

                        if (floors.length > 0) {
                            floors.forEach(floor => {

                                let suffix =
                                    floor.floor_no == 1 ? 'st' :
                                    (floor.floor_no == 2 ? 'nd' :
                                        (floor.floor_no == 3 ? 'rd' : 'th'));

                                const row = document.createElement('tr');

                                row.innerHTML = `
                            <td>${floor.floor_no}<sup>${suffix}</sup> floor</td>
                            <td>${floor.type}</td>
                            <td>${floor.name}</td>
                            <td>${block.name} <br> ( ${block.block_no} )</td>
                            <td>
                                <div class="btn-group dropdown">
                                    <a href="javascript:void(0);" class="table-action-btn dropdown-toggle"
                                        data-toggle="dropdown" aria-expanded="false">
                                        <i class="mdi mdi-dots-horizontal"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                        <a class="dropdown-item" href="show/${floor.id}">
                                            <i class="mdi mdi-eye m-r-10 font-18 text-muted vertical-middle"></i>View Details
                                        </a>
                                        <a class="dropdown-item" href="edit/${floor.id}">
                                            <i class="mdi mdi-pencil m-r-10 text-muted font-18 vertical-middle"></i>Edit Floor
                                        </a>
                                        <a class="dropdown-item" href="#" onclick="confirmDelete('delete/${floor.id}')">
                                            <i class="mdi mdi-delete m-r-10 text-muted font-18 vertical-middle"></i>Delete
                                        </a>
                                        <form id="delete-form" action="delete/${floor.id}" method="GET" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </div>
                            </td>
                        `;
                                tableBody.appendChild(row);
                            });
                        } else {
                            tableBody.innerHTML =
                                '<tr><td colspan="5" class="text-center">No floors found for the selected block.</td></tr>';
                        }
                    })
                    .catch(error => console.error('Error fetching floors:', error));
            } else {
                tableBody.innerHTML =
                    '<tr><td colspan="5" class="text-center">Select a block to view floors.</td></tr>';
            }
        });
    </script>
@endsection
