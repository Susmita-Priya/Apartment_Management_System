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
                            <li class="breadcrumb-item"><a href="{{ url('/index') }}">Admin</a></li>
                            <li class="breadcrumb-item"><a href="#">Units</a></li>
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

                        <table class="table table-hover m-0 tickets-list table-actions-bar dt-responsive nowrap"
                            cellspacing="0" width="100%" id="datatable">
                            <thead>
                                <tr>
                                    <th>Unit NO</th>
                                    <th>Type</th>
                                    <th>Floor NO</th>
                                    <th>Floor Name</th>
                                    <th>Block ID</th>
                                    <th>Block Name</th>
                                    <th>Building ID</th>
                                    <th>Building Name</th>
                                    <th>Status</th>
                                    <th class="hidden-sm">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($units as $unit)
                                    <tr>
                                        <td>Unit - {{ $unit->unit_no }}</td>
                                        <td>{{ $unit->type }}</td>
                                        <td>{{ $unit->floor->type }}-{{ $unit->floor->floor_no }}</td>
                                        <td>{{ $unit->floor->name }}</td>
                                        <td>{{ $unit->floor->block->block_id }}</td>
                                        <td>{{ $unit->floor->block->name }}</td>
                                        <td>{{ $unit->floor->block->building->building_id }}</td>
                                        <td>{{ $unit->floor->block->building->name }}</td>
                                        <td>
                                            <!-- Add status logic here -->
                                        </td>
                                        <td>
                                            <div class="btn-group dropdown">
                                                <a href="javascript: void(0);" class="table-action-btn dropdown-toggle"
                                                    data-toggle="dropdown" aria-expanded="false"><i
                                                        class="mdi mdi-dots-horizontal"></i></a>
                                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                    <a class="dropdown-item"
                                                        href="{{ route('unit.show', ['id' => $unit->id]) }}"><i
                                                            class="mdi mdi-eye m-r-10 font-18 text-muted vertical-middle"></i>View
                                                        Details</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('unit.edit', ['id' => $unit->id]) }}"
                                                        type="submit"><i
                                                            class="mdi mdi-pencil m-r-10 text-muted font-18 vertical-middle"></i>Edit
                                                        Unit</a>
                                                    <a class="dropdown-item"
                                                        onclick="confirmDelete('{{ route('unit.delete', ['id' => $unit->id]) }}')"><i
                                                            class="mdi mdi-delete m-r-10 text-muted font-18 vertical-middle"></i>
                                                        Delete
                                                    </a>
                                                    <!-- Hidden form for deletion -->
                                                    <form id="delete-form"
                                                        action="{{ route('unit.delete', ['id' => $unit->id]) }}"
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
                </div><!-- end col -->
            </div>
            <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->
@endsection
