@extends('master')

@push('title')
    <title>Vehicles List</title>
@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Vehicles</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Admin</a></li>
                            {{-- <li class="breadcrumb-item"><a href="#">Vehicles</a></li> --}}
                            <li class="breadcrumb-item active">Vehicles list</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <h4 class="header-title m-b-15 m-t-0">Vehicles List</h4>
                        <div class="row">
                            @can('vehicle-create')
                            <div class="col-sm-12">
                                <div class="text-right m-b-20">
                                    <button type="button" class="btn waves-effect waves-light greenbtn"
                                        onclick="window.location.href='{{ route('vehicle.create') }}'">
                                        <i class="mdi mdi-plus m-r-5"></i> Add Vehicle
                                    </button>
                                </div>
                            </div>
                                
                            @endcan

                        </div>

                        <table class="table table-hover m-0 tickets-list table-actions-bar dt-responsive nowrap"
                            cellspacing="0" width="100%" id="datatable">
                            <thead>
                                <tr>
                                    <th>Vehicle No</th>
                                    <th>Vehicle Type</th>
                                    <th>Model</th>
                                    <th>Registration No</th>
                                    <th>Vehicle Image</th>
                                    <th>Stall No</th>
                                    <th>Vehicle Owner</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($vehicles as $vehicle)
                                    <tr>
                                        
                                        <td>{{ $vehicle->vehicle_no }}</td>
                                        <td>{{ $vehicle->vehicleType->name }}</td>
                                        <td>{{ $vehicle->model }}</td>
                                        <td>{{ $vehicle->registration_no }}</td>
                                        <td>
                                            <img src="{{ asset($vehicle->vehicle_image) }}" alt="{{ $vehicle->vehicle_name }}" style="width: 80px; height: auto;">
                                        </td>
                                        <td>Stall - {{ $vehicle->stall->stall_no }}</td>
                                        <td>{{ $vehicle->vehicleOwner->name ?? 'N/A' }}</td>
                                        <td>
                                            @if ($vehicle->status === '1')
                                                <span class="badge badge-success">Stored</span>
                                            @else
                                                <span class="badge badge-danger">Not Stored</span>
                                            @endif                                      
                                        </td> <!-- Display status -->
                                        <td>
                                            <div class="btn-group dropdown">
                                                <a href="javascript: void(0);" class="table-action-btn dropdown-toggle"
                                                    data-toggle="dropdown" aria-expanded="false"><i
                                                        class="mdi mdi-dots-horizontal"></i></a>
                                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                    @can('stall-view')
                                                    @if($vehicle->stall_id)
                                                        <a class="dropdown-item"
                                                        href="{{ route('stall.show', ['id' => $vehicle->stall_id]) }}"><i
                                                            class="mdi mdi-eye m-r-10 font-18 text-muted vertical-middle"></i>View
                                                        Details</a>
                                                        @endif
                                                    @endcan
                                                    @can('vehicle-edit')
                                                         <a class="dropdown-item"
                                                        href="{{ route('vehicle.edit', ['id' => $vehicle->id]) }}"
                                                        type="submit"><i
                                                            class="mdi mdi-pencil m-r-10 text-muted font-18 vertical-middle"></i>Edit
                                                        vehicle</a>
                                                    @endcan
                                                   @can('vehicle-delete')
                                                    <a class="dropdown-item" href="#"
                                                        onclick="confirmDelete('{{ route('vehicle.delete', ['id' => $vehicle->id]) }}')"><i
                                                            class="mdi mdi-delete m-r-10 text-muted font-18 vertical-middle"></i>
                                                        Delete
                                                    </a>
                                                    <!-- Hidden form for deletion -->
                                                    <form id="delete-form"
                                                        action="{{ route('vehicle.delete', ['id' => $vehicle->id]) }}"
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
