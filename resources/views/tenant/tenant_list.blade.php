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
                                    <button type="button" class="btn waves-effect waves-light greenbtn"
                                        onclick="window.location.href='{{ route('tenant.create') }}'">
                                        <i class="mdi mdi-plus m-r-5"></i> Add Tenant
                                    </button>
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

                                                    <a class="dropdown-item" href="#"
                                                        onclick="viewInfo({{ $tenant }})"><i
                                                            class="mdi mdi-eye m-r-10 text-muted font-18 vertical-middle"></i>
                                                        View Info
                                                    </a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('tenant.create', ['id' => $tenant->id, 'type' => 'contact-info']) }}"
                                                        type="submit"><i
                                                            class="mdi mdi-pencil m-r-10 text-muted font-18 vertical-middle"></i>Edit
                                                        tenant</a>
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
    <div class="modal fade" id="tenantInfoModal" tabindex="-1" role="dialog" aria-labelledby="tenantInfoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tenantInfoModalLabel">Tenant Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Tenant information will be populated here -->
                    <div id="tenant-info-content"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

<!-- Modal for viewing units, create one modal per tenant -->
{{-- @foreach ($tenants as $tenant)
    <div class="modal fade" id="Modalunit-{{ $tenant->id }}" tabindex="-1" role="dialog"
         aria-labelledby="ModalunitLabel-{{ $tenant->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalunitLabel-{{ $tenant->id }}">
                        Units Information for {{ $tenant->name }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Units information will be populated here -->
                    @if ($tenant->units && $tenant->units->isNotEmpty())
                        <ul class="list-group">
                            @forelse ($tenant->units as $unit)
                            @if ($unit->status == 'Occupied')
                                
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
                            @else
                            <ul class="list-group">
                                <li class="list-group-item">No units available</li>
                            </ul>

                            @endif
                        @empty
                            <ul class="list-group">
                                <li class="list-group-item">No units available</li>
                            </ul>
                        @endforelse

                        @endif
                       
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endforeach --}}


    {{-- <script>
        function viewInfo(tenant) {
            let infoContent = `
                <p><strong>Name:</strong> ${tenant.name}</p>
                <p><strong>Father:</strong> ${tenant.father}</p>
                <p><strong>Mother:</strong> ${tenant.mother}</p>
                <p><strong>Phone:</strong> ${tenant.phone}</p>
                <p><strong>Email:</strong> ${tenant.email}</p>
                <p><strong>NID:</strong> ${tenant.nid}</p>
                <p><strong>Tax ID:</strong> ${tenant.tax_id}</p>
                <p><strong>Passport:</strong> ${tenant.passport}</p>
                <p><strong>Driving License:</strong> ${tenant.driving_license}</p>
                <p><strong>DOB:</strong> ${tenant.dob}</p>
                <p><strong>Marital Status:</strong> ${tenant.marital_status}</p>
                <p><strong>Permanent Address:</strong> ${tenant.per_address}</p>
                <p><strong>Occupation:</strong> ${tenant.occupation}</p>
                <p><strong>Company:</strong> ${tenant.company}</p>
                <p><strong>Religion:</strong> ${tenant.religion}</p>
                <p><strong>Qualification:</strong> ${tenant.qualification}</p>
                <p><strong>Family Members:</strong> ${tenant.family_members}</p>
                <p align =" center"><strong>Family Members Details</strong></p>
                <ul>
                    @php
                        $i = 1;
                        $familyMembersDetails = json_decode($tenant->family_members_details, true); // Decoding the JSON data
                    @endphp
                    @foreach ($familyMembersDetails as $member)
                        <li>
                            <p><strong>Family Member {{ $i }}</strong></p>
                            <p><strong>Name:</strong> {{ $member['name'] ?? 'N/A' }}</p>
                            <p><strong>Age:</strong> {{ $member['age'] ?? 'N/A' }}</p>
                            <p><strong>Occupation:</strong> {{ $member['occupation'] ?? 'N/A' }}</p>
                            <p><strong>Phone:</strong> {{ $member['phone'] ?? 'N/A' }}</p>
                        </li>
                        @php
                            $i++;
                        @endphp
                    @endforeach
                </ul>

                <p align ="center"><strong>Emergency Contact</strong></p>
                <p><strong>Name:</strong> ${tenant.e_name}</p>
                <p><strong>Relation:</strong> ${tenant.e_rel}</p>
                <p><strong>Address:</strong> ${tenant.e_add}</p>
                <p><strong>Phone:</strong> ${tenant.e_phone}</p>

                <p align =" center"><strong>Housemaid Information</strong></p>
                <p><strong>Name:</strong> ${tenant.housemaid_name}</p>
                <p><strong>NID:</strong> ${tenant.housemaid_nid}</p>
                <p><strong>Phone:</strong> ${tenant.housemaid_phone}</p>
                <p><strong>Address:</strong> ${tenant.housemaid_address}</p>

                <p align =" center"><strong>Driver Information</strong></p>
                <p><strong>Name:</strong> ${tenant.driver_name}</p>
                <p><strong>NID:</strong> ${tenant.driver_nid}</p>
                <p><strong>Phone:</strong> ${tenant.driver_phone}</p>
                <p><strong>Address:</strong> ${tenant.driver_address}</p>

                <p align =" center"><strong>Previous Owner Information</strong></p>
                <p><strong>Name:</strong> ${tenant.pre_owner_name}</p>
                <p><strong>Phone:</strong> ${tenant.pre_owner_phone}</p>
                <p><strong>Address:</strong> ${tenant.pre_owner_address}</p>

                <p align =" center"><strong>Reason for leaving previous House</strong></p>
                <p><strong>Reason:</strong> ${tenant.reason}</p>

                <p align =" center"><strong>Present House-Owner Information</strong></p>
                <p><strong>Name:</strong> ${tenant.new_owner_name}</p>
                <p><strong>Phone:</strong> ${tenant.new_owner_phone}</p>

                <p align =" center"><strong>Start Date of living in the house</strong></p>
                <p><strong>Date:</strong> ${tenant.new_house_start_date}</p>
            `;
            document.getElementById('tenant-info-content').innerHTML = infoContent;
            $('#tenantInfoModal').modal('show');
        }
    </script> --}}
@endsection
