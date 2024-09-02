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
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('building') }}">Buildings</a></li>
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
                                <p class="font-15">{{ $floor->block->building->name }} Building</p>
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

                        <p class="text-muted font-15"><strong>Floor No:</strong> <span class="m-l-15">{{ $floor->floor_no }}</p>
                        <p class="text-muted font-15"><strong>Floor Name:</strong> <span class="m-l-15">{{ $floor->name }}</p>
                        <p class="text-muted font-15"><strong>Type:</strong> <span class="m-l-15">{{ ucfirst($floor->type) }} floor</p>
                            <p class="text-muted font-15"><strong>Date Added:</strong> <span class="m-l-15">{{ $floor->created_at->format('d M, Y') }}</span></p>
                            <p class="text-muted font-15"><strong>Number of Units:</strong> <span class="m-l-15">{{ $floor->units_count }}</span></p>

                        <hr>

                        <p class="text-muted font-15"><strong>Block ID:</strong> <span class="m-l-15">{{ $block->block_id }}</span></p>
                        <p class="text-muted font-15"><strong>Block:</strong> <span class="m-l-15">{{ $block->name }}</span></p>
                        <hr>

                        @php
                            $typeFullForm = [
                                'RESB' => 'Residential',
                                'COMB' => 'Commercial',
                                'RECB' => 'Residential-Commercial',
                            ];
                        @endphp

                        <p class="text-muted font-15"><strong>Building:</strong> <span class="m-l-15">{{ $block->building->name }} </span></p>
                        <p class="text-muted font-15"><strong>Building ID:</strong> <span class="m-l-15">{{ $building->building_id }}</span></p>
                        <p class="text-muted font-15"><strong>Building Type:</strong> <span class="m-l-15">{{ $typeFullForm[$block->building->type] ?? 'Other' }}</span></p>
                        <hr>
                        

                        @if($building->type === 'RESB' || $building->type === 'RECB')
                            {{-- <p class="text-muted font-15"><strong>Residential Suites:</strong><span class="m-l-15">Yes</p> --}}
                                <p class="text-muted font-15"><strong>Residential Suites:</strong> <span class="m-l-15">{{ $floor->residential_suite ? 'Yes' : 'No' }}</p>
                        @endif
                                
                        @if($building->type === 'COMB' || $building->type === 'RECB')
                            {{-- <p class="text-muted font-15"><strong>Commercial Units:</strong><span class="m-l-15">Yes</p> --}}
                            <p class="text-muted font-15"><strong>Commercial Units:</strong> <span class="m-l-15">{{ $floor->commercial_unit? 'Yes' : 'No' }}</p>
                                
                        @endif

                        <p class="text-muted font-15"><strong>Supporting & Service Room:</strong> <span class="m-l-15">{{ $floor->supporting_service_room ? 'Yes' : 'No' }}</p>
                        <p class="text-muted font-15"><strong>Parking Lot:</strong> <span class="m-l-15">{{ $floor->parking_lot ? 'Yes' : 'No' }}</p>
                        <p class="text-muted font-15"><strong>Bike Lot:</strong> <span class="m-l-15">{{ $floor->bike_lot ? 'Yes' : 'No' }}</p>
                        <p class="text-muted font-15"><strong>Storage Lot:</strong> <span class="m-l-15">{{ $floor->storage_lot ? 'Yes' : 'No' }}</p>
                        <p class="text-muted font-15"><strong>Common Area:</strong> <span class="m-l-15">{{ $floor->common_area ? 'Yes' : 'No' }}</p>
                        

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

                             @if($floor->parking_lot || $floor->bike_lot)
                                       
                            <button type="button" class="btn waves-effect waves-light"
                            style="background-color: rgb(100, 197, 177); border-color: rgb(100, 197, 177); color: white; 
                                  position: absolute; right: 10px;  transform: translateY(-50%);  text-decoration: none;"
                                    onclick="window.location.href='{{ route('unit.create', ['floor_id' => $floor->id]) }}'">
                                <i class="mdi mdi-plus m-r-5"></i> Add Stall 
                                                    
                                @elseif($building->type === 'RESB' )
                                <button type="button" class="btn waves-effect waves-light"
                                style="background-color: rgb(100, 197, 177); border-color: rgb(100, 197, 177); color: white; 
                                      position: absolute; right: 10px;  transform: translateY(-50%);  text-decoration: none;"
                                        onclick="window.location.href='{{ route('unit.create', ['floor_id' => $floor->id]) }}'">
                                    <i class="mdi mdi-plus m-r-5"></i> Add Suite
                                                            
                                @elseif($building->type === 'COMB' )
                                <button type="button" class="btn waves-effect waves-light"
                                style="background-color: rgb(100, 197, 177); border-color: rgb(100, 197, 177); color: white; 
                                      position: absolute; right: 10px;  transform: translateY(-50%);  text-decoration: none;"
                                        onclick="window.location.href='{{ route('unit.create', ['floor_id' => $floor->id]) }}'">
                                    <i class="mdi mdi-plus m-r-5"></i> Add Unit
                                
                                @elseif($building->type === 'RECB')
                                <button type="button" class="btn waves-effect waves-light"
                                style="background-color: rgb(100, 197, 177); border-color: rgb(100, 197, 177); color: white; 
                                      position: absolute; right: 10px;  transform: translateY(-50%);  text-decoration: none;"
                                        onclick="window.location.href='{{ route('unit.create', ['floor_id' => $floor->id]) }}'"
                                        >
                                    <i class="mdi mdi-plus m-r-5"></i> Add Suite / Unit
                                @endif

                            </button>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                
