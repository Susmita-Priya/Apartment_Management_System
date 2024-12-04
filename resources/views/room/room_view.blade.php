@extends('master')

@section('content')
    @push('title')
        <title>Room Details</title>
    @endpush

    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">

            <!-- Breadcrumb and Header -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">{{ $roomType->name }}</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('building') }}">Buildings</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('building.show', $block->building_id) }}">Building</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('block.show', $floor->block_id) }}">Block</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('floor.show', $unit->floor_id) }}">Floor</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('unit.show', $room->unit_id) }}">Unit</a></li>
                            <li class="breadcrumb-item active">Room Details</li>
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
                    <div class="profile-bg-picture" style="background-image:url('{{ asset('image/unit1.webp') }}')">
                        <span class="picture-bg-overlay"></span><!-- overlay -->
                    </div>
                    <!-- meta -->
                    <div class="profile-user-box">
                        <div class="row">
                            <div class="col-sm-6">
                                <span class="pull-left m-r-15"><img src="{{ asset($building->image) }}"
                                        alt="" class="thumb-lg rounded-circle"></span>
                                <div class="media-body">
                                    <h4 class="m-t-7 font-18">{{ $roomType->name }} {{ $room->room_no }}</h4>
                                    <p class="text-muted font-15">{{ $building->name }} Building</p>
                                </div>
                            </div>
                            @can('room-edit')
                            <div class="col-sm-6">
                                <div class="text-right">
                                    <button type="button" class="btn waves-effect waves-light greenbtn"
                                        style=" position: absolute; "
                                        onclick="window.location.href='{{ route('room.edit', $room->id) }}'">
                                        <i class="mdi mdi-pencil m-r-5"></i> Edit Room
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
                        <h4 class="header-title mt-0 m-b-20">Room Information</h4>
                        <div class="panel-body">

                            <p class="text-muted
                                font-15"><strong>Room No:</strong> <span class="m-l-15">{{ $room->room_no }}</span></p>
                            <p class="text-muted
                                font-15"><strong>Room Type:</strong> <span class="m-l-15">{{ $roomType->name }}</span></p>
                            <p class="text-muted font-15"><strong>Date Added:</strong> <span
                                class="m-l-15">{{ $room->created_at->format('d M, Y') }}</span></p>
                            <hr>

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

                            <p class="text-muted font-15"><strong>Block No:</strong> <span
                                    class="m-l-15">{{ $block->block_no }}</span></p>
                            <p class="text-muted font-15"><strong>Block:</strong> <span
                                    class="m-l-15">{{ $block->name }}</span></p>
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
                    <div class="card-box">
                        <h4 class="header-title mt-0 m-b-20">Assets</h4>
                        <div class="panel-body">
                            <div class="row">
                                @foreach ($selectedAmenities as $selectedAmenity)
                                    <div class="col-md-4">
                                        <div class="gallery-box">
                                            <img 
                                                src="{{ asset($selectedAmenity['image']) }}" 
                                                alt="{{ $selectedAmenity['name'] }}" 
                                                class="img-fluid" 
                                                style="height: 350px; width: 350px; object-fit: cover;">
                                        </div>
                                        <div class="text-center mt-2">
                                            <p class="text-muted font-15">
                                                <strong>Name:</strong> {{ $selectedAmenity['name'] }}
                                            </p>
                                            <p class="text-muted font-15">
                                                <strong>Description:</strong> {{ $selectedAmenity['description']??"No Description " }}
                                            </p>
                                            <p class="text-muted font-15">
                                                <strong>Quantity:</strong> {{ $selectedAmenity['quantity'] }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                
                
                
            </div>
            <!-- end row -->


                {{-- <div class="row">
                    @foreach ($rooms as $room)
                    <div class="col-md-4 mb-4">
                        <div class="card-box">
                            <h4 class="header-title mt-0 m-b-20">{{ $room->type }}{{ $room->room_no }}</h4>
                            </h4>
                            <div class="panel-body">
                              
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
               
            @endforeach --}}

        </div>
            </div> <!-- content -->
        @endsection
