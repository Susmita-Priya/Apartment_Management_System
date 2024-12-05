@extends('master')

@push('title')
    <title>Lease Request List</title>
@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Lease</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Lease Request list</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <h4 class="header-title m-b-15 m-t-0">Lease Request list</h4>

                        {{-- <div class="row">
                            <div class="col-sm-12">
                                <div class="text-right m-b-20">
                                    <button type="button" class="btn waves-effect waves-light greenbtn"
                                        onclick="window.location.href='{{ route('tenants.create') }}'">
                                        <i class="mdi mdi-plus m-r-5"></i> Add Tenant
                                    </button>
                                </div>
                            </div>
                        </div> --}}

                        <table class="table table-hover m-0 tickets-list table-actions-bar dt-responsive nowrap"
                            cellspacing="0" width="100%" id="datatable">
                            <thead>
                                <tr>
                                    <th>Tenant Name</th>
                                    <th>Unit Name</th>
                                    <th>Send Aggrement</th>
                                    <th>Accept</th>
                                    <th>Reject</th>

                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($leaseRequests as $request)
                                    <tr>
                                        <td>{{ $request->tenant->name }}</td>
                                        <td>Unit - {{ $request->unit->unit_no }} (Floor - {{ $request->unit->floor->floor_no }} , {{ $request->unit->floor->block->block_id }})</td>
                                        <td class="text-center">

                                            @if ($request->agreement == 1 && $request->agreement_path == null)
                                                <span class="badge badge-success">Sent</span>
                                            @elseif ($request->agreement == 1 && $request->agreement_path != null)
                                                <a href="{{ route('download.agreement', ['id' => $request->id]) }}" class="btn btn-primary">Download Agreement</a>
                                            @else
                                                <a class="btn btn-success" href="{{ route('send.agreement', ['id' => $request->id]) }}"><i
                                                class="mdi mdi-send m-r-10  font-18 vertical-middle"></i>Send Agreement</a>
                                            @endif
                                        </td>   
                                        <td class="text-center">
                                            @if ($request->agreement == 1 && $request->agreement_path != null)
                                                 <a class="dropdown-item"
                                                href="{{ route('agreement.accept', ['id' => $request->id]) }}" type="submit"><i
                                                    class="mdi mdi-check m-r-10 text-muted font-18 vertical-middle"></i>Accept</a>
                                            @else 
                                                <span class="badge badge-warning">Pending</span>
                                            @endif
                                           
                                        </td>
                                            {{-- <a class="dropdown-item" href="#"
                                                onclick="confirmDelete('{{ route('tenants.delete', ['id' => $tenant->id]) }}')"><i
                                                    class="mdi mdi-delete m-r-10 text-muted font-18 vertical-middle"></i>
                                                Reject
                                            </a>
                                            <!-- Hidden form for deletion -->
                                            <form id="delete-form"
                                                action="{{ route('tenants.delete', ['id' => $tenant->id]) }}" method="GET"
                                                style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form> --}}
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
