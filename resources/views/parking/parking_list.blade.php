@extends('master')

@section('content')
    @push('title')
        <title>Parkiing List</title>
    @endpush

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Stalls</h4>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Stalls list</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <h4 class="header-title">List of Stalls</h4>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="text-right m-b-20">
                                    <button type="button" class="btn waves-effect waves-light greenbtn"
                                        onclick="window.location.href='{{ route('stall_locker.create') }}'">
                                        <i class="mdi mdi-plus m-r-5"></i> Add Stall
                                    </button>
                                </div>
                            </div>
                        </div>

                        <table class="table table-hover m-0 tickets-list table-actions-bar dt-responsive nowrap"
                            cellspacing="0" width="100%" id="datatable">
                            <thead>
                                <tr>
                                    <th>Stall No</th>
                                    <th>Type</th>
                                    <th>Capacity</th>
                                    <th>Available Spaces</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($stalls as $stall)
                                    <tr>
                                        <td>Stall-{{ $stall->stall_locker_no }}</td>
                                        <td>{{ $stall->type }}</td>
                                        <td>{{ $stall->capacity }}</td>
                                        <td>{{ $stall->capacity - $stall->vehicles->count() }}</td>
                                        <!-- Calculating available spaces -->
                                        <td>
                                            <div class="btn-group dropdown">
                                                <a href="javascript: void(0);" class="table-action-btn dropdown-toggle"
                                                    data-toggle="dropdown" aria-expanded="false"><i
                                                        class="mdi mdi-dots-horizontal"></i></a>
                                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                    <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal"
                                                        data-target="#infoModal-{{ $stall->id }}">
                                                        <i
                                                            class="mdi mdi-eye m-r-10 text-muted font-18 vertical-middle"></i>View
                                                        Full Info
                                                    </a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('parking.create', $stall->id) }}">
                                                        <i
                                                            class="mdi mdi-clipboard-check m-r-10 text-muted font-18 vertical-middle"></i>Assign
                                                        Vehicle / Parker
                                                    </a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('stall_locker.edit', $stall->id) }}">
                                                        <i
                                                            class="mdi mdi-pencil m-r-10 text-muted font-18 vertical-middle"></i>Edit
                                                        Stall Info
                                                    </a>

                                                    <a class="dropdown-item" href="#"
                                                        onclick="confirmDelete('{{ route('stall_locker.delete', ['id' => $stall->id]) }}')"><i
                                                            class="mdi mdi-delete m-r-10 text-muted font-18 vertical-middle"></i>
                                                        Delete Stall
                                                    </a>
                                                    <!-- Hidden form for deletion -->
                                                    <form id="delete-form"
                                                        action="{{ route('stall_locker.delete', ['id' => $stall->id]) }}"
                                                        method="GET" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Modal for showing full info -->
                                    <div class="modal fade" id="infoModal-{{ $stall->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="infoModalLabel-{{ $stall->id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="infoModalLabel-{{ $stall->id }}">Stall
                                                        Details</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p><strong>Stall No:</strong> Stall-{{ $stall->stall_locker_no }}</p>
                                                    <p><strong>Type:</strong> {{ $stall->type }}</p>
                                                    <p><strong>Capacity:</strong> {{ $stall->capacity }}</p>
                                                    <p><strong>Vehicles:</strong>
                                                        @if ($stall->vehicles->isNotEmpty())
                                                            <ul>
                                                                @foreach ($stall->vehicles as $vehicle)
                                                                    <li>{{ $vehicle->vehicle_no }}
                                                                        ({{ $vehicle->vehicle_name }})</li>
                                                                @endforeach
                                                            </ul>
                                                        @else
                                                            No vehicles assigned
                                                        @endif
                                                    </p>
                                                    <p><strong>Parkers:</strong>
                                                        @if ($stall->parkers->isNotEmpty())
                                                            <ul>
                                                                @foreach ($stall->parkers as $parker)
                                                                    <li>{{ $parker->parker_no }}
                                                                        ({{ $parker->parker_name }})</li>
                                                                @endforeach
                                                            </ul>
                                                        @else
                                                            No parkers assigned
                                                        @endif
                                                    </p>
                                                    <p><strong>Floor No:</strong>
                                                        {{ $stall->floor->type ?? 'N/A' }}-{{ $stall->floor->floor_no ?? 'N/A' }}
                                                    </p>
                                                    <p><strong>Block ID:</strong>
                                                        {{ $stall->floor->block->block_id ?? 'N/A' }}</p>
                                                    <p><strong>Block Name:</strong>
                                                        {{ $stall->floor->block->name ?? 'N/A' }}</p>
                                                    <p><strong>Building Name:</strong>
                                                        {{ $stall->floor->block->building->name ?? 'N/A' }}</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
