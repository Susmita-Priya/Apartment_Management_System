@extends('master')

@push('title')
    <title>Vehicle Types List</title>
@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Vehicle Types</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Admin</a></li>
                            <li class="breadcrumb-item active">Vehicle Types list</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <h4 class="header-title m-b-15 m-t-0">Vehicle Types List</h4>
                        <div class="row">
                            @can('vehicle-type-create')
                            <div class="col-sm-12">
                                <div class="text-right m-b-20">
                                    <button type="button" class="btn waves-effect waves-light greenbtn"
                                        onclick="window.location.href='{{ route('vehicleType.create') }}'">
                                        <i class="mdi mdi-plus m-r-5"></i> Add Vehicle Type
                                    </button>
                                </div>
                            </div>
                            @endcan
                            
                        </div>

                        <table class="table table-hover m-0 tickets-list table-actions-bar dt-responsive nowrap"
                            cellspacing="0" width="100%" id="datatable">
                            <thead>
                                <tr>
                                    <th>Serial No</th>
                                    <th>Vehicle Type</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp

                                @foreach ($vehicleTypes as $vehicleType)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $vehicleType->name }}</td>
                                        <td>{{ $vehicleType->description ? $vehicleType->description : 'No Description' }}</td>

                                        <td>
                                            @if ($vehicleType->status == 1)
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-danger">Inactive</span>
                                            @endif                                      
                                        </td> <!-- Display status -->
                                        <td>
                                            <div class="btn-group dropdown">
                                                <a href="javascript: void(0);" class="table-action-btn dropdown-toggle"
                                                    data-toggle="dropdown" aria-expanded="false"><i
                                                        class="mdi mdi-dots-horizontal"></i></a>
                                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                    @can('vehicle-type-edit')
                                                        <a class="dropdown-item"
                                                        href="{{ route('vehicleType.edit', ['id' => $vehicleType->id]) }}"
                                                        type="submit"><i
                                                            class="mdi mdi-pencil m-r-10 text-muted font-18 vertical-middle"></i>Edit
                                                        Vehicle Type</a>
                                                    @endcan
                                                    @can('vehicle-type-delete')
                                                        <a class="dropdown-item" href="#"
                                                        onclick="confirmDelete('{{ route('vehicleType.delete', ['id' => $vehicleType->id]) }}')"><i
                                                            class="mdi mdi-delete m-r-10 text-muted font-18 vertical-middle"></i>
                                                        Delete Vehicle Type
                                                    </a>
                                                    <!-- Hidden form for deletion -->
                                                    <form id="delete-form"
                                                        action="{{ route('vehicleType.delete', ['id' => $vehicleType->id]) }}"
                                                        method="GET" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                    @endcan
                                                    
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
