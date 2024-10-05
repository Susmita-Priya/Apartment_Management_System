@extends('master')

@section('content')
    @push('title')
        <title>Assign Vehicle and Parker</title>
    @endpush
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Assign Vehicle and Parker</h4>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('unit.index') }}">unit list</a></li>
                            <li class="breadcrumb-item active">Assign</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <h4 class="header-title">Unit No: UNIT-{{ $unit->unit_no }}</h4>

                        <h5>Assign Tenant/Landlord</h5>
                        <form method="POST" action="{{ route('unit.assign') }}">
                            @csrf
                            <div class="form-group">
                                <label for="tenant">Select Tenant</label>
                                <select class="form-control" id="tenant" name="tenant_id">
                                    <option value="">Select Tenant</option>
                                    @foreach ($tenants as $tenant)
                                        <option value="{{ $tenant->id }}">{{ $tenant->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="landlord">Select Landlord</label>
                                <select class="form-control" id="landlord" name="landlord_id">
                                    <option value="">Select Landlord</option>
                                    @foreach ($landlords as $landlord)
                                        <option value="{{ $landlord->id }}">{{ $landlord->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Assign</button>
                        </form>

                        <h5 class="mt-5">Assigned Tenants</h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Tenant Name</th>
                                    <th>Tenant Email</th>
                                    <th>Tenant Phone</th>
                                    <th>Tenant Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($assignments as $assignment)
                                    <tr>
                                        <td>{{ $assignment->tenant->name ?? 'N/A' }}</td>
                                        <td>{{ $assignment->tenant->email ?? 'N/A' }}</td>
                                        <td>{{ $assignment->tenant->phone ?? 'N/A' }}</td>
                                        <td>
                                            @if ($assignment->tenant && $assignment->tenant->image)
                                                <img src="{{ asset('storage/' . $assignment->tenant->image) }}"
                                                    alt="Tenant Image" width="50">
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>
                                            {{-- <button type="button" class="btn btn-info" data-toggle="modal" data-target="#tenantModal{{ $assignment->tenant->id }}">
                                                Show Info
                                            </button> --}}
                                            <form method="POST" action="{{ route('unit.unassign', $assignment->id) }}"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <h5 class="mt-5">Assigned Landlords</h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Landlord Name</th>
                                    <th>Landlord Email</th>
                                    <th>Landlord Phone</th>
                                    <th>Landlord Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($assignments as $assignment)
                                    <tr>
                                        <td>{{ $assignment->landlord->name ?? 'N/A' }}</td>
                                        <td>{{ $assignment->landlord->email ?? 'N/A' }}</td>
                                        <td>{{ $assignment->landlord->phone ?? 'N/A' }}</td>
                                        <td>
                                            @if ($assignment->landlord && $assignment->landlord->image)
                                                <img src="{{ asset('storage/' . $assignment->landlord->image) }}"
                                                    alt="Landlord Image" width="50">
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>
                                            {{-- <button type="button" class="btn btn-info" data-toggle="modal" data-target="#landlordModal{{ $assignment->landlord->id }}">
                                                Show Info
                                            </button> --}}
                                            <form method="POST" action="{{ route('unit.unassign', $assignment->id) }}"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{-- <!-- Tenant Info Modals -->
                        @foreach ($assignments as $assignment)
                        @if ($assignment->tenant)
                            <div class="modal fade" id="tenantModal{{ $assignment->tenant->id }}" tabindex="-1" role="dialog" aria-labelledby="tenantModalLabel{{ $assignment->tenant->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="tenantModalLabel{{ $assignment->tenant->id }}">Tenant Info</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Name:</strong> {{ $assignment->tenant->name }}</p>
                                            <p><strong>Email:</strong> {{ $assignment->tenant->email }}</p>
                                            <p><strong>Phone:</strong> {{ $assignment->tenant->phone }}</p>
                                            @if ($assignment->tenant->image)
                                                <p><strong>Image:</strong></p>
                                                <img src="{{ asset('storage/' . $assignment->tenant->image) }}" alt="Tenant Image" width="100">
                                            @endif
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @endforeach

                        <!-- Landlord Info Modals -->
                        @foreach ($assignments as $assignment)
                        @if ($assignment->landlord)
                            <div class="modal fade" id="landlordModal{{ $assignment->landlord->id }}" tabindex="-1" role="dialog" aria-labelledby="landlordModalLabel{{ $assignment->landlord->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="landlordModalLabel{{ $assignment->landlord->id }}">Landlord Info</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Name:</strong> {{ $assignment->landlord->name }}</p>
                                            <p><strong>Email:</strong> {{ $assignment->landlord->email }}</p>
                                            <p><strong>Phone:</strong> {{ $assignment->landlord->phone }}</p>
                                            @if ($assignment->landlord->image)
                                                <p><strong>Image:</strong></p>
                                                <img src="{{ asset('storage/' . $assignment->landlord->image) }}" alt="Landlord Image" width="100">
                                            @endif
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @endforeach --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

