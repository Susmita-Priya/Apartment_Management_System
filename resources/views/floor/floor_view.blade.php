@extends('master')

@section('content')
@push('title')
    <title>Block Details</title>
@endpush

<!-- Start content -->
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title float-left">{{ $floor->name }}</h4>

                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="{{ url('/index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/building') }}">Buildings</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('building.show', $block->building_id) }}">Building</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('block.show', $floor->block_id) }}">Block</a></li>
                        <li class="breadcrumb-item active">Floor Details</li>
                    </ol>

                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-sm-12">
                <div class="profile-bg-picture" style="background-image:url('{{ asset('image/floor.jpg') }}')">
                    <span class="picture-bg-overlay"></span><!-- overlay -->
                </div>
                <!-- meta -->
                <div class="profile-user-box">
                    <div class="row">
                        <div class="col-sm-6">
                            <span class="pull-left m-r-15"><img src="{{ asset($block->building->image) }}" alt="" class="thumb-lg rounded-circle"></span>
                            <div class="media-body">
                                <h4 class="m-t-7 font-18">{{ $floor->name }}</h4>
                                <p class="font-13">{{ $floor->block->building->name }} Building</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="text-right">
                                <button type="button" class="btn waves-effect waves-light" 
                           style="background-color: rgb(100, 197, 177); border-color: rgb(100, 197, 177); color: white; 
                                  position: absolute; right: 10px; top: 50%; transform: translateY(-50%);  text-decoration: none;"
                                        onclick="window.location.href='{{ route('floor.edit', $floor->id) }}'">
                                    <i class="mdi mdi-pencil m-r-5"></i> Edit Floor
                                </button>
                            </div>
                        </div>
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
                    <h4 class="header-title mt-0 m-b-20">Floor Information</h4>
                    <div class="panel-body">

                        <p class="text-muted font-13"><strong>Floor No:</strong> <span class="m-l-15">{{ $floor->floor_no }}</p>
                        <p class="text-muted font-13"><strong>Floor Name:</strong> <span class="m-l-15">{{ $floor->name }}</p>
                        <p class="text-muted font-13"><strong>Type:</strong> <span class="m-l-15">{{ ucfirst($floor->type) }} floor</p>
                        <hr>

                        <p class="text-muted font-13"><strong>Block ID:</strong> <span class="m-l-15">{{ $block->block_id }}</span></p>
                        <p class="text-muted font-13"><strong>Block:</strong> <span class="m-l-15">{{ $block->name }}</span></p>
                        <hr>

                        @php
                            $typeFullForm = [
                                'RESB' => 'Residential',
                                'COMB' => 'Commercial',
                                'RECB' => 'Residential-Commercial',
                            ];
                        @endphp

                        <p class="text-muted font-13"><strong>Building:</strong> <span class="m-l-15">{{ $block->building->name }} </span></p>
                        <p class="text-muted font-13"><strong>Building Type:</strong> <span class="m-l-15">{{ $typeFullForm[$block->building->type] ?? 'Other' }}</span></p>
                        <hr>
                        {{-- <p class="text-muted font-13"><strong>Number of Units:</strong> <span class="m-l-15">{{ $block->floors_count }}</span></p> --}}

                        

                        @if($building->type === 'RESB' || $building->type === 'RECB')
                            <p class="text-muted font-13"><strong>Residential Suites:</strong><span class="m-l-15">Yes</p>
                        @endif
                                
                        @if($building->type === 'COMB' || $building->type === 'RECB')
                            <p class="text-muted font-13"><strong>Commercial Units:</strong><span class="m-l-15">Yes</p>
                        @endif

                        <p class="text-muted font-13"><strong>Supporting & Service Room:</strong> <span class="m-l-15">{{ $floor->supporting_service_room ? 'Yes' : 'No' }}</p>
                        <p class="text-muted font-13"><strong>Parking Lot:</strong> <span class="m-l-15">{{ $floor->parking_lot ? 'Yes' : 'No' }}</p>
                        <p class="text-muted font-13"><strong>Bike Lot:</strong> <span class="m-l-15">{{ $floor->bike_lot ? 'Yes' : 'No' }}</p>
                        <p class="text-muted font-13"><strong>Storage Lot:</strong> <span class="m-l-15">{{ $floor->storage_lot ? 'Yes' : 'No' }}</p>
                        <p class="text-muted font-13"><strong>Common Area:</strong> <span class="m-l-15">{{ $floor->common_area ? 'Yes' : 'No' }}</p>

                        <p class="text-muted font-13"><strong>Date Added:</strong> <span class="m-l-15">{{ $block->created_at->format('d M, Y') }}</span></p>

                        {{-- <p class="text-muted font-13"><strong>Block Image :</strong>
                            <span class="m-l-15"><img src="{{ asset($block->image) }}" style="width:27%; height:27%" alt="image can't found"></span>
                        </p> --}}

                    </div>
                </div>
                <!-- Block-Information -->
            </div>

            <div class="col-md-8">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="text-right m-b-20">
                            <button type="button" class="btn waves-effect waves-light"
                            style="background-color: rgb(100, 197, 177); border-color: rgb(100, 197, 177); color: white; 
                                  position: absolute; right: 10px;  transform: translateY(-50%);  text-decoration: none;"
                                    onclick="window.location.href='{{ route('floor.create', ['block_id' => $block->id]) }}'"
                                    >
                                <i class="mdi mdi-plus m-r-5"></i> 

                                @if($building->type === 'RESB' || $building->type === 'RECB')
                                   Add Suite
                                @endif
                                
                                @if($building->type === 'COMB' || $building->type === 'RECB')
                                  Add Unit
                                @endif

                                @if($building->type === 'RECB')
                                Add Suite / Unit
                              @endif
                                
                            </button>
                        </div>
                    </div>
                </div>
                <!-- end row -->
