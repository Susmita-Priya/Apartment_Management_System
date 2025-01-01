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
                                    @can('landlord-create')
                                        <button type="button" class="btn waves-effect waves-light greenbtn"
                                            onclick="window.location.href='{{ route('landlord.create') }}'">
                                            <i class="mdi mdi-plus m-r-5"></i> Add Landlord
                                        </button>
                                    @endcan

                                </div>
                            </div>
                        </div>

                        <table class="table table-hover m-0 tickets-list table-actions-bar dt-responsive nowrap"
                            cellspacing="0" width="100%" id="datatable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>NID</th>
                                    <th>Tread Licence</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($landlords as $landlord)
                                    <tr>

                                        <td>{{ $landlord->name }}</td>
                                        <td>{{ $landlord->email }}</td>
                                        <td>{{ $landlord->phone }}</td>
                                        <td>{{ $landlord->address }}</td>
                                        <td>{{ $landlord->nid }}</td>
                                        <td>{{ $landlord->tread_licence }}</td>

                                        <td class="text-center">
                                            <div class="btn-group dropdown">
                                                <a href="javascript: void(0);" class="table-action-btn dropdown-toggle"
                                                    data-toggle="dropdown" aria-expanded="false"><i
                                                        class="mdi mdi-dots-horizontal"></i></a>
                                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">

                                                    @can('landlord-view')
                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#Modallandlord-{{ $landlord->id }}"><i
                                                                class="mdi mdi-eye m-r-10 text-muted font-18 vertical-middle"></i>
                                                            View Info
                                                        </a>
                                                    @endcan

                                                    @can('landlord-edit')
                                                        <a class="dropdown-item"
                                                            href="{{ route('landlord.edit', ['id' => $landlord->id]) }}"
                                                            type="submit"><i
                                                                class="mdi mdi-pencil m-r-10 text-muted font-18 vertical-middle"></i>Edit
                                                            landlord</a>
                                                    @endcan

                                                    @can('landlord-delete')
                                                        <a class="dropdown-item" href="#"
                                                            onclick="confirmDelete('{{ route('landlord.delete', ['id' => $landlord->id]) }}')"><i
                                                                class="mdi mdi-delete m-r-10 text-muted font-18 vertical-middle"></i>
                                                            Delete
                                                        </a>
                                                        <!-- Hidden form for deletion -->
                                                        <form id="delete-form"
                                                            action="{{ route('landlord.delete', ['id' => $landlord->id]) }}"
                                                            method="GET" style="display: none;">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    @endcan


                                                </div>
                                            </div>
                                            <!-- Modal -->
                                            <div class="modal fade" id="Modallandlord-{{ $landlord->id }}" tabindex="-1" role="dialog" aria-labelledby="landlordInfoModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="landlordInfoModalLabel">Landlord Information</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p><strong>Name:</strong> {{ $landlord->name }}</p>
                                                            <p><strong>Phone:</strong> {{ $landlord->phone }}</p>
                                                            <p><strong>Email:</strong> {{ $landlord->email }}</p>
                                                            <p><strong>NID:</strong> {{ $landlord->nid }}</p>
                                                            <p><strong>Tax ID:</strong> {{ $landlord->tread_licence }}</p>
                                                            <p><strong>Address:</strong> {{ $landlord->address }}</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
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
