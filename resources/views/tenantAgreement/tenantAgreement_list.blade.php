@extends('master')

@push('title')
    <title>Tenant List</title>
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
                            <li class="breadcrumb-item active">Tenant list</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <h4 class="header-title m-b-15 m-t-0">Tenant List</h4>
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
                                    <th>Rent Advance</th>
                                    <th>Lease Start Date</th>
                                    <th>Lease End Date</th> 
                                    <th>Document</th>
                                    {{-- <th>Action</th> --}}
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
                                        {{-- <td>
                                            @if ($agreement->status == 1)
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-danger">Inactive</span>
                                            @endif
                                        </td> --}}

                                        {{-- <td class="text-center">
                                            <div class="btn-group dropdown">
                                                <a href="javascript: void(0);" class="table-action-btn dropdown-toggle"
                                                    data-toggle="dropdown" aria-expanded="false"><i
                                                        class="mdi mdi-dots-horizontal"></i></a>
                                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">

                                                    @can('tenant-agreement-view')
                                                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#Modallandlord-{{ $tenant->id }}"><i
                                                                            class="mdi mdi-eye m-r-10 text-muted font-18 vertical-middle"></i>
                                                                        View Info
                                                                    </a>
                                                                @endcan
                                                    @can('tenant-agreement-edit')
                                                        <a class="dropdown-item"
                                                            href="{{ route('tenant.agreement.edit', ['id' => $agreement->id]) }}"
                                                            type="submit"><i
                                                                class="mdi mdi-pencil m-r-10 text-muted font-18 vertical-middle"></i>Edit
                                                            tenant</a>
                                                    @endcan

                                                    @can('tenant-agreement-delete')
                                                        <a class="dropdown-item" href="#"
                                                            onclick="confirmDelete('{{ route('tenant.agreement.delete', ['id' => $agreement->id]) }}')"><i
                                                                class="mdi mdi-delete m-r-10 text-muted font-18 vertical-middle"></i>
                                                            Delete
                                                        </a>
                                                        <!-- Hidden form for deletion -->
                                                        <form id="delete-form"
                                                            action="{{ route('tenant.agreement.delete', ['id' => $agreement->id]) }}"
                                                            method="GET" style="display: none;">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    @endcan

                                                </div>
                                            </div>

                                        </td> --}}
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
