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
                        <li class="breadcrumb-item"><a href="{{ url('/index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/building') }}">Buildings</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('building.show', $block->building_id) }}">Building</a></li>
                        <li class="breadcrumb-item active">Block Details</li>
                    </ol>

                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-sm-12">
                <div class="profile-bg-picture" style="background-image:url('{{ asset('image/block_bg.jpg') }}')">
                    <span class="picture-bg-overlay"></span><!-- overlay -->
                </div>
                <!-- meta -->
                <div class="profile-user-box">
                    <div class="row">
                        <div class="col-sm-6">
                            <span class="pull-left m-r-15"><img src="{{ asset($block->building->image) }}" alt="" class="thumb-lg rounded-circle"></span>
                            <div class="media-body">
                                <h4 class="m-t-7 font-18">{{ $block->name }}</h4>
                                <p class="font-13">{{ $block->building->name }} Building</p>
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
                        <p class="text-muted font-13"><strong>Block ID:</strong> <span class="m-l-15">{{ $block->block_id }}</span></p>

                        <p class="text-muted font-13"><strong>Block Name:</strong> <span class="m-l-15">{{ $block->name }}</span></p>
                        
                        @php
                            $typeFullForm = [
                                'RESB' => 'Residential',
                                'COMB' => 'Commercial',
                                'RECB' => 'Residential-Commercial',
                            ];
                        @endphp

                        <p class="text-muted font-13"><strong>Building:</strong> <span class="m-l-15">{{ $block->building->name }} </span></p>
                        
                        <p class="text-muted font-13"><strong>Building Type:</strong> <span class="m-l-15">{{ $typeFullForm[$block->building->type] ?? 'Other' }}</span></p>
                        
                        {{-- <p class="text-muted font-13"><strong>Number of Floors:</strong> <span class="m-l-15">{{ $block->floors }}</span></p> --}}

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
                                    {{-- onclick="window.location.href='{{ route('block.create', ['building_id' => $building->id]) }}'" --}}
                                    >
                                <i class="mdi mdi-plus m-r-5"></i> Add Floor
                            </button>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <!-- Blocks List -->
                {{-- <div class="row">
                    @foreach($building->blocks as $block)
                        <div class="col-md-4">
                            <div class="card-box">
                                <h4 class="header-title mt-0 m-b-20">{{ $block->name }}</h4>
                                <p class="text-muted font-13"><strong>Block ID: </strong>{{ $block->block_id }}</p>

                                <button type="button" 
                                    onclick="window.location.href='{{ route('block.show', $block->id) }}'"
                                    class="btn btn-info m-t-20 btn-rounded btn-bordered waves-effect w-md waves-light btn-sm">
                                    Enter
                                </button>
                                <button type="button" 
                                    class="btn btn-success m-t-20 btn-rounded btn-bordered waves-effect w-md waves-light btn-sm" 
                                    onclick="window.location.href='{{ route('block.edit', $block->id) }}'">
                                    Edit
                                </button>
                                <a type="button" 
                                   href="{{ route('block.delete', ['id' => $block->id]) }}"
                                   class="btn btn-danger m-t-20 btn-rounded btn-bordered waves-effect w-md waves-light btn-sm">
                                    Delete
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div> --}}
                <!-- end Blocks List -->

            </div>
            <!-- end col -->
        </div>
        <!-- end row -->

    </div> <!-- container -->

</div> <!-- content -->
@endsection
