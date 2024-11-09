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
                        </div>
                        <table class="table table-hover m-0 tickets-list table-actions-bar dt-responsive nowrap"
                            cellspacing="0" width="100%" id="datatable">
                            <thead>
                                <tr>
                                    <th>Floor No</th>
                                    {{-- <th>Floor Type</th> --}}
                                    <th>Floor Name</th>
                                    <th>Block ID</th>
                                    <th>Block Name</th>
                                    <th>Building ID</th>
                                    <th>Building Name</th>
                                    {{-- <th>Status</th> --}}
                                    <th class="hidden-sm">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($floors as $floor)
                                    <tr>
                                        {{-- <td>{{ $floor->floor_no }}</td> --}}
                                        <td>{{ ucfirst( $floor->type ) }}-{{ $floor->floor_no }}</td>
                                        <td>{{ $floor->name }}</td>
                                        <td>{{ $floor->block->block_id }}</td>
                                        <td>{{ $floor->block->name }}</td>
                                        <td>{{ $floor->block->building->building_id }}</td>
                                        <td>{{ $floor->block->building->name }}</td>
                                       {{--  <td>
                                            @if ($floor->residential_suite)
                                                Residential Suite
                                            @elseif ($floor->commercial_unit)
                                                Commercial Unit
                                            @elseif ($floor->supporting_service_room)
                                                Supporting Service Room
                                            @elseif ($floor->parking_lot)
                                                Parking Lot
                                            @elseif ($floor->bike_lot)
                                                Bike Lot
                                            @elseif ($floor->storage_lot)
                                                Storage Lot
                                            @else
                                                N/A
                                            @endif
                                        </td> --}}
                                        <td>
                                            <div class="btn-group dropdown">
                                                <a href="javascript: void(0);" class="table-action-btn dropdown-toggle"
                                                    data-toggle="dropdown" aria-expanded="false"><i
                                                        class="mdi mdi-dots-horizontal"></i></a>
                                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                    <a class="dropdown-item"
                                                        href="{{ route('floor.show', ['id' => $floor->id]) }}"><i
                                                            class="mdi mdi-eye m-r-10 font-18 text-muted vertical-middle"></i>View
                                                        Details</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('floor.edit', ['id' => $floor->id]) }}"><i
                                                            class="mdi mdi-pencil m-r-10 text-muted font-18 vertical-middle"></i>Edit</a>
                                                    <a class="dropdown-item" href="#"
                                                        onclick="confirmDelete('{{ route('floor.delete', ['id' => $floor->id]) }}')"><i
                                                            class="mdi mdi-delete m-r-10 text-muted font-18 vertical-middle"></i>
                                                        Delete
                                                    </a>
                                                    <!-- Hidden form for deletion -->
                                                    <form id="delete-form"
                                                        action="{{ route('floor.delete', ['id' => $floor->id]) }}"
                                                        method="GET" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>

                                                    {{-- <a class="dropdown-item"
                                                        href="{{ route('floor.delete', ['id' => $floor->id]) }}"
                                                        onclick="event.preventDefault(); document.getElementById('delete-form-{{ $floor->id }}').submit();"><i
                                                            class="mdi mdi-delete m-r-10 text-muted font-18 vertical-middle"></i>Delete</a>
                                                    <form id="delete-form-{{ $floor->id }}"
                                                        action="{{ route('floor.delete', ['id' => $floor->id]) }}"
                                                        method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form> --}}
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div><!-- end col -->
            </div>
            <!-- end row -->

        </div> <!-- container -->
    </div> <!-- content -->
@endsection
