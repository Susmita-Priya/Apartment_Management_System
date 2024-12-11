@extends('master')

@section('content')
    @push('title')
        <title>Building Details</title>
    @endpush

    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">{{ $building->name }} Building</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('building') }}">Buildings</a></li>
                            <li class="breadcrumb-item active">Building Details</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-sm-12">
                    <div class="profile-bg-picture" style="background-image:url('{{ asset('image/bg-building.webp') }}')">
                        <span class="picture-bg-overlay"></span><!-- overlay -->
                    </div>
                    <!-- meta -->
                    <div class="profile-user-box">
                        <div class="row">
                            <div class="col-sm-6">
                                <span class="pull-left m-r-15"><img src="{{ asset($building->image) }}" alt=""
                                        class="thumb-lg rounded-circle"></span>
                                <div class="media-body">
                                    <h4 class="m-t-7 font-18">{{ $building->name }} Building</h4>
                                    <p class="text-muted font-15">Dhaka, Bangladesh</p>
                                    {{-- <p class="text-muted m-b-0"><small>{{ $building->city }}, {{ $building->country }}</small></p> --}}
                                </div>
                            </div>
                            @can('building-edit')
                                <div class="col-sm-6">
                                <div class="text-right">
                                    <button type="button" class="btn waves-effect waves-light greenbtn"
                                        style="position: absolute;"
                                        onclick="window.location.href='{{ route('building.edit', $building->id) }}'">
                                        <i class="mdi mdi-pencil m-r-5"></i> Edit Building
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
                    <!-- Building-Information -->
                    <div class="card-box">
                        <h4 class="header-title mt-0 m-b-20 font-16">Building Information</h4>
                        <div class="panel-body">
                            {{-- <p class="text-muted font-13"><strong>Type:</strong> <span class="m-l-15"> --}}
                            @php
                                $typeFullForm = [
                                    'RESB' => 'Residential',
                                    'COMB' => 'Commercial',
                                    'RECB' => 'Residential-Commercial',
                                ];
                            @endphp
                            <p class="text-muted font-15"> <strong>Type:</strong> <span class="m-l-15">
                                    {{ $typeFullForm[$building->type] ?? 'Other' }} </span>
                            </p>


                            <p class="text-muted font-15"><strong>Building No:</strong> <span
                                    class="m-l-15">{{ $building->building_no }}</span></p>

                            <p class="text-muted font-15"><strong>Building Name:</strong> <span
                                    class="m-l-15">{{ $building->name }}</span></p>

                            <p class="text-muted font-15"><strong>Total Upper Floor:</strong> <span
                                    class="m-l-15">{{ $building->total_upper_floors }}</span></p>

                            <p class="text-muted font-15"><strong>Total Underground Floor:</strong> <span
                                    class="m-l-15">{{ $building->total_underground_floors }}</span></p>

                            <p class="text-muted font-15"><strong>Date Added:</strong> <span
                                    class="m-l-15">{{ $building->created_at->format('d M, Y') }}</span></p>

                            <hr>

                            {{-- display common area --}}

                            @php
                                $buildingCommonAreas = json_decode($building->common_area, true) ?? [];
                            @endphp

                            <p class="text-muted
                                font-15"><strong>Common Areas:</strong></p>
                            @foreach ($commonAreas as $commonArea)
                                @if (in_array($commonArea->id, $buildingCommonAreas))
                                <li class="text-muted font-15">  {{ $commonArea->name }} </li>
                                @endif
                            @endforeach
                        
                        </div>
                    </div>
                    <!-- Building-Information -->
                </div>

                <div class="col-md-8">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="text-right">
                                <div class="btn-group">

                                    @can('floor-create')
                                    <button type="button" class="btn waves-effect waves-light greenbtn"
                                    style="position: absolute; "
                                    onclick="window.location.href='{{ route('floor.create', ['building_id' => $building->id]) }}'">
                                    <i class="mdi mdi-plus m-r-5"></i> Add Floor
                                </button>                                        
                                    @endcan
                                    {{-- <button type="button" class="btn waves-effect waves-light dropdown-toggle greenbtn"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Add <span class="caret"></span>
                                    </button>

                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                        @can('floor-create')
                                        <a class="dropdown-item"
                                            href="{{ route('floor.create', ['building_id' => $building->id]) }}">
                                            <i class="mdi mdi-plus m-r-10 text-muted font-18 vertical-middle"></i> Add Floor
                                        </a>
                                        @endcan
                                        @can('common-area-create')
                                        <a class="dropdown-item"
                                            href="{{ route('commonArea.create', ['building_id' => $building->id]) }}">
                                            <i class="mdi mdi-plus m-r-10 text-muted font-18 vertical-middle"></i> Add
                                            Common Area
                                        </a>
                                        @endcan
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                    <!-- Floors List -->
                    <div class="row">
                        <div class="col-12">
                            <h4 class="header-title mt-0 m-b-20">Upper Floors</h4>
                        </div>
                        @foreach ($floors as $floor)
                            @if($floor->type == 'upper')
                            @php
                                $suffix =
                                    $floor->floor_no == 1? 'st': ($floor->floor_no == 2? 'nd': ($floor->floor_no == 3? 'rd': 'th'));
                            @endphp
                                <div class="col-md-4 mb-4">
                                    <div class="card-box">
                                        <h4 class="header-title mt-0 m-b-20">{{ $floor->floor_no }}<sup>{{ $suffix }}</sup> floor</h4>
                                        <p class="text-muted font-15"><strong>Name:
                                            </strong>{{ $floor->name }}</p>
                                            @can('floor-view')
                                        <button type="button"
                                            onclick="window.location.href='{{ route('floor.show', $floor->id) }}'"
                                            class="btn btn-info m-t-20 btn-rounded btn-bordered waves-effect w-md waves-light btn-sm">
                                            Enter
                                        </button>
                                        @endcan
                                        @can('floor-edit')
                                        <button type="button"
                                            class="btn btn-success m-t-20 btn-rounded btn-bordered waves-effect w-md waves-light btn-sm"
                                            onclick="window.location.href='{{ route('floor.edit', $floor->id) }}'">
                                            Edit
                                        </button>
                                        @endcan
                                        @can('floor-delete')
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
                                        @endcan
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <h4 class="header-title mt-0 m-b-20">Underground Floors</h4>
                        </div>
                        @foreach ($floors as $floor)
                            @if($floor->type == 'underground')
                            @php
                                $suffix =
                                    $floor->floor_no == 1? 'st': ($floor->floor_no == 2? 'nd': ($floor->floor_no == 3? 'rd': 'th'));
                            @endphp
                                <div class="col-md-4 mb-4">
                                    <div class="card-box">
                                        <h4 class="header-title mt-0 m-b-20">{{ $floor->floor_no }}<sup>{{ $suffix }}</sup> floor</h4>
                                        <p class="text-muted font-15"><strong>Name:
                                            </strong>{{ $floor->name }}</p>
                                            @can('floor-view')
                                                <button type="button"
                                            onclick="window.location.href='{{ route('floor.show', $floor->id) }}'"
                                            class="btn btn-info m-t-20 btn-rounded btn-bordered waves-effect w-md waves-light btn-sm">
                                            Enter
                                        </button>
                                            @endcan
                                        
                                        @can('floor-edit')
                                        <button type="button"
                                            class="btn btn-success m-t-20 btn-rounded btn-bordered waves-effect w-md waves-light btn-sm"
                                            onclick="window.location.href='{{ route('floor.edit', $floor->id) }}'">
                                            Edit
                                        </button>
                                        @endcan
                                        @can('floor-delete')
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
                                        @endcan
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <!-- End Floors List -->

                </div>
                <!-- end col -->
            </div>
            <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->
@endsection