<!-- Floors List -->
{{-- <div class="row"> --}}
    <!-- Residential Suite, Supporting Room & Mailroom (for Residential buildings) -->
    {{-- @if ($block->building->type === 'RESB')
        <div class="col-12">
            <h4 class="header-title mt-0 m-b-20">Residential Suite, Supporting Room & Mailroom</h4>
            @php
                $sortedFloors = $block->floors->sortBy('floor_no');
            @endphp
            @foreach($sortedFloors->chunk(3) as $chunk)
                <div class="row">
                    @foreach($chunk as $floor)
                        @if($floor->residential_suite || $floor->supporting_service_room || $floor->mailroom)
                            <div class="col-md-4">
                                <div class="card-box">
                                    <h4 class="header-title mt-0 m-b-20">{{ $floor->name }}</h4>
                                    <div class="panel-body">
                                    <p class="text-muted font-13"><strong>Floor No: </strong>{{ $floor->floor_no }}</p>
                                    <p class="text-muted font-13"><strong>Type: </strong>{{ ucfirst($floor->type) }}</p>
                                    @if($floor->residential_suite)
                                        <p class="text-muted font-13"><strong>Residential Suite: </strong>Yes</p>
                                    @endif
                                    @if($floor->supporting_service_room)
                                        <p class="text-muted font-13"><strong>Supporting Service Room: </strong>Yes</p>
                                    @endif
                                    @if($floor->mailroom)
                                        <p class="text-muted font-13"><strong>Mailroom: </strong>Yes</p>
                                    @endif
                                    <button type="button" 
                                        onclick="window.location.href='{{ route('floor.show', $floor->id) }}'"
                                        class="btn btn-info m-t-20 btn-rounded btn-bordered waves-effect w-md waves-light btn-sm">
                                        Enter
                                    </button>
                                    <button type="button" 
                                        class="btn btn-success m-t-20 btn-rounded btn-bordered waves-effect w-md waves-light btn-sm" 
                                        onclick="window.location.href='{{ route('floor.edit', $floor->id) }}'">
                                        Edit
                                    </button>
                                    <a type="button" 
                                       href="{{ route('floor.delete', ['id' => $floor->id]) }}"
                                       class="btn btn-danger m-t-20 btn-rounded btn-bordered waves-effect w-md waves-light btn-sm">
                                        Delete
                                    </a>
                                </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endforeach
        </div>
    @endif --}}

    <!-- Commercial Unit, Supporting Room & Mailroom (for Commercial buildings) -->
    {{-- @if ($block->building->type === 'COMB')
        <div class="col-12">
            <h4 class="header-title mt-0 m-b-20">Commercial Unit, Supporting Room & Mailroom</h4>
            @php
                $sortedFloors = $block->floors->sortBy('floor_no');
            @endphp
            @foreach($sortedFloors->chunk(3) as $chunk)
                <div class="row">
                    @foreach($chunk as $floor)
                        @if($floor->commercial_unit || $floor->supporting_service_room || $floor->mailroom)
                            <div class="col-md-4">
                                <div class="card-box">
                                    <h4 class="header-title mt-0 m-b-20">{{ $floor->name }}</h4>
                                    <div class="panel-body">
                                    <p class="text-muted font-13"><strong>Floor No: </strong>{{ $floor->floor_no }}</p>
                                    <p class="text-muted font-13"><strong>Type: </strong>{{ ucfirst($floor->type) }}</p>
                                    @if($floor->commercial_unit)
                                        <p class="text-muted font-13"><strong>Commercial Unit: </strong>Yes</p>
                                    @endif
                                    @if($floor->supporting_service_room)
                                        <p class="text-muted font-13"><strong>Supporting Service Room: </strong>Yes</p>
                                    @endif
                                    @if($floor->mailroom)
                                        <p class="text-muted font-13"><strong>Mailroom: </strong>Yes</p>
                                    @endif
                                    <button type="button" 
                                        onclick="window.location.href='{{ route('floor.show', $floor->id) }}'"
                                        class="btn btn-info m-t-20 btn-rounded btn-bordered waves-effect w-md waves-light btn-sm">
                                        Enter
                                    </button>
                                    <button type="button" 
                                        class="btn btn-success m-t-20 btn-rounded btn-bordered waves-effect w-md waves-light btn-sm" 
                                        onclick="window.location.href='{{ route('floor.edit', $floor->id) }}'">
                                        Edit
                                    </button>
                                    <a type="button" 
                                       href="{{ route('floor.delete', ['id' => $floor->id]) }}"
                                       class="btn btn-danger m-t-20 btn-rounded btn-bordered waves-effect w-md waves-light btn-sm">
                                        Delete
                                    </a>
                                </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endforeach
        </div>
    @endif

    <!-- Residential Suite, Commercial Unit, Supporting Room & Mailroom (for Residential-Commercial buildings) -->
    @if ($block->building->type === 'RECB')
        <div class="col-12">
            <h4 class="header-title mt-0 m-b-20">Residential Suite, Commercial Unit, Supporting Room & Mailroom</h4>
            @php
                $sortedFloors = $block->floors->sortBy('floor_no');
            @endphp
            @foreach($sortedFloors->chunk(3) as $chunk)
                <div class="row">
                    @foreach($chunk as $floor)
                        @if($floor->residential_suite || $floor->commercial_unit || $floor->supporting_service_room || $floor->mailroom)
                            <div class="col-md-4">
                                <div class="card-box">
                                    <h4 class="header-title mt-0 m-b-20">{{ $floor->name }}</h4>
                                    <div class="panel-body">
                                    <p class="text-muted font-13"><strong>Floor No: </strong>{{ $floor->floor_no }}</p>
                                    <p class="text-muted font-13"><strong>Type: </strong>{{ ucfirst($floor->type) }}</p>
                                    @if($floor->residential_suite)
                                        <p class="text-muted font-13"><strong>Residential Suite: </strong>Yes</p>
                                    @endif
                                    @if($floor->commercial_unit)
                                        <p class="text-muted font-13"><strong>Commercial Unit: </strong>Yes</p>
                                    @endif
                                    @if($floor->supporting_service_room)
                                        <p class="text-muted font-13"><strong>Supporting Service Room: </strong>Yes</p>
                                    @endif
                                    @if($floor->mailroom)
                                        <p class="text-muted font-13"><strong>Mailroom: </strong>Yes</p>
                                    @endif
                                    <button type="button" 
                                        onclick="window.location.href='{{ route('floor.show', $floor->id) }}'"
                                        class="btn btn-info m-t-20 btn-rounded btn-bordered waves-effect w-md waves-light btn-sm">
                                        Enter
                                    </button>
                                    <button type="button" 
                                        class="btn btn-success m-t-20 btn-rounded btn-bordered waves-effect w-md waves-light btn-sm" 
                                        onclick="window.location.href='{{ route('floor.edit', $floor->id) }}'">
                                        Edit
                                    </button>
                                    <a type="button" 
                                       href="{{ route('floor.delete', ['id' => $floor->id]) }}"
                                       class="btn btn-danger m-t-20 btn-rounded btn-bordered waves-effect w-md waves-light btn-sm">
                                        Delete
                                    </a>
                                </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endforeach
        </div>
    @endif --}}
