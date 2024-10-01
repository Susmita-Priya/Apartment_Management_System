@extends('master')

@push('title')
    <title>Parkers List</title>
@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Parkers</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
      
                            <li class="breadcrumb-item active">Parkers list</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <h4 class="header-title m-b-15 m-t-0">Parkers List</h4>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="text-right m-b-20">
                                    <button type="button" class="btn waves-effect waves-light greenbtn"
                                        onclick="window.location.href='{{ route('parker.create') }}'">
                                        <i class="mdi mdi-plus m-r-5"></i> Add Parker
                                    </button>
                                </div>
                            </div>
                        </div>

                        <table class="table table-hover m-0 tickets-list table-actions-bar dt-responsive nowrap"
                            cellspacing="0" width="100%" id="datatable">
                            <thead>
                                <tr>
                                    <th>Parker No</th>
                                    <th>Parker Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Stall No</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($parkers as $parker)
                                    <tr>
                                        <td>{{ $parker->parker_no }}</td>
                                        <td>{{ $parker->parker_name }}</td>
                                        <td>{{ $parker->email }}</td>
                                        <td>{{ $parker->phn }}</td>
                                        <td>{{ $parker->stall_no ? "Stall - " . $parker->stall_no : '' }}</td>
                                        <td>
                                            @if ($parker->status === 'assigned')
                                                <span class="badge badge-success">{{ $parker->status }}</span>
                                            @else
                                                <span class="badge badge-danger">{{ $parker->status }}</span>
                                            @endif                                      
                                        </td> <!-- Display status -->
                                        <td>
                                            <div class="btn-group dropdown">
                                                <a href="javascript: void(0);" class="table-action-btn dropdown-toggle"
                                                    data-toggle="dropdown" aria-expanded="false"><i
                                                        class="mdi mdi-dots-horizontal"></i></a>
                                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                    {{-- <a class="dropdown-item"
                                                        href="{{ route('parker.show', ['id' => $parker->id]) }}"><i
                                                            class="mdi mdi-eye m-r-10 font-18 text-muted vertical-middle"></i>View
                                                        Details</a> --}}
                                                    <a class="dropdown-item"
                                                        href="{{ route('parker.edit', ['id' => $parker->id]) }}"
                                                        type="submit"><i
                                                            class="mdi mdi-pencil m-r-10 text-muted font-18 vertical-middle"></i>Edit
                                                        parker</a>
                                                    <a class="dropdown-item"
                                                        onclick="confirmDelete('{{ route('parker.delete', ['id' => $parker->id]) }}')"><i
                                                            class="mdi mdi-delete m-r-10 text-muted font-18 vertical-middle"></i>
                                                        Delete
                                                    </a>
                                                    <!-- Hidden form for deletion -->
                                                    <form id="delete-form"
                                                        action="{{ route('parker.delete', ['id' => $parker->id]) }}"
                                                        method="GET" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
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
