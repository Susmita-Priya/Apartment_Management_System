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
                        <h4 class="page-title float-left">{{ $block->name }}</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('building') }}">Buildings</a></li>
                            <li class="breadcrumb-item"><a
                                    href="{{ route('building.show', $block->building_id) }}">Building</a></li>
                            <li class="breadcrumb-item active">Block Details</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-sm-12">
                    <div class="profile-bg-picture" style="background-image:url('{{ asset('image/block_bg.webp') }}')">
                        <span class="picture-bg-overlay"></span><!-- overlay -->
                    </div>
                    <!-- meta -->
                    <div class="profile-user-box">
                        <div class="row">
                            <div class="col-sm-6">
                                <span class="pull-left m-r-15"><img src="{{ asset($block->building->image) }}"
                                        alt="" class="thumb-lg rounded-circle"></span>
                                <div class="media-body">
                                    <h4 class="m-t-7 font-18">{{ $block->name }}</h4>
                                    <p class="text-muted font-15">{{ $block->building->name }} Building</p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="text-right">
                                    <button type="button" class="btn waves-effect waves-light"
                                        style="background-color: rgb(100, 197, 177); border-color: rgb(100, 197, 177); color: white; 
                                  position: absolute; right: 10px; top: 50%; transform: translateY(-50%);  text-decoration: none;"
                                        onclick="window.location.href='{{ route('block.edit', $block->id) }}'">
                                        <i class="mdi mdi-pencil m-r-5"></i> Edit Block
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
                        <h4 class="header-title mt-0 m-b-20">Block Information</h4>
                        <div class="panel-body">
                            <p class="text-muted font-15"><strong>Block ID:</strong> <span
                                    class="m-l-15">{{ $block->block_id }}</span></p>
                            <p class="text-muted font-15"><strong>Block Name:</strong> <span
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
                                    class="m-l-15">{{ $block->building->name }} </span></p>
                            <p class="text-muted font-15"><strong>Building ID:</strong> <span
                                    class="m-l-15">{{ $building->building_id }}</span></p>
                            <p class="text-muted font-15"><strong>Building Type:</strong> <span
                                    class="m-l-15">{{ $typeFullForm[$block->building->type] ?? 'Other' }}</span></p>

                            <hr>

                            <p class="text-muted font-15"><strong>Number of Floors:</strong> <span
                                    class="m-l-15">{{ $block->floors_count }}</span></p>

                            <p class="text-muted font-15"><strong>Date Added:</strong> <span
                                    class="m-l-15">{{ $block->created_at->format('d M, Y') }}</span></p>

                            {{-- <p class="text-muted font-13"><strong>Block Image :</strong>
                            <span class="m-l-15"><img src="{{ asset($block->image) }}" style="width:27%; height:27%"
                        alt="image can't found"></span>
                        </p> --}}

                        </div>
                    </div>
                    <!-- Block-Information -->
                </div>

                <div class="col-md-8">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="text-right m-b-20">
                                {{-- <button type="button" class="btn waves-effect waves-light"
                            style="background-color: rgb(100, 197, 177); border-color: rgb(100, 197, 177); color: white; 
                                  position: absolute; right: 10px;  transform: translateY(-50%);  text-decoration: none;"
                                    onclick="window.location.href='{{ route('floor.create', ['block_id' => $block->id]) }}'"
                            >
                            <i class="mdi mdi-plus m-r-5"></i> Add Floor
                            </button> --}}
                                <div class="btn-group">
                                    <button type="button" class="btn waves-effect waves-light dropdown-toggle"
                                        style="background-color: rgb(100, 197, 177); border-color: rgb(100, 197, 177); color: white;"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Add <span class="caret"></span>
                                    </button>

                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                        <a class="dropdown-item"
                                            href="{{ route('floor.create', ['block_id' => $block->id]) }}">
                                            <i class="mdi mdi-plus m-r-10 text-muted font-18 vertical-middle"></i> Add Floor
                                        </a>
                                        <a class="dropdown-item"
                                            href="{{ route('comarea.create', ['block_id' => $block->id]) }}">
                                            <i class="mdi mdi-plus m-r-10 text-muted font-18 vertical-middle"></i> Add
                                            Common Area
                                        </a>
                                        {{-- <a class="dropdown-item" href="{{ route('amroom.create', ['unit_id' => $unit->id]) }}">
                                    <i class="mdi mdi-plus m-r-10 text-muted font-18 vertical-middle"></i> Amenity Room
                                    </a> --}}
                                        {{-- <a class="dropdown-item" href="{{ route('floor.create', ['block_id' => $block->id]) }}">
                                    <i class="mdi mdi-plus m-r-10 text-muted font-18 vertical-middle"></i> Service Room
                                    </a> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                    <!-- Floors List -->
                    <div class="row">

                        @php
                            $sortedFloors = $block->floors->sortBy('floor_no');
                        @endphp

                        @php
                            $sections = [
                                'RESB' => 'Residential Suite & Supporting Unit',
                                'COMB' => 'Commercial Unit & Supporting Unit',
                                'RECB' => 'Residential Suite, Commercial Unit & Supporting Unit',
                            ];
                        @endphp

                        @foreach ($sections as $type => $title)
                            @if ($block->building->type === $type)
                                <div class="col-12">
                                    <h4 class="header-title mt-0 m-b-20">{{ $title }}</h4>
                                    @foreach ($sortedFloors->filter(function ($floor) use ($type) {
                return ($type === 'RESB' && ($floor->residential_suite || $floor->supporting_service_room || $floor->mailroom)) || ($type === 'COMB' && ($floor->commercial_unit || $floor->supporting_service_room || $floor->mailroom)) || ($type === 'RECB' && ($floor->residential_suite || $floor->commercial_unit || $floor->supporting_service_room || $floor->mailroom));
            })->chunk(3) as $chunk)
                                        <div class="row">
                                            @foreach ($chunk as $floor)
                                                <div class="col-md-4 mb-4">
                                                    <div class="card-box">
                                                        <h4 class="header-title mt-0 m-b-20">{{ $floor->name }}</h4>
                                                        <p class="text-muted font-15"><strong>Floor No:
                                                            </strong>{{ $floor->type }}-{{ $floor->floor_no }}</p>
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
                                                        <button type="button"
                                                            class="btn btn-danger m-t-20 btn-rounded btn-bordered waves-effect w-md waves-light btn-sm"
                                                            onclick="confirmDelete('{{ route('floor.delete', ['id' => $floor->id]) }}')">
                                                            Delete
                                                        </button>
                                                        <!-- Hidden form for deletion -->
                                                        <form id="delete-form"
                                                            action="{{ route('floor.delete', ['id' => $floor->id]) }}"
                                                            method="GET" style="display: none;">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        @endforeach

                        <!-- Parking Lot, Bike Lot & Storage Lot (for all buildings) -->
                        <div class="col-12">
                            <h4 class="header-title mt-0 m-b-20">Parking Lot, Bike Lot & Storage Lot</h4>
                            @foreach ($sortedFloors->filter(function ($floor) {
                return $floor->parking_lot || $floor->bike_lot || $floor->storage_lot;
            })->chunk(3) as $chunk)
                                <div class="row">
                                    @foreach ($chunk as $floor)
                                        <div class="col-md-4 mb-4">
                                            <div class="card-box">
                                                <h4 class="header-title mt-0 m-b-20">{{ $floor->name }}</h4>
                                                <p class="text-muted font-15"><strong>Floor No:
                                                    </strong>{{ $floor->type }}-{{ $floor->floor_no }}</p>
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
                                                <button type="button"
                                                    class="btn btn-danger m-t-20 btn-rounded btn-bordered waves-effect w-md waves-light btn-sm"
                                                    onclick="confirmDelete('{{ route('floor.delete', ['id' => $floor->id]) }}')">
                                                    Delete
                                                </button>
                                                <!-- Hidden form for deletion -->
                                                <form id="delete-form"
                                                    action="{{ route('floor.delete', ['id' => $floor->id]) }}"
                                                    method="GET" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>

                        <!-- Common Area (for all buildings) -->
                        <div class="col-12">
                            <h4 class="header-title mt-0 m-b-20">Common Area</h4>
                            @foreach ($sortedFloors->filter(function ($floor) {
                return $floor->common_area;
            })->chunk(3) as $chunk)
                                <div class="row">
                                    @foreach ($chunk as $floor)
                                        <div class="col-md-4 mb-4">
                                            <div class="card-box">
                                                <h4 class="header-title mt-0 m-b-20">{{ $floor->name }}</h4>
                                                <p class="text-muted font-15"><strong>Floor No:
                                                    </strong>{{ $floor->type }}-{{ $floor->floor_no }}</p>
                                                {{-- <p class="text-muted font-15"><strong>Type: </strong>{{ ucfirst($floor->type) }}
                                    </p> --}}
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
                                                {{-- <a type="button" 
                               href="{{ route('floor.delete', ['id' => $floor->id]) }}"
                                    class="btn btn-danger m-t-20 btn-rounded btn-bordered waves-effect w-md waves-light
                                    btn-sm">
                                    Delete
                                    </a> --}}
                                                <button type="button"
                                                    class="btn btn-danger m-t-20 btn-rounded btn-bordered waves-effect w-md waves-light btn-sm"
                                                    onclick="confirmDelete('{{ route('floor.delete', ['id' => $floor->id]) }}')">
                                                    Delete
                                                </button>
                                                <!-- Hidden form for deletion -->
                                                <form id="delete-form"
                                                    action="{{ route('floor.delete', ['id' => $floor->id]) }}"
                                                    method="GET" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>

                    </div>
                    <!-- End Floors List -->

                </div>
            </div>
            <!-- end row -->
        </div>
    </div>
    <!-- end content -->
@endsection
