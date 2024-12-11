@extends('master')

@section('content')
    @push('title')
        <title>Unit Details</title>
    @endpush

    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">

            <!-- Breadcrumb and Header -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Unit-{{ $unit->unit_no }}</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('building') }}">Buildings</a></li>
                            <li class="breadcrumb-item"><a
                                    href="{{ route('building.show', $floor->building_id) }}">Building</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('floor.show', $unit->floor_id) }}">Floor</a></li>
                            <li class="breadcrumb-item active">Unit Details</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            @php
                $i = 1;
            @endphp
            <div class="row">
                <div class="col-sm-12">
                    <div class="profile-bg-picture" style="background-image:url('{{ asset('image/unit.webp') }}')">
                        <span class="picture-bg-overlay"></span><!-- overlay -->
                    </div>
                    <!-- meta -->
                    <div class="profile-user-box">
                        <div class="row">
                            <div class="col-sm-6">
                                <span class="pull-left m-r-15"><img src="{{ asset($building->image) }}"
                                        alt="" class="thumb-lg rounded-circle"></span>
                                <div class="media-body">
                                    <h4 class="m-t-7 font-18">Unit-{{ $unit->unit_no }}</h4>
                                    <p class="text-muted font-15">{{ $building->name }} Building</p>
                                </div>
                            </div>
                            @can('unit-edit')
                            <div class="col-sm-6">
                                <div class="text-right">
                                    <button type="button" class="btn waves-effect waves-light greenbtn"
                                        style=" position: absolute; "
                                        onclick="window.location.href='{{ route('unit.edit', $unit->id) }}'">
                                        <i class="mdi mdi-pencil m-r-5"></i> Edit Unit
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
                        <h4 class="header-title mt-0 m-b-20">Unit Information</h4>
                        <div class="panel-body">

                            <p class="text-muted font-15"><strong>
                                        Unit:
                                </strong> <span class="m-l-15">Unit-{{ $unit->unit_no }} </span></p>
                            <p class="text-muted font-15"><strong>
                                        Unit Type:
                                </strong> <span class="m-l-15"> {{ ucfirst($unit->type) }} Unit</span></p>
                                <p class="text-muted font-15"><strong>
                                    Unit Rent:
                            </strong> <span class="m-l-15">{{ $unit->rent }} TK</span></p>
                            <p class="text-muted font-15"><strong>
                                Unit Price:
                        </strong> <span class="m-l-15">{{ $unit->price }} TK</span></p>
                            <p class="text-muted font-15"><strong>Date Added:</strong> <span
                                    class="m-l-15">{{ $unit->created_at->format('d M, Y') }}</span></p>

                            <p class="text-muted font-15"><strong>Unit Status:</strong> <span
                                    class="m-l-15"><span class="badge bg-{{ $unit->status == 0 ? 'danger' : ($unit->status == 1 ? 'primary' : 'success') }}">
                                        {{ $unit->status == 0 ? 'Vacant' : ($unit->status == 1 ? 'Pending' : 'Occupied') }}</span></p>
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

                            <p class="text-muted font-15"><strong>Floor No:</strong> <span
                                    class="m-l-15">{{ $floor->floor_no }}<sup>{{ $suffix }}</sup> floor</span></p>
                            <p class="text-muted font-15"><strong>Floor Name:</strong> <span
                                    class="m-l-15">{{ $floor->name }}</span></p>

                            <hr>

                            {{-- <p class="text-muted font-15"><strong>Block No:</strong> <span
                                    class="m-l-15">{{ $block->block_no }}</span></p>
                            <p class="text-muted font-15"><strong>Block:</strong> <span
                                    class="m-l-15">{{ $block->name }}</span></p>
                            <hr> --}}

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
                        <h4 class="header-title mt-0 m-b-20">Landlord Information</h4>
                        {{-- <div class="panel-body">

                            @if ($unit->landlords->isEmpty())
                                No Landlord
                            @else
                                @foreach ($unit->landlords as $landlord) <hr>
                                   <h5 class="header-title mt-0 m-b-20">Landlord {{ $i++ }} </h5>
                                  
                                    <p class="text-muted font-15"><strong>Name:</strong> <span class="m-l-15">{{ $landlord->name }}</span></p>
                                    <p class="text-muted font-15"><strong>Phone:</strong> <span class="m-l-15">{{ $landlord->phone }}</span></p>
                                    <p class="text-muted font-15"><strong>Email:</strong> <span class="m-l-15">{{ $landlord->email }}</span></p>
                                    <p class="text-muted font-15"><strong>NID:</strong> <span class="m-l-15">{{ $landlord->nid }}</span></p>
                                    <p class="text-muted font-15"><strong>Tax ID:</strong> <span class="m-l-15">{{ $landlord->tax_id }}</span></p>
                                    <p class="text-muted font-15"><strong>Passport:</strong> <span class="m-l-15">{{ $landlord->passport }}</span></p>
                                    <p class="text-muted font-15"><strong>Driving License:</strong> <span class="m-l-15">{{ $landlord->driving_license }}</span></p>
                                    <p class="text-muted font-15"><strong>DOB:</strong> <span class="m-l-15">{{ $landlord->dob }}</span></p>
                                    <p class="text-muted font-15"><strong>Marital Status:</strong> <span class="m-l-15">{{ $landlord->marital_status }}</span></p>
                                    <p class="text-muted font-15"><strong>Address:</strong> <span class="m-l-15">{{ $landlord->per_address }}</span></p>
                                    <p class="text-muted font-15"><strong>Occupation:</strong> <span class="m-l-15">{{ $landlord->occupation }}</span></p>
                                    <p class="text-muted font-15"><strong>Company:</strong> <span class="m-l-15">{{ $landlord->company }}</span></p>
                                    <p class="text-muted font-15"><strong>Religion:</strong> <span class="m-l-15">{{ $landlord->religion }}</span></p>
                                    <p class="text-muted font-15"><strong>Qualification:</strong> <span class="m-l-15">{{ $landlord->qualification }}</span></p>
                                @endforeach
                            @endif

                        </div> --}}
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
                                    @can('room-create')
                                        <button type="button" class="btn waves-effect waves-light greenbtn"
                                            style="position: absolute; "
                                            onclick="window.location.href='{{ route('room.create', ['unit_id' => $unit->id]) }}'">
                                            <i class="mdi mdi-plus m-r-5"></i> Add Room
                                        </button>
                                    @endcan
                            </div>
                        </div>
                    </div>

                <div class="row">
                    @foreach ($rooms as $room)
                    <div class="col-md-4 mb-4">
                        <div class="card-box">
                            @foreach ($roomTypes as $roomType)
                                @if ($roomType->id == $room->room_type_id)
                                    <h4 class="header-title mt-0 m-b-20">{{ $roomType->name }} - {{ $room->room_no }}</h4>
                                @endif
                            @endforeach
                           
                            <div class="panel-body">
                                {{-- <p class="text-muted font-15"><strong>Type:
                                    </strong>{{ ucfirst($unit->type) }} Unit</p> --}}
                                @can('room-list')
                                    <button type="button"
                                        onclick="window.location.href='{{ route('room.show', $room->id) }}'"
                                        class="btn btn-info m-t-20 btn-rounded btn-bordered waves-effect w-md waves-light btn-sm">
                                        Enter
                                    </button>
                                @endcan
                                @can('room-edit')
                                    <button type="button"
                                        class="btn btn-success m-t-20 btn-rounded btn-bordered waves-effect w-md waves-light btn-sm"
                                        onclick="window.location.href='{{ route('room.edit', $room->id) }}'">
                                        Edit
                                    </button>
                                @endcan
                                @can('room-delete')
                                    <button type="button"
                                        class="btn btn-danger m-t-20 btn-rounded btn-bordered waves-effect w-md waves-light btn-sm"
                                        onclick="confirmDelete('{{ route('room.delete', ['id' => $room->id]) }}')">
                                        Delete
                                    </button>
                                    <!-- Hidden form for deletion -->
                                    <form id="delete-form"
                                        action="{{ route('room.delete', ['id' => $room->id]) }}" method="GET"
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
