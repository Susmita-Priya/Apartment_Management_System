@extends('master')

@push('title')
    <title>Tenant Agreement Reject List</title>
@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Tenants</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Tenant Agreement Reject List</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <h4 class="header-title m-b-15 m-t-0">Tenant Agreement Reject List</h4>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="text-right m-b-20">
                                    {{-- @can('tenant-agreement-create')
                                        <button type="button" class="btn waves-effect waves-light greenbtn"
                                            onclick="window.location.href='{{ route('tenant.agreement.create') }}'">
                                            <i class="mdi mdi-plus m-r-5"></i> Create Tenant Agreement
                                        </button>
                                    @endcan --}}

                                </div>
                            </div>
                        </div>

                        <table class="table table-hover m-0 tickets-list table-actions-bar dt-responsive nowrap"
                            cellspacing="0" width="100%" id="datatable">
                            <thead>
                                <tr>
                                    <th>Tenant</th>
                                    <th>Landlord</th>
                                    <th>Building</th>
                                    <th>Floor</th>
                                    <th>Unit</th>
                                    <th>Rent</th>
                                    <th>Rent Advance Recived</th>
                                    <th>Lease Start Date</th>
                                    <th>Lease End Date</th>
                                    <th>Document</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tenantAgreements as $agreement)
                                    <tr>
                                        <td>{{ $agreement->tenant->name }}</td>
                                        <td>{{ $agreement->landlord->name }}</td>
                                        <td>{{ $agreement->building->name }}</td>
                                        <td>
                                            @php
                                                $floorNo = $agreement->floor->floor_no;
                                                if ($floorNo == 1) {
                                                    $suffix = 'st';
                                                } elseif ($floorNo == 2) {
                                                    $suffix = 'nd';
                                                } elseif ($floorNo == 3) {
                                                    $suffix = 'rd';
                                                } else {
                                                    $suffix = 'th';
                                                }
                                            @endphp
                                            {{ $agreement->floor->floor_no }}{{ $suffix }}
                                            ({{ $agreement->floor->type }})
                                        </td>
                                        <td>Unit-{{ $agreement->unit->unit_no }}</td>
                                        
                                        <td>{{ $agreement->rent }} TK</td>
                                        <td>{{ $agreement->rent_advance_received }} TK</td>
                                        <td>{{ $agreement->lease_start_date }}</td>
                                        <td>{{ $agreement->lease_end_date }}</td>
                                        <td>
                                            @if ($agreement->document)
                                                {{-- <a href="{{ asset($agreement->document) }}" >View Document</a> --}}
                                                <a href="{{ asset($agreement->document) }}" target="_blank"
                                                    class="btn btn-primary btn-sm">View Document</a>
                                            @else
                                                No Document
                                            @endif
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