<!-- Units List -->
<div class="row">
    @php
        // Define unit types for categorization
        $unitTypes = [
            'Residential Suite' => 'Residential Suite',
            'Commercial Unit' => 'Commercial Unit',
            'Supporting and Servicing Unit' => 'Supporting and Servicing Unit',
            'Parking Lot' => 'Parking Lot',
            'Bike Lot' => 'Bike Lot',
            'Storage Lot' => 'Storage Lot',
            'Common Area' => 'Common Area'
        ];
    @endphp

    @foreach($unitTypes as $typeKey => $typeName)
        @php
            // Filter units by type and sort them by the numeric part after "UNIT"
            $unitsByType = $floor->units->where('type', $typeKey)->sortBy(function($unit) {
                $position = strpos($unit->unit_id, 'UNIT');
                if ($position !== false) {
                    return (int) substr($unit->unit_id, $position + 4);
                }
                return $unit->unit_id; // or handle the case where "UNIT" is not found
            });
        @endphp
        
        @if($unitsByType->isNotEmpty())
            <div class="col-md-12">
                <h4 class="header-title mt-0 m-b-20">{{ $typeName }}</h4>

                @foreach($unitsByType->chunk(3) as $chunk)
                    <div class="row">
                        @foreach($chunk as $unit)
                            <div class="col-md-4">
                                <div class="card-box">
                                    <h4 class="header-title mt-0 m-b-20">{{ $unit->unit_id }}</h4>
                                    <div class="panel-body">
                                        <p class="text-muted font-15"><strong>Type: </strong>{{ $unit->type }}</p>
                                        <button type="button" 
                                            onclick="window.location.href='{{ route('unit.show', $unit->id) }}'"
                                            class="btn btn-info m-t-20 btn-rounded btn-bordered waves-effect w-md waves-light btn-sm">
                                            Enter
                                        </button>
                                        <button type="button" 
                                            class="btn btn-success m-t-20 btn-rounded btn-bordered waves-effect w-md waves-light btn-sm" 
                                            onclick="window.location.href='{{ route('unit.edit', $unit->id) }}'">
                                            Edit
                                        </button>
                                       
                                        <button type="button" 
                                            class="btn btn-danger m-t-20 btn-rounded btn-bordered waves-effect w-md waves-light btn-sm"
                                            onclick="confirmDelete('{{ route('unit.delete', ['id' => $unit->id]) }}')">
                                            Delete
                                        </button>
                                        <!-- Hidden form for deletion -->
                                        <form id="delete-form" action="{{ route('unit.delete', ['id' => $unit->id]) }}" method="GET" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        @endif
    @endforeach
</div>

    </div>
</div>
<!-- end content -->
@endsection

