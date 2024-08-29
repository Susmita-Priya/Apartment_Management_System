@extends('master')

@section('content')
@push('title')
    <title>Building List</title>
@endpush

    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Buildings</h4>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ url('/index') }}">Admin</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/building') }}">Buildings</a></li>
                            <li class="breadcrumb-item active">Building List</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-sm-12">
                    <a href="{{ route('building.create') }}" class="btn waves-effect waves-light btn-sm" 
                       style="background-color: rgb(100, 197, 177); border-color: rgb(100, 197, 177); color: white; 
                              position: absolute; right: 20px; top: 50%; transform: translateY(-50%); 
                              text-decoration: none; padding: 10px 20px;"> <!-- Added padding here -->
                        <i class="md md-add"></i> Add Building
                    </a>
                </div>
                <div class="col-sm-8">
                    <div class="text-right">
                        <ul class="pagination pagination-split mt-0 pull-right">
                            <!-- Pagination Links -->
                        </ul>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <!-- Section for Residential Buildings -->
            <div class="row">
                <div class="col-12">
                    <h3>Residential Buildings</h3>
                </div>
                @foreach($buildings->where('type', 'RESB') as $building)
                <div class="col-md-4">
                    <div class="card-box">
                        <div class="member-card-alt">
                            <div class="thumb-xl member-thumb m-b-10 pull-left">
                                <img src="{{ asset($building->image) }}" class="img-thumbnail" alt="building-image">
                            </div>
                            <div class="member-card-alt-info">
                                <h4 class="m-b-5 m-t-0 font-19">{{ $building->name }}</h4>
                                @php
                                $typeFullForm = [
                                    'RESB' => 'Residential',
                                    'COMB' => 'Commercial',
                                    'RECB' => 'Residential-Commercial',
                                ];
                                @endphp
                                <p class="text-muted">
                                    {{ $typeFullForm[$building->type] ?? 'Other' }} 
                                    <span> | </span> 
                                    {{ $building->building_id }}
                                </p>
                                <button type="button" 
                                    onclick="window.location.href='{{ route('building.show', $building->id) }}'"
                                    class="btn btn-info m-t-20 btn-rounded btn-bordered waves-effect w-md waves-light btn-sm">
                                    Enter
                                </button>
                                <button type="button" 
                                    class="btn btn-success m-t-20 btn-rounded btn-bordered waves-effect w-md waves-light btn-sm" 
                                    onclick="window.location.href='{{ route('building.edit', $building->id) }}'">
                                    Edit
                                </button>
                                <a type="button" 
                                   href="{{ route('building.delete', ['id' => $building->id]) }}"
                                   class="btn btn-danger m-t-20 btn-rounded btn-bordered waves-effect w-md waves-light btn-sm">
                                    Delete
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <!-- end section for Residential Buildings -->

            <!-- Section for Commercial Buildings -->
            <div class="row">
                <div class="col-12">
                    <h3>Commercial Buildings</h3>
                </div>
                @foreach($buildings->where('type', 'COMB') as $building)
                <div class="col-md-4">
                    <div class="card-box">
                        <div class="member-card-alt">
                            <div class="thumb-xl member-thumb m-b-10 pull-left">
                                <img src="{{ asset($building->image) }}" class="img-thumbnail" alt="building-image">
                            </div>
                            <div class="member-card-alt-info">
                                <h4 class="m-b-5 m-t-0 font-19">{{ $building->name }}</h4>
                                @php
                                $typeFullForm = [
                                    'RESB' => 'Residential',
                                    'COMB' => 'Commercial',
                                    'RECB' => 'Residential-Commercial',
                                ];
                                @endphp
                                <p class="text-muted">
                                    {{ $typeFullForm[$building->type] ?? 'Other' }} 
                                    <span> | </span> 
                                    {{ $building->building_id }}
                                </p>
                                <button type="button" 
                                    onclick="window.location.href='{{ route('building.show', $building->id) }}'"
                                    class="btn btn-info m-t-20 btn-rounded btn-bordered waves-effect w-md waves-light btn-sm">
                                    Enter
                                </button>
                                <button type="button" 
                                    class="btn btn-success m-t-20 btn-rounded btn-bordered waves-effect w-md waves-light btn-sm" 
                                    onclick="window.location.href='{{ route('building.edit', $building->id) }}'">
                                    Edit
                                </button>
                                <a type="button" 
                                   href="{{ route('building.delete', ['id' => $building->id]) }}"
                                   class="btn btn-danger m-t-20 btn-rounded btn-bordered waves-effect w-md waves-light btn-sm">
                                    Delete
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <!-- end section for Commercial Buildings -->

            <!-- Section for Residential-Commercial Buildings -->
            <div class="row">
                <div class="col-12">
                    <h3>Residential-Commercial Buildings</h3>
                </div>
                @foreach($buildings->where('type', 'RECB') as $building)
                <div class="col-md-4">
                    <div class="card-box">
                        <div class="member-card-alt">
                            <div class="thumb-xl member-thumb m-b-10 pull-left">
                                <img src="{{ asset($building->image) }}" class="img-thumbnail" alt="building-image">
                            </div>
                            <div class="member-card-alt-info">
                                <h4 class="m-b-5 m-t-0 font-19">{{ $building->name }}</h4>
                                @php
                                $typeFullForm = [
                                    'RESB' => 'Residential',
                                    'COMB' => 'Commercial',
                                    'RECB' => 'Residential-Commercial',
                                ];
                                @endphp
                                <p class="text-muted">
                                    {{ $typeFullForm[$building->type] ?? 'Other' }} 
                                    <span> | </span> 
                                    {{ $building->building_id }}
                                </p>
                                <button type="button" 
                                    onclick="window.location.href='{{ route('building.show', $building->id) }}'"
                                    class="btn btn-info m-t-20 btn-rounded btn-bordered waves-effect w-md waves-light btn-sm">
                                    Enter
                                </button>
                                <button type="button" 
                                    class="btn btn-success m-t-20 btn-rounded btn-bordered waves-effect w-md waves-light btn-sm" 
                                    onclick="window.location.href='{{ route('building.edit', $building->id) }}'">
                                    Edit
                                </button>
                                <a type="button" 
                                   href="{{ route('building.delete', ['id' => $building->id]) }}"
                                   class="btn btn-danger m-t-20 btn-rounded btn-bordered waves-effect w-md waves-light btn-sm">
                                   Delete
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <!-- end section for Residential-Commercial Buildings -->

        </div> <!-- container -->
    </div> <!-- content -->
@endsection
