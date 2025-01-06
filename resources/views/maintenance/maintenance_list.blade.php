@extends('master')

@push('title')
    <title>Maintenance List</title>
@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Maintenance List</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Maintenance List</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <h4 class="header-title m-b-15 m-t-0">Maintenance List</h4>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="text-right m-b-20">
                                    {{-- @can('maintenance-create')
                                                    <button type="button" class="btn waves-effect waves-light greenbtn"
                                                        onclick="window.location.href='{{ route('maintenance.create') }}'">
                                                        <i class="mdi mdi-plus m-r-5"></i> Create Maintenance Request
                                                    </button>
                                                @endcan --}}
                                </div>
                            </div>
                        </div>

                        <table class="table table-hover m-0 tickets-list table-actions-bar dt-responsive nowrap"
                            cellspacing="0" width="100%" id="datatable">
                            <thead>
                                <tr>
                                    <th>Tenant</th>
                                    <th>Landlord</th>
                                    <th>Building</th>
                                    <th>Floor</th>
                                    <th>Unit</th>
                                    <th>Issue</th>
                                    <th>Issue Date</th>
                                    <th>Status</th>
                                    <th>Update Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($maintenances as $maintenance)
                                    <tr>
                                        <td>{{ $maintenance->tenant->name }}</td>
                                        <td>{{ $maintenance->landlord->name }}</td>
                                        <td>{{ $maintenance->building->name }}</td>
                                        <td>
                                            @php
                                                $floorNo = $maintenance->floor->floor_no;
                                                if ($floorNo == 1) {
                                                    $suffix = 'st';
                                                } elseif ($floorNo == 2) {
                                                    $suffix = 'nd';
                                                } elseif ($floorNo == 3) {
                                                    $suffix = 'rd';
                                                } else {
                                                    $suffix = 'th';
                                                }
                                            @endphp
                                            {{ $maintenance->floor->floor_no }}{{ $suffix }}
                                            ({{ $maintenance->floor->type }})
                                        </td>
                                        <td>Unit-{{ $maintenance->unit->unit_no }}</td>
                                        <td>{{ $maintenance->issue }}</td>
                                        <td>{{ $maintenance->created_at }}</td>
                                        <td>
                                            @if ($maintenance->status == 0)
                                                <span class="badge badge-warning">Pending</span>
                                            @elseif ($maintenance->status == 1)
                                                <span class="badge badge-info">In Progress</span>
                                            @elseif ($maintenance->status == 2)
                                                <span class="badge badge-success">Completed</span>
                                            @else
                                                <span class="badge badge-danger">Unknown</span>
                                            @endif
                                        </td>
                                        <td>
                                            @can('maintenance-edit')
                                            <a class="dropdown-item"
                                                href="{{ route('maintenance.edit', $maintenance->id) }}"
                                                type="submit"><i
                                                    class="mdi mdi-pencil m-r-10 text-muted font-18 vertical-middle"></i>Change</a>
                                            @endcan
                                        </td>

                                        {{-- <td class="text">
                                            <div class="btn-group dropdown">
                                                <a href="javascript: void(0);" class="table-action-btn dropdown-toggle"
                                                    data-toggle="dropdown" aria-expanded="false"><i
                                                        class="mdi mdi-dots-horizontal"></i></a>
                                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                    @can('maintenance-edit')
                                                        <a class="dropdown-item"
                                                            href="{{ route('maintenance.edit', $maintenance->id) }}"
                                                            type="submit"><i
                                                                class="mdi mdi-pencil m-r-10 text-muted font-18 vertical-middle"></i>Edit
                                                            landlord</a>
                                                    @endcan
                                                    @can('maintenance-delete')
                                                        <a class="dropdown-item" href="#"
                                                            onclick="confirmDelete('{{ route('maintenance.delete', $maintenance->id) }}')"><i
                                                                class="mdi mdi-delete m-r-10 text-muted font-18 vertical-middle"></i>
                                                            Delete
                                                        </a>
                                                        <!-- Hidden form for deletion -->
                                                        <form id="delete-form"
                                                            action="{{ route('maintenance.delete', $maintenance->id) }}"
                                                            method="GET" style="display: none;">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    @endcan

                                                </div>
                                            </div>

                                        </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div><!-- end col -->
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    </div>
    <!-- end row -->

    </div> <!-- container -->

    </div> <!-- content -->
@endsection
