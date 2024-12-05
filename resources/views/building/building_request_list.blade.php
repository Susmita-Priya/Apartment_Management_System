@extends('master')

@push('title')
    <title>Building Request List</title>
@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Pending Request</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Admin</a></li>
                            <li class="breadcrumb-item active">Building Request List</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <h4 class="header-title m-b-15 m-t-0">Building Request List</h4>

                        <table class="table table-hover m-0 tickets-list table-actions-bar dt-responsive nowrap"
                            cellspacing="0" width="100%" id="datatable">
                            <thead>
                                <tr>
                                    <th>Serial No</th>
                                    <th>Name</th>
                                    <th>Building No</th>
                                    <th>Type</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp

                                @foreach ($buildings as $building)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $building->name }}</td>
                                        <td>{{ $building->building_no }}</td>
                                        <td>{{ $building->type}}</td>
                                        <td>
                                            <img src="{{ asset($building->image) }}" alt="{{ $building->name }}" style="width: 80px; height: auto;">
                                        </td>
                                        
                                        <td>
                                            @can('building-request-approve')
                                                <a href="{{ route('building.approve', $building->id) }}" class="action-icon" style="font-size: 26px; color: green;" title="Approve"> <i class="mdi mdi-check-circle"></i></a>
                                            @endcan
                                            @can('building-request-reject')
                                                <a href="{{ route('building.reject', $building->id) }}" class="action-icon" style="font-size: 26px; color: red;" title="Reject"> <i class="mdi mdi-close-circle"></i></a>
                                            @endcan
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
