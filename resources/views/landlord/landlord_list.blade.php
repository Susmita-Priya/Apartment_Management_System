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
                                    <button type="button" class="btn waves-effect waves-light greenbtn"
                                        onclick="window.location.href='{{ route('landlord.create') }}'">
                                        <i class="mdi mdi-plus m-r-5"></i> Add Landlord
                                    </button>
                                </div>
                            </div>
                        </div>

                        <table class="table table-hover m-0 tickets-list table-actions-bar dt-responsive nowrap"
                            cellspacing="0" width="100%" id="datatable">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Statistics</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($landlords as $landlord)
                                    <tr>
                                        <td><img src="{{ asset($landlord->image) }}" alt="{{ $landlord->name }}"
                                                style="width: 80px; height: auto;"></td>
                                        <td>{{ $landlord->name }}</td>
                                        <td>{{ $landlord->phone }}</td>
                                        <td>{{ $landlord->email }}</td>
                                        <td>{{ $landlord->per_address }}</td>
                                        <td>
                                            Unit : {{ $landlord->units_count }}
                                        </td>

                                        <td class="text-center">
                                            <div class="btn-group dropdown">
                                                <a href="javascript: void(0);" class="table-action-btn dropdown-toggle"
                                                    data-toggle="dropdown" aria-expanded="false"><i
                                                        class="mdi mdi-dots-horizontal"></i></a>
                                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">

                                                    <a class="dropdown-item" href="#"
                                                        onclick="viewInfo({{ $landlord }})"><i
                                                            class="mdi mdi-eye m-r-10 text-muted font-18 vertical-middle"></i>
                                                        View Info
                                                    </a>

                                                    <!-- View Unit Button -->
                                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                                        data-target="#Modalunit-{{ $landlord->id }}">
                                                        <i
                                                            class="mdi mdi-eye m-r-10 text-muted font-18 vertical-middle"></i>
                                                        View Unit
                                                    </a>

                                                    <a class="dropdown-item"
                                                        href="{{ route('landlord.edit', ['id' => $landlord->id]) }}"
                                                        type="submit"><i
                                                            class="mdi mdi-pencil m-r-10 text-muted font-18 vertical-middle"></i>Edit
                                                        landlord</a>

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

    <!-- Modal -->
    <div class="modal fade" id="landlordInfoModal" tabindex="-1" role="dialog" aria-labelledby="landlordInfoModalLabel"
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
                    <!-- Landlord information will be populated here -->
                    <div id="landlord-info-content"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal for viewing units, create one modal per landlord -->
    @foreach ($landlords as $landlord)
        <div class="modal fade" id="Modalunit-{{ $landlord->id }}" tabindex="-1" role="dialog"
            aria-labelledby="ModalunitLabel-{{ $landlord->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalunitLabel-{{ $landlord->id }}">Units Information for
                            {{ $landlord->name }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        @forelse ($landlord->units as $unit)
                            <ul class="list-group">
                                <a href="{{ route('unit.show', ['id' => $unit->id]) }}">
                                    <li class="list-group-item text-center" style="cursor: pointer;">
                                        <strong>Unit-{{ $unit->unit_no }}:</strong> {{ $unit->type }}
                                    </li>
                                </a>
                                                               
                                <li class="list-group-item"><strong>Floor:
                                    </strong>{{ $unit->floor->type }}-{{ $unit->floor->floor_no }}</li>
                                <li class="list-group-item"><strong>Block: </strong>{{ $unit->floor->block->name }}
                                    ({{ $unit->floor->block->block_id }})</li>
                                <li class="list-group-item"><strong>Building:
                                    </strong>{{ $unit->floor->block->building->name }}
                                    ({{ $unit->floor->block->building->building_id }})</li>
                            </ul>
                        @empty
                            <ul class="list-group">
                                <li class="list-group-item">No units available</li>
                            </ul>
                        @endforelse

                    </div>
                    <div class="modal-footer">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                        {{-- <a href="{{ route('edit.unit', $landlord->id) }}" class="btn btn-primary">Edit Asset</a>
                <form action="{{ route('delete.unit', $landlord->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Asset</button>
                </form> --}}
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <script>
        function viewInfo(landlord) {
            let infoContent = `
                <p><strong>Name:</strong> ${landlord.name}</p>
                <p><strong>Phone:</strong> ${landlord.phone}</p>
                <p><strong>Email:</strong> ${landlord.email}</p>
                <p><strong>NID:</strong> ${landlord.nid}</p>
                <p><strong>Tax ID:</strong> ${landlord.tax_id}</p>
                <p><strong>Passport:</strong> ${landlord.passport}</p>
                <p><strong>Driving License:</strong> ${landlord.driving_license}</p>
                <p><strong>DOB:</strong> ${landlord.dob}</p>
                <p><strong>Marital Status:</strong> ${landlord.marital_status}</p>
                <p><strong>Address:</strong> ${landlord.per_address}</p>
                <p><strong>Occupation:</strong> ${landlord.occupation}</p>
                <p><strong>Company:</strong> ${landlord.company}</p>
                <p><strong>Religion:</strong> ${landlord.religion}</p>
                <p><strong>Qualification:</strong> ${landlord.qualification}</p>
            `;
            document.getElementById('landlord-info-content').innerHTML = infoContent;
            $('#landlordInfoModal').modal('show');
        }
    </script>
@endsection