<!-- Parking Lot, Bike Lot & Storage Lot (for all buildings) -->
{{-- <div class="col-12">
    <h4 class="header-title mt-0 m-b-20">Parking Lot, Bike Lot & Storage Lot</h4>
    @php
        $sortedFloors = $block->floors->sortBy('floor_no');
        $chunkedFloors = $sortedFloors->filter(function ($floor) {
            return $floor->parking_lot || $floor->bike_lot || $floor->storage_lot;
        })->chunk(3);
    @endphp
    @foreach($chunkedFloors as $chunk)
        <div class="row">
            @foreach($chunk as $floor)
                <div class="col-md-4 mb-4">
                    <div class="card-box">
                        <h4 class="header-title mt-0 m-b-20">{{ $floor->name }}</h4>
                        <p class="text-muted font-13"><strong>Floor No: </strong>{{ $floor->floor_no }}</p>
                        <p class="text-muted font-13"><strong>Type: </strong>{{ ucfirst($floor->type) }}</p>
                        @if($floor->parking_lot)
                            <p class="text-muted font-13"><strong>Parking Lot: </strong>Yes</p>
                        @endif
                        @if($floor->bike_lot)
                            <p class="text-muted font-13"><strong>Bike Lot: </strong>Yes</p>
                        @endif
                        @if($floor->storage_lot)
                            <p class="text-muted font-13"><strong>Storage Lot: </strong>Yes</p>
                        @endif
                        <button type="button" 
                            onclick="window.location.href='{{ route('floor.show', $floor->id) }}'"
                            class="btn btn-info m-t-20 btn-rounded btn-bordered waves-effect w-md waves-light btn-sm">
                            Enter
                        </button>
                        <button type="button" 
                            class="btn btn-success m-t-20 btn-rounded btn-bordered waves-effect w-md waves-light btn-sm" 
                            onclick="window.location.href='{{ route('floor.edit', $floor->id) }}'">
                            Edit
                        </button>
                        <a type="button" 
                           href="{{ route('floor.delete', ['id' => $floor->id]) }}"
                           class="btn btn-danger m-t-20 btn-rounded btn-bordered waves-effect w-md waves-light btn-sm">
                            Delete
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
</div> --}}

