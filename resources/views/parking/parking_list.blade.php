@extends('master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Stalls</h4>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <h4 class="header-title">List of Stalls/Lockers</h4>

                        <table class="table table-hover m-0 tickets-list table-actions-bar dt-responsive nowrap"
                            cellspacing="0" width="100%" id="datatable">
                            <thead>
                                <tr>
                                    <th>Stall No</th>
                                    <th>Type</th>
                                    <th>Capacity</th>
                                    <th>Vehicles</th>
                                    <th>Parkers</th>
                                    <th>Floor No</th>
                                    <th>Block ID</th>
                                    <th>Block Name</th>
                                    <th>Building Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($stalls as $stall)
                                    <tr>
                                        <td>Stall-{{ $stall->stall_locker_no }}</td>
                                        <td>{{ $stall->type }}</td>
                                        <td>{{ $stall->capacity }}</td>
                                        <td>
                                            @if ($stall->vehicles->isNotEmpty())
                                                <ul>
                                                    @foreach ($stall->vehicles as $vehicle)
                                                        <li>{{ $vehicle->vehicle_no }} ({{ $vehicle->vehicle_name }})</li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                <span>No vehicles assigned</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($stall->parkers->isNotEmpty())
                                                <ul>
                                                    @foreach ($stall->parkers as $parker)
                                                        <li>{{ $parker->parker_name }}</li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                <span>No parkers assigned</span>
                                            @endif
                                        </td>
                                        </td>
                                        <td>{{ $stall->floor->type ?? 'N/A' }}-{{ $stall->floor->floor_no ?? 'N/A' }}</td>
                                        <!-- Accessing floor_no -->
                                        <td>{{ $stall->floor->block->block_id ?? 'N/A' }}</td> <!-- Accessing block_id -->
                                        <td>{{ $stall->floor->block->name ?? 'N/A' }}</td> <!-- Accessing block_name -->
                                        <td>{{ $stall->floor->block->building->name ?? 'N/A' }}</td>
                                        <!-- Accessing building_name -->
                                        <td>
                                            <div class="btn-group dropdown">
                                                <a href="javascript: void(0);" class="table-action-btn dropdown-toggle"
                                                    data-toggle="dropdown" aria-expanded="false"><i
                                                        class="mdi mdi-dots-horizontal"></i></a>
                                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                    {{-- <a class="dropdown-item"
                                                        href="{{ route('parker.show', ['id' => $parker->id]) }}"><i
                                                            class="mdi mdi-eye m-r-10 font-18 text-muted vertical-middle"></i>View
                                                        Details</a> --}}
                                                        <a class="dropdown-item" href="{{ route('parking.create', $stall->id) }}"
                                                            class="btn btn-sm btn-primary">Assign Vehicle / Parker</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('parker.edit', ['id' => $parker->id]) }}"
                                                        type="submit"><i
                                                            class="mdi mdi-pencil m-r-10 text-muted font-18 vertical-middle"></i>Edit
                                                        parker</a>
                                                    <a class="dropdown-item"
                                                        onclick="confirmDelete('{{ route('parker.delete', ['id' => $parker->id]) }}')"><i
                                                            class="mdi mdi-delete m-r-10 text-muted font-18 vertical-middle"></i>
                                                        Delete
                                                    </a>
                                                    <!-- Hidden form for deletion -->
                                                    <form id="delete-form"
                                                        action="{{ route('parker.delete', ['id' => $parker->id]) }}"
                                                        method="GET" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </div>
                                            </div>
                                        </td>                                                                       
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
