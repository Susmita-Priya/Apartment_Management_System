@extends('master')

@push('title')
    <title>Amenities List</title>
@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Amenities</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Admin</a></li>
                            <li class="breadcrumb-item active">Amenities list</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <h4 class="header-title m-b-15 m-t-0">Amenities List</h4>
                        <div class="row">
                            @can('amenities-create')
                                
                                <div class="col-sm-12">
                                <div class="text-right m-b-20">
                                    <button type="button" class="btn waves-effect waves-light greenbtn"
                                        onclick="window.location.href='{{ route('amenities.create') }}'">
                                        <i class="mdi mdi-plus m-r-5"></i> Add Amenity
                                    </button>
                                </div>
                            </div>
                            @endcan
                            
                        </div>

                        <table class="table table-hover m-0 tickets-list table-actions-bar dt-responsive nowrap"
                            cellspacing="0" width="100%" id="datatable">
                            <thead>
                                <tr>
                                    <th>Serial No</th>
                                    <th>Amenity Name</th>
                                    <th>Amenity Image</th>
                                    <th>Amenity Description</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp

                                @foreach ($amenities as $amenity)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $amenity->name }}</td>
                                        <td>
                                            <img src="{{ asset($amenity->image) }}" alt="{{ $amenity->name }}" style="width: 80px; height: auto;">
                                        </td>
                                        <td>{{ $amenity->description ? $amenity->description : 'No Description' }}</td>

                                        <td>
                                            @if ($amenity->status == 1)
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-danger">Inactive</span>
                                            @endif                                      
                                        </td> <!-- Display status -->
                                        <td>
                                            <div class="btn-group dropdown">
                                                <a href="javascript: void(0);" class="table-action-btn dropdown-toggle"
                                                    data-toggle="dropdown" aria-expanded="false"><i
                                                        class="mdi mdi-dots-horizontal"></i></a>
                                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                    @can('amenities-edit')
                                                        <a class="dropdown-item"
                                                        href="{{ route('amenities.edit', ['id' => $amenity->id]) }}"
                                                        type="submit"><i
                                                            class="mdi mdi-pencil m-r-10 text-muted font-18 vertical-middle"></i>Edit
                                                        Amenity</a>
                                                    @endcan
                                                    @can('amenities-delete')
                                                        <a class="dropdown-item" href="#"
                                                        onclick="confirmDelete('{{ route('amenities.delete', ['id' => $amenity->id]) }}')"><i
                                                            class="mdi mdi-delete m-r-10 text-muted font-18 vertical-middle"></i>
                                                        Delete Amenity
                                                    </a>
                                                    <!-- Hidden form for deletion -->
                                                    <form id="delete-form"
                                                        action="{{ route('amenities.delete', ['id' => $amenity->id]) }}"
                                                        method="GET" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                    @endcan
                                                    
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div><!-- end col -->
            </div>
            <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->
@endsection
