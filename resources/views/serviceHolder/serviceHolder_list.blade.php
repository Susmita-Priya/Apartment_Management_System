@extends('master')

@push('title')
    <title>Service Holder List</title>
@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Service Holders</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Service Holder List</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <h4 class="header-title m-b-15 m-t-0">Service Holder List</h4>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="text-right m-b-20">
                                    @can('service-holder-create')
                                        <button type="button" class="btn waves-effect waves-light greenbtn"
                                            onclick="window.location.href='{{ route('serviceHolder.create') }}'">
                                            <i class="mdi mdi-plus m-r-5"></i> Add Service holder
                                        </button>
                                    @endcan

                                </div>
                            </div>
                        </div>

                        @php
                            $i=1;
                        @endphp

                        <table class="table table-hover m-0 tickets-list table-actions-bar dt-responsive nowrap"
                            cellspacing="0" width="100%" id="datatable">
                            <thead>
                                <tr>
                                    <th>Serial</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Landlord</th>
                                    <th>Services</th>
                                    <th>Note</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($serviceHolders as $serviceHolder)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $serviceHolder->name }}</td>
                                    <td>{{ $serviceHolder->phone }}</td>
                                    <td>{{ $serviceHolder->email }}</td>
                                    {{-- <td>{{ $serviceHolder->landlord->name ?? 'N/A' }}</td> --}}
                                    <td>
                                        @if ($serviceHolder->landlord)
                                            {{ $serviceHolder->landlord->name }}
                                        @else
                                            N/A
                                        @endif
                                    <td>
                                        @php
                                        $serviceHolderservices = json_decode($serviceHolder->services_id, true) ?? [];
                                        @endphp
                                        @foreach ($services as $service)
                                            @if (in_array($service->id, $serviceHolderservices))
                                                <span class="badge bg-primary">{{ $service->name }}</span>
                                            @endif
                                        @endforeach

                                    </td>
                                    <td>{{ $serviceHolder->note ?? 'N/A' }}</td>
                                    <td class="text-center">
                                        <div class="btn-group dropdown">
                                            <a href="javascript: void(0);" class="table-action-btn dropdown-toggle"
                                                data-toggle="dropdown" aria-expanded="false"><i
                                                    class="mdi mdi-dots-horizontal"></i></a>
                                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                @can('service-holder-edit')
                                                    <a class="dropdown-item"
                                                        href="{{ route('serviceHolder.edit', $serviceHolder->id) }}"
                                                        type="submit"><i
                                                            class="mdi mdi-pencil m-r-10 text-muted font-18 vertical-middle"></i>Edit Info</a>
                                                @endcan
                                                @can('service-holder-delete')
                                                    <a class="dropdown-item" href="#"
                                                        onclick="confirmDelete('{{ route('serviceHolder.delete', $serviceHolder->id) }}')"><i
                                                            class="mdi mdi-delete m-r-10 text-muted font-18 vertical-middle"></i>
                                                        Delete
                                                    </a>
                                                    <!-- Hidden form for deletion -->
                                                    <form id="delete-form"
                                                        action="{{ route('serviceHolder.delete', $serviceHolder->id) }}"
                                                        method="GET" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                @endcan
                                            </div>
                                        </div>
                                    </td>
                                    {{-- <td>

                                        <a href="{{ route('serviceHolder.edit', $serviceHolder->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('serviceHolder.destroy', $serviceHolder->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
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

