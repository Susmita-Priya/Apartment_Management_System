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
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Building List</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                {{-- <div class="col-4">
                    <form action="" method="GET">
                        <div class="page-title">
                            <div class="d-flex">
                                <input type="text" class="form-control" name="search_property" value="{{ $search_property ?? '' }}"
                                    placeholder="search here...">
                                <input type="submit" class="form-control" value="Submit" placeholder="search here...">
                            </div>
                        </div>
                    </form>
                </div> --}}

                {{-- <label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="datatable"></label> --}}


                @can('building-create')
                    <div class="col-sm-12">
                    <a href="{{ route('building.create') }}" class="btn waves-effect waves-light btn-sm greenbtn"
                        style="position: absolute;">
                        <!-- Added padding here -->
                        <i class="mdi mdi-plus m-r-5"></i>Add Building
                    </a>
                </div>
                @endcan
                


                <div class="col-sm-8">
                    <div class="text-right">
                        <ul class="pagination pagination-split mt-0 pull-right">
                            <!-- Pagination Links -->
                        </ul>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <table class="table table-hover m-0 table-actions-bar dt-responsive nowrap" cellspacing="0" width="100%"
                id="datatable">
                <tbody>
                    <!-- Buildings Section -->
                    @php
                        $buildingTypes = [
                            'RESB' => 'Residential Buildings',
                            'COMB' => 'Commercial Buildings',
                            'RECB' => 'Residential-Commercial Buildings',
                        ];
                    @endphp

                    @foreach ($buildingTypes as $type => $title)
                        <div class="row">
                            <div class="col-12">
                                <h3>{{ $title }}</h3>
                            </div>
                            @foreach ($buildings->where('type', $type) as $building)
                                <div class="col-md-4">
                                    <div class="card-box">
                                        <div class="member-card-alt">
                                            <div class="thumb-xl member-thumb m-b-10 pull-left">
                                                <img src="{{ asset($building->image) }}" class="img-thumbnail"
                                                    alt="building-image">
                                            </div>
                                            <div class="member-card-alt-info">
                                                <h4 class="m-b-5 m-t-0 font-19">{{ $building->name }}</h4>
                                                <p class="text-muted">
                                                    {{ $buildingTypes[$building->type] ?? 'Other' }}
                                                    <span> | </span>
                                                    {{ $building->building_no }}
                                                </p>
                                                @can('building-view')
                                                    <button type="button"
                                                    onclick="window.location.href='{{ route('building.show', $building->id) }}'"
                                                    class="btn btn-info m-t-20 btn-rounded btn-bordered waves-effect w-md waves-light btn-sm">
                                                    Enter
                                                </button>
                                                @endcan
                                                
                                                @can('building-edit')
                                                    <button type="button"
                                                    class="btn btn-success m-t-20 btn-rounded btn-bordered waves-effect w-md waves-light btn-sm"
                                                    onclick="window.location.href='{{ route('building.edit', $building->id) }}'">
                                                    Edit
                                                </button>
                                                @endcan
                                                
                                                @can('building-delete')
                                                <button type="button"
                                                    class="btn btn-danger m-t-20 btn-rounded btn-bordered waves-effect w-md waves-light btn-sm"
                                                    onclick="confirmDelete('{{ route('building.delete', ['id' => $building->id]) }}')">
                                                    Delete
                                                </button>
                                                
                                                <!-- Hidden form for deletion -->
                                                <form id="delete-form"
                                                    action="{{ route('building.delete', ['id' => $building->id]) }}"
                                                    method="GET" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                @endcan

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                    <!-- End Buildings Section -->
                </tbody>
            </table>



        </div> <!-- container -->
    </div> <!-- content -->
@endsection
