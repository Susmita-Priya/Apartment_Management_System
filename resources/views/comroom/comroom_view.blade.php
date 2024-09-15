@extends('master')

@section('content')
    @push('title')
        <title>Commercial Room Details</title>
    @endpush

    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">

            <!-- Breadcrumb and Header -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">{{ ucfirst(str_replace('_', ' ', $room_type)) }}</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('building') }}">Buildings</a></li>
                            <li class="breadcrumb-item"><a
                                    href="{{ route('building.show', $comroom->unit->floor->block->building_id) }}">Building</a>
                            </li>
                            <li class="breadcrumb-item"><a
                                    href="{{ route('block.show', $comroom->unit->floor->block_id) }}">Block</a></li>
                            <li class="breadcrumb-item"><a
                                    href="{{ route('floor.show', $comroom->unit->floor_id) }}">Floor</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('unit.show', $comroom->unit_id) }}">Unit</a></li>
                            <li class="breadcrumb-item active">Room Details</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-sm-12">
                    <div class="profile-bg-picture" style="background-image:url('{{ asset('image/unit.webp') }}')">
                        <span class="picture-bg-overlay"></span><!-- overlay -->
                    </div>
                    <!-- meta -->
                    <div class="profile-user-box">
                        <div class="row">
                            <div class="col-sm-6">
                                <span class="pull-left m-r-15"><img
                                        src="{{ asset($comroom->unit->floor->block->building->image) }}" alt=""
                                        class="thumb-lg rounded-circle"></span>
                                <div class="media-body">
                                    <h4 class="m-t-7 font-18">{{ ucfirst(str_replace('_', ' ', $room_type)) }}</h4>
                                    <p class="text-muted font-15">{{ $comroom->unit->floor->block->building->name }}
                                        Building</p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="text-right">
                                    <button type="button" class="btn waves-effect waves-light greenbtn"
                                        style="background-color: rgb(100, 197, 177); border-color: rgb(100, 197, 177); color: white; 
                                  position: absolute; right: 10px; top: 50%; transform: translateY(-50%);  text-decoration: none;"
                                        onclick="window.location.href='{{ route('comroom.edit', $comroom->id) }}'">
                                        <i class="mdi mdi-pencil m-r-5"></i> Edit Room
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
                        <h4 class="header-title mt-0 m-b-20">Room Information</h4>
                        <div class="panel-body">

                            <p class="text-muted font-15"><strong> Room:
                                </strong> <span class="m-l-15">{{ $room_type }}</span></p>

                            <p class="text-muted font-15"><strong> Count:
                                </strong> <span class="m-l-15">{{ $roomTypeDetails }}</span></p>

                            <hr>

                            <p class="text-muted font-15"><strong>
                                    @if ($comroom->unit->type === 'Residential Suite')
                                        Suite ID:
                                    @else
                                        Unit ID:
                                    @endif
                                </strong> <span class="m-l-15">{{ $comroom->unit->unit_no }}</span></p>
                            <p class="text-muted font-15"><strong>
                                    @if ($comroom->unit->type === 'Residential Suite')
                                        Suite Type:
                                    @else
                                        Unit Type:
                                    @endif
                                </strong> <span class="m-l-15">{{ $comroom->unit->type }}</span></p>
                            <p class="text-muted font-15"><strong>Date Added:</strong> <span
                                    class="m-l-15">{{ $comroom->unit->created_at->format('d M, Y') }}</span></p>
                            <hr>

                            <p class="text-muted font-15"><strong>Floor No:</strong> <span
                                    class="m-l-15">{{ $comroom->unit->floor->floor_no }}</span></p>
                            <p class="text-muted font-15"><strong>Floor Name:</strong> <span
                                    class="m-l-15">{{ $comroom->unit->floor->name }}</span></p>

                            <hr>

                            <p class="text-muted font-15"><strong>Block ID:</strong> <span
                                    class="m-l-15">{{ $comroom->unit->floor->block->block_id }}</span></p>
                            <p class="text-muted font-15"><strong>Block:</strong> <span
                                    class="m-l-15">{{ $comroom->unit->floor->block->name }}</span></p>
                            <hr>

                            @php
                                $typeFullForm = [
                                    'RESB' => 'Residential',
                                    'COMB' => 'Commercial',
                                    'RECB' => 'Residential-Commercial',
                                ];
                            @endphp

                            <p class="text-muted font-15"><strong>Building:</strong> <span
                                    class="m-l-15">{{ $comroom->unit->floor->block->building->name }}</span></p>
                            <p class="text-muted font-15"><strong>Building ID:</strong> <span
                                    class="m-l-15">{{ $comroom->unit->floor->block->building->building_id }}</span></p>
                            <p class="text-muted font-15"><strong>Building Type:</strong> <span
                                    class="m-l-15">{{ $typeFullForm[$comroom->unit->floor->block->building->type] ?? 'Other' }}</span>
                            </p>

                        </div>
                    </div>
                    <!-- Block-Information -->
                </div>

                <div class="col-md-8">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="text-right m-b-20">
                                <button type="button" class="btn waves-effect waves-light greenbtn"
                                    onclick="submitAssetForm()">
                                    <i class="mdi mdi-plus m-r-5"></i> Add Asset
                                </button>

                                <!-- Hidden form -->
                                <form id="asset-form" action="{{ route('asset.create') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $comroom->id }}">
                                    <input type="hidden" name="room_type" value="{{ $room_type }}">    <!-- bedroom,bathroom -->
                                    <input type="hidden" name="count" value="{{ $roomTypeDetails }}">
                                    <input type="hidden" name="room" value="comroom">
                                </form>

                                <script>
                                    function submitAssetForm() {
                                        document.getElementById('asset-form').submit();
                                    }
                                </script>

                            </div>
                        </div>
                    </div>

                <div class="row">
                    <div class="col-md-12">
                    @for ($i = 1; $i <= $roomTypeDetails; $i++)
                        @php
                            // Generate a unique ID for each room card
                            $roomId = $room_type . $i;
                            $assetId = $comroom->assets
                                        ? $comroom->assets->where('room_no', $roomId)->first()->id ?? null
                                        : null;

                        @endphp

                        @if ($i % 3 == 1)
                            <div class="row">
                        @endif
                        <div class="col-md-4">
                            <div class="card-box room-card" data-toggle="modal" data-target="#assetModal"
                                data-roomid="{{ $roomId }}" data-roomtype="{{ $room_type }}"
                                data-assetid="{{ $assetId }}">
                                <h4 class="header-title mt-0 m-b-20">{{ ucfirst(str_replace('_', ' ', $room_type)) }} {{ $i }}
                                </h4>
                                <div class="panel-body">
                                    <p class="text-muted font-15"><strong>ID:</strong><span
                                            class="m-l-15">{{ $roomId }}</span></p>
                                </div>
                            </div>
                        </div>
                        @if ($i % 3 == 0 || $i == $roomTypeDetails)
                </div> <!-- End row -->
                @endif
                @endfor
            </div>
        </div>
        
        <!-- Modal for viewing assets -->
        <div class="modal fade" id="assetModal" tabindex="-1" role="dialog" aria-labelledby="assetModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="assetModalLabel">Room Assets</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="assetContent">
                            <!-- Asset content will be dynamically loaded here -->
                        </div>
                    </div>
                    <div class ="modal-footer">
                        <a id="edit-button" href="#" class="btn btn-primary">
                            Edit Asset
                        </a>

                        <!-- Delete button -->
                        <button type="button" class="btn btn-danger" id="delete-button">
                            Delete Asset
                        </button>

                    </div>

                </div>
            </div>
        </div>
        <!-- Hidden Delete Form -->
        <form id="delete-form" method="GET" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
            </div>
    </div>
@endsection


