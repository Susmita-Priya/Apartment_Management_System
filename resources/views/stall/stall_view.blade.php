@extends('master')

@section('content')
    @push('title')
        <title>Stall Details</title>
    @endpush

    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">

            <!-- Breadcrumb and Header -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Stall-{{ $stall->stall_no }}</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('building') }}">Buildings</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('building.show', $floor->building_id) }}">Building</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('floor.show', $stall->floor_id) }}">Floor</a></li>
                            <li class="breadcrumb-item active">Stall Details</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-sm-12">
                    <div class="profile-bg-picture" style="background-image:url('{{ asset('image/parkStall.jpg') }}')">
                        <span class="picture-bg-overlay"></span><!-- overlay -->
                    </div>
                    <!-- meta -->
                    <div class="profile-user-box">
                        <div class="row">
                            <div class="col-sm-6">
                                <span class="pull-left m-r-15"><img src="{{ asset($building->image) }}" alt=""
                                        class="thumb-lg rounded-circle"></span>
                                <div class="media-body">
                                    <h4 class="m-t-7 font-18">Stall-{{ $stall->stall_no }}</h4>
                                    <p class="text-muted font-15">{{ $building->name }} Building</p>
                                </div>
                            </div>
                            @can('stall-edit')
                                <div class="col-sm-6">
                                    <div class="text-right">
                                        <button type="button" class="btn waves-effect waves-light greenbtn"
                                            style=" position: absolute; "
                                            onclick="window.location.href='{{ route('stall.edit', $stall->id) }}'">
                                            <i class="mdi mdi-pencil m-r-5"></i> Edit Stall
                                        </button>
                                    </div>
                                </div>
                            @endcan
                        </div>
                    </div>
                    <!--/ meta -->
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-md-4">
                    <!-- Block-Information -->
                    <div class="card-box">
                        <h4 class="header-title mt-0 m-b-20">Stall Information</h4>
                        <div class="panel-body">

                            <p class="text-muted font-15"><strong>
                                    Stall:
                                </strong> <span class="m-l-15">Stall-{{ $stall->stall_no }} </span></p>
                            <p class="text-muted font-15"><strong>
                                    Stall Type:
                                </strong> <span class="m-l-15"> {{ ucfirst($stall->type) }}</span></p>
                            <p class="text-muted font-15"><strong>
                                    Capacity:
                                </strong> <span class="m-l-15">{{ $stall->capacity }}</span></p>
                            <p class="text-muted font-15"><strong>Date Added:</strong> <span
                                    class="m-l-15">{{ $stall->created_at->format('d M, Y') }}</span></p>

                            <p class="text-muted font-15"><strong>Stall Status:</strong> <span class="m-l-15"><span
                                        class="badge bg-{{ $stall->status == 0 ? 'danger' : 'primary' }}">
                                        {{ $stall->status == 0 ? 'Inactive' : 'Active' }}</span></p>
                            <hr>

                            @php
                                $suffix =
                                    $floor->floor_no == 1
                                        ? 'st'
                                        : ($floor->floor_no == 2
                                            ? 'nd'
                                            : ($floor->floor_no == 3
                                                ? 'rd'
                                                : 'th'));
                            @endphp

                            <p class="text-muted font-15"><strong>Floor No:</strong> <span class="m-l-15">Underground -
                                    {{ $floor->floor_no }}<sup>{{ $suffix }}</sup> floor</span></p>
                            <p class="text-muted font-15"><strong>Floor Name:</strong> <span
                                    class="m-l-15">{{ $floor->name }}</span></p>

                            <hr>

                            @php
                                $typeFullForm = [
                                    'RESB' => 'Residential',
                                    'COMB' => 'Commercial',
                                    'RECB' => 'Residential-Commercial',
                                ];
                            @endphp

                            <p class="text-muted font-15"><strong>Building:</strong> <span
                                    class="m-l-15">{{ $building->name }}</span></p>
                            <p class="text-muted font-15"><strong>Building No:</strong> <span
                                    class="m-l-15">{{ $building->building_no }}</span></p>
                            <p class="text-muted font-15"><strong>Building Type:</strong> <span
                                    class="m-l-15">{{ $typeFullForm[$building->type] ?? 'Other' }}</span>
                            </p>

                        </div>
                        <hr>
                        <h4 class="header-title mt-0 m-b-20">Parkers Information</h4>
                        <div class="panel-body">

                            @if ($parkers->isEmpty())
                                <p class="text-muted font-15"><strong>No Parker Assigned</strong></p>

                            @else
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($parkers as $parker)
                                    <hr>
                                    <h5 class="header-title mt-0 m-b-20 ">Parker {{ $i++ }} </h5>

                                    <p class="text-muted font-15"><strong>Parker No:</strong> <span
                                        class="m-l-15">{{ $parker->parker_no }}</span></p>
                                    <p class="text-muted font-15"><strong>Name:</strong> <span
                                            class="m-l-15">{{ $parker->full_name }}</span></p>
                                    <p class="text-muted font-15"><strong>Phone:</strong> <span
                                            class="m-l-15">{{ $parker->phone }}</span></p>
                                    <p class="text-muted font-15"><strong>Email:</strong> <span
                                            class="m-l-15">{{ $parker->email }}</span></p>
                                   
                                @endforeach
                            @endif

                        </div>
                    </div>
                    <!-- Block-Information -->
                </div>

                <!-- Display error messages if any -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="col-md-8">
                    <div class="row">
                        <div class="col-sm-12 m-b-20">
                            <div class="text-right ">
                                @can('vehicle-create')
                                    <button type="button" class="btn waves-effect waves-light greenbtn"
                                            style="position: absolute; "
                                            onclick="window.location.href='{{ route('vehicle.create', ['stall_id' => $stall->id]) }}'">
                                            <i class="mdi mdi-plus m-r-5"></i> Add Vehicle
                                    </button>
                                @endcan
                            </div>
                        </div>
                    </div>

                 <div class="row">
                    @foreach ($vehicles as $vehicle)
                    <div class="col-md-4 mb-4">
                        <div class="card-box">
                            @foreach ($vehicleTypes as $vehicleType)
                                @if ($vehicleType->id == $vehicle->vehicle_type_id)
                                    <h4 class="header-title mt-0 m-b-20">{{ $vehicleType->name }} - {{ $vehicle->vehicle_no }}</h4>
                                @endif
                            @endforeach
                            <div class="gallery-box" style="height: 200px; overflow: hidden;">
                                <img 
                                    src="{{ asset($vehicle->vehicle_image) }}" 
                                    alt="Vehicle Image" 
                                    class="img-fluid" 
                                    style="width: 100%; height: auto; object-fit: cover;">
                            </div>
                           
                            <div class="panel-body">
                                <p class="text-muted font-15"><strong>Model:
                                </strong>{{ ucfirst($vehicle->model) }}</p>
                                <p class="text-muted font-15"><strong>Registration No:
                                </strong>{{ ucfirst($vehicle->registration_no) }}</p>
                                <p class="text-muted font-15"><strong>Owner Name:
                                    </strong>{{ ucfirst($vehicle->vehicleOwner->name) }}</p>
                                <p class="text-muted font-15"><strong>Owner Phone:
                                    </strong>{{ $vehicle->vehicleOwner->phone?? 'N/A' }}</p>
                               
                                @can('vehicle-edit')
                                    <button type="button"
                                        class="btn btn-success m-t-20 btn-rounded btn-bordered waves-effect w-md waves-light btn-sm"
                                        onclick="window.location.href='{{ route('vehicle.edit', $vehicle->id) }}'">
                                        Edit
                                    </button>
                                @endcan
                                @can('vehicle-delete')
                                    <button type="button"
                                        class="btn btn-danger m-t-20 btn-rounded btn-bordered waves-effect w-md waves-light btn-sm"
                                        onclick="confirmDelete('{{ route('vehicle.delete', ['id' => $vehicle->id]) }}')">
                                        Delete
                                    </button>
                                    <!-- Hidden form for deletion -->
                                    <form id="delete-form"
                                        action="{{ route('vehicle.delete', ['id' => $vehicle->id]) }}" method="GET"
                                        style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                @endcan
                            </div>
                        </div>
                    </div>
               
                    @endforeach

                </div> 
                </div> <!-- content -->
            @endsection
