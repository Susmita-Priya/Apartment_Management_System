@extends('master')

@push('title')
    <title>Landlord List</title>
@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Landlords</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Landlord list</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <h4 class="header-title m-b-15 m-t-0">Landlord List</h4>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="text-right m-b-20">
                                    @can('landlord-agreement-create')
                                        <button type="button" class="btn waves-effect waves-light greenbtn"
                                            onclick="window.location.href='{{ route('landlord.agreement.create') }}'">
                                            <i class="mdi mdi-plus m-r-5"></i> Create Landlord Agreement
                                        </button>
                                    @endcan

                                </div>
                            </div>
                        </div>

                        <table class="table table-hover m-0 tickets-list table-actions-bar dt-responsive nowrap"
                            cellspacing="0" width="100%" id="datatable">
                            <thead>
                                <tr>
                                    <th>Landlord</th>
                                    <th>Company</th>
                                    <th>Building</th>
                                    <th>Floor</th>
                                    <th>Unit</th>
                                    <th>Document</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($landlordAgreements as $agreement)
                                <tr>
                                    <td>{{ $agreement->landlord->name }}</td>
                                    <td>{{ $agreement->company->name }}</td>
                                    <td>{{ $agreement->building->name }}</td>
                                    <td>
                                        @php
                                            $suffix = 'th';
                                            if ($agreement->floor->floor_no  == 1) {
                                                $suffix = 'st';
                                            } elseif ($agreement->floor->floor_no == 2) {
                                                $suffix = 'nd';
                                            } elseif ($agreement->floor->floor_no == 3) {
                                                $suffix = 'rd';
                                            }
                                        @endphp
                                        {{ $agreement->floor->floor_no }}{{ $suffix }} ({{ $agreement->floor->type }})
                                    </td>
                                    <td>Unit-{{ $agreement->unit->unit_no }}</td>
                                    <td>
                                        @if($agreement->document)
                                            <a href="{{ asset($agreement->document) }}" target="_blank">View Document</a>
                                        @else
                                            No Document
                                        @endif
                                    </td>
                                    <td>{{ $agreement->amount }}TK</td>
                                    <td>
                                        @if($agreement->status == 1)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">Inactive</span>
                                        @endif
                                    </td>
                               
                                        <td class="text-center">
                                            <div class="btn-group dropdown">
                                                <a href="javascript: void(0);" class="table-action-btn dropdown-toggle"
                                                    data-toggle="dropdown" aria-expanded="false"><i
                                                        class="mdi mdi-dots-horizontal"></i></a>
                                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">

                                                                {{-- @can('landlord-agreement-view')
                                                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#Modallandlord-{{ $landlord->id }}"><i
                                                                            class="mdi mdi-eye m-r-10 text-muted font-18 vertical-middle"></i>
                                                                        View Info
                                                                    </a>
                                                                @endcan --}}
                                                    @can('landlord-agreement-edit')
                                                        <a class="dropdown-item"
                                                            href="{{ route('landlord.agreement.edit', ['id' => $agreement->id]) }}"
                                                            type="submit"><i
                                                                class="mdi mdi-pencil m-r-10 text-muted font-18 vertical-middle"></i>Edit
                                                            landlord</a>
                                                    @endcan
                                                    @can('landlord-agreement-delete')
                                                        <a class="dropdown-item" href="#"
                                                            onclick="confirmDelete('{{ route('landlord.agreement.delete', ['id' => $agreement->id]) }}')"><i
                                                                class="mdi mdi-delete m-r-10 text-muted font-18 vertical-middle"></i>
                                                            Delete
                                                        </a>
                                                        <!-- Hidden form for deletion -->
                                                        <form id="delete-form"
                                                            action="{{ route('landlord.agreement.delete', ['id' => $agreement->id]) }}"
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