<!-- Common Area (for all buildings) -->
{{-- <div class="col-12">
    <h4 class="header-title mt-0 m-b-20">Common Area</h4>
    @php
        $sortedFloors = $block->floors->sortBy('floor_no');
        $chunkedFloors = $sortedFloors->filter(function ($floor) {
            return $floor->common_area;
        })->chunk(3);
    @endphp
    @foreach($chunkedFloors as $chunk)
        <div class="row">
            @foreach($chunk as $floor)
                <div class="col-md-4 mb-4">
                    <div class="card-box">
                        <h4 class="header-title mt-0 m-b-20">{{ $floor->name }}</h4>
                        <p class="text-muted font-13"><strong>Floor No: </strong>{{ $floor->floor_no }}</p>
                        <p class="text-muted font-13"><strong>Type: </strong>{{ ucfirst($floor->type) }}</p>
                        <p class="text-muted font-13"><strong>Common Area: </strong>Yes</p>
                        <button type="button" 
                            onclick="window.location.href='{{ route('floor.show', $floor->id) }}'"
                            class="btn btn-info m-t-20 btn-rounded btn-bordered waves-effect w-md waves-light btn-sm">
                            Enter
                        </button>
                        <button type="button" 
                            class="btn btn-success m-t-20 btn-rounded btn-bordered waves-effect w-md waves-light btn-sm" 
                            onclick="window.location.href='{{ route('floor.edit', $floor->id) }}'">
                            Edit
                        </button>
                        <a type="button" 
                           href="{{ route('floor.delete', ['id' => $floor->id]) }}"
                           class="btn btn-danger m-t-20 btn-rounded btn-bordered waves-effect w-md waves-light btn-sm">
                            Delete
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
</div> --}}


</div>
<!-- End Floors List -->

            </div>
        </div>
        <!-- end row -->
    </div>
</div>
<!-- end content -->
@endsection

