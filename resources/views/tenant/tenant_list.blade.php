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
                                    @can('tenant-create')
                                        <button type="button" class="btn waves-effect waves-light greenbtn"
                                        onclick="window.location.href='{{ route('tenant.create') }}'">
                                        <i class="mdi mdi-plus m-r-5"></i> Add Tenant
                                    </button>
                                    @endcan
                                    
                                </div>
                            </div>
                        </div>

                        <table class="table table-hover m-0 tickets-list table-actions-bar dt-responsive nowrap"
                            cellspacing="0" width="100%" id="datatable">
                            @php
                                $i = 1;
                            @endphp
                            <thead>
                                <tr>
                                    <th>Serial</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tenants as $tenant)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $tenant->full_name }}</td>
                                        <td>{{ $tenant->phone }}</td>
                                        <td>{{ $tenant->email }}</td>
                                        <td>{{ $tenant->address }}</td>
                                        
                                        <td class="text-center">
                                            <div class="btn-group dropdown">
                                                <a href="javascript: void(0);" class="table-action-btn dropdown-toggle"
                                                    data-toggle="dropdown" aria-expanded="false"><i
                                                        class="mdi mdi-dots-horizontal"></i></a>
                                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                    @can('tenant-view')
                                                        <a class="dropdown-item" href="{{ route('tenant.show', ['id' => $tenant->id]) }}" type="submit">
                                                        <i class="mdi mdi-eye m-r-10 text-muted font-18 vertical-middle"></i>
                                                        View Info
                                                    </a>
                                                    @endcan
                                                    @can('tenant-edit')
                                                        <a class="dropdown-item"
                                                        href="{{ route('tenant.create', ['id' => $tenant->id, 'type' => 'contact-info']) }}"
                                                        type="submit"><i
                                                            class="mdi mdi-pencil m-r-10 text-muted font-18 vertical-middle"></i>Edit
                                                        tenant</a>
                                                        
                                                    @endcan
                                                    
                                                    @can('tenant-delete')
                                                        <a class="dropdown-item" href="#"
                                                        onclick="confirmDelete('{{ route('tenant.delete', ['id' => $tenant->id]) }}')"><i
                                                             class="mdi mdi-delete m-r-10 text-muted font-18 vertical-middle"></i>
                                                        Delete
                                                    </a>
                                                    <!-- Hidden form for deletion -->
                                                    <form id="delete-form"
                                                        action="{{ route('tenant.delete', ['id' => $tenant->id]) }}"
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
