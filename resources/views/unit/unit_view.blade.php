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
                    <h4 class="page-title float-left">{{ $unit->unit_id }}</h4>

                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="{{ url('/index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/building') }}">Buildings</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('building.show', $unit->floor->block->building_id) }}">Building</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('block.show', $unit->floor->block_id) }}">Block</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('floor.show', $unit->floor_id) }}">Floor</a></li>
                        <li class="breadcrumb-item active">Unit Details</li>
                    </ol>

                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-sm-12">
                <div class="profile-bg-picture" style="background-image:url('{{ asset('image/block.jpg') }}')">
                    <span class="picture-bg-overlay"></span><!-- overlay -->
                </div>
                <!-- meta -->
                <div class="profile-user-box">
                    <div class="row">
                        <div class="col-sm-6">
                            <span class="pull-left m-r-15"><img src="{{ asset($unit->floor->block->building->image) }}" alt="" class="thumb-lg rounded-circle"></span>
                            <div class="media-body">
                                <h4 class="m-t-7 font-18">{{ $unit->unit_id }}</h4>
                                <p class="font-15">{{ $unit->floor->block->building->name }} Building</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="text-right">
                                <button type="button" class="btn waves-effect waves-light" 
                           style="background-color: rgb(100, 197, 177); border-color: rgb(100, 197, 177); color: white; 
                                  position: absolute; right: 10px; top: 50%; transform: translateY(-50%);  text-decoration: none;"
                                        onclick="window.location.href='{{ route('unit.edit', $unit->id) }}'">
                                    <i class="mdi mdi-pencil m-r-5"></i> Edit Unit
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

                        <p class="text-muted font-15"><strong>
                            @if($unit->type === 'Residential Suite')
                                Suite ID:
                            @else
                                Unit ID:
                            @endif
                            </strong> <span class="m-l-15">{{ $unit->unit_id }}</span></p>
                        <p class="text-muted font-15"><strong>
                            @if($unit->type === 'Residential Suite')
                                Suite Type:
                            @else
                                Unit Type:
                            @endif
                            </strong> <span class="m-l-15">{{ $unit->type }}</span></p>
                        <p class="text-muted font-15"><strong>Date Added:</strong> <span class="m-l-15">{{ $unit->created_at->format('d M, Y') }}</span></p>
                        <hr>

                        <p class="text-muted font-15"><strong>Floor No:</strong> <span class="m-l-15">{{ $unit->floor->floor_no }}</span></p>
                        <p class="text-muted font-15"><strong>Floor Name:</strong> <span class="m-l-15">{{ $unit->floor->name }}</span></p>

                        <hr>

                        <p class="text-muted font-15"><strong>Block ID:</strong> <span class="m-l-15">{{ $unit->floor->block->block_id }}</span></p>
                        <p class="text-muted font-15"><strong>Block:</strong> <span class="m-l-15">{{ $unit->floor->block->name }}</span></p>
                        <hr>

                        @php
                            $typeFullForm = [
                                'RESB' => 'Residential',
                                'COMB' => 'Commercial',
                                'RECB' => 'Residential-Commercial',
                            ];
                        @endphp

                        <p class="text-muted font-15"><strong>Building:</strong> <span class="m-l-15">{{ $unit->floor->block->building->name }}</span></p>
                        <p class="text-muted font-15"><strong>Building ID:</strong> <span class="m-l-15">{{ $unit->floor->block->building->building_id }}</span></p>
                        <p class="text-muted font-15"><strong>Building Type:</strong> <span class="m-l-15">{{ $typeFullForm[$unit->floor->block->building->type] ?? 'Other' }}</span></p>
                       
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

            {{-- <div class="col-md-8">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="text-right m-b-20">
                            @if($unit->type == 'Residential Suite')

                            <div class="btn-group dropdown">
                                <a href="javascript: void(0);" class="table-action-btn dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                    
                                    <a class="dropdown-item" href="{{ route('resroom.create',['unit_id' => $unit->id]) }}" type="submit"><i class="mdi mdi-eye m-r-10 font-18 text-muted vertical-middle"></i>Add Room</a>          
                                    <a class="dropdown-item" href="{{ route('resroom.edit',['id'=> $unit->resRoom->id]) }}" type="submit"><i class="mdi mdi-pencil m-r-10 text-muted font-18 vertical-middle"></i>Edit Room</a>
                                    <a class="dropdown-item" href="{{ route('resroom.delete',['id'=> $unit->resRoom->id]) }}" type="submit"><i class="mdi mdi-delete m-r-10 text-muted font-18 vertical-middle"></i>Delete Room</a>                                  
                                </div>
                            </div>

            
            @else
                <p>This action is only available for Residential Suites.</p>
            @endif
                        </div>
                    </div>
                </div>
                <!-- end row --> --}}

                <div class="col-md-8">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="text-right m-b-20">
                                @php
                                    $isResidential = $unit->type == 'Residential Suite';
                                    $isCommercial = $unit->type == 'Commercial Unit';
                                    $isSupportingServicing = $unit->type == 'Supporting and Servicing Unit';
                                    $roomType = $isResidential ? 'resroom' : ($isCommercial ? 'comroom' : ($isSupportingServicing ? 'supporting' : null));
                                    $roomInstance = $isResidential ? $unit->resRoom : ($isCommercial ? $unit->comRoom : null);
                                @endphp
                    
                                @if($roomType)
                                    @if($isSupportingServicing)
                                        <!-- Dropdown button for adding different room types -->
                                        <div class="btn-group">
                                            <button type="button" class="btn waves-effect waves-light dropdown-toggle"
                                                style="background-color: rgb(100, 197, 177); border-color: rgb(100, 197, 177); color: white;"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Add Room <span class="caret"></span>
                                            </button>
                    
                                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                <a class="dropdown-item" href="{{ route('mechroom.create', ['unit_id' => $unit->id]) }}">
                                                    <i class="mdi mdi-plus m-r-10 text-muted font-18 vertical-middle"></i> Mechanical Room
                                                </a>
                                                <a class="dropdown-item" href="{{ route('adroom.create', ['unit_id' => $unit->id]) }}">
                                                    <i class="mdi mdi-plus m-r-10 text-muted font-18 vertical-middle"></i> Administrative Room
                                                </a>
                                                <a class="dropdown-item" href="{{ route('amroom.create', ['unit_id' => $unit->id]) }}">
                                                    <i class="mdi mdi-plus m-r-10 text-muted font-18 vertical-middle"></i> Amenity Room
                                                </a>
                                                <a class="dropdown-item" href="{{ route('serroom.create', ['unit_id' => $unit->id]) }}">
                                                    <i class="mdi mdi-plus m-r-10 text-muted font-18 vertical-middle"></i> Service Room
                                                </a>
                                            </div>
                                        </div>
                                    @else
                                        <!-- Single Add Room button for Residential and Commercial Units -->
                                        <button type="button" class="btn waves-effect waves-light"
                                            style="background-color: rgb(100, 197, 177); border-color: rgb(100, 197, 177); color: white; text-decoration: none; margin-right: 10px;"
                                            onclick="window.location.href='{{ route($roomType . '.create', ['unit_id' => $unit->id]) }}'">
                                            <i class="mdi mdi-plus m-r-5"></i> Add Room
                                        </button>
                    
                                        <!-- Dropdown button for Edit and Delete Room -->
                                        @if($roomInstance)
                                            <div class="btn-group">
                                                <button type="button" class="btn waves-effect waves-light dropdown-toggle"
                                                    style="background-color: rgb(100, 197, 177); border-color: rgb(100, 197, 177); color: white;"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Manage Room <span class="caret"></span>
                                                </button>
                                            
                                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                    <a class="dropdown-item" href="{{ route($roomType . '.edit', ['id'=> $roomInstance->id]) }}" type="submit">
                                                        <i class="mdi mdi-pencil m-r-10 text-muted font-18 vertical-middle"></i> Edit Room
                                                    </a>
                                                    <a class="dropdown-item" href="{{ route($roomType . '.delete', ['id'=> $roomInstance->id]) }}" type="submit">
                                                        <i class="mdi mdi-delete m-r-10 text-muted font-18 vertical-middle"></i> Delete Room
                                                    </a>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                    

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


                <div class="row">
                    <!-- Define the room types for Residential and Commercial Units -->
                    @php
                        $residentialRoomTypes = [
                            'bedroom' => 'Bedroom',
                            'bathroom' => 'Bathroom',
                            'balcony' => 'Balcony',
                            'dining_room' => 'Dining Room',
                            'library_room' => 'Library Room',
                            'kitchen' => 'Kitchen',
                            'storeroom' => 'Storeroom',
                            'laundry' => 'Laundry',
                            'solarium' => 'Solarium',
                            'washroom' => 'Washroom'
                        ];
                
                        $commercialRoomTypes = [
                            'bathroom' => 'Bathroom',
                            'office_room' => 'Office Room',
                            'conference_room' => 'Conference Room',
                            'dining_room' => 'Dining Room',
                            'kitchen' => 'Kitchen',
                            'laundry' => 'Laundry',
                            'solarium' => 'Solarium',
                            'storage' => 'Storage',
                            'washroom' => 'Washroom'
                        ];
                
                        $roomTypes = $unit->type == 'Residential Suite' ? $residentialRoomTypes : $commercialRoomTypes;
                        $roomData = $unit->type == 'Residential Suite' ? $unit->resRoom : $unit->comRoom;
                        $roomurl = $unit->type == 'Residential Suite' ? 'resroom' : 'comroom';
                    @endphp
                
                    @if($roomData)
                        <!-- Residential or Commercial Rooms -->
                        @foreach($roomTypes as $key => $label)
                            @if($roomData->$key)
                                <div class="col-md-4">
                                    <div class="card-box">
                                        <h4 class="header-title mt-0 m-b-20">{{ $label }}</h4>
                                        <div class="panel-body">
                                            <p class="text-muted font-15">
                                                <strong>Count:</strong> 
                                                <span class="m-l-15">{{ $roomData->$key }}</span>
                                            </p>
                                            <div class="text-right">
                                                <a href="{{ route($roomurl . '.show', ['id'=> $roomData->id]) }}" class="btn btn-primary btn-sm">Enter</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                
                        <!-- Extra Rooms Card -->
                        @if($roomData->extraRooms->isNotEmpty())
                            @foreach($roomData->extraRooms as $extraRoom)
                                <div class="col-md-4">
                                    <div class="card-box">
                                        <h4 class="header-title mt-0 m-b-20">{{ $extraRoom->room_name }}</h4>
                                        <div class="panel-body">
                                            <p class="text-muted font-15">
                                                <strong>Count:</strong> 
                                                <span class="m-l-15">{{ $extraRoom->quantity }}</span>
                                            </p>
                                            <div class="text-right">
                                                <a href="{{ route($roomurl . '.show', ['id'=> $extraRoom->id]) }}" class="btn btn-primary btn-sm">Enter</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        {{-- @else
                            <div class="alert alert-info">No extra rooms found.</div> --}}
                        @endif
                    @endif
                
                    <div class="row">
                        <!-- Supporting and Servicing Unit Rooms -->
                        @if($unit->type == 'Supporting and Servicing Unit')
                            <!-- Mechanical Rooms -->
                            @if($unit->mechRoom)
                                <div class="col-md-12">
                                    <div class="card-box">
                                        <div class="text-right">
                                            <h3 class="header-title text-left mt-0 ">Mechanical Rooms</h3>
                                            <a href="{{ route('mechroom.edit', ['id'=> $unit->mechRoom->id]) }}" 
                                               class="btn btn-sm m-b-20" 
                                               style="background-color: rgb(100, 197, 177); border-color: rgb(100, 197, 177); color: white; text-decoration: none; margin-right: 10px; margin-bottom: 20px;">
                                               Edit Mechanical Rooms
                                            </a>
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                @foreach($unit->mechRoom->getAttributes() as $key => $value)
                                                    @if($value && $key != 'id' && $key != 'unit_id' && $key != 'created_at' && $key != 'updated_at')
                                                        <div class="col-md-4">
                                                            <div class="card-box">
                                                                <h4 class="header-title mt-0 m-b-20">{{ ucfirst(str_replace('_', ' ', $key)) }}</h4>
                                                                <div class="panel-body">
                                                                    <p class="text-muted font-15">
                                                                        <strong>Count:</strong> 
                                                                        <span class="m-l-15">{{ $value }}</span>
                                                                    </p>
                                                                    <div class="text-right">
                                                                        <a href="{{ route('mechroom.show', ['id'=> $unit->mechRoom->id]) }}" class="btn btn-primary btn-sm">Enter</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                            <!-- Extra Mechanical Rooms -->
                                            @if($unit->mechRoom->extraRooms->isNotEmpty())
                                                <div class="row">
                                                    @foreach($unit->mechRoom->extraRooms as $extraRoom)
                                                        <div class="col-md-4">
                                                            <div class="card-box">
                                                                <h4 class="header-title mt-0 m-b-20">{{ $extraRoom->room_name }}</h4>
                                                                <div class="panel-body">
                                                                    <p class="text-muted font-15">
                                                                        <strong>Count:</strong> 
                                                                        <span class="m-l-15">{{ $extraRoom->quantity }}</span>
                                                                    </p>
                                                                    <a href="{{ route('mechroom.show', ['id'=> $unit->mechRoom->id]) }}" class="btn btn-primary btn-sm">Enter</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                    
                            <!-- Administrative Rooms -->
                            @if($unit->adminRoom)
                                <div class="col-md-12">
                                    <div class="card-box">
                                        <div class="text-right">
                                            <h4 class="header-title text-left mt-0 m-b-20">Administrative Rooms</h4>
                                            <a href="{{ route('adroom.edit', ['id'=> $unit->adminRoom->id]) }}" 
                                               class="btn btn-sm" 
                                               style="background-color: rgb(100, 197, 177); border-color: rgb(100, 197, 177); color: white; text-decoration: none; margin-right: 10px; margin-bottom: 20px;">
                                               Edit Administrative Rooms
                                            </a>
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                @foreach($unit->adminRoom->getAttributes() as $key => $value)
                                                    @if($value && $key != 'id' && $key != 'unit_id' && $key != 'created_at' && $key != 'updated_at')
                                                        <div class="col-md-4">
                                                            <div class="card-box">
                                                                <h4 class="header-title mt-0 m-b-20">{{ ucfirst(str_replace('_', ' ', $key)) }}</h4>
                                                                <div class="panel-body">
                                                                    <p class="text-muted font-15">
                                                                        <strong>Count:</strong> 
                                                                        <span class="m-l-15">{{ $value }}</span>
                                                                    </p>
                                                                    <a href="{{ route('adroom.show', ['id'=> $unit->mechRoom->id]) }}" class="btn btn-primary btn-sm">Enter</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                            <!-- Extra Administrative Rooms -->
                                            @if($unit->adminRoom->extraRooms->isNotEmpty())
                                                <div class="row">
                                                    @foreach($unit->adminRoom->extraRooms as $extraRoom)
                                                        <div class="col-md-4">
                                                            <div class="card-box">
                                                                <h4 class="header-title mt-0 m-b-20">{{ $extraRoom->room_name }}</h4>
                                                                <div class="panel-body">
                                                                    <p class="text-muted font-15">
                                                                        <strong>Count:</strong> 
                                                                        <span class="m-l-15">{{ $extraRoom->quantity }}</span>
                                                                    </p>
                                                                    <a href="{{ route('adroom.show', ['id'=> $unit->mechRoom->id]) }}" class="btn btn-primary btn-sm">Enter</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                    
                            <!-- Amenity Rooms -->
                            @if($unit->amRoom)
                                <div class="col-md-12">
                                    <div class="card-box">
                                        <div class="text-right">
                                            <h4 class="header-title text-left mt-0 m-b-20">Amenity Rooms</h4>
                                            <a href="{{ route('amroom.edit', ['id'=> $unit->amRoom->id]) }}" 
                                               class="btn btn-sm" 
                                               style="background-color: rgb(100, 197, 177); border-color: rgb(100, 197, 177); color: white; text-decoration: none; margin-right: 10px; margin-bottom: 20px;">
                                               Edit Amenity Rooms
                                            </a>
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                @foreach($unit->amRoom->getAttributes() as $key => $value)
                                                    @if($value && $key != 'id' && $key != 'unit_id' && $key != 'created_at' && $key != 'updated_at')
                                                        <div class="col-md-4">
                                                            <div class="card-box">
                                                                <h4 class="header-title mt-0 m-b-20">{{ ucfirst(str_replace('_', ' ', $key)) }}</h4>
                                                                <div class="panel-body">
                                                                    <p class="text-muted font-15">
                                                                        <strong>Count:</strong> 
                                                                        <span class="m-l-15">{{ $value }}</span>
                                                                    </p>
                                                                    <a href="{{ route('amroom.show', ['id'=> $unit->mechRoom->id]) }}" class="btn btn-primary btn-sm">Enter</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                            <!-- Extra Amenity Rooms -->
                                            @if($unit->amRoom->extraRooms->isNotEmpty())
                                                <div class="row">
                                                    @foreach($unit->amRoom->extraRooms as $extraRoom)
                                                        <div class="col-md-4">
                                                            <div class="card-box">
                                                                <h4 class="header-title mt-0 m-b-20">{{ $extraRoom->room_name }}</h4>
                                                                <div class="panel-body">
                                                                    <p class="text-muted font-15">
                                                                        <strong>Count:</strong> 
                                                                        <span class="m-l-15">{{ $extraRoom->quantity }}</span>
                                                                    </p>
                                                                    <a href="{{ route('amroom.show', ['id'=> $unit->mechRoom->id]) }}" class="btn btn-primary btn-sm">Enter</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                    
                            <!-- Service Rooms -->
                            @if($unit->serRoom)
                                <div class="col-md-12">
                                    <div class="card-box">
                                        <div class="text-right">
                                            <h4 class="header-title text-left mt-0 m-b-20">Service Rooms</h4>
                                            <a href="{{ route('serroom.edit', ['id'=> $unit->serRoom->id]) }}" 
                                               class="btn btn-sm" 
                                               style="background-color: rgb(100, 197, 177); border-color: rgb(100, 197, 177); color: white; text-decoration: none; margin-right: 10px; margin-bottom: 20px;">
                                               Edit Service Rooms
                                            </a>
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                @foreach($unit->serRoom->getAttributes() as $key => $value)
                                                    @if($value && $key != 'id' && $key != 'unit_id' && $key != 'created_at' && $key != 'updated_at')
                                                        <div class="col-md-4">
                                                            <div class="card-box">
                                                                <h4 class="header-title mt-0 m-b-20">{{ ucfirst(str_replace('_', ' ', $key)) }}</h4>
                                                                <div class="panel-body">
                                                                    <p class="text-muted font-15">
                                                                        <strong>Count:</strong> 
                                                                        <span class="m-l-15">{{ $value }}</span>
                                                                    </p>
                                                                    <a href="{{ route('serroom.show', ['id'=> $unit->mechRoom->id]) }}" class="btn btn-primary btn-sm">Enter</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                            <!-- Extra Service Rooms -->
                                            @if($unit->serRoom->extraRooms->isNotEmpty())
                                                <div class="row">
                                                    @foreach($unit->serRoom->extraRooms as $extraRoom)
                                                        <div class="col-md-4">
                                                            <div class="card-box">
                                                                <h4 class="header-title mt-0 m-b-20">{{ $extraRoom->room_name }}</h4>
                                                                <div class="panel-body">
                                                                    <p class="text-muted font-15">
                                                                        <strong>Count:</strong> 
                                                                        <span class="m-l-15">{{ $extraRoom->quantity }}</span>
                                                                    </p>
                                                                    <a href="{{ route('serroom.show', ['id'=> $unit->mechRoom->id]) }}" class="btn btn-primary btn-sm">Enter</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endif
                    </div>
                    
                    
                </div>

    </div> <!-- container -->
</div> <!-- content -->
@endsection

