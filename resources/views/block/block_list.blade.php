@extends('master')

@push('title')
    <title>Blocks List</title>
@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Blocks List</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Admin</a></li>
                            <li class="breadcrumb-item active">Blocks List</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <h4 class="header-title m-b-15 m-t-0">Blocks List</h4>
                        <div class="row">
                            @can('block-create')
                            <div class="col-sm-12">
                                <div class="text-right m-b-20">
                                    <button type="button" class="btn waves-effect waves-light greenbtn"
                                        onclick="window.location.href='{{ route('block.create') }}'">
                                        <i class="mdi mdi-plus m-r-5"></i> Add Block
                                    </button>
                                </div>
                            </div>
                            @endcan

                            <!-- Building Selection -->
                            <div class="form-group col-md-12">
                                <label for="building_id" class="col-form-label">Select Building</label>
                                <select id="building-select" name="building_id" class="form-control">
                                <option value="">Select a Building</option>
                                @foreach ($buildings as $building)
                                    <option value="{{ $building->id }}">{{ $building->name }} ( {{ $building->building_no }})</option>
                                @endforeach
                                </select>
                            </div>
                            
                        </div>
                        <table class="table table-hover m-0 table-actions-bar dt-responsive nowrap" cellspacing="0"
                            width="100%" id="datatable">
                            <thead>
                                <tr>
                                    <th>Block No</th>
                                    <th>Block Name</th>
                                    <th>Total Upper Floors</th>
                                    <th>Total Underground Floors</th>
                                    <th class="hidden-sm">Action</th>
                                </tr>
                            </thead>
                            <tbody id="blocks-table-body">
                                <!-- Rows will be added dynamically here -->
                            </tbody>
                        </table>
                    </div>
                </div><!-- end col -->
            </div>
            <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->

<script>
    document.getElementById('building-select').addEventListener('change', function () {
    const buildingId = this.value;
    const tableBody = document.getElementById('blocks-table-body');

    // Clear existing rows
    tableBody.innerHTML = '';

    if (buildingId) {
        // Fetch blocks for the selected building
        fetch(`/blocks/${buildingId}`)
            .then(response => response.json())
            .then(blocks => {
                if (blocks.length > 0) {
                    blocks.forEach(block => {
                        // Dynamically create a table row for each block
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${block.block_no}</td>
                            <td>${block.name}</td>
                            <td>${block.total_upper_floors}</td>
                            <td>${block.total_underground_floors}</td>
                            <td>
                                <div class="btn-group dropdown">
                                    <a href="javascript: void(0);" class="table-action-btn dropdown-toggle"
                                        data-toggle="dropdown" aria-expanded="false"><i
                                            class="mdi mdi-dots-horizontal"></i></a>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                        @can('block-list')
                                            <a class="dropdown-item"
                                            href="show/${block.id}"><i
                                                class="mdi mdi-eye m-r-10 font-18 text-muted vertical-middle"></i>View Details</a>
                                        @endcan
                                        @can('block-edit')
                                            <a class="dropdown-item"
                                            href="edit/${block.id}"><i
                                                class="mdi mdi-pencil m-r-10 text-muted font-18 vertical-middle"></i>Edit Block</a>
                                        @endcan
                                        @can('block-delete')
                                           <a class="dropdown-item"
                                            href="#"
                                            onclick="confirmDelete('delete/${block.id}')"><i
                                                class="mdi mdi-delete m-r-10 text-muted font-18 vertical-middle"></i>
                                            Delete
                                        </a>
                                        <form id="delete-form" action="delete/${block.id}" method="GET" style="display: none;">
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
                    // Add a message if no blocks are found
                    const row = document.createElement('tr');
                    row.innerHTML = `<td colspan="6" class="text-center">No blocks found for the selected building.</td>`;
                    tableBody.appendChild(row);
                }
            })
            .catch(error => console.error('Error fetching blocks:', error));
    }
    });

</script>
@endsection
